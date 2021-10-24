<?php include('includes/current_page.php');?>
<?php
    session_start();
    if(!isset($_SESSION['email']) || $_SESSION['is_admin']==0){
        header("Location: ./index.php");

   }
?>
<?php 
    $edit_state = false;
    require './controllers/CourseController.php';
    
    $course = new CourseController;
    $db = mysqli_connect('localhost','root','','dnotes');
    $results = mysqli_query($db,"SELECT * FROM courses");
    $category_results = mysqli_query($db,"SELECT * FROM category");
    $course_id =0;

    
    if(isset($_POST['save'])){
        $course->store($_POST);
        header('Location: ./coursespanel.php');
    }
    if(isset($_GET['del'])){
        $course->destroy($_GET["del"]);
        header('Location: ./coursespanel.php');
    }

    //course_id qe fitohet prej edit butonit, perdoret prej metodes update($course_id,$_POST)
    if(isset($_GET['edit'])){
        $course_id = $_GET['edit'];
        $title= $_GET['title'];
        $edit_state = true;
    }

    //permban kursin qe do te editohet
    $currentCourse = $course->edit($course_id);

  //$course_id id e rreshtit qe editohet
    if(isset($_POST['update'])){
        $course->update($course_id,$_POST);
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
                    <th style = "font-size:25px">Course</th>
                    <th style = "font-size:25px">Category</th>                    
                    <th class ="actionclass" colspan = "2">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = mysqli_fetch_array($results)){ ?>
                    <tr>
                    <td><?php echo $row['title'] ?></td>
                    <td>
                        <?php 
                            $cat_id = $row['category'];
                            
                            $emri=$course->get_categoryNameById($cat_id);
                            $categoria_cmb=$emri['0']['1'];
                            echo $categoria_cmb;
                            
                            
                        ?>
                    </td>
                    <td class ="editclass">
                        <a class ="edit_btn" href="coursespanel.php?edit=<?php echo $row['course_id']; ?>&title=<?php echo $row['title']?>">Edit</a>
                    </td>
                    <td class ="updateclass">
                    <a class ="del_btn" href="coursespanel.php?del=<?php echo $row['course_id']; ?>">Delete</a>
                    </td>
                </tr>
                <?php } ?>
                
            </tbody>
        </table>
        <form method="post" action ="">
            <input type ="hidden" name="course_id" value="<?php echo $course_id; ?>">
            <input type ="hidden" name="title" value="<?php echo $title; ?>">

            <div class ="input-group">
                <label>Course Title</label>
                <input type="text" value="<?php echo $currentCourse['title']; ?>" name="coursename">

                <label>Category</label>
                <select name = "selectCategory">
                        <?php while($row = mysqli_fetch_array($category_results)){ ?>
                            <option value="<?php echo $row['cid'] ;?>"><?php echo $row['cname']?></option>
                    
                        <?php } ?>
                    </select>   
            </div>
            
                <div class ="input-group">

                    <?php //nese nuk editon    ?>

                    <?php if($edit_state == false):?>
                   
                       

                        <button type="submit" name="save" class="btn">Save</button>
                    
                    <?php //nese editon?>
                    
                    <?php else:?>
                   
                        <button type="submit" name="update" class="btn">Update</button>
                    <?php endif ?>
                </div>
            </form>

            
</body>
</html>