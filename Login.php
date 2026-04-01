<?php 
include('server/database.php');
// Ensure validation.php doesn't redirect before HTML is rendered if there's an error
include('validation.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EA-Soft | Login</title>
    <link rel="shortcut icon" type="image/icon" href="img/Ea-Soft.ico">
    
    <script src="bootstrap4/jquery/jquery.min.js"></script>
    <script src="bootstrap4/js/bootstrap.bundle.min.js"></script>
    <script src="bootstrap4/jquery/sweetalert.min.js"></script>
    <link href="bootstrap4/css/bootstrap.min.css" rel="stylesheet"> 
    <link href="bootstrap4/css/all.min.css" rel="stylesheet"> 

    <style>
        body, html { height: 100%; margin: 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        
        .login-container {
            display: flex;
            height: 100vh;
            width: 100%;
        }

        /* Left Side: App Features */
        .features-side {
            flex: 1;
            background: linear-gradient(rgba(40, 167, 69, 0.85), rgba(0, 80, 0, 0.9)), url('img/Login-icon.png');
            background-size: cover;
            background-position: center;
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 60px;
        }

        .features-side h1 { font-size: 3.5rem; font-weight: 800; margin-bottom: 20px; }
        .features-side p { font-size: 1.2rem; opacity: 0.9; margin-bottom: 40px; }

        .feature-item {
            display: flex;
            align-items: center;
            margin-bottom: 25px;
            background: rgba(255, 255, 255, 0.1);
            padding: 15px;
            border-radius: 10px;
            transition: 0.3s;
        }
        .feature-item:hover { background: rgba(255, 255, 255, 0.2); transform: translateX(10px); }
        .feature-item i { font-size: 2rem; margin-right: 20px; color: #ffc107; }
        .feature-item h5 { margin: 0; font-weight: bold; }

        /* Right Side: Login Form */
        .form-side {
            width: 450px;
            background: #f8f9fa;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-box {
            width: 100%;
            max-width: 350px;
            padding: 20px;
        }

        .form-control {
            height: 50px;
            border-radius: 8px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
        }

        .btn-login {
            height: 50px;
            font-size: 1.1rem;
            font-weight: bold;
            background-color: #28a745;
            border: none;
            border-radius: 8px;
            transition: 0.3s;
        }
        .btn-login:hover { background-color: #218838; transform: translateY(-2px); box-shadow: 0 5px 15px rgba(0,0,0,0.1); }

        @media (max-width: 992px) {
            .features-side { display: none; }
            .form-side { width: 100%; }
        }
    </style>
</head>
<body>

<div class="login-container">
    <div class="features-side">
        <h1>EA-Soft <span style="color: #ffc107;">POS</span></h1>
        <p>The ultimate management solution for your business.</p>

        <div class="feature-item">
            <i class="fas fa-warehouse"></i>
            <div>
                <h5>Advanced Warehouse Management</h5>
                <small>Track stock movements and expiring products in real-time.</small>
            </div>
        </div>

        <div class="feature-item">
            <i class="fas fa-chart-line"></i>
            <div>
                <h5>Real-time Sales Statistics</h5>
                <small>Analyze daily and monthly performance with detailed graphs.</small>
            </div>
        </div>

        <div class="feature-item">
            <i class="fas fa-database"></i>
            <div>
                <h5>Secure AppData Backup</h5>
                <small>Automatic local backups ensure your data is never lost.</small>
            </div>
        </div>

        <div class="mt-5">
            <small>&copy; 2021-2030 EA-Soft Systems | Ghana</small>
        </div>
    </div>

    <div class="form-side">
        <div class="login-box text-center">
            <img class="mb-4" src="img/login-icon.png" alt="Logo" width="100">
            
            <div id="alert-container">
                <?php if (isset($_SESSION['meg'])): ?>
                    <div id="meg" class="alert alert-danger">Check Password, ID and Username.</div>
                    <?php unset($_SESSION['meg']); ?>
                <?php endif; ?>
            </div>

            <h2 class="mb-4 font-weight-bold" style="color: #333;">Sign In</h2>
            
            <form action="validation.php" method="post">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text bg-white border-right-0"><i class="fas fa-user text-muted"></i></span>
                    </div>
                    <input type="text" id="username" name="username" class="form-control border-left-0" placeholder="Username" required>
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text bg-white border-right-0"><i class="fas fa-id-badge text-muted"></i></span>
                    </div>
                    <input type="text" id="uid" name="uid" class="form-control border-left-0" placeholder="Employee ID" required>
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text bg-white border-right-0"><i class="fas fa-lock text-muted"></i></span>
                    </div>
                    <input type="password" id="password" name="password" class="form-control border-left-0" placeholder="Password" required>
                </div>

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="rememberMe">
                        <label class="custom-control-label text-muted" for="rememberMe">Remember me</label>
                    </div>
                </div>

                <button name="submit" class="btn btn-primary btn-block btn-login" type="submit">
                    Login to System
                </button>
            </form>
        </div>
    </div>
</div>

</body>
</html>