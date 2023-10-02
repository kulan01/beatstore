let songAudio;
let beatFiles = {};

//Hides the Pause button on the player when the page loads so that only the play button shows
$('.pause').hide();


//MUSIC RELEASE PAGE

$('.carousel-inner').children().first().addClass('active');



//CMS PAGE

//This hides the dragover element when the add beat is open on the admin side
$('.dragover').hide();

//This shows or hides the dragover element when something is draged over it
const parent = document.querySelectorAll('.files');
console.log(parent.length);
for(let i=0; i<parent.length; i++ ){
  parent[i].ondragover = (ev) =>{
    ev.preventDefault();
    $(parent[i].querySelector('input')).hide();
    $(parent[i].querySelector('.dragover')).show();
    return false;

    }

  parent[i].ondragexit = (ev) =>{
    $(parent[i].querySelector('input')).show();
    $(parent[i].querySelector('.dragover')).hide();
    return false;
  }
   //This adds the file added to the beatFiles array or sets them to be null
    parent[i].ondrop =  function(event){
    $(parent[i].querySelector('.dragover')).hide();
      div= $('<div>');
      $parent = $(parent[i]);
      div.text(event.dataTransfer.files[0].name).addClass('file');

      $parent.children('.file').remove();
     let file= event.dataTransfer.files[0]

      if(parent[i].className.includes('cover')){

        if(file.type.split('/')[0] =='image'){
          beatFiles['cover'] = file;
           $parent.append(div);
        }
        else{
           $(parent[i].querySelector('input')).show();
          beatFiles['cover'] = null;
        }

      }
      else {
       if(file.type.split('/')[0] =='audio'){
          beatFiles['beat'] = file;
           $parent.append(div);

        }
        else{

           $(parent[i].querySelector('input')).show();
          beatFiles['beat'] = null;
        }

      }
      return false;
    }

}








//this event happens when the beat form is submitted 


$('.form').submit((event)=>{
  event.preventDefault();
  let beat_input = document.querySelector('#beat').files[0];
  let beat = (beat_input) ?beat_input :beatFiles.beat;
  let cover_input = document.querySelector('#cover').files[0];
  let cover = (cover_input) ?cover_input :beatFiles.cover;
  let name = $('input[name=name]').val();
  let bpm = $('input[name=bpm]').val();
  let tags = $('input[name=tags]').val();
  let data = {
    beat  : beat,
    cover : cover,
    name  : name,
    bpm   : bpm,
    tags  : tags
  };
//this creates a form data anda adds all the inputs into the the new form data array
  let formD = new FormData();
  $.each(data ,(key, value) =>{
    formD.append(key, value);
  });
// this opens an ajax request and sends the input fields to the upload.php page and logs out ('Done')
//When is it finished
  $.ajax({
    processData: false,
    contentType: false,
    method : "POST",
    url: 'includes/upload.php',
    data :formD,
    success: function(response){
     console.log(response);
    }
}).done(function(){
    console.log("Done");
  });



});













// Scroll to the top
$(document).on("click","#back_to_top",function(e){
    e.preventDefault();
    $("body,html").animate({scrollTop:0},$(window).scrollTop()/3,"linear");
});

//This checks the width of the window and changes how elements appear based on 
//the width
const $win = $(window);
const width_check = ()=>{

  if($win.width() < 683){

    $('.add-to-cart').removeClass("pull-right");
  }
  else if($win.width() < 769){
    $('.tags').removeClass("pull-left");
    $('.add-to-cart').addClass("pull-right");




  }

  else{

     $('.tags').addClass("pull-left");

  }
  if($win.width() > 991){
    $('.title-header').attr('colspan', "2");
  }
  else{
    $('.title-header').attr('colspan', "1");
  }

}
$(document).ready(width_check);
$win.resize(width_check);

//Pop up


