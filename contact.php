<?php include('includes/header.php');


    $succsses ='';
   //Send email 
if(isset($_POST['email'])) {
 
    // EDIT THE 2 LINES BELOW AS REQUIRED
    $email_to = 'snotesprojekt@gmail.com';
    $email_subject = 'TO Contact your site';
 
    function died($error) {
        // your error code can go here
        echo "We are very sorry, but there were error(s) found with the form you submitted. ";
        echo "These errors appear below.<br /><br />";
        echo $error."<br /><br />";
        echo "Please go back and fix these errors.<br /><br />";
        die();
    }
 
 
    // validation expected data exists
    if(!isset($_POST['name']) ||
        !isset($_POST['email']) ||
        !isset($_POST['message'])) {
        died('We are sorry, but there appears to be a problem with the form you submitted.');       
    }
 
     
 
    $name = $_POST['name']; // required
    $email_from = $_POST['email']; // required
    $message = $_POST['message']; // required
 
    $error_message = "";
    $email_exp = '/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/';
 
  if(!preg_match($email_exp,$email_from)) {
    $error_message .= 'The Email Address you entered does not appear to be valid.<br />';
  }
 
    $string_exp = "/^[A-Za-z .'-]+$/";
 
  if(!preg_match($string_exp,$name)) {
    $error_message .= 'The First Name you entered does not appear to be valid.<br />';
  }

  if(strlen($message) < 2) {
    $error_message .= 'The Comments you entered do not appear to be valid.<br />';
  }
 
  if(strlen($error_message) > 0) {
    died($error_message);
  }
 
    $email_message = "Form details below.\n\n";
 
     
    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }
 
     
 
    $email_message .= "Name: ".clean_string($name)."\n";
    $email_message .= "Email: ".clean_string($email_from)."\n";
    $email_message .= "message: ".clean_string($message)."\n";
    
        // create email headers
        $headers = 'From: '.$email_from."\r\n".
        'Reply-To: '.$email_from."\r\n" .
        'X-Mailer: PHP/' . phpversion();
         


        // Sending email
        if(@mail($email_to, $email_subject, $email_message, $headers)){
            $succsses = "<p class='success'>Your message has been sent successfully!</p>";
        } else{
            echo '<p class="error">Unable to send email. Please try again!</p>';
        }
    
}
?>

    <div style ="text-align:center" class="content">
            <p class="content-text">Get in touch with us</p>
            <form role="form"  method="POST">
                    <div class="form-group">
                        <input 
                            class="text1"
                            type="text" 
                            placeholder="Your Name (required)"
                            name="name" 
                            data-validation="custom" 
                            data-validation-regexp="^([a-zA-Z]+)$"
                            data-validation-error-msg="You did not enter a valid name"
                        >
                    </div>
                    <div class="form-group">
                        <input 
                            class="text1"
                            type="email" 
                            placeholder="Your Email (required)"
                            name="email" 
                            data-validation="required email"
                        >
                    </div>
                    <div class="form-group">
                        <textarea maxlength="150" name="message" class="text2" data-validation="required" placeholder="Your message" ></textarea>
                    </div>

                    <div class="form-group">
                        <button class="submit-button" type="submit" value="submit">Submit</button>
                        <?php echo $succsses; ?>
                    </div>

                </form>



        
</div>

     <?php include('includes/footer.php');?>

    
        <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>
    <script>
        $.validate({
            errorMessageClass: "error",
        });
    </script>

</body>


</html>