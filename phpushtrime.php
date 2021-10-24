<?php
    session_start();
    if(isset($_POST['submitted'])){
        $_SESSION['name']=$_POST['name'];
    }
//     $_SESSION['name']='filan';
//   $pets = ['Morie', 'Miki', 'Halo', 'lab' ,'Winnie'];
//   foreach ($pets as $val) {
//       echo "$val \n";
//   }

    



?>

<div id ="contacts">
    <?php echo $_SESSION['name'];?>

</div>

<form  method = "POST">
    <input type='text' id ="emri" name ='name'>
    <button  onclick = "validate()" type ="submit" name ="asubmitted">SEND</button>
    <p id="error""></p>
</form>

<script>function validate(){
        var x = document.getElementById('emri').value;
        if(isNaN(x){
            document.getElementById('error').innerHTML = 'numer gabim';

        }
    }</script>
    
