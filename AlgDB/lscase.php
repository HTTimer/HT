<script src="lib/tablesorter.js"></script>
<link rel="stylesheet" type="text/css" href="lib/tablesorter2.css" />

<?php
$set=$_GET["set"];
$case=$_GET["alg"];
$counter=0;

$sql = "SELECT name FROM AlgDbSets WHERE id=$set;";
$result=mysqli_query($db,$sql);
$row = mysqli_fetch_assoc($result);
$setname=$row["name"];

$sql = "SELECT name FROM AlgDbCases WHERE id=$case;";
$result=mysqli_query($db,$sql);
$row = mysqli_fetch_assoc($result);
$algname=$row["name"];

function addAlg($alg){
  global $counter;
  global $set;
  global $case;
  $counter++;

  $likes=$dislikes=$iusethis=0;
  $lgth=count(explode(" ",$alg))+count(explode("M",$alg))+count(explode("E",$alg))+count(explode("S",$alg))-count(explode("x",$alg))-count(explode("y",$alg))-count(explode("z",$alg));
  $elgth=count(explode(" ",$alg))+count(explode("M",$alg))+count(explode("E",$alg))+count(explode("S",$alg))-3;
  $qlgth=$lgth+count(explode("2",$alg))-1;
  echo ",[$counter,$likes,$dislikes,$iusethis,\"$alg\",$lgth,$qlgth,$elgth]";
}
?>
<div class="container">
  <h1><?php echo "$setname/$algname"; ?></h1>
  <div>
    Rotation: <div class="btn-group" role="group" id="rotationbuttons">
      <button type="button" class="btn btn-default btn-sm active" onclick="switchRotation(0);">none</button>
      <button type="button" class="btn btn-default btn-sm" onclick="switchRotation(1);">y</button>
      <button type="button" class="btn btn-default btn-sm" onclick="switchRotation(2);">y2</button>
      <button type="button" class="btn btn-default btn-sm" onclick="switchRotation(3);">y'</button>
    </div>
    <table class="table table-condensed table-hover table-striped">
      <thead>
        <tr><th>ID</th><!--<th>Likes</th><th>Dislikes</th><th>People that use this alg</th>--><th>Algorithm</th><th>HTM</th><th>QTM</th><th>ETM</th><th>Error</th></tr>
      </thead>
      <tbody id="tbody"></tbody>
    </table>
    <?php if($login){ ?><button class="btn btn-success" onclick="window.location.href='index.php?show=AlgDB/downloadalg&set=<?php echo $set; ?>&alg=<?php echo $case; ?>';">Download Algorithms</button><?php } ?>
    <a href="index.php?show=AlgDB/addalg&set=<?php echo $set; ?>&alg=<?php echo $case; ?>" role="button" class="btn btn-success">Add algorithms</a><br/><br/>
  </div>
</div>

<script>
// Get data
var data=[
<?php
$sql = "SELECT * FROM AlgDbAlg WHERE cid=$case;";
$result=mysqli_query($db,$sql);
while($row = mysqli_fetch_assoc($result)){
  addAlg($row["alg"]);
}
?>];

// Set document ready actions
$(document).ready(function(){
  display();
  $("table").tablesorter({sortList: [[3,0], [0,0]],theme:"blue"});
  $("table").filterTable();
});

/*
 * Rotation
 */
// https://medium.freecodecamp.com/the-programming-language-pipeline-91d3f449c919
// http://imgur.com/a/Gwu73#0
var currentRotation=0;
function switchRotation(to){
  document.getElementById("rotationbuttons").children[0].classList.remove("active");
  document.getElementById("rotationbuttons").children[1].classList.remove("active");
  document.getElementById("rotationbuttons").children[2].classList.remove("active");
  document.getElementById("rotationbuttons").children[3].classList.remove("active");
  document.getElementById("rotationbuttons").children[currentRotation=to].classList.add("active");
  display();
}
function showAdd(){
  document.getElementById("add").style.display="block";
  addInput();
  window.scrollBy(0,100);
}

/*
 * Display
 */
function display(){
  var html="",i;
  for(i=1;i<data.length;++i){
    html+="<tr><td>"
    +data[i][0]+"</td><td>"
    /*+"<a href='index.php?show=algdb_togglelike&set=<?php echo $set; ?>&case=<?php echo $case; ?>&nr="
    +data[i][0]+"' class='btn btn-xs btn-flat'>"+
    +data[i][1]+"</a></td><td><a href='index.php?show=algdb_toggledislike&set=<?php echo $set; ?>&case=<?php echo $case; ?>&nr="
    +data[i][0]+"' class='btn btn-xs btn-flat'>"
    +data[i][2]+"</a></td><td><a href='index.php?show=algdb_toggleuse&set=<?php echo $set; ?>&case=<?php echo $case; ?>&nr="
    +data[i][0]+"' class='btn btn-xs btn-flat'>"
    +data[i][3]+"</a></td><td>"*/
    +addY(currentRotation,data[i][4])+"</td><td>"
    +data[i][5]+"</td><td>"
    +data[i][6]+"</td><td>"
    +data[i][7]+"</td><td><a href='index.php?show=AlgDB/algstats&set=<?php echo $set; ?>&case=<?php echo $case; ?>&nr="
    +data[i][0]+"' class='btn btn-xs btn-flat'>Show statistics and memo help</a></td></tr>";
  }
  document.getElementById("tbody").innerHTML=html;
}
function addY(number,alg){
  if(alg[0]!="y")
    return ["","y","y2","y'"][number]+" "+alg;
  var a=["","y","y2","y'","","y","y2"][number+{"'":3,"2":2," ":1}[alg[1]]]+" ";
  alg=alg.split(" ");
  alg.shift();
  alg=alg.join(" ");
  return a+alg;
}
</script>
