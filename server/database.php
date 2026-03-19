<?php  
		//session_start();	
		//	$dbname = "pos.db";

			// try {
			// 	$conn = new PDO("sqlite:" . __DIR__ . "/" . $dbname);
			// 	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			// } catch (PDOException $e) {
			// 	echo "Connection failed: " . $e->getMessage();
			// 	exit;
			// }	


  // 1. Define the persistent AppData path
$appDataDir = getenv('APPDATA') . DIRECTORY_SEPARATOR . 'easoft' . DIRECTORY_SEPARATOR;
$dbname = "pos.db";
$db_path = $appDataDir . $dbname;

// 2. Automatically create the 'easoft' folder if it doesn't exist
if (!is_dir($appDataDir)) {
    mkdir($appDataDir, 0777, true);
}

// 3. Establish the PDO connection
try {
    $conn = new PDO("sqlite:" . $db_path);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Optional: Enable Foreign Keys for SQLite
    $conn->exec("PRAGMA foreign_keys = ON;");
    
} catch (PDOException $e) {
    // In a production POS, you might want to log this instead of echoing
    die("Database Connection Error: " . $e->getMessage());
}





















	$sql ="CREATE TABLE IF NOT EXISTS `cashflow` (
  `transaction_id` INTEGER PRIMARY KEY AUTOINCREMENT,
  `description` TEXT,
  `amount` REAL DEFAULT NULL,
  `username` TEXT DEFAULT NULL,
  `transaction_date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
)";
	$conn->exec($sql);


$sql = "CREATE TABLE IF NOT EXISTS `customer` (
  `customer_id` INTEGER PRIMARY KEY AUTOINCREMENT,
  `firstnamec` TEXT DEFAULT NULL,
  `lastnamec` TEXT DEFAULT NULL,
  `address` TEXT,
  `contact_number` TEXT DEFAULT NULL,
  `image` TEXT NOT NULL
)";
$conn->exec($sql);


$sql = "CREATE TABLE IF NOT EXISTS`cashtype` (
  `id` INTEGER PRIMARY KEY,
  `typeofcash` TEXT NOT NULL
)";
$conn->exec($sql);


$sql = "CREATE TABLE IF NOT EXISTS `cashtypee` (
  `id` INTEGER PRIMARY KEY AUTOINCREMENT,
  `supppliername` INTEGER NOT NULL,
  `batchno` TEXT NOT NULL,
  `currentpayment` REAL NOT NULL,
  `suppliercurrentbilling` REAL NOT NULL,
  `amountpaid` REAL NOT NULL,
  `amountpayable` REAL NOT NULL,
  `remark` TEXT NOT NULL,
  `created_date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
)";
$conn->exec($sql);

$sql = "CREATE TABLE IF NOT EXISTS `updatewarehouse` (
  `id` INTEGER PRIMARY KEY AUTOINCREMENT,
  `product_id` INTEGER NOT NULL,
   `productname` TEXT NOT NULL,
  `quantity` INTEGER NOT NULL,
  `price` REAL NOT NULL,
  `tprice` REAL NOT NULL,
  `companyname` TEXT NOT NULL,
  `unity` TEXT NOT NULL,
  `expiredate` INTEGER NOT NULL,
  `description` TEXT NOT NULL,
  `images` INTEGER NOT NULL,
  `created_date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
)";
$conn->exec($sql);



$sql = "CREATE TABLE IF NOT EXISTS `customersale` (
  `id` INTEGER PRIMARY KEY AUTOINCREMENT,
  `salername` TEXT NOT NULL,
  `customername` TEXT NOT NULL,
  `totalsale` REAL NOT NULL,
  `discount` REAL NOT NULL,
  `grandtotal` REAL NOT NULL,
  `days` INTEGER NOT NULL,
  `month` TEXT NOT NULL,
  `year` INTEGER NOT NULL,
  `created_date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
)";
$conn->exec($sql);



$sql = "CREATE TABLE IF NOT EXISTS `login` (
  `id` INTEGER PRIMARY KEY AUTOINCREMENT,
  `uid` INTEGER NOT NULL,
  `password` TEXT NOT NULL,
  `username` TEXT NOT NULL,
  `type` TEXT NOT NULL
)";
$conn->exec($sql);

$query = "SELECT id FROM login";
		$result12 = $conn->query($query);
		if($result12 && count($result12->fetchAll()) == 0) {

$sql = "INSERT INTO `login` (`id`, `uid`, `password`, `username`, `type`) VALUES
(1, 1, 'c4ca4238a0b923820dcc509a6f75849b', 'a', 'Admin')";
$conn->exec($sql);

}

$sql = "CREATE TABLE IF NOT EXISTS `moneyin` (
  `id` INTEGER PRIMARY KEY AUTOINCREMENT,
  `total_amount` REAL NOT NULL,
  `name` TEXT NOT NULL,
  `day` INTEGER NOT NULL,
  `month` TEXT NOT NULL,
  `year` INTEGER NOT NULL
)";
$conn->exec($sql);


