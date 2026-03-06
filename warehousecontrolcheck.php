<?php
	include('server/config.php');

	if (isset($_POST['products'])){

		$name = $_POST['products'];
		$stmt = $conn->prepare("SELECT * FROM warehouse WHERE name LIKE :name OR sid LIKE :name");
		$stmt->execute([':name' => $name . '%']);
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		if(count($result) > 0){
			foreach($result as $row){
				
				
				echo '<div class="form-group">
     					 
     					 <div class="col-sm-10">
      				 <span class="text-danger">This Product is in the Warehouse table:'.$row['name'].' </span> 
     					 </div>
     					 </div>';

/*
   				echo '<div class="form-group">
      					<label class="control-label col-sm-2" for="product_id">Product ID:</label>
      					<div class="col-sm-10">
       					<input autocomplete="OFF" type="text" class="form-control" id="product_id" name="product_id" value='.$row['product_no'].'>
     					 </div>
    					 </div>';

    			echo '<div class="form-group">
     				 <label class="control-label col-sm-2" for="rate">Rate</label>
    				  <div class="col-sm-10">          
       				 <input autocomplete="OFF" type="text" class="form-control" id="rate"  name="rate" value='.$row['sell_price'].'>
     					 </div>
   						 </div>';



    			echo '<div class="form-group">
      				<label class="control-label col-sm-2" for="print_qty">Barcode Quantity</label>
     				 <div class="col-sm-10">          
     				   <input autocomplete="OFF" type="print_qty" class="form-control" id="print_qty"  name="print_qty" required="">
    					 </div>
    					</div>';*/


    				



			
			}
		}
		else{
			echo "<td></td><td class='text-success'>Is a new product and it can be register.</td><td></td>";
		}
	}?>


	 <!-- <div class="form-group">
      <label class="control-label col-sm-2" for="product">Product:</label>
      <div class="col-sm-10">
        <input autocomplete="OFF" type="text" class="form-control" id="product" name="product">
      </div>
    </div> -->
   <!--  if ($_POST['aja_id']){
	$query = "SELECT sf.*,ns.sfname as name FROM student_ef_list sf inner join newstudent ns on ns.studentID = sf.student_id  WHERE Class_ID=".$_POST['aja_id'];
	$result =$conn->query($query);

	if ($result->num_rows > 0){
		echo '<option value=""> Select Student</option>';
		while ($row = $result->fetch_assoc()){
			$paid = $conn->query("SELECT sum(amount) as paid FROM payments where ef_id=".$row['id'].(isset($id) ? " and id!=$id " : ''));
						$paid = $paid->num_rows > 0 ? $paid->fetch_array()['paid']:'';
						$balance = $row['total_fee'] - $paid;

		echo '<option value='.$row['id'].'>'.$row['id'].' | '.$row['name'].'</option>';




		}
	}else{
		echo '<option> No State Found </option>';
		}
} -->
