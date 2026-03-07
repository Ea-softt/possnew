<?php
include('headside.php');
include('insert_sales.php');
include 'easoftsql.php'; 
include('insert_newwarehouse.php');

$fees = $conn->query("SELECT * FROM newemployee WHERE EmpID = '{$_SESSION['uid']}'");
foreach ($fees->fetch(PDO::FETCH_ASSOC) as $k => $v) {
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

        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mb-3 border-bottom pb-2">
            <h1 class="h2">Warehouse Update</h1>
            <div class="alert alert-warning py-1 px-3 mb-0">
                <i class="fas fa-exclamation-triangle"></i> Expiring date format: <strong><?php echo date('Y-m-d', strtotime('now'));?></strong>
            </div>
        </div>
        
        <form action="" id="productts">
            <div class="row">
                <!-- Left Column: Selected Items -->
                <div class="col-lg-8">
                    <div class="card shadow-sm mb-4">
                        <div class="card-header bg-success text-white">
                            <h5 class="mb-0"><i class="fas fa-clipboard-check"></i> Items to Update</h5>
                        </div>
                        <div class="card-body">
                            <input type="hidden" id="location" class="location" name="location" value="<?php echo date('s', strtotime('now'));?>">
                            
                            <div class="table-responsive" style="max-height: 600px; overflow-y: auto;">
                                <table class="table table-bordered table-hover table-striped">
                                    <thead class="table-light sticky-top">
                                        <tr class='text-center'>
                                            <th>ID</th>
                                            <th>CompanyID</th>
                                            <th>Product</th>
                                            <th>Quantity</th>
                                            <th>Cost</th>
                                            <th>Unit</th>                         
                                            <th>Description</th>      
                                            <th>Expirdate</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody id="tableData1">     
                                        <!-- Rows added via JS -->
                                    </tbody>        
                                </table>
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-end bg-light">
                            <button type="button" class="btn btn-primary me-2" id='submit'><i class="fas fa-thumbs-up"></i> Save</button>
                            <button type="button" id="cancel" class="btn btn-danger"><i class="fas fa-ban"></i> Cancel</button>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Product Selection -->
                <div class="col-lg-4"> 
                    <div class="card shadow-sm mb-4">
                        <div class="card-header bg-dark text-white">
                            <h5 class="mb-0"><i class="fas fa-search"></i> Select Products</h5>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive" style="height: 650px; overflow-y: auto;">
                                <table id="mytable" class="table table1 table-striped table-hover w-100 font-weight-bold tablet mb-0" style="cursor: pointer;">
                                    <thead class="table-light sticky-top">
                                        <tr class='text-center text-black'>
                                            <th class="text-center" style="width: 40px;">
                                                <input class="checkbox" type="checkbox" id="selectall">
                                            </th>
                                            <th>ID</th>
                                            <th>Product</th>
                                            <th>Price</th>
                                            <th>Qty</th>
                                            <th>Unit</th>              
                                            <th style="display:none;">Description</th>
                                            <th style="display:none;">Expirdate</th>
                                            <th style="display:none;">Sub.Total</th> 
                                            <th style="display:none;">barc</th>            
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $i = 1;
                                        $student = $conn->query("SELECT wh.*,sp.* FROM warehouse wh inner join supplier sp on wh.supplierid = sp.supplier_id ORDER BY wh.name ASC ");
                                        while($row=$student->fetch_assoc()):
                                        ?>
                                        <tr>
                                            <td class="text-center">
                                                <input class="checkbox" type="checkbox" name="check" value="">
                                            </td>   
                                            <td class="text-center" name="check"><?php echo $row['sid'] ?></td>
                                            <td class="text-center" name="check"><?php echo $row['name'] ?></td>
                                            <td class="text-center" name="check"><?php echo $row['price'] ?></td>
                                            <td class="text-center" name="check"><?php echo $row['quantity'] ?></td>
                                            <td class="text-center" name="check"><?php echo $row['unit'] ?></td>
                                            
                                            <td class="text-center" name="check" style="display:none;"><?php echo $row['supplierid'] ?></td>
                                            <td class="text-center" name="check" style="display:none;"><?php echo $row['description'] ?></td>
                                            <td class="text-center" name="check" style="display:none;"><?php echo $row['expire_date'] ?></td>
                                            <td class="text-center" name="check" style="display:none;"><?php echo $row['supplierid'] ?></td>
                                            <td class="text-center" name="check" style="display:none;"><?php echo $row['multtota'] ?></td>
                                            <td class="text-center" name="check" style="display:none;"><?php echo $i++ ?></td>

                                            <td class='text-center p-1'>
                                                <button class='btn btn-danger btn-sm' type='button' id='delete-row'><i class='fas fa-times'></i></button>
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
        </form>
    </div>
    

<style>
    .btnn{
        display: none;
    }
    img#cimg{
        max-height: 27vh;
        max-width: 13vw;
    }
</style>




    
    <!-- Custom JS -->
   <script src="bootstrap4/jquery/accounting.min.js"></script>
   <script>

    $(document).ready(function(){
        $('.table').dataTable();
        $('#mytable').ddTableFilter();
    })
    



