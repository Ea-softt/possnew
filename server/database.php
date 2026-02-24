<?php  
		//session_start();	
			$host = "localhost";
			$dbuser = "root";
			$dbpass = ""; 
			$dbname = "pos";

        //eMMA2020@

      
			try {
				$conn = new mysqli ("$host","$dbuser","$dbpass") or die(conn_error($conn));
				
				
			} catch (Exception $e) {
				echo "$e";
				
			}	

			
			/*$host = "sql202.epizy.com";
			$dbuser = "epiz_29233641";
			$dbpass = "fmxXZ4MwJQBuzk";
			$dbname = "epiz_29233641_databaseschool1";

			try {
				$conn = new mysqli ("$host","$dbuser","$dbpass","$dbname") or die(conn_error($conn));
				
				
			} catch (Exception $e) {
				echo "$e";
				
			}*/
			
// create a database
$sql = "CREATE DATABASE IF NOT EXISTS pos";
$result = mysqli_query($conn, $sql);

if ($result){
	$conn -> close();

$host = "localhost";
			$dbuser = "root";
			$dbpass = "";//eMMA2020@
			$dbname = "pos";

			try {
				$conn = new mysqli ("$host","$dbuser","$dbpass","$dbname") or die(conn_error($conn));
				
				
			} catch (Exception $e) {
				echo "$e";
				
			}	


	$sql ="CREATE TABLE IF NOT EXISTS `cashflow` (
  `transaction_id` int(11) NOT NULL AUTO_INCREMENT,
  `description` text,
  `amount` decimal(18,2) DEFAULT NULL,
  `username` varchar(30) DEFAULT NULL,
  `transaction_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,PRIMARY KEY (`transaction_id`)
)";
	$result = mysqli_query($conn, $sql);


$sql = "CREATE TABLE IF NOT EXISTS `customer` (
  `customer_id` int(11) NOT NULL  AUTO_INCREMENT,
  `firstnamec` varchar(40) DEFAULT NULL,
  `lastnamec` varchar(40) DEFAULT NULL,
  `address` text,
  `contact_number` varchar(50) DEFAULT NULL,
  `image` varchar(50) NOT NULL,PRIMARY KEY (`customer_id`)
)";
$result = mysqli_query($conn, $sql);


$sql = "CREATE TABLE IF NOT EXISTS`cashtype` (
  `id` int(11) NOT NULL,
  `typeofcash` varchar(11) NOT NULL,PRIMARY KEY (`id`)
)";
$result = mysqli_query($conn, $sql);


$sql = "CREATE TABLE IF NOT EXISTS `cashtypee` (
  `id` int(35) NOT NULL AUTO_INCREMENT,
  `supppliername` int(255) NOT NULL,
  `batchno` varchar(255) NOT NULL,
  `currentpayment` decimal(65,2) NOT NULL,
  `suppliercurrentbilling` decimal(65,2) NOT NULL,
  `amountpaid` decimal(65,2) NOT NULL,
  `amountpayable` decimal(65,2) NOT NULL,
  `remark` varchar(255) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,PRIMARY KEY (`id`)
)";
$result = mysqli_query($conn, $sql);

$sql = "CREATE TABLE IF NOT EXISTS `updatewarehouse` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `product_id` int(255) NOT NULL,
   `productname` varchar(255) NOT NULL,
  `quantity` int(255) NOT NULL,
  `price` decimal(65,2) NOT NULL,
  `tprice` decimal(65,2) NOT NULL,
  `companyname` varchar(255) NOT NULL,
  `unity` varchar(255) NOT NULL,
  `expiredate` int(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `images` int(255) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,PRIMARY KEY (`id`)
)";
$result = mysqli_query($conn, $sql);



$sql = "CREATE TABLE IF NOT EXISTS `customersale` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `salername` varchar(255) NOT NULL,
  `customername` varchar(255) NOT NULL,
  `totalsale` decimal(65,2) NOT NULL,
  `discount` decimal(65,2) NOT NULL,
  `grandtotal` decimal(65,2) NOT NULL,
  `days` int(11) NOT NULL,
  `month` varchar(11) NOT NULL,
  `year` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,PRIMARY KEY (`id`)
)";
$result = mysqli_query($conn, $sql);



$sql = "CREATE TABLE IF NOT EXISTS `login` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `password` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,PRIMARY KEY (`id`)
)";
$result = mysqli_query($conn, $sql);

$query = "SELECT id FROM login";
		$result12 = mysqli_query($conn, $query);
		if(mysqli_num_rows($result12) == 0) {

$sql = "INSERT INTO `login` (`id`, `uid`, `password`, `username`, `type`) VALUES
(1, 1, 'c4ca4238a0b923820dcc509a6f75849b', 'a', 'Admin')";
$result = mysqli_query($conn, $sql);

}

$sql = "CREATE TABLE IF NOT EXISTS `moneyin` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `total_amount` decimal(65,2) NOT NULL,
  `name` varchar(255) NOT NULL,
  `day` int(255) NOT NULL,
  `month` varchar(255) NOT NULL,
  `year` int(255) NOT NULL,PRIMARY KEY (`id`)
)";
$result = mysqli_query($conn, $sql);


$sql = "CREATE TABLE IF NOT EXISTS `moneyin_des` (
  `did` int(11) NOT NULL AUTO_INCREMENT,
  `money_id` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `amount` decimal(65,2) NOT NULL,PRIMARY KEY (`did`)
)";
$result = mysqli_query($conn, $sql);

$sql = "CREATE TABLE IF NOT EXISTS `moneyout` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `total_amount` decimal(65,2) NOT NULL,
  `name` varchar(255) NOT NULL,
  `day` int(11) NOT NULL,
  `month` varchar(11) NOT NULL,
  `year` int(11) NOT NULL,PRIMARY KEY (`id`)
)";
$result = mysqli_query($conn, $sql);


$sql = "CREATE TABLE IF NOT EXISTS `moneyout_des` (
  `did` int(11) NOT NULL AUTO_INCREMENT,
  `money_id` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `amount` decimal(65,2) NOT NULL,PRIMARY KEY (`did`)
)";
$result = mysqli_query($conn, $sql);

$sql = "CREATE TABLE IF NOT EXISTS `newemployee` (
  `EmpID` int(100) NOT NULL AUTO_INCREMENT,
  `FullName` varchar(255) NOT NULL,
  `Gender` varchar(255) NOT NULL,
  `DOB` varchar(255) NOT NULL,
  `Age` int(255) NOT NULL,
  `Hometown` varchar(255) NOT NULL,
  `Nationality` varchar(255) NOT NULL,
  `Phonenum` varchar(20) NOT NULL,
  `Mail` varchar(255) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `Address2` varchar(255) NOT NULL,
  `Status` varchar(255) NOT NULL,
  `Department` varchar(255) NOT NULL,
  `Lastschool` varchar(255) NOT NULL,
  `Qualification` varchar(255) NOT NULL,
  `StartingDate` varchar(255) NOT NULL,
  `Employer` varchar(255) NOT NULL,
  `Language` varchar(255) NOT NULL,
  `Religion` varchar(255) NOT NULL,
  `picture` varchar(255) NOT NULL,PRIMARY KEY (`EmpID`)
)";

$result1 = mysqli_query($conn, $sql);



$query = "SELECT EmpID FROM newemployee";
		$result = mysqli_query($conn, $query);
		if(mysqli_num_rows($result) == 0) {

$sql = "INSERT INTO `newemployee` (`EmpID`, `FullName`, `Gender`, `DOB`, `Age`, `Hometown`, `Nationality`, `Phonenum`, `Mail`, `Address`, `Address2`, `Status`, `Department`, `Lastschool`, `Qualification`, `StartingDate`, `Employer`, `Language`, `Religion`, `picture`) VALUES

(1, 'benedicta YAA AKORLI', 'Male', '2005-02-02', 24, 'bokorkrom', 'Ghanaian', '0553896769', 'botee2020@gmail.com', '	bokorkrom d/a basic school post office box 88 daboase	\r\n		', '	bokorkrom d/a basic school post office box 88 daboase	\r\n		', 'Active', 'Active', 'benedicta YAA AKORLI', 'Degree', '2022-01-15', '', 'Nzema', 'Christian', '1641072420_1633495740_Ea-Softlogo.png')";

$result = mysqli_query($conn, $sql);

}

$sql = "CREATE TABLE IF NOT EXISTS `logs` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `purpose` varchar(255) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,PRIMARY KEY (`id`)
)";
$result = mysqli_query($conn, $sql);


$sql = "CREATE TABLE IF NOT EXISTS `note` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `notee` varchar(255) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,PRIMARY KEY (`id`)
)";
$result = mysqli_query($conn, $sql);


$sql = "CREATE TABLE IF NOT EXISTS `prod` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,PRIMARY KEY (`id`)
)";
$result = mysqli_query($conn, $sql);


$sql = "CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_no` varchar(11) NOT NULL,
  `product_name` varchar(11) DEFAULT NULL,
  `sell_price` decimal(18,2) DEFAULT NULL,
  `cprice` decimal(65,2) NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `unit` varchar(30) DEFAULT NULL,
  `min_stocks` int(11) DEFAULT NULL,
  `expire_date` varchar(255) NOT NULL,
  `remarks` text,
  `location` varchar(255) NOT NULL,
  `images` varchar(255) NOT NULL,PRIMARY KEY (`id`)
)";
$result = mysqli_query($conn, $sql);

