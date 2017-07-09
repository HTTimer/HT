<div class="container">
  <h1>
<?php
$set=$_GET["set"];
$case=$_GET["case"];
$nr=$_GET["nr"];
$alg=explode("\n",file_get_contents("../AlgDB/data/$set/$case/algorithms"))[$nr-1];
echo "$set/$case/$nr</h1>";
?>
<div class="list-group">
  <a nohref="nohref" class="list-group-item">
    <h4 class="list-group-item-heading">Algorithm</h4>
    <p class="list-group-item-text"><?php echo explode(",",$alg)[0]; ?></p>
  </a>
  <a nohref="nohref" class="list-group-item">
    <h4 class="list-group-item-heading">Length</h4><p>
<?php
$alg=explode(",",$alg)[0];
$lgth=count(explode(" ",$alg))+count(explode("M",$alg))+count(explode("E",$alg))+count(explode("S",$alg))-count(explode("x",$alg))-count(explode("y",$alg))-count(explode("z",$alg));
$elgth=count(explode(" ",$alg))+count(explode("M",$alg))+count(explode("E",$alg))+count(explode("S",$alg))-3;
$qlgth=$lgth+count(explode("2",$alg))-1;
echo "$lgth HTM<br/>$elgth ETM<br/>$qlgth QTM</p></a>";
$trigger=str_replace("R U R' U'","(sexy)",$alg);
$trigger=str_replace("U R U' R'","(reverse sexy)",$trigger);
$trigger=str_replace("R' F R F'","(sledge)",$trigger);
$trigger=str_replace("F R' F' R","(reverse sledge)",$trigger);

function toDegrees($alg,$move){
  $cnt=substr_count($alg,$move." ")+substr_count($alg,$move."2")+substr_count($alg,$move."2")-substr_count($alg,$move."'");
  $s=$cnt!=1?"s":"";
  return ($cnt%4*90)."° ($cnt move$s)";
}

echo '<a nohref="nohref" class="list-group-item">
  <h4 class="list-group-item-heading">Simplified Algorithm</h4>
  <p class="list-group-item-text">'.$trigger.'</p></a><a nohref="nohref" class="list-group-item">
  <h4 class="list-group-item-heading">Center orientation</h4>
  <p class="list-group-item-text">';
echo   "R: ".toDegrees($alg,"R");
echo "<br/>U: ".toDegrees($alg,"U");
echo "<br/>F: ".toDegrees($alg,"F");
echo "<br/>D: ".toDegrees($alg,"D");
echo "<br/>B: ".toDegrees($alg,"B");
echo "<br/>L: ".toDegrees($alg,"L");
?>
</p>
</a>
</div>
</div>
