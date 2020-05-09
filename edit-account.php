<?php require("templates/header.php");  ?>

<?php //erro: se errar na ediçao a senha n retornada. Talvez uma solucao seria puchar os dados da db dnovo ao inves de tranmiti-los pra esta page com um POST.
    $id = '';
    $service = '';
    $emailuid = '';
    $pwd = '';
    $extra = '';
    $desc = '';

    $empty = '';
    $serviceErr = '';
    $emailuidErr = '';
    $pwdErr = '';
    $extraErr = '';
    $descErr = '';

    function fillFields(){
        global $id;
        $id = isset($_GET['id']) ? htmlspecialchars($_GET['id']) : '';

        global $service;
        $service = isset($_GET['service']) ? htmlspecialchars($_GET['service']) : '';

        global $emailuid;
        $emailuid = isset($_GET['emailuid']) ? htmlspecialchars($_GET['emailuid']) : '';

        global $extra;
        $extra = isset($_GET['extra']) ? htmlspecialchars($_GET['extra']) : '';

        global $desc;
        $desc = isset($_GET['desc']) ? htmlspecialchars($_GET['desc']) : '';
    }

    if(isset($_POST['editPage'])){
        $id = htmlspecialchars($_POST['id']);
        $service = htmlspecialchars($_POST['service']);
        $emailuid = htmlspecialchars($_POST['emailuid']);
        $pwd = htmlspecialchars($_POST['pwd']);
        $extra = htmlspecialchars($_POST['extra']);
        $desc = htmlspecialchars($_POST['description']);
    }
   
    else if(isset($_GET['error'])){
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

    else{
        header("Location: home.php");
        exit();
    }
    
?>

    <main>
        <div>
            <div><?php echo $empty;?></div>
            <form action="scripts/edit-account-script.php" method="POST">
                <input type="hidden" name="idToUpdate" value="<?php echo $id;?>">
                <h3>Service: *</h3>
                <input type="text" name="service" value="<?php echo $service;?>">
                <div><?php echo $serviceErr;?></div>
                <h3>Email/username: *</h3>
                <input type="text" name="emailuid" value="<?php echo $emailuid;?>"> 
                <div><?php echo $emailuidErr;?></div>
                <h3>Password: *</h3>
                <input type="text" name="pwd" value="<?php echo $pwd;?>">
                <div><?php echo $pwdErr;?></div>
                <h3>Extra information: </h3>
                <textarea name="extra" cols="50" rows="5"><?php echo $extra;?></textarea>
                <div><?php echo $extraErr;?></div>
                <h3>Description: </h3>
                <textarea name="description" cols="50" rows="5"><?php echo $desc;?></textarea>
                <div><?php echo $descErr;?></div>
                <input type="submit" name="edit" value="Done">
            </form>
        </div>
    </main>


<?php require("templates/footer.php"); ?>