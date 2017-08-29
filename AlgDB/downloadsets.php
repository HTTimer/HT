<div class="container">
  <h1>Download AlgSet list</h1>
  <div class="row">
    <div class="col-md-4">
      <h3>Text</h3>
      <textarea rows="10" cols="40"><?php
      $sql = "SELECT * FROM AlgDbSets ORDER BY name ASC;";
      $result=mysqli_query($db,$sql);
      while($row = mysqli_fetch_assoc($result)){
        echo "$row[name]\n";
      }
      ?></textarea>
    </div>
    <div class="col-md-4">
      <h3>CSV</h3>
      <textarea rows="10" cols="40"><?php
      $sql = "SELECT * FROM AlgDbSets ORDER BY name ASC;";
      $result=mysqli_query($db,$sql);
      while($row = mysqli_fetch_assoc($result)){
        echo "$row[name],";
      }
      ?></textarea>
    </div>
    <div class="col-md-4">
      <h3>JSON</h3>
      <textarea rows="10" cols="40">[<?php
      $sql = "SELECT * FROM AlgDbSets ORDER BY name ASC;";
      $result=mysqli_query($db,$sql);
      while($row = mysqli_fetch_assoc($result)){
        echo '"'.$row["name"].'",';
      }
      ?>]</textarea>
    </div>
  </div>
</div>
