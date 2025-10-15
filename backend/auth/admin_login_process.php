<?php
session_start();

error_log("LOGIN hit: method=" . $_SERVER['REQUEST_METHOD'] . " user=" . ($_POST['email'] ?? ''));


define('APP_BASE', '/PWD-Application-System');
define('ADMIN_SIGNIN', APP_BASE . '/src/admin_side/signin.php');
define('ADMIN_DASH',   APP_BASE . '/src/admin_side/dashboard.php');

require_once __DIR__ . '/../../config/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ' . ADMIN_SIGNIN);
    exit;
}

// Treat "email" as username for now
$username = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';
$role     = strtolower(trim($_POST['role'] ?? 'admin'));

if ($username === '') { header('Location: ' . ADMIN_SIGNIN . '?err=empty_user'); exit; }
if ($password === '') { header('Location: ' . ADMIN_SIGNIN . '?err=empty_pwd');  exit; }
if (!$conn) {
    error_log('DB connection failed: ' . pg_last_error());
    header('Location: ' . ADMIN_SIGNIN . '?err=db_conn'); exit;
}

$sql = "SELECT username, password FROM public.user_admin WHERE username = $1 LIMIT 1";
$res = pg_query_params($conn, $sql, [$username]);
if (!$res || pg_num_rows($res) === 0) { header('Location: ' . ADMIN_SIGNIN . '?err=no_account'); exit; }

$user = pg_fetch_assoc($res);

// TEMP: plain text compare (migrate to password_hash soon)
if ($password !== $user['password']) { header('Location: ' . ADMIN_SIGNIN . '?err=invalid_pwd'); exit; }

session_regenerate_id(true);
$_SESSION['username'] = $user['username'];
$_SESSION['role']     = 'admin';

if ($role === 'doctor') {
    header('Location: ' . ADMIN_SIGNIN . '?err=doctor_not_supported');
    exit;
}

header('Location: ' . ADMIN_DASH);
exit;
