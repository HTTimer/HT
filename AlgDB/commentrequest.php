<?php
$id=$_GET["id"];
if(!isset($_GET["msg"])){
?>
<script>window.location="commentrequest.php?id=<?php echo $id; ?>&msg="+prompt("Message");</script>
<?php
}else{
  file_put_contents("addrequests/$id",file_get_contents("addrequests/$id")."4,".date("Y-m-d H:i:s").",".$_GET["msg"]."\n");
}
?>
Done.
