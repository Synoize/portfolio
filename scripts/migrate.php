<?php
require_once __DIR__ . '/../config/database.php';

echo "Running migrations...\n";

$dir = dirname(__DIR__) . '/migrations';
$files = array_values(array_filter(scandir($dir), function($f) { return preg_match('/^\d+_.*\.sql$/', $f); }));
sort($files);

foreach ($files as $file) {
    $path = $dir . '/' . $file;
    echo "Applying: $file\n";
    $sql = file_get_contents($path);
    if ($sql === false) {
        echo "Could not read $file\n";
        continue;
    }

    // Split statements by semicolon for simple execution
    $stmts = array_filter(array_map('trim', preg_split('/;\s*\n/', $sql)));
    foreach ($stmts as $stmt) {
        if ($stmt === '') continue;
        $res = $db->query($stmt);
        if ($res === false) {
            echo "Failed: " . $db->getConnection()->error . "\n";
        }
    }
}

echo "Migrations complete.\n";

// Close connection
$db->close();

echo "Done.\n";

?>
