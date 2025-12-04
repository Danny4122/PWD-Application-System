<?php
// api/get_application_history.php
session_start();
header('Content-Type: application/json');
require_once __DIR__ . '/../config/db.php';

$appId = (int)($_GET['application_id'] ?? 0);
if (!$appId) { http_response_code(400); echo json_encode(['error'=>'application_id required']); exit; }

$res = pg_query_params($conn,
    "SELECT hist_id, from_status, to_status, changed_by, role, remarks, created_at
     FROM application_status_history
     WHERE application_id = $1
     ORDER BY created_at ASC",
    [$appId]
);
if ($res === false) { http_response_code(500); echo json_encode(['error'=>'DB error']); exit; }

$rows = [];
while ($r = pg_fetch_assoc($res)) $rows[] = $r;
echo json_encode(['success'=>true, 'history'=>$rows]);
