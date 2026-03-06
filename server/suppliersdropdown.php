<?php
include 'config.php'; 

if ($_POST['aja_id']){
	$query = "SELECT * FROM supplier WHERE supplier_id=".$_POST['aja_id'];
	$stmt = $conn->query($query);
	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

	if (count($result) > 0){
		echo '<option value=""> Select Student</option>';
		foreach ($result as $row){
			echo '<option value='.$row['supplier_id'].'>'.$row['supplier_id'].' | '.$row['companyname'].'</option>';
		}
	}else{
		echo '<option> No State Found </option>';
		}
}


?>
