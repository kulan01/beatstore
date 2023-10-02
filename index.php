<?php
include 'includes/db.php';

?>
<?php include 'header.php'; ?>

<?php



?>

<div class="jumbotron" id="hero">
        <div class="container">
        <div class="div-searchbar">
            <div class="searchbar">
                <div class="main-searchbar">
                    <form method="get" action="">
                        <div class="tb">
                            <div class="td"><input type="text" placeholder="What are you looking for?" required></div>
                            <div class="td" id="s-cover">
                                <button type="submit">
                      <div id="s-circle"></div>
                      <span></span>
                    </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        </div>

       </div>
      <div class="jumbotron" id="player">
        <div class="container">
           <div class="top-player clearfix">

             <div class="cover-image">
              <button class="play-pause"><span class="fa fa-play play"></span><span class="fa fa-pause pause"></span></button>
               <img class="" src="" alt="">

             </div>
             <div class="details">
               <div class="title">No One</div>
             <div class="genre-list">GENRE <span class="genre">HIP HOP</span> <span class="genre">TRAP</span></div>
             <ul class="tags">
               <li class="tag">#Migos</li>
               <li class="tag">#Young Thug</li>
               <li class="tag">#Travis Scott</li>
               <li class="tag">#21 Savage</li>
             </ul>
             </div>

           </div>
            <div class="jumbo-area" id="playlist">
              <h3>Playlist</h3>
            <table class ='table playlist-table' >
             <thead>
               <tr>
                <th colspan="1" scope="col" class="title-header">title</th>
                <th colspan="1" scope="col" class="time-header hidden-xs hidden-sm">time</th>
                <th colspan="1" scope="col" class="bpm-header hidden-xs hidden-sm">bpm</th>
                <th colspan="1" scope="col" class="tags-header hidden-xs hidden-sm">tags</th>
                <th colspan="1" scope="col" class="license-header">License</th>
                <th colspan="1" scope="col" class="price-header">price</th>
              </tr>
             </thead>
             <tbody>

             </tbody>

            </table>

            </div>
        </div>

       </div>

       
<?php include 'footer.php'; ?>
