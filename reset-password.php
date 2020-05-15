<?php require('templates/header.php'); ?>

    <main>
        <div>
            <h2>Reset your password</h2>
            <?php if(isset($_GET['success']) && $_GET['success'] === 'emailsent'): ?>
                <p>We've just sent an email with instructions on how to reset your password.</br> If you don't receive an email within a few minutes, please check if you used the correct email address and try again.</p>
            <?php else: ?>
                <p>We're are going to send you an email with instructions on how to reset your password.</p>
            <?php endif; ?>
        </div>
        <div>
            <form action="scripts/reset-password-script.php" method="POST">
                <input type="text" name="email" placeholder="Enter your e-mail address">
                <input type="submit" name="reset-pwd" value="Send e-mail">
            </form>
            
        </div>
    </main>

<?php require('templates/footer.php'); ?>