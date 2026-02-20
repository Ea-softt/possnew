<?php
include('server/config.php');

	
	$query 	= mysqli_real_escape_string($conn, $_POST['query']);	
	$show 	= "SELECT * FROM customer WHERE firstnamec LIKE '%{$query}%'";
	$result	= mysqli_query($conn,$show);
	$array  = array();

		while($row = mysqli_fetch_assoc($result)){
			$array[] =$row['firstnamec'].' '.$row['lastnamec'];				
		}
		print json_encode($array);

