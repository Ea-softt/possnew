<?php
include 'server/config.php'; 

if ($_POST['aja_id']){
	$query = "SELECT * FROM supplier WHERE supplier_id=".$_POST['aja_id'];
	$result =$conn->query($query);

	if ($result->num_rows > 0){
		echo '<option value=""> Select Student</option>';
		while ($row = $result->fetch_assoc()){
			echo '<option value='.$row['supplier_id'].'>'.$row['supplier_id'].' | '.$row['companyname'].'</option>';
		}
	}else{
		echo '<option> No State Found </option>';
		}
}


?>
