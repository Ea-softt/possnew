<?php 
 include 'server/config.php'; 
include 'easoftsql.php'; 




if(isset($_GET['sid'])){
$qry = $conn->query("SELECT w.*, s.* FROM warehouse w inner join supplier s on w.supplierid = s.supplier_id  where sid=".$_GET['sid']);
foreach($qry->fetch_array() as $k => $val){
    $$k=$val;
    $meta[$k] = $val;
}
}

?>


<!-- ms-sm-auto col-lg-10 px-md-4 -->
    <main class="w-100">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mb-2 border-bottom">
        <h1 class="h2">Edit Item </h1>
        
      </div>

      <div class="container">   

       




<div id="msg" class="form-group"></div>
<form action="" id="new_warehouse">
         <div class="row "> 
      
                <div class="col-lg-7  ">
                <table class="table-responsive mt-5">
                        <tbody>
                                <tr>
                                <td  valign="baseline">ID:</td>
                                <td class="pl-5 pb-2"><div class="input-group"><div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><i class="fas fa-id"></i></span></div><input type="text" name="sid" id="sid" class="form-control-sm form-control" 
                                value="<?php echo isset($sid) ? $sid : '' ?>" readonly=""></div></td>

                                </tr>

                                <tr>
                                     <div class="form-group">
                <label for="" class="control-label">Company Name</label>        
           
            <select name="companynameid" id="companynameid" class="custom-select input-sm select2"  cols="30" rows="4" required=""> <!-- onchange="FetchState(this.value) -->
               
                <option selected="" value="<?php echo isset ($supplierid)? $supplierid :'' ?>"><?php echo isset ($companyname)? $companyname:'' ?></option>
                 <?php
                    $query = "SELECT * FROM supplier";
                    $result = $conn->query($query);
                   if ($result->num_rows > 0) {
                    while($row= $result->fetch_assoc()){                    
             
                    }
                  }
                    ?>          
                    <?php
                    $fees = $conn->query("SELECT * FROM supplier");

                    while($row= $fees->fetch_assoc()):
                        
                ?>
                <option value="<?php echo $row['supplier_id'] ?>" ><?php echo  $row['supplier_id'].' | '.ucwords($row['companyname']) ?></option>
                <?php endwhile; ?>              
            </select>

            </div>




                                </tr>


<!-- 
<input type="text" name="name" class="form-control-sm form-control" aria-label="Search" id="search" value="<?php echo isset($name) ? $name : '' ?>" placeholder="Enter Product Name" required="" onkeyup="loadpro();"/>
 -->



                                 <tr>
                                <td  valign="baseline">Product Name:</td>
                                <td class="pl-5 pb-2"><div class="input-group"><div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><i class="fas fa-pen-alt"></i></span></div> <input class="form-control-sm form-control" name="name" value="<?php echo isset($name) ? $name : '' ?>"  type="text" placeholder="Enter Product Name" aria-label="Search" id="search" required=""  onkeyup="loadpro();"/>
                             </div></td>
                            </tr>

                             

                              <tr>
                                <td  valign="baseline">Quantity</td>
                                <td class="pl-5 pb-2"><div class="input-group"><div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><i class="fas fa-pen-alt"></i></span></div><input type="number" name="quantity" class="form-control-sm form-control quantity" id="quantity" pattern="[A-Za-z]+" title="Name must not contain numbers or spaces e.g John12" placeholder="Quantity"  value="<?php echo isset($quantity) ? $quantity : '' ?>"  required></div></td>
                            </tr>
                            <tr>
                                <td  valign="baseline">Cost</td>
                                <td class="pl-5 pb-2"><div class="input-group"><div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><i class="fas fa-pen-alt"></i></span></div><input type="number" name="price" class="form-control-sm form-control" id="cost" pattern="[A-Za-z]+"  placeholder="price"  value="<?php echo isset($price) ? $price : '' ?>"  required></div></td>
                            </tr>
                            <tr>
                                <td  valign="baseline">TCost</td>
                                <td class="pl-5 pb-2"><div class="input-group"><div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><i class="fas fa-pen-alt"></i></span></div><input type="text" name="multtota" class="form-control-sm form-control tcost" id="tcost" pattern="[A-Za-z]+"  placeholder="TCost"  value="<?php echo isset($multtota) ? $multtota : '' ?>"  required readonly></div></td>
                            </tr>
                            <tr>
                                <td  valign="baseline">Unit</td>
                                <td class="pl-5 pb-2"><div class="input-group"><div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><i class="fas fa-pen-alt"></i></span></div><input type="text" name="unit" class="form-control-sm form-control" pattern="[A-Za-z]+" title="Unit must contain numbers or spaces e.g John12" placeholder="Unit"  value="<?php echo isset($unit) ? $unit : '' ?>"  required></div></td>
                            </tr>
                            
                            <tr>
                                <td  valign="baseline">Description:</td>
                                <td class="pl-5 pb-2"><div class="input-group"><div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><i class="fas fa-pen-alt"></i></span></div><input type="text" name="description" class="form-control-sm form-control"  value="<?php echo isset($description) ? $description
                                 : '' ?>"  placeholder="Description" required></div></td>
                            </tr>
                             <tr>
                                <td  valign="baseline">Expire Date:</td>
                                <td class="pl-5 pb-2"><div class="input-group"><div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><i class="fas fa-pen-alt"></i></span></div><input type="date" name="expire_date" class="form-control-sm form-control"  value="<?php echo isset($expire_date) ? $expire_date : '' ?>"  placeholder="Expire Date" required>

                                </div></td>
                                 
                            </tr>
                        </tbody>
                    </table>

