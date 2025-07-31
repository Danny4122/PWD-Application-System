<?php
session_start();
require_once '../../config/db.php';
require_once '../../includes/DraftHelper.php';

header('Content-Type: application/json');

// ✅ Ensure we have an active application
if (!isset($_SESSION['application_id'])) {
    http_response_code(400);
    echo json_encode(["status" => "error", "message" => "No active application."]);
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['formData'])) {
    $application_id = $_SESSION['application_id'];
    $step = isset($_POST['step']) ? (int)$_POST['step'] : 1;

    // Decode the posted JSON form data
    $formData = json_decode($_POST['formData'], true);

    if (!is_array($formData)) {
        http_response_code(400);
        echo json_encode(["status" => "error", "message" => "Invalid JSON data"]);
        exit;
    }

    // Save using DraftHelper
    $success = saveDraftData($step, $formData, $application_id);

    if ($success) {
        echo json_encode(["status" => "success", "message" => "Draft saved"]);
    } else {
        http_response_code(500);
        echo json_encode(["status" => "error", "message" => "Failed to save draft", "error" => pg_last_error($conn)]);
    }
} else {
    http_response_code(405);
    echo json_encode(["status" => "error", "message" => "Invalid request"]);
}
