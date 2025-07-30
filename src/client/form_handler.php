<?php
session_start();
require_once '../../config/db.php';
require_once '../../includes/saveDraftData.php';

$step = $_POST['step'] ?? null;

if (!$step) {
    die("Step not specified.");
}

saveDraftData($step, $_POST);

// Decide where to go next
switch ($step) {
    case 1:
        header("Location: form2.php");
        break;
    case 2:
        header("Location: form3.php");
        break;
    case 3:
        header("Location: form4.php");
        break;
    case 4:
        header("Location: review.php");
        break;
    default:
        die("Invalid step.");
}

exit;
?>