$sql = "CREATE TABLE IF NOT EXISTS `salecustomeriterm` (
  `barcode` int(11) NOT NULL AUTO_INCREMENT,
  `product` varchar(255) NOT NULL,
  `price` decimal(65,2) NOT NULL,
  `unit` varchar(255) NOT NULL,
  `qty` int(255) NOT NULL,
  `subtotal` decimal(65,2) NOT NULL,
  `salecustomerid` int(255) NOT NULL,PRIMARY KEY (`barcode`)
)";
$result = mysqli_query($conn, $sql);


$sql = "CREATE TABLE IF NOT EXISTS `sales` (
  `reciept_no` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `discount` decimal(65,2) NOT NULL,
  `total` decimal(65,2) NOT NULL,
  `grandtotal` decimal(65,2) NOT NULL,
  `typeofcash`varchar(30) NOT NULL,
  `days` int(11) NOT NULL,
  `month` varchar(11) NOT NULL,
  `years` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,PRIMARY KEY (`reciept_no`)
)";
$result = mysqli_query($conn, $sql);



$sql = "CREATE TABLE IF NOT EXISTS `sales_product` (
  `reciept_no` int(11) NOT NULL,
  `product_id` varchar(20) NOT NULL,
  `price` decimal(18,2) NOT NULL,
  `qty` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
)";
$result = mysqli_query($conn, $sql);



