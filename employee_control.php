<?php 
include("server/config.php");

if(isset($_GET['EmpID'])){
$qry = $conn->query("SELECT * FROM newemployee where EmpID= ".$_GET['EmpID']);
foreach($qry->fetch_array() as $k => $val){
    $$k=$val;
     $meta[$k] = $val;
}
}

?>


<main class="container">


	
		<form action="" id="new_employe">
  		<div class="row">
  		<div class="col-lg-4 border-right"> 		
  		
  		
  		<div class="form-group" >
  		<label class="">ID:</label>
		<input class="form-control" type="text" id="EmpID" name="EmpID"  value="<?php echo isset ($EmpID)? $EmpID :''?>" readonly>	
	     </div>	   
	 	


	     <div class="form-group">
  		<label class="">Emp Name:</label>
		<input class="form-control"   type="text" id="FullName" name="FullName" placeholder="Full Name" required value="<?php echo isset ($FullName)? $FullName :''?>">			
		</div>

		
		<div class="form-group">
		<label class="">Date of Birth:</label>		
		<input class="form-control"  type="Date" id="DOB" name="DOB" placeholder="" required value="<?php echo isset ($DOB)? $DOB :''?>">		
		</div>

		<div class="form-group">
		<label class="">Age:</label>		
		<input class="form-control"  type="text" id="Age" name="Age" placeholder="" value="<?php echo isset ($Age)? $Age :''?>">		
		</div>
		
		 

		<div class="form-group ">
  		<label class="">Gender:</label>
		<select class="form-control" required style="font-size:15px;"  id="Gender" name="Gender">				
			<option selected="" disabled="" value="Select">--Select--</option>
			<option selected="" value="<?php echo isset($Gender)? $Gender :''?>"><?php echo isset($Gender)? $Gender :''?></option>
			<option value="Male">Male</option>
			<option value="Female">Female</option>
			<option value="Other">Other</option>
		</select>
		</div>

		<div class="form-group">
  		<label class="">Language Speak:</label>
		<input class="form-control" style="font-size:15px;" type="text" id="Language" name="Language" placeholder="Language Speak" value="<?php echo isset($Language)? $Language :''?>">
		</div>

		<div class="form-group">
  		<label class="">Hometown:</label>
		<input class="form-control" style="font-size:15px;" type="text" id="Hometown" name="Hometown" placeholder="Hometown" value="<?php echo isset($Hometown)? $Hometown :''?>" >			
		</div>

		<div class="form-group">
  		<label class="">Nationality:</label>
		<input class="form-control" style="font-size:15px;" type="text" id="Nationality" name="Nationality" required placeholder="Nationality" value="<?php echo isset($Nationality)? $Nationality :''?>">			
		</div>


		<div class="form-group">
  		<label class="">Religion:</label>
		<input class="form-control"  type="text" id="Religion" name="Religion" placeholder="Religion"  value="<?php echo isset ($Religion)? $Religion :''?>">			
		</div>		
		</div>

  		
  		
		<!-- school -->
		<div class="col-lg-4 border-right">
		<div class="form-group">
		<label class="">Name of Last School:</label>		
		<input class="form-control"  type="text" id="Lastschool" name="Lastschool" required placeholder="Last School"  value="<?php echo isset($Lastschool)? $Lastschool :''?>">		
		</div> 

		<div class="form-group">
  		<label class="">Qualification:</label>
		<select class="form-control"  type="text" id="Qualification" name="Qualification" required placeholder="Hometown" >	
		<option selected="" disabled="" value="--Select--">--Select--</option>
		<option selected="" value="<?php echo isset($Qualification)? $Qualification :''?>"><?php echo isset ($Qualification)? $Qualification :''?></option>
		<option  value="Some School Experienc">Some School Experienc</option>
		<option   value="Basic Cartificate">Basic Cartificate</option>
		<option  value="Vocational Cartificate">Vocational Cartificate</option>
		<option   value="Senior">Senior</option>
		<option  value="Diploma">Diploma</option>
		<option   value="Higher Diploma">Higher Diploma</option>
		<option  value="Degree">Degree</option>
		<option   value="Masters">Masters</option>
		<option  value="PHD">PHD</option>
		<option   value="Others">Others</option>
		</select>		
		</div>


		<div class="form-group">
  		<label class="">Phone Number:</label>
		<input class="form-control"  type="text" id="Phonenum" name="Phonenum" placeholder="Phone Number" value="<?php echo isset ($Phonenum)? $Phonenum :''?>">			
		</div>


		<div class="form-group">
  		<label class="">E-Mail:</label>
		<input class="form-control"  type="Mail" id="Mail" name="Mail" placeholder="E-Mail" value="<?php echo isset ($Mail)? $Mail :''?>" >			
		</div>

  		<div class="form-group">
  		<label class="">Address 1:</label>
		<textarea  class="form-control "  type="text" id="Address" name="Address" placeholder="Nationality" value="<?php echo isset ($Address)? $Address :''?>">	<?php echo isset($Address)? $Address :''?>	
		</textarea>
		</div>

		<div class="form-group">
  		<label class="">Address 2:</label>
		<textarea  class="form-control "  type="text" id="Address2" name="Address2" placeholder="Address2" value="<?php echo isset ($Address2)? $Address2 :''?>">	<?php echo isset ($Address2)? $Address2 :''?>	
		</textarea>
		</div>

		




		

		</div>





		

	    <!--picture-->
	    <div class="col-lg-4">
		<!-- <div class="form-group">
		<img src="<?php echo base64_decode($meta['picture']) ? '../img/'.$meta['picture'] :'' ?>" alt="" id="cimg">		
		</div>

  		
  		 <div class="form-group">
		<label for="" class="control-label">Image of Employee</label>
		 <input type="file" class="form-control" name="img" onchange="displayImg(this,$(this))">
		</div>
		 -->
		<div class="form-group text-center">
    <img src="<?php echo base64_decode($meta['picture']) ? 'img/'.$meta['picture'] :'' ?>" alt="Employee Image" id="cimg" class="img-thumbnail mb-2">
    <div class="custom-file">
        <input type="file" class="custom-file-input form-control" name="img" id="img" onchange="displayImg(this,$(this))">
        <label class="custom-file-label" for="img">Choose file</label>
    </div>
