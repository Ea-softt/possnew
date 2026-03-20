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

        $sql2 = "CREATE TABLE IF NOT EXISTS generated_keys (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            enc_key TEXT NOT NULL,
            type TEXT NOT NULL,
            created_date DATETIME DEFAULT CURRENT_TIMESTAMP
        )";
        $this->conn->exec($sql2);
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
        // Key format: EA-SOFT-{TYPE}-{EXPIRY_YMD}-{RANDOM}-{CHECKSUM}
        $parts = explode('-', $key);
        if (count($parts) < 6) return false;
        
        // Verify Prefix
        if ($parts[0] !== 'EA' || $parts[1] !== 'SOFT') return false;
        
        $type = $parts[2]; // TRIAL or PREM
        $expiryStr = $parts[3]; // Expiration Date Ymd
        
        // Verify Checksum
        $hashProvided = array_pop($parts);
        $baseString = implode('-', $parts);
        $calculatedHash = strtoupper(substr(md5($baseString . $this->secret), 0, 8));

        if ($hashProvided !== $calculatedHash) {
            return false; // Invalid key
        }

        // Verify Expiration Date from Key
        $expiryDateObj = DateTime::createFromFormat('Ymd', $expiryStr);
        if (!$expiryDateObj) return false;
        
        // Set expiry time to end of day
        $expiryDateObj->setTime(23, 59, 59);

        // Calculate Expiry
        $now = new DateTime();
        
        // If the key itself has already passed its validity date (e.g. key expired before use)
        if ($now > $expiryDateObj) {
            return false;
        }

        $startDate = $now->format('Y-m-d H:i:s');
        $expiryDate = $expiryDateObj->format('Y-m-d H:i:s');

        // Store License
        $sql = "INSERT INTO app_license (license_key, activation_date, expiry_date, type) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$key, $startDate, $expiryDate, $type]);
    }
    
    // Generate a valid key (for admin use)
    public function generateKey($type = 'TRIAL', $days = 90) {
        $random = strtoupper(substr(md5(uniqid(rand(), true)), 0, 8));
        
        // Calculate expiry date based on days provided
        $date = new DateTime();
        if ($type === 'PREM') {
            $date->modify('+100 years');
        } else {
            $date->modify("+$days days");
        }
        $expiryStr = $date->format('Ymd');

        $base = "EA-SOFT-$type-$expiryStr-$random";
        $hash = strtoupper(substr(md5($base . $this->secret), 0, 8));
        return "$base-$hash";
    }

    // Encrypt data for storage
    private function encrypt($data) {
        $method = "AES-256-CBC";
        $key = hash('sha256', $this->secret);
        $iv = substr(hash('sha256', 'iv_secret_salt'), 0, 16);
        return base64_encode(openssl_encrypt($data, $method, $key, 0, $iv));
    }

    // Store generated keys in the database encrypted
    public function storeKey($key, $type) {
        $encryptedKey = $this->encrypt($key);
        $stmt = $this->conn->prepare("INSERT INTO generated_keys (enc_key, type) VALUES (?, ?)");
        return $stmt->execute([$encryptedKey, $type]);
    }
}
?>