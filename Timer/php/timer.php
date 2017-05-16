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

// Read Collection file
$collection_file="../Users/$username/Collection";
$collection=file_get_contents($collection_file);
$collection=explode("\n",$collection);
for($i=0;$i<count($collection);++$i)
  $collection[$i]=explode(",",$collection[$i]);

// Build Collection JSON
$collectionString=[];
for($i=0;$i<count($collection)-1;++$i)
  if($collection[$i][1]==0)
    $collectionString[$i]='{"company":"'.$collection[$i][3].'","model":"'.$collection[$i][4].'","color":"'.$collection[$i][5].'","identifier":"0040020A"}';
$collectionString=implode(",",$collectionString);

// Get TimeListData
$timeListData_file="../Users/$username/Timersave";
$timeListData=file_get_contents($timeListData_file);
?>
