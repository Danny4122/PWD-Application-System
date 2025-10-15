<?php
require_once '../../config/db.php'; 

// ✅ Load draft data by application_id and step
function loadDraftData($step, $application_id) {
    global $conn;
    $data = [];

    $query = "SELECT data 
              FROM application_draft 
              WHERE application_id = $1 AND step = $2";
    $result = pg_query_params($conn, $query, [$application_id, $step]);

    if ($result && pg_num_rows($result) > 0) {
        $row = pg_fetch_assoc($result);
        $decoded = json_decode($row['data'], true);
        if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
            $data = $decoded;
        }
    }

    return $data; // Always array
}

// ✅ Save draft data tied to application_id and step
function saveDraftData($step, $formData, $application_id) {
    global $conn;
    $json_data = json_encode($formData, JSON_UNESCAPED_UNICODE);

    $query = "
        INSERT INTO application_draft (application_id, step, data, updated_at)
        VALUES ($1, $2, $3::jsonb, NOW())
        ON CONFLICT (application_id, step)
        DO UPDATE SET
            data = EXCLUDED.data,
            updated_at = NOW()
    ";

    $result = pg_query_params($conn, $query, [$application_id, $step, $json_data]);

    if (!$result) {
        error_log('❌ Failed to save draft (Step ' . $step . '): ' . pg_last_error($conn));
    }

    return $result !== false;
}
?>
