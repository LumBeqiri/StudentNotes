<?php
    require './controllers/AuthController.php';



    $user = new AuthController;

    if(isset($_POST['submitted'])) {
        session_start();
        $user->login($_POST);
        $_SESSION['name']=$_POST['email'];
    }

?>


<?php 

    // $password = password_hash(123, PASSWORD_DEFAULT);
    // echo $password;

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Create User</title>
    <link rel="stylesheet" href="">
</head>
<body>
    <h1>Login</h1>
    <form action="" method="POST">
        <input type="text" name="email">
        <input type="password" name="password">
        <button type="submit" name="submitted">Login</button>
    </form>
</body>
</html>