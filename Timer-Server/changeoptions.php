<?php

$login=isset($_COOKIE["HTTimer-login"]);
if($login)
  $username=$_COOKIE["HTTimer-login"];
else
  die("false//login");
$change=$_GET["change"];
if($change!="theme")echo "false";
echo $_GET["value"];
$userfile=explode("\n",file_get_contents("../Users/$username/Preferences"));
$userfile[0]="TimerTheme ".$_GET["value"];
file_put_contents("../Users/$username/Preferences",implode("\n",$userfile));
?>
