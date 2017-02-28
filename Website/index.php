<?php
//Check login
$login=isset($_COOKIE["HTTimer-login"]);

//If no location, set it to index
if(!isset($_GET["show"])){
  $_GET["show"]="index";
}

//Do not build menu if the user wants to see the timer
if($_GET["show"]=="Timer"){
  echo "redirecting you, please wait...";
  echo "<script>window.location.href='../Timer/index.htm';</script>";
}else{
  //build website
?>
<!doctype html>
<html>
  <head>
    <title>HTWebsite</title>
    <script src="lib/jquery.min.js"></script> <!-- JQuery 3.1.1 -->
    <link href="lib/bootstrap.min.css" rel="stylesheet" />
    <script src="lib/bootstrap.min.js"></script>
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
