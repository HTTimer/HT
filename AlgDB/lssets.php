<div class="container">
  <h1>AlgSet list</h1>
  <ul>
  <?php
  $sql = "SELECT * FROM AlgDbSets ORDER BY name ASC;";
  $result = mysqli_query($db,$sql);
  while($row = mysqli_fetch_assoc($result)){
    echo "<li class='list-group-item'>
      <b>
        <a href='index.php?show=AlgDB/lsset&id=$row[id]'>$row[name]</a>
      </b>
    </li>";
  }
  ?>
  </ul>
  <div class="row">
    <br/>
    <a href="index.php?show=AlgDB/downloadsets" class="btn btn-success">Download list</a>
    <a href="index.php?show=AlgDB/algdbstats" class="btn btn-success">View statistics</a>
    <a href="index.php?show=AlgDB/algsearch" class="btn btn-success">Search AlgDB</a>
  </div>
</div>
<style>
.addset {
  height: 100px;
  border: 1px solid black;
  padding: 3px;
}
</style>
