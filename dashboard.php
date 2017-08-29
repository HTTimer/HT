<div class="container">
<h1>Welcome to your dashboard, <?php echo $username; ?>!</h1>
<div class="row">
  <div class="col-md-7">
    <!-- Statistics -->
    <h3>Statistics</h3>
    Username: <?php echo $username; ?><br/>
    Role: <?php echo $isAdministrator?"Administrator":"User"; ?><br/>
    Version of CMOS: <?php echo $version; ?><br/>
  </div>
  <div class="col-md-5">
    <h3>News</h3>
    <div class="row">
      <ul>
        <!-- Newsbot -->
        <?php
        $sql="SELECT type,content FROM News ORDER BY id DESC LIMIT 5;";
        $result=mysqli_query($db,$sql);
        while($row=mysqli_fetch_assoc($result)){
          echo '<li>'.$row["content"].[" added to CubeDB",""," added to AlgDB"][$row["type"]]."</li>";
        }
        ?>
      </ul>
      <ul><a href='index.php?show=viewallnews'>[View all]</a></ul><br/>
    </div>
  </div>
  <div class="col-md-7">
    <!-- Requests -->
    <h3>Requests</h3>
    <ul class="list-group">
      <?php
      $sql="SELECT c.id,c.name,a.name AS company FROM CubeDBRequests c INNER JOIN CubeDBCompany a ON a.id=c.cid WHERE uid=$uid;";
      $result=mysqli_query($db,$sql);
      while($row=mysqli_fetch_assoc($result)){
        echo "<li class='list-group-item'><a href='index.php?show=algrequest&id=$row[id]'>CubeRequest #$row[id]: $row[company] $row[name]</a></li>";
      }
      ?>
    </ul>
  </div>
  <div class="col-md-5">
    <!-- _ -->
    <!--<h3>PB history</h3>
    <a href="index.php?show=pbs" class="btn btn-success">View PBs</a>-->
    <a href="index.php?show=Timer" class="btn btn-success">open CMOSTimer</a>
  </div>
  <div class="col-md-12">
    <!-- Storage -->
    <!--<h3>Storage</h3>
    <?php
    /*  $fz=filesize("../Users/$username/Algsets")
      +filesize("../Users/$username/Collection")
      +filesize("../Users/$username/Data")
      +filesize("../Users/$username/PBs")
      +filesize("../Users/$username/Pointlog")
      +filesize("../Users/$username/Preferences")
      +filesize("../Users/$username/Timersave")
      +filesize("../Users/$username/Tmp");
      echo round($fz/1048576*1000)/1000; */
    ?>MB/10 MB (<?php echo $fz; ?>/10485760 bytes)
    <div class="progress">
      <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $fz/104857.6; ?>" aria-valuemin="0" aria-valuemax="10485760" style="width: <?php echo $fz/104857.6; ?>%;">
        <?php echo round($fz/1048.576)/100; ?>%
      </div>
    </div>
    <button class="btn" onclick="document.getElementById('storage_breakdown').style.display='block';">view Details</button>
    <div id="storage_breakdown" style="display:none;">
      <?php
      echo "AlgSets: ".filesize("../Users/$username/Algsets")." bytes<br/>";
      echo "Data: ".filesize("../Users/$username/Data")." bytes<br/>";
      echo "Collection: ".filesize("../Users/$username/Collection")." bytes<br/>";
      echo "Pointlog: ".filesize("../Users/$username/Pointlog")." bytes<br/>";
      echo "Preferences: ".filesize("../Users/$username/Preferences")." bytes<br/>";
      echo "PBs: ".filesize("../Users/$username/PBs")." bytes<br/>";
      echo "Tmp: ".filesize("../Users/$username/Tmp")." bytes<br/>";
      echo "Timersave: ".filesize("../Users/$username/Timersave")." bytes<br/>";
      ?>
    </div>-->
  </div>
</div>
</div>
