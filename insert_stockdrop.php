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

				//echo $product_id;

				$sql1 = "SELECT quantity FROM warehouse WHERE sid ='$product_id'";
				$result1 = $conn->query($sql1);
				$qty = $result1->fetch(PDO::FETCH_ASSOC);

				$newqty = $qty['quantity'] - $qtyold;
 					
 					

				$sql2 = "UPDATE warehouse SET quantity=$newqty WHERE sid='$product_id'";
				$conn->exec($sql2);

			}

			for($numm=0; $numm<count($sid); $numm++){
			   $product_id = $sid[$numm];

				$sql1 = "SELECT product_no FROM products WHERE product_no = '$product_id' ";
				$result4 = $conn->query($sql1);
				$qty = $result4->fetch(PDO::FETCH_ASSOC);
					
				
			
				
			}
			if(isset($qty['product_no'])){
				
				for($nump = 0; $nump < count($sid); $nump++){
				$product_id = $sid[$nump];
				$qtyold = $quantity1[$nump];
				$barcode_clean = $barcode[$nump];
				$product_clean = $product[$nump];
				$sprice_clean = $sprice[$nump];
				$cprice_clean = $cprice[$nump];			
				$quantity_clean = $quantity1[$nump];
				$unit_clean = $unit1[$nump];
				$minstock_clean = $min_stock[$nump];
				$expiredate_clean = $expiredate[$nump];
				$description_clean = $description[$nump];
				


				$sql1 = "SELECT quantity FROM products WHERE product_no ='$product_id'";
				$result1 = $conn->query($sql1);
				$qty = $result1->fetch(PDO::FETCH_ASSOC);

				$newqty = $qty['quantity'] + $qtyold;
 					

				$sql3 = "UPDATE products SET quantity=$newqty, product_no=$barcode_clean, min_stocks=$minstock_clean, product_name='$product_clean',sell_price=$sprice_clean,cprice=$cprice_clean,unit='$unit_clean',expire_date='$expiredate_clean',remarks='$description_clean'  WHERE product_no='$product_id'";
			
				$conn->exec($sql3);
				}

		}

 			 for($count = 0; $count < count($sid); $count++){
 			 	$productID_clean = $sid[$count];
				$barcode_clean = $barcode[$count];
				$product_clean = $product[$count];
				$sprice_clean = $sprice[$count];
				$cprice_clean = $cprice[$count];			
				$quantity_clean = $quantity1[$count];
				$unit_clean = $unit1[$count];
				$minstock_clean = $min_stock[$count];
				$expiredate_clean = $expiredate[$count];
				$description_clean = $description[$count];
				$supplierid_clean = $supplierid[$count];
				$images_clean = $reciept[$count];
				
				/*if($product_clean != '' && $barcode_clean != '' && $sprice_clean != '' && $cprice_clean != '' && $quantity_clean != '' && $minstock_clean != '' &&  $expiredate_clean != '' && $description_clean != '' ){*/
					$query = "INSERT INTO newstock(productID,product_no,product_name,sell_price,cprice,quantity,unit,min_stocks,expire_date,remarks,supplier_id,images) 
							VALUES($productID_clean,'$barcode_clean','$product_clean',$sprice_clean,'$cprice_clean','$quantity_clean','$unit_clean','$minstock_clean','$expiredate_clean','$description_clean','$supplierid_clean','$images_clean')";
					$conn->exec($query);						
				/*}*/
				
			} 
		
		echo 'Successfully';


			}else{
			echo "failure1";
		}
	}