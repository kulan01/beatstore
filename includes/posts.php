<?php 
//This is the posts page in the admin section
//it checks to see which get attributes  are passed to it in the url
//and based on the attribute it does different things

if (isset($_GET['delete'])){
  $id= $_GET['delete'];
  $query = "DELETE FROM music_posts WHERE id={$id}";
  $result  = mysqli_query($connection, $query);
  if(!$result){
    die(mysqli_error($connection));
  }
  header("Location: cms.php?source=posts");
}

?>
 

 
 
 
 
 <table class="table table-bordered table-hover">
  <thead>
    <tr>
      <th>Id</th>
      <th>Song Name</th>
      <th>Song Artist</th>
      <th>Song URL</th>
      <th>Post Content</th>
      <th>Edit Post</th>
      <th>Delete Post</th>
    </tr>
  </thead>
  <tbody>
        

<?php 
         
    $query = "SELECT * FROM music_posts ORDER BY id DESC ";
   $result = mysqli_query($connection, $query);
   if(!$result){

   }
   while($row = mysqli_fetch_assoc($result)){
     $song_name = $row['song_name'];
     $id = $row['id'];
     $song_artist = $row['song_artist'];
     $song_url = $row['song_url'];
     $song_content = $row['song_content'];
     
     
     echo "<tr>";
      
      echo "<td>$id</td>";
      echo "<td>$song_name</td>";
  
      echo "<td>$song_artist</td>";
      echo "<td>$song_url</td>";
      echo "<td>$song_content</td>";
      echo "<td><a href='cms.php?source=edit_post&edit=$id' >Edit Post</a></td>";
      echo "<td><a href='cms.php?source=post&delete=$id' >Delete</a></td>";
      echo "</tr>";

   }
           
?>
  </tbody>
</table>