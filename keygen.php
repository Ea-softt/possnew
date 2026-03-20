<?php
// This file should be kept secure or local only
include 'server/config.php';
include 'server/License.php';

$license = new License($conn);
$generatedKeys = [];
$msg = "";

if(isset($_POST['generate'])) {
    $count = (int)$_POST['count'];
    $type = $_POST['type'];
    $startDate = isset($_POST['start_date']) ? $_POST['start_date'] : date('Y-m-d');
    $dateObj = new DateTime($startDate);
    
    if($count > 0) {
        for($i = 0; $i < $count; $i++) {
            $currentExpiry = $dateObj->format('Y-m-d');
            $key = $license->generateKey($type, $currentExpiry);
            if($license->storeKey($key, $type, $currentExpiry)) {
                $generatedKeys[] = $key . " (Expires: $currentExpiry)";
            }
            $dateObj->modify('+3 months');
        }
        $msg = count($generatedKeys) . " keys generated and stored encrypted in database.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Key Generator</title>
    <link href="bootstrap4/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>POS Activation Key Generator</h2>
        <hr>
        
        <?php if($msg): ?>
            <div class="alert alert-success"><?php echo $msg; ?></div>
        <?php endif; ?>

        <form method="post" class="mb-4">
            <div class="form-row align-items-end">
                <div class="col-auto">
                    <label>Number of Keys</label>
                    <input type="number" name="count" class="form-control" value="1" min="1" max="300" required>
                </div>
                <div class="col-auto">
                    <label>License Type</label>
                    <select name="type" class="form-control">
                        <option value="TRIAL">3-Month Trial</option>
                        <option value="PREM">Premium (Lifetime)</option>
                    </select>
                </div>
                <div class="col-auto">
                    <label>Start Expiry Date</label>
                    <input type="date" name="start_date" class="form-control" value="<?php echo date('Y-m-d'); ?>" required>
                </div>
                <div class="col-auto">
                    <button type="submit" name="generate" class="btn btn-primary">Generate & Store</button>
                </div>
            </div>
        </form>

        <?php if(!empty($generatedKeys)): ?>
            <h4>Generated Keys (Copy these):</h4>
            <ul class="list-group">
                <?php foreach($generatedKeys as $k): ?>
                    <li class="list-group-item" style="font-family: monospace; font-size: 1.2em;"><?php echo $k; ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>
</body>
</html>