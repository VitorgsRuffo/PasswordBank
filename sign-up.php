<?php 

	require('config/db_connect.php');

	if(isset($_POST['submit'])){

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




<!DOCTYPE html>
<html>

	<?php require('templates/header_1.php'); ?>

		<div>
			<div>
				<h2>Wow! now you are only a few steps from keeping all your passwords safe!</h2>

				<h3>Create your account</h3>
			</div>

			<div>

				<form action="sign-up.php" method="POST">

					<label for="Name">Name</label>
					<input type="text" name="name" id="Name">
					<div></div>

					<label for="Email">E-mail</label>
					<input type="email" name="email" id="Email">
					<div></div>

					<label for="pwd">Password</label>
					<input type="password" name="password" id="pwd">
					<div></div>

					<div><input type="checkbox" name="cBox">By clicking, you agree to our Terms of Use and Privacy Policy.</div>

					<input type="submit" name="submit" value="Sign up">
					
				</form>

				<div>
					Already have an account? <a href="sign-in.php">Sign in</a>
				</div>

			</div>
		</div>
		
	<?php require('templates/footer.php'); ?>

</html>