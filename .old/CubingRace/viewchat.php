<?php
$username=$_COOKIE['HTTimer-login'];
$evt=$_GET["evt"];
echo str_replace("\n","<br/>",file_get_contents($evt."/chat"));
?>
