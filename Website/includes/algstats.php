<div class="container">
  <h1>
<?php
$set=$_GET["set"];
$case=$_GET["case"];
$nr=$_GET["nr"];
$alg=explode("\n",file_get_contents("../AlgDB/data/$set/$case/algorithms"))[$nr-1];
echo "$set/$case/$nr</h1>";
echo "Algorithm: ".explode(",",$alg)[0];
$alg=explode(",",$alg)[0];
$lgth=count(explode(" ",$alg))+count(explode("M",$alg))+count(explode("E",$alg))+count(explode("S",$alg))-count(explode("x",$alg))-count(explode("y",$alg))-count(explode("z",$alg));
$elgth=count(explode(" ",$alg))+count(explode("M",$alg))+count(explode("E",$alg))+count(explode("S",$alg))-3;
$qlgth=$lgth+count(explode("2",$alg))-1;
echo "<br/>Length: $lgth HTM, $elgth ETM, $qlgth QTM<br/>Memorization help: ";
$trigger=str_replace("R U R' U'","(sexy)",$alg);
$trigger=str_replace("U R U' R'","(reverse sexy)",$trigger);
$trigger=str_replace("R' F R F'","(sledge)",$trigger);
$trigger=str_replace("F R' F' R","(reverse sledge)",$trigger);

function toDegrees($alg,$move){
  $cnt=substr_count($alg,$move." ")+substr_count($alg,$move."2")+substr_count($alg,$move."2")-substr_count($alg,$move."'");
  return ($cnt%4*90)."° ($cnt moves)";
}

echo $trigger."<br/>Center orientation:<pre>";
echo   "R: ".toDegrees($alg,"R");
echo "\nU: ".toDegrees($alg,"U");
echo "\nF: ".toDegrees($alg,"F");
echo "\nD: ".toDegrees($alg,"D");
echo "\nB: ".toDegrees($alg,"B");
echo "\nL: ".toDegrees($alg,"L");
?>
</pre>
</div>
