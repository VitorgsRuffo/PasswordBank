<?php

    if(isset($_POST['add'])){

        require("../config/db_connect.php");

        //getting and validating account data that user is trying to register.
            require("../library/Account.php");
            $accountData = new Account("", $_POST['service'], $_POST['emailuid'], $_POST['pwd'],
                                    $_POST['extra'], $_POST['description'], $_POST['userid'], "add-account.php");
                        
            $accountData->validateAccountData();
        
        //insert data into database:
            $sql = "INSERT INTO accounts(service, emailuid, pwd, extra, description, userid)
                    VALUES (?, ?, ?, ?, ?, ?)";

            $statement = mysqli_stmt_init($connection);

            if(!mysqli_stmt_prepare($statement, $sql)){
                header("Location: ../home.php?addError=sqlError");
                exit();
            }

            //hash pwd:
            //

            mysqli_stmt_bind_param($statement, "ssssss", $accountData->service, $accountData->emailuid, $accountData->pwd, $accountData->extra, $accountData->desc, $accountData->userid);

            mysqli_stmt_execute($statement);

            //$e = mysqli_stmt_error($statement);

        header("Location: ../add-account.php?success=add");
        exit();
    }

?>