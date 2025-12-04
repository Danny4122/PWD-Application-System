<?php
// tests/uploads_check.php
$uploadsRoot = realpath(__DIR__ . '/../uploads');
echo '<pre>';
if ($uploadsRoot === false) {
    echo "Uploads folder not found (realpath returned false). Check path.\n";
    exit;
}
echo "Uploads root: $uploadsRoot\n\n";
$files = scandir($uploadsRoot);
foreach ($files as $f) {
    if ($f === '.' || $f === '..') continue;
    $full = $uploadsRoot . DIRECTORY_SEPARATOR . $f;
    echo ($f) . " - " . (is_file($full) ? 'file' : (is_dir($full) ? 'dir' : 'other')) . " - size: " . (is_file($full) ? filesize($full) : '-') . "\n";
}
echo '</pre>';
