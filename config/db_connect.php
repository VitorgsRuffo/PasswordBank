<?php 
	
	$serverName = NULL;
	$dbUsername = "root";
	$dbPassword = "";
	$dbName = "passwordbank";
	$port = "80";
	$socket = "";


	$connection = mysqli_connect($serverName, $dbUsername, $dbPassword, $dbName, $port, $socket);

	if(!$connection){

		echo 'Database connection error: ' . mysqli_connect_error() . mysqli_error($connection) . PHP_EOL;

		
		die('Database connection error: ' . mysqli_connect_error());

	}

?>
