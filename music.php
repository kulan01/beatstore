
<?php include 'header.php';?>

<div id="music-hero" class=" carousel slide" data-ride="carousel">
<ol class="carousel-indicators">
    <li data-target="#hero-section" data-slide-to="0" class="active"></li>
    <li data-target="#hero-section" data-slide-to="1"></li>
    <li data-target="#hero-section" data-slide-to="2"></li>
    <li data-target="#hero-section" data-slide-to="3"></li>
</ol>
<div class="carousel-inner" role="listbox">
   
   <?php 
         
          $query = "SELECT * FROM music_posts ORDER BY id DESC LIMIT 4";
         $result = mysqli_query($connection, $query);
         if(!$result){
           
         }
         while($row = mysqli_fetch_assoc($result)){
           $song_name = $row['song_name'];
           $song_artist = $row['song_artist'];
           $song_url = $row['song_url'];
           $song_content = $row['song_content'];
           
           ?>
            
   <div class="item">
       <iframe width="100%" height="400px" src="https://www.youtube.com/embed/<?php echo $song_url;?>" frameborder="0" allowfullscreen></iframe>

   </div>
        <?php } ?>


</div>
<a href="#music-hero" role="button" data-slide="prev" class="left carousel-control"><span class="glyphicon glyphicon-chevron-left"></span></a>
<a href="#music-hero" role="button" data-slide="next" class="right carousel-control"><span class=" glyphicon glyphicon-chevron-right"></span></a>

</div>
       
       
<section id="blog">
   <div class="container">
       <div class="row">
          <?php 
         
          $query = "SELECT * FROM music_posts ORDER BY id DESC";
         $result = mysqli_query($connection, $query);
         if(!$result){
           
         }
         while($row = mysqli_fetch_assoc($result)){
           $song_name = $row['song_name'];
           $song_artist = $row['song_artist'];
           $song_url = $row['song_url'];
           $song_content = $row['song_content'];
           
           ?>
           
           <div class="col-sm-6">
              <h2><?php echo $song_name;?> - <?php echo $song_artist;?></h2>
              <iframe width="100%" height="200px" src="https://www.youtube.com/embed/<?php echo $song_url;?>" frameborder="0" allowfullscreen></iframe>
<!--              <img src="images/contact.jpg" alt="">-->
               <p><?php echo $song_content;?></p>

           </div>
           
           <?php } ?>
           
       </div>
   </div>

</section>


<?php include 'footer.php'; ?>