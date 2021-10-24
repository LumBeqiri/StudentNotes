
<?php include('includes/current_page.php');?>
<?php
    session_start();
    if(!isset($_SESSION['email']) || $_SESSION['is_admin']==0){
        header("Location: ./index.php");

   }
?>
<?php 
    $edit_state = false;
    require './controllers/CategoryController.php';
    
    $category = new CategoryController;
    $db = mysqli_connect('localhost','root','','dnotes');
    $results = mysqli_query($db,"SELECT * FROM category");
    
    $cid =0;
    
    
    if(isset($_POST['save'])){
        $category->store($_POST);
        header('Location: ./categoriespanel.php');
    }
    if(isset($_GET['del'])){
        $category->destroy($_GET["del"]);
        header('Location: ./categoriespanel.php');
    }
    if(isset($_GET['edit'])){
        $cid = $_GET['edit'];
        $edit_state = true;
    }
    $cuurentCategory = $category->edit($cid);

    if(isset($_POST['update'])){
        $category->update($cid,$_POST);
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
                    <th style = "font-size:25px">Category</th>
                    <th class ="actionclass" colspan = "2">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = mysqli_fetch_array($results)){ ?>
                    <tr>
                    <td><?php echo $row['cname'] ?></td>
                    <td class ="editclass">
                        <a class ="edit_btn" href="categoriespanel.php?edit=<?php echo $row['cid']; ?>">Edit</a>
                    </td>
                    <td class ="updateclass">
                        <a class ="del_btn" href="categoriespanel.php?del=<?php echo $row['cid']; ?>">Delete</a>
                    </td>
                </tr>
                <?php } ?>
                
            </tbody>
        </table>
        <form method="post" action ="">
            <input type ="hidden" name="cid" value="<?php echo $cid; ?>">
            <div class ="input-group">
                <label>Category Name</label>
                <input type="text" value="<?php echo $cuurentCategory['cname']; ?>" name="categoryname">
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