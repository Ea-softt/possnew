<?php 
 include 'server/config.php'; 
include 'easoftsql.php'; 




if(isset($_GET['supplier_id'])){
$qry = $conn->query("SELECT * FROM supplier where supplier_id= ".$_GET['supplier_id']);
foreach($qry->fetch(PDO::FETCH_ASSOC) as $k => $val){
    $$k=$val;
    $meta[$k] = $val;
}
}

?>


<!-- ms-sm-auto col-lg-10 px-md-4 -->
    <main class="w-100">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mb-2 border-bottom">
        <h1 class="h2">New Suppliers </h1>
        
      </div>

      <div class="container">   

       




<div id="msg" class="form-group"></div>
<form action="" id="new_supplier">
         <div class="row "> 
      
                <div class="col-lg-7  ">
                <table class="table-responsive mt-5">
                        <tbody>
                                <tr>
                                <td  valign="baseline">ID:</td>
                                <td class="pl-5 pb-2"><div class="input-group"><div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><i class="fas fa-id"></i></span></div><input type="text" name="id" id="id" class="form-control-sm form-control" 
                                value="<?php echo isset($supplier_id) ? $supplier_id : '' ?>" readonly=""></div></td>

                                </tr>
                                 <tr>
                                <td  valign="baseline">Company Name:</td>
                                <td class="pl-5 pb-2"><div class="input-group"><div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><i class="fas fa-pen-alt"></i></span></div><input type="text" name="cname" class="form-control-sm form-control" value="<?php echo isset($companyname) ? $companyname : '' ?>" placeholder="Enter Company Name" required></div></td>
                            </tr>
                              <tr>
                                <td  valign="baseline">First Name:</td>
                                <td class="pl-5 pb-2"><div class="input-group"><div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><i class="fas fa-pen-alt"></i></span></div><input type="text" name="fname" class="form-control-sm form-control" pattern="[A-Za-z]+" title="Name must not contain numbers or spaces e.g John12" placeholder="Enter Firstname"  value="<?php echo isset($firstname) ? $firstname : '' ?>"  required></div></td>
                            </tr>
                            <tr>
                                <td  valign="baseline">Last Name:</td>
                                <td class="pl-5 pb-2"><div class="input-group"><div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><i class="fas fa-pen-alt"></i></span></div><input type="text" name="lname" class="form-control-sm form-control" pattern="[A-Za-z]+" title="Name must not contain numbers or spaces e.g John12" placeholder="Enter Lastname"  value="<?php echo isset($lastname) ? $lastname : '' ?>"  required></div></td>
                            </tr>
                            <tr>
                                <td  valign="baseline">Address:</td>
                                <td class="pl-5 pb-2"><div class="input-group"><div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><i class="fas fa-map-marker-alt"></i></span></div><textarea name="address" required class="form-control-sm form-control" pattern="[A-Za-z0-9]+"  placeholder="Enter Adderss"  cols="23" value="<?php echo isset($address) ? $address : '' ?>"  ><?php echo isset($address) ? $address : '' ?> 
                                    
                                </textarea></div></td>
                            </tr>
                            <tr>
                                <td  valign="baseline">Contact Number:</td>
                                <td class="pl-5 pb-2"><div class="input-group"><div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><i class="fas fa-phone"></i></span></div><input type="text" name="number" class="form-control-sm form-control"  value="<?php echo isset($contact_number) ? $contact_number : '' ?>"  placeholder="Enter Contact number" required></div></td>
                            </tr>
                        </tbody>
                    </table>

</div>
<div class="col-lg-5 border-right">

        <div class="form-group">
        <img src="<?php echo isset($meta['image']) ? '../img/'.$meta['image'] :'' ?>" alt="" id="cimg">     
        </div>

        <div class="form-group">
        <label for="" class="control-label">Image</label>
         <input type="file" class="form-control" name="img" onchange="displayImg(this,$(this))">
        </div>
</div>
<div class="modal-footer">
        <button type="submit" class="btn btn-primary" id="submit"><i class="fas fa-thumbs-up"></i>&nbsp;&nbsp;Save</button>
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="fas fa-ban"></i>&nbsp;&nbsp;Cancel</button>
      </div>




</div>








</div>

</form>
     
        </div>


<style>
    img#cimg{
        max-height: 27vh;
        max-width: 13vw;
    }
</style>

<script>

  
function displayImg(input,_this) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#cimg').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

 
   
    
    $(document).on('submit', '#new_supplier', function(e) {
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
        placeholder:"Please Select here",
        width:'100%'
    })
</script>