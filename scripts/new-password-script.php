<?php

    if(isset($_POST['reset-pwd'])){
       
        $password = $_POST['pwd'];
        $password2 = $_POST['pwd2'];
        $selectorToken = $_POST['selector'];
        $validatorToken = $_POST['validator'];

        //we to do some checks on the form data before reseting the password:
        if(empty($password) || empty($password2)){
            header("Location: ../new-password.php?error=newpwdempty&selector=".$selectorToken."&validator=".$validatorToken);
            exit();
        }else if($password !== $password2){
            header("Location: ../new-password.php?error=differentpwd&selector=".$selectorToken."&validator=".$validatorToken);
            exit(); 
        }//check if the pwd is in the correct for for the user table:  else if(){}
       
        //..and some checks on the tokens for security:
        
        require("../config/db_connect.php");

        $currentDate = date("U"); //to check if the tokens are expired.
        
        //we are gonna use the selector token to find the row where the validator token is. The validator token are gonna help us check if this is the correct user that is trying to change his pwd.
        $sql = "SELECT * FROM pwd_reset_token WHERE selectorToken=? AND expiration >= $currentDate"; //btw we only need the ? placeholder for data sent by the user (to avoid sql injection).
        $statement = mysqli_stmt_init($connection);
        if(!mysqli_stmt_prepare($statement, $sql)){
            header("Location: ../new-password.php?error=selectsqlerror");
            exit();
        }
        mysqli_stmt_bind_param($statement, "s", $selectorToken);
        mysqli_stmt_execute($statement);

        $rawResult = mysqli_stmt_get_result($statement);
        //we can only found one or no rows because we only allow one token per user on our database. 
        $row = mysqli_fetch_assoc($rawResult); //as we know we are might have only one row as result we use this method to convert the result into an assoc array where the keys are gonna be the columns.
        
        if(!$row){  //if no row was found:
            header("Location: ../new-password.php?error=invalidtoken");
            exit();
        }

        //now let's check if the validator token is equal to the one inside the database:
        $validatorTokenBin = hex2bin($validatorToken); //we need to convert the validator back to binary to compare it to the validator inside the database.
        $isValidatorCorrect = password_verify($validatorTokenBin, $row['validatorToken']);
        if($isValidatorCorrect == false){
            header("Location: ../new-password.php?error=invalidtoken");
            exit();
        }else if($isValidatorCorrect == true){
            //ok as everything is correct let's start to change user's password:
            $userEmail = $row['userEmail'];

            $sql = "UPDATE user SET pwd=? WHERE email=?";
            if(!mysqli_stmt_prepare($statement, $sql)){
                header("Location: ../new-password.php?error=updatesqlerror");
                exit();
            }
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            mysqli_stmt_bind_param($statement, "ss", $hashedPassword, $userEmail);
            mysqli_stmt_execute($statement);  
            
            //as this token already did its work let's delete it:
            $sql = "DELETE FROM pwd_reset_token WHERE userEmail=?";
            if(!mysqli_stmt_prepare($statement, $sql)){
                header("Location: ../new-password.php?error=deletetokensqlerror");
                exit(); 
            }
            mysqli_stmt_bind_param($statement, "s", $userEmail);
            mysqli_stmt_execute($statement);

            header("Location: ../sign-in.php?pwdreset=success");
        }

    }else{
        header("Location: ../index.php"); 
    }
?>