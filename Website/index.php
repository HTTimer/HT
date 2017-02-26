<?php
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
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"/>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
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