$sql = "CREATE TABLE IF NOT EXISTS `moneyin_des` (
  `did` INTEGER PRIMARY KEY AUTOINCREMENT,
  `money_id` INTEGER NOT NULL,
  `description` TEXT NOT NULL,
  `amount` REAL NOT NULL
)";
$conn->exec($sql);

$sql = "CREATE TABLE IF NOT EXISTS `moneyout` (
  `id` INTEGER PRIMARY KEY AUTOINCREMENT,
  `total_amount` REAL NOT NULL,
  `name` TEXT NOT NULL,
  `day` INTEGER NOT NULL,
  `month` TEXT NOT NULL,
  `year` INTEGER NOT NULL
)";
$conn->exec($sql);


$sql = "CREATE TABLE IF NOT EXISTS `moneyout_des` (
  `did` INTEGER PRIMARY KEY AUTOINCREMENT,
  `money_id` INTEGER NOT NULL,
  `description` TEXT NOT NULL,
  `amount` REAL NOT NULL
)";
$conn->exec($sql);

$sql = "CREATE TABLE IF NOT EXISTS `newemployee` (
  `EmpID` INTEGER PRIMARY KEY AUTOINCREMENT,
  `FullName` TEXT NOT NULL,
  `Gender` TEXT NOT NULL,
  `DOB` TEXT NOT NULL,
  `Age` INTEGER NOT NULL,
  `Hometown` TEXT NOT NULL,
  `Nationality` TEXT NOT NULL,
  `Phonenum` TEXT NOT NULL,
  `Mail` TEXT NOT NULL,
  `Address` TEXT NOT NULL,
  `Address2` TEXT NOT NULL,
  `Status` TEXT NOT NULL,
  `Department` TEXT NOT NULL,
  `Lastschool` TEXT NOT NULL,
  `Qualification` TEXT NOT NULL,
  `StartingDate` TEXT NOT NULL,
  `Employer` TEXT NOT NULL,
  `Language` TEXT NOT NULL,
  `Religion` TEXT NOT NULL,
  `picture` TEXT NOT NULL
)";

$conn->exec($sql);



$query = "SELECT EmpID FROM newemployee";
		$result = $conn->query($query);
		if($result && count($result->fetchAll()) == 0) {

$sql = "INSERT INTO `newemployee` (`EmpID`, `FullName`, `Gender`, `DOB`, `Age`, `Hometown`, `Nationality`, `Phonenum`, `Mail`, `Address`, `Address2`, `Status`, `Department`, `Lastschool`, `Qualification`, `StartingDate`, `Employer`, `Language`, `Religion`, `picture`) VALUES

(1, 'benedicta YAA AKORLI', 'Male', '2005-02-02', 24, 'bokorkrom', 'Ghanaian', '0553896769', 'botee2020@gmail.com', '	bokorkrom d/a basic school post office box 88 daboase	\r\n		', '	bokorkrom d/a basic school post office box 88 daboase	\r\n		', 'Active', 'Active', 'benedicta YAA AKORLI', 'Degree', '2022-01-15', '', 'Nzema', 'Christian', '1641072420_1633495740_Ea-Softlogo.png')";

$conn->exec($sql);

}

$sql = "CREATE TABLE IF NOT EXISTS `logs` (
  `id` INTEGER PRIMARY KEY AUTOINCREMENT,
  `username` TEXT NOT NULL,
  `purpose` TEXT NOT NULL,
  `created_date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
)";
$conn->exec($sql);


$sql = "CREATE TABLE IF NOT EXISTS `note` (
  `id` INTEGER PRIMARY KEY AUTOINCREMENT,
  `title` TEXT NOT NULL,
  `notee` TEXT NOT NULL,
  `created_date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
)";
$conn->exec($sql);


$sql = "CREATE TABLE IF NOT EXISTS `prod` (
  `id` INTEGER PRIMARY KEY AUTOINCREMENT,
  `name` TEXT NOT NULL
)";
$conn->exec($sql);


$sql = "CREATE TABLE IF NOT EXISTS `products` (
  `id` INTEGER PRIMARY KEY AUTOINCREMENT,
  `product_no` TEXT NOT NULL,
  `barcode` TEXT DEFAULT NULL,
  `product_name` TEXT DEFAULT NULL,
  `sell_price` REAL DEFAULT NULL,
  `cprice` REAL NOT NULL,
  `quantity` INTEGER DEFAULT NULL,
  `unit` TEXT DEFAULT NULL,
  `min_stocks` INTEGER DEFAULT NULL,
  `expire_date` TEXT NOT NULL,
  `remarks` TEXT,
  `location` TEXT NOT NULL,
  `images` TEXT NOT NULL
)";
$conn->exec($sql);


$sql = "CREATE TABLE IF NOT EXISTS `salecustomeriterm` (
  `barcode` INTEGER PRIMARY KEY AUTOINCREMENT,
  `product` TEXT NOT NULL,
  `price` REAL NOT NULL,
  `unit` TEXT NOT NULL,
  `qty` INTEGER NOT NULL,
  `subtotal` REAL NOT NULL,
  `salecustomerid` INTEGER NOT NULL
)";
$conn->exec($sql);