//This Initializes the audio to play next and takes in a table row as input
function initAudio(track){
    let song = track.data("filename");
    let title = track.children('.song_title').text();
    let cover_image = track.children('.cover').css('background-image');
    $('.cover-image').css('background-image', cover_image);


    let tags = track.children('.song_tags').text();
    let tags_array = tags.split(',');
    $tags =$(".top-player .tags").html('');
    $.each(tags_array,(index, tag_string)=>{
      let $tag = $('<li class="tag"></li>').text('#' + tag_string);
      $tags.append($tag);
    });

    songAudio = new Audio(song)

    $(".top-player .title").text(title);
//    $(".active").removeClass("active");
//    element.addClass("active");

}
//This function Add the songs to the table on the index
//page it uses ajax to get the json data outputted from the
//server and loops through it to create the table body for
//the playlist on the index page
const getSongs= () =>{
  $.ajax({
    url : "includes/getSongs.php",
    method : 'post',
    success : function(msg){
      let response = JSON.parse(msg);
    let $playlist_table = $('.playlist-table tbody');
    $.each(response, function(index, song){
    let $row = $("<tr></tr>");
    $row.addClass('track');
      let song_id = 0;
      $.each(song, function(key, value){
        let $col = $("<td></td>");

        if(key === 'id'){
          song_id = value;
        }
        else if(key === "filename"){
          let audio= new Audio(value);
          audio.ondurationchange = () =>{

          let secs = Math.floor(parseInt(audio.duration % 60));
            let mins = Math.floor(parseInt((audio.duration / 60 )% 60));
            if(mins < 10){
              mins = '0' + mins;
            }
            if (secs < 10 ){
              secs = '0' + secs;
            }
            let duration = mins + ':' + secs;
            $col.addClass("song_time hidden-xs hidden-sm").text(duration);
            audio = null;

          }
          $row.attr('data-filename', value);
          $row.append($col);
        }
        else if(key === "cover"){

          $col.css('background-image', "url(" + value + ")").addClass('cover  hidden-xs hidden-sm');
          $row.prepend($col);
        }

        else{
            if(key === 'song_tags' || key === 'song_bpm'){
               $col.addClass("hidden-xs hidden-sm");
               }
          $col.addClass(key).text(value);
          $row.append($col);
        }


      });
      let $license =$('<td class="song_license"><select class="license-select" name="licenses"><option value="MP3">Mp3 License</option><option value="WAV">WAV License</option><option value="Premium">Premium License</option><option value="Unlimited">Unlimited License</option></select></td>');
      let $price = $('<td colspan="1" class="song_price">$<span class="price">24.99</span> <a data-id='+ song_id +' href="cart.php" class="add-btn"><span class="fa fa-shopping-cart"></span> ADD</a></td>');

      $row.append($license);
      $row.append($price);
      $playlist_table.append($row);


      });


      width_check();
      let $first = $(".playlist-table .track").first();
      $first.addClass("active");
      initAudio($first);
      play();

      $(songAudio).bind('timeupdate', function(){
        if (songAudio.currentTime == songAudio.duration){
          next();
        }

      });


  }
});
}

//This checks to see if the page is the index page then
//runs the getSongs function which adds the songs to the page

if ( location.pathname.endsWith('/index.php')  ||  location.pathname.endsWith('/')) {
  getSongs();
}

//Stores the User name and Password on the local storage so the
//user doesn't have to put their username and password everytime
//they want to sign in  if they click the remember me button

if(location.pathname.includes('login.php')){

    if (localStorage.chkbx && localStorage.chkbx != '') {
        $('#remember').attr('checked', 'checked');
        $('#username').val(localStorage.usrname);
        $('#password').val(localStorage.pass);
    } else {
        $('#remember').removeAttr('checked');
        $('#username').val('');
        $('#password').val('');
    }

    $('input[type=submit]').click(function(event) {
        event.preventDefault();
        if ($('#remember').is(':checked')) {
            // save username and password
            localStorage.usrname = $('#username').val();
            localStorage.pass = $('#password').val();
            localStorage.chkbx = $('#remember').val();
        } else {
            localStorage.usrname = '';
            localStorage.pass = '';
            localStorage.chkbx = '';
        }
      $('form').submit();
    });

}

//This Checks if the Licence Was Changed and then Changes the Price Based on the Selection

$('.playlist-table tbody').change(function(event){
  let license = $(event.target).val();
  let $track = $(event.target).parent().siblings('.song_price');
  console.log($track);
  let price = "24.99";

  switch(license){
    case "MP3" :
      price = "24.99";
      break;
    case "WAV":
      price = "34.99";
      break;
    case "Premium":
      price = "80.00";
      break;
    case "Unlimited":
      price = "200.00";
      break;
                }
  $track.children('.price').text(price);
});




 //SELECTING WHICH SONG TO PLAY AND ADDING ITEMS TO CART
$('.playlist-table tbody').click(function(event){
  event.preventDefault();
if($(event.target).parent().hasClass('track')){
  songAudio.pause();
  $track = $(event.target).parent();
  $(".track").removeClass("active");
  $track.addClass('active');


  initAudio($track);
  play();
}
else if($(event.target).parent().hasClass('song_price')){
  let url = $(event.target).attr('href');
  let id= $(event.target).data('id');
  let price= $(event.target).siblings('.price').html();

  let license =$(event.target).parent().siblings(".song_license").children(".license-select").val();

  // Sending the Ajax request to add the item to the cart
  $.ajax(url,{
    method : 'get',
    data : {
      add_cart: id,
      name: $(event.target).parent().siblings('.song_title').text(),
      price: parseFloat(price),
      license: license
           },
    success: function(response){
      if (response !='no'){
        $cart = $('.cart_count');
        count =parseInt($cart.html());

        $cart.text(count + 1);
      }


    }
  });
}

});

$(".play").click(function(){
play();
});
$(".pause").click(function(){
songAudio.pause();
$(".play").show();
$(".pause").hide();
});



function play(){
  songAudio.play();

  $(".play").hide();
  $(".pause").show();
//  $(".duration").fadeIn(300);
//  show_duration();
}

function next(){
  songAudio.pause();
  var next = $('.track.active').next();
  $(".track").removeClass("active");

  if (next.length==0){
    next = $("tbody .track:first-child");
  }
   next.addClass("active");
  initAudio(next);
  play();

}



//License Page Modal
//Making the modal show different License Information Depending On the License Clicked


$('#licenses button[data-toggle="modal"]').click(function(){

  let id = parseInt($(this).data('id'));
  console.log(id);
  let url = 'includes/license_template.php';
  let data = {
    id : id
  }

  $.post(url, data, function(response){
    

    response = JSON.parse(response);



    $('#licenseModal .modal-title').html(response.type.toUpperCase() + ' License');
    $('#licenseModal .modal-body').html(response.content);


  });
});
