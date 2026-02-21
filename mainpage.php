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
    <script src="bootstrap4/jquery/accounting.min.js"></script>
    <script src="bootstrap4/js/typeahead.js"></script>

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
                    <li><a class="dropdown-item text-success" href="supplierlistpage.php">Suppliers List</a></li>
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
        <form action="" id="supplierlin">
            <div class="bd-example">
                <div class="row-cols-1 row-cols-md-29 g-1">
                    <div class="col">
                        <div class="card bg-dark">
                              
                           <div class="card-header p-0">
    <div class="row g-0 m-0">
        <div class="col-lg-4 border-end border-white p-2 bg-success d-flex flex-column justify-content-center" style="min-height: 70px;">
            <?php
            date_default_timezone_set("Africa/Accra");
            $date = date("Y-m-d");
            $classt = 0;

            if (isset($EmpID)) {
                $fees = $conn->query("SELECT * FROM sales WHERE username= '$EmpID' AND created_date = '$date'");
                while ($row = $fees->fetch_assoc()) {
                    $classt += $row['grandtotal'];
                }
            }
            ?>
            <p class="text-white mb-1" style="font-size: 14px;">
                <i class="fas fa-user-shield me-1"></i>
                <?php echo isset($FullName) ? $FullName : ''; ?> your Total Sale: Ghc <?php echo $classt; ?>
            </p>
            <p class="text-white mb-0" style="font-size: 13px;">
                <i class="fas fa-calendar-alt me-1"></i>
                Date: <?php echo $date; ?>
            </p>
            <?php
            for ($i = 0; $i <= 31; ++$i) {
                $time = strtotime(sprintf('+%d days', $i));
                $days = date('d', $time);
            }
            ?>
            <input type="hidden" name="days" id="days" value="<?php echo isset($days) ? $days : ''; ?>">
            <?php
            for ($i = 0; $i <= 12; ++$i) {
                $time = strtotime(sprintf('+%d months', $i));
                $monthname = date('F', $time);
            }
            ?>
            <input type="hidden" name="month" id="month" value="<?php echo isset($monthname) ? $monthname : ''; ?>">
            <?php $y = (int)date("Y"); ?>
            <input type="hidden" name="year" id="years" value="<?php echo $y; ?>">
            <input type="hidden" id="user" name="salername" value="<?php echo isset($EmpID) ? $EmpID : ''; ?>">
        </div>

        <div class="col-lg-5 border-end border-white p-2 bg-success d-flex flex-column justify-content-center" style="min-height: 70px;">
            <div class="mb-1">
                <label class="text-white mb-0" style="font-size: 13px;">Customer Name:</label>
                <input type="text" class="form-control form-control-sm" autocomplete="off" data-provide="typeahead" id="customer_search" placeholder="Customer Search" name="customername" value="" style="font-size: 12px;">
            </div>
            <div class="d-flex justify-content-between align-items-center mb-1">
                <label class="text-white mb-0" style="font-size: 13px;">New Name:</label>
                <a class="btn btn-sm btn-info py-0" href="javascript:void(0)" id="new_customer" style="font-size: 12px;">
                    <i class="fas fa-user-plus me-1"></i> New
                </a>
            </div>
            <input type="date" name="datee" id="datee" class="form-control form-control-sm py-0" value="<?php echo $date; ?>" required style="font-size: 12px;">
        </div>

        <div class="col-lg-3 p-0">
            <div class="h-100 bg-danger d-flex flex-column justify-content-center align-items-center p-2" style="min-height: 70px;">
                <div class="text-white text-center w-100 mb-1">
                    <label class="d-block mb-0" style="font-size: 13px;">Total(Ghc):</label>
                    <p id="totalValue1" class="mb-0" style="font-size: 14px;">0.00</p>
                </div>
                <div class="text-white text-center w-100">
                    <label class="d-block mb-0" style="font-size: 13px;">Grand Total Ghc:</label>
                    <p id="totalValue" class="mb-0 fw-bold" style="font-size: 16px;">0.00</p>
                </div>
                <input type="hidden" class="mult1" id="totalvaluer1in" name="totalsale" value="">
                <input type="hidden" class="mult2" id="totalvaluein" name="grandtotal">
            </div>
        </div>
    </div>
