<?php 
include 'db.php';
if (isset($_POST['name'])){
  
  if(!empty($_FILES['beat']['name']) && !empty($_POST['name'])){
    $beat = $_FILES['beat'];
    $cover = $_FILES['cover'];
    $name = $_POST['name'];
    $tags = $_POST['tags'];
    $bpm = $_POST['bpm'];
    
    $beat_filename = 'media/'. rand(1000, 5000000). '_'.strtolower(str_replace(' ', '_',basename($beat['name'])));
    $cover_filename = 'images/'. rand(1000, 5000000). '_'.strtolower(str_replace(' ', '_',basename($cover['name'])));
    
    $beat_filename = mysqli_real_escape_string($connection, $beat_filename);
    $cover_filename = mysqli_real_escape_string($connection,$cover_filename);
    $name = mysqli_real_escape_string($connection, $name);
    $bpm = mysqli_real_escape_string($connection, $bpm);
    $tags = mysqli_real_escape_string($connection, $tags);
    if (!file_exists($beat_filename) && !file_exists($cover_filename)) {
        if(move_uploaded_file($beat['tmp_name'], $beat_filename) &&move_uploaded_file($cover['tmp_name'], $cover_filename) ){
          $query = "INSERT INTO beats(name, filename, cover_image, bpm, tags) VALUES ('$name', '$beat_filename', '$cover_filename', $bpm, '$tags')";
          $result = mysqli_query($connection, $query);
          
    
        }

        
    }
    
    
  }
  else{
    echo "<p class='alert alert-danger' >Something is Missing! <span class='close '>X</span></p>"; 
  }
  
}




?>