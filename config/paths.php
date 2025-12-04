<?php
// config/paths.php
// Simple, XAMPP-friendly base URL configuration.

$proto = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
$host  = $_SERVER['HTTP_HOST'] ?? 'localhost';  // e.g. localhost or localhost:8080

// Folder name of your app inside htdocs.
// Change this if you ever rename the project folder.
$basePath = '/PWD-Application-System';

define('APP_BASE_URL', $proto . '://' . rtrim($host, '/') . $basePath);

// Admin base (adjust path if your admin folder is different)
define('ADMIN_BASE', rtrim(APP_BASE_URL, '/') . '/src/admin_side');
