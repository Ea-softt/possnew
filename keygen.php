<?php
// This file should be kept secure or local only
include 'server/config.php';
include 'server/License.php';

$license = new License($conn);
$trialKey = $license->generateKey('TRIAL');
$premKey = $license->generateKey('PREM');
?>
<!DOCTYPE html>
<html>
<head><title>Key Generator</title></head>
<body>
    <h2>POS Activation Key Generator</h2>
    <hr>
    <h3>3-Month Trial Key:</h3>
    <code style="background: #eee; padding: 10px; font-size: 1.2em;"><?php echo $trialKey; ?></code>
    <hr>
    <h3>Premium (Lifetime) Key:</h3>
    <code style="background: #eee; padding: 10px; font-size: 1.2em;"><?php echo $premKey; ?></code>
</body>
</html>