<form action="upload.php" method="post" enctype="multipart/form-data">
    Select Image File to Upload:
    <input type="file" name="file">
    <input type="submit" name="submit" value="Upload">
</form>

<?php
// Include the database configuration file
    require_once './core/dbh.php';
    require './controllers/PostsController.php';
    $db = new Database;
    $pst = new PostsController;

    $result= $pst->get_post_file(1);

    print_r($result);

    $imageURL= 'posts/'. $result['0']['file_name'];
?>

<a href="<?php echo $imageURL;?> "target="_blank">test.pdf</a>
 


  

