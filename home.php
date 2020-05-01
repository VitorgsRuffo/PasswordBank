<?php require("templates/header.php") ?>

<?php 

	//this piece of script don't let people access this page by typing its url on the browser (without signing in)
	if(!isset($_SESSION['username'])){
		header("Location: index.php");
	}

	//we'll have to get those rows from accounts table that the logged user owns to show them in this page:

		require("config/db_connect.php");

		$userid = $_SESSION['userId'];

		$sql = "SELECT id, service, emailuid, pwd, extra, description FROM accounts WHERE userid = ?";

		$statement = mysqli_stmt_init($connection);

		if(!mysqli_stmt_prepare($statement, $sql)){

			header("Location: home.php?error=sqlerror");
			exit();
		}

		mysqli_stmt_bind_param($statement, "i", $userid);

		mysqli_stmt_execute($statement);

		$rawResult = mysqli_stmt_get_result($statement);

		$resultSet = mysqli_fetch_all($rawResult, MYSQLI_ASSOC); //$resultSet will be an array. Each of its element are associative arrays([columnName] => columnValue) that corresponds to each row returned by the query.

		mysqli_close($connection);
?>

	<main>
		<div>
			<span><h3>Your passwordbank:</h3></span>

			<div>
				<ul>	       
					<?php foreach($resultSet as $row): ?>
						<div>
							<div>
								<li> 
									<h4> <?php echo htmlspecialchars($row['service']);?> </h4>
									<p><i>Description:</i> <?php echo htmlspecialchars($row['description']); ?> </p>
								</li>
							</div>

							<div>
								<a href="account-details.php?id=<?php echo htmlspecialchars($row['id']);?>">More</a>
							</div>
						</div>
					<?php endforeach; ?>
				</ul>	
			</div>

			<div><a href="add-account.php"><h3>Add new account</h3></a></div>
		</div>
	</main>

<?php require("templates/footer.php") ?>