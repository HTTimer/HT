<div class="container">
<?php
if(!$login)
  die("You must be logged in to view this!");
?>
<h1>Welcome to your dashboard, <?php echo $username; ?>!</h1>
<div class="row">
  <div class="col-md-7">
    <!-- Statistics -->
    <h3>Statistics</h3>
    Role: <?php echo $isAdministrator?"Administrator":"User"; ?><br/>
    ...
  </div>
  <div class="col-md-5">
    <h3>News</h3>
    <div class="row">
      <!-- Newsbot -->
      <?php
      $file=explode(",",file_get_contents("data/newsbot.csv"));
      for($i=0;$i<count($file);++$i){
        echo '<div class="col-md-12">'.$file[$i]."</div>";
      }
      ?>
    </div>
  </div>
  <div class="col-md-7">
    <!-- Requests -->
    <h3>Requests</h3>
    <ul class="list-group">
      <?php
      $reqs=explode(",",file_get_contents("../Users/$username/Algsets"));
      for($i=0;$i<count($reqs);++$i){
        echo "<li class='list-group-item'><a href='index.php?show=algrequest&id=".$reqs[$i]."'>AlgRequest #".$reqs[$i]."</a></li>";
      }
      ?>
    </ul>
  </div>
  <div class="col-md-5">
    <!-- _ -->
    <h3>PB history</h3>
    <a href="index.php?show=pbs" class="btn btn-success">View PBs</a>
  </div>
  <div class="col-md-12">
    <!-- Storage -->
    <h3>Storage</h3>
    <?php
      $fz=filesize("../Users/$username/Algsets")+filesize("../Users/$username/Collection")+filesize("../Users/$username/Data")+filesize("../Users/$username/PBs")+filesize("../Users/$username/Pointlog")+filesize("../Users/$username/Preferences")+filesize("../Users/$username/Tmp");
      echo round($fz/1048576*1000)/1000;
    ?>MB/10 MB (<?php echo $fz; ?>/10485760 bytes)
    <div class="progress">
      <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $fz/104857.6; ?>" aria-valuemin="0" aria-valuemax="10485760" style="width: <?php echo $fz/104857.6; ?>%;">
        <?php echo round($fz/1048.576)/100; ?>%
      </div>
    </div>
  </div>
</div>
</div>
