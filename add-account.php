<?php require("templates/header.php"); ?>

<?php

    if(isset($_POST['add'])){

        require("config/db_connect.php");

        $service = mysqli_real_escape_string($connection, $_POST['service']);
        $emailuid = mysqli_real_escape_string($connection, $_POST['emailuid']);
        $pwd = mysqli_real_escape_string($connection, $_POST['pwd']);
        $extra = mysqli_real_escape_string($connection, $_POST['extra']);
        $description = mysqli_real_escape_string($connection, $_POST['description']);
        $userid = $_POST['userid'];

        //data validation:
        //


        //insert data into database:

        $sql = "INSERT INTO accounts(service, emailuid, pwd, extra, description, userid)
                VALUES (?, ?, ?, ?, ?, ?)";

        $statement = mysqli_stmt_init($connection);

        if(!mysqli_stmt_prepare($statement, $sql)){
            header("Location: home.php?addError=sqlError");
            exit();
        }

        //hash pwd:
        //

        mysqli_stmt_bind_param($statement, "ssssss", $service, $emailuid, $pwd, $extra, $description, $userid);

        mysqli_stmt_execute($statement);

        //$e = mysqli_stmt_error($statement);

        header("Location: home.php?add=success");
        exit();
    }

?>

    <main>
        <div>
            <div><h3>Add new account:</h3></div>
            
            <div>
                <form action="add-account.php" method="POST">
                    <label for="service">Service:</label>
                    <input type="text" id="service" name="service">  

                    <label for="emailuid">Email/Username:</label>
                    <input type="text" id="emailuid" name="emailuid"> 


                    <label for="pwd">Password: </label>
                    <input type="text" id="pwd" name="pwd">

                    <label for="extra">Extra information: </label>
                    <textarea  id="extra" name="extra" cols="50" rows="5">Example: This is my secret key to get back my account if I forget the password: #@#jkdf)_99</textarea>
                    
                    <label for="desc">Description: </label>
                    <textarea id="desc" name="description" cols="50" rows="5">Example: This is my xyz account</textarea>
                    
                    <input type="hidden" name="userid" value="<?php echo $_SESSION['userId'] ?>">

                    <input type="submit" name="add" value="Add">  
                </form>
            </div>  
        </div>
    </main>

<?php require ("templates/footer.php"); ?>