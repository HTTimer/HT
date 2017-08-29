<?php
//Database connection
$db=mysqli_connect("localhost","CMOSSystem","test") or die ("Database connection failed!");
mysqli_set_charset($db,"utf8");
mysqli_select_db($db,"CMOS");

//Check login
$uid=0;
$login=isset($_COOKIE["HTTimer-login"]);
$username="";
$uid=$login?$_COOKIE["HTTimer-login"]:0;

$sql="SELECT uname FROM Users WHERE id=$uid;";

if($login)
  $username=mysqli_fetch_assoc(mysqli_query($db,$sql))["uname"];
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
"AlgTrainer/addset","AlgTrainer/addset2","AlgTrainer/addset3","AlgTrainer/changeset","AlgTrainer/practise","Timer/index"];
if(!$login&&(in_array($_GET["show"],$no)||strstr($_GET["show"],"Admin")))
  $_GET["show"]="Access/accessdenied";

$no=["../../Patterns/index","createcube","../../AlgTrainer/lssets"];
if(!$isAdministrator&&(in_array($_GET["show"],$no)||strstr($_GET["show"],"Admin")))
  $_GET["show"]="Access/accessdeniedadmin";

$no=[];
$version="1.0.0";

if (mysqli_connect_errno()){
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

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
    <title>CMOS - Cubing Management and Optimizing System - V<?php echo $version; ?></title>
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
    if(!strstr("Login/loginTimer-Server/registerTimer-Server/doregister",$_GET["show"]))
      include_once("menu.php");
    include_once($_GET["show"].".php");
    ?>
  </body>
</html>
<?php
}
mysqli_close($db);
?>
