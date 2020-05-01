<?php require("templates/header.php"); ?>

<?php  
  
?>

    <main>
        <div>
            <div>
                <h3>Profile</h3>
                <h4>Username: <?php echo $_SESSION['username']; ?></h4>
                <h4>Email: <?php echo $_SESSION['email']; ?></h4>
            </div>
            <div>
                <form action="#" method="POST">
                    <input type="submit" name="edit" value="Edit">
                </form>
            </div>
        </div>
    </main>

<?php require("templates/footer.php"); ?>



