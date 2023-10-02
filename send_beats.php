<!--This file send the beats to the client after they pay for the beats -->



<?php
include 'includes/db.php';
include 'includes/functions.php';
session_start();

require_once "vendor/phpmailer/phpmailer/PHPMailerAutoLoad.php";
if (!isset($_GET['transaction']) || empty($_GET['transaction'])){
  header("Location: index.php");
  die('no tansaction id');
}
$transaction = mysqli_real_escape_string($connection, $_GET['transaction']);

$query = "SELECT * FROM transaction WHERE paymentId  = '$transaction'";
$result = mysqli_query($connection, $query);
if(mysqli_num_rows($result) == 0){
  header("Location: index.php");
  die('no results');
  }
  $beats = [];
if(!isset($_SESSION['id'])){
  header("location: login.php");
  die();
}
  $current_buyer_id = $_SESSION['id'];
  while($row = mysqli_fetch_assoc($result)){
    
    $buyer_id = $row['buyer_id'];
    if ($buyer_id === $current_buyer_id){
      $beats[] = [ 
      'id'      => $row['beat_id'],
      'license' => $row["license"]
      ];
    }
    else {
      header("location: index.php");
      die("not right buyer");
    }
    
  }



$bodytext = "<!DOCTYPE html>
<html>
  <head>
  </head>
  <body>
  <div class='container'>
    <h1>Your Purchased Beats</h1>";
  

$mail = new PHPMailer();
$mail->setFrom('beats@beatstore.com', 'Beats Store');
$mail->addReplyTo('beats@beatstore.com', 'Beat Store');
$mail->FromName  = 'Beats Store';
$mail->Subject   = 'Here Are Your Purchased Beats  From The Beat STORE';

$mail->AddAddress( 'isissa01@gmail.com' );

//This loops through the beats and adds them to the email 
//that is going to be sent as attachments
foreach($beats as $beat){
    $id = $beat['id'];
    $license = $beat['license'];
      $query = "SELECT * FROM beats where id = {$id} LIMIT 1";
      $result = mysqli_query($connection, $query);

    if(!$result){
      die('error');
    }
    while($row = mysqli_fetch_assoc($result)){
      $file_content = strip_tags(getLicense($transaction, $row['name'], $license));
      if (!file_exists('./licenses')) {
        mkdir('./licenses', 0777, true);
      }
      $license_file_name ="./licenses/{$row['name']}_{$license} license_{$_SESSION['name']}.txt";
      
      try {
        $license_file = fopen($license_file_name, 'w');
        fwrite($license_file, $file_content);
      }catch (Exception $e){
        die($e);
      }
      
      
      
      $mail->AddAttachment( $row['filename'] ,"{$row['name']}.mp3");
      $mail->AddAttachment( $license_file_name, "{$row['name']}_{$license} license_{$_SESSION['name']}.txt");
      
      $bodytext .= "<div class='well'>";
      $bodytext .= "<p>{$row['name']}</p>";
      $bodytext .= "</div>";

    }
      
      
}

$bodytext .= "</div></body></html>";
$mail->msgHTML($bodytext);


if(!$mail->Send()){
   echo "Error Message Did not Send!! " . $mail->ErrorInfo;

}
else{
  $_SESSION["shopping_cart"] = [];
  $mail->clearAttachments();
  header("location: account.php?success");

}
?>
