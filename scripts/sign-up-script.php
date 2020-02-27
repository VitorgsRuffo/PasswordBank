<?php 

	if(isset($_POST['submit'])){

		//connecting to the database system:
		require('../config/db_connect.php');
		
		//grabbing user submited data:
		$username = $_POST['username'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		$password_2 = $_POST['password-2'];


		//validating user input:
		
			//checking if any field is empty:
			if(empty($username) || empty($email) ||empty($password) || empty($password_2)){

				header("Location: ../sign-up.php?error=emptyfields&username=".$username."&email=".$email);

				//stops the this script from running. We don't wanna to continue to run it if user left any field empty.
				exit();


			//checking for valid email AND valid username:
			}else if(!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $username)){

				header("Location: ../sign-up.php?error=invaliddata");

				exit();


			//checking for a valid e-mail:
			} else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){

				header("Location: ../sign-up.php?error=invalidemail&username=".$username);

				exit();

			//checking for a valid username: REGEX
			} else if(!preg_match("/^[a-zA-Z0-9]*$/", $username)){

				header("Location: ../sign-up.php?error=invalidusername&email=".$email);

				exit();

			//checking if password and password_2 matches:
			} else if($password !== $password_2){

				header("Location: ../sign-up.php?error=differentpasswords&username=".$username."&email=".$email);

				exit();

			} else {
				//checking if username already exists:


					//we're gonna user prepared statements to run the query safely on the database.

					//?: is a placeholder.
					$sql = "SELECT username FROM user_registration WHERE username=?";

					//create a prepared statement:
					$statement = mysqli_stmt_init($connection);

					//preparing the statement:
					if(!mysqli_stmt_prepare($statement, $sql)){

						header("Location: ../sign-up.php?error=sqlerror");

						exit();

					//if we successfully prepared the statement:
					} else {

						//attaching the user data to the sql statement placeholder(?):

						
						mysqli_stmt_bind_param($statement, "s", $username);
						//1st param: statement
						//2nd: data type.
						//(//s: string, b: blob, i: integer, double: d.)
						//3rd: user data itself;

						//Finally running the query command on the database:
						mysqli_stmt_execute($statement);


						//checking if we had a match (meaning if that username was already registered at the website)

							//storing the result inside the statement var itself:
							mysqli_stmt_store_result($statement);

							//getting how many rows from the database was returned by the query command. 
							$resultCheck = mysqli_stmt_num_rows($statement);

							//(obviously it's gonna be either 0 or 1, because either an user has already taken that username or not.)
							if($resultCheck > 0){

								header("Location: ../sign-up.php?error=usernamealreadytaken&email=".$email);

								exit();
							}

					}


				//one more check: checking if email has already been registered at the website.

					//soon:
			}


		//if we got to this part of the code, it means that there weren't any errors and now we can sign the user up to the website:

			//making the sql command with the placeholders for the user input
			$sql = "INSERT INTO user_registration(username, email, password) VALUES(?, ?, ?)";

			//creating a statement that will receive the sql command:
			$statement = mysqli_stmt_init($connection);

			//checking if we can run the sql statement in the database: if it is a correct statement.
			if(!mysqli_stmt_prepare($statement, $sql)){

				header("Location: ../sign-up.php?error=sqlerror");

				exit();
			} 

			//if we can, then:
			else{

				//before we bind the password to the statement we need to hash (encrypt) it first: if a hacker gets access to our database he will not be able to see the password.

				//second parameter is a hashing method: the best is Bcrypt.
				$hashedPassword = password_hash($password, PASSWORD_DEFAULT);


				//binding to the sql statement the user data needed to run it properly.
				mysqli_stmt_bind_param($statement, "sss", $username, $email, $hashedPassword);

				//executing the command on the database:
				mysqli_stmt_execute($statement);

				header("Location: ../sign-up.php?signup=success");

				exit();

			}

		//freeing resources used:

		mysqli_stmt_close($statement);

		mysqli_close($connection);

	//if user haven't gotten here by clicking the form submit button we wanna redirect him back to the sign up page: we don't wanna run all this code if user is not trying to signing up.
	} else {

		header("Location: ../sign-up.php");

		exit();

	}

?>




