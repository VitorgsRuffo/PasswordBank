
<?php require('templates/header.php'); ?>
	
	<main>
		<div>
			<h2>Sign in</h2>
		</div>

		<div>
				
			<form action="scripts/sign-in-script.php" method="POST">

				<div></div>
					
				<label for="Emailuid">E-mail/Username</label>
				<input type="text" name="emailuid" id="Emailuid">


				<label for="pwd">Password</label>
				<input type="password" name="password" id="pwd">

				<input type="submit" name="submit" value="Sign in">

				<div><a href="#">Forgot password?</a></div>

				<div>Don't have an account? <a href="sign-up.php">Sign up</a></div>

			</form>
		</div>
	</main>

<?php require('templates/footer.php'); ?>