$sql = "CREATE TABLE IF NOT EXISTS `sales` (
  `reciept_no` INTEGER PRIMARY KEY AUTOINCREMENT,
  `customer_id` INTEGER NOT NULL,
  `username` TEXT NOT NULL,
  `discount` REAL NOT NULL,
  `total` REAL NOT NULL,
  `grandtotal` REAL NOT NULL,
  `typeofcash` TEXT NOT NULL,
  `days` INTEGER NOT NULL,
  `month` TEXT NOT NULL,
  `years` INTEGER NOT NULL,
  `created_date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
)";
$conn->exec($sql);



$sql = "CREATE TABLE IF NOT EXISTS `sales_product` (
  `reciept_no` INTEGER NOT NULL,
  `product_id` TEXT NOT NULL,
  `price` REAL NOT NULL,
  `qty` INTEGER NOT NULL,
  `created_date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
)";
$conn->exec($sql);



$sql = "CREATE TABLE IF NOT EXISTS `supplier` (
  `supplier_id` INTEGER PRIMARY KEY AUTOINCREMENT,
  `companyname` TEXT NOT NULL,
  `firstname` TEXT NOT NULL,
  `lastname` TEXT NOT NULL,
  `address` TEXT NOT NULL,
  `contact_number` TEXT NOT NULL,
  `image` TEXT NOT NULL
)";
$conn->exec($sql);


$sql = "CREATE TABLE IF NOT EXISTS `suppliercompany` (
  `id` INTEGER PRIMARY KEY AUTOINCREMENT,
  `companynameid` INTEGER NOT NULL,
  `price2` REAL NOT NULL,
  `multtota2` REAL NOT NULL,
  `date_deliver` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
)";
$conn->exec($sql);


$sql = "CREATE TABLE IF NOT EXISTS `supplierdeliver` (
  `sid` INTEGER PRIMARY KEY AUTOINCREMENT,
  `name` TEXT NOT NULL,
  `image` INTEGER NOT NULL,
  `description` TEXT NOT NULL,
  `supplierid` INTEGER NOT NULL,
  `created_date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
)";
$conn->exec($sql);



$sql = "CREATE TABLE IF NOT EXISTS `users` (
  `id` INTEGER PRIMARY KEY AUTOINCREMENT,
  `firstname` TEXT NOT NULL,
  `lastname` TEXT NOT NULL,
  `position` TEXT NOT NULL,
  `contact_number` TEXT NOT NULL,
  `picture` TEXT NOT NULL
)";
$conn->exec($sql);


$sql = "CREATE TABLE IF NOT EXISTS `warehouse` (
  `sid` INTEGER PRIMARY KEY AUTOINCREMENT,
  `supplierid` INTEGER NOT NULL,
  `name` TEXT NOT NULL,
  `quantity` INTEGER NOT NULL,
  `price` REAL NOT NULL,
  `multtota` INTEGER NOT NULL,
  `unit` TEXT NOT NULL,
  `description` TEXT NOT NULL,
  `expire_date` TEXT NOT NULL,
  `picture` TEXT NOT NULL,
  `create_date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
)";
$conn->exec($sql);

$sql1 = "CREATE TABLE IF NOT EXISTS `newstock` (
  `id` INTEGER PRIMARY KEY AUTOINCREMENT,
  `productID` INTEGER NOT NULL,
  `product_no` TEXT NOT NULL,
  `product_name` TEXT NOT NULL,
  `sell_price` REAL NOT NULL,
  `cprice` INTEGER NOT NULL,
  `quantity` INTEGER NOT NULL,
  `unit` TEXT NOT NULL,
  `min_stocks` INTEGER NOT NULL,
  `expire_date` TEXT NOT NULL,
  `remarks` TEXT NOT NULL,
  `supplier_id` INTEGER NOT NULL,
  `images` TEXT,
  `date_created` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
)";
$conn->exec($sql1);



$sql2 = "CREATE TABLE IF NOT EXISTS `cashtype` (
  `id` INTEGER PRIMARY KEY AUTOINCREMENT,
  `typeofcash` TEXT NOT NULL
)";
$conn->exec($sql2);


$query = "SELECT id FROM cashtype";
    $result = $conn->query($query);
    if($result && count($result->fetchAll()) == 0) {
$sql ="INSERT INTO `cashtype` (`id`, `typeofcash`) VALUES
(1, 'cash'),
(2, 'e_cash')";

$conn->exec($sql);
}

$query1 ="CREATE TABLE IF NOT EXISTS`cashtypee` (
  `id` INTEGER PRIMARY KEY AUTOINCREMENT,
  `supppliername` INTEGER NOT NULL,
  `batchno` TEXT NOT NULL,
  `currentpayment` INTEGER NOT NULL,
  `suppliercurrentbilling` INTEGER NOT NULL,
  `amountpaid` REAL NOT NULL,
  `amountpayable` REAL NOT NULL,
  `remark` TEXT NOT NULL,
  `created_date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
)";
$conn->exec($query1);