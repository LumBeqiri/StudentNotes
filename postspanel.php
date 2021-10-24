<?php include('includes/current_page.php');?>
<?php
    session_start();
    if(!isset($_SESSION['email'])){
        header("Location: ./index.php");

   }
?>
<?php 
    $edit_state = false;
    require './controllers/PostsController.php';
    
    $psts = new PostsController;
    $db = mysqli_connect('localhost','root','','dnotes');
    $user_id = $psts->getUserId($_SESSION['email']);
    //permban te gjitha postimet qe shfaqen te tabel

    $posts_results= array();

   if($_SESSION['is_admin']==1){
    $posts_results = mysqli_query($db,"SELECT * FROM posts");
   }
    else{
        $posts_results = mysqli_query($db,"SELECT * FROM posts where created_by = $user_id");
    }

   
    //permban te gjitha courses qe do shfaqen ne dropdownlist
    $course_results = mysqli_query($db,"SELECT * FROM courses");
    $post_id =0;

    $title="";
    $post_desc="";


 
    if(isset($_GET['del'])){
        $course->destroy($_GET["del"]);
        header('Location: ./postspanel.php');
    }

    //course_id qe fitohet prej edit butonit, perdoret prej metodes update($post_id,$_POST)
    if(isset($_GET['edit'])){
        $post_id = $_GET['edit'];
        //titulli i postimit
        $title= $_GET['title'];

        $post_desc = $_GET['description'];
        $edit_state = true;
    }




  
    $currentPost = $psts->edit($post_id);

  //$course_id id e rreshtit qe editohet
    if(isset($_POST['update'])){
        $psts->update($post_id,$_POST);
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
                    <th style = "font-size:25px">Title</th>     
                    <th style = "font-size:25px">Description</th>


                    <th class ="actionclass" colspan = "2"> Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if($posts_results){?>
                    <?php while($row = mysqli_fetch_array($posts_results)){ ?>
                    <tr>
                    <td>
                        <?php 
                                $course_id = $row['course'];
                                
                                $emri=$psts->get_courseNameById($course_id);
                                $course_cmb=$emri['0']['1'];
                                echo $course_cmb;
                                
                                
                            ?>
                    </td>
                    <td>
                        <?php 
                            echo $row['title'];
                        ?>
                    </td>
                    <td>
                        <?php 
                            echo $row['description'];
                        ?>
                    </td>
                    
                    <td class ="editclass">
                        <a class ="edit_btn" href="postspanel.php?edit=<?php echo $row['id']; ?>&title=<?php echo $row['title']?>&description=<?php echo $row['description']?>">Edit</a>
                    </td>
                    <!-- buttoni delete -->
                    <td class ="updateclass">
                    <a class ="del_btn" href="postspanel.php?del=<?php echo $row['id']; ?>">Delete</a>
                    </td>
                </tr>
                <?php } ?> <!--while loop ends here -->

                <?php } ?>
                
                
            </tbody>
        </table>
        <form method="post" action ="">


            <div class ="input-group">
                <label>Post Title</label>
                <input type="text" value="<?php echo $currentPost['title']; ?>" name="postname">
                
                <label>Description</label>
                <input type="text" value="<?php echo $currentPost['description']; ?>" name="description">

                <label>Course</label>
                <select name = "selectCourse">
                        <?php while($row = mysqli_fetch_array($course_results)){ ?>
                            <option value="<?php echo $row['course_id'] ;?>"><?php echo $row['title']?></option>
                    
                        <?php } ?>
                    </select>   
            </div>
            
                <div class ="input-group">
                    <button type="submit" name="update" class="btn">Update</button>
                </div>
            </form>

            
</body>
</html>