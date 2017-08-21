<div class="container">
<h1>Welcome to your dashboard, not logged in user!</h1>
<h5>Warning: this site is a alpha version. Nothing is garantueed to work.</h5>
<div class="row">
  <div class="col-md-7">
    You are viewing the front page of CMOS (Cubing Management and Optimization System), the <a href="index.php?show=Text/compare">best</a> cubing software in the world.
    You can use most features, but you need to create an account and log in for those saving or changing data.
  </div>
  <div class="col-md-5">
    <h3>News</h3>
    <div class="row">
      <ul>
        <!-- Newsbot -->
        <?php
        $file=explode("\n",file_get_contents("data/newsbot.csv"));
        for($i=0;$i<5;++$i){
          echo '<li>'.$file[$i]."</li>";
        }
        ?>
      </ul>
      <?php
      if(count($file)>5){
        echo "<ul><a href='index.php?show=viewallnews'>[View more]</a></ul><br/>";
      }
      ?>
    </div>
  </div>
  <div class="col-md-7">

  </div>
  <div class="col-md-5">

    <a href="index.php?show=Timer" class="btn btn-success">open CMOSTimer</a>
  </div>
</div>
</div>
