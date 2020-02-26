
<?php require('templates/header_1.php'); ?>
	
	<main>
		<div>
			<h2>Sign in</h2>
		</div>

		<div>
				
			<form action="scripts/sign-in-script.php" method="POST">

				<div></div>
					
				<label for="Email">E-mail</label>
				<input type="email" name="email" id="Email">


				<label for="pwd">Password</label>
				<input type="password" name="password" id="pwd">

				<input type="submit" name="submit" value="Sign in">

				<div><a href="#">Forgot password?</a></div>

				<div>Don't have an account? <a href="sign-up.php">Sign up</a></div>

			</form>
		</div>
	</main>

<?php require('templates/footer.php'); ?>

