<?php

    if(isset($_POST['edit'])){

        //getting and validating data:

            require("../library/Account.php");
            $accountData = new Account($_POST['idToUpdate'], $_POST['service'], $_POST['emailuid'], 
                                       $_POST['pwd'], $_POST['extra'], $_POST['description'], "", "edit-account.php");

            $accountData->validateAccountData();

        //updating on database:
                
            require("../config/db_connect.php");

            $sql = "UPDATE accounts 
                    SET service=?, emailuid=?, pwd=?, extra=?, description=? 
                    WHERE id=?";

            $statement = mysqli_stmt_init($connection);

            if(!mysqli_stmt_prepare($statement, $sql)){
                header("Location: account-details.php?id=".$accountData->id."&updateError=sqlError");
                exit();
            }

            mysqli_stmt_bind_param($statement, "ssssss", $accountData->service, $accountData->emailuid, $accountData->pwd, $accountData->extra, $accountData->desc, $accountData->id);
            mysqli_stmt_execute($statement);


        header("Location: ../account-details.php?id=".$accountData->id."&edit=success");
        exit();
    }

?>