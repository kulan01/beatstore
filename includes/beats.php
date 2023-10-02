<?php 


if (isset($_GET['delete'])){
  $id= $_GET['delete'];
  $query = "DELETE FROM beats WHERE id={$id}";
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
      <th>Beat Name</th>
      <th>Filename</th>
      <th>Cover Image</th>
      <th>BPM</th>
      <th>Tags</th>
      <th>Edit Beat</th>
      <th>Delete Beat</th>
    </tr>
  </thead>
  <tbody>
        

<?php 
         
    $query = "SELECT * FROM beats ORDER BY id DESC ";
   $result = mysqli_query($connection, $query);
   if(!$result){

   }
   while($row = mysqli_fetch_assoc($result)){
     $name = $row['name'];
     $id = $row['id'];
     $filename = $row['filename'];
     $cover_image = $row['cover_image'];
     $bpm = $row['bpm'];
     $tags = $row['tags'];
     
     
     echo "<tr>";
      
      echo "<td>$id</td>";
      echo "<td>$name</td>";
  
      echo "<td>$filename</td>";
      echo "<td><img  class='beat_img' src= '$cover_image' alt='Cover Image'></td>";
      echo "<td>$bpm</td>";
      echo "<td>$tags</td>";
      echo "<td><a href='cms.php?source=edit_beat&edit=$id' >Edit</a></td>";
      echo "<td><a href='cms.php?source=beat&delete=$id' >Delete</a></td>";
      echo "</tr>";

   }
           
?>
  </tbody>
</table>