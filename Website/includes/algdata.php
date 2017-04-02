<script src="lib/tablesorter.js"></script>
<link rel="stylesheet" type="text/css" href="lib/tablesorter2.css" />

<?php
$set=$_GET["set"];
$case=$_GET["alg"];
$algorithms=explode("\n",file_get_contents("../AlgDB/data/$set/$case/algorithms"));
$counter=0;

function addAlg($alg){
  global $counter;
  $counter++;

  $alg=explode(",",$alg);
  $likes=$alg[1];
  $dislikes=$alg[2];
  $iusethis=$alg[3];
  $alg=$alg[0];
  $lgth=count(explode(" ",$alg))+count(explode("M",$alg))+count(explode("E",$alg))+count(explode("S",$alg))-count(explode("x",$alg))-count(explode("y",$alg))-count(explode("z",$alg));
  $elgth=count(explode(" ",$alg))+count(explode("M",$alg))+count(explode("E",$alg))+count(explode("S",$alg))-3;
  $qlgth=$lgth+count(explode("2",$alg))-1;
  echo "<tr><td>$counter</td><td>$likes</td><td>$dislikes</td><td>$iusethis</td>
  <td>$alg</td>
  <td>$lgth</td>
  <td>$qlgth</td>
  <td>$elgth</td>
  <td><button class='btn btn-xs btn-success'>Error found</button></td>
  </tr>";
}
?>
<div class="container">
  <h1><?php echo "$set/$case"; ?></h1>
  <div>
    Rotation: <div class="btn-group" role="group" id="rotationbuttons">
      <button type="button" class="btn btn-default active" onclick="switchRotation(0);">none</button>
      <button type="button" class="btn btn-default" onclick="switchRotation(1);">y</button>
      <button type="button" class="btn btn-default" onclick="switchRotation(2);">y2</button>
      <button type="button" class="btn btn-default" onclick="switchRotation(3);">y'</button>
    </div>
    <table class="table table-condensed table-hover table-striped">
      <thead>
        <tr><th>ID</th><th>Likes</th><th>Dislikes</th><th>People that use this alg</th><th>Algorithm</th><th>HTM</th><th>QTM</th><th>ETM</th><th>Error</th></tr>
      </thead>
      <tbody>
        <?php
        for($i=0;$i<count($algorithms)-1;++$i)
          addAlg($algorithms[$i]);
        ?>
      </tbody>
    </table>
  </div>
</div>

<script>
$(document).ready(function(){
  $("table").tablesorter({sortList: [[3,0], [0,0]],theme:"blue"});
  $("table").filterTable();
});

var currentRotation=0;
function switchRotation(to){
  document.getElementById("rotationbuttons").children[0].classList.remove("active");
  document.getElementById("rotationbuttons").children[1].classList.remove("active");
  document.getElementById("rotationbuttons").children[2].classList.remove("active");
  document.getElementById("rotationbuttons").children[3].classList.remove("active");
  document.getElementById("rotationbuttons").children[currentRotation=to].classList.add("active");
}
</script>
