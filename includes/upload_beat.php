<form class="form" action="" enctype="multipart/form-data" method="post">
  <div class="form-group files beat">
    <label for="beat">*Select Beat To Upload:</label>
    <input type="file" name="beat" id="beat" accept="audio/*" class="form-control input">
    <div class='dragover'>
      <div class="drag">Upload Beat</div>
    </div>
  </div>

  <div class="form-group files cover">
    <label for="cover">Select Cover Image To Upload:</label>
    <input type="file" class="form-control input" id="cover" accept="image/*" name="cover">
    <div class='dragover'>
      <div class="drag">Upload Cover</div>
    </div>
  </div>
  <div class="form-group">
    <label for="name">*Beat Name:</label>
    <input type="text" class="form-control" name="name" placeholder="Name of Beat">
  </div>

  <div class="form-group">
    <label for="bpm">BPM:</label>
    <input type="text" class="form-control" name="bpm" placeholder="BPM of Beat">
  </div>

  <div class="form-group">
    <label for="tags">TAGS:</label>
    <input type="text" class="form-control" name="tags" placeholder="TAGS">
  </div>

  <input type="submit" name="submit" value="UPLOAD" class="btn btn-primary btn-md pull-right">
</form>

<?php
if(isset($_POST['submit'])){
  // Ensure you have a valid database connection
  // $connection = mysqli_connect(...);

  // Handle file uploads using $_FILES
  $name = mysqli_real_escape_string($connection, $_POST['name']);
  $bpm = mysqli_real_escape_string($connection, $_POST['bpm']);
  $tags = mysqli_real_escape_string($connection, $_POST['tags']);

  $beat_file = $_FILES['beat']['name'];
  $cover_image_file = $_FILES['cover']['name'];

  // Move uploaded files to desired location
  move_uploaded_file($_FILES['beat']['tmp_name'], 'media/' . $beat_file);
  move_uploaded_file($_FILES['cover']['tmp_name'], 'images/' . $cover_image_file);

  $query = "INSERT INTO beats (name, filename, cover_image, bpm, tags) VALUES ('$name', '$beat_file', '$cover_image_file', '$bpm', '$tags')";
  $result = mysqli_query($connection, $query);
  if(!$result){
    die(mysqli_error($connection));
  }
}
?>
