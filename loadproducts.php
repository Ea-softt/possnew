<?php
include('server/config.php');

	if (isset($_POST['products'])){

		$name = $_POST['products'] . '%';
		$stmt = $conn->prepare("SELECT * FROM products WHERE (product_name LIKE :name AND quantity > 0) OR (product_no LIKE :name AND quantity > 0)");
		$stmt->execute([':name' => $name]);
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		if(count($result) > 0){
			foreach($result as $row){
				echo "<tr class='js-add' data-barcode=".$row['product_no']." data-product=".$row['product_name']." data-price=".$row['sell_price']." data-unt=".$row['unit']." data-min=".$row['min_stocks']." data-quantity=".$row['quantity']."><td>".$row['product_no']."</td><td>".$row['product_name']."</td>";
				echo "<td>Ghc".$row['sell_price']."</td>";
				echo "<td>".$row['unit']."</td>";
				echo "<td>".$row['quantity']."</td>";
				echo "<td>".$row['expire_date']."</td>";
				echo"<td class='text-center p-1'><button class='btn btn-danger btn-sm' type='button' id='delete-row'><i class='fas fa-times-mark'></i></button></td>";








			}
		}
		else{
			echo "<td></td><td>No Products found!</td><td></td>";
		}
	}?>