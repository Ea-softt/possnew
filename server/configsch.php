<?php  
		//session_start();	
			$host = "localhost";
			$dbuser = "root";
			$dbpass = "";
			$dbname = "databaseschool1";
				//eMMA2020@
			try {
				$conn = new mysqli ("$host","$dbuser","$dbpass","$dbname") or die(conn_error($conn));
				
				
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

?>	