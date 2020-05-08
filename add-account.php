<?php require("templates/header.php"); ?>

<?php

    $service = '';
    $emailuid = '';
    $pwd = '';
    $extra = 'Example: This is my secret key to get back my account if I forget the password: #@#jkdf)_99';
    $desc = 'Example: This is my xyz account';

    $empty = '';
    $serviceErr = '';
    $emailuidErr = '';
    $pwdErr = '';
    $extraErr = '';
    $descErr = '';

    function fillFields(){
        global $service;
        $service = isset($_GET['service']) ? htmlspecialchars($_GET['service']) : '';

        global $emailuid;
        $emailuid = isset($_GET['emailuid']) ? htmlspecialchars($_GET['emailuid']) : '';

        global $extra;
        $extra = isset($_GET['extra']) ? htmlspecialchars($_GET['extra']) : '';

        global $desc;
        $desc = isset($_GET['desc']) ? htmlspecialchars($_GET['desc']) : '';
    }


    if(isset($_GET['error'])){
        
        switch($_GET['error']){
            case "emptyfields":
                $empty = "Fill in all required fields *";
                fillFields();
                break;
            case "invalidservice":
                $serviceErr = "Service must only contain letters, numbers, underscores, dots and be 1-20 characters long.";
                fillFields();
                break;
            case "emailuidnotvalid":
                $emailuidErr = "Email must be a valid address. Username must only contain letters, numbers, underscores, and also be 5-20 characters long.";
                fillFields();
                break;
            case "pwdtoolong":
                $pwdErr = "Password cannot be longer than 50 characters.";
                fillFields();
                break;
            case "extratoolong":
                $extraErr = "Extra information about an account cannot be longer than 255 characters.";
                fillFields();
                break;
            case "desctoolong":
                $descErr = "Account description cannot be longer than 255 characters.";
                fillFields();
                break;
        }

    }

?>

    <main>
        <div>
            <?php if(!isset($_GET['success'])): ?>
                <div><h3>Add new account:</h3></div>
                
                <div><?php echo $empty;?></div>

                <div>
                    <form action="scripts/add-account-script.php" method="POST">
                        <label for="service">*Service: </label>
                        <input type="text" id="service" name="service" value="<?php echo $service; ?>" placeholder="Facebook, Google, ..">  
                        <div><?php echo $serviceErr; ?></div>
                        
                        <label for="emailuid">*Email/Username:</label>
                        <input type="text" id="emailuid" name="emailuid" value="<?php echo $emailuid; ?>" placeholder="example@example.com"> 
                        <div><?php echo $emailuidErr; ?></div>

                        <label for="pwd">*Password: </label>
                        <input type="password" id="pwd" name="pwd" value="<?php echo $pwd; ?>">
                        <div><?php echo $pwdErr; ?></div>

                        <label for="extra">Extra information: </label>
                        <textarea  id="extra" name="extra" cols="50" rows="5"><?php echo $extra;?></textarea>
                        <div><?php echo $extraErr; ?></div>

                        <label for="desc">Description: </label>
                        <textarea id="desc" name="description" cols="50" rows="5"><?php echo $desc;?></textarea>
                        <div><?php echo $descErr; ?></div>

                        <input type="hidden" name="userid" value="<?php echo $_SESSION['userId'] ?>">

                        <input type="submit" name="add" value="Add">  
                    </form>
                </div> 
            <?php else: ?> 
                <div><h2>You successfully added a new account to your passwordbank!</h2></div>
                <div><a href="home.php">Go back</a></div>
            <?php endif; ?>
        </div>
    </main>

<?php require ("templates/footer.php"); ?>