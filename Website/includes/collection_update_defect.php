<div class="container">
<?php
if(!$login)die("Login</div>");

$nr=$_GET["nr"];

$collection=explode("\n",file_get_contents("../Users/$username/Collection"));
$tmp=explode(",",$collection[$nr]);
echo '<div class="alert alert-danger" role="alert">Your cube '.$tmp[3]." ".$tmp[4]." (color: ".$tmp[5].") was marked as defective.</div>";
$tmp[6]=1;
$collection[$nr]=implode(",",$tmp);
$collection=implode("\n",$collection);
file_put_contents("../Users/$username/Collection",$collection);
?>
</div>