$('.tablet').click(function() {
   // var newline = "\n";
    var sendToNum = $('#tableData1');
    sendToNum.text('');
    $("input[name=check]:checked").each(function() {
      var sid = $(this).parent().nextAll('td').eq(0).html();   
       var companyname = $(this).parent().nextAll('td').eq(5).html(); 
      var product = $(this).parent().nextAll('td').eq(1).html();
       var quantity = $(this).parent().nextAll('td').eq(3).html();  
      var price = $(this).parent().nextAll('td').eq(2).html();      
      var  unit= $(this).parent().nextAll('td').eq(4).html();
      var description = $(this).parent().nextAll('td').eq(6).html();    
      var expiredate = $(this).parent().nextAll('td').eq(7).html(); 
      var multtota = $(this).parent().nextAll('td').eq(9).html(); 
      var barc = $(this).parent().nextAll('td').eq(8).html(); 
     // var supplierid = $(this).parent().nextAll('td').eq(9).html(); 
      var quantity1 = parseFloat(0);
      var price1 =  parseFloat(0);
    // var tcost1 = parseFloat(0);
       /*var tprice = (quantity*price);
       var dateee = $("#location").val();
        var supp = $(".supplierid").val();
       var datee = dateee++;*/
      
      

      sendToNum.append("<tr class='prd'><td class='sid text-center' contenteditable>"+sid+"</td><td class='companyname  text-center' contenteditable>"+companyname+"</td><td class='product text-center' contenteditable>"+product+"</td><td class='quantity1 text-center' contenteditable>"+quantity1+"</td><td class='price1 text-center'contenteditable>"+price+" </td><td class='unit1 text-center'contenteditable>"+unit+"</td><td class='description text-center' contenteditable>"+description+"</td></td><td class='expiredate text-center'  contenteditable>"+expiredate+"</td>");
      
   


    /*  <td style='display:none;' class='multtota text-center'contenteditable>"+accounting.formatMoney(multtota,{symbol:"Ghc",format: "%s %v"})+"</td>*/

/*accounting.formatMoney(price,{symbol:"Ghc",format: "%s %v"})  */
    });
  });

var $selectAll = $('#selectall'); // main checkbox inside table thead
  var $table = $('.table1'); // table selector 
  var $tdCheckbox = $table.find('tbody input:checkbox'); // checboxes inside table body
  var tdCheckboxChecked = 0; // checked checboxes

  // Select or deselect all checkboxes depending on main checkbox change
  $selectAll.on('click', function () {
    $tdCheckbox.prop('checked', this.checked);
  });







$(document).on('click', '#cancel', function(){
   swal({
      title: "Cancel orders?",
      text: "By doing this,orders will remove!",
      icon: "warning",
      buttons: ["No","Yes"],
      dangerMode: true,
    })
   .then((reload) => {
      if (reload) {
        location.reload();
        window.location.href='productpage.php?'
      }
    });
    

});



$('#search').focus();

function loadprod(){
  var name = $("#search1").val();
  if(name){
    $.ajax({
      type: 'post',
      data: {
        products:name,
      },
      url: 'dropdownstock.php',
      success: function (Response){
        $('#products').html(Response);
      }
    });
  }
};



  
function displayImg(input,_this) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#cimg').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}



/*
function loadpro(){
  var name = $("#search").val();
  if(name){
    $.ajax({
      type: 'post',
      data: {
        products:name,
      },
      url: 'stockdropdown.php',
      success: function (Response){
        $('#products').html(Response);
      }
    });
  }
};*/

$('body').on('click','.js-add',function(){
      var totalPrice = 0;
      var target = $(this);
      var product = target.attr('data-name');
      var price = target.attr('data-price');
      var sid = target.attr('data-sid');
      var unit = target.attr('data-unit');
       var quantity = target.attr('data-quantity');
      var min_stock = target.attr('data-min');  
      var description = target.attr('data-description');
      var multtota = target.attr('data-multtota');
       var expiredate = target.attr('data-expire');
          
           

            if(min >= quantity){
              swal("Warning","Please Selected Product is getting finish","warning")
            }


            
            $('#tableData1').append("<tr class='prd'><td class='sid text-center'>"+sid+"</td><td class='product text-center'>"+product+"</td><td class='cprice text-center'contenteditable>"+accounting.formatMoney(price,{symbol:"Ghc",format: "%s %v"})+" </td><td class='unit text-center' contenteditable>"+unit+"</td><td class='quantity text-center'contenteditable>"+quantity+"</td><td class='expiredate text-center' contenteditable>"+expiredate+"</td><td style='display:none;' class='multtota text-center'contenteditable>"+accounting.formatMoney(multtota,{symbol:"Ghc",format: "%s %v"})+"</td></td><td class='description text-center' style='display:none;' contenteditable>"+description+"</td><td class='text-center p-1'contenteditable><button class='btn btn-danger btn-sm' type='button' id='delete-row'><i class='fas fa-times-circle'></i></button><tr>");
            

             $('#search').focus();
      

        
      
 
});




