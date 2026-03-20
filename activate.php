<?php 
include 'server/config.php';
include 'server/License.php';

$msg = "";
if(isset($_POST['activate'])) {
    $key = trim($_POST['license_key']);
    $license = new License($conn);
    if($license->activate($key)) {
        $msg = "System Activated Successfully! Please login.";
        echo "<script>alert('Activation Successful!'); window.location.href='index.php';</script>";
    } else {
        $msg = "Invalid Activation Key.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>System Activation</title>
    <link href="bootstrap4/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; display: flex; align-items: center; justify-content: center; height: 100vh; }
        .card { width: 400px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); }
        .card-header { background: #dc3545; color: white; text-align: center; font-weight: bold; }
    </style>
</head>
<body>
    <div class="card">
        <div class="card-header">
            System Locked
        </div>
        <div class="card-body">
            <p class="text-center">Your license has expired or is invalid.<br>Please enter a valid activation key.</p>
            <?php if($msg): ?><div class="alert alert-danger"><?php echo $msg; ?></div><?php endif; ?>
            <form method="post">
                <div class="form-group">
                    <label>Activation Key</label>
                    <input type="text" name="license_key" class="form-control" placeholder="EA-SOFT-XXXX-..." required>
                </div>
                <button type="submit" name="activate" class="btn btn-primary btn-block">Activate</button>
            </form>
        </div>
        <div class="card-footer text-center text-muted">
            <small>Contact Support for Keys</small>
        </div>
    </div>
</body>
</html>