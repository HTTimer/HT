<div class="container">
  <h1>Goals</h1>
<?php
include("PBs/math.php");

$counter=0;
$sql="SELECT id,name FROM TimeSessions WHERE uid=$uid;";
$result=mysqli_query($db,$sql);
while($row=mysqli_fetch_assoc($result)){
  ++$counter;
  displayGoals($row["id"],$counter,$row["name"]);
}

echo "<br/>";

function formatFormat($format){
  return substr($format,1)==1?"single":$format[0]."o".substr($format,1);
}

$times=[];

function displayGoals($id,$counter,$sessionname){
  global $db;
  global $times;
  global $username;

  $json=json_decode(file_get_contents("Users/$username/$counter.session"),true);

  $times=[];
  for($i=0;$i<count($json);++$i){
    array_push($times,$json[$i]["zeit"]);
  }

  $sql="SELECT format,zeit,reached FROM CMOS.goals WHERE uid=$id ORDER BY reached ASC,zeit DESC;";
  $result=mysqli_query($db,$sql);
  if(mysqli_num_rows($result)>0){
    echo "<h2>$sessionname <a role='btn' class='btn btn-success' href='index.php?show=Goals/add&id=$id'>Add</a></h2><div class='row'>";
    while($row=mysqli_fetch_assoc($result)){
      $goalzeit=format($row["zeit"]);
      $currentzeit=format(getBestAverage($json,substr($row["format"],1)));
      $format=formatFormat($row["format"]);
      $ratio=$currentzeit>0?($goalzeit/$currentzeit):0;
      $percentage=round($ratio*100,2)."%";
      $done=$currentzeit<=$goalzeit?" (done)":"";

      echo "<div class='col-md-3'>
        <div class='row' style='border:1px solid black;margin-right:-2px;'>
          <div class='row-md-12' style='font-size:30px;'>$format$done</div>
          <div class='row-md-12' style='font-size:20px;'><b>$goalzeit</b> / $currentzeit </div>
          <div class='row-md-12'><progress value='$ratio' max='1' title='$percentage'></progress></div>
        </div>
      </div>";
    }

    echo "</div>";
  }else{
    echo "<h3>$sessionname <a role='btn' class='btn btn-success' href='index.php?show=Goals/add&id=$id'>Add</a></h3>";
  }
}
?>
</div>
