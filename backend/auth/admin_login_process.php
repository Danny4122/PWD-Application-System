<?php
session_start();
require_once '../../config/db.php';

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $role = trim($_POST['role']); // "admin" or "doctor"

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format.");
    }

    // Map the form role to database roles
    if ($role === 'admin') {
        $allowedRoles = ['super_admin', 'pdao_staff'];
    } elseif ($role === 'doctor') {
        $allowedRoles = ['doctor'];
    } else {
        die("Invalid role selected.");
    }

    // Query with pg_query_params for security
    $query = "SELECT * FROM admin_doctor_account 
              WHERE email = $1 AND role = ANY($2)";
    $result = pg_query_params($conn, $query, [$email, $allowedRoles]);

    if ($result && pg_num_rows($result) === 1) {
        $user = pg_fetch_assoc($result);

        if (password_verify($password, $user['password_hash'])) {
            // Save session
            $_SESSION['account_id'] = $user['account_id'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['email'] = $user['email'];

            // Redirect based on role
            if ($user['role'] === 'doctor') {
                header("Location: ../DoctorDashboard/dashboard.php");
            } else {
                header("Location: ../AdminDashboard/dashboard.php");
            }
            exit;
        } else {
            die("Invalid password.");
        }
    } else {
        die("No account found with that email and role.");
    }
} else {
    header("Location: signin.php");
    exit;
}
?>
