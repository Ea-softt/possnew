<?php
include('head.php');
// include('procon.php');

?>


   
<!-- ms-sm-auto col-lg-10 px-md-4 -->
    <main class="w-100">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mb-2 border-bottom">
        <h1 class="h2" style="margin-left: 15%">Product Information</h1>
        
      </div>

      

          <div id="live_data">          

          </div>

       
      


        </div>
      </div>
      
<script>





  $(document).ready(function(){


 

   function fetch_data(){

    $.ajax({
            url:"procon.php",
            method: "POST",
            success:function(data){
           
              $('#live_data').html(data);
                $('#mytable').ddTableFilter();
              $('.table').dataTable();

                      }
    })



   }
fetch_data();
$(document).on('click', '#btn_add', function(){
  var product_no = $('#product_no').text();
 var product_name = $('#product_name').text();
 var sell_price = $('#sell_price').text();
 var quantity = $('#quantity').text();
 var unit = $('#unit').text();

 var min_stocks = $('#min_stocks').text();
 var remarks = $('#remarks').text();
 var location = $('#location').text();
 var images = $('#images').text();

if(product_no == ""){
swal("Warning","Please Enter Barcode Number!","warning");
     return false;
        }
if(product_name == ""){
swal("Warning","Please Enter Product Name !","warning");
     return false;
        }
if(sell_price == ""){
swal("Warning","Please Enter Sell Price !","warning");
     return false;
        }

       
if(quantity == ""){
swal("Warning","Please Enter quantity !","warning");
     return false;
        }
if(unit == ""){
swal("Warning","Please Enter Unit !","warning");
     return false;
        }
        if(min_stocks == ""){
swal("Warning","Please Enter Min Stocks !","warning");
     return false;
        }

        
$.ajax({
      url:'server/insert_product.php',   
      method: "POST",
      data:{product_no:product_no, product_name:product_name, sell_price:sell_price, quantity:quantity, unit:unit, min_stocks:min_stocks, remarks:remarks, location:location, images:images},
      dataType:"text",
      success:function(data)   
      {
       
           if(data = "Data Inserted"){                 
                  alert_toast("Data successfully saved.",'success')
                        setTimeout(function(){
                            location.reload()
                        },900)
                }                
      fetch_data();


      }

})

});


function edit_data(product_no, text, column_name)
{

swal({
      title: "Are You Sure of the Changes if not, Cancel and Reload?",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })

.then((willedite) => {
      if (willedite) {

  $.ajax({
    url:'easoftfun.php?action=productedit',
    method:"POST",
    data:{product_no:product_no, text:text, column_name:column_name},
    dataType:"text",
    success:function(data)
    {
      
      if(data = "data update"){                 
                  alert_toast("Data successfully update.",'success')
                        setTimeout(function(){
                            location.reload()
                        },900)
                }
        }
    
  });


}
});
}

$(document).on('blur', '.product_no', function(){  
var product_no1 = $(this).data("product_no");
var product_no = $(this).text();
if(product_no== ""){
swal("Warning","Please Enter Barcode ! or Reload the Page","warning");    
     return false;
        }
edit_data(product_no1, product_no, "product_no");
});


$(document).on('blur', '.product_name', function(){
var product_no = $(this).data("product_name");
var product_name = $(this).text();
if(product_name== ""){
swal("Warning","Please Enter Product Name ! or Reload the Page","warning");    
     return false;
        }
edit_data(product_no,product_name, "product_name");
});


$(document).on('blur', '.sell_price', function(){
var product_no = $(this).data("sell_price");
var sell_price = $(this).text();
if(sell_price== ""){
swal("Warning","Please Enter Sell Price ! or Reload the Page","warning");    
     return false;
        }
edit_data(product_no, sell_price, "sell_price");
});


$(document).on('blur', '.quantity', function(){
var product_no = $(this).data("quantity");
var quantity = $(this).text();
if(quantity== ""){
swal("Warning","Please Enter quantity ! or Reload the Page","warning");    
     return false;
        }
edit_data(product_no, quantity, "quantity");
});


$(document).on('blur', '.unit', function(){
var product_no = $(this).data("unit");
var unit = $(this).text();
if(unit== ""){
swal("Warning","Please Enter Unit ! or Reload the Page","warning");    
     return false;
        }
edit_data(product_no, unit, "unit");
});


$(document).on('blur', '.min_stocks', function(){
var product_no = $(this).data("min_stocks");
var min_stocks = $(this).text();
if(min_stocks== ""){
swal("Warning","Please Enter Min Stocks ! or Reload the Page","warning");    
     return false;
        }
edit_data(product_no, min_stocks, "min_stocks");
});


$(document).on('blur', '.remarks', function(){
var product_no = $(this).data("remarks");
var remarks = $(this).text();
if(remarks== ""){
swal("Warning","Please Enter Remarks ! or Reload the Page","warning");    
     return false;
        }       
edit_data(product_no, remarks, "remarks");

});


$(document).on('blur', '.location', function(){
var product_no = $(this).data("location");
var location = $(this).text();
if(location== ""){
swal("Warning","Please Enter Location ! or Reload the Page","warning");    
     return false;
        }

        




edit_data(product_no, location, "location");
});


$(document).on('blur', '.images', function(){
var product_no = $(this).data("images");
var images = $(this).text();
if(images== ""){
swal("Warning","Please Enter Images ! or Reload the Page","warning");    
     return false;
        }
edit_data(product_no, images, "images");
});



$(document).on('click', '.btn_delete', function(){

var product_no = $(this).data("delete_btn");

//if(confirm("Are You Sure You Want To Delete This?")){

 swal({
      title: "Are You Sure To Delete This Item From The Table?",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })

 .then((willDelete) => {
      if (willDelete) {
        $.ajax({
      url:"delete.php",
      method:"POST",
      data:{product_no:product_no},
      dataType:"text",
      success:function(data){    
       

        if(data = "Data delete"){                 
                  alert_toast("Data successfully delete.",'danger')
                        setTimeout(function(){
                            location.reload()
                        },900)
                }      
      }

    });        
        swal("Removed Successfully!", {
          icon: "success",
        });
           fetch_data();
      }
  });




//}


//$('mytable').ddTableFilter();
  });


});

 $('#SupplierDeliverlist').click(function(){
    uni_modal("Suppliers Entry","SupplierDeliverlistcontrol.php",'large')
    
  })










</script>



