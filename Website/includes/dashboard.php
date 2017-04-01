<div class="container">
<?php
if(!$login)
  die("You must be logged in to view this!");
?>
<h1>Welcome to your dashboard, <?php echo $username; ?>!</h1>
<div class="row">
  <div class="col-md-7">
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
</div>
</div>
