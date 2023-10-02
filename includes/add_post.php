<!--This is the add post section of the admin page-->
 

 
 <form action="" method="post">
  <div class="form-group">
  <label for="song_name">Song Name: </label>
  <input name="song_name" type="text" class="form-control">
  </div>
  <div class="form-group">
  <label for="song_artist">Song Artist: </label>
  <input name="song_artist" type="text" class="form-control">
  </div>
  <div class="form-group">
  <label for="song_url">Song URL: </label>
  <input name="song_url" type="text" class="form-control">
  </div>
  <div class="form-group">
  <label for="song_content">Song Content: </label>
    <textarea rows=10 name="song_content" class="form-control"></textarea>
  </div>
  <input class="btn btn-primary pull-right" type="submit" value="Add Post" name='submit'>
</form>


<?php

if(isset($_POST['submit'])){
  $song_name = mysqli_real_escape_string($connection, $_POST['song_name']);
  $song_artist = mysqli_real_escape_string($connection,$_POST['song_artist']);
  $song_url =mysqli_real_escape_string($connection, $_POST['song_url']);
  $song_content = mysqli_real_escape_string($connection,$_POST['song_content']);
  
  
  $query = "INSERT INTO music_posts (song_name, song_artist, song_url, song_content) VALUES ( '{$song_name}','{$song_artist}','{$song_url}','{$song_content}')";
  $result = mysqli_query($connection, $query);
  if(!$result){
    die(mysqli_error($connection));
  }
  
  
  
  
  
}