<?php
// backend/uploads/handle_upload.php
session_start();
require_once __DIR__ . '/../config/db.php'; // adjust path to your db.php
header('Content-Type: application/json; charset=utf-8');

// Require applicant to be logged in (or admin depending on your flow)
if (empty($_SESSION['user_id'])) {
  http_response_code(401);
  echo json_encode(['success'=>false,'error'=>'Not logged in']);
  exit;
}

// Expect a file input named "file" (change if your form uses another name)
if (empty($_FILES['file']) || $_FILES['file']['error'] !== UPLOAD_ERR_OK) {
  http_response_code(400);
  echo json_encode(['success'=>false,'error'=>'No file uploaded or upload error']);
  exit;
}

$file = $_FILES['file'];
$maxBytes = 5 * 1024 * 1024; // 5 MB per file - adjust as needed

if ($file['size'] > $maxBytes) {
  http_response_code(400);
  echo json_encode(['success'=>false,'error'=>'File too large']);
  exit;
}

// Validate mime type with finfo (do NOT trust client-provided type)
$finfo = new finfo(FILEINFO_MIME_TYPE);
$mime = $finfo->file($file['tmp_name']);

// Allowed mime -> extension map
$allowed = [
  'application/pdf' => 'pdf',
  'image/jpeg' => 'jpg',
  'image/png' => 'png'
];

if (!isset($allowed[$mime])) {
  http_response_code(400);
  echo json_encode(['success'=>false,'error'=>'Invalid file type: ' . htmlspecialchars($mime)]);
  exit;
}

$ext = $allowed[$mime];

// generate stored filename (random, no original name used for filesystem)
$storeName = time() . '_' . bin2hex(random_bytes(8)) . '.' . $ext;

// folder per-application is recommended; for simplicity use a common folder or create with app id
$uploadBase = __DIR__ . '/../../uploads/applications/';
if (!is_dir($uploadBase)) mkdir($uploadBase, 0755, true);

// Optionally create a folder for an application:
// $appId = intval($_POST['application_id'] ?? 0);
// $destDir = $uploadBase . ($appId ? $appId . '/' : 'common/');
// if (!is_dir($destDir)) mkdir($destDir, 0755, true);

// For now use common subfolder:
$destDir = $uploadBase . 'common/';
if (!is_dir($destDir)) mkdir($destDir, 0755, true);

$target = $destDir . $storeName;

if (!move_uploaded_file($file['tmp_name'], $target)) {
  http_response_code(500);
  echo json_encode(['success'=>false,'error'=>'Failed to move uploaded file']);
  exit;
}

// set safe permissions (readable, not executable)
@chmod($target, 0644);

// Relative web path to store in DB (frontend/admin will use a download script instead)
$relPath = '/PWD-Application-System/uploads/applications/common/' . $storeName;

// Example DB insert — change table/columns to match your DB
$sql = "INSERT INTO public.application_attachments (filename_orig, filename_store, mime_type, file_size, created_at)
        VALUES ($1,$2,$3,$4, NOW()) RETURNING attachment_id";
$res = pg_query_params($conn, $sql, [$file['name'], $relPath, $mime, $file['size']]);

$attachId = $res ? pg_fetch_result($res, 0, 0) : null;

echo json_encode(['success'=>true,'path'=>$relPath,'attachment_id'=>$attachId]);
exit;
