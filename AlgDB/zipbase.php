<?php
$cleanedup="";
$algorithms=explode(",",file_get_contents("../AlgDB/data/algsets"));
for($i=0;$i<count($algorithms);++$i){
  if($algorithms[$i][0]=="!"){
    $algorithms[$i][0]="#";
    $algorithms[$i]="Group ".$algorithms[$i];
  }
  $cleanedup.=$algorithms[$i]."\n";
}

header("Content-Type: text/plain");
header("Content-Disposition: attachment; filename=Algsetlist");

echo $cleanedup;
?>
