<?php
// tests/db_check.php
require_once __DIR__ . '/../config/db.php'; // loads $conn

echo '<pre>';
if (!isset($conn)) {
    echo '$conn MISSING' . PHP_EOL;
    exit;
}
echo '$conn OK (pg connection exists)' . PHP_EOL;

// Print a safe type/summary for $conn
if (is_resource($conn)) {
    echo 'conn is a resource of type: ' . get_resource_type($conn) . PHP_EOL;
} elseif (is_object($conn)) {
    echo 'conn is an object of class: ' . get_class($conn) . PHP_EOL;
} else {
    echo 'conn type: ' . gettype($conn) . PHP_EOL;
}

// Optionally try a tiny query to confirm DB responds
$res = @pg_query($conn, 'SELECT 1 as ok');
if ($res && ($row = pg_fetch_assoc($res))) {
    echo 'Simple query result: ' . ($row['ok'] ?? 'n/a') . PHP_EOL;
} else {
    echo 'Simple query failed: ' . pg_last_error($conn) . PHP_EOL;
}
echo '</pre>';
