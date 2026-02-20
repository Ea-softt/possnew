<?php 
 include 'server/config.php'; 
include 'easoftsql.php'; 
include('insert_stockdrop.php');
//include('stockdropdown.php');

?>


<!-- ms-sm-auto col-lg-10 px-md-4 -->
<main class="w-100">    

<div class="container">   

<div id="msg" class="form-group"></div>
<form action="" id="productts">
         <div class="row "> 
      
                <div class="col-lg-7 border-right  ">
                  

  
    <div class="form-group">
          
              <input type="hidden" id="location" class="location" name="location" value="<?php echo date('s', strtotime('now'));?>">
            
            </div>    

    <!--      
     <div id="products"> 
        
     </div> -->
     
                <div>
    <!--  <?php
        if (isset($_POST['search'])){
            $name = $_POST['search'];
           
                $show   = "SELECT * FROM warehouse WHERE name LIKE '$name%' AND quantity > 0 OR sid = '$name' AND quantity > 0";
                        $query  = mysqli_query($conn,$show);
                             if(mysqli_num_rows($query)>0){
                                 while($row = mysqli_fetch_array($query)){
                                                                 }
                                                            }
        }?>

 -->






                   <!--  <div class="row "> -->
                    <!--     <div class="form-group">
                         <b><label class="control-label col-sm-2" for="product">Product:</label></b>
                         <div class="col-sm-10">
                      <input autocomplete="OFF" type="text" class="form-control" id="product" name="product" value="<?php echo $row['name'];?>">
                         </div>
                         </div>


                <div class="form-group">
                        <b><label class="control-label col-sm-2" for="product_id">Quantity:</label></b>
                        <div class="col-sm-10">
                        <input autocomplete="OFF" type="text" class="form-control" id="quantity" name="product_id" value="<?php echo $row['name'];?>">
                         </div>
                         </div>

               <div class="form-group">
                     <b><label class="control-label col-sm-2" for="rate">Cprice</label></b>
                      <div class="col-sm-10">          
                     <input autocomplete="OFF" type="text" class="form-control" id="cprice"  name="cprice" value="<?php echo $row['name'];?>">
                         </div>
                         </div>

                <div class="form-group">
                     <b><label class="control-label col-sm-2" for="rate">Tcost</label></b>
                      <div class="col-sm-10">          
                     <input autocomplete="OFF" type="text" class="form-control" id="tcost"  name="tcost" value="<?php echo $row['name'];?>">
                         </div>
                         </div>
                         

                <div class="form-group">
                     <b><label class="control-label col-sm-2" for="rate">Picture</label></b>
                      <div class="col-sm-10">          
                     <input autocomplete="OFF" type="text" class="form-control" id="picture"  name="picture" value="<?php echo $row['name'];?>">
                         </div>
                         </div>
                         </div>


                <div class="col-lg-4 border-right">
                    <div class="form-group">
                     <b><label class="control-label col-sm-2" for="rate">Unit</label></b>
                      <div class="col-sm-10">          
                     <input autocomplete="OFF" type="text" class="form-control" id="unit"  name="unit" value="<?php echo $row['name'];?>">
                         </div>
                         </div>

                <div class="form-group">
                     <b><label class="control-label col-sm-2" for="rate">ExpireDate:</label></b>
                      <div class="col-sm-10">          
                     <input autocomplete="OFF" type="text" class="form-control" id="expiredate"  name="expiredate" value="<?php echo $row['name'];?>">
                         </div>
                         </div>

               <div class="form-group">
                     <b><label class="control-label col-sm-2" for="rate">SPrice</label></b>
                      <div class="col-sm-10">          
                     <input autocomplete="OFF" type="text" class="form-control" id="sprice"  name="sprice" >
                         </div>
                         </div>


                <div class="form-group"><b>
                    <label class="control-label col-sm-2" for="print_qty">Barcode</label></b>
                     <div class="col-sm-10">          
                       <input autocomplete="OFF" type="print_qty" class="form-control" id="barcode"  name="barcode" required="">
                         </div>
                        </div>
                        </div>
                         
                

           <div class="col-lg-4 ">
                    <div class="form-group">
                     <b><label class="control-label col-sm-2" for="rate">Min_stock</label></b>
                      <div class="col-sm-10">          
                     <input autocomplete="OFF" type="text" class="form-control" id="min_stock"  name="min_stock" >
                         </div>
                         </div>';

             <div class="form-group">
                     <b><label class="control-label col-sm-2" for="rate">location</label></b>
                      <div class="col-sm-10">          
                     <input autocomplete="OFF" type="text" class="form-control" id="location"  name="location" >
                         </div>
                         </div>


 -->


            
                    <!-- <div class="form-group">
                     <b><label class="control-label col-sm-2" for="rate">Remark</label></b>
                      <div class="col-sm-10">          
                     <input autocomplete="OFF" type="text" class="form-control" id="remark"  name="remark" >
                         </div>
                         </div> -->
