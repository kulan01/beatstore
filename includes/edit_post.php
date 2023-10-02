<!--This Page Edits the post that was clicked-->



<?php 
if (isset($_GET['edit'])){
  $edit_id = mysqli_real_escape_string($connection, $_GET['edit']);
  $query = "SELECT * FROM music_posts WHERE id= {$edit_id}";
  $result = mysqli_query($connection, $query);
  if(!$result){
    header("Location: cms.php?source=posts");
    die();
  }
  while($row = mysqli_fetch_assoc($result)){
    $song_name = $row['song_name'];
    $song_artist = $row['song_artist'];
    $song_url = $row['song_url'];
    $song_content = $row['song_content'];
    
    
    
    
    ?>
    
    


 
 
 <form action="" method="post">
  <div class="form-group">
  <label for="song_name">Song Name: </label>
  <input name="song_name" type="text" class="form-control" value="<?php echo $song_name; ?>">
  </div>
  <div class="form-group">
  <label for="song_artist">Song Artist: </label>
  <input name="song_artist" type="text" class="form-control" value="<?php echo $song_artist; ?>">
  </div>
  <div class="form-group">
  <label for="song_url">Song URL: </label>
  <input name="song_url" type="text" class="form-control" value="<?php echo $song_url; ?>">
  </div>
  <div class="form-group">
  <label for="song_content">Song Content: </label>
    <textarea rows=10 name="song_content" class="form-control"><?php echo $song_content; ?></textarea>
  </div>
  <input class="btn btn-primary pull-right" type="submit" value="Update Post" name='submit'>
</form>
<?php  }
} ?>


<?php

if(isset($_POST['submit'])){
  $song_name = mysqli_real_escape_string($connection, $_POST['song_name']);
  $song_artist = mysqli_real_escape_string($connection,$_POST['song_artist']);
  $song_url =mysqli_real_escape_string($connection, $_POST['song_url']);
  $song_content = mysqli_real_escape_string($connection,$_POST['song_content']);
  
  
  $query = "UPDATE music_posts SET ";
  $query .="song_name =  '{$song_name}', "; 
  $query .= "song_artist = '{$song_artist}', ";
  $query .= "song_url = '{$song_url}', ";
  $query .= "song_content = '{$song_content}' ";
  $query .= "WHERE id = {$edit_id} ";
  
  
  
  $result = mysqli_query($connection, $query);
  if(!$result){
    die(mysqli_error($connection));
  }
  header("Location: cms.php?source=posts");
  
  
  
}