<script src="lib/tablesorter.js"></script>
<link rel="stylesheet" type="text/css" href="lib/tablesorter2.css" />
<div class="container">
  <h1>PBs</h1>
  <span class="cubing-icon event-222"   onclick="search('2x2x2');"   ></span>
  <span class="cubing-icon event-333"   onclick="search('3x3x3');"   ></span>
  <span class="cubing-icon event-444"   onclick="search('4x4x4');"   ></span>
  <span class="cubing-icon event-555"   onclick="search('5x5x5');"   ></span>
  <span class="cubing-icon event-666"   onclick="search('6x6x6');"   ></span>
  <span class="cubing-icon event-777"   onclick="search('7x7x7');"   ></span>
  <span class="cubing-icon event-minx"  onclick="search('Megaminx');"></span>
  <span class="cubing-icon event-pyram" onclick="search('Pyraminx');"></span>
  <span class="cubing-icon event-skewb" onclick="search('Skewb');"   ></span>
  <span class="cubing-icon event-sq1"   onclick="search('Square-1');"></span>
  <span onclick="search('')">–</span><br/>
  <span onclick="search('mo1/single');">Single</span>
  <span onclick="search('mo3');">mo3</span>
  <span onclick="search('mo5');">mo5</span>
  <span onclick="search('mo12');">mo12</span>
  <span onclick="search('mo50');">mo50</span>
  <span onclick="search('mo100');">mo100</span>
  <span onclick="search('mo1000');">mo1000</span>
  <span onclick="search('');">–</span>
  <table class="table table-condensed table-striped table-hover">
    <thead><tr><th>Session</th><th>format</th><th>Result</th><th>Result details</th><th>Date</th><th>Inspection</th><th>Details</th></tr></thead>
    <tbody>
<?php

include ("math.php");


$counter=0;
$sql="SELECT id,name FROM TimeSessions WHERE uid=$uid;";
$result=mysqli_query($db,$sql);
while($row=mysqli_fetch_assoc($result)){
  ++$counter;
  displayGoals($row["id"],$counter,$row["name"]);
}




echo "<br/>";

function pb($sessionname,$format,$i,$json){
  global $times;
  $jsoni=$json[$i];
  if($format==1){
    echo "<tr><td>".$sessionname."</td><td>".
    "mo1/single"."</td><td>".
    format($jsoni["zeit"])."</td><td>".
    format($jsoni["zeit"])."</td><td>".
    date("Y-m-d H:i:s",floor($jsoni["endTime"]/1000))."</td><td>".
    format($jsoni["currentInspection"])."</td><td>".
    "View details"."</td></tr>";
  }else{
    echo "<tr><td>".$sessionname."</td><td>".
    "mo".$format."</td><td>".
    format(getAverage($json,$i-$format,$format))."</td><td>";
    $timeList="";
    $fc="";
    if($format>60){$format=60;$fc="<b>...</b>";};
    $counter=0;
    for($j=$i-$format;$j<$i;++$j){
      ++$counter;
      $timeList.=format($json[$j]["zeit"]).", ";
      if($counter%12==0)$timeList.="<br/>";
    }
    echo $timeList.$fc."</td><td>".date("Y-m-d H:i:s",floor($jsoni["endTime"]/1000)).
    "</td><td></td><td>View details</td></tr>";
  }
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

  $best=0xFFFFFFFF;
  $best3=0xFFFFFFFF;
  $best5=0xFFFFFFFF;
  $best12=0xFFFFFFFF;
  $best50=0xFFFFFFFF;
  $best100=0xFFFFFFFF;
  $best1000=0xFFFFFFFF;

  for($i=0;$i<count($json);++$i){
    if($times[$i]<$best){
      $best=$times[$i];
      pb($sessionname,1,$i,$json);
    }
    if($i>2&&getAverage($json,$i-3,3)<$best3){
      $best3=getAverage($json,$i-3,3);
      pb($sessionname,3,$i,$json);
    }
    if($i>4&&getAverage($json,$i-5,5)<$best5){
      $best5=getAverage($json,$i-5,5);
      pb($sessionname,5,$i,$json);
    }
    if($i>11&&getAverage($json,$i-12,12)<$best12){
      $best12=getAverage($json,$i-12,12);
      pb($sessionname,12,$i,$json);
    }
    if($i>49&&getAverage($json,$i-50,50)<$best50){
      $best50=getAverage($json,$i-50,50);
      pb($sessionname,50,$i,$json);
    }
    if($i>99&&getAverage($json,$i-100,100)<$best100){
      $best100=getAverage($json,$i-100,100);
      pb($sessionname,100,$i,$json);
    }
    if($i>999&&getAverage($json,$i-1000,1000)<$best1000){
      $best1000=getAverage($json,$i-1000,1000);
      pb($sessionname,1000,$i,$json);
    }
  }
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
