<?php include('includes/current_page.php');?>
<?php
    session_start();
    if(!isset($_SESSION['email']) || $_SESSION['is_admin']==0){
        header("Location: ./index.php");

   }
?>
<?php 
    
    $edit_state = false;
    require './controllers/UserController.php';
    
    $user = new UserController;
    $db = mysqli_connect('localhost','root','','dnotes');
    $results = mysqli_query($db,"SELECT * FROM users");
    
    $id =0;
    
    
    if(isset($_POST['save'])){
        $user->store($_POST);
        header('Location: ./userspanel.php');
    }
    if(isset($_GET['del'])){
        $user->destroy($_GET["del"]);
        header('Location: ./userspanel.php');
    }
    if(isset($_GET['edit'])){
        $id = $_GET['edit'];
        $edit_state = true;
    }
    $currentUser = $user->edit($id);

    if(isset($_POST['update'])){
        $user->update($id,$_POST);
    }
    
    
?>
<!DOCTYPE html>
<html>
    <head>
         
        <link rel="stylesheet" type="text/css" href="css/styleadminpannel.css">
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">

    </head>
    <body>
    <?php include('includes/dashboard_navigation.php');?>
        <table>
            <thead>
                <tr>
                    <th style="width:15%">Name</th>
                    <th style="width:20%">Email</th>
                    <th>Password</th>
                    <th>isAdmin</th>
                    <th style ="text-align:center" colspan = "2">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = mysqli_fetch_array($results)){ ?>
                    
                    <tr>
                    <td><?php echo $row['name'] ?></td>
                    <td><?php echo $row['email'] ?></td>
                    <td><?php echo $row['password'] ?></td>
                    <td style ="text-align:center"><?php echo $row['is_admin'] ?></td>
                    <td style ="text-align:center">
                        <a class ="edit_btn" href="userspanel.php?edit=<?php echo $row['id']; ?>">Edit</a>
                    </td>
                    <td>
                        <a class ="del_btn" href="userspanel.php?del=<?php echo $row['id']; ?>">Delete</a>
                    </td>
                </tr>
                <?php } ?>
                
            </tbody>
        </table>
        <form method="post" action ="">
            <input type ="hidden" name="id" value="<?php echo $id; ?>">
            <div class ="input-group">
                <label>Name</label>
                <input type="text" value="<?php echo $currentUser['name']; ?>" name="fullName">
            </div>
            <div class ="input-group">
                <label>Email</label>
                <input type="email" value="<?php echo $currentUser['email']; ?>" name="email">
            </div>
            <div class ="input-group">
                <label>Password</label>
                <input type="password" value="<?php echo $currentUser['password']; ?>" name="password">
            </div>
            <div class ="checkbox">
            <label>is Admin</label>
            <input type="checkbox"<?php echo $currentUser['is_admin'] === '1' ? 'checked' : '' ?> name="is_admin">
            </div>
            <div class ="input-group">
            <?php if($edit_state == false):?>
                 <button type="submit" name="save" class="btn">Save</button>
             <?php else:?>
                <button type="submit" name="update" class="btn">Update</button>
            <?php endif ?>
            </div>
            </form>
    </body>

</html>