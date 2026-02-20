<?php 
include 'server/config.php'; 
include 'easoftsql.php'; 


if(isset($_GET['customer_id'])){
$qry = $conn->query("SELECT * FROM customer where customer_id= ".$_GET['customer_id']);
foreach($qry->fetch_array() as $k => $val){
    $$k=$val;
    $meta[$k] = $val;
}
}
?>
<div id="msg" class="form-group"></div>
<form action="" id="new_customer">
         <div class="row "> 
      
                <div class="col-lg-7 border-right ">
                <table class="table-responsive mt-5">
                        <tbody>
                                <tr>
                                <td  valign="baseline">ID:</td>
                                <td class="pl-5 pb-2"><div class="input-group"><div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><i class="fas fa-id"></i></span></div><input type="text" name="id" class="form-control-sm form-control"   value="<?php echo isset($customer_id) ? $customer_id : '' ?>" readonly=""></div></td>

                                </tr>
                            <tr>
                                <td  valign="baseline">First Name:</td>
                                <td class="pl-5 pb-2"><div class="input-group"><div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><i class="fas fa-pen-alt"></i></span></div><input type="text" name="fname" class="form-control-sm form-control" value="<?php echo isset($firstnamec) ? $firstnamec : '' ?>"  pattern="[A-Za-z]+" title="Name must not contain numbers or spaces e.g John12" placeholder="Enter Firstname" required></div></td>
                            </tr>
                            <tr>
                                <td  valign="baseline">Last Name:</td>
                                <td class="pl-5 pb-2"><div class="input-group"><div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><i class="fas fa-pen-alt"></i></span></div><input type="text" name="lname" class="form-control-sm form-control" value="<?php echo isset($lastnamec) ? $lastnamec : '' ?>"  pattern="[A-Za-z]+" title="Name must not contain numbers or spaces e.g John12" placeholder="Enter Lastname" required></div></td>
                            </tr>
                            <tr>
                                <td  valign="baseline">Address:</td>
                                <td class="pl-5 pb-2"><div class="input-group"><div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><i class="fas fa-map-marker-alt"></i></span></div><textarea name="address" required class="form-control-sm form-control"  pattern="[A-Za-z0-9]+" placeholder="Enter Adderss"  cols="23"><?php echo isset($address) ? $address : '' ?></textarea></div></td>
                            </tr>
                            <tr>
                                <td  valign="baseline">Contact Number:</td>
                                <td class="pl-5 pb-2"><div class="input-group"><div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><i class="fas fa-phone"></i></span></div><input type="text" name="number" class="form-control-sm form-control" id="number" value="<?php echo isset($contact_number) ? $contact_number : '' ?>"  pattern='\d{10}' title='Phone Number (Format: +99(99)9999-9999)' placeholder="Enter Contact number" required></div></td>
                            </tr>
                        </tbody>
                    </table>

</div>
<div class="col-lg-5 ">

       <!--  <div class="form-group">
        <img src="<?php echo isset($meta['image']) ? '../img/'.$meta['image'] :'' ?>" alt="" id="cimg">     
        </div>

        <div class="form-group">
        <label for="" class="control-label">Image</label>
         <input type="file" class="form-control" name="img" onchange="displayImg(this,$(this))">
        </div> -->

            <div class="form-group text-center">
    <img src="<?php echo base64_decode($meta['image']) ? 'img/'.$meta['image'] :'' ?>" alt="customer Image" id="cimg" class="img-thumbnail mb-2">
    <div class="custom-file">
        <input type="file" class="custom-file-input form-control" name="img" id="img" onchange="displayImg(this,$(this))">
        <label class="custom-file-label" for="img">Choose file</label>
    </div>
</div>


</div>

</div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary" id="submit"><i class="fas fa-thumbs-up"></i>&nbsp;&nbsp;Save</button>
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="fas fa-ban"></i>&nbsp;&nbsp;Cancel</button>
      </div>

</form>








<style>
    img#cimg{
        max-height: 30vh;
        max-width: 15vw;
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



    $('#manage-course').on('reset',function(){
        $('#msg').html('')
        $('input:hidden').val('')
    })
    
   
    
    $('#new_customer').submit(function(e){
        e.preventDefault()
        start_load()
        $('#msg').html('')

        var number = $('#number').val();
        
           
         if(number == ''){
              swal("Warning","Please provide Phone Number","warning");    
            return false;
        }


        $.ajax({
            url:'easoftfun.php?action=new_customer',
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
                $('#msg').html('<div class="alert alert-danger mx-2">Already exist, So Check the Name And The Phone Number.</div>')
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