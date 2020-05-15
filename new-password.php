<?php require('templates/header.php'); ?>

    <?php
        $selector = $_GET['selector'];
        $validator = $_GET['validator'];
        
        if(empty($selector) || empty($validator)){
            $areTokensInCorrectForm = false;
        }else if(ctype_xdigit($selector) === false || ctype_xdigit($validator) === false){
            $areTokensInCorrectForm = false;
        }else{
            $areTokensInCorrectForm = true;
        }

        //handle possible incorrect new password format errors:

    ?>

    <main>
        <div>
            <?php if($areTokensInCorrectForm):  ?>
                <form action="scripts/new-password-script.php" method="POST">
                    <input type="hidden" name="selector" value="<?php echo $selector;?>">
                    <input type="hidden" name="validator" value="<?php echo $validator;?>">
                    <input type="password" name="pwd" placeholder="Enter your new password">
                    <input type="password" name="pwd2" placeholder="Repeat your new password">
                    <input type="submit" name="reset-pwd" value="Reset Password">
                </form>
            <?php else: ?>
                <p>It was not possible to handle your request due to invalid tokens.</p>
            <?php endif; ?>
        </div>
    </main>   

<?php require('templates/footer.php'); ?>