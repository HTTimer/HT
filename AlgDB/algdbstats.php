<div class="container">
  <h1>AlgDb statistics</h1>
  <?php
  $sql="SELECT COUNT(*) AS COUNT FROM CMOS.AlgDbSets;";
  $sets = mysqli_fetch_assoc(mysqli_query($db,$sql))["COUNT"];
  $sql="SELECT COUNT(*) AS COUNT FROM CMOS.AlgDbCases;";
  $cases = mysqli_fetch_assoc(mysqli_query($db,$sql))["COUNT"];
  $sql="SELECT COUNT(*) AS COUNT FROM CMOS.AlgDbAlg;";
  $algorithms = mysqli_fetch_assoc(mysqli_query($db,$sql))["COUNT"];
  $sql="SELECT count(DISTINCT(alg)) as COUNT FROM CMOS.AlgDbAlg;";
  $ualgorithms = mysqli_fetch_assoc(mysqli_query($db,$sql))["COUNT"];
  ?>
  <div class="list-group">
    <a nohref="nohref" class="list-group-item">
      <h4 class="list-group-item-heading">Number of cases</h4>
      <p class="list-group-item-text"><?php echo $cases; ?></p>
    </a>
    <a nohref="nohref" class="list-group-item">
      <h4 class="list-group-item-heading">Number of sets:</h4>
      <p class="list-group-item-text"><?php echo $sets; ?></p>
    </a>
    <a nohref="nohref" class="list-group-item">
      <h4 class="list-group-item-heading">Number of algorithms:</h4>
      <p class="list-group-item-text"><?php echo $algorithms; ?></p>
    </a>
    <a nohref="nohref" class="list-group-item">
      <h4 class="list-group-item-heading">Number of unique algorithms:</h4>
      <p class="list-group-item-text"><?php echo $ualgorithms; ?></p>
    </a>
  </div>
</div>
