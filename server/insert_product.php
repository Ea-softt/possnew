<?php
  include('config.php');

 

$sql = "INSERT INTO products (product_no, product_name, sell_price, quantity, unit, min_stocks, remarks, location, images) VALUES('".$_POST["product_no"]."',  '".$_POST['product_name']."', '".$_POST['sell_price']."', '".$_POST['quantity']."', '".$_POST['unit']."', '".$_POST['min_stocks']."', '".$_POST['remarks']."', '".$_POST['location']."', '".$_POST['images']."')";
if($conn->exec($sql))
{
    echo 'Data Inserted';
}
?>