</div>

    <div id="content" class="mr-15">
      <div id="price_column" class="m-2 table-responsive-sm table-wrapper-scroll-y my-custom-scrollbar-a">
        <!-- id="mytable" class="table table-condensed table-bordered table-hover -->
        <table  class="w-100 font-weight-bold" style="cursor: pointer;" >
          <thead>
            <tr class='text-center'>
                <th>ID</th>
              <th>Barcode</th>
              <th>SPrice</th>
              <th>min_stock</th>
              <th>Product</th>
              <th>CPrice</th> 
              <th>Qty</th>                         
              <th>Unit</th>             
              
              <th>Expirdate</th>
              <th>Sub.Total</th>             
              <th>Description</th>
             

            </tr>
          </thead>
          <tbody id="tableData1">     
                
          
          </tbody>        


        </table>
       
      </div>
      
      
    </div>
                         </div>
                         

<div class="col-lg-5"> 
    <div id="sidebar">      
      <div class="mb-60 ">
     <!--  <div class="input-group"><div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><i class="fas fa-search"></i></span></div>
          <input class="form-control" type="text" placeholder="Product Search" autofocus aria-label="Search" id="search1" onfocus="this.value=''"  onkeyup="loadprod();"/>
        </div> -->
         <!--   <input class="form-control" name="images" type="text" placeholder="images" id="images" class="images" value="the"> -->

        </div>
        
      <div id="product_area" class="table-responsive-sm mt-2 table-wrapper-scroll-y my-custom-scrollbar" >

        <!-- id="mytable" class="table table-condensed table-bordered table-hover -->
        <table id="mytable" class="table tablet table-condensed table-bordered table-hover  font-weight-bold" style="cursor: pointer;" >
          <thead>
            <tr claclass='text-center text-black'><b>
            <th class="text-center" id="checkbox1">
            <input class="checkbox" type="checkbox"  id="selectall">
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
           </b></tr>
            </thead>
            <tbody>
              <?php 
                 $i = 1;
                 $student = $conn->query("SELECT * FROM warehouse order by quantity asc ");
                    while($row=$student->fetch_assoc()):
                        ?>
                <tr >
                   

                <td class="text-center" id="checkbox1">
                <input class="checkbox" type="checkbox" name="check" id="num1" value="">
                </td>   

                <td class="text-center" name="check"><?php echo $row['sid'] ?></td>
                <td class="text-center" name="check"><?php echo $row['name'] ?></td>
                
                <td class="text-center" name="check"><?php echo $row['price'] ?></td>
                <td class="text-center" name="check"><?php echo $row['quantity'] ?></td>
                <td class="text-center" name="check"><?php echo $row['unit'] ?></td>
                
                <td class="text-center" name="check" style="display:none;"><?php echo $row['description'] ?></td>

                <td class="text-center" name="check" style="display:none;"><?php echo $row['expire_date'] ?></td>

                <td class="text-center" name="check"style="display:none;"><?php echo $row['multtota'] ?></td>
                <td class="text-center" name="check" style="display:none;"><?php echo $i++ ?></td>

                <td class='text-center p-1'><button class='btn btn-danger btn-sm' type='button' id='delete-row'><i class='fas fa-times-mark'>x</i></button></td>          


                </tr>
                <?php endwhile; ?>
            </tbody>          
        </table>
      </div>     
    </div>
 </div>

            

</div>


</form>
    
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-primary" id='submit'><i class="fas fa-thumbs-up">&nbsp&nbsp</i>Save</button>
<button type="button" id="cancel" class="btn btn-danger" ><i class="fas fa-ban">&nbsp&nbsp</i>Cancel</button>
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
      var product = $(this).parent().nextAll('td').eq(1).html(); 
      var price = $(this).parent().nextAll('td').eq(2).html();    
      var quantity = $(this).parent().nextAll('td').eq(3).html(); 
      var  unit= $(this).parent().nextAll('td').eq(4).html();
      var description = $(this).parent().nextAll('td').eq(5).html();    
      var expiredate = $(this).parent().nextAll('td').eq(6).html(); 
      var multtota = $(this).parent().nextAll('td').eq(7).html(); 
      var barc = $(this).parent().nextAll('td').eq(8).html(); 
      var add = parseFloat(1.5);
      var add1 =  parseFloat(price)
       var sprice = (add1+add);
       var dateee = $("#location").val();
       var datee = dateee++;
      


      sendToNum.append("<tr class='prd'><td class='sid text-center' contenteditable>"+sid+"</td><td class='barcode text-center' contenteditable>"+sid+""+dateee+""+barc+"</td><td class='sprice text-center' contenteditable>"+sprice+"</td><td class='min_stock text-center' contenteditable>"+quantity+"</td><td class='product text-center' contenteditable>"+product+"</td><td class='cprice text-center'contenteditable>"+accounting.formatMoney(price,{symbol:"Ghc",format: "%s %v"})+" </td><td class='quantity1 text-center' contenteditable>"+quantity+"</td><td class='unit1 text-center'contenteditable>"+unit+"</td><td class='expiredate text-center' contenteditable>"+expiredate+"</td><td class='multtota text-center'contenteditable>"+accounting.formatMoney(multtota,{symbol:"Ghc",format: "%s %v"})+"</td></td><td class='description text-center' contenteditable>"+description+"</td><td class='text-center p-1'contenteditable></tr>");
      

    });
  });

