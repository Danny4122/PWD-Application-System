<?php
session_start();

// diagnostics (safe)
error_log("ADMIN LOGIN START: METHOD=" . $_SERVER['REQUEST_METHOD'] . " HOST=" . ($_SERVER['HTTP_HOST'] ?? 'unknown'));

// NEW: use APP_BASE_URL from config/paths.php (recommended)
require_once __DIR__ . '/../../config/paths.php';

define('ADMIN_SIGNIN', rtrim(APP_BASE_URL, '/') . '/src/admin_side/signin.php');
define('ADMIN_DASH_ADMIN', rtrim(APP_BASE_URL, '/') . '/src/admin_side/dashboard.php');
define('ADMIN_DASH_DOCTOR', rtrim(APP_BASE_URL, '/') . '/src/doctor/CHO_dashboard.php');


// DB
require_once __DIR__ . '/../../config/db.php';

// Only accept POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ' . ADMIN_SIGNIN);
    exit;
}

// Get and trim input
$username = trim((string)($_POST['email'] ?? ''));
$password = trim((string)($_POST['password'] ?? ''));
$requestedRole = strtolower(trim((string)($_POST['role'] ?? 'admin'))); // expected 'admin' or 'doctor'

// log safely
error_log("ADMIN LOGIN: username='{$username}' requestedRole={$requestedRole}");

// basic checks
if ($username === '') { header('Location: ' . ADMIN_SIGNIN . '?err=empty_user'); exit; }
if ($password === '') { header('Location: ' . ADMIN_SIGNIN . '?err=empty_pwd'); exit; }
if (!$conn) { error_log('DB connection failed: ' . pg_last_error()); header('Location: ' . ADMIN_SIGNIN . '?err=db_conn'); exit; }

// Fetch user row. This SELECT expects optional columns: role, is_admin, is_doctor.
// If your table doesn't have them, see the SQL below to add them.
$sql = "SELECT username, password, role, is_admin, is_doctor FROM public.user_admin WHERE username = $1 LIMIT 1";
$res = @pg_query_params($conn, $sql, [$username]);
if (!$res) {
    // If the query failed because columns don't exist, fall back to a minimal select
    error_log("ADMIN LOGIN: initial SELECT failed, trying fallback SELECT. Error: " . pg_last_error($conn));
    $res = pg_query_params($conn, "SELECT username, password FROM public.user_admin WHERE username = $1 LIMIT 1", [$username]);
    if (!$res || pg_num_rows($res) === 0) {
        error_log("LOGIN FAIL: no account for '{$username}' (fallback)");
        header('Location: ' . ADMIN_SIGNIN . '?err=no_account'); exit;
    }
    $user = pg_fetch_assoc($res);
    // normalize values if optional columns missing
    $user['role'] = $user['role'] ?? null;
    $user['is_admin'] = $user['is_admin'] ?? null;
    $user['is_doctor'] = $user['is_doctor'] ?? null;
} else {
    if (pg_num_rows($res) === 0) {
        error_log("LOGIN FAIL: no account for '{$username}'");
        header('Location: ' . ADMIN_SIGNIN . '?err=no_account'); exit;
    }
    $user = pg_fetch_assoc($res);
}

// safe diagnostics about stored password (no actual values)
$stored = (string)($user['password'] ?? '');
$isHashLike = preg_match('/^\$(2[aby]|argon2)/', $stored) ? 'yes' : 'no';
error_log("ADMIN LOGIN: stored_present=" . ($stored !== '' ? 'yes' : 'no') . " stored_len=" . strlen($stored) . " isHashLike={$isHashLike}");

// Verify password (support hashed and plaintext fallback)
$ok = false;
if ($stored !== '' && $isHashLike === 'yes') {
    if (password_verify($password, $stored)) $ok = true;
} else {
    if ($password === $stored) $ok = true;
}

if (!$ok) {
    error_log("LOGIN FAIL: invalid password for '{$username}'");
    header('Location: ' . ADMIN_SIGNIN . '?err=invalid_pwd'); exit;
}

// Determine allowed roles for this user (server-trusted)
$allowedRoles = []; // empty -> none
// prefer explicit role column if present
if (!empty($user['role'])) {
    // role column may contain comma-separated roles e.g. "admin,doctor"
    $roles = array_map('trim', explode(',', strtolower($user['role'])));
    foreach ($roles as $r) if ($r !== '') $allowedRoles[$r] = true;
}
// fallback to boolean flags if present
if (isset($user['is_admin']) && ($user['is_admin'] === 't' || $user['is_admin'] === true || $user['is_admin'] === '1')) {
    $allowedRoles['admin'] = true;
}
if (isset($user['is_doctor']) && ($user['is_doctor'] === 't' || $user['is_doctor'] === true || $user['is_doctor'] === '1')) {
    $allowedRoles['doctor'] = true;
}

// If no role info found but the table exists, you can treat rows as admin by default.
// Here we require explicit grant. If you want the old behavior (any user in user_admin = admin),
// uncomment the following line:
// if (empty($allowedRoles)) $allowedRoles['admin'] = true;

// Check requested role is allowed
if (!isset($allowedRoles[$requestedRole])) {
    error_log("LOGIN FAIL: user '{$username}' not allowed to login as '{$requestedRole}'");
    header('Location: ' . ADMIN_SIGNIN . '?err=invalid_role'); exit;
}

// success: create session and set role from requestedRole (server-trusted)
session_regenerate_id(true);
$_SESSION['username'] = $user['username'] ?? $username;
$_SESSION['role'] = $requestedRole;
$_SESSION['user_id'] = $user['user_id'] ?? $user['admin_id'] ?? $user['id'] ?? $username;
$_SESSION['is_admin'] = ($requestedRole === 'admin');

// redirect to correct dashboard
if ($requestedRole === 'doctor') {
    header('Location: ' . ADMIN_DASH_DOCTOR);
} else {
    header('Location: ' . ADMIN_DASH_ADMIN);
}
exit;
