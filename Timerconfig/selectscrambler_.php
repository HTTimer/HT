<?php
print_r($_POST);
$sql="UPDATE TimeSessions SET scrambler=".$_POST["scrambler"]." WHERE id=".$_POST["id"].";";
echo $sql;
$result=mysqli_query($db,$sql);
?>
<script>window.location.href="index.php?show=Timerconfig/sessions";</script>
