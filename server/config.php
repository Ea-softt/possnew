<?php
// 1. Define the persistent AppData path
$appDataDir = getenv('APPDATA') . DIRECTORY_SEPARATOR . 'easoft' . DIRECTORY_SEPARATOR;
$dbname = "pos.db";
$db_path = $appDataDir . $dbname;

// 2. Automatically create the 'easoft' folder if it doesn't exist
if (!is_dir($appDataDir)) {
    mkdir($appDataDir, 0777, true);
}

// 3. Establish the PDO connection
try {
    $conn = new PDO("sqlite:" . $db_path);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Optional: Enable Foreign Keys for SQLite
    $conn->exec("PRAGMA foreign_keys = ON;");
    
} catch (PDOException $e) {
    // In a production POS, you might want to log this instead of echoing
    die("Database Connection Error: " . $e->getMessage());
}
?>