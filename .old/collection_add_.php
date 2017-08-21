<?php
$c=$_GET["c"];
$m=$_GET["m"];
$d=$_GET["d"];
$r=rand();

$handle=fopen("../Users/$username/Collection","a");
fwrite($handle,"$r,0,3x3,$c,$m,$d,0\n");
fclose($handle);
?>
<div class="container">
  The cube was added to your <a href="index.php?show=collection_read">collection</a>.
  <script>window.location.href="index.php?show=collection_read";</script>
</div>
