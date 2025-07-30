<?php
session_start();
require_once '../../config/db.php'; // adjust path as needed

file_put_contents('autosave_log.txt', date('c') . ' ' . json_encode($_POST) . PHP_EOL, FILE_APPEND);

echo realpath('autosave_log.txt');

    
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['formData'])) {
            $formData = json_decode($_POST['formData'] ?? '', true);
        if (!is_array($formData)) {
            http_response_code(400);
            exit('Invalid JSON data');
        }


        $sessionId = session_id();
        $step = isset($_POST['step']) ? (int)$_POST['step'] : 1;
        $data = json_encode($formData);



    $query = "INSERT INTO application_draft (session_id, step, data, updated_at)
              VALUES ($1, $2, $3, CURRENT_TIMESTAMP)
              ON CONFLICT (session_id, step) DO UPDATE
              SET data = EXCLUDED.data, updated_at = CURRENT_TIMESTAMP";

    pg_query_params($conn, $query, [$sessionId, $step, $data]);
}

?>
