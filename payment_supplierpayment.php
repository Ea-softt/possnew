
<?php
include'head.php';
 include 'server/config.php'; 

?>
<div class="container-fluid">
	<div class="col-lg-12">
		<div class="row mb-4 mt-4">
			<div class="col-md-12">
				
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header bg-success text-white">
						<b>Make Payment </b>
						<span class="float:right"><a class="btn btn-primary btn-block btn-sm col-sm-2 float-right" href="javascript:void(0)" id="new_payment">
					<i class="fa fa-plus"></i> New 
				</a></span>
					</div>
					<div class="card-body">
						<table id="mytable" class="table table-condensed table-bordered table-hover">
							<thead>
								<tr>
									<th class="text-center">#</th>
									<th class="">Date</th>
									<th class="">Batch No.</th>
									<th class="">Type of Payment</th>
									<th class="">Supplier Name</th>									
									<th class="">Paid Amount</th>
									<th class="text-center">Action</th>
								</tr>
							</thead>
							<tbody>

								<?php 
								$i = 1;
								$fees = $conn->query("SELECT p.*,ps.* FROM paypay_supplier ps inner join paymen_supplier p on p.id = ps.paymen_supplierID GROUP BY ps.paymen_supplierID   order by ps.date_create  desc ");

								while($row=$fees->fetch_assoc()):
									$paid = $conn->query("SELECT sum(amountt) as paid FROM paypay_supplier where paymen_supplierID=".$row['id']);
									$paid = $paid->num_rows > 0 ? $paid->fetch_array()['paid']:'';
									$balance = $row['amount'] - $paid;
									
								?>

									<tr>
									<td class="text-center"><?php echo $i++ ?></td>
									<td class="text-center">
										<p> <b><?php echo date("M d,Y ",strtotime($row['date_create'])) ?></b></p>
									</td>
									<td class="text-center">
										<p> <b><?php echo $row['batchno'] ?></b></p>
									</td>
									<td class="text-center">
										<p> <b><?php echo $row['companyname'] ?></b></p>
									</td>
							 		<td class="text-center">
										<p> <b><?php echo $row['typeofpayment'] ?></b></p>
									</td>
									
									<td class="text-center">
										<p> <b><?php echo number_format($paid,2) ?></b></p>
									</td>
									<td class="text-center">
										<button class="btn btn-sm btn-outline-primary view_payment" type="button" data-id="<?php echo $row['id'] ?>" data-ef_id="<?php echo $row['paymen_supplierID'] ?>">View</button>
										<button class="btn btn-sm btn-outline-primary edit_payment" type="button" data-id="<?php echo $row['id'] ?>" >Edit</button>
										<button class="btn btn-sm btn-outline-danger delete_payment" type="button" data-id="<?php echo $row['id'] ?>">Delete</button>
									</td>
								</tr>
								<?php endwhile; ?>
								</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<style>
	
	td{
		vertical-align: middle !important;
	}
	td p{
		margin: unset
	}
	img{
		max-width:100px;
		max-height: :150px;
	}
</style>
<script>
	$(document).ready(function(){
		$('table').dataTable()
	})
	$('#mytable').ddTableFilter();
	
	$('#new_payment').click(function(){
		uni_modal("New Payment ","paymentpayment_supplier.php","mid-large")
		
	})

	$('.view_payment').click(function(){
		uni_modal("Payment Details","view_paypay.php?paymen_supplierID="+$(this).attr('data-ef_id')+"&pid="+$(this).attr('data-id'),"mid-large")
		
	})
	$('.edit_payment').click(function(){
		uni_modal("Manage Payment","manage_payment.php?id="+$(this).attr('data-id'),"mid-large")
		
	})
	$('.delete_payment').click(function(){
		_conf("Are you sure to delete this payment ?","delete_payment",[$(this).attr('data-id')])
	})
	function delete_payment($id){
		start_load()
		$.ajax({
			url:'easoft.php?action=delete_payment',
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