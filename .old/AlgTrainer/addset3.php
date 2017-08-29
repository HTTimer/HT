<?php
$name=$_GET["set"];
$algs=explode(",",explode("}",explode("{",$_GET["res"])[1])[0]);
$a="";
$username=$_COOKIE["HTTimer-login"];

for($i=0;$i<count($algs);++$i){
  $pa=explode(":",$algs[$i]);
  $tmp=explode("\n",file_get_contents("../AlgDB/data/$name/".str_replace('"',"",$pa[0])."/algorithms"));
  $a.=$tmp[$pa[1]]."\n";
}
if(!is_dir("../Users/$username/AlgTrainer"))
  mkdir("../Users/$username/AlgTrainer");
if(!is_dir("../Users/$username/AlgTrainer/$name"))
  mkdir("../Users/$username/AlgTrainer/$name");
touch("../Users/$username/AlgTrainer/$name/1");
file_put_contents("../Users/$username/AlgTrainer/$name/1", $a);
echo $a;
?>
