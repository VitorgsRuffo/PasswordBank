<?php session_start(); ?>

<!DOCTYPE html>
<html>

	<head>

		<meta charset="utf-8">

		<title>PasswordBank</title>

	</head>

	<body>

		<header>
			
			<a href="index.php"><h1>PasswordBank</h1></a>

			<?php if(!isset($_SESSION['username'])): ?>
				
				<nav>
					<ul>
						<li><a href="index.php">The idea</a></li>
						<li><a href="sign-in.php">Sign in</a></li>
						<li><a href="sign-up.php">Sign up</a></li>
					</ul>
				</nav>

			<?php else: ?>

				<nav>
					<ul>
						<li>Welcome <?php echo htmlspecialchars($_SESSION['username']); ?></li>
						<li><a href="profile.php">Profile</a></li>
						<li><a href="index.php">The idea</a></li>
						<li><a href="home.php">Home</a></li>
					</ul>
				</nav>

				<form action="scripts/sign-out-script.php" method="POST">
					<input type="submit" name="signout" value="Sign out">
				</form>

			<?php endif; ?>

		</header>