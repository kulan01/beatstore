<!--This checks to see if the user payed the or canceled the payment and
excutes the payment of returns the user back to the cart page to try again-->


<?php
include 'includes/db.php';
include 'includes/functions.php';
session_start();
require "app/start.php";


use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;

//This checks to see if the payment was not successful
//and redirects the user back to the cart page
if (!isset($_GET['success'],$_GET['paymentId'], $_GET['PayerID']) || $_GET['success'] === "false" || $_GET['success'] === ""){
  header("Location:cart.php?failed");
  die();
}
 //if the payment was successful
//the se store the paymentId and the payerId which come from
//paypal and then excute the payment so that the user gets charged with
//the payment
$paymentId = $_GET['paymentId'];
$payerId = $_GET['PayerID'];


$payment = Payment::get($paymentId, $paypal);

$execute = new PaymentExecution();
$execute->setPayerId($payerId);


try{
  $result = $payment->execute($execute, $paypal);
}catch(Exception $e){
  die($e);
}


//Here we store the transaction in the database
date_default_timezone_set('America/New_York');
$time = date('M d Y h:i:sa');
$buyer_id = $_SESSION['id'];
foreach($_SESSION['shopping_cart'] as $song){

  $beat_id  = $song['id'];
  $beat_name  = $song['name'];
  $license  = $song['license'];
  $price  = $song['price'];

  $query = "INSERT INTO transaction (beat_id, buyer_id, beat_name, license, payerId, paymentId, price, created_time) ";
  $query .= "VALUES ('{$beat_id}', '{$buyer_id}', '{$beat_name}', '{$license}', '{$payerId}', '{$paymentId}', '{$price}', NOW())";

  $result = mysqli_query($connection, $query);
  if(!$result){
    die(mysqli_error($connection));
  }



}
//After the transaction is added to the database the applications redirects to the send_beats page
//Sends the beats to the users email

header("Location: send_beats.php?transaction=$paymentId");
