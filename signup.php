
<?php include('includes/current_page.php');?>

<?php
    
    require './controllers/UserController.php';
    $user = new UserController;

    $msg='';$msg2='';$msg3='';$msg4='';$msg5='';
    $username='';$email='';$password='';$repeatpassword='';

    if(isset($_POST['submitted'])){

        $username = $_POST['fullName'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $repeatpassword = $_POST['repeat-pass'];

       //echo $username."</br>".$email."</br>".$password."</br>".$repeatpassword."</br>";
        if(empty($username)||empty($email)||empty($password)||empty($repeatpassword))
        {
            $msg5 = "<div class='signUperror'>Please fill all the required spaces !</div>";
        }
        elseif(strlen($username)<3)
        {
            $msg = "<div class='signUperror'>Username must contain atleast 3 characters !</div>";
        }
        elseif($user->emailExists($email))
        {
            $msg2 = "<div class='signUperror'>This email is already taken !</div>";
        }
        elseif(strlen($password)<8)
        {
            $msg3 = "<div class='signUperror'>Password must contain atleast 8 characters !</div>";
        }
        elseif($password !== $repeatpassword)
        {
            $msg4 = "<div class='signUperror'>Password doesn't match !</div>";
        }
        else
        {
            $user->store($_POST);
            header('Location: ./signin.php');
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo $title?></title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <body>
    <div class="signIncontanier">

        <div class="loginBox">
            
            <article class="back">
                
                <img src="images/student.png" alt="User">
                
                <h3>Sign Up Here</h3>
                <?php echo $msg5; ?>
                <form class="" method="post">
                    <p>Type Username</p>
                    <input class="inp" type="text" name="fullName" value = '<?php echo $username; ?>'><br>
                    <?php echo $msg; ?>
                    <p>Type Email</p>
                    <input class="inp" type="email" name="email"  value = '<?php echo $email; ?>' ><br>
                    <?php echo $msg2; ?>
                    <p>Type Password</p>
                    <input class="inp" type="password" name="password" value = '<?php echo $password; ?>'><br>
                    <?php echo $msg3; ?>
                    <p>Confirm your Password</p>
                    <input class="inp" type="password" name="repeat-pass" value = '<?php echo $repeatpassword; ?>'><br>
                    <?php echo $msg4; ?>
                    <input class="subSignIN" type="submit" name="submitted" value="Sign Up">

                </form>
                    </article>
                </div>
            </div>
        </body>

</html>

