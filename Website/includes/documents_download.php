<?php
$id=$_GET["id"];
$a=explode("\n",file_get_contents("../../Documents/$id/information"));
header("Content-Type: text/plain");
header("Content-Disposition: attachment; filename=CubingDocument$id.".$a[4]);
$file=file_get_contents("../../Documents/$id/document");
echo $file;
?>
