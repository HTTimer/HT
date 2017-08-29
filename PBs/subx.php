<script src="lib/tablesorter.js"></script>
<link rel="stylesheet" type="text/css" href="lib/tablesorter2.css" />
<div class="container">
<?php
function getMean($times,$start=0,$size=NULL){
  $sum=0;
  if($size==NULL)$size=count($times)-1;
  else $size+=$start;

  for($i=$start+1;$i<$size+1;++$i){
    if($times[$i]>0)
      $sum+=$times[$i];
    else
      return -1;
  }
  return $sum/($size-$start);
}

function getBestMean($times,$x){
  if($x>count($times)) return -1;
  $best=0xFFFFFFFF;
  for($i=0;$i<count($times)-$x;++$i)
    if(getMean($times,$i,$x)<$best)
      $best=getMean($times,$i,$x);
  return $best;
}

function format($time){
  if($time<0)return "DNF";

  $time=round($time);
  $bits=$time%1000;
  $time=($time-$bits)/1000;
  $secs=$time%60;
  $mins=(($time-$secs)/60)%60;
  $hours=($time-$secs-60*$mins)/3600;
  $s="".$bits;

  if($bits<10)$s="0".$s;
  if($bits<100)$s="0".$s;
  $s=$secs.".".$s;


  //Fill 0s and append minutes if neccessary
  if ($secs < 10 && ($mins > 0 || $hours > 0)) $s = "0" . $s;
  if ($mins > 0 || $hours > 0) $s = $mins . ":" . $s;
  if ($mins < 20 && $hours > 0) $s = "0" . $s;
  if ($hours > 0) $s = $hours + ":" . $s;
  return $s;
}


$x=0;
if(isset($_GET["x"])){
  global $x;
  $x=$_GET["x"];
  ?>
<h1>sub <?php echo format($x); ?></h1>
<a href="index.php?show=PBs/subx&x=<?php echo $x; ?><?php echo isset($_GET["opt"])?"":"&opt"; ?>"><?php echo isset($_GET["opt"])?"show":"hide"; ?> 0</a>
<table class="table table-condensed table-hover table-striped">
  <thead>
    <tr><th>Session</th><th>number of sub-x</th><th>solves in session</th><th>Percentage of solves</th></tr>
  </thead>
  <tbody>
<?php
  $counter=0;
  $sql="SELECT id,name FROM TimeSessions WHERE uid=$uid;";
  $result=mysqli_query($db,$sql);
  while($row=mysqli_fetch_assoc($result)){
    ++$counter;
    displayGoals($row["id"],$counter,$row["name"],isset($_GET["opt"]));
  }
}else{
  ?>
<h1>Get sub-x solves</h1>
<form action="index.php" method="GET">
  <input name="x" placeholder="x [ms]" type="text" class="form-control"/>
  <input type="submit" class="form-control" value="Get"/>
  <input type="hidden" name="show" value="PBs/subx"/>
</form>
  <?php
}

echo "<br/>";

$times=[];

function displayGoals($id,$counter,$sessionname,$opthideifzero){
  global $db;
  global $times;
  global $username;
  global $x;

  $json=json_decode(file_get_contents("Users/$username/$counter.session"),true);

  $times=[];
  for($i=0;$i<count($json);++$i){
    array_push($times,$json[$i]["zeit"]);
  }

  $n=0;
  $solves=count($json);

  for($i=0;$i<$solves;++$i){
    if($times[$i]<$x)++$n;
  }

  $ratio=round($solves>0?$n/$solves:0,4)*100;

  if(!$opthideifzero||$n!=0)echo "<tr><td>$sessionname</td><td>$n</td><td>$solves</td><td>$ratio%</td></tr>";
}
?>
</tbody>
</table>
</div>
<script>
$(document).ready(function(){
  $("table").tablesorter({sortList: [[0,0], [1,0], [2,0]], theme:"blue"});
  $("table").filterTable({label:"",filterExpression:'filterTableFindAll'});
});
function search(what){
  $('.filter-table input').val(what).focus().trigger('click');
}
</script>
