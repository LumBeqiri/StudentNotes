<?php include('includes/header.php');
require './controllers/PostsController.php';

$posts = new PostsController;


?>


<?php 

    
    


   
    //'ID' e postit
    $id=$_REQUEST['ID'];
    $title = $posts->get_post_title($id);
    //$author permban emrin e userit per postin e klikuar me id $id
    $author = $posts->get_post_author($id);
    $time = $posts->get_post_date($id);
    $desc = $posts->get_post_description($id);
    $data=$posts->get_post_file($id);



    $imageURL= 'posts/'. $data['0']['file_name'];


    if(isset($_POST['delete_post'])){
        $posts->destroy($id,$imageURL);   
    }

 
?>

<div class="home-categories home-about" style="border-top:white">
        
        <div class="layout-cont1">
        
        
        <div class="layout-item2">
            <h3><?php print_r($title['0']['title']);?></h3>
            <p><?php print_r($author);?> | <?php print_r($time[0]['created_at']);?> </p>
            
            <?php 
                if(isset($_SESSION['email'])){
                    
                    $user_id = $posts->getUserId($_SESSION['email']);
                    //shfaqe delete button nese je autor i postit ose nese je admin
                    if($posts->user_in_post($id,$user_id) || $_SESSION['is_admin']==1){?>
                        <form method="post">
                            <button name ="delete_post" type="submit" >Delete</button>
                        </form>
                   <?php }

                }
            ?>
            
            <p><?php print_r($desc[0]['description']);?></p>
            <a class='button2' href="<?php echo $imageURL;?> "target="_blank">View Post</a>
        </div>
        </div>     <!--layout-cont1 ends here-->   
    </div>

<?php include('includes/footer.php');?>