</div>




		<div class="form-group">
  		<label class="">Dapartment:</label>		
		
            <select class="form-control form-select select2" required  id="Department" name="Department">        
            <option class="text-center" selected="" disabled=""  value="Select">----Select----</option>
              <option class="text-center" selected=""  value="<?php echo isset ($Department)? $Department :''?>"><?php echo isset ($Department)? $Department :''?></option>
             <option  value="Admin">Admin</option>
		<option   value="Staff">Staff</option>
            </select>
		</div>

		<div class="form-group">
		<label class="">Starting Date:</label>		
		<input class="form-control"  type="Date" id="StartingDate" name="StartingDate" required placeholder="" value="<?php echo isset ($StartingDate)? $StartingDate :''?>">		
		</div>
 		<div class="form-group">
  		<label class="">Status:</label>
		<select class="form-control"  type="text" id="Status" name="Status" placeholder="Status" >	
		<option selected="" disabled="" value="--Select--">--Select--</option>
		<option selected="" value="<?php echo isset ($Status)? $Status :''?>"><?php echo isset($Status)? $Status :''?></option>
		<option  value="Active">Active</option>
		<option   value="Not active">Not active</option>
		</select>		
		</div>



		<div class="form-group">
  		<label class="">Name of Employer:</label>
		<input class="form-control"  type="text" id="Employer" name="Employer" placeholder="Employer" required  value="<?php isset ($Employer)? $Employer :''?>">			
		</div>


		




		</div>
		</div>
		<div class="modal-footer">
        <button type="submit" class="btn btn-primary" id="submit"><i class="fas fa-thumbs-up"></i>&nbsp;&nbsp;Save</button>
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="fas fa-ban"></i>&nbsp;&nbsp;Cancel</button>
      </div>
	</form>
	
	</main>

	<style>
	img#cimg{
		max-height: 30vh;
		max-width: 60vw;
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
 $(document).on('submit', '#new_employe', function(e) {
        e.preventDefault()
        start_load()
        $('#msg').html('')
        $.ajax({
            url:'easoftfun.php?action=new_employee',
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
                        },1500)
                }/*else if(resp == 2){
                $('#msg').html('<div class="alert alert-danger mx-2">ID # already exist.</div>')
                end_load()
                }  */ 
            }
        })
    })
$(document).ready(function() {
    $('.select2').select2({
        placeholder: 'Please select here',
        width: '100%'
    });
});


</script>