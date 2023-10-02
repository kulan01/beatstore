<?php
include 'db.php';


//This is the get license function
//gets the content of the license file from the license_template and adds
//The required information to the file based on the transaction id,
//the beat name and the license name
function getLicense($transaction, $beat_name, $license_name){
  global $connection;
  $url = 'http://localhost/beatstore_empire/includes/license_template.php';
  
  
  $query = "SELECT * FROM licenses WHERE license_name = '{$license_name}'";
  $result = mysqli_query($connection, $query);
  if(!$result){die();}
  foreach($result as $row){
    $license_id = $row['id'];
  }
  $data = array('beat_name' => "{$beat_name}",'id' => "{$license_id}",'transaction' => "{$transaction}");

  // use key 'http' even if you send the request to https://...
  $options = array(
      'http' => array(
          'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
          'method'  => 'POST',
          'content' => http_build_query($data)
      )
  );
  $context  = stream_context_create($options);
  $result = file_get_contents($url, false, $context);
  if ($result === FALSE) { /* Handle error */ }

  return $result;
}

//This function is used for signing up a new user
function signup($username, $password, $email, $name, $stage_name){
  global $connection;
  $errors =[];



  $query = "SELECT * FROM users WHERE email = '$email' OR username ='$username'";

  $result = mysqli_query($connection, $query);
  if (mysqli_num_rows($result) == 0){
    $signup_query = "INSERT INTO users (username, password, email, name, stage_name) VALUES ('$username', '$password', '$email', '$name', '$stage_name')";
    $signup_result = mysqli_query($connection, $signup_query);
    if(!$signup_result){
      $errors[] = 'Failed To Sign You up try again Later!';
    }
    else {
      return 'done';

    }
  }


  while($row = mysqli_fetch_assoc($result)){
    if ($row['username'] == $username){
      $errors[] = 'Username is aleady Taken';
    }
    if($row['email'] == $email){
      $errors[] = 'Email is aleady Taken';
    }
  }
  return $errors;
}




//This function is used to login existing users
function login($username, $password){
  global $connection;
  $query = "SELECT * FROM `users` WHERE username ='$username' LIMIT 1";
  $result = mysqli_query($connection, $query);
  if(mysqli_num_rows($result) == 0){
    $error = "<p class='alert alert-danger'>Username and Password Combination Not In System, Try Again! <span class='close'>X</span></p>";
    return $error;
  }
  while($row = mysqli_fetch_assoc($result)){

    $cred = array(
      'hashed_password' => $row['password'],
      'id'              => $row['id'],
      'isAdmin'         => $row['isAdmin'],
      'email'           => $row['email'],
      'username'        => $row['username'],
      'name'            => $row['name'],
      'stage_name'      => $row['stage_name'],


    );

   if(password_verify($password, $cred['hashed_password'])){
      $_SESSION['logged_in'] = true;
      foreach($cred as $key => $value){
      $_SESSION[$key] = $value;

    }

     if(isset($_GET['checkout'])){
       header('Location: checkout.php');
     }
     else {
       header('Location: index.php');
     }


   }
    else{
      $error = "<p class='alert alert-danger'>Username and Password Combination Not In System, Try Again! <span class='close'>X</span></p>";
      return $error;
    }

  }

}


//This function returns a json encoded array of the songs in the database for the playlist
//on the index page
function getSongs(){
  global $connection;
  $query = 'SELECT * FROM beats';
  $result = mysqli_query($connection, $query);
  if(!$result){
    die();
  }
  $songs = [];
  while($row = mysqli_fetch_assoc($result)){

    $song = array(
      'id' => $row['id'],
      'song_title' => $row['name'],
      'filename' => $row['filename'],
      'song_bpm' => $row['bpm'],
      'song_tags' => $row['tags'],
      'cover' => $row['cover_image'],

    );
    $songs[] = $song;

  }

  echo json_encode($songs);
}


//This gets the navbar content
function getNavbar(){
  global $connection;
  $query = 'SELECT * FROM navbar';
  $result = mysqli_query($connection, $query);
  if(!$result){
    die();
  }
  $songs = [];
  while($row = mysqli_fetch_assoc($result)){

    $page = array(
      'page' => $row['page'],
      'link' => $row['link']
    );
    $pages[] = $page;

  }
  return $pages;

}
//This function sends emails
function sendMail($from, $name, $message){
  $from = 'From: '. $from . '\r\n';
  $subject = $name . ' Has A Question';
  $to = '';
  mail($to, $subject, $message, $from);

}
