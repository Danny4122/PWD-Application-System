<?php
// api/admin_action.php
session_start();
header('Content-Type: application/json');
require_once __DIR__ . '/../config/db.php';

// only admins may call this
if (empty($_SESSION['user_id']) || empty($_SESSION['is_admin'])) {
    http_response_code(403);
    echo json_encode(['error'=>'Not authorized']);
    exit;
}

$admin_id = (int)$_SESSION['user_id'];
$appId = (int)($_POST['application_id'] ?? 0);
$action = trim($_POST['action'] ?? '');
$remarks = trim($_POST['remarks'] ?? '');

if (!$appId || $action === '') {
    http_response_code(400);
    echo json_encode(['error'=>'Missing parameters']);
    exit;
}

pg_query($conn, 'BEGIN');
try {
    // lock
    $res = pg_query_params($conn, "SELECT workflow_status FROM application WHERE application_id = $1 FOR UPDATE", [$appId]);
    if (!$res || pg_num_rows($res) === 0) throw new Exception('Application not found');
    $row = pg_fetch_assoc($res);
    $from = $row['workflow_status'] ?? 'submitted';

    // map action -> new status
    if ($action === 'forward_to_cho') {
        $to = 'cho_review';
    } elseif ($action === 'request_more_info') {
        $to = 'pdao_review';
    } elseif ($action === 'reject') {
        $to = 'pdao_rejected';
    } else {
        throw new Exception('Invalid action');
    }

    $upd = pg_query_params($conn,
        "UPDATE application SET workflow_status = $1, remarks = $2, updated_at = CURRENT_TIMESTAMP WHERE application_id = $3",
        [$to, $remarks, $appId]
    );
    if ($upd === false) throw new Exception('Failed to update application');

    $ins = pg_query_params($conn,
        "INSERT INTO application_status_history(application_id, from_status, to_status, changed_by, role, remarks)
         VALUES($1, $2, $3, $4, 'pdao_admin', $5)",
        [$appId, $from, $to, $admin_id, $remarks]
    );
    if ($ins === false) throw new Exception('Failed to insert history');

    pg_query($conn, 'COMMIT');

    echo json_encode(['success'=>true, 'to'=>$to]);
    exit;
} catch (Exception $e) {
    pg_query($conn, 'ROLLBACK');
    http_response_code(500);
    echo json_encode(['error'=>$e->getMessage()]);
    exit;
}
