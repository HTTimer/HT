<?php
$format=$_POST["formatam"].$_POST["formatsolves"];
$time=$_POST["time"];
$id=$_GET["id"];
$sql="INSERT INTO goals (uid,format,zeit,reached) VALUES ($id,'$format',$time,0);";
mysqli_query($db,$sql);
?>
<script>window.location.href="index.php?show=Goals/readgoal";</script>
