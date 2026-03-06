<?php include 'server/config.php';
if(isset($_POST['product'])){
	$user =  $_POST['user'];
	$discount = $_POST['discount'];
	$total = $_POST['totalvalue'];
	$price = $_POST['price'];
	$product = $_POST['product'];
	$customer = $_POST['customer'];
	$quantity = $_POST['quantity'];
	$grandtotal = $_POST['grandtotal'];
	$days = $_POST['days'];
	$month = $_POST['month'];
	$years = $_POST['years'];
	$typeofcash = $_POST['typeofcash'];
	$datee = $_POST['datee'];

		//echo $datee;




$veemos = '1';

	
	$reciept = array();
	
	$query = '';

	
	

	// SQLite uses || for concatenation, not CONCAT()
	$stmt = $conn->prepare("SELECT customer_id FROM customer WHERE firstnamec || ' ' || lastnamec = :customer");
	$stmt->execute([':customer' => $customer]);
	$cust_id = $stmt->fetch(PDO::FETCH_ASSOC);

	if(!$cust_id){
		echo "failure";
	}else{
		$cust_id_new = $cust_id['customer_id'];

		$sql = "INSERT INTO sales(customer_id,username,discount,total,grandtotal,days,month,years,typeofcash,created_date) VALUES($cust_id_new,'$user',$discount, $total, $grandtotal, $days, '$month', $years, $typeofcash, '$datee')";
		$result = $conn->exec($sql);
		

		if($result == true){
			$id = $conn->lastInsertId();
			
			for($i = 0;  $i < count($product); $i++){
				$reciept[] = $id;
			}
			//echo "$id[0]";
			for($num=0; $num<count($product); $num++){
				$product_id = $product[$num];
				$qtyold = $quantity[$num];

				$stmt1 = $conn->query("SELECT quantity FROM products WHERE product_no='$product_id'");
				$qty = $stmt1->fetch(PDO::FETCH_ASSOC);

				$newqty = $qty['quantity'] - $qtyold;

				$sql2 = "UPDATE products SET quantity=$newqty WHERE product_no='$product_id'";
				$conn->exec($sql2);

			}

			$query1 	= "INSERT INTO logs (username,purpose) VALUES('$user','Product sold')";
	 		$conn->exec($query1);

			for($count = 0; $count < count($product); $count++){
				$price_clean = $price[$count];
				$reciept_clean = $reciept[$count];
				$product_clean = $product[$count];
				$quantity_clean = $quantity[$count];
				if($product_clean != '' && $quantity_clean != '' && $price_clean != '' && $reciept_clean != ''){
					$conn->exec("INSERT INTO sales_product(reciept_no,product_id,price,qty) VALUES('$reciept_clean','$product_clean','$price_clean','$quantity_clean')");
				}
			} 
		}else{
			echo "failure";
		}
	
		echo "$id";
	}
}