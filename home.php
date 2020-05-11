<?php require("templates/header.php") ?>

<?php 

	//this piece of script don't let people access this page by typing its url on the browser (without signing in)
	if(!isset($_SESSION['username'])){
		header("Location: index.php");
	}

	//we'll have to get those rows from accounts table that the logged user owns to show them(we are going to show 5 on each page):

		require("config/db_connect.php");

		$userid = $_SESSION['userId'];

		//get the total number of account that the current user has registered:
			$sql = "SELECT COUNT(*) FROM accounts WHERE userid = ?";
			$statement = mysqli_stmt_init($connection);
			if(!mysqli_stmt_prepare($statement, $sql)){

				header("Location: home.php?error=sqlerror");
				exit();
			}
			mysqli_stmt_bind_param($statement, "i", $userid);
			mysqli_stmt_execute($statement);
			$result = mysqli_stmt_get_result($statement);
			$record = mysqli_fetch_assoc($result); //we user this to convert the (only) row returned into an associative array.
			$totalRecords = $record['COUNT(*)'];

		//getting the current page the user is on: (if no page is specified on the GET request so we are going to be on the first one by default)
		$page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;

		//number of account that will be shown on each page:
		$numOfAccountsOnEachPage = 5;

		//number of pages that will need to displays all records:
		$totalPages = ceil($totalRecords / $numOfAccountsOnEachPage); 

		//getting the accounts for the current page the user is in:
			$sql = "SELECT * FROM accounts WHERE userid=? ORDER BY service LIMIT ?,?";

			if(!mysqli_stmt_prepare($statement, $sql)){

				header("Location: home.php?error=sqlerror");
				exit();
			}

			$offset = ($page - 1)  * $numOfAccountsOnEachPage;
			mysqli_stmt_bind_param($statement, "iii", $userid, $offset, $numOfAccountsOnEachPage);
			mysqli_stmt_execute($statement);
			$rawResult = mysqli_stmt_get_result($statement);
			$resultSet = mysqli_fetch_all($rawResult, MYSQLI_ASSOC);  //$resultSet will be an array. Each of its element are associative arrays([column1Name] => column1Value, [column2Name] => column2Value ) that corresponds to each row returned by the query.
			mysqli_close($connection);
		
?>

	<main>
		<div>
			<span><h3>Your passwordbank:</h3></span>
			<div><a href="add-account.php"><h3>Add new account</h3></a></div>
			<div>
				<table>	
					<tr>
						<th>Service</th>
						<th>Description</th>
						<th>..</th>
					</tr>       
					<?php foreach($resultSet as $row): ?>
						<tr>								
							<td><h4><?php echo htmlspecialchars($row['service']);?></h4></td>
							<td><?php echo htmlspecialchars($row['description']);?></td>						
							<td><a href="account-details.php?id=<?php echo htmlspecialchars($row['id']);?>">More</a></td>						
						</tr>
					<?php endforeach; ?>
				</table>	
			</div>
			<div>
				<?php if($totalPages > 0): ?>
					<ul>
						<?php if($page > 1): ?>
							<li class="previousPage"><a href="home.php?page=<?php echo $page-1;?>">Previous</a></li>
						<?php endif; ?>
						<li class="currentPage"><a href="home.php?page=<?php echo $page;?>"><?php echo $page;?></a></li>
						<?php if($page < $totalPages): ?>
							<li class="nextPage"><a href="home.php?page=<?php echo $page+1;?>">Next</a></li>
						<?php endif; ?>
					</ul>
				<?php endif; ?>
			</div>
		</div>
	</main>

<?php require("templates/footer.php") ?>