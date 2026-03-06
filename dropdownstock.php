<?php
	include('server/config.php');

	if (isset($_POST['products'])){

		$namee = $_POST['products'];
		$show 	= "SELECT * FROM warehouse WHERE (name LIKE '$namee%' AND quantity > 0) OR (sid LIKE '$namee%' AND quantity > 0)";
		$query 	= $conn->query($show);
		if($query && count($result = $query->fetchAll(PDO::FETCH_ASSOC)) > 0){
			foreach($result as $row){
				echo "<tr class='js-add' data-sid=".$row['sid']." data-name=".$row['name']." data-price=".$row['price']." data-unit=".$row['unit']." data-quantity=".$row['quantity']." data-multtota=".$row['multtota']." data-description=".$row['description']." data-expire=".$row['expire_date']." data-picture=".$row['picture']." ><td>".$row['sid']."</td><td>".$row['name']."</td>";
				echo "<td>Ghc".$row['price']."</td>";
				echo "<td>".$row['unit']."</td>";
				echo "<td>".$row['quantity']."</td>";				
				echo"<td class='text-center p-1'><button class='btn btn-danger btn-sm' type='button' id='delete-row'><i class='fas fa-times-mark'></i></button></td>";








			}
		}
		else{
			echo "<td></td><td>No Products found!</td><td></td>";
		}
	}?>