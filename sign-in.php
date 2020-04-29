<?php require('templates/header.php'); ?>
	
	<!--This piece of script here will let the user know if he has made some mistake when trying to sign in by showing some specfic massages -->
	<?php 

		$error = '';

		if(isset($_GET['error'])){

			if($_GET['error'] == 'emptyfields'){

				$error = 'Fill in all fields.';

			}else if($_GET['error'] == 'incorrectuser'|| $_GET['error'] == 'wrongpwd'){

				$error = 'Incorrect username or password.';

			}
		}

	?>
	
	<main>
		<div>
			<h2>Sign in</h2>
		</div>

		<div>	
			<form action="scripts/sign-in-script.php" method="POST">

				<div><?php echo $error; ?></div>
					
				<label for="Emailuid">E-mail/Username</label>
				<input type="text" name="emailuid" id="Emailuid">

				<label for="pwd">Password</label>
				<input type="password" name="password" id="pwd">

				<input type="submit" name="submit" value="Sign in">
			</form>

			<div><a href="#">Forgot password?</a></div>

			<div>Don't have an account? <a href="sign-up.php">Sign up</a></div>
		</div>
	</main>

<?php require('templates/footer.php'); ?>

