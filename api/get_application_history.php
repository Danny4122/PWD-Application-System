<?php
// api/get_application_history.php
// Improved safe version with consistent JSON output

session_start();
header('Content-Type: application/json; charset=utf-8');
require_once __DIR__ . '/../config/db.php';

$response = [
    "success" => false,
    "history" => [],
    "error"   => null
];

// 1. Validate application_id
$appId = (int)($_GET['application_id'] ?? 0);
if ($appId <= 0) {
    http_response_code(400);
    $response["error"] = "application_id required";
    echo json_encode($response);
    exit;
}

// 2. Query history table
$sql = "SELECT hist_id, from_status, to_status, changed_by, role, remarks, created_at
        FROM application_status_history
        WHERE application_id = $1
        ORDER BY created_at ASC";

$result = @pg_query_params($conn, $sql, [$appId]);

if ($result === false) {
    http_response_code(500);
    error_log("History DB error: " . pg_last_error($conn));
    $response["error"] = "Database error while loading history";
    echo json_encode($response);
    exit;
}

// 3. Build history array
while ($row = pg_fetch_assoc($result)) {
    $response["history"][] = [
        "hist_id"     => (int)$row["hist_id"],
        "from_status" => $row["from_status"],
        "to_status"   => $row["to_status"],
        "changed_by"  => $row["changed_by"] !== null ? (int)$row["changed_by"] : null,
        "role"        => $row["role"],
        "remarks"     => $row["remarks"],
        "created_at"  => $row["created_at"]
    ];
}

$response["success"] = true;
echo json_encode($response);
exit;
