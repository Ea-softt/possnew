<?php include("head.php");
?>

<main class="w-100">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mb-2 border-bottom">
        <h1 class="h2" style="margin-left: 15%">User Information</h1>
        
      </div>





<div class="container-fluid">
	
	<div class="row">
	<div class="col-lg-12">
	</div>
	</div>
	<br>
	<div class="col-lg-12">
		<div class="card ">
			<div class="card-header bg-success text-white"><b>User List</b>
			
			<span class="float:right"><a class="btn btn-primary btn-block btn-sm col-sm-2 float-right" href="javascript:void(0)" id="new_user">
					<i class="fa fa-plus"></i> New Entry
				</a></span>

			</div>

 

			<div class="card-body">
				<table id="mytable" class="table-striped table-bordered">
			<thead>
				<tr>
					<th class="text-center">#</th>
					<th class="text-center">ID</th>
					<th class="text-center">User ID</th>
					<th class="text-center">Username</th>
					<th class="text-center">Password</th>
					<th class="text-center">Type</th>
					<th class="text-center">Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
 					 					
 					$users = $conn->query("SELECT * FROM login order by id desc");
 					$i = 1;
 					while($row= $users->fetch(PDO::FETCH_ASSOC)):
				 ?>
				 <tr>
				 	<td class="text-center">
				 		<?php echo $i++ ?>
				 	</td>
				 	<td class="text-center">
				 		<?php echo $row['id'] ?>
				 	</td>
				 	<td class="text-center">
				 		<?php echo $row['uid'] ?>
				 	</td>
				 	
				 	<td class="text-center">
				 		<?php echo $row['username'] ?>
				 	</td>
				 	<td class="text-center">
				 		<?php echo $row['password'] ?>
				 	</td>
				 	<td class="text-center">
				 		<?php echo $row['type'] ?>
				 	</td>
				 	<td>
				 		<center>
							<div class="btn-group">							  
							  <button type="button" class="btn btn-primary btn-sm dropdown-toggle " data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							  
							  Action</button>
							  <div class="dropdown-menu" aria-haspopup="true">
							    <a class="dropdown-item edit_login" href="javascript:void(0)" data-id = '<?php echo $row['id'] ?>'>Edit</a>
							    <div class="dropdown-divider"></div>
							    <a class="dropdown-item delete_login" href="javascript:void(0)" data-id = '<?php echo $row['id'] ?>'>Delete</a>
							  </div>
							</div>
						</center>
				 	</td>
				 </tr>
				<?php endwhile; ?>
			</tbody>
		</table>
			</div>
		</div>
	</div>

</div>
<script>

$('table').dataTable();

	$('#mytable').ddTableFilter();

$('#new_user').click(function(){
	uni_modal('New User','user_control.php')
})
$('.edit_login').click(function(){
	uni_modal('Edit User','user_control.php?id='+$(this).attr('data-id'))
})
$('.delete_login').click(function(){
_conf("Are you sure to delete this user?","delete_login",[$(this).attr('data-id')])
	})
	function delete_login($id){
		start_load()
		$.ajax({
			url:'easoftfun.php?action=delete_login',
			method:'POST',
			data:{id:$id},
			success:function(resp){
				if(resp==1){
					alert_toast("Data successfully deleted",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}
			}
		})
	}
</script>