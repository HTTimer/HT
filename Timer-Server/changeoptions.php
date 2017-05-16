<?php

$login=isset($_COOKIE["HTTimer-login"]);
if($login)
  $username=$_COOKIE["HTTimer-login"];
else
  die("false//login");
$change=$_POST["change"];
if($change=="theme"){
  echo $_POST["value"];
  $userfile=explode("\n",file_get_contents("../Users/$username/Preferences"));
  $userfile[0]="TimerTheme ".$_POST["value"];
  file_put_contents("../Users/$username/Preferences",implode("\n",$userfile));
}else if($change=="timelist"){
  echo $_POST["value"];
  file_put_contents("../Users/$username/Timersave",$_POST["value"]);
}
?>
