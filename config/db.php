<?php

$host = "localhost";
$dbname = "pdao_db";  // Your actual database name
$user = "postgres";            // PostgreSQL username
$password = "thesisit";  // Your PostgreSQL password

$conn = pg_connect("host=$host dbname=$dbname user=$user password=$password");

if (!$conn) {
    die("❌ Database connection failed: " . pg_last_error());
}
?>
    