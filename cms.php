<?php include 'header.php';

if(!isset($_SESSION['logged_in']) || $_SESSION['isAdmin'] == 0){
  header("Location: index.php");
}
?>



 <section id="cms">
<div class='container'>
   <div class="row">
    
    <div class="col-md-2" id="navi">
     <ul>
      <li>
        <a href="javascript:;" data-toggle="collapse" data-target="#beats">Beats <i class="fa fa-fw fa-caret-down"></i></a>
        <ul id="beats" class="collapse">
            <li><a href="cms.php?source=beats" class="active">All Beats</a></li>
            <li><a href="cms.php?source=add_beat" class="active">Add Beat</a></li>
        </ul>
      </li>
      <li>
        <a href="javascript:;" data-toggle="collapse" data-target="#posts">Music Posts <i class="fa fa-fw fa-caret-down"></i></a>
        <ul id="posts" class="collapse">
            <li><a href="cms.php?source=posts">All Posts</a></li>
            <li><a href="cms.php?source=add_post">Add Post</a></li>
        </ul>
       </li>
       
       <li><a href="cms.php?source=accounts">User Acounts</a></li>
     </ul>
      
      
    </div>
    <div class="col-md-10" id="main-content">
     <?php 
     if(isset($_GET['source'])){
       $source = $_GET['source'];
                  
       }
      else{
        
        $source = '';
      }
       switch($source){
           case 'add_beat';
           include 'includes/upload_beat.php';
           break;
           case 'beats';
           include 'includes/beats.php';
           break;
           case 'posts';
           include 'includes/posts.php';
           break;
           case 'add_post';
           include 'includes/add_post.php';
           break;
           case 'edit_post';
           include 'includes/edit_post.php';
           break;

           case 'accounts';
           include 'includes/accounts.php';
           break;
         default;
           include 'includes/beats.php';
           break;

       
       
       
     } ?> 
      
      
      
    </div>
    
  </div>
   </div>
</section>




<?php include 'footer.php';?>