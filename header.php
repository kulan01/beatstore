<!--This is the header section it is on another php page so the it can be included dynamically into any page without having to hard code it to each individual page-->


<!--This include statements include the database and functions from the files-->
<?php include 'includes/db.php'; ?>
<?php include 'includes/functions.php';?>
 <?php 
  session_start();
  if(!isset($_SESSION['shopping_cart'])){
  $_SESSION['shopping_cart'] = [];
    
  }
  
  $title = '';
  $path = explode( '/',$_SERVER['REQUEST_URI']);
  $link= $path[count($path) -1];
  foreach(getNavbar() as $key => $value){
    
    if ($link === $value['link']){
      $title = $value['page'];
      
    }
  }
?>


<!DOCTYPE html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta http-equiv="Cache-control" content="no-cache">
  <title> | <?php echo $title;?></title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" >
  <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="main.css">

  <link rel="stylesheet" href="./seach_bar.css">

  
  <!-- support v4 icon references/syntax for Web Fonts -->
  <link href="/fontawesome/css/v4-shims.css" rel="stylesheet" />
  
  </head>
<body>
  <!--[if lt IE 7]>
      <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
  <![endif]-->

      
<!-- This Inlcudes the Navbar which is in another file       -->
  <?php include 'includes/navbar.php'; ?>