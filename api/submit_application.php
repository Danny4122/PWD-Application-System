<?php
// api/submit_application.php
session_start();
header('Content-Type: application/json');
require_once __DIR__ . '/../config/db.php';

if (empty($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode(['error'=>'Not authenticated']);
    exit;
}

$user_id = (int)$_SESSION['user_id'];
$application_id = (int)($_POST['application_id'] ?? 0);
if (!$application_id) {
    // allow JSON body too
    $json = json_decode(file_get_contents('php://input'), true);
    if (!empty($json['application_id'])) $application_id = (int)$json['application_id'];
}
if (!$application_id) {
    http_response_code(400);
    echo json_encode(['error'=>'application_id required']);
    exit;
}

pg_query($conn, 'BEGIN');
try {
    // Lock application row
    $res = pg_query_params($conn, "SELECT workflow_status FROM application WHERE application_id = $1 FOR UPDATE", [$application_id]);
    if (!$res || pg_num_rows($res) === 0) throw new Exception('Application not found');

    $row = pg_fetch_assoc($res);
    $from = $row['workflow_status'] ?? 'draft';

    // Update application status
    $upd = pg_query_params($conn,
        "UPDATE application
         SET application_date = CURRENT_DATE,
             status = 'Pending',
             workflow_status = 'submitted',
             updated_at = CURRENT_TIMESTAMP
         WHERE application_id = $1",
        [$application_id]
    );
    if ($upd === false) throw new Exception('Failed to update application');

    // Insert history
    $ins = pg_query_params($conn,
        "INSERT INTO application_status_history(application_id, from_status, to_status, changed_by, role, remarks)
         VALUES($1, $2, 'submitted', $3, 'applicant', $4)",
        [$application_id, $from, $user_id, 'Applicant submitted final Form 5']
    );
    if ($ins === false) throw new Exception('Failed to insert history');

    pg_query($conn, 'COMMIT');

    echo json_encode(['success'=>true, 'application_id'=>$application_id, 'workflow_status'=>'submitted']);
    exit;
} catch (Exception $e) {
    pg_query($conn, 'ROLLBACK');
    http_response_code(500);
    echo json_encode(['error'=>'Server error', 'details'=>$e->getMessage()]);
    exit;
}
