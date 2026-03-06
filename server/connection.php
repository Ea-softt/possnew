<?php
$database	= 'pos.db';
$msg 		= '';

ini_set('display_errors',1);
error_reporting(E_ALL);

try {
	$db = new PDO("sqlite:" . __DIR__ . "/" . $database);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
	die("Connection Failed: " . $e->getMessage());
}
/*
if(!isset($_SESSION)){
	session_start();	
}

if (isset($_POST['logout'])){
	$user = $_SESSION['username'];
	$insert	= "INSERT INTO logs (username,purpose) VALUES('$user','User $user logout')";
 	$logs = $db->exec($insert);
	session_destroy();
	unset($_SESSION['username']);
	header('location: ../index.php');
}
*/
