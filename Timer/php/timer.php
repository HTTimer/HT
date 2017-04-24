<?php
// Check for login
if(!isset($_COOKIE['HTTimer-login']))
  die("You must be logged in!");

$username=$_COOKIE['HTTimer-login'];

// Read preference file
$preference_file="../Users/$username/Preferences";
$preferences=file_get_contents($preference_file);

// Define preferenes and defaults
$timerTheme=0;

// Get significant key-value pairs
$preferences=explode("\n",$preferences);
for($i=0;$i<count($preferences);++$i){
  if(explode(" ",$preferences[$i])[0]=="TimerTheme")
    $timerTheme=explode(" ",$preferences[$i])[1];
}
?>
