<?php 
include('includes/header.php');
include './controllers/CategoryController.php';
$category = new CategoryController;
$categories = $category->all();
?>

  
    <div id="slider">
        <figure>
            <img src ="images/simages1.png">
            <img src ="images/simages2.jpg">
            <img src ="images/simages3.jpg">
        </figure>
    </div>

    <div class="home-categories">
        <div class="home-cat-title">
            <a style="text-decoration:none" href="categories.php"><h2 style="color:#33334f">Categories</h2></a>
            
        </div>
        <div class="layout-cont1">
        <?php $i=0;?>
    <?php foreach($categories as $item):?>
      
        <div class="layout-item2">
      

       <?php 
         if (++$i > 4)
         break;
       ?>
            <h3><?php echo $item[1]?></h3>
            
            <!--ID e e kategorise dergohet te courses.php-->
            <?php echo "<a class='button2' href='courses.php?ID={$item[0]}'>View Courses</a>"?>
        
        </div>
   
<?php endforeach; ?>


</div>
        
        
    </div>

    <div class="home-categories home-about">
        
        <div class="layout-cont1">
        
        <div class="layout-item1">
            <img style="height:250px;width:100%" src="images/about2.png">
           
        </div>
        
        <div class="layout-item1">
            <h3>About</h3>
            <p>Laboris quem duis admodum fore, te quamquam distinguantur. Quo de dolor illum 
                amet. Incurreret aute eiusmod ullamco an quis consequat se ullamco, litteris 
                philosophari et commodo te fore ingeniis praetermissum e laborum quae magna 
                voluptate quem, sed nisi eruditionem est et expetendis eu occaecat ubi aute iis 
                officia. Senserit quid si vidisse adipisicing, irure e admodum ab labore. Aliqua 
                nam et elit aliquip quo dolore appellat in excepteur, te iudicem ab litteris, 
                proident ita legam quibusdam. Lorem cupidatat cohaerescant. Ita nulla occaecat 
                fidelissimae ubi ubi anim reprehenderit quo o de sempiternum in hic magna hic 
                elit.</p>
            <a class="button2" href="about.php">About</a>
        </div>
        </div>     <!--layout-cont1 ends here-->   
    </div>
   

    <?php include('includes/footer.php');?>

    </body>


    <script src="./js/jquery-3.4.1.min.js"></script>

    
</html>