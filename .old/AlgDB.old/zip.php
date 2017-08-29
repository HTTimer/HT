<?php
$username=$_COOKIE["HTTimer-login"];

$set=$_GET["set"];
$case=$_GET["alg"];
$cleanedup="";
$algorithms=explode("\n",file_get_contents("../AlgDB/data/$set/$case/algorithms"));
for($i=0;$i<count($algorithms);++$i)
  $cleanedup.=explode(",",$algorithms[$i])[0]."\n";

file_put_contents("../Users/$username/Tmp",$cleanedup);


header("Content-Type: text/plain");
header("Content-Disposition: attachment; filename=Algorithms$set");

echo $cleanedup;
?>
