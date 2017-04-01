<div class="container">
  <?php
  function url($href,$text){
    echo "<a href='http://$href'>$text</a><br/>";
  }
  function title($text){
    echo "<h3>$text</h3>";
  }
  title("General Websites");
  url("localhost/HTTimer/Website/index.php","CMOS");
  url("speedsolving.com","Speedsolving");
  url("speedcube.de","Speedcube.de");
  url("twistypuzzles.com","Twistypuzzles");
  url("reddit.com/r/cubers","Reddit /r/cubers");
  title("Timer");
  url("localhost/HTTimer/Timer/index.html","CMOSTimer");
  url("qqtimer.net","QQTimer");
  url("cstimer.net/timer.php","CsTimer");
  ?>
</div>