var $selectAll = $('#selectall'); // main checkbox inside table thead
  var $table = $('.table'); // table selector 
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
      }
    });
    //window.location.href='product.php?'

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


            
            $('#tableData').append("<tr class='prd'><td class='sid text-center' contenteditable>"+sid+"</td><td class='barcode text-center' contenteditable></td><td class='sprice text-center' contenteditable></td><td class='min_stock text-center' contenteditable></td><td class='product text-center' contenteditable>"+product+"</td><td class='cprice text-center'contenteditable>"+accounting.formatMoney(price,{symbol:"Ghc",format: "%s %v"})+" </td><td class='unit text-center' contenteditable>"+unit+"</td><td class='quantity text-center'contenteditable>"+quantity+"</td><td class='expiredate text-center' contenteditable>"+expiredate+"</td><td class='multtota text-center'contenteditable>"+accounting.formatMoney(multtota,{symbol:"Ghc",format: "%s %v"})+"</td></td><td class='description text-center' contenteditable>"+description+"</td><td class='text-center p-1'contenteditable><button class='btn btn-danger btn-sm' type='button' id='delete-row'><i class='fas fa-times-circle'></i></button><tr>");
            

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
    var product = [];  
    var barcode = []; 
    var sprice = [];      
    var cprice = [];
    var unit1 = [];
    var quantity1 =[]; 
   // var product = $('#product').val();
    var multtota = []; 
    var description = []; 
    var picture = [];    
    
    var expiredate =[];       
    var min_stock = [];
    var location =  $('#location').val();
    var images = $('#images').val();
    
    
     $('.sid').each(function(){
        sid.push($(this).text());
     });
     $('.product').each(function(){
        product.push($(this).text());
    });

    $('.barcode').each(function(){
     barcode.push($(this).text());
     });
     
           
      $('.sprice').each(function(){
      sprice.push($(this).text().replace(/,/g, "").replace("Ghc",""));
         });     

      $('.cprice').each(function(){
      cprice.push($(this).text().replace(/,/g, "").replace("Ghc",""));
    });

    $('.unit1').each(function(){
         unit1.push($(this).text());

    });

   $('.quantity1').each(function(){
         quantity1.push($(this).text());

    });
    $('.expiredate').each(function(){
        expiredate.push($(this).text());

    });
    $('.min_stock').each(function(){
        min_stock.push($(this).text());
       });
    $('.description').each(function(){
        description.push($(this).text());
       });

 


       /* var qtynum = value;
        if(isNaN(qtynum)){
          swal("Error","Please enter a valid number!","error");
        }else if(qtynum == null){
          swal("Error","Entered None!","error");
        }else{
    if ($t <= "30"){
        echo "6";
      }
      else if ($t <= "40"){
        echo "5";
      }

      else if ($t <= "55"){
        echo "4";
      }
      else if ($t <= "65"){
        echo "3";
      }
      else if ($t <= "79"){
        echo "2";
      }
      else if ($t <= "100"){
        echo "1";
      }
      else if ($t <= "300"){
        echo "?";
      }



          */

         /* if(quantity1 <= min_stock){
             swal("Error","Min Stock can not be greater than the Qty!","error");         
           
          }else{*/
        

          //var product_no = $(this).data("min_stocks");
         // var min_stocks = $('.min_stocks').val();

          if(barcode== ""){
              swal("Warning","Please Enter Barcode ","warning");    
            return false;
            }

         if(sprice== ""){
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
        }

            $.ajax({
              url:"insert_stockdrop.php",
              method:"POST",        
              data:{product:product,barcode:barcode,sprice:sprice,cprice:cprice,unit1:unit1,quantity1:quantity1,expiredate:expiredate,sid:sid,min_stock:min_stock,description:description,images:images,location:location},
              success: function(data){
              // alert(data);
                
                if(data = "success"){  

                  alert_toast("Data successfully saved.",'success')
                        setTimeout(function(){
                            window.location.href='product.php?'+data;
                        },900)
                }
                else{
                  window.location.href='product.php?'+data;
                }   
                
              }

            });
          
        //window.location.href='productform.php'+data;
        // window.location.href='productform.php?'+data;
      /*$('#SupplierDeliverlist').click(function(){
    uni_modal("Suppliers Entry","SupplierDeliverlistcontrol.php",'large')
    
  })*/
    
  
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





</script>