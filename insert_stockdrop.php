<?php include 'server/config.php';


if(isset($_POST['product'])){
	$product = $_POST['product'];
	$barcode = $_POST['barcode'];
	$sprice = $_POST['sprice'];
	$cprice = $_POST['cprice'];
	$unit1 = $_POST['unit1'];
	$quantity1 = $_POST['quantity1'];			
	$expiredate = $_POST['expiredate'];	
	$sid = $_POST['sid'];
	$min_stock = $_POST['min_stock'];
	$description = $_POST['description'];
	$supplierid = $_POST['supplierid']; 
	$images = '1';
	$location = $_POST['location'];
	$reciept = array();
	$query = '';
	$query1 = '';

	
	//$location = 'location';
	
	//echo $location;
	//$query = '';
	/*$sql = "INSERT INTO prod(name) VALUES('Emman')";
	$result = mysqli_query($conn,$sql);
*/






	/*$customer_id = mysqli_query($conn, "SELECT customer_id FROM customer WHERE CONCAT(firstnamec,' ',lastnamec) LIKE '$customer'");*/


	/*if(mysqli_num_rows($customer_id) == 0){
		echo "failure";
	}else{
		$cust_id 	= mysqli_fetch_array($customer_id);
		$cust_id_new = $cust_id['customer_id'];

	









	
*/
		
		$sql = "INSERT INTO prod(name) VALUES('$images')";
		$result = mysqli_query($conn,$sql);
		

		if($result == true){
			$select = "SELECT id FROM prod ORDER BY id DESC LIMIT 1";
			$res = mysqli_query($conn,$select);
			$id = mysqli_fetch_array($res);
			for($i = 0;  $i < count($product); $i++){
				$reciept[] = $id[0];
			}
			//echo "$id[0]";

			for($num=0; $num<count($sid); $num++){
				$product_id = mysqli_real_escape_string($conn, $sid[$num]);
				$qtyold = mysqli_real_escape_string($conn, $quantity1[$num]);

				//echo $product_id;

				$sql1 = "SELECT quantity FROM warehouse WHERE sid ='$product_id'";
				$result1 = mysqli_query($conn, $sql1);
				$qty = mysqli_fetch_array($result1);

				$newqty = $qty['quantity'] - $qtyold;
 					
 					

				$sql2 = "UPDATE warehouse SET quantity=$newqty WHERE sid='$product_id'";
				$result2 = mysqli_query($conn, $sql2);

			}

			for($numm=0; $numm<count($sid); $numm++){
			   $product_id = mysqli_real_escape_string($conn, $sid[$numm]);

				$sql1 = "SELECT productID FROM products WHERE productID = $product_id ";
				$result4 = mysqli_query($conn, $sql1);
				$qty = mysqli_fetch_array($result4);
					
				
			
				
			}
			if(isset($qty['productID'])){
				
				for($nump = 0; $nump < count($sid); $nump++){
				$product_id = mysqli_real_escape_string($conn, $sid[$nump]);
				$qtyold = mysqli_real_escape_string($conn, $quantity1[$nump]);
				$barcode_clean = mysqli_real_escape_string($conn, $barcode[$nump]);
				$product_clean = mysqli_real_escape_string($conn, $product[$nump]);
				$sprice_clean = mysqli_real_escape_string($conn, $sprice[$nump]);
				$cprice_clean = mysqli_real_escape_string($conn, $cprice[$nump]);			
				$quantity_clean = mysqli_real_escape_string($conn, $quantity1[$nump]);
				$unit_clean = mysqli_real_escape_string($conn, $unit1[$nump]);
				$minstock_clean = mysqli_real_escape_string($conn, $min_stock[$nump]);
				$expiredate_clean = mysqli_real_escape_string($conn, $expiredate[$nump]);
				$description_clean = mysqli_real_escape_string($conn, $description[$nump]);
				


				$sql1 = "SELECT quantity FROM products WHERE productID ='$product_id'";
				$result1 = mysqli_query($conn, $sql1);
				$qty = mysqli_fetch_array($result1);

				$newqty = $qty['quantity'] + $qtyold;
 					

				$sql3 = "UPDATE products SET quantity=$newqty, product_no=$barcode_clean, min_stocks=$minstock_clean, product_name='$product_clean',sell_price=$sprice_clean,cprice=$cprice_clean,unit='$unit_clean',expire_date='$expiredate_clean',remarks='$description_clean'  WHERE productID='$product_id'";
			
				$result3 = mysqli_query($conn, $sql3);
				}

		}

			/*$query1 	= "INSERT INTO logs (username,purpose) VALUES('$user','Product sold')";
	 		$insert 	= mysqli_query($conn,$query1);
	 		 $last_id = mysqli_insert_id($conn);
  echo "New record created successfully. Last inserted ID is: " . $last_id;*/
 			 for($count = 0; $count < count($sid); $count++){
 			 	$productID_clean = mysqli_real_escape_string($conn, $sid[$count]);
				$barcode_clean = mysqli_real_escape_string($conn, $barcode[$count]);
				$product_clean = mysqli_real_escape_string($conn, $product[$count]);
				$sprice_clean = mysqli_real_escape_string($conn, $sprice[$count]);
				$cprice_clean = mysqli_real_escape_string($conn, $cprice[$count]);			
				$quantity_clean = mysqli_real_escape_string($conn, $quantity1[$count]);
				$unit_clean = mysqli_real_escape_string($conn, $unit1[$count]);
				$minstock_clean = mysqli_real_escape_string($conn, $min_stock[$count]);
				$expiredate_clean = mysqli_real_escape_string($conn, $expiredate[$count]);
				$description_clean = mysqli_real_escape_string($conn, $description[$count]);
				$supplierid_clean = mysqli_real_escape_string($conn, $supplierid[$count]);
				$images_clean = mysqli_real_escape_string($conn, $reciept[$count]);
				
				/*if($product_clean != '' && $barcode_clean != '' && $sprice_clean != '' && $cprice_clean != '' && $quantity_clean != '' && $minstock_clean != '' &&  $expiredate_clean != '' && $description_clean != '' ){*/
					$query .= "INSERT INTO newstock(productID,product_no,product_name,sell_price,cprice,quantity,unit,min_stocks,expire_date,remarks,supplier_id,images) 
							VALUES($productID_clean,'$barcode_clean','$product_clean',$sprice_clean,'$cprice_clean','$quantity_clean','$unit_clean','$minstock_clean','$expiredate_clean','$description_clean','$supplierid_clean','$images_clean');";						
				/*}*/
				
			} 
		
		


			}else{
			echo "failure1";
		}
		if ($query != ''){
			if(mysqli_multi_query($conn,$query)){
				//return json_encode(array('id'=>$id[0], 'status'=>success));
				echo 'Successfully';

			}else{
				echo 'failure2';
				
			}
		}else{
			echo 'failure3';
		}
	}