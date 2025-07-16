<?php
session_start();
require_once '../../config/db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM user_account WHERE email = $1";
    $result = pg_query_params($conn, $query, [$email]);

    if (pg_num_rows($result) === 1) {
        $user = pg_fetch_assoc($result);

        if (password_verify($password, $user['password_hash'])) {
            // Store session variables
              $_SESSION['user_email'] = $user['email'];
              $_SESSION['first_name'] = $user['first_name']; // ✅ important
              $_SESSION['last_name'] = $user['last_name'];
             $_SESSION['user_id'] = $user['user_id']; // optional if needed



            // Redirect to dashboard or next step
            header("Location: ../../public/index.php");
            exit;
        } else {
            echo "Incorrect password.";
        }
    } else {
        echo "Email not found.";
    }
}
?>
