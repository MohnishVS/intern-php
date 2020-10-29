<?php
	//DB connection
	define('DB_SERVER', 'localhost');
	define('DB_USERNAME', 'root');
	define('DB_PASSWORD', '');
	define('DB_NAME', 'register_db');
	
	/* Attempt to connect to MySQL database */
	try{
		$db = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);
		// Set the PDO error mode to exception
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo ("success");
	} 
	catch(PDOException $e){
		die("ERROR: Could not connect. " . $e->getMessage());
    }
?>