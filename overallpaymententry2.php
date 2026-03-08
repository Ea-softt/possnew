<?php include 'server/config.php'; 

if(isset($_GET['id'])){
	$qry = $conn->query("SELECT * FROM cashtypee c inner join supplier s on c.supppliername = s.supplier_id  where id = {$_GET['id']} ");
	foreach($qry->fetch(PDO::FETCH_ASSOC) as $k => $v){
		$$k = $v;
	}
}
?>
<div class="container-fluid">
	<form id="manage-payment">
		<div id="msg"></div>
		<div class="row">
			<div class="col-lg-6">
		<input type="hidden" id="id" value="<?php echo isset($id) ? $id : '' ?>">
		

		 <div class="form-group">
                <label for="" class="control-label">Batch No/Type of payment/Supplier Name</label>        
           
            <select name="supppliername" id="supppliername" class="custom-select input-sm select2" cols="30" rows="4" required="">
                <option value="">--Select--</option>
               <option selected="" value="<?php echo isset ($id)? $id :'' ?>"><?php echo isset ($companyname)? $companyname :'' ?></option> 
                 <?php
                    $query = "SELECT * FROM supplier";
                    $result = $conn->query($query);
                   if ($result->rowCount() > 0) {
                    while($row= $result->fetch(PDO::FETCH_ASSOC)){                    
             
                    }
                  }
                    ?> 
                   <?php
                   /* $fees = $conn->query("SELECT ch.*,s.* FROM cashtypee ch inner join supplier s on ch.supppliername = s.supplier_id");*/

                 /* inner join supplier s on s.supplier_id = ch.supppliername where ch.supppliername =".$row['supplier_id'].(isset($supplier_id) ? " and ch.supppliername!=$supplier_id " : '')*/ 
                 /*  while($row= $fees->fetch_assoc()):
                   $paid = $conn->query("SELECT sum(amountpayable) as paid FROM cashtypee where supppliername=".$row['supppliername']);
									$paid = $paid->num_rows > 0 ? $paid->fetch_array()['paid']:'';
									$balance = $row['batchno'];
									$amountpayable = $row['pai'];*/


					 $fees = $conn->query("SELECT * FROM supplier ");

                   while($row= $fees->fetch(PDO::FETCH_ASSOC)):          
                   	$ids = $row['supplier_id'];                                                                                                                                                                                                                                                                                                                    
                   	$paid_query = $conn->query("SELECT sum(amountpayable) as paid, suppliercurrentbilling as bat FROM cashtypee  where supppliername = $ids");
					$roww = $paid_query->fetch(PDO::FETCH_ASSOC);
					$pai = $roww['paid'] ?? 0;
                    $paid = $roww['bat'] ?? 0;
                ?> 
                 <option  value="<?php echo $row['supplier_id'] ?>" data-balance="<?php echo $pai ?>" data-paid="<?php echo $paid ?>" <?php echo isset($ef_id) && $ef_id == $row['supplier_id'] ? 'selected' : '' ?>><?php echo  ucwords($row['companyname']) ?></option>


             
                            <?php endwhile; ?> 
            </select>

            </div>
            <div class="form-group">
            <label for="" class="control-label">Batch no/Invoice no </label>
            <input type="text" class="form-control text-right" name="batchno" id="batchno"  value="<?php echo isset ($batchno)? $batchno :'' ?>" >
        </div>
 
 		<div class="form-group">
            <!-- <label for="" class="control-label">Current Payment </label> -->
            <input type="hidden" class="form-control text-right" name="currentpayment" id="currentpayment"  value="" >
        </div>

 		 <div class="form-group">
            <label for="" class="control-label">Suppliers Current Billing</label>
            <input type="number" class="form-control text-right" name="suppliercurrentbilling" id="suppliercurrentbilling"  value="<?php echo isset($amount) ? number_format($amount) :0 ?>" >
        </div>
       
        </div>
        <div class="col-lg-6">
        	
        	<div class="form-group">
           <!--  <label for="" class="control-label">Amount paid</label> -->
            <input type="hidden" class="form-control text-right" id="balance"  value="<?php echo isset ($amountpaid)? $amountpaid :'' ?>" >
            <input type="hidden" class="form-control text-right" id="amountpaid" name="amountpaid" value="" >
        </div>

 		 <div class="form-group">
            <label for="" class="control-label">Amount Payable</label>
            <input type="hidden" class="form-control text-right" name="" id="amountt"  value="<?php echo isset ($amountpayable)? $amountpayable :'' ?>" >
            <input type="number" class="form-control text-right" name="amountpayable" id="amountpayable"  value="<?php echo isset($amount) ? number_format($amount) :0 ?>" readonly >
        </div>

         <div class="form-group">        	
            <label for="" class="control-label">Remarks</label>
            <textarea name="remark" id="" cols="10" rows="3" class="form-control" ></textarea>

        </div>


        </div>

		
       </div> 
         <div class="modal-footer">
        <button type="submit" class="btn btn-primary" id="submit"><i class="fas fa-thumbs-up"></i>&nbsp;&nbsp;Save</button>
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="fas fa-ban"></i>&nbsp;&nbsp;Cancel</button>
      </div>
	</form>
