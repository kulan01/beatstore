<?php

include 'includes/db.php';
include 'header.php';

if(isset($_SESSION['logged_in'])){
  header("Location: index.php");
}

?>

         
         <?php 
  if (isset($_POST['username'])){
  $name = $_POST['name'];
  $stage_name = $_POST['stage_name'];
  $username = $_POST['username'];
  $password = $_POST['password'];
  $confirm_password = $_POST['confirm_password'];
  $email    = $_POST['email'];
  
  
  $name = mysqli_real_escape_string($connection, $name);
  $stage_name = mysqli_real_escape_string($connection, $stage_name);
  $username = mysqli_real_escape_string($connection, $username);
  $password= mysqli_real_escape_string($connection, $password);
  $confirm_password= mysqli_real_escape_string($connection, $confirm_password);
  $email= mysqli_real_escape_string($connection, $email);
  
//  $salt = 'ilovemywifeaminabutsheplaywaytoomuch1770420';
//  $hash = '$2a$10$';
//  $password = crypt($password, $hash . $salt);
    $hashed_password = password_hash($password, PASSWORD_DEFAULT , ['cost' => 15]);
      if(!$password){
    $errors[] = "Password Cannot Not Be Empty!";
  } else {
        
        $errors = signup($username, $hashed_password, $email, $name, $stage_name);
      }
    
    if($errors === 'done'){
      login($username,$password );
    }
    }

  
  ?>
 
<div class="wrap">
         <section id="contact">
             <div class="container">
               <h2>S<span class="red_underline">ign Up For An Accoun</span>t</h2>
                 <div class="row">
                     <div class="col-md-8 col-md-offset-2">
<?php if(isset($errors)){
  

                       foreach($errors as $key => $error){
                       ?>
                       <p class ='alert alert-danger'><?php echo $error;?><span class="close" data-dismiss='alert'>&times;</span></p>
                       <?php  
                       }}
                       ?>
          <form action="" method='post' class="clearfix">
          <div class="row">
             <div class="col-md-6">
               <div class="form-group">
              <label class="label" for="#name">Name:</label>
              <input type="text" id="name" placeholder="Name (first and last)" class="form-control input-lg" name="name" required>
              </div>
            </div>
              <div class="col-md-6">
               <div class="form-group">
                <label class="label" for="#stage_name">Stage Name:</label>
                <input type="text" id="stage_name" placeholder="Stage Name" class="form-control input-lg" name="stage_name">
              </div>
            </div>
            
            </div>
           <div class="row">
             <div class="col-md-6">
               <div class="form-group">
              <label class="label" for="#username">Username:</label>
              <input type="text" id="username" placeholder="Username" class="form-control input-lg" name="username" required>
              </div> 
             </div>
             
             <div class="col-md-6">
               <div class="form-group">
              <label class="label" for="#email">Email:</label>
              <input type="email" id="email" placeholder="Email" class="form-control input-lg" name="email" required>
              </div>
            </div>
             </div>
             
             
            <div class="row">
             <div class="col-md-6">
               <div class="form-group">
              <label class="label" for="#password">Password:</label>
              <input type="password" id="password" placeholder="Password" class="form-control input-lg" name="password" required>
            </div>
             </div>
             <div class="col-md-6">
               <div class="form-group">
              <label class="label" for="#confirm_password">Password:</label>
              <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm Password" class="form-control input-lg" name="confirm_password" required>
            </div>
               
             </div>
           </div>
            
            <input type="submit" value="Sign Up" class="btn btn-danger btn-lg pull-right">
            
          </form>
          
          <p><span class="signup">Already Signed Up </span><a href="login.php" class="red">Log In Now</a></p>
          </div>
                 </div>
             </div>
         </section>
         

</div>
         
         
        
       
  <?php  include 'footer.php';?>