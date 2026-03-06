<?php
include('server/config.php');

$sql = "DELETE FROM products WHERE product_no = '".$_POST['product_no']."'";
if ($conn->exec($sql)){

	echo 'Data delete';
}

?>