$("body").on('click','#delete-row', function(){
    var target = $(this);
    swal({
      title: "Remove this item?",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        $(this).parents("tr").remove();
        swal("Removed Successfully!", {
          icon: "success",
        });
          GrandTotal();
      }
  });
});

/*$('#productts').submit(function(e){
        e.preventDefault()*/


    $(document).on('click', '#submit', function(){
   var sid = [];
    var companyname  = [];  
    var product  = [];
     var quantity1 = [];
    var price1 = [];  
   // var tcost1  = [];
     var description = [];
    var expiredate = [];  
     var unit = [];
    
      var result = 0;
   /* 
    var expiredate =[];       
    var min_stock = [];
    var location =  $('#location').val();
    var images = $('#images').val();
    var supplierid =[];
    */
     $('.sid').each(function(){
        sid.push($(this).text());
     });
    // alert (sid);
      $('.companyname').each(function(){
       companyname.push($(this).text());
     });

     $('.product').each(function(){
        product.push($(this).text());
    });

   
           
      $('.price1').each(function(){
      price1.push($(this).text().replace(/,/g, "").replace("Ghc",""));
    
         });    


       $('.quantity1').each(function(){
    quantity1.push($(this).text());     
    
     }); 


    /*// tt1 = (quantity1 * price1);
    
      $('.tcost1').each(function(){
       // tcost1 =parseFloat([quantity1 + price1]);
         result = (quantity1 * price1);
       //  if (isNaN(tt1)) { return }
         tcost1.push(result);*/
   // });
// alert(tcost1);
    $('.unit1').each(function(){
         unit.push($(this).text());

    });

 
    $('.expiredate').each(function(){
        expiredate.push($(this).text());

    });
   
    $('.description').each(function(){
        description.push($(this).text());
       });
   



        /* if(price1== ""){
              swal("Warning","Please Enter sprice ","warning");    
            return false;
            }


          if(min_stock== ""){
              swal("Warning","Please Enter Min Stocks ","warning");    
            return false;
        }

          if(min_stock== 0){
              swal("Warning","Please Min Stocks can not be 0","warning");    
            return false;
        }
        
         if(quantity1== 0){
              swal("Warning","Please quantity can not be 0","warning");    
            return false;
        }
         if(quantity1<= 0){
              swal("Warning","Please quantity can not be less than 0","warning");    
            return false;
        }

        if(min_stock<= 0){
              swal("Warning","Please Min Stocks can not be less than 0","warning");    
            return false;
        }
        if(expiredate== ""){
              swal("Warning","Please provide expiring Date at the Warehouse Entry ","warning");    
            return false;
        }*/
       //  tcost1 = parseFloat(50);
       // alert(tcost1);

        swal({
      title: "Please are you sure to update Selected Product?",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
        .then((willsave) => {
      if (willsave) {

            $.ajax({
              url:"insert_newwarehouse.php",
              method:"POST",        
              data:{companyname:companyname,product:product,quantity1:quantity1,price1:price1,unit:unit,expiredate:expiredate,description:description,sid:sid},
              success: function(data){
               // alert(data);
                
                if(data = "success"){  

                  alert_toast("Data successfully saved.",'success')
                        setTimeout(function(){
                            window.location.href='newwarehousepage.php?'+data;
                        },900)
                }
                else{
                  window.location.href='warehouse.php?'+data;
                }   
                
              }

            });
          
        //window.location.href='productform.php'+data;
        // window.location.href='productform.php?'+data;
      /*$('#SupplierDeliverlist').click(function(){
    uni_modal("Suppliers Entry","SupplierDeliverlistcontrol.php",'large')
    
  })*/

}
    });
  
});
































/*
$('#products').submit(function(e){
        e.preventDefault()
        start_load()
        $('#msg').html('')*/

  
     













/* function FetchState(sid){ 
    $('#StudentName').html('');
    $.ajax({
        type:'post',
        url: 'stockdropdown.php',
        data:{aja_id :sid},
        success : function(data){
            $('#StudentName').html(data);
             return false;
        }

    })
   }*/
   
    
    $('#new_supplier').submit(function(e){
        e.preventDefault()
        start_load()
        $('#msg').html('')
      /*  if($('#new_supplier').find('[fname]').length <= 0){
            alert_toast("Please insert atleast 1 row in the fees table",'danger')
            end_load()
            return false;
        }*/
      
        $.ajax({
            url:'easoftfun.php?action=new_supplier',
            data: new FormData($(this)[0]),
            cache: false,
            contentType: false,
            processData: false,
            method: 'POST',
            type: 'POST',
            success:function(resp){
                if(resp==1){
                    alert_toast("Data successfully saved.",'success')
                        setTimeout(function(){
                            location.reload()
                        },1000)
                }else if(resp == 2){
                $('#msg').html('<div class="alert alert-danger mx-2">Already exist, So Check the Names And The Phone Number.</div>')
                end_load()
                }   
            }
        })
    })

    $('.select2').select2({
        placeholder:"Search of products in the warehouse",
        width:'100%'
    })

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
