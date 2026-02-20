<?php
include('server/config.php');

$sql = "DELETE FROM products WHERE product_no = '".$_POST['product_no']."'";
if (mysqli_query($conn, $sql)){

	echo 'Data delete';
}

?>