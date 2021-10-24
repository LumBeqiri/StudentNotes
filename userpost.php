<?php include('includes/header.php');
require_once './core/dbh.php';
$db = new Database;


// queryi me marr user_id
$query = $db->pdo->prepare('Select id from users where email =:em');
        $query->bindParam(':em', $_SESSION['email']);
        $query->execute();
        $temp = $query->fetchAll();
        $res =$temp['0']['0'];
        $_SESSION['user_id']=$res;

?>



<?php if(!isset($_SESSION['email'])){
        header("Location: ./signinuploadform.php");

   }

   
   ?>
<!DOCTYPE html>
<html>
    <head>
        <title>Upload</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
        <script src="./js/jquery-3.2.1.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                $("#cat").change(function(){
                    var catid = $("#cat").val();
                    $.ajax({
                        
                        url: 'data.php',
                        method:'post',
                        data: 'catid='+catid
                    }).done(function(courses){
                        console.log(courses);
                        courses = JSON.parse(courses);
                        $('#courses').empty();
                        courses.forEach(function(course){
                            $('#courses').append('<option>'+course.title+'</option>')
                        })
                    })
                })
            })
        </script>
    </head>
    <body>

            <div class="signIncontanier-upload">

                <div class="loginBox-upload">
                    
                    <div class="back-upload">
                        
                        <img src="images/student3.png" alt="User">
                        
                        <h3>Your Profile</h3>
                        
                        <p><?php echo $_SESSION['email'];?></p>

                    </div>
                </div>

                <div class="uploadfilebox">
                <form class="uploadForm" action="upload.php" method="post" enctype="multipart/form-data">
                    <h1>Share what you've got</h1>
                    <label>User</label><br>
                    <input readonly class="input" type="text" name="user" value ="<?php echo $_SESSION['email'];?>"><br><br>
                    
                    <label>Categories</label><br>
                    <select class="input" id="cat" name="selectCategory">
                        <option selected ="" disabled="">Select Category</option>
                        <?php
                            require 'data.php';
                            $categories = loadCategories();
                            foreach($categories as $category){
                                echo "<option id='".$category['cid']."' value='".$category['cid']."'>".$category['cname']."</option>";
                            }
                        ?>
                    </select><br>
                    <label>Courses</label><br>
                    <select class="input" id="courses" name="selectCourse"> </select><br>
                    
                    <label>Choose File</label><br>
                    <input class="input" type="file" name="file"><br>
                    <label>Title it</label><br>
                    <input class="input" type="text" name="title"><br>
                    <textarea maxlength="150" name="description" class="uploaddescription"placeholder="Your Description" ></textarea><br>
                    <button name="submit" class="submitupload-button" type="submit" value="submit">Submit</button>
                </form>

                
                </div>
            </div>

            <?php include('includes/footer.php');?>

    </body>

</html>