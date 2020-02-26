<?php 
	
	$serverName = "localhost";
	$dbUsername = "vitor";
	$dbPassword = "vitor123";
	$dbName = "PasswordBank_db";


	$connection = mysqli_connect($serverName, $dbUsername, $dbPassword, $dbName);

	if(!$connection){

		echo 'Database connection error: ' . mysqli_connect_error(); 

		die('Database connection error: ' . mysqli_connect_error());

	}

?>