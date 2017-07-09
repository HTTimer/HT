<?php
//Check login
$login=isset($_COOKIE["HTTimer-login"]);
$username="";

if($login)
  $username=$_COOKIE["HTTimer-login"];
$isAdministrator=$username=="HTTimer-developer";

//If no location, set it to index
if(!isset($_GET["show"])){
  $_GET["show"]="index";

  //If logged in, set it to dashboard
  if($login)
    $_GET["show"]="dashboard";
  else
    $_GET["show"]="nologindashboard";
}

$no=["cmosoptions","userlist","../../Patterns/index","algdbstats","createcube",
"dashboard","documents_add","pbs","profileedit","requestchange","cuberequest",
"collection_read","collection_add","collection_add_","collection_toggle_defect",
"collection_delete","collection_update_defect","../../AlgTrainer/lssets"];
if(!$login&&in_array($_GET["show"],$no))
  $_GET["show"]="accessdenied";

$no=["../../Patterns/index","createcube","../../AlgTrainer/lssets"];
if(!$isAdministrator&&in_array($_GET["show"],$no))
  $_GET["show"]="accessdeniedadmin";

$no=[];

//Do not build menu if the user wants to see the timer
if($_GET["show"]=="Timer"){
  echo "redirecting you, please wait...";
  echo "<script>window.location.href='../Timer/index.php';</script>";
}else{
  //build website
?>
<!doctype html>
<html>
  <head>
    <title>CMOS - Cubing Management and Optimizing System - Version 0.0.1 Alpha</title>
    <script src="lib/jquery.min.js"></script> <!-- JQuery 3.1.1 -->
    <link href="lib/bootstrap.min.css" rel="stylesheet" />
    <link href="lib/custom.css" rel="stylesheet" />
    <link rel="stylesheet" href="lib/cubing-icons.css" />
    <link rel="stylesheet" href="lib/font.css" />
    <script src="lib/notify/bootstrap-notify.js"></script>
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
