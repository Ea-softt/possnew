<?php include 'server/config.php';
if(isset($_POST['product'])){
	$user =  $_POST['user'];
	$discount = $_POST['discount'];
	$total = $_POST['totalvalue'];
	$price = $_POST['price'];
	$product = $_POST['product'];
	$customer = mysqli_real_escape_string($conn, $_POST['customer']);
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

	
	

	$customer_id = mysqli_query($conn, "SELECT customer_id FROM customer WHERE CONCAT(firstnamec,' ',lastnamec) = '$customer'");


	if(mysqli_num_rows($customer_id) == 0){
		echo "failure";
	}else{
		$cust_id 	= mysqli_fetch_array($customer_id);
		$cust_id_new = $cust_id['customer_id'];

		$sql = "INSERT INTO sales(customer_id,username,discount,total,grandtotal,days,month,years,typeofcash,created_date) VALUES($cust_id_new,'$user',$discount, $total, $grandtotal, $days, '$month', $years, $typeofcash, '$datee')";
		$result = mysqli_query($conn,$sql);
		

		if($result == true){
			$select = "SELECT reciept_no FROM sales ORDER BY reciept_no DESC LIMIT 1";
			$res = mysqli_query($conn,$select);
			$id = mysqli_fetch_array($res);
			for($i = 0;  $i < count($product); $i++){
				$reciept[] = $id[0];
			}
			//echo "$id[0]";
			for($num=0; $num<count($product); $num++){
				$product_id = mysqli_real_escape_string($conn, $product[$num]);
				$qtyold = mysqli_real_escape_string($conn, $quantity[$num]);

				$sql1 = "SELECT quantity FROM products WHERE product_no='$product_id'";
				$result1 = mysqli_query($conn, $sql1);
				$qty = mysqli_fetch_array($result1);

				$newqty = $qty['quantity'] - $qtyold;

				$sql2 = "UPDATE products SET quantity=$newqty WHERE product_no='$product_id'";
				$result2 = mysqli_query($conn, $sql2);

			}

			$query1 	= "INSERT INTO logs (username,purpose) VALUES('$user','Product sold')";
	 		$insert 	= mysqli_query($conn,$query1);

			for($count = 0; $count < count($product); $count++){
				$price_clean = mysqli_real_escape_string($conn, $price[$count]);
				$reciept_clean = mysqli_real_escape_string($conn, $reciept[$count]);
				$product_clean = mysqli_real_escape_string($conn, $product[$count]);
				$quantity_clean = mysqli_real_escape_string($conn, $quantity[$count]);
				if($product_clean != '' && $quantity_clean != '' && $price_clean != '' && $reciept_clean != ''){
					$query .= "
						INSERT INTO sales_product(reciept_no,product_id,price,qty) 
						VALUES($reciept_clean,$product_clean,$price_clean,$quantity_clean);
						";
				}
			} 
		}else{
			echo "failure";
		}
	
		if ($query != ''){
			if(mysqli_multi_query($conn,$query)){
				//return json_encode(array('id'=>$id[0], 'status'=>success));
			echo "$id[0]";
			}else{
				echo "failure";
			}
		}else{
			echo 'failure';
		}
	}
}