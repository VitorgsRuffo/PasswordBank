
<?php require("templates/header.php") ?>

<?php 

	//this piece of script don't let people access this page by typing its url on the browser (without signing in)
	
	if(!isset($_SESSION['username'])){
		header("Location: index.php");
	}

?>







	<h1>HOME PAGE</h1>

	<h2>Your logged!!</h2>












<?php require("templates/footer.php") ?>