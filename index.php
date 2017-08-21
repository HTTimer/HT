<?php
//Check login
$login=isset($_COOKIE["HTTimer-login"]);
$username="";

if($login)
  $username=$_COOKIE["HTTimer-login"];
$isAdministrator=$username=="CMOSTimer-developer";

//If no location, set it to index
if(!isset($_GET["show"])){
  $_GET["show"]="index";

  //If logged in, set it to dashboard
  if($login)
    $_GET["show"]="dashboard";
  else
    $_GET["show"]="nologindashboard";
}

$no=["Timerconfig/cmosoptions","Timerconfig/sessions","Timerconfig/sessions_add_","Timerconfig/sessions_update_","userlist","AlgDB/algdbstats",
"dashboard","Documents/documents_add","pbs","profileedit","requestchange","CubeDB/cuberequest",
"Collection/collection_read","Collection/collection_add","Collection/collection_add_","Collection/collection_toggle_defect",
"Collection/collection_delete","Collection/collection_update_defect","AlgTrainer/lssets","CubingRace/join","CubingRace/view",
"AlgTrainer/addset","AlgTrainer/addset2","AlgTrainer/addset3","AlgTrainer/changeset","AlgTrainer/practise"];
if(!$login&&(in_array($_GET["show"],$no)||strstr($_GET["show"],"Admin")))
  $_GET["show"]="Access/accessdenied";

$no=["../../Patterns/index","createcube","../../AlgTrainer/lssets"];
if(!$isAdministrator&&(in_array($_GET["show"],$no)||strstr($_GET["show"],"Admin")))
  $_GET["show"]="Access/accessdeniedadmin";

$no=[];

//Database connection
$db=mysqli_connect("localhost","CMOSSystem","test");
mysqli_set_charset($db,"utf8");
mysqli_select_db($db,"CMOS");

if (mysqli_connect_errno()){
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$uid=1;

//Do not build menu if the user wants to see the timer
if($_GET["show"]=="Timer"){
  echo "redirecting you, please wait...";
  echo "<script>window.location.href='../Timer/index.php';</script>";
}else if($_GET["show"]=="Timer/index"){
  include_once($_GET["show"].".php");
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
    include_once($_GET["show"].".php");
    ?>
  </body>
</html>
<?php
}
mysqli_close($db);
?>
