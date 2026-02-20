<?php include 'server/config.php' 

/*if(isset($_GET['id'])){
	$qry = $conn->query("SELECT * FROM student_ef_list where id = {$_GET['id']}");
	foreach($qry->fetch_array() as $k => $v){
		$$k = $v;
	}
}*/
?>
<div class="container-fluid">
	<form id="manage-fees">
		<div id="msg"></div>
		<div class="form-group" >
  		<label class="">ID:</label>
		<input class="form-control" type="text" id="id" name="id"   readonly>	
	     </div>	   
	 	
		 <div class="form-group" >
  		<label class="">Batch No:</label>
		<input class="form-control" type="text" id="batchno" name="batchno" required >	
	     </div>	   
	      <div class="form-group" >
  		<label class="">Company Name:</label>
		<input class="form-control" type="text" id="companyname" name="companyname" required >	
	     </div>	
	        <div class="form-group" >
  		<label class="">Type of Payment:</label>
		<input class="form-control" type="text" id="type" name="type" required >	
	     </div>	
	      <div class="form-group" >
  		<label class="">Amount:</label>
		<input class="form-control" type="number" id="amount" name="amount"  placeholder="only number should be place" >	
	     </div>
	 	
	</form>
</div>
<script>
	$('.select2').select2({
		placeholder:'Please select here',
		width:'100%'
	})

	
$('#manage-fees').submit(function(e){
        e.preventDefault()
        start_load()
        $('#msg').html('')
        $.ajax({
            url:'easoftfun.php?action=save_paymentsupplier',
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
                }else if(resp == 2){
                $('#msg').html('<div class="alert alert-danger mx-2">This type, has already Registed for Payment.</div>')
                end_load()
                } 
            }
        })
    })




	
	/*
	$('#manage-fees').submit(function(e){
		e.preventDefault()
		start_load()
		alert('err');
		$.ajax({
			url:'easoftfun.php?action=save_paymentsupplier',
			method:'POST',
			data:$(this).serialize(),
			error:err=>{
				console.log(err)
				alert(err)
				end_load()
			},
			success:function(resp){
				if(resp == 1){
					location.reload();
					alert_toast("Data successfully saved.",'success')
						setTimeout(function(){
							location.reload()
						},1000)
				}else if(resp == 2){
					$('#msg').html('<div class="alert alert-danger">Type of Fee has already Registed for Payment.</div>')
					end_load()
				}
			}
		})
	})*/
</script>
