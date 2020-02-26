<?php 

	$connection = mysqli_connect('localhost', 'vitor', 'vitor123', 'PasswordBank_db');

	if(!$connection){

		echo 'Database connection error: ' . mysqli_connect_error(); 

	}



?>