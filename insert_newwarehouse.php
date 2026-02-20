<?php include 'server/config.php';


if(isset($_POST['product'])){
	$sid = $_POST['sid'];
	$product = $_POST['product'];	
	$companyname = $_POST['companyname'];
	$quantity1 = $_POST['quantity1'];
	$price1 = $_POST['price1'];
	$tcost1 = '642855';
	$unit = $_POST['unit'];			
	$expiredate = $_POST['expiredate'];	
	$description = $_POST['description'];
	
	$images = '2';
	//$location = $_POST['location'];
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
				$companyname_clean = mysqli_real_escape_string($conn, $companyname[$num]);
				$product_clean = mysqli_real_escape_string($conn, $product[$num]);
				$price1_clean = mysqli_real_escape_string($conn, $price1[$num]);
				$tcost1_clean = mysqli_real_escape_string($conn, $tcost1[$num]);			
				$quantity_clean = mysqli_real_escape_string($conn, $quantity1[$num]);
				$unit_clean = mysqli_real_escape_string($conn, $unit[$num]);
				$expiredate_clean = mysqli_real_escape_string($conn, $expiredate[$num]);
				$description_clean = mysqli_real_escape_string($conn, $description[$num]);
				

				$sql1 = "SELECT quantity,multtota FROM warehouse WHERE sid ='$product_id'";
				$result1 = mysqli_query($conn, $sql1);
				$qty = mysqli_fetch_array($result1);

				$newqty = $qty['quantity'] + $qtyold;
 				$newmult =$qty['multtota'] + $tcost1_clean;
 				
 				//echo ($newmult);
				$sql2 = "UPDATE warehouse SET quantity=$newqty, price=$price1_clean, multtota=$newmult, unit='$unit_clean', description ='$description_clean', expire_date ='$expiredate_clean', supplierid=$companyname_clean, name='$product_clean'  WHERE sid='$product_id'";
				$result2 = mysqli_query($conn, $sql2);

				// , price=$price1_clean expire_date =$expiredate_clean, description ='$description_clean'

			}

			
			/*g*/

			/*$query1 	= "INSERT INTO logs (username,purpose) VALUES('$user','Product sold')";
	 		$insert 	= mysqli_query($conn,$query1);
	 		 $last_id = mysqli_insert_id($conn);
  echo "New record created successfully. Last inserted ID is: " . $last_id;*/
 /* for($count = 0; $count < count($sid); $count++){
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

*/




 			 for($count = 0; $count < count($sid); $count++){
 			 	$product_did = mysqli_real_escape_string($conn, $sid[$count]);
				$quantity_clean = mysqli_real_escape_string($conn, $quantity1[$count]);
				$companyname_clean = mysqli_real_escape_string($conn, $companyname[$count]);
				$product_clean = mysqli_real_escape_string($conn, $product[$count]);
				$price1_clean = mysqli_real_escape_string($conn, $price1[$count]);
				$tcost1_clean = mysqli_real_escape_string($conn, $tcost1[$count]);			
				//$quantity_clean = mysqli_real_escape_string($conn, $quantity1[$num]);
				$unit_clean = mysqli_real_escape_string($conn, $unit[$count]);
				$expiredate_clean = mysqli_real_escape_string($conn, $expiredate[$count]);
				$description_clean = mysqli_real_escape_string($conn, $description[$count]);
				$images_clean = mysqli_real_escape_string($conn, $reciept[$count]);
				echo $product_did;
				
					$query .= "INSERT INTO updatewarehouse(product_id,productname,quantity,price,companyname,unity,expiredate,description,tprice) 
							VALUES($product_did,'$product_clean','$quantity_clean','$price1_clean','$companyname_clean','$unit_clean','$expiredate_clean','$description_clean','$tcost1_clean');";						
						//	,'','$companyname_clean','$unit_clean','$expiredate_clean','$description_clean','$images_clean'
			//,companyname,,description
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