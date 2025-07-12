<?php
ob_start(); // Start output buffering
require_once('../../config/db.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $repeat_password = $_POST['repeat_password'] ?? '';

    // Check if passwords match
    if ($password !== $repeat_password) {
        echo "Passwords do not match.";
        exit;
    }

    // Check if email already exists
    $check_query = "SELECT * FROM user_account WHERE email = $1";
    $check_result = pg_query_params($conn, $check_query, [$email]);

    if (pg_num_rows($check_result) > 0) {
        echo "Email already exists. Please log in.";
        exit;
    }

    // Hash the password
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    // Insert user (without applicant_id yet)
    $insert_query = "INSERT INTO user_account (email, password_hash) VALUES ($1, $2)";
    $insert_result = pg_query_params($conn, $insert_query, [$email, $password_hash]);

if ($insert_result) {
    echo '
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="refresh" content="2;url=../../public/login_form.php">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Registration Successful</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <style>
            body {
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                background-color: #f4f9ff;
                font-family: "Segoe UI", sans-serif;
            }
            .card {
                padding: 30px 50px;
                border-radius: 12px;
                background: white;
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
                text-align: center;
                display: flex;
                flex-direction: column;
                align-items: center;
            }
            .spinner-border {
                margin-top: 20px;
                width: 3rem;
                height: 3rem;
                color: #3577e6;
            }
            h2 {
                margin-bottom: 10px;
            }
        </style>
    </head>
    <body>
        <div class="card">
            <h2 class="text-success">Account Created!</h2>
            <p>You will be redirected to the login page shortly.</p>
            <div class="spinner-border" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </body>
    </html>';
    exit;
    } else {
        echo "Signup failed: " . pg_last_error($conn);
    }
}
?>
