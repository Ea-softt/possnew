<?php
include('headside.php');
include('insert_sales.php');

$fees = $conn->query("SELECT * FROM newemployee WHERE EmpID = '{$_SESSION['uid']}'");
foreach ($fees->fetch_array() as $k => $v) {
    $$k = $v;
    $meta[$k] = $v;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EA-Soft System</title>
    <link rel="shortcut icon" type="image/icon" href="img/Ea-Soft.ico">

    <!-- Bootstrap 5 CSS -->
    <link href="bootstrap5/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="bootstrap5/font_awesome_all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- Custom CSS -->
    <style>
        :root {
            --bg-color: #f8f9fa;
            --sidebar-bg: #212529;
            --sidebar-text: rgba(255, 255, 255, 0.8);
            --sidebar-hover: rgba(255, 255, 255, 0.1);
            --card-bg: #ffffff;
            --card-header-bg: #28a745;
            --text-color: #212529;
            --navbar-bg: #212529;
            --navbar-text: #ffffff;
            --border-color: #dee2e6;
        }

        [data-theme="dark"] {
            --bg-color: #121212;
            --sidebar-bg: #1e1e1e;
            --sidebar-text: rgba(255, 255, 255, 0.8);
            --sidebar-hover: rgba(255, 255, 255, 0.15);
            --card-bg: #2d2d2d;
            --card-header-bg: #1e88e5;
            --text-color: #e0e0e0;
            --navbar-bg: #1e1e1e;
            --navbar-text: #e0e0e0;
            --border-color: #444;
        }

        body {
            background-color: var(--bg-color);
            color: var(--text-color);
            transition: background-color 0.3s, color 0.3s;
            overflow-x: hidden;
        }

        /* Top Navbar */
        .top-navbar {
            height: 60px;
            background-color: var(--navbar-bg);
            color: var(--navbar-text);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 20px;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1030;
            border-bottom: 1px solid var(--border-color);
        }

        .top-navbar .logo {
            font-size: 20px;
            font-weight: bold;
            color: #28a745;
        }

        .top-navbar .user-profile {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .top-navbar .user-profile img {
            width: 35px;
            height: 35px;
            border-radius: 50%;
        }

        /* Sidebar */
        .sidebar {
            height: calc(100vh - 60px);
            width: 250px;
            position: fixed;
            top: 60px;
            left: 0;
            background-color: var(--sidebar-bg);
            color: var(--sidebar-text);
            transition: all 0.3s;
            overflow-y: auto;
            border-right: 1px solid var(--border-color);
        }

        .sidebar.collapsed {
            width: 70px;
        }

        .sidebar .nav-link {
            color: var(--sidebar-text);
            padding: 10px;
            margin: 5px 0;
            display: flex;
            align-items: center;
        }

        .sidebar .nav-link i {
            margin-right: 10px;
            min-width: 20px;
        }

        .sidebar .nav-link .sidebar-text {
            transition: opacity 0.3s;
        }

        .sidebar.collapsed .nav-link .sidebar-text {
            display: none;
        }

        .sidebar .nav-link:hover {
            background-color: var(--sidebar-hover);
        }

        /* Main Content */
        .main-content {
            margin-top: 60px;
            margin-left: 250px;
            padding: 20px;
            transition: all 0.3s;
            background-color: var(--bg-color);
            color: var(--text-color);
        }

        .main-content.expanded {
            margin-left: 70px;
        }

        .card {
            background-color: var(--card-bg);
            border-color: var(--border-color);
            color: var(--text-color);
        }

        .card-header {
            background-color: var(--card-header-bg);
            color: white;
        }

        /* Toggle Sidebar Button */
        .toggle-sidebar {
            cursor: pointer;
            background: transparent;
            border: none;
            color: var(--sidebar-text);
            width: 100%;
            text-align: left;
            padding: 10px;
            margin-bottom: 10px;
        }

        /* Theme Toggle Button */
        .theme-toggle {
            cursor: pointer;
            background: var(--card-header-bg);
            border: none;
            padding: 5px 10px;
            border-radius: 20px;
            color: white;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .theme-toggle i {
            pointer-events: none;
        }

        /* Dropdown Menu */
        .dropdown-menu {
            background-color: var(--sidebar-bg);
        }

        .dropdown-menu .dropdown-item {
            color: var(--sidebar-text);
        }

        .dropdown-menu .dropdown-item:hover {
            color: white;
            background-color: var(--sidebar-hover);
        }
    </style>
</head>
<body>
    <!-- Top Navbar -->
    <div class="top-navbar">
        <div class="logo">EA-Soft</div>
        <div style="display: flex; align-items: center; gap: 15px;">
            <!-- Theme Toggle Button -->
            <button class="theme-toggle" id="themeToggle">
                <i class="fas fa-moon"></i>
                <i class="fas fa-sun" style="display: none;"></i>
            </button>
            <!-- User Profile -->
            <div class="user-profile">
                <span><?php echo $FullName; ?></span>
                <img src="<?php echo isset($meta['picture']) ? '../img/' . $meta['picture'] : '' ?>" alt="Profile">
                <div class="dropdown">
                    <button class="btn btn-sm btn-outline-light dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown"></button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                        <li><a class="dropdown-item" href="newuserpage.php">Users</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="notepage.php">Note</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="backupandrestorepage.php">Backup and Restore</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="logoutpage.php">Sign out</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Sidebar -->
    <div class="sidebar p-3" id="sidebar">
        <button class="toggle-sidebar" onclick="toggleSidebar()">
            <i class="fas fa-bars"></i>
            <span class="sidebar-text">Menu</span>
        </button>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link active" href="mainpage.php">
                    <i class="fas fa-home"></i>
                    <span class="sidebar-text">Home</span>
                </a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdownSidebar" role="button" data-bs-toggle="dropdown">
                    <i class="fas fa-user-friends"></i>
                    <span class="sidebar-text">User</span>
                </a>
                <ul class="dropdown-menu bg-dark">
                    <li><a class="dropdown-item text-success" href="Employeepage.php">Employees</a></li>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="customerlistpage.php">
                    <i class="fas fa-users"></i>
                    <span class="sidebar-text">Customer</span>
                </a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="supplierDropdownSidebar" role="button" data-bs-toggle="dropdown">
                    <i class="fas fa-truck"></i>
                    <span class="sidebar-text">Supplier</span>
                </a>
                <ul class="dropdown-menu bg-dark">
                    <li><a class="dropdown-item text-success" href="supplierslistpage.php">Suppliers List</a></li>
                    <li><a class="dropdown-item text-success" href="SupplierDeliverlistpage.php">Supplier Deliver</a></li>
                    <li><a class="dropdown-item text-success" href="overalltotalpaymentpage.php">Total Payment</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="warehouseDropdownSidebar" role="button" data-bs-toggle="dropdown">
                    <i class="fas fa-building"></i>
                    <span class="sidebar-text">Warehouse</span>
                </a>
                <ul class="dropdown-menu bg-dark">
                    <li><a class="dropdown-item text-success" href="warehousepage.php">Warehouse Entry</a></li>
                    <li><a class="dropdown-item text-success" href="newwarehousepage.php">Warehouse Update</a></li>
                    <li><a class="dropdown-item text-success" href="warehouseupdateloadpage.php">Product Received</a></li>
                    <li><a class="dropdown-item text-success" href="warehouseexpiringdatepage.php">Expiring Date</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="stockDropdownSidebar" role="button" data-bs-toggle="dropdown">
                    <i class="fas fa-shopping-cart"></i>
                    <span class="sidebar-text">Stock</span>
                </a>
                <ul class="dropdown-menu bg-dark">
                    <li><a class="dropdown-item text-success" href="productpage.php">Market Stock</a></li>
                    <li><a class="dropdown-item text-success" href="newstockpage.php">Loaded Stock</a></li>
                    <li><a class="dropdown-item text-success" href="prodstatistpage.php">Product Stat</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="saleDropdownSidebar" role="button" data-bs-toggle="dropdown">
                    <i class="fas fa-shopping-bag"></i>
                    <span class="sidebar-text">Sale</span>
                </a>
                <ul class="dropdown-menu bg-dark">
                    <li><a class="dropdown-item text-success" href="salerecodepage.php">Sale C</a></li>
                    <li><a class="dropdown-item text-success" href="salestatisticspage.php">Sale Statistics</a></li>
                    <li><a class="dropdown-item text-success" href="saleusertwopage.php">Daily Sale</a></li>
                    <li><a class="dropdown-item text-success" href="saleusermonthpage.php">Monthly Sale</a></li>
                    <li><a class="dropdown-item text-success" href="e_cash_infpage.php">Daily Cash Type</a></li>
                    <li><a class="dropdown-item text-success" href="cashtypemonthpage.php">Monthly Cash Type Sale</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="cashDropdownSidebar" role="button" data-bs-toggle="dropdown">
                    <i class="fas fa-money-bill-wave"></i>
                    <span class="sidebar-text">Cash</span>
                </a>
                <ul class="dropdown-menu bg-dark">
                    <li><a class="dropdown-item text-success" href="moneyinpage.php">Money In</a></li>
                    <li><a class="dropdown-item text-success" href="moneyoutpage.php">Money Out</a></li>
                    <li><a class="dropdown-item text-success" href="expenditure_statpage.php">Statistics</a></li>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="generatorbarpage.php">
                    <i class="fas fa-barcode"></i>
                    <span class="sidebar-text">Bar</span>
                </a>
            </li>
        </ul>
    </div>

    <!-- Main Content -->
     <div class="main-content" id="mainContent">

        <div class="container-fluid">
    <div class="col-lg-12">
        <div class="row mb-4 mt-4">
            <div class="col-md-12">
                
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                   
                <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                    <b>Make Payment</b>
                    <a class="btn btn-primary btn-sm" href="javascript:void(0)" id="new_payment">
                        <i class="fa fa-plus"></i> New Entry
                    </a>
                </div>

                    <div class="card-body">
                        <table id="mytable" class="table table-condensed table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="">Date</th>
                                    <th class="">Batch No.</th>                                 
                                    <th class="">Supplier Name</th> 
                                    <!-- <th class="">Type of Payment</th> -->
                                    <th class="">Currentpayment</th>
                                    <th class="">Current Billing</th>
                                    <th class="">Payable Amount</th>
                                    <th class="">Paid Amount</th>
                                    
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php 
                                $i = 1;
                                $fees = $conn->query("SELECT c.*,s.* FROM cashtypee c inner join supplier s on  c.supppliername = s.supplier_id order by created_date  desc ");

                                while($row=$fees->fetch_assoc()):
                                /*  $paid = $conn->query("SELECT sum(amountt) as paid FROM paypay_supplier where paymen_supplierID=".$row['id']);
                                    $paid = $paid->num_rows > 0 ? $paid->fetch_array()['paid']:'';
                                    $balance = $row['amount'] - $paid;*/
                                    
                                ?>

                                    <tr>
                                    <td class="text-center"><?php echo $i++ ?></td>
                                    <td class="text-center">
                                        <p> <b><?php echo date("M d,Y ",strtotime($row['created_date'])) ?></b></p>
                                    </td>
                                    <td class="text-center">
                                        <p> <b><?php echo $row['batchno'] ?></b></p>
                                    </td>
                                    <td class="text-center">
                                        <p> <b><?php echo $row['companyname'] ?></b></p>
                                    </td>
                                    <td class="text-center">
                                        <p> <b><?php echo $row['currentpayment'] ?></b></p>
                                    </td>
                                    <td class="text-center">
                                        <p> <b><?php echo $row['suppliercurrentbilling'] ?></b></p>
                                    </td>
                                    <td class="text-center">
                                        <p> <b><?php echo $row['amountpayable'] ?></b></p>
                                    </td>
                                    <td class="text-center">
                                        <p> <b><?php echo $row['amountpaid'] ?></b></p>
                                    </td>
                                    
                                    <td class="text-center">
                                        <!-- <button class="btn btn-sm btn-outline-primary view_payment" type="button" data-id="<?php echo $row['id'] ?>" data-ef_id="<?php echo $row['id'] ?>">View</button> -->
                                        <button class="btn btn-sm btn-outline-primary edit_payment" type="button" data-id="<?php echo $row['id'] ?>" >Edit</button>
                                        <button class="btn btn-sm btn-outline-danger delete_payment" type="button" data-id="<?php echo $row['id'] ?>">Delete</button>
                                    </td>
                                </tr>
                                <?php endwhile; ?>
                                </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



     </div>
     <style>
    
    td{
        vertical-align: middle !important;
    }
    td p{
        margin: unset
    }
    img{
        max-width:100px;
        max-height: :150px;
    }
</style>
    <!-- Custom JS -->
   <script>
        $(document).ready(function(){
        $('table').dataTable()
    })
    $('#mytable').ddTableFilter();
    
    $('#new_payment').click(function(){
        uni_modal("New Payment ","overallpaymententry2.php","mid-large")
        
    })

    /*$('.view_payment').click(function(){
        uni_modal("Payment Details","view_paypay.php?paymen_supplierID="+$(this).attr('data-ef_id')+"&pid="+$(this).attr('data-id'),"mid-large")
        
    })*/
    $('.edit_payment').click(function(){
        uni_modal("Continue Manage Payment","overallpaymententry.php?id="+$(this).attr('data-id'),"mid-large")
        
    })
    $('.delete_payment').click(function(){
        _conf("Are you sure to delete this payment ?","delete_payment",[$(this).attr('data-id')])
    })
    function delete_payment($id){
        start_load()
        $.ajax({
            url:'easoftfun.php?action=delete_emma',
            method:'POST',
            data:{id:$id},
            success:function(resp){
                if(resp==1){
                    alert_toast("Data successfully deleted",'success')
                    setTimeout(function(){
                        location.reload()
                    },1500)

                }
            }
        })
    }


        // Toggle Sidebar
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('mainContent');
            sidebar.classList.toggle('collapsed');
            mainContent.classList.toggle('expanded');
        }

        // Toggle Dark/Light Mode
        const themeToggle = document.getElementById('themeToggle');
        const prefersDarkScheme = window.matchMedia('(prefers-color-scheme: dark)');

        // Check for saved user preference or use system preference
        const currentTheme = localStorage.getItem('theme');
        if(currentTheme === 'dark' || (!currentTheme && prefersDarkScheme.matches)) {
            document.documentElement.setAttribute('data-theme', 'dark');
            document.querySelector('.theme-toggle .fa-moon').style.display = 'none';
            document.querySelector('.theme-toggle .fa-sun').style.display = 'block';
        }

        themeToggle.addEventListener('click', () => {
            const isDark = document.documentElement.getAttribute('data-theme') === 'dark';
            if(isDark) {
                document.documentElement.removeAttribute('data-theme');
                localStorage.setItem('theme', 'light');
                document.querySelector('.theme-toggle .fa-moon').style.display = 'block';
                document.querySelector('.theme-toggle .fa-sun').style.display = 'none';
            } else {
                document.documentElement.setAttribute('data-theme', 'dark');
                localStorage.setItem('theme', 'dark');
                document.querySelector('.theme-toggle .fa-moon').style.display = 'none';
                document.querySelector('.theme-toggle .fa-sun').style.display = 'block';
            }
        });
    </script>
</body>
</html>
