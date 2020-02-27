
<?php require('templates/header.php'); ?>
	
	<main>
		<div>
			<div>
				<h2>Now you are only a few steps from keeping all your passwords safe!</h2>

				<h3>Create your account</h3>
			</div>

			<div>

				<form action="scripts/sign-up-script.php" method="POST">

					<label for="username">Username</label>
					<input type="text" name="username" id="username">
					<div></div>

					<label for="Email">E-mail</label>
					<input type="text" name="email" id="Email">
					<div></div>

					<label for="pwd">Password</label>
					<input type="password" name="password" id="pwd">
					<div></div>

					<label for="pwd-2">Repeat password</label>
					<input type="password" name="password-2" id="pwd-2">
					<div></div>

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

