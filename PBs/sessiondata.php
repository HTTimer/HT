<div class="container">
  <?php
  include("math.php");

  $counter=0;
  $sql="SELECT id,name FROM TimeSessions WHERE uid=$uid;";
  $result=mysqli_query($db,$sql);
  while($row=mysqli_fetch_assoc($result)){
    ++$counter;
    echo "<a href='index.php?show=PBs/sessiondata&s=$row[id]&p=$counter'>$row[name]</a>";
  }
  if(!isset($_GET["s"]))die("</div>");
  $sql="SELECT t.name,t.writable,t.type,t.active,t.scrambler,s.name AS scramblername, c.name AS event FROM TimeSessions t INNER JOIN Scrambler s ON s.id=t.scrambler INNER JOIN CubeDBTypes c ON s.category = c.id WHERE t.id=$_GET[s];";
  $result=mysqli_query($db,$sql);
  $row=mysqli_fetch_assoc($result);

  $sessionname=$row["name"];
  $flags=($row["writable"]?"Writable":"")." ".($row["active"]?"Active":"");
  $type=["System-defined session", "User-defined session"][$row["type"]];
  $scramblername=$row["event"]." ".$row["scramblername"];

  $json=json_decode(file_get_contents("Users/$username/$_GET[p].session"),true);

  $times=[];
  for($i=0;$i<count($json);++$i){
    array_push($times,$json[$i]["zeit"]);
  }

  echo "<h1>Statistics for session ".$row["name"]."</h1>";
  $ba=format(getMean($times));
  $b5=format(getBestMean($times,5));
  $b12=format(getBestMean($times,12));
  $b50=format(getBestMean($times,50));
  $b100=format(getBestMean($times,100));
  $b500=format(getBestMean($times,500));
  $b1000=format(getBestMean($times,1000));
  $sessioncnt=count($json);
  $storage=filesize("Users/$username/$_GET[p].session");
  $pbstats="<h3>Time statistics</h3><table class='table table-striped'><thead><tr><th>Format</th><th>Time</th></tr><thead><tbody>
  <tr><td>ao5</td><td>$b5</td></tr>
  <tr><td>ao12</td><td>$b12</td></tr>
  <tr><td>ao50</td><td>$b50</td></tr>
  <tr><td>ao100</td><td>$b100</td></tr>
  <tr><td>ao500</td><td>$b500</td></tr>
  <tr><td>ao1000</td><td>$b1000</td></tr>
  <tr><td>mo$sessioncnt</td><td>$ba</td></tr>
  </tbody></table>";
  $sessstats="<h3>Session statistics</h3><div class='list-group'>
    <a nohref='nohref' class='list-group-item'>
      <h4 class='list-group-item-heading'>Name</h4>
      <p class='list-group-item-text'>$sessionname</p>
    </a>
    <a nohref='nohref' class='list-group-item'>
      <h4 class='list-group-item-heading'>Number of solves</h4>
      <p class='list-group-item-text'>$sessioncnt</p>
    </a>
    <a nohref='nohref' class='list-group-item'>
      <h4 class='list-group-item-heading'>Storage used</h4>
      <p class='list-group-item-text'>$storage bytes</p>
    </a>
    <a nohref='nohref' class='list-group-item'>
      <h4 class='list-group-item-heading'>Type</h4>
      <p class='list-group-item-text'>$type</p>
    </a>
    <a nohref='nohref' class='list-group-item'>
      <h4 class='list-group-item-heading'>Scrambler</h4>
      <p class='list-group-item-text'>$scramblername</p>
    </a>
  </div>";
  $timegraph="<h3>Time graph</h3>Graph";
  $subxgraph="<h3>Sub-x graph</h3>Graph";

  $export='<h3>Human-readable export</h3><textarea class="form-control" rows="10">'.
  "-----------------------\n".
  "|    Session export   |\n".
  "|       by CMOS       |\n".
  "-----------------------\n\n"
  ."Best ao5: ".$b5."\n"
  ."Best ao12: ".$b12."\n"
  ."Best ao50: ".$b50."\n"
  ."Best ao100: ".$b100."\n"
  ."Best ao500: ".$b500."\n"
  ."Best ao1000: ".$b1000."\n\n\n";
  for($i=0;$i<count($json);++$i){
    $export.="\n".($i+1).".: ".format($json[$i]["zeit"])." ".$json[$i]["scramble"];
  }
  $export.="\n----------END----------</textarea>";
  ?>
  <div class="row">
    <div class="col-md-6"><?php echo $timegraph; ?></div>
    <div class="col-md-3"><?php echo $pbstats; ?></div>
    <div class="col-md-3"><?php echo $sessstats; ?></div>
  </div>
  <div class="row">
    <div class="col-md-6"><?php echo $subxgraph; ?></div>
    <div class="col-md-6"><?php echo $export; ?></div>
  </div>
</div>
<style>
textarea {
  font-family:courier;
}
</style>
