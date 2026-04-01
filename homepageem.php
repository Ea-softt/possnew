<?php 
 include('headem.php');
 //include('insert_sales.php');

 if(isset($_SESSION["uid"])){
    $fees = $conn->query("SELECT * FROM newemployee WHERE EmpID = '{$_SESSION['uid']}' ");
    foreach($fees->fetch(PDO::FETCH_ASSOC) as $k => $v){
      $$k= $v;
      $meta[$k] = $v;
    }
} else {
    header('location:Login.php?error=wrong username,password and role');
}

// Logic for Dates/Totals (Kept exactly as original)
$y=(int)date("Y");
for($i = 0; $i <= 31; ++$i){
    $time = strtotime(sprintf('+%d days',$i));
    $days=date('d',$time);
}
for($i = 0; $i <= 12; ++$i){
    $time = strtotime(sprintf('+%d months',$i));
    $monthname=date('F',$time);
}
?>
<!-- 
<style>
    body { background-color: #f4f7f6; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
    .pos-card { border: none; border-radius: 15px; box-shadow: 0 4px 20px rgba(0,0,0,0.08); background: #fff; }
    .table-wrapper-scroll-y { position: relative; height: 400px; overflow-y: auto; border: 1px solid #dee2e6; border-radius: 8px; }
    .my-custom-scrollbar { height: 450px; }
    .my-custom-scrollbar-a { height: 450px; }
    .bg-pos-dark { background-color: #2c3e50 !important; color: white; }
    .total-display { background: #e74c3c; color: white; border-radius: 10px; padding: 15px; }
    .grand-total-text { font-size: 1.8rem; font-weight: 800; }
    .product-row:hover { background-color: #f8f9fa; cursor: pointer; }
    .sticky-summary { position: sticky; top: 20px; }
    .btn-finish { padding: 12px 30px; font-weight: bold; text-transform: uppercase; letter-spacing: 1px; }
    thead th { position: sticky; top: 0; background: #2c3e50; color: white; z-index: 10; }
</style> -->

<style>
    body { 
        background-color: #f4f7f6; 
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
        overflow: hidden; /* Prevents the whole page from scrolling */
    }
    .pos-card { border: none; border-radius: 10px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); background: #fff; }
    
    /* Dynamic Height - This makes it fit 100% of the screen */
    .table-wrapper-scroll-y { 
        position: relative; 
        height: calc(100vh - 360px) !important; /* Adjusts based on screen height */
        overflow-y: auto; 
        border: 1px solid #dee2e6; 
        border-radius: 6px; 
    }

    .bg-pos-dark { background-color: #2c3e50 !important; color: white; padding: 8px !important; }
    
    /* Shrink the font sizes slightly to fit more items */
    #table2 thead th, #table1 thead th { 
        font-size: 0.85rem; 
        padding: 8px; 
        background: #2c3e50; 
        color: white; 
        position: sticky; 
        top: 0; 
        z-index: 10;
    }

    #tableData, #products { font-size: 0.95rem !important; } /* Reduced from 1.50rem */

    /* Compact inputs */
    .form-control-sm { height: calc(1.5em + 0.5rem + 2px); font-size: 0.875rem; }
    
    /* Action Buttons Area */
    .action-section { padding-top: 10px; border-top: 1px solid #eee; }
    .grand-total-box { padding: 10px !important; }
    .btn-finish-big { height: 100%; font-size: 1.2rem; }
</style>

<div class="container-fluid py-2"> <form action="" id="supplierlin">
        <div class="row mb-2">
            <div class="col-md-12">
                <div class="pos-card p-2 px-3 d-flex justify-content-between align-items-center bg-pos-dark">
                    <div class="small">
                        <span class="me-3"><i class="fas fa-user-shield me-1 text-info"></i> Cashier: <strong><?php echo $FullName;?></strong></span>
                        <span><i class="fas fa-calendar-alt me-1 text-info"></i> <?php echo date("Y-m-d"); ?></span>
                    
                         <input type="hidden" name="days" id="days" value="<?php echo $days; ?>">
                    <input type="hidden" name="month" id="month" value="<?php echo $monthname; ?>">
                    <input type="hidden" name="year" id="years" value="<?php echo $y; ?>">
                    <input type="hidden" id="user" name="salername" value="<?php echo $EmpID;?>">
                    <input type="hidden" name="datee" id="datee" value="<?php echo date('Y-m-d') ?>">
                    
                    
                      </div>
                </div>
            </div>
        </div>

        <div class="row g-2"> <div class="col-lg-7">
                <div class="pos-card p-2 shadow-sm">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div style="width: 70%;">
                            <input type="text" class="form-control form-control-sm" id="customer_search" placeholder="Select Customer..." name="customername" required>
                        </div>
                        <button type="button" class="btn btn-outline-primary btn-sm" id="new_customer"><i class="fas fa-plus"></i></button>
                    </div>

                    <div class="table-wrapper-scroll-y">
                        <table class="table table-sm table-hover align-middle mb-0" id="table2">
                            <thead>
                                <tr class="text-center">
                                    <th  class="text-center">Barcode</th>
                                    <th  class="text-center">Product</th>
                                    <th class="text-center">Price</th>
                                    <th class="text-center">Unit</th>
                                    <th class="text-center" width="80">Qty</th>
                                    <th class="text-center">Total</th>
                                    <th class="text-center"><i class="fas fa-times"></i></th>
                                </tr>
                            </thead>
                            <tbody id="tableData"></tbody>
                        </table>
                    </div>

                    <div class="action-section mt-2">
                        <div class="row g-2 align-items-stretch">
                            <div class="col-md-2 text-center">
                                <label class="small fw-bold mb-0">Disc %</label>
                                <input class="form-control form-control-sm text-center fw-bold" type="number" name="discount" value="0" id="discount">
                            </div>
                            
                            <div class="col-md-3">
                                <div class="p-1 border rounded bg-light h-100 d-flex align-items-center justify-content-around">
                                    <div class="form-check m-0">
                                        <input class="form-check-input" type="radio" name="typeofcash" value="1" id="cash" checked>
                                        <label class="form-check-label small" for="cash">Cash</label>
                                    </div>
                                    <div class="form-check m-0">
                                        <input class="form-check-input" type="radio" name="typeofcash" value="2" id="ecash">
                                        <label class="form-check-label small" for="ecash">E-Cash</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <button type="button" class="Enter btn btn-success w-100 h-100 fw-bold">
                                    <i class="fas fa-check-circle me-1"></i> FINISH
                                </button>
                            </div>

                            <div class="col-md-4">
                                <div class="bg-danger text-white rounded grand-total-box text-center h-100 d-flex flex-column justify-content-center">
                                    <small class="text-uppercase" style="font-size: 0.7rem;">Grand Total</small>
                                    <span id="totalValue" class="fw-bold" style="font-size: 1.5rem;">0.00</span>
                                   
                                    <input type="hidden" class="mult2" id="totalvaluein" name="grandtotal">
                                    <input type="hidden" id="totalValue1"> 
                                    <input type="hidden" class="mult1" id="totalvaluer1in" name="totalsale">
                                </div>
                            </div>

                        </div>
                        <div class="text-center mt-1">
                            <a href="javascript:void(0)" class="cancel text-danger small text-decoration-none"><i class="fas fa-ban"></i> Cancel Order</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="pos-card p-2 shadow-sm">
                    <div class="input-group input-group-sm mb-2">
                        <span class="input-group-text bg-white"><i class="fas fa-search"></i></span>
                        <input class="form-control" type="text" placeholder="Search product..." id="search" onkeyup="loadproducts();" autofocus/>
                    </div>

                    <div class="table-wrapper-scroll-y">
                        <table class="table table-sm table-hover mb-0" id="table1">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Unit</th>
                                    <th>Qty</th>
                                    <th>Ex. Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="products"></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

















<script type="text/javascript">
 $('#new_customer').click(function(){
    uni_modal("Customer Entry","customer.php",'small')
    
  })






function loadproducts(){
  var name = $("#search").val();
  if(name){
    $.ajax({
      type: 'post',
      data: {
        products:name,
      },
      url: 'loadproducts.php',
      success: function (Response){
        $('#products').html(Response);
      }
    });
  }
};

$(document).ready(function(){

  $('#customer_search').typeahead({

    source: function(query, result)
    {

        $.ajax({
          url: 'loadcustomer.php',
          method: "POST",
          data:{
            query:query
          },
          dataType: "json",
          success:function(data)
          {
            result($.map(data,function(item){
              return item;
            }));
          }
        })
    }
  });
});


function GrandTotal(){
  var TotalValue = 0;
  var TotalPriceArr = $('#tableData tr .totalPrice').get()
  var discount = $('#discount').val();

  $(TotalPriceArr).each(function(){
    TotalValue += parseFloat($(this).text().replace(/,/g, "").replace("Ghc",""));
  });

  /*if(discount != null){
    var f_discount = 0;

    f_discount = TotalValue - discount;

    $("#totalValue").text(accounting.formatMoney(f_discount,{symbol:"₱",format: "%s %v"}));
    $("#totalValue1").text(accounting.formatMoney(TotalValue,{format: "%v"}));
  }else{
    $("#totalValue").text(accounting.formatMoney(TotalValue,{symbol:"₱",format: "%s %v"}));
    $("#totalValue1").text(accounting.formatMoney(TotalValue,{format: "%v"}));
  }*/

   if(discount != null){
    var f_discount = 0;
    var todiscount = 0;

    f_discount = discount/100*TotalValue; 
          
        todiscount =TotalValue-f_discount;


 $("#totalValue").text(accounting.formatMoney(todiscount,{symbol:"Ghc",format: "%s %v"}));
    $("#totalValue1").text(accounting.formatMoney(TotalValue,{format: "%v"}));
    $("#totalvaluein").val(TotalValue);

  }else{
    $("#totalValue").text(accounting.formatMoney(TotalValue,{symbol:"Ghc",format: "%s %v"}));
    $("#totalValue1").text(accounting.formatMoney(TotalValue,{format: "%v"}));
  }





        //TotalValue - discount;
/*
    $("#totalValue").text(accounting.formatMoney(todiscount,{symbol:"₱",format: "%s %v"}));
   // $("#totalvaluein").val(accounting.formatMoney(todiscount,{symbol:"Ghc",format: "%s %v"}));

    $("#totalValue1").text(accounting.formatMoney(TotalValue,{format: "%v"}));
//$("#totalvaluer1in").val(accounting.formatMoney(TotalValue,{symbol:"Ghc",format: "%s %v"}));
  }else{
    $("#totalValue").text(accounting.formatMoney(TotalValue,{symbol:"Ghc",format: "%s %v"}));     //(accounting.formatMoney(TotalValue,{symbol:"Ghc",format: "%s %v"}));
    $("#totalvaluein").val(accounting.formatMoney(TotalValue,{symbol:"Ghc",format: "%s %v"})); //(accounting.formatMoney(TotalValue,{symbol:"Ghc",format: "%s %v"}));

    $("#totalValue1").text(TotalValue);   //(accounting.formatMoney(TotalValue,{format: "%v"}));
    $("#totalvalue1in").text(accounting.formatMoney(TotalValue,{format: "%v"}));    //(accounting.formatMoney(TotalValue,{format: "%v"}));
  }*/
};

$(document).on('change', '#discount', function(){
  GrandTotal();
});

$('body').on('click','.js-add',function(){
      var totalPrice = 0;
      var target = $(this);
      var product = target.attr('data-product');
      var price = target.attr('data-price');
       var barcodes = target.attr('data-barcode');
      var barcode = target.attr('data-product_no');
      var unit = target.attr('data-unt');
      var min = target.attr('data-min');  
      var quantity = target.attr('data-quantity');
      swal({               
        title: "Enter number of items:",
        content: "input",
      })
      .then((value) => {
        if (value == "") {
          swal("Error","Entered none!","error");
        }else{
          var qtynum = value;
          if (isNaN(qtynum)){
            swal("Error","Please enter a valid number!","error");
          }else if(qtynum == null){
            swal("Error","Please enter a number!","error");
          }else{
            

            if(min >= quantity){
              swal("Warning","Please Selected Product is getting finish","warning");
            }




           
            var total = parseInt(value,10) * parseFloat(price);
            $('#tableData').append("<tr class='prd'><td input class='barcode text-center d-none'>"+barcode+"</td><td input class='barcodes text-center'>"+barcodes+"</td><td class='text-center'>"+product+"</td><td class='price text-center'>"+accounting.formatMoney(price,{symbol:"Ghc",format: "%s %v"})+"</td><td class='text-center'>"+unit+"</td><td class='qty text-center'>"+value+"</td><td class='totalPrice text-center'>"+accounting.formatMoney(total,{symbol:"Ghc",format: "%s %v"})+"</td><td class='text-center p-1'><button class='btn btn-danger btn-sm' type='button' id='delete-row'><i class='fas fa-times-circle'></i></button><tr>");
            GrandTotal();

             $('#search').focus();
      
       }
      }
  });
});

$(document).ready(function(){
    document.getElementById("search").focus();
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

$(document).on('click','.Enter',function(){

  var TotalPriceArr = $('#tableData tr .totalPrice').get();
   var typeofcash = $("input[name='typeofcash']:checked").val();

  if($.trim($('#customer_search').val()).length == 0){
      swal("Warning","Please Enter Customer Name!","warning");
      return false;
   }
  //  if($.trim(customer).length == 0){
  //     swal({
  //       title: "Selection Required",
  //       text: "Please select or enter a customer name before finishing!",
  //       icon: "warning",
  //     });
  //     return false; // Stop the function here
  //   }
   
    if(typeofcash == undefined){
      swal("Warning","Please Select The Type Of Cash !","warning");
      return false;
    }

  if (TotalPriceArr == 0){
    swal("Warning","No products ordered!","warning");
    return false; 
  }else{

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
     
   
       

    $('.barcode').each(function(){
     product.push($(this).text());
    });
    $('.qty').each(function(){
    quantity.push($(this).text());
    });
    $('.price').each(function(){
      price.push($(this).text().replace(/,/g, "").replace("Ghc",""));
    });

    swal({
      title: "Enter Cash",
      content: "input",
    })
    .then((value) => {  
      if(value == "") {
        swal("Error","Entered None!","error");
      }else{

        var qtynum = value;
        if(isNaN(qtynum)){
          swal("Error","Please enter a valid number!","error");
        }else if(qtynum == null){
          swal("Error","Entered None!","error");
        }else{

          var change = 0;
          // var TotalPriceArr = $('#tableData tr .totalPrice').get()
          // $(TotalPriceArr).each(function(){
          //   TotalValue += parseFloat($(this).text().replace(/,/g, "").replace("₱",""));
          // });
          var TotalValue = parseFloat($('#totalValue').text().replace(/,/g, "").replace("Ghc",""));

          if(TotalValue > qtynum){
            swal("Error","Can't process a smaller number","error");
          }else{
            change = parseInt(value,10) - parseFloat(TotalValue);
            $.ajax({
              url:"insert_sales.php",
              method:"POST",
        data:{totalvalue:TotalValue, product:product, price:price, grandtotal:grandtotal, days:days, month:month, user:user, years:years, customer:customer, quantity:quantity, discount:discount, typeofcash:typeofcash, datee:datee},
              success: function(data){
               //  console.log(data);  
                if(data){
                  swal({
                    title: "Change is " + accounting.formatMoney(change,{symbol:"Ghc",format: "%s %v"}),
                    icon: "success",
                    buttons: "Okay",
                  })
                  .then((okay)=>{
                    if(okay){
                    setTimeout(function(){   
                   
                    var nw = window.open("receiptsale.php?reciept_no="+data+"","_blank","width=900px,height=600px");
                      setTimeout(function(){
                       nw.print()
                     setTimeout(function(){
                  nw.close()
                //  location.reload()

              nw.close()
            $('#tableData').html('');
            $('#totalValue').text('0');
            $('#totalvaluein').val('0');
            $('#customer_search').val('');
            $('#discount').val('0');
            $("input[name='typeofcash'][value='1']").prop('checked', true);
              $('#search').val('');
            $('#search').focus();
                },500)
              },500)
            },500)
                 

                    }
                  })
                }else{
                  window.location.href='homepageem.php?'+data;
                }
                
              }
            });
          }
        }
      }
    });
  }
});


let barcodeBuffer = '';
let lastKeyTime = Date.now();

$('#search').on('keypress', function(e){
 
    let currentTime = Date.now();

    if(currentTime - lastKeyTime > 100){
        barcodeBuffer = '';
    }

    lastKeyTime = currentTime;

    // ✅ FIXED HERE (Enter key)
    if(e.which === 13){

      if(e.key === "Enter"){

          setTimeout(function(){

           let scannedCode = $('#search').val().trim().replace(/\s+/g, '');

           let target = $(".js-add").filter(function(){
           let code = $(this).attr("data-barcode");
            return code && code.trim() === scannedCode;
               });
               if(target.length){
                   target.click();
                  
                    //alert('kkskdkskd');
                    }else{
                         console.log("NOT FOUND:", scannedCode);
                       //  swal("Error","Product not found!","error");
                      }

                      $('#search').val('');

                  }, 10); // 🔥 small delay (30–100ms works best)

                  e.preventDefault();
              }
       
      //  let scannedCode = $('#search').val().trim();
        
      //   if(scannedCode !== ''){
      //       let target = $(".js-add[data-barcode='" + scannedCode + "']");
      //     console.log(target);
      //       if(target.length){
               
      //           target.click();
      //       }else{
            
      //           swal("Error","Product not found!","error");
      //       }
      //   }

        
      // let scannedCode = $('#search').val().trim().replace(/\s+/g, '');

      //   let target = $(".js-add").filter(function(){
      //       let code = $(this).attr("data-barcode");
      //       // alert(target);
      //       return code && code.trim() === scannedCode;
      //   });

      //   if(target.length){
      //       target.click();
      //      // alert('kkskdkskd');
      //   }else{
      //       console.log("NOT FOUND:", scannedCode);
      //       swal("Error","Product not found!","error");
      //   }


      //   barcodeBuffer = '';
      //   $('#search').val('');
      //   e.preventDefault();

    }else{
        barcodeBuffer += e.key;
    }
});


$(document).on('click','.cancel',function(e){
  var TotalPriceArr = $('#tableData tr .totalPrice').get();
  if (TotalPriceArr == 0){
    return 0;
  }else{
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
      }
    });
  }
});
/*
function out(){
  var lag = "logout";
  swal({
      title: "Logout?",
      icon: "warning",
      buttons: ["Cancel","Yes"],
      dangerMode: true,
    })
    .then((value) => {
      if(value){
        if(lag){
            $.ajax({
              type: 'post',
              data: {
                logout:lag
              },
              url: 'server/connection.php',
              success: function (data){
                window.location.href='index.php';
              }
            });
        }
      }
    })
};*/
 
</script>