$sql = "CREATE TABLE IF NOT EXISTS `supplier` (
  `supplier_id` int(11) NOT NULL AUTO_INCREMENT,
  `companyname` varchar(30) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `address` text NOT NULL,
  `contact_number` varchar(30) NOT NULL,
  `image` varchar(60) NOT NULL,PRIMARY KEY (`supplier_id`)
)";
$result = mysqli_query($conn, $sql);


$sql = "CREATE TABLE IF NOT EXISTS `suppliercompany` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `companynameid` int(11) NOT NULL,
  `price2` decimal(65,2) NOT NULL,
  `multtota2` decimal(65,2) NOT NULL,
  `date_deliver` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,PRIMARY KEY (`id`)
)";
$result = mysqli_query($conn, $sql);


$sql = "CREATE TABLE IF NOT EXISTS `supplierdeliver` (
  `sid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `image` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `supplierid` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,PRIMARY KEY (`sid`)
)";
$result = mysqli_query($conn, $sql);



$sql = "CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `position` varchar(20) NOT NULL,
  `contact_number` varchar(30) NOT NULL,
  `picture` varchar(255) NOT NULL,PRIMARY KEY (`id`)
)";
$result = mysqli_query($conn, $sql);


$sql = "CREATE TABLE IF NOT EXISTS `warehouse` (
  `sid` int(11) NOT NULL AUTO_INCREMENT,
  `supplierid` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(65,2) NOT NULL,
  `multtota` int(11) NOT NULL,
  `unit` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `expire_date` varchar(11) NOT NULL,
  `picture` varchar(255) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,PRIMARY KEY (`sid`)
)";
$result = mysqli_query($conn, $sql);

$sql1 = "CREATE TABLE IF NOT EXISTS `newstock` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `productID` int(11) NOT NULL,
  `product_no` varchar(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `sell_price` decimal(18,2) NOT NULL,
  `cprice` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `unit` varchar(11) NOT NULL,
  `min_stocks` int(11) NOT NULL,
  `expire_date` varchar(11) NOT NULL,
  `remarks` text NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `images` varchar(11) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),PRIMARY KEY (`id`)
)";
$result = mysqli_query($conn, $sql1);



$sql2 = "CREATE TABLE IF NOT EXISTS `cashtype` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `typeofcash` varchar(11) NOT NULL,PRIMARY KEY (`id`)
)";
$result = mysqli_query($conn, $sql2);


$query = "SELECT id FROM cashtype";
    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result) == 0) {
$sql ="INSERT INTO `cashtype` (`id`, `typeofcash`) VALUES
(1, 'cash'),
(2, 'e_cash')";

$result = mysqli_query($conn, $sql);
}

$query1 ="CREATE TABLE IF NOT EXISTS`cashtypee` (
  `id` int(35) NOT NULL AUTO_INCREMENT,
  `supppliername` int(255) NOT NULL,
  `batchno` varchar(255) NOT NULL,
  `currentpayment` int(35) NOT NULL,
  `suppliercurrentbilling` int(35) NOT NULL,
  `amountpaid` decimal(65,2) NOT NULL,
  `amountpayable` decimal(65,2) NOT NULL,
  `remark` varchar(255) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),PRIMARY KEY (`id`)
)";
$result = mysqli_query($conn, $query1);



$conn -> close();



}else{
	echo $result;
}