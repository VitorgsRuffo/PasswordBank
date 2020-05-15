<?php
    
    if(isset($_POST['reset-pwd'])){

        $userEmail = $_POST['email'];

        //1st: set up our two tokens:(by separating this tokens we avoing timing attacks)  //Token has to be made cryptographically secure. (some PHP functions will help us with that: random_bytes and bin2hex)
            
            //used as a helper in the authentication
            $selectorToken =  bin2hex(random_bytes(8));
            //used to authenticate if the user is correct
            $validatorToken =  random_bytes(32);

            //link to reset the pwd that is gonna be sent to user's email.
            //(as the tokens are gonna be put in the url we need to convert 'em to hexadecimal, we can't put binary data in urls)
            $url = "http://passwordbank:3333/new-password.php?selector=" . $selectorToken . "&validator=" . bin2hex($validatorToken);

            //a token has to have a expire data, we don't want it lasting too long because it is only a tool for helping user reset his pwd.
            //(date("U") returns the number of seconds passed since january 1st, 1970). // 600 == ten minutes, so the tokens will expire ten minutes after executing this script.
            $expiration = date("U") + 600;
        
        //2nd: we need to delete any tokens that are related to this user, if they exist, inside the database. //(we don't wanna have multiple tokens for a same user)
            
            require("../config/db_connect.php");

            $sql = "DELETE FROM pwd_reset_token WHERE userEmail=?";
            $statement = mysqli_stmt_init($connection);

            if(!mysqli_stmt_prepare($statement, $sql)){
                header("Location: ../reset-password.php?error=deletesqlerror");
                exit();
            }else{
                mysqli_stmt_bind_param($statement, "s", $userEmail);
                mysqli_stmt_execute($statement);
            }

        //3rd: insert the token inside the database:
            
            $sql = "INSERT INTO pwd_reset_token (userEmail, selectorToken, validatorToken, expiration) VALUES (?, ?, ?, ?)";

            if(!mysqli_stmt_prepare($statement, $sql)){
                header("Location: ../reset-password.php?error=insertsqlerror");
                exit();
            }else{
                //the validator token is a sensitive data so we need to hash it before storing it in the database;
                $hashedValidator = password_hash($validatorToken, PASSWORD_DEFAULT);
                
                mysqli_stmt_bind_param($statement, "ssss", $userEmail, $selectorToken, $hashedValidator, $expiration);
                mysqli_stmt_execute($statement);
            }
            mysqli_stmt_close($statement);
            mysqli_close($connection);

        //4th: send the email to the user.

            //library that will help us send emails without having to set a mail server on our web server.
            require_once("../library/PHPMailer/PHPMailerAutoload.php");
            
            //object with all the methods and properties we'll need:
            $mail = new PHPMailer();
            
            //We'll be using Gmail as our SMTP server, this means we don't need to host our own mail server 
            $mail->Host = 'smtp.gmail.com';

            //enable SMTP:
            $mail->isSMTP();

            //specifies that we need to authenticate with Gmail to be able to send a message
            $mail->SMTPAuth = true;

            //the username and pwd of the gmail account that we are gonna use to send the message:
            $mail->Username = '';
            $mail->Password = '';

            //specfies the way of connection as being TLS, or we could use SSL
            $mail->SMTPSecure = 'tls';
            
            $mail->Port = 587;   //we can use 587(TLS) or 456(SSL) 
            
            //allows our email content to be structured with HTML
            $mail->isHTML();                
            $mail->Subject = 'Reset your password for Passwordbank';
            $mail->Body = '<p>We recieved a password reset request. Click the link below to reset your password. If you did not make this request you can ignore this email</p>
                            <p>Reset password: </br><a href="' . $url . '">' . $url . '</a></p>';

            //who is sending the email:
            $mail->setFrom('');            
            //who is gonna receive the email:
            $mail->AddAddress($userEmail);

            if($mail->Send()){
                header("Location: ../reset-password.php?success=emailsent");
            }else{
                header("Location: ../reset-password.php?error=emailnotsent-". $mail->ErrorInfo);
            }
        
    }else{
        header("Location: ../index.php");
    }

?>
