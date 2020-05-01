<?php require("templates/header.php");  ?>

<?php

    if(isset($_POST['editPage'])){
        $id = htmlspecialchars($_POST['id']);
        $service = htmlspecialchars($_POST['service']);
        $emailuid = htmlspecialchars($_POST['emailuid']);
        $pwd = htmlspecialchars($_POST['pwd']);
        $extra = htmlspecialchars($_POST['extra']);
        $description = htmlspecialchars($_POST['description']);
    }
    
    else if(isset($_POST['edit'])){

        $id = htmlspecialchars($_POST['idToUpdate']);
        $service = htmlspecialchars($_POST['service']);
        $emailuid = htmlspecialchars($_POST['emailuid']);
        $pwd = htmlspecialchars($_POST['pwd']);
        $extra = htmlspecialchars($_POST['extra']);
        $description = htmlspecialchars($_POST['description']);

        require("config/db_connect.php");

        $sql = "UPDATE accounts 
                SET service=?, emailuid=?, pwd=?, extra=?, description=? 
                WHERE id=?";
        
        $statement = mysqli_stmt_init($connection);

        if(!mysqli_stmt_prepare($statement, $sql)){
            header("Location: more-details.php?id=".$id."&updateError=sqlError");
            exit();
        }

        //$hashedPassword = password_hash($pwd, PASSWORD_DEFAULT);
    
        mysqli_stmt_bind_param($statement, "ssssss", $service, $emailuid, $pwd, $extra, $description, $id);

        mysqli_stmt_execute($statement);

        //do some checkings to see if it was possible to run the query.
        //$e = mysqli_stmt_error($statement);
        
        header("Location: more-details.php?id=".$id."&edit=success");
        exit();
    }
    
    else{
        header("Location: home.php");
        exit();
    }

?>

    <main>
        <div>
            <form action="edit.php" method="POST">
                <input type="hidden" name="idToUpdate" value="<?php echo $id;?>">
                <h3>Service: </h3>
                <input type="text" name="service" value="<?php echo htmlspecialchars($service);?>">
                <h3>Email/username: </h3>
                <input type="text" name="emailuid" value="<?php echo htmlspecialchars($emailuid);?>"> 
                <h3>Password: </h3>
                <input type="text" name="pwd" value="<?php echo htmlspecialchars($pwd);?>">
                <h3>Extra information: </h3>
                <textarea name="extra" cols="50" rows="5"><?php echo htmlspecialchars($extra);?></textarea>
                <h3>Description: </h3>
                <textarea name="description" cols="50" rows="5"><?php echo htmlspecialchars($description);?></textarea>
                <input type="submit" name="edit" value="Done">
            </form>
        </div>
    </main>


<?php require("templates/footer.php"); ?>