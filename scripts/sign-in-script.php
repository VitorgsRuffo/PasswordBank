<?php 
	
	if(isset($_POST['submit'])){

		require('../config/db_connect.php');

		$emailuid = $_POST['emailuid'];
		$password = $_POST['password'];


		//validating input:

			if(empty($emailuid) || empty($password)){

				header("Location: ../sign-in.php?error=emptyfields");

				exit();

			
			} 
			//now we'll check if there is a user on the database that matches the data submited(username or email, and password) on the sign in form:
			else {

				//"Select all coluns from table user_registration where the email colum is equal to ? or username is equal to ?"

				//"Technically we're selecting a entire unique row of the table where the username or the email matches the one user entered. By unique a mean that either it'll be select ONE row or NO ONE because different users cannot have the same username or email address"
				$sql = "SELECT * FROM user_registration WHERE email=? OR username=?";	

				$statement = mysqli_stmt_init($connection);

				if(!mysqli_stmt_prepare($statement, $sql)){

					header("Location: ../sign-in.php?error=sqlerror");

					exit();

				}

				else{

					mysqli_stmt_bind_param($statement, "ss", $emailuid, $emailuid);

					mysqli_stmt_execute($statement);


					//after executing the statement the results are going to be inside it so we can use this funtion to grab it.
					$result = mysqli_stmt_get_result($statement);


					//converting the data that we might have received into an associative array:
					$record = mysqli_fetch_assoc($result);



					//if record has a truthy value and not a falsy one we know that we found a match on the database. So now we'll check if the password submited matches the one in the same record(row) of the Email/Username submited:

					//(record array will only have info about one specific row)
					if($record){

						//this function will take password user tried to sign in with(1st param) and the password from database (2nd param), will hash the user password, and finally will check if they match.
						$passwordCheck = password_verify($password, $record['password']);


						if($passwordCheck == false){

							header("Location: ../sign-in.php?error=wrongpwd");

							exit();

						}

						//now that the user entered the right info let's sign him in to the website: we're gonna use $_SESSION.
						else if($passwordCheck == true){

							//we'll use the SESSION vars to tell if user is logged in or logged out.

							//In order to see those global vars we need to start a session on every page that will user 'em. (That's why we started a session on top of the header file)
							session_start();

							$_SESSION['userId'] = $record['id'];
							$_SESSION['username'] = $record['username'];

							header("Location: ../home.php");

							exit();

						}

						else {

							header("Location: ../sign-in.php?error=wrongpwd");

							exit();

						}

					}

					//as user don't typed an proper Email/username we send him back to sign in page with an error message:
					else{

						header("Location: ../sign-in.php?error=incorrectuser");

						exit();

					}

				}

			}



	} else {

		header("Location: ../sign-in.php");

		exit();

	}

?>