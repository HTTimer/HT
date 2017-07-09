<?php
$name=$_GET["set"];

function print_case($case,$tmp){
  global $name;
  echo "<tr><td><a href='index.php?show=algdata&set=$name&alg=$case'>$case</a></td><td id='$case'>";
  for($j=0;$j<count($tmp);++$j){
    echo "<span id='$case$j' onclick='select(\"$case\",$j);'>".$tmp[$j]."</span><br/>";
  }
  echo "</td><td id='i$case'></td></tr>";
}
?>
<div class="container">
  <h1><?php echo $name; ?></h1>
  <h4>Select the algorithms you want to use.</h4>
  <div>
    <table class="table table-condensed table-hover table-striped">
      <?php
      $lsalgsetdb=explode(",",file_get_contents("../AlgDB/data/$name/cases"));
      for($i=0;$i<count($lsalgsetdb);++$i){
        $tmp=explode("\n",file_get_contents("../AlgDB/data/$name/".$lsalgsetdb[$i]."/algorithms"));
        echo print_case($lsalgsetdb[$i],$tmp);
      }
      ?>
    </table>
  </div>
  <button class="btn btn-success" onclick="add()">Add!</button>
</div>
<script>
resArray={};
function select(cas,j){
  document.getElementById("i"+cas).innerHTML=document.getElementById(cas+j).innerHTML;
  document.getElementById(cas).style.display="none";
  resArray[cas]=j;
}
function add(){
  window.location.href="../AlgTrainer/addset3.php?set=<?php echo $name; ?>&res="+JSON.stringify(resArray);
}
</script>
