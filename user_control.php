<?php 
include('server/config.php');

if(isset($_GET['id'])){
$user = $conn->query("SELECT * FROM login where id =".$_GET['id']);
foreach($user->fetch_array() as $k =>$v){
	$meta[$k] = $v;
}
}
?>
<div class="container-fluid">
	<div id="msg"></div>
	
	<form action="" id="login_user">	
		<input type="hidden" name="id" value="<?php echo isset($meta['id']) ? $meta['id']: '' ?>">
		<div class="form-group">
			<label for="uid">Username</label>

			 <select name="uid" id="uid" class="custom-select input-sm" onchange="FetchState(this.value)" cols="30" rows="4" required="">
                <option value="">--Select--</option>
               <option selected="" value="<?php echo isset ($meta['uid'])? $meta['uid']:'' ?>"><?php echo isset ($meta['uid'])? $meta['uid'] :'' ?></option>
                      
          
                 <?php
                    $query = "SELECT * FROM newemployee";
                    $result = $conn->query($query);
                   if ($result->num_rows > 0) {
                    while($row= $result->fetch_assoc()){                    
             
                    }
                  }
                    ?> 
                   <?php
                    $fees = $conn->query("SELECT * FROM newemployee ");

                    while($row= $fees->fetch_assoc()):
                        
                ?>
                <option value="<?php echo $row['EmpID'] ?>" ><?php echo 'Staff'.' | '.$row['EmpID'].' | '.ucwords($row['FullName']) ?></option>
                <?php endwhile; ?> 

            </select>


		</div>

		<div class="form-group">
			<label for="username">Username</label>
			<input type="text" name="username" id="username" class="form-control" value="<?php echo isset($meta['username']) ? $meta['username']: '' ?>"   required >
		</div>
		<div class="form-group">
			<label for="password">Password</label>
			<input type="text" name="password" id="password" class="form-control" value="<?php echo isset ($meta['(password)']) ? $meta['password']: '' ?>" autocomplete="off" required>
			<small class="text-danger"><i>Leave this blank if you do not want to change the password.</i></small>
		
		</div>
		
		
		<div class="form-group">
			<label for="type">User Type</label>
			<select name="type" id="type" class="custom-select" required>
				<option value="">--Select--</option>
				<option selected="" value="<?php echo isset ($meta['type'])? $meta['type']:'' ?>"><?php echo isset ($meta['type'])? $meta['type'] :'' ?></option>
				<!-- <option value="Student">Student</option> -->
				<option value="Staff">Staff</option>
				<option value="Admin">Admin</option>
				<option value="Disconnect">Disconnect</option>
			</select>
		</div>	
		

	</form>
</div>


<div class="modal-footer">
        <button type="submit" class="btn btn-primary" id="submit" form="manage-moneyin"><i class="fas fa-thumbs-up"></i>&nbsp;&nbsp;Save</button>
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="fas fa-ban"></i>&nbsp;&nbsp;Cancel</button>
      </div>
<script>

 $(document).on('submit', '#login_user', function(e) {
//$('#login_user').submit(function(e){
        e.preventDefault()
        start_load()
        $('#msg').html('')
        $.ajax({
            url:'easoftfun.php?action=login_user',
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
                $('#msg').html('<div class="alert alert-danger mx-2">Username already exist.</div>')
                end_load()
                }  
            }
        })
    })




</script>