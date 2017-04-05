<?php
$set=$_GET["set"];
$case=$_GET["case"];
$username=$_COOKIE["HTTimer-login"];
$data=explode(",",str_replace("]","",str_replace("[","",$_GET["data"])));
for($i=0;$i<count($data);++$i){
  $data[$i]=str_replace('"',"",$data[$i]);
  $r=rand();
  touch("addrequests/".$r);
  file_put_contents("addrequests/".$r,$data[$i]."\n$set/$case\n0,".date("Y-m-d H:i:s"));
  file_put_contents("../Users/$username/Algsets",file_get_contents("../Users/$username/Algsets").",".$r);
}
?>
A Administrator is notified of your algorithm request and will check it soon.
