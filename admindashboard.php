<?php 
    session_start();
?>
<?php 
    if(!isset($_SESSION['email']) || $_SESSION['is_admin']==0){
        header("Location: ./signin.php");

   }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Admin Dashboard</title>
        <link rel="stylesheet" type="text/css" href="css/styleadminpannel.css">
    </head>
    <body>
      <?php include('includes/dashboard_navigation.php');?>
    </body>
</html>