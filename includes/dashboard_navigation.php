

<header>
<div class = "container">

<?php 
  $adm ="";
if($_SESSION['is_admin']==0){
    $adm="Manage Dashboard";}
    else{$adm="ADMIN Dashboard";}
  ?>

    <nav>
    <h1 class ="brand"><a href = "index.php">SNOTES </a><span><?PHP echo $adm ?></span></h1>
      


        <ul>
          <?php if($_SESSION['is_admin']==1){?>
            <li><a href ="admindashboard.php">Dashboard</a></li>
            <li><a href ="userspanel.php">Users</a></li>
            <li><a href ="categoriespanel.php">Categories</a></li>
            <li><a href ="coursespanel.php">Courses</a></li>
            <li><a href ="postspanel.php">Posts</a></li>
            <li><a class="logoutButton" href="logout.php" type="submit" name="logout">Log Out</a></li>
          <?php }else{ ?>
            <li><a class="logoutButton" href="logout.php" type="submit" name="logout">Log Out</a></li>
          <?php } ?>
          </ul>
      </nav>

    
      
  </div>
  </header>