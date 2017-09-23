<div class="container"><?php
$case=$_GET["alg"];
$alg=$_POST["alg"];
$check=$_POST["check"];
if(!$check)echo "You must agree!";
$sql='INSERT INTO AlgDbAlg(cid,alg) VALUES ('.$case.',"'.$alg.'");';
$result=mysqli_query($db,$sql);
echo mysqli_error($db);
?>Done.</div>
