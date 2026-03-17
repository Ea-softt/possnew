<?php
// Define the path to the APPDATA directory
$appDataDir = getenv('APPDATA') . DIRECTORY_SEPARATOR . 'easoft' . DIRECTORY_SEPARATOR;
$dbname = "pos.db";
$db_path = $appDataDir . $dbname;

// Ensure the directory exists
if (!is_dir($appDataDir)) {
    mkdir($appDataDir, 0777, true);
}

// 1. DATABASE CONNECTION (Using your specific PDO setup)
try {
    $conn = new PDO("sqlite:" . $db_path);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    if (isset($_POST['action'])) {
        die(json_encode(["status" => "error", "message" => "Connection failed: " . $e->getMessage()]));
    }
    die("Connection failed: " . $e->getMessage());
}

$action = $_REQUEST['action'] ?? '';

// --- BACKUP: Stream from APPDATA to Browser ---
if ($action === 'backup') {
    if (file_exists($db_path)) {
        // Clear all buffers to ensure a clean 120KB download
        while (ob_get_level()) {
            ob_end_clean();
        }

        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="EA_Soft_Backup_'.date('Y-m-d').'.db"');
        header('Content-Length: ' . filesize($db_path));
        header('Pragma: public');

        session_write_close();
        readfile($db_path);
        exit;
    } else {
        die("Error: No database found at " . $db_path);
    }
}

// --- RESTORE: Move Uploaded File to APPDATA ---
if ($action === 'restore') {
    if (isset($_FILES['backup_file'])) {
        $file = $_FILES['backup_file'];
        
        // Close connection before replacing file
        $conn = null; 

        if (move_uploaded_file($file['tmp_name'], $db_path)) {
            echo json_encode(["status" => "success", "message" => "Restore complete! Data saved to APPDATA."]);
        } else {
            echo json_encode(["status" => "error", "message" => "Failed to write to APPDATA. Check Windows permissions."]);
        }
    }
    exit;
}
?>