<?php
class License {
    private $conn;
    // Secret key for checksum generation - change this to something unique
    private $secret = "EA-SOFT-POS-SECRET-KEY-2024-SECURE";

    public function __construct($db) {
        $this->conn = $db;
        $this->initTable();
    }

    // Initialize the license table if it doesn't exist
    private function initTable() {
        $sql = "CREATE TABLE IF NOT EXISTS app_license (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            license_key TEXT NOT NULL,
            activation_date DATETIME NOT NULL,
            expiry_date DATETIME NOT NULL,
            type TEXT NOT NULL
        )";
        $this->conn->exec($sql);
    }

    // Check if the system has a valid active license
    public function checkLicense() {
        // Get the latest license
        $stmt = $this->conn->query("SELECT * FROM app_license ORDER BY id DESC LIMIT 1");
        $license = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$license) {
            return false; // No license found
        }

        $expiry = new DateTime($license['expiry_date']);
        $now = new DateTime();

        if ($now > $expiry) {
            return false; // License expired
        }

        return true; // License valid
    }

    // Activate the system with a key
    public function activate($key) {
        // Key format: EA-SOFT-{TYPE}-{RANDOM}-{CHECKSUM}
        $parts = explode('-', $key);
        if (count($parts) < 5) return false;
        
        // Verify Prefix
        if ($parts[0] !== 'EA' || $parts[1] !== 'SOFT') return false;
        
        $type = $parts[2]; // TRIAL or PREM
        
        // Verify Checksum
        $hashProvided = array_pop($parts);
        $baseString = implode('-', $parts);
        $calculatedHash = strtoupper(substr(md5($baseString . $this->secret), 0, 8));

        if ($hashProvided !== $calculatedHash) {
            return false; // Invalid key
        }

        // Calculate Expiry
        $now = new DateTime();
        $startDate = $now->format('Y-m-d H:i:s');
        
        if ($type === 'PREM') {
            $now->modify('+100 years'); // Effectively lifetime
        } else {
            $now->modify('+3 months'); // Trial period
        }
        $expiryDate = $now->format('Y-m-d H:i:s');

        // Store License
        $sql = "INSERT INTO app_license (license_key, activation_date, expiry_date, type) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$key, $startDate, $expiryDate, $type]);
    }
    
    // Generate a valid key (for admin use)
    public function generateKey($type = 'TRIAL') {
        $random = strtoupper(substr(md5(uniqid(rand(), true)), 0, 8));
        $base = "EA-SOFT-$type-$random";
        $hash = strtoupper(substr(md5($base . $this->secret), 0, 8));
        return "$base-$hash";
    }
}
?>