</div>






                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-7 border-right">
                                        <div id="content" class="mr-15">
                                            <div id="price_column" class="m-2 table-responsive-sm table-wrapper-scroll-y my-custom-scrollbar-a">
                                                <table class="table-striped w-100 font-weight-bold" style="cursor: pointer;" id="table2">
                                                    <thead>
                                                        <tr class='text-center'>
                                                            <th>Barcode</th>
                                                            <th>Product</th>
                                                            <th>Price</th>
                                                            <th>Unit</th>
                                                            <th>Qty</th>
                                                            <th>Sub.Total</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tableData"></tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-5 border-right">
                                        <div id="sidebar">
                                            <div class="mb-60">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-search"></i></span>
                                                    </div>
                                                    <input class="form-control" type="text" placeholder="Product Search" autofocus aria-label="Search" id="search" onfocus="this.value=''" onkeyup="loadproducts();"/>
                                                </div>
                                            </div>
                                            <div id="product_area" class="table-responsive-sm mt-2 table-wrapper-scroll-y my-custom-scrollbar">
                                                <table class="w-100" style="cursor: pointer;" id="table1">
                                                    <thead>
                                                        <tr class='text-center text-black'><b>
                                                            <td>Barcode</td>
                                                            <td>Product</td>
                                                            <td>Price</td>
                                                            <td>Unit</td>
                                                            <td>Qty</td>
                                                            <td>Ex Date</td>
                                                        </b></tr>
                                                    </thead>
                                                    <tbody id="products"></tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-5 border-right">
                                        <div class="w-100 mt-2" id="enter_area">
                                            <button id="buttons" type="button" name='enter' class="Enter btn btn-primary border ml-2"><i class="fas fa-handshake"></i> Finish</button>
                                        </div>
                                    </div>

                                    <div class="col-lg-2 border p-1 bg-danger rounded">
    <div id="table_buttons" class="d-flex flex-column align-items-center justify-content-center h-100 text-white">
        <div class=" w-100">
            <label class="form-label mb-0">Discount(Ghc):</label>
            <input class="form-control form-control-sm text-center" type="number" name="discount" value="0" min="0" placeholder="Enter Discount" id="discount">
        </div>
        <div class="d-flex justify-content-between w-100 mt-1">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="typeofcash" value="1" id="typeofcash">
                <label class="form-check-label" for="typeofcash">Cash</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="typeofcash" value="2" id="typeofcash1">
                <label class="form-check-label" for="typeofcash1">E-Cash</label>
            </div>
        </div>
    </div>
