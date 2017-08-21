<?php
$username=$_COOKIE['HTTimer-login'];
$evt=$_GET["evt"];
$msg=$_GET["msg"];
file_put_contents($evt."/chat",file_get_contents($evt."/chat")."\n".$username.": ".$msg);
echo str_replace("\n","<br/>",file_get_contents($evt."/chat"));
?>
