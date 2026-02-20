<?php
include('server/config.php');

$product_no = $_POST["product_no"];
$text = $_POST["text"];
$column_name = $_POST["column_name"];

  
 $sql = "UPDATE products SET ".$column_name."='".$text."' WHERE product_no='".$product_no."'";  
 if(mysqli_query($conn
 	, $sql))  
 {  
      echo 'Data Updated';  
 }  
?>