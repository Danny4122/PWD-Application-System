<?php
// src/config/auth.php
// Centralized admin authentication for all admin pages.

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Only signin.php should be public
$publicFiles = [
    realpath(__DIR__ . '/../admin_side/signin.php'),
];

// Current script absolute path
$current = realpath($_SERVER['SCRIPT_FILENAME']);

// If the current page is signin.php, allow it
if ($current !== false && in_array($current, $publicFiles, true)) {
    return;
}

// --- Admin Auth Rules ---
// We accept admin as logged in IF these session variables exist:
$loggedIn =
    !empty($_SESSION['user_id']) ||        // backend-style login
    !empty($_SESSION['username']);         // interface-style login

$isAdmin =
    !empty($_SESSION['is_admin']) ||       // boolean flag
    (isset($_SESSION['role']) && $_SESSION['role'] === 'admin');

// If any fails → redirect to admin signin
if (!$loggedIn || !$isAdmin) {
    $base = defined('APP_BASE_URL') ? rtrim(APP_BASE_URL, '/') : '';
    header('Location: ' . $base . '/src/admin_side/signin.php');
    exit;
}
