<?php 
	
	session_start();

	//unset all session variables created so far:
	session_unset();


	//destroy all sessions running inside this website:
	session_destroy();


	header("Location: ../index.php");
?>