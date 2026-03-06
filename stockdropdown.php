<?php
	include('server/config.php');

	if (isset($_POST['products'])){

		$name = $_POST['products'];
		$stmt = $conn->prepare("SELECT * FROM warehouse WHERE (name LIKE :name AND quantity > 0) OR (sid = :sid AND quantity > 0)");
		$stmt->execute([':name' => $name . '%', ':sid' => $name]);
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		if(count($result) > 0){
			foreach($result as $row){
				
					echo '<div class="row ">
					    <div class="col-lg-4 border-right">
						<div class="form-group">
     					 <b><label class="control-label col-sm-2" for="product">Product:</label></b>
     					 <div class="col-sm-10">
      				  <input autocomplete="OFF" type="text" class="form-control" id="product" name="product" value='.$row['name'].'>
     					 </div>
     					 </div>';


   				echo '<div class="form-group">
      					<b><label class="control-label col-sm-2" for="product_id">Quantity:</label></b>
      					<div class="col-sm-10">
       					<input autocomplete="OFF" type="text" class="form-control" id="quantity" name="product_id" value='.$row['quantity'].'>
     					 </div>
    					 </div>';

    			echo '<div class="form-group">
     				 <b><label class="control-label col-sm-2" for="rate">Cprice</label></b>
    				  <div class="col-sm-10">          
       				 <input autocomplete="OFF" type="text" class="form-control" id="cprice"  name="cprice" value='.$row['price'].'>
     					 </div>
     					 </div>';

    			/*echo '<div class="form-group">
     				 <b><label class="control-label col-sm-2" for="rate">Tcost</label></b>
    				  <div class="col-sm-10">          
       				 <input autocomplete="OFF" type="text" class="form-control" id="tcost"  name="tcost" value='.$row['multtota'].'>
     					 </div>
     					 </div>
   						 </div>';*/

   				echo '<div class="form-group">
     				 <b><label class="control-label col-sm-2" for="rate">Picture</label></b>
    				  <div class="col-sm-10">          
       				 <input autocomplete="OFF" type="text" class="form-control" id="picture"  name="picture" value='.$row['picture'].'>
     					 </div>
   						 </div>
   						 </div>';


   				echo '<div class="col-lg-4 border-right">
   					<div class="form-group">
     				 <b><label class="control-label col-sm-2" for="rate">Unit</label></b>
    				  <div class="col-sm-10">          
       				 <input autocomplete="OFF" type="text" class="form-control" id="unit"  name="unit" value='.$row['unit'].'>
     					 </div>
   						 </div>';

   				echo '<div class="form-group">
     				 <b><label class="control-label col-sm-2" for="rate">ExpireDate:</label></b>
    				  <div class="col-sm-10">          
       				 <input autocomplete="OFF" type="text" class="form-control" id="expiredate"  name="expiredate" value='.$row['expire_date'].'>
     					 </div>
     					 </div>';

     			echo '<div class="form-group">
     				 <b><label class="control-label col-sm-2" for="rate">SPrice</label></b>
    				  <div class="col-sm-10">          
       				 <input autocomplete="OFF" type="text" class="form-control" id="sprice"  name="sprice" >
     					 </div>
   						 </div>';


   				echo '<div class="form-group"><b>
      				<label class="control-label col-sm-2" for="print_qty">Barcode</label></b>
     				 <div class="col-sm-10">          
     				   <input autocomplete="OFF" type="print_qty" class="form-control" id="barcode"  name="barcode" required="">
    					 </div>
    					</div>
    					</div>';
     					 
    			

    		echo '<div class="col-lg-4 ">
					<div class="form-group">
     				 <b><label class="control-label col-sm-2" for="rate">Min_stock</label></b>
    				  <div class="col-sm-10">          
       				 <input autocomplete="OFF" type="text" class="form-control" id="min_stock"  name="min_stock" >
     					 </div>
   						 </div>';

   			echo '	<div class="form-group">
     				 <b><label class="control-label col-sm-2" for="rate">location</label></b>
    				  <div class="col-sm-10">          
       				 <input autocomplete="OFF" type="text" class="form-control" id="location"  name="location" >
     					 </div>
   						 </div>';





   			echo '
   					<div class="form-group">
     				 <b><label class="control-label col-sm-2" for="rate">Remark</label></b>
    				  <div class="col-sm-10">          
       				 <input autocomplete="OFF" type="text" class="form-control" id="remark"  name="remark" >
     					 </div>
   						 </div>
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
