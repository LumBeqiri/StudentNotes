<?php include('includes/header.php');
require './controllers/CategoryController.php';
$category = new CategoryController;?>
<?php 
    //id e kategorise (fakultetit)
    $id=$_REQUEST['ID'];
    //gjeneroj lendet qe i takojn kategorise me ID $id
    $courses = $category->get_courses($id);
?>
<!-- <div class="search-cat">
        
        <input class="search-input-style" type="text" placeholder="Search Course">
       
</div> -->



<div class="layout-cont1">
    <?php foreach($courses as $item):?>
      
            <div class="layout-item2">
                <h3><?php echo $item[1]?></h3>
                
                <!--Dergohet ID e kategoris te faqja posts-->
                <?php echo "<a class='button2' href='posts.php?ID={$item[0]}'>View Posts</a>"?>
            </div>
        
        
                

<?php endforeach; ?>
</div>





    <?php include("includes/footer.php");?>
</body>
</html>