<?php
print_r($_POST);
$cube=$_POST["cube"];
$color=$_POST["color"];

$sql="INSERT INTO Collection (cid,defective,color,uid) VALUES ($cube,0,$color,$uid);";
mysqli_query($db,$sql);
echo mysqli_error();
?>
<div class="container">
  The cube was added to your <a href="index.php?show=Collection/collection_read">collection</a>.
  <script>//window.location.href="index.php?show=Collection/collection_read";</script>
</div>
