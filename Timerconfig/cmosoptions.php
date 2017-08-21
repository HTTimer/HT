<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

// Read preference file
/*$preference_file="Users/$username/Preferences";
$preferences=file_get_contents($preference_file);

// Get significant key-value pairs
$timeStatistics=";";
$denotePB=0;
$preferences=explode("\n",$preferences);
for($i=0;$i<count($preferences)-1;++$i){
  if(explode(" ",$preferences[$i])[0]=="TimeStatistics")
    $timeStatistics=explode(" ",$preferences[$i])[1];
  else if(explode(" ",$preferences[$i])[0]=="TimeStatsPb")
    $denotePB=explode(" ",$preferences[$i])[1];
  $prefs.='"'.explode(" ",$preferences[$i])[0].'":"'.explode(" ",$preferences[$i])[1].'"';
  if($i<count($preferences)-1-1)$prefs.=",";
}*/
$denotePB=0;

$sql="SELECT ky,value FROM Configuration WHERE uid=$uid;";
$result=mysqli_query($db,$sql);
while($row=mysqli_fetch_assoc($result)){
  if($row["ky"]=="TimeStatistics")$timeStatistics=$row["value"];
  else if($row["ky"]="TimeStatsPb")$denotePB=$row["value"];
}
?>
<script>
//start={<?php echo 0;//$prefs; ?>};
function setTheme(id){
  json("Timer-Server/changeoptions.php", function(t) {
    console.log("Loaded theme: " + t.response);
    $.notify({
    	message: 'The colors were updated.'
    },{
    	type: 'success',
      delay: 3000
    });
  }, "change=theme&value=" + id);
}

//TimeStatistics single,mo3,ao5,ao12,ao50,ao100,ao1000,ao10000;single,mo3,ao5,ao12,ao50,ao100,ao1000;single,mo3,ao5,mo12;single,mo3,mo12;single,mo3,mo5,mo10,mo12,mo50,mo100;single,ao5,ao12,ao50

function json(url, callback, params) {
  var jsonFile = new XMLHttpRequest();
  jsonFile.open("POST", url, true);
  // Source of the next 3 lines: openjs.com/articles/ajax_xmlhttp_using_post.php
  jsonFile.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  jsonFile.setRequestHeader("Content-length", params.length);
  jsonFile.setRequestHeader("Connection", "close");
  jsonFile.send(params);
  jsonFile.onload = function() {
    callback(jsonFile)
  };
}
</script>
<div class="container">
  <h1>CMOSTimer configuration</h1>
  <h2>Color</h2>
  <div class="btn-group">
    <button onclick='setTheme(0)' class="btn btn-default">white 1</button>
    <button onclick='setTheme(1)' class="btn btn-warning">yellow 1</button>
    <button onclick='setTheme(2)' class="btn btn-warning">orange 1</button>
    <button onclick='setTheme(8)' class="btn btn-danger">red 1</button>
    <button onclick='setTheme(10)' class="btn btn-info">pink 1</button>
    <button onclick='setTheme(3)' class="btn btn-success">green 1</button>
    <button onclick='setTheme(6)' class="btn btn-primary">blue 1</button>
    <button onclick='setTheme(4)' class="btn btn-primary">blue 2</button>
    <button onclick='setTheme(9)' class="btn btn-info">purple 1</button>
    <button onclick='setTheme(7)' class="btn btn-default">cstimer 1</button>
    <br/>
    <button onclick='setTheme(21)' class="btn btn-default">white 2</button>
    <button onclick='setTheme(11)' class="btn btn-warning">yellow 2</button>
    <button onclick='setTheme(12)' class="btn btn-warning">orange 2</button>
    <button onclick='setTheme(18)' class="btn btn-danger">red 2</button>
    <button onclick='setTheme(20)' class="btn btn-info">pink 2</button>
    <button onclick='setTheme(13)' class="btn btn-success">green 2</button>
    <button onclick='setTheme(16)' class="btn btn-primary">blue 3</button>
    <button onclick='setTheme(14)' class="btn btn-primary">blue 4</button>
    <button onclick='setTheme(19)' class="btn btn-info">purple 2</button>
    <button onclick='setTheme(17)' class="btn btn-default">cstimer 2</button>

  </div>
  <h2>Statistics</h2>
  <h3>Time statistics</h3>
  <!-- Generate current and best average/mean of x based on event type. -->
  <form class="form-inline" autocomplete="off">
    <div class="row" onclick="timestatistics_all()">
      <?php
      $timeStatistics=explode(";",$timeStatistics);
      $items=["single","mo3","ao5","mo5","mo10","ao12","mo12","ao50","mo50","ao100","mo100","ao500","ao1000","ao10000","ao100000","session average"];
      for($i=0;$i<6;++$i){
        $timeStatistics[$i]=explode(",",$timeStatistics[$i]);
        echo '<div class="col-md-2">
          <h4>'.["2H","OH","OH BLD","BLD","FMC","FT"][$i].'</h4>
          <select class="form-control" multiple="multiple" size="'.count($items).'">';
          for($j=0;$j<count($items);++$j)
            echo "<option".(in_array($items[$j],$timeStatistics[$i])?" selected='selected'":"").">".$items[$j]."</option>";
          echo '</select>
        </div>';
      }
      ?>
    </div>

    <br/>
  Denote PBs by <select class="form-control">
    <option onclick="denotePB(0);" <?php if($denotePB==0)echo "selected='selected'"; ?>>nothing</option>
    <option onclick="denotePB(1);" <?php if($denotePB==1)echo "selected='selected'"; ?>>appending "PB" to the time</option>
    <option onclick="denotePB(2);" <?php if($denotePB==2)echo "selected='selected'"; ?>>emphasizing format and time</option>
    <option onclick="denotePB(3);" <?php if($denotePB==3)echo "selected='selected'"; ?>>appending "PB" to the time and emphasizing format and time</option>
    <option onclick="denotePB(4);" <?php if($denotePB==4)echo "selected='selected'"; ?>>emphasizing the time</option>
    <option onclick="denotePB(5);" <?php if($denotePB==5)echo "selected='selected'"; ?>>appending "PB" to the time and emphasizing the time</option>
  </select>.

  </form>
</div>
<script>
function timestatistics(id){
  var el=document.getElementsByTagName("select")[id].selectedOptions;
  for(var i=0;i<el.length;++i){
    console.log(el[i].innerHTML);
    globaltimestatisticssave[id].push(el[i].innerHTML);
  }
  globaltimestatisticssave[id]=globaltimestatisticssave[id].join(",");
}

var globaltimestatisticssave;
function timestatistics_all(){
  globaltimestatisticssave=[[],[],[],[],[],[]];
  timestatistics(0);
  timestatistics(1);
  timestatistics(2);
  timestatistics(3);
  timestatistics(4);
  timestatistics(5);
  globaltimestatisticssave=globaltimestatisticssave.join(";");
  json("Timer-Server/changeoptions.php", function(t) {
    $.notify({
    	message: 'The time statistics were updated.'
    },{
    	type: 'success',
      delay: 3000
    });
  }, "change=timestatistics&value=" + globaltimestatisticssave);
}

function denotePB(id){
  json("Timer-Server/changeoptions.php", function(t) {
    console.log("Response on timestats: " + t.response);
    $.notify({
    	message: 'The pb denotation preference was updated.'
    },{
    	type: 'success',
      delay: 3000
    });
  }, "change=timestatspb&value=" + id);
}
</script>
