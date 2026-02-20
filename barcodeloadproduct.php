<?php
	include('server/config.php');

	if (isset($_POST['products'])){

		$name = mysqli_real_escape_string($conn,$_POST['products']);
		$show 	= "SELECT * FROM products WHERE product_name LIKE '$name%' AND quantity > 0 OR product_no LIKE '$name%' AND quantity > 0";
		$query 	= mysqli_query($conn,$show);
		if(mysqli_num_rows($query)>0){
			while($row = mysqli_fetch_array($query)){
				
				
				echo '<div class="form-group">
     					 <label class="control-label col-sm-2" for="product">Product:</label>
     					 <div class="col-sm-10">
      				  <input autocomplete="OFF" type="text" class="form-control" id="product" name="product" value='.$row['product_name'].'>
     					 </div>
     					 </div>';


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
    					</div>';


    				



			
			}
		}
		else{
			echo "<td></td><td>No Products found!</td><td></td>";
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