</div>

<div class="col-lg-5 border-right">
            

         

        <div class="form-group">
        <img src="<?php echo isset($meta['picture']) ? '../img/'.$meta['picture'] :'' ?>" alt="" id="cimg">     
        </div>

        
         <div class="form-group">
        <label for="" class="control-label">Image of item</label>
         <input type="file" class="form-control" name="img" onchange="displayImg(this,$(this))">
        </div>

       <!--  <input type="date" name="expire_date" class="form-control-sm form-control"  value="<?php echo date('Y-m-d') ?>"  placeholder="Expire Date" required> -->

<div class="modal-footer m-5">
    
    <button type="button" class="btn btn-primary" id='submit' onclick="$('form').submit()"><i class="fas fa-thumbs-up">&nbsp&nbsp</i>Save</button>
<button type="button" id="cancel" class="btn btn-danger" ><i class="fas fa-ban">&nbsp&nbsp</i>Cancel</button>
</div>

 <div id="products">    
     
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
        max-height: 30vh;
        max-width: 15vw;
    }
</style>

<script>

  function loadpro(){
  var name = $("#search").val();
  if(name){
    $.ajax({
      type: 'post',
      data: {
        products:name,
      },
      url: 'warehousecontrolcheck.php',
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

       reader.readAsDataUR(input.files[0]);
    }
}

   $("#cost, #quantity").keyup(function(){
 var multtotal1 = 0;
 var x = Number($("#cost").val());
 var y = Number($("#quantity").val());
 var multtotal1= x * y;

 $("#tcost").val(multtotal1);

});

$(document).on('click', '#cancel', function(){
   swal({
      title: "Close Page?",
      text: "By doing this,will close the page!",
      icon: "warning",
      buttons: ["No","Yes"],
      dangerMode: true,
    })
   .then((reload) => {
      if (reload) {
        location.reload();
        window.location.href='warehousepage.php?'
      }
    });
    

});

  
    $('#new_warehouse').submit(function(e){
        e.preventDefault()
        start_load()


        $('#msg').html('')
      if($.trim($('#companynameid').val()).length == 0){
      swal("Warning","Please Select Supplier!","warning");
      return false;
    }
      
        $.ajax({
            url:'easoftfun.php?action=new_warehouse',
            data: new FormData($(this)[0]),
            cache: false,
            contentType: false,
            processData: false,
            method: 'POST',
            type: 'POST',
            success:function(resp){
                alert('opwoepw');
                if(resp==1){
                    alert_toast("Data successfully saved.",'success')
                        setTimeout(function(){
                             uni_modal("New Product Entry","warehousecontrol.php",'small')
                        },1000)
                }else if(resp == 2){
                $('#msg').html('<div class="alert alert-danger mx-2">Already exist.</div>')
                end_load()
                }   
            }
        })
    })
</script>