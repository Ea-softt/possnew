<?php include 'server/config.php'; 

if(isset($_GET['id'])){
	$qry = $conn->query("SELECT * FROM paymen_supplier where pay_id = {$_GET['id']} ");
	foreach($qry->fetch_array() as $k => $v){
		$$k = $v;
	}
}
?>
<div class="container-fluid">
	<form id="manage-payment">
		<div id="msg"></div>
		<input type="hidden" id="id" value="<?php echo isset($id) ? $id : '' ?>">
		

		 <div class="form-group">
                <label for="" class="control-label">Batch No/Type of payment/Supplier Name</label>        
           
            <select name="paymen_supplierID" id="paymen_supplierID" class="custom-select input-sm select2" cols="30" rows="4" required="">
                <option value="">--Select--</option>
              <!--   <option selected="" value="<?php echo isset ($Term)? $Term :'' ?>"><?php echo isset ($companyname)? $conpanyname :'' ?></option> -->
                 <?php
                    $query = "SELECT * FROM paymen_supplier";
                    $result = $conn->query($query);
                   if ($result->rowCount() > 0) {
                    while($row= $result->fetch(PDO::FETCH_ASSOC)){                    
             
                    }
                  }
                    ?> 
                   <?php
                    $fees = $conn->query("SELECT * FROM paymen_supplier ");

                   while($row= $fees->fetch(PDO::FETCH_ASSOC)):                                                                                                                                                                                                                                                                                                                                                                                                                  
                   	$paid = $conn->query("SELECT sum(amountt) as paid FROM paypay_supplier where paymen_supplierID=".$row['id'].(isset($id) ? " and id!=$id " : ''));
						$paid = $paid->rowCount() > 0 ? $paid->fetch(PDO::FETCH_ASSOC)['paid']:'';
						echo $paid;
						$balance = $row['amount'] - $paid;



                        
                ?> 
                <option  value="<?php echo $row['id'] ?>" data-balance="<?php echo $balance ?>" <?php echo isset($ef_id) && $ef_id == $row['id'] ? 'selected' : '' ?>><?php echo  $row['batchno'].' | '. ucwords($row['typeofpayment']).' | '.ucwords($row['companyname']) ?></option>
                            <?php endwhile; ?> 
            </select>

            </div>
 	
 		<div class="form-group">
            <label for="" class="control-label">Outstanding Balance</label>
            <input type="text" class="form-control text-right" id="balance"  value="" required readonly>
        </div>

 		 <div class="form-group">
            <label for="" class="control-label">Amount</label>
            <input type="text" class="form-control text-right" name="amountt"  value="<?php echo isset($amount) ? number_format($amount) :0 ?>" required>
        </div>

        <div class="form-group">

        	
            <label for="" class="control-label">Remarks</label>
            <textarea name="remark" id="" cols="10" rows="3" class="form-control" required=""></textarea>

        </div>


		
       
	</form>
</div>
<script>
	$('.select2').select2({
		placeholder:'Please select here',
		width:'100%'
	})

	

	$('#paymen_supplierID').change(function(){
		
		var amount= $('#paymen_supplierID option[value="'+$(this).val()+'"]').attr('data-balance')
		alert(amount)
		$('#balance').val(parseFloat(amount).toLocaleString('en-US',{style:'decimal',maximumFractionDigits:2,minimumFractionDigits:2}))
	})

	$('#manage-payment').submit(function(e){
		e.preventDefault()
		start_load()
		$.ajax({
			url:'easoftfun.php?action=save_paypayment',
			method:'POST',
			data:$(this).serialize(),
			error:err=>{
				console.log(err)
				end_load()
			},
			success:function(resp){
				
				
				if(resp == 1){
					alert_toast("Data successfully saved.",'success')
						setTimeout(function(){
							var nw = window.open('receipt.php?ef_id='+resp.ef_id+'&pid='+resp.pid,"_blank","width=900,height=600")
							setTimeout(function(){
								nw.print()
								setTimeout(function(){
									nw.close()
									location.reload()
								},500)
							},500)
						},500)
				}
			}
		})
	})
</script>
