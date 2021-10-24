<?php include('includes/header.php');
include './controllers/CategoryController.php';
$category = new CategoryController;




?>

    <!-- <div class="search-cat">
        
            <input class="search-input-style" type="text" placeholder="Search Category">
           
    </div> -->

    <?php
        $categories = $category->all();
       

    ?>

<div class="layout-cont1">
    <?php foreach($categories as $item):?>
      
        <div class="layout-item2">
                <h3><?php echo $item[1]?></h3>
                
                                    <!--ID e e kategorise dergohet te courses.php-->
                <?php echo "<a class='button2' href='courses.php?ID={$item[0]}'>View Courses</a>"?>
            </div>
        
        
                

<?php endforeach; ?>
</div>

    
   
        
        
        
        
    <?php include('includes/footer.php');?>

        
    </body>
</html>