</div>



                          










                                    <div class="col-lg-5 border-right">
                                        <div class="w-100 mt-2" id="enter_area">
                                            <button id="buttons" type="button" class="cancel btn btn-primary border"><i class="fas fa-ban"></i> Cancel</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Custom JS -->
    <script type="text/javascript">
        $('#new_customer').click(function() {
            uni_modal("Customer Entry", "customer.php", 'small');
        });

        function loadproducts() {
            var name = $("#search").val();
            if(name) {
                $.ajax({
                    type: 'post',
                    data: { products: name },
                    url: 'loadproducts.php',
                    success: function(Response) {
                        $('#products').html(Response);
                    }
                });
            }
        };

        $(document).ready(function() {
            $('#customer_search').typeahead({
                source: function(query, result) {
                    $.ajax({
                        url: 'loadcustomer.php',
                        method: "POST",
                        data: { query: query },
                        dataType: "json",
                        success: function(data) {
                            result($.map(data, function(item) {
                                return item;
                            }));
                        }
                    });
                }
            });
        });

        function GrandTotal() {
            var TotalValue = 0;
            var TotalPriceArr = $('#tableData tr .totalPrice').get();
            var discount = $('#discount').val();

            $(TotalPriceArr).each(function() {
                TotalValue += parseFloat($(this).text().replace(/,/g, "2").replace("Ghc", ""));
            });

            if(discount != null) {
                var f_discount = 0;
                var todiscount = 0;
                f_discount = discount/100*TotalValue;
                todiscount = TotalValue - f_discount;
                $("#totalValue").text(accounting.formatMoney(todiscount, {symbol: "Ghc", format: "%s %v"}));
                $("#totalValue1").text(accounting.formatMoney(TotalValue, {format: "%v"}));
                $("#totalvaluein").val(TotalValue);
            } else {
                $("#totalValue").text(accounting.formatMoney(TotalValue, {symbol: "Ghc", format: "%s %v"}));
                $("#totalValue1").text(accounting.formatMoney(TotalValue, {format: "%v"}));
            }
        };

        $(document).on('change', '#discount', function() {
            GrandTotal();
        });

        $('body').on('click', '.js-add', function() {
            var totalPrice = 0;
            var target = $(this);
            var product = target.attr('data-product');
            var price = target.attr('data-price');
            var barcode = target.attr('data-barcode');
            var unit = target.attr('data-unt');
            var min = target.attr('data-min');
            var quantity = target.attr('data-quantity');

            swal({
                title: "Enter number of items:",
                content: "input",
            })
            .then((value) => {
                if(value == "") {
                    swal("Error", "Entered none!", "error");
                } else {
                    var qtynum = value;
                    if(isNaN(qtynum)) {
                        swal("Error", "Please enter a valid number!", "error");
                    } else if(qtynum == null) {
                        swal("Error", "Please enter a number!", "error");
                    } else {
                        if(value >= quantity) {
                            swal("Warning", "Please Check Selected Product Quantity", "warning");
                        }
                        if(min >= quantity) {
                            swal("Warning", "Please Selected Product is getting finish", "warning");
                        }
                        var total = parseInt(value, 10) * parseFloat(price);
                        $('#tableData').append("<tr class='prd'><td input class='barcode text-center'>" + barcode + "</td><td class='text-left'>" + (product) + "</td><td class='price text-center'>" + accounting.formatMoney(price, {symbol: "Ghc", format: "%s %v"}) + "</td><td class='text-center'>" + unit + "</td><td class='qty text-center'>" + value + "</td><td class='totalPrice text-center'>" + accounting.formatMoney(total, {symbol: "Ghc", format: "%s %v"}) + "</td><td class='text-center p-1'><button class='btn btn-danger btn-sm' type='button' id='delete-row'><i class='fas fa-times-circle'></i></button><tr>");
                        GrandTotal();
                        $('#search').focus();
                    }
                }
            });
        });

        $(document).ready(function() {
            document.getElementById("search").focus();
        });

        $("body").on('click', '#delete-row', function() {
            var target = $(this);
            swal({
                title: "Remove this item?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if(willDelete) {
                    $(this).parents("tr").remove();
                    swal("Removed Successfully!", {
                        icon: "success",
                    });
                    GrandTotal();
                }
            });
        });

        $(document).on('click', '.Enter', function() {
            var TotalPriceArr = $('#tableData tr .totalPrice').get();
            var typeofcash = $("input[name='typeofcash']:checked").val();

            if(typeofcash == undefined) {
                swal("Warning", "Please Select The Type Of Cash!", "warning");
                return false;
            }

            if(TotalPriceArr == 0) {
                swal("Warning", "No products ordered!", "warning");
                return false;
            } else {
                var product = [];
                var quantity = [];
                var price = [];
                var grandtotal = $('#totalvaluein').val();
                var days = $('#days').val();
                var month = $('#month').val();
                var user = $('#user').val();
                var years = $('#years').val();
                var customer = $('#customer_search').val();
                var discount = $('#discount').val();
                var datee = $('#datee').val();

                $('.barcode').each(function() {
                    product.push($(this).text());
                });
                $('.qty').each(function() {
                    quantity.push($(this).text());
                });
                $('.price').each(function() {
                    price.push($(this).text().replace(/,/g, "").replace("Ghc", ""));
                });

                swal({
                    title: "Enter Cash",
                    content: "input",
                })
                .then((value) => {
                    if(value == "") {
                        swal("Error", "Entered None!", "error");
                    } else {
                        var qtynum = value;
                        if(isNaN(qtynum)) {
                            swal("Error", "Please enter a valid number!", "error");
                        } else if(qtynum == null) {
                            swal("Error", "Entered None!", "error");
                        } else {
                            var change = 0;
                            var TotalValue = parseFloat($('#totalValue').text().replace(/,/g, "").replace("Ghc", ""));
                            if(TotalValue > qtynum) {
                                swal("Error", "Can't process a smaller number", "error");
                            } else {
                                change = parseFloat(value) - parseFloat(TotalValue);
                                $.ajax({
                                    url: "insert_sales.php",
                                    method: "POST",
                                    data: {
                                        totalvalue: TotalValue,
                                        product: product,
                                        price: price,
                                        grandtotal: grandtotal,
                                        days: days,
                                        month: month,
                                        user: user,
                                        years: years,
                                        customer: customer,
                                        quantity: quantity,
                                        discount: discount,
                                        typeofcash: typeofcash,
                                        datee: datee
                                    },
                                    success: function(data) {
                                        if(data) {
                                            swal({
                                                title: "Change is " + accounting.formatMoney(change, {symbol: "Ghc", format: "%s %v"}),
                                                icon: "success",
                                                buttons: "Okay",
                                            })
                                            .then((okay) => {
                                                if(okay) {
                                                    setTimeout(function() {
                                                        var nw = window.open("receiptsale.php?reciept_no=" + data + "", "_blank", "width=900px,height=600px");
                                                        setTimeout(function() {
                                                            nw.print();
                                                            setTimeout(function() {
                                                                nw.close();
                                                                location.reload();
                                                            }, 500);
                                                        }, 500);
                                                    }, 500);
                                                }
                                            });
                                        } else {
                                            window.location.href = 'mainpa.php?' + data;
                                        }
                                    }
                                });
                            }
                        }
                    }
                });
            }
        });

        $(document).on('click', '.cancel', function(e) {
            var TotalPriceArr = $('#tableData tr .totalPrice').get();
            if(TotalPriceArr == 0) {
                return 0;
            } else {
                swal({
                    title: "Cancel orders?",
                    text: "By doing this, orders will remove!",
                    icon: "warning",
                    buttons: ["No", "Yes"],
                    dangerMode: true,
                })
                .then((reload) => {
                    if(reload) {
                        location.reload();
                    }
                });
            }
        });

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
