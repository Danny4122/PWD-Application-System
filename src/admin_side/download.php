<?php
// admin_side/download.php
// Secure file download handler for multiple document types

require_once __DIR__ . '/../../config/db.php';    // correct path from admin_side to config/
require_once __DIR__ . '/../../config/paths.php'; // optional, for APP_BASE_URL
session_start();

// -----------------------------
// 1) Authentication
// -----------------------------
if (empty($_SESSION['user_id'])) {
    http_response_code(403);
    echo '❌ Not authorized. Please log in.';
    exit;
}

$userId  = $_SESSION['user_id'];
$isAdmin = !empty($_SESSION['is_admin']); // true for admin accounts

// -----------------------------
// 2) Validate parameters
// -----------------------------
$docId = isset($_GET['doc']) ? filter_var($_GET['doc'], FILTER_VALIDATE_INT) : false;
$type  = $_GET['type'] ?? 'medical'; // default to medical cert

if ($docId === false || $docId <= 0) {
    http_response_code(400);
    echo '❌ Invalid document id.';
    exit;
}

// -----------------------------
// 3) Map type → DB column
// -----------------------------
$columnMap = [
    'medical'   => 'medicalcert_path',
    'barangay'  => 'barangaycert_path',
    'bodypic'   => 'bodypic_path',
    'pwdid'     => 'old_pwd_id_path',
    'affidavit' => 'affidavit_loss_path',
    'cho'       => 'cho_cert_path', // optional
    'pic1x1'    => 'pic_1x1_path'   // optional
];

if (!array_key_exists($type, $columnMap)) {
    http_response_code(400);
    echo '❌ Invalid document type.';
    exit;
}

$fileColumn = $columnMap[$type];

// -----------------------------
// 4) Fetch document record
// -----------------------------
$sql = "SELECT document_id, application_id, $fileColumn AS file_path
        FROM documentrequirements
        WHERE document_id = $1
        LIMIT 1";

$res = pg_query_params($conn, $sql, [$docId]);

if ($res === false) {
    error_log('download.php: DB query error: ' . pg_last_error($conn));
    http_response_code(500);
    echo '⚠️ Server error while fetching document.';
    exit;
}

$doc = pg_fetch_assoc($res);
if (!$doc || empty($doc['file_path'])) {
    http_response_code(404);
    echo '❌ Document not found.';
    exit;
}

// -----------------------------
// 5) Authorization check
// -----------------------------
if (!$isAdmin) {
    // Allow only owner (applicant) to access their file
    $sqlOwner = "
      SELECT a.applicant_id, ap.user_account_id
      FROM application a
      JOIN applicant ap ON a.applicant_id = ap.applicant_id
      WHERE a.application_id = $1
      LIMIT 1
    ";
    $r2 = pg_query_params($conn, $sqlOwner, [$doc['application_id']]);
    if ($r2 === false) {
        error_log('download.php: owner check query error: ' . pg_last_error($conn));
        http_response_code(500);
        echo '⚠️ Error verifying file ownership.';
        exit;
    }
    $owner = pg_fetch_assoc($r2);
    $ownerUserId = $owner['user_account_id'] ?? null;

    if ($ownerUserId === null || intval($ownerUserId) !== intval($userId)) {
        http_response_code(403);
        echo '❌ You are not authorized to download this file.';
        exit;
    }
}

// -----------------------------
// 6) Locate file on disk
// -----------------------------
$uploadsRoot = realpath(__DIR__ . '/../../uploads'); // adjust if uploads folder differs
if ($uploadsRoot === false) {
    error_log('download.php: uploads root not found');
    http_response_code(500);
    echo '⚠️ Uploads folder not found on server.';
    exit;
}

$relativePath = ltrim($doc['file_path'], "/\\");
$filePath = realpath($uploadsRoot . DIRECTORY_SEPARATOR . $relativePath);

if (!$filePath || strpos($filePath, $uploadsRoot) !== 0 || !is_file($filePath)) {
    http_response_code(404);
    echo '❌ File not found on disk.';
    exit;
}

// -----------------------------
// 7) Detect MIME type
// -----------------------------
$mime = null;
if (function_exists('finfo_open')) {
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    if ($finfo) {
        $mime = finfo_file($finfo, $filePath);
        finfo_close($finfo);
    }
}
if (empty($mime)) {
    $mime = 'application/octet-stream';
}

// -----------------------------
// 8) Prepare headers
// -----------------------------
$inlineTypes = [
    'application/pdf',
    'image/jpeg', 'image/png', 'image/gif', 'image/webp',
    'text/plain'
];
$disposition = in_array($mime, $inlineTypes) ? 'inline' : 'attachment';

$downloadName = basename($filePath);

header('X-Content-Type-Options: nosniff');
header('Content-Description: File Transfer');
header('Content-Type: ' . $mime);
header('Content-Disposition: ' . $disposition . '; filename="' . $downloadName . '"');
header('Content-Length: ' . filesize($filePath));
header('Cache-Control: private, max-age=0, must-revalidate');
header('Pragma: public');

// -----------------------------
// 9) Stream file
// -----------------------------
while (ob_get_level()) ob_end_clean();
$fp = fopen($filePath, 'rb');
if ($fp === false) {
    http_response_code(500);
    echo '⚠️ Unable to open file.';
    exit;
}
fpassthru($fp);
fclose($fp);
exit;
?>
