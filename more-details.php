<?php require("templates/header.php"); ?>

<?php  

    if(!isset($_SESSION['username'])){// in case user tries to accces this page without being logged in an account.
        header("Location: index.php");
        exit();
    }

    require("config/db_connect.php");

    //dealing with a post request to this page which intent is to delete a account.
    if(isset($_POST['delete'])){

        $idToDelete =  mysqli_real_escape_string($connection, $_POST['idToDelete']);

        $sql = "DELETE FROM accounts WHERE id=?";

        $statement = mysqli_stmt_init($connection);

        if(!mysqli_stmt_prepare($statement, $sql)){
            header("Location: more-details.php?deleteError=sqlerror");
            exit();
        }

        mysqli_stmt_bind_param($statement, "i", $idToDelete);

        mysqli_stmt_execute($statement);

        header("Location: home.php?delete=success");
    }

    //we need to get from database the data related to the unique account that user wanna see more info about.
    //for that end, we attached each account's id to their 'more button' on home page so that when user clicks it the right id is sent to more-details.php.
    else if(isset($_GET['id'])){

        //we must scape any possible SQL chars because user can try to get to this page by typing its url, and that person can do so. But the problem is if the person inserts dangerous SQL statement in the id's value.
        $id = mysqli_real_escape_string($connection, $_GET['id']);

        $sql = "SELECT * FROM accounts WHERE id=?";

        $statement = mysqli_stmt_init($connection);

        if(!mysqli_stmt_prepare($statement, $sql)){
            header("Location: home.php?error=sqlerror");
            exit();
        }

        mysqli_stmt_bind_param($statement, "i", $id);

        mysqli_stmt_execute($statement);

        $result = mysqli_stmt_get_result($statement);

        $row = mysqli_fetch_assoc($result);
        
        if($_SESSION['userId'] !== $row['userid']){ //in case user tries to render info about a account that he does not own.
            header("Location: home.php?sessionid=".$_SESSION['userId']."&userid=".$row['userid']);
            exit();
        }

        //print_r($row);

    }else{ //in case user tries to access this page without sending an id.
        header("Location: home.php");
        exit();
    }

?>

<!-- if the that specific data in hand we can render the page properly:-->

    <main>
        <div>
            <h2><?php echo htmlspecialchars($row['service']); ?></h2>
        
            <h3>Email/username: </h3>
            <p><?php echo htmlspecialchars($row['emailuid']);?> </p>
            <h3>Password: </h3>
            <p><?php echo htmlspecialchars($row['pwd']);?> </p>
            <h3>Extra information: </h3>
            <p><?php echo htmlspecialchars($row['extra']);?> </p>
            <h3>Description: </h3>
            <p><?php echo htmlspecialchars($row['description']);?> </p>
        </div>

        <div>
            <form action="edit.php" method="POST">
                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                <input type="hidden" name="service" value="<?php echo $row['service']; ?>">
                <input type="hidden" name="emailuid" value="<?php echo $row['emailuid']; ?>">
                <input type="hidden" name="pwd" value="<?php echo $row['pwd']; ?>">
                <input type="hidden" name="extra" value="<?php echo $row['extra']; ?>">
                <input type="hidden" name="description" value="<?php echo $row['description']; ?>">
                <input type="submit" name="editPage" value="Edit">
            </form>
        </div>

        <div>
            <form action="more-details.php" method="POST">
                <input type="hidden" name="idToDelete" value="<?php echo $row['id']; ?>">
                <input type="submit" name="delete" value="Delete">
            </form>
        </div>
    </main>

<?php require("templates/footer.php"); ?>