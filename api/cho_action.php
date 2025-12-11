<?php
// api/cho_action.php
session_start();
require_once __DIR__ . '/../config/db.php';

if (empty($_SESSION['user_id']) || empty($_SESSION['is_doctor'])) {
    http_response_code(403);
    echo json_encode(['success'=>false,'error'=>'Not authorized']);
    exit;
}
$cho_id = (int)$_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] !== 'POST') { http_response_code(405); echo json_encode(['error'=>'Use POST']); exit; }

$appId = (int)($_POST['application_id'] ?? 0);
$action = trim((string)($_POST['action'] ?? ''));
$remarks = trim((string)($_POST['remarks'] ?? ''));

if (!$appId || !$action) { http_response_code(400); echo json_encode(['error'=>'Missing params']); exit; }
if (in_array($action, ['cho_reject']) && $remarks === '') { http_response_code(400); echo json_encode(['error'=>'Remarks required']); exit; }

$to = ($action === 'cho_verify') ? 'cho_verified' : (($action === 'cho_reject') ? 'cho_rejected' : null);
if (!$to) { http_response_code(400); echo json_encode(['error'=>'Invalid action']); exit; }

pg_query($conn, 'BEGIN');
try {
    $sel = pg_query_params($conn, "SELECT workflow_status FROM application WHERE application_id = $1 FOR UPDATE", [$appId]);
    if (!$sel || pg_num_rows($sel) === 0) throw new Exception('Application not found');
    $row = pg_fetch_assoc($sel);
    $from = $row['workflow_status'] ?? '';

    $upd = pg_query_params($conn, "UPDATE application SET workflow_status = $1, updated_at = NOW() WHERE application_id = $2", [$to, $appId]);
    if ($upd === false) throw new Exception(pg_last_error($conn));

    $ins = pg_query_params($conn, "INSERT INTO application_status_history (application_id, from_status, to_status, changed_by, role, remarks) VALUES($1,$2,$3,$4,'CHO',$5)", [$appId, $from, $to, $cho_id, $remarks]);
    if ($ins === false) throw new Exception(pg_last_error($conn));

    pg_query($conn, 'COMMIT');
    echo json_encode(['success'=>true,'new_status'=>$to]);
} catch (Exception $e) {
    pg_query($conn, 'ROLLBACK');
    http_response_code(500);
    echo json_encode(['error'=>$e->getMessage()]);
}
