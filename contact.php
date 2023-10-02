<!--Contact Page-->

<?php

include 'includes/db.php';
include 'header.php';
require_once "vendor/phpmailer/phpmailer/PHPMailerAutoLoad.php";


?>
<div class="wrap">
<?php

if (isset($_POST['name'],$_POST['email'], $_POST['message'])  ){
  $name = $_POST['name'];
  $from = $_POST['email'];
  $message = $_POST['message'];
  
  
  $message = mysqli_real_escape_string($connection, $message);
  $name = mysqli_real_escape_string($connection, $name);
  $from = mysqli_real_escape_string($connection, $from);
  
//  sendMail($from, $name, $message);
  $mail = new PHPMailer();
  $mail->setFrom('contact@beatstore.com', 'Contact beatstore');
  $mail->addReplyTo($from, $name);
  $mail->Subject   = 'Message';
  $mail->Body = $message;

  $mail->AddAddress( '' );
 
  if(!$mail->Send()){
    header('location: contact.php?failed');

  }
  else{
    header('location: contact.php?success');

    
  }
}

if (isset($_GET['success'])){
  $message = '<p class="alert alert-success">Message Sent Successfully.<span class="close" data-dismiss="alert">&times;</span></p>';
}
else if (isset($_GET['failed'])){
  $message = '<p class="alert alert-danger">Message was unable to be sent try again later.<span class="close" data-dismiss="alert">&times;</span></p>';
}
?>
 

         <section id="contact">
             <div class="container">
               <h2>G<span class="red_underline">ET IN TOUC</span>H</h2>
                 <div class="row">
                     <div class="col-md-8 col-md-offset-2">
                        <?php if (isset($message)) echo $message;?>
                         <form action="" method="post" class="clearfix">
                            <div class="row">
                                <div class="col-md-6">
                                     <div class="form-group">
                                         <label for="name">NAME:</label>
                                         <input type="text" id="name" name="name" class="form-control input-lg">
                                     </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                         <label for="email">EMAIL:</label>
                                         <input type="email" id="email" name="email" class="form-control input-lg">
                                     </div>
                                </div>
                            </div>
                             <div class="form-group">
                                 <label for="message">MESSAGE:</label>
                                 <textarea  rows= 7 id="message" name="message" class="form-control"></textarea>
                             </div>
                           <button type="submit" class="btn pull-right btn-danger" >SEND</button>
                         </form>
                     </div>
                 </div>
             </div>
         </section>
        </div>
        
       
  <?php  include 'footer.php';?>