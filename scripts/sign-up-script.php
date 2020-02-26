<?php 

	if(isset($_POST['submit'])){

		require('../config/db_connect.php');

		//validate input: (REGEX).

			//if is not valid:

				//reload this page showing the errors

			//else:

				//add new user to database:

					//escaping any possible malicous SQL code:
					$name = mysqli_real_escape_string($connection, $_POST['name']);

					$email = mysqli_real_escape_string($connection, $_POST['email']);

					$password = mysqli_real_escape_string($connection, $_POST['password']);

					//Inserting the data into the database:

					$sql = "INSERT INTO user_registration(name, email, password) VALUES('$name', '$email', 'password')";

					if(mysqli_query($connection, $sql)){
						header('Location: index.php');
					}else{
						echo "Insertion in database error: " . sqli_error();
					}

	}

?>
