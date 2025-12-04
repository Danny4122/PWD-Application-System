<?php
// api/pdao_finalize.php
session_start();
header('Content-Type: application/json');
require_once __DIR__ . '/../config/db.php';

if (empty($_SESSION['user_id']) || empty($_SESSION['is_admin'])) {
    http_response_code(403);
    echo json_encode(['error'=>'Not authorized']);
    exit;
}

$admin_id = (int)$_SESSION['user_id'];
$appId = (int)($_POST['application_id'] ?? 0);
$pwd_id = trim($_POST['pwd_id'] ?? '');
$remarks = trim($_POST['remarks'] ?? '');

if (!$appId || $pwd_id === '') {
    http_response_code(400);
    echo json_encode(['error'=>'Missing parameters']);
    exit;
}

pg_query($conn, 'BEGIN');
try {
    // lock and get applicant_id
    $res = pg_query_params($conn, "SELECT workflow_status, applicant_id FROM application WHERE application_id = $1 FOR UPDATE", [$appId]);
    if (!$res || pg_num_rows($res) === 0) throw new Exception('Application not found');
    $row = pg_fetch_assoc($res);
    $from = $row['workflow_status'] ?? null;
    $applicant_id = isset($row['applicant_id']) ? (int)$row['applicant_id'] : null;

    // update application
    $upd = pg_query_params($conn,
        "UPDATE application
         SET workflow_status = 'approved',
             status = 'Approved',
             final_pwd_id = $1,
             approved_by = $2,
             approved_at = CURRENT_TIMESTAMP,
             remarks = $3,
             updated_at = CURRENT_TIMESTAMP
         WHERE application_id = $4",
        [$pwd_id, $admin_id, $remarks, $appId]
    );
    if ($upd === false) throw new Exception('Failed to update application');

    // update applicant table (if exists)
    if ($applicant_id) {
        pg_query_params($conn, "UPDATE applicant SET pwd_number = $1 WHERE applicant_id = $2", [$pwd_id, $applicant_id]);
    }

    // insert history
    $ins = pg_query_params($conn,
        "INSERT INTO application_status_history(application_id, from_status, to_status, changed_by, role, remarks)
         VALUES($1, $2, 'approved', $3, 'pdao_admin', $4)",
        [$appId, $from, $admin_id, $remarks]
    );
    if ($ins === false) throw new Exception('Failed to insert history');

    pg_query($conn, 'COMMIT');

    echo json_encode(['success'=>true, 'pwd_id'=>$pwd_id]);
    exit;
} catch (Exception $e) {
    pg_query($conn, 'ROLLBACK');
    http_response_code(500);
    echo json_encode(['error'=>$e->getMessage()]);
    exit;
}
