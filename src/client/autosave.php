<?php
session_start();
require_once '../../config/db.php';
require_once '../../includes/DraftHelper.php';

header('Content-Type: application/json');

try {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        http_response_code(405);
        echo json_encode(["status" => "error", "message" => "Invalid request method"]);
        exit;
    }

    // Get application_id from session or POST fallback
    $application_id = $_SESSION['application_id'] ?? null;
    if (!$application_id && isset($_POST['application_id'])) {
        $application_id = (int)$_POST['application_id'];
    }
    if (!$application_id) {
        http_response_code(400);
        echo json_encode(["status" => "error", "message" => "No active application."]);
        exit;
    }
    $application_id = (int)$application_id;

    // Read formData + step from x-www-form-urlencoded or raw JSON
    $raw       = file_get_contents('php://input');
    $formData  = null;
    $step      = 1;

    if (isset($_POST['formData'])) {
        $formData = json_decode($_POST['formData'], true);
        $step     = isset($_POST['step']) ? (int)$_POST['step'] : 1;
    } elseif (!empty($raw)) {
        $payload = json_decode($raw, true);
        if (is_array($payload)) {
            if (isset($payload['formData'])) $formData = $payload['formData'];
            if (isset($payload['step']))     $step     = (int)$payload['step'];
            if (isset($payload['application_id']) && !$application_id) {
                $application_id = (int)$payload['application_id'];
            }
        }
    }

    if (!is_array($formData)) {
        http_response_code(400);
        echo json_encode(["status" => "error", "message" => "Invalid or missing formData"]);
        exit;
    }

    if ($step < 1) $step = 1;
    if ($step > 20) $step = 20;

    // Persist using DraftHelper (UPSERT on (application_id, step))
    $ok = saveDraftData($step, $formData, $application_id);

    if ($ok) {
        echo json_encode(["status" => "success", "message" => "Draft saved", "step" => $step]);
    } else {
        http_response_code(500);
        echo json_encode(["status" => "error", "message" => "Failed to save draft"]);
    }

} catch (Throwable $e) {
    http_response_code(500);
    echo json_encode(["status" => "error", "message" => "Server error", "detail" => $e->getMessage()]);
}
