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
		$result = $conn->exec($sql);
		

		if($result == true){
			$id = $conn->lastInsertId();
			for($i = 0;  $i < count($product); $i++){
				$reciept[] = $id;
			}
			//echo "$id[0]";

			for($num=0; $num<count($sid); $num++){
				$product_id = $sid[$num];
				$qtyold = $quantity1[$num];
				$companyname_clean = $companyname[$num];
				$product_clean = $product[$num];
				$price1_clean = $price1[$num];
				$tcost1_clean = $tcost1[$num];			
				$quantity_clean = $quantity1[$num];
				$unit_clean = $unit[$num];
				$expiredate_clean = $expiredate[$num];
				$description_clean = $description[$num];
				

				$sql1 = "SELECT quantity,multtota FROM warehouse WHERE sid ='$product_id'";
				$result1 = $conn->query($sql1);
				$qty = $result1->fetch(PDO::FETCH_ASSOC);

				$newqty = (int)$qty['quantity'] + (int)$qtyold;
 				$newmult = (float)$qty['multtota'] + (float)$tcost1_clean;
 				
 				//echo ($newmult);
				$sql2 = "UPDATE warehouse SET quantity=$newqty, price=$price1_clean, multtota=$newmult, unit='$unit_clean', description ='$description_clean', expire_date ='$expiredate_clean', supplierid=$companyname_clean, name='$product_clean'  WHERE sid='$product_id'";
				$conn->exec($sql2);

				// , price=$price1_clean expire_date =$expiredate_clean, description ='$description_clean'

			}

			
 			 for($count = 0; $count < count($sid); $count++){
 			 	$product_did = $sid[$count];
				$quantity_clean = $quantity1[$count];
				$companyname_clean = $companyname[$count];
				$product_clean = $product[$count];
				$price1_clean = $price1[$count];
				$tcost1_clean = $tcost1[$count];			
				//$quantity_clean = mysqli_real_escape_string($conn, $quantity1[$num]);
				$unit_clean = $unit[$count];
				$expiredate_clean = $expiredate[$count];
				$description_clean = $description[$count];
				$images_clean = $reciept[$count];
				
					$querym = "INSERT INTO updatewarehouse(product_id,productname,quantity,price,tprice,companyname,unity,expiredate,description,images) 
							VALUES($product_did,'$product_clean','$quantity_clean','$price1_clean','$tcost1_clean','$companyname_clean','$unit_clean','$expiredate_clean','$description_clean','$images_clean')";
					$conn->exec($querym);	
					var_dump($querym);
						//	,'','$companyname_clean','$unit_clean','$expiredate_clean','$description_clean','$images_clean'
			//,companyname,,description
			}

		
			echo 'Successfully';

			}else{
			echo "failure1";
		}
	}