<?php 
 include('headem.php');
 include('insert_sales.php');

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
</style>

<div class="container-fluid py-3">
    <form action="" id="supplierlin">
        <div class="row mb-3">
            <div class="col-md-12">
                <div class="pos-card p-2 px-3 d-flex justify-content-between align-items-center bg-pos-dark" style="border-radius: 8px;">
                    <div class="small">
                        <span class="me-3"><i class="fas fa-user-shield me-2 text-info"></i>Cashier: <strong><?php echo $FullName;?></strong></span>
                        <span><i class="fas fa-calendar-alt me-2 text-info"></i>Date: <strong><?php echo date("Y-m-d"); ?></strong></span>
                    </div>
                    <input type="hidden" name="days" id="days" value="<?php echo $days; ?>">
                    <input type="hidden" name="month" id="month" value="<?php echo $monthname; ?>">
                    <input type="hidden" name="year" id="years" value="<?php echo $y; ?>">
                    <input type="hidden" id="user" name="salername" value="<?php echo $EmpID;?>">
                    <input type="hidden" name="datee" id="datee" value="<?php echo date('Y-m-d') ?>">
                </div>
            </div>
        </div>

        <div class="row g-3">
            <div class="col-lg-7">
                <div class="pos-card p-3 shadow-sm h-100">
                    <div class="row mb-2 align-items-end">
                        <div class="col-md-7">
                            <label class="form-label fw-bold small text-uppercase mb-1">Customer</label>
                            <input type="text" class="form-control form-control-sm customer_search" id="customer_search" placeholder="Search customer..." name="customername" required autocomplete="off">
                        </div>
                        <div class="col-md-5 text-end">
                            <button type="button" class="btn btn-outline-primary btn-sm" id="new_customer">
                                <i class="fas fa-user-plus"></i> New
                            </button>
                        </div>
                    </div>

                    <div class="table-wrapper-scroll-y my-custom-scrollbar-a mb-3" style="height: 500px;">
                        <table class="table table-sm table-hover align-middle small"   id="table2">
                            <thead>
                                <tr class="text-center" style="font-size: 1.0rem;">
                                    <th>Barcode</th>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Unit</th>
                                    <th>Qty</th>
                                    <th>Total</th>
                                    <th><i class="fas fa-times"></i></th>
                                </tr>
                            </thead>
                            <tbody id="tableData" style="font-size: 1.50rem;"></tbody>
                        </table>
                    </div>

                    <div class="border-top pt-3">
                        <div class="row g-2 align-items-center">
                            <div class="col-md-2 ">
                                <label class="fw-bold d-block text-center">Disc. %</label>
                                <input class="form-control form-control-sm text-center fw-bold py-4" type="number" name="discount" value="0" min="0" id="discount">
                            </div>
                            
                            <div class="col-md-3">
                                <div class="p-1 py-4 border rounded bg-light text-center">
                                    <div class="form-check form-check-inline m-0 me-2">
                                        <input class="form-check-input" type="radio" name="typeofcash" value="1" id="typeofcash" style="transform: scale(0.8);">
                                        <label class="form-check-label small" for="typeofcash" style="font-size: 1.75rem;">Cash</label>
                                    </div>
                                    <div class="form-check form-check-inline m-0">
                                        <input class="form-check-input" type="radio" name="typeofcash" value="2" id="typeofcash1" style="transform: scale(0.8);">
                                        <label class="form-check-label small" for="typeofcash1" style="font-size: 1.75rem;">E-Cash</label>
                                    </div>
                                </div>
                            </div>

                             <div class="col-md-3">
                                <button type="button" name='enter' class="Enter btn btn-success w-100 py-4 fw-bold small">
                                    <i class="fas fa-check me-1"></i> FINISH
                                </button>
                            </div>

                            <div class="col-md-4">
                                <div class="bg-danger text-white rounded px-3 py-4 text-center">
                                    <small class="text-uppercase d-block" style="font-size: 0.90rem; opacity:0.7">Grand Total</small>
                                    <span id="totalValue" class="fw-bold" style="font-size: 2.2rem;">0.00</span>
                                    <input type="hidden" class="mult2" id="totalvaluein" name="grandtotal">
                                    <input type="hidden" id="totalValue1"> 
                                    <input type="hidden" class="mult1" id="totalvaluer1in" name="totalsale">
                                </div>
                            </div>

                           
                        </div>
                        
                        <div class="text-center mt-2">
                            <a href="javascript:void(0)" class="cancel text-danger  small text-decoration-none" style="font-size: 1.25rem;">
                                <i class="fas fa-ban me-1"></i> Cancel Order
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="pos-card p-3 shadow-sm h-100">
                    <label class="form-label fw-bold small text-uppercase mb-1">Product Search</label>
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text bg-white border-end-0"><i class="fas fa-search"></i></span>
                        <input class="form-control border-start-0" type="text" placeholder="Search items by barcode or name or ID........." autofocus id="search" onkeyup="loadproducts();"/>
                    </div>

                    <div class="table-wrapper-scroll-y my-custom-scrollbar" style="height: 480px;">
                        <table class="table table-sm table-hover small" id="table1">
                            <thead class="table-light" style="font-size: 1.0rem;">
                                <tr>
                                    
                                     <th>Barcode</th>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Unit</th>
                                    <th>Qty</th>
                                    <th>Ex Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody style="font-size: 1.50rem;" id="products"></tbody>
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
      var barcode = target.attr('data-barcode');
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
            $('#tableData').append("<tr class='prd'><td input class='barcode text-center'>"+barcode+"</td><td class='text-center'>"+product+"</td><td class='price text-center'>"+accounting.formatMoney(price,{symbol:"Ghc",format: "%s %v"})+"</td><td class='text-center'>"+unit+"</td><td class='qty text-center'>"+value+"</td><td class='totalPrice text-center'>"+accounting.formatMoney(total,{symbol:"Ghc",format: "%s %v"})+"</td><td class='text-center p-1'><button class='btn btn-danger btn-sm' type='button' id='delete-row'><i class='fas fa-times-circle'></i></button><tr>");
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
              // alert(data)
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
                  location.reload()
               },500)
              },500)
            },500)
                 

                    }
                  })
                }else{
                  window.location.href='mainpa.php?'+data;
                }
                
              }
            });
          }
        }
      }
    });
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