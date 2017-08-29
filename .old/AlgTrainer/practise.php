<script>var d=[<?php
$name=$_GET["pr"];
$username=$_COOKIE["HTTimer-login"];
$algs=explode("\n",file_get_contents("../Users/$username/AlgTrainer/$name/1"));
for($i=0;$i<count($algs);++$i){
  $algs[$i]='"'.$algs[$i].'"';
}
echo implode(",",$algs);
?>];</script>
