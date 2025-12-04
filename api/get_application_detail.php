<?php
// api/get_application_detail.php
session_start();
header('Content-Type: application/json');
require_once __DIR__ . '/../config/db.php';

$appId = (int)($_GET['application_id'] ?? 0);
if (!$appId) { http_response_code(400); echo json_encode(['error'=>'application_id required']); exit; }

// fetch application + applicant + documentrequirements
$res = pg_query_params($conn,
    "SELECT a.*, ap.first_name, ap.last_name, ap.middle_name, ap.birth_date, dr.*
     FROM application a
     LEFT JOIN applicant ap ON ap.applicant_id = a.applicant_id
     LEFT JOIN documentrequirements dr ON dr.application_id = a.application_id
     WHERE a.application_id = $1
     LIMIT 1",
    [$appId]
);
if (!$res || pg_num_rows($res) === 0) { http_response_code(404); echo json_encode(['error'=>'Not found']); exit; }
$detail = pg_fetch_assoc($res);

// fetch drafts (application_draft)
$drafts = [];
$res2 = pg_query_params($conn, "SELECT step_number, draft_data, updated_at FROM application_draft WHERE application_id = $1 ORDER BY step_number", [$appId]);
if ($res2) while ($d = pg_fetch_assoc($res2)) $drafts[] = $d;

echo json_encode(['success'=>true, 'application'=>$detail, 'drafts'=>$drafts]);
