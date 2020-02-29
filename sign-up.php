
<?php require('templates/header.php'); ?>

	<!--This piece of script here will let the user know if he has made some mistake when filling the register form by showing some specfic massages -->
	<?php  	

		$empty = '';
		$usernameError  = '';
		$emailError = '';
		$pwdError = '';

		$username = '';
		$email = '';


		function fillFields(){

			global $username;

			if(isset($_GET['username']))
				$username = htmlspecialchars($_GET['username']);

			global $email;

			if(isset($_GET['email']))
				$email = htmlspecialchars($_GET['email']);
		}

		if(isset($_GET['error'])){

					
			if($_GET['error'] == "emptyfields"){ 	

				$empty = 'Fill in all fields!';

				fillFields();
					
			}else if($_GET['error'] == "invalidemailandusername"){ 

				$usernameError = 'Enter a valid username!';
				$emailError = 'Enter a valid e-mail!';

				fillFields();

			}else if($_GET['error'] == "invalidemail"){

				$emailError = 'Enter a valid e-mail!';

				fillFields();

			}else if($_GET['error'] == "invalidusername"){

				$usernameError = 'Enter a valid username!';

				fillFields();

			}else if($_GET['error'] == "differentpasswords"){

				$pwdError = "Passwords don't match!";

				fillFields();

			}else if($_GET['error'] == "usernamealreadytaken"){

				$usernameError = 'Username already taken!';

				fillFields();
					
			} 
		}
				
	?>	

	<main>
		<div>
			<div>
				<h2>Now you are only a few steps from keeping all your passwords safe!</h2>

				<h3>Create your account</h3>
			</div>

			<div>

				<form action="scripts/sign-up-script.php" method="POST">

					<div><?php echo $empty; ?></div>

					<label for="username">Username</label>
					<input type="text" name="username" id="username" value="<?php echo $username; ?>">
					<div><?php echo $usernameError; ?></div>

					<label for="Email">E-mail</label>
					<input type="text" name="email" id="Email" value="<?php echo $email; ?>">
					<div><?php echo $emailError; ?></div>

					<label for="pwd">Password</label>
					<input type="password" name="password" id="pwd">
					<div></div>

					<label for="pwd-2">Repeat password</label>
					<input type="password" name="password-2" id="pwd-2">
					<div><?php echo $pwdError; ?></div>

					<div><input type="checkbox" name="cBox">By clicking, you agree to our Terms of Use and Privacy Policy.</div>

					<input type="submit" name="submit" value="Sign up">
						
				</form>

				<div>
					Already have an account? <a href="sign-in.php">Sign in</a>
				</div>

			</div>
		</div>
	</main>
		
<?php require('templates/footer.php'); ?>

