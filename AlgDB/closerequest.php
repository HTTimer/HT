<?php
$close=isset($_GET['yes']);
$id=$_GET["id"];
if($close){
  file_put_contents("addrequests/$id",file_get_contents("addrequests/$id")."3,".date("Y-m-d H:i:s")."\n");
  $data=file_get_contents("../AlgDB/addrequests/$id");
  $data=explode("\n",$data);
  $algorithm=$data[0];
  $case=explode("/",$data[1]);
  $set=$case[0];
  $case=$case[1];
  file_put_contents("data/$set/$case/algorithms",file_get_contents("data/$set/$case/algorithms").$algorithm.",0,0,0\n");
}else
  file_put_contents("addrequests/$id",file_get_contents("addrequests/$id")."2,".date("Y-m-d H:i:s")."\n");
?>Done.