</div>
<script>
	// $('.select2').select2({
	// 	placeholder:'Please select here',
	// 	width:'100%'
	// })

	$(document).ready(function(){
   var x = Number($("#currentpayment").val());
 

  })

	$('#supppliername').change(function(){
		
		var amount= $('#supppliername option[value="'+$(this).val()+'"]').attr('data-balance')
		
		$('#currentpayment').val(parseFloat(amount).toLocaleString('en-US',{style:'decimal',maximumFractionDigits:2,minimumFractionDigits:2}))
		

	var amountt= $('#supppliername option[value="'+$(this).val()+'"]').attr('data-paid')
		
		$('#suppliercurrentbilling').val(amountt);

		var b = $("#batchno").val();
		//alert (b);
		//$("#suppliercurrentbilling").val(amountt);


	})
	 $("#cost, #quantity").keyup(function(){
 	var multtotal1 = 0;
 	var x = Number($("#cost").val());
 	var y = Number($("#quantity").val());
 	var multtotal1= x * y;

 $("#tcost").val(multtotal1);

});

	$("#currentpayment").keyup(function(){
 	var multtotal1 = 0;
 	var multtotal2 = 0;
 	var x = Number($("#currentpayment").val());
 	var y = Number($("#balance").val());
 	var z = Number($("#amountt").val());
 	var multtotal1= x + y;
 	var multtotal2= z - x;


 $("#amountpaid").val(multtotal1);
 $("#amountpayable").val(multtotal2);

});

	$("#suppliercurrentbilling").keyup(function(){
 	
 	var multtotal3 = 0;
 	var x = Number($("#suppliercurrentbilling").val());
 	
 	var z = Number($("#amountt").val());
 	
 	var multtotal3= z + x;


 
 $("#amountpayable").val(multtotal3);

});


	 $(document).on('submit', '#manage-payment', function(e) {
	//$('#manage-payment').submit(function(e){
		e.preventDefault()
		start_load()

		$.ajax({
			url:'easoftfun.php?action=save_emma',
			method:'POST',
			data:$(this).serialize(),
			error:err=>{
				console.log(err)
				end_load()
			},
			success:function(resp){
				
				
				if(resp == 1){
					alert_toast("Data successfully saved.",'success')
						/*setTimeout(function(){
							var nw = window.open('receipt.php?ef_id='+resp.ef_id+'&pid='+resp.pid,"_blank","width=900,height=600")
							setTimeout(function(){
								nw.print()*/
								setTimeout(function(){
									/*nw.close()*/
									location.reload()
								},500)
							/*},500)
						},500)*/
				}
			}
		})
	})
</script>
