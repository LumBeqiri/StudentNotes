<?php include('includes/header.php');
require './controllers/PostsController.php';
$posts = new PostsController;?>
<?php 
    //ID e course
    $id=$_REQUEST['ID'];
    //gjenerojm array me postimet ne kurs prej ID $id
    $postimet = $posts->get_posts($id);
?>
<!-- <div class="search-cat">
        
        <input class="search-input-style" type="text" placeholder="Search Course">
       
</div> -->



<div class="layout-cont1">
    <?php foreach($postimet as $item):?>
      
            <div class="layout-item2">
                <h3><?php echo $item[3]?></h3>
                
                <!--dergohet id e postit-->
                <?php echo "<a class='button2' href='single_item.php?ID={$item[0]}'>View Posts</a>"?>
            </div>
        
        
                

<?php endforeach; ?>
</div>





    <?php include("includes/footer.php");?>
</body>
</html>