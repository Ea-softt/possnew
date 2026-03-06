<?php  
		//session_start();	
			$dbname = "school.db";

			try {
				$conn = new PDO("sqlite:" . __DIR__ . "/" . $dbname);
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			} catch (PDOException $e) {
				echo "Connection failed: " . $e->getMessage();
			}	
?>	