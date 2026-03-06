<?php
include('server/config.php');

	
	$query 	= $_POST['query'];
	$stmt 	= $conn->prepare("SELECT * FROM customer WHERE firstnamec LIKE :query");
	$stmt->execute([':query' => '%' . $query . '%']);
	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	$array  = array();

		foreach($result as $row){
			$array[] =$row['firstnamec'].' '.$row['lastnamec'];				
		}
		print json_encode($array);
