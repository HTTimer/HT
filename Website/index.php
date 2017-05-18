<?php
//Check login
$login=isset($_COOKIE["HTTimer-login"]);
$username="";
if(!$login){
  echo "<script>window.location.href='../Timer-Server/login.php';</script>";
  die();
}
if($login)
  $username=$_COOKIE["HTTimer-login"];
$isAdministrator=$username=="HTTimer-developer";

//If no location, set it to index
if(!isset($_GET["show"])){
  $_GET["show"]="index";

  //If logged in, set it to dashboard
  if($login)
    $_GET["show"]="dashboard";
}

//Do not build menu if the user wants to see the timer
if($_GET["show"]=="Timer"){
  echo "redirecting you, please wait...";
  echo "<script>window.location.href='../Timer/index.php';</script>";
}else{
  //build website
  //Configuration
  $dashboard_printnews=false;
?>
<!doctype html>
<html>
  <head>
    <title>CMOS - Cubing Management and Optimizing System</title>
    <script src="lib/jquery.min.js"></script> <!-- JQuery 3.1.1 -->
    <link href="lib/bootstrap.min.css" rel="stylesheet" />
    <link href="lib/custom.css" rel="stylesheet" />
    <script src="lib/bootstrap.min.js"></script>
    <script src="lib/tablefilter.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
  </head>
  <body>
    <?php
    include_once("menu.php");
    include_once("includes/".$_GET["show"].".php");
    ?>
  </body>
</html>
<?php
}
?>
