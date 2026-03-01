<?php
	session_start();
	session_destroy();
	unset($_SESSION['meg']);
	unset($_SESSION['LAST_ACTIVE_TIME']); 
	$_SESSION['meg'] = "You logout Bye Bye!!!";
	header('location:Login.php ');
?>