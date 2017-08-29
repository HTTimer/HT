<?php
$id=$_GET["id"];
$sql = "SELECT name FROM AlgDbSets WHERE id=$id;";
$result=mysqli_query($db,$sql);
$row = mysqli_fetch_assoc($result);
$name=$row["name"];

function print_case($case,$id2){
  global $id; global $name;
  echo "<tr><td><a href='index.php?show=AlgDB/lscase&set=$id&alg=$id2'>$case</a></td><td>$name/$case</td></tr>";
}
?>
<div class="container">
  <h1><?php echo $name; ?></h1>
  <div>
    <table class="table table-condensed table-hover table-striped">
      <?php
      $sql = "SELECT * FROM AlgDbCases WHERE sid=$id ORDER BY name ASC;";
      $result=mysqli_query($db,$sql);
      while($row = mysqli_fetch_assoc($result)){
        print_case($row["name"],$row["id"]);
      }
      ?>
    </table>
  </div>
</div>
