<div class="container">
  <?php
  function url($href,$text){
    echo "<li class='list-group-item'><a href='http://$href' target='_blank'>$text</a></li>";
  }
  function title($text){
    echo "</ul><h3>$text</h3><ul class='list-group'>";
  }
  title("General Websites");
  url("localhost/HTTimer/Website/index.php","CMOS");
  title("Cubeshops");
  url("championscubestore.com","Championscubestore/51morefun");
  url("cubedepotusa.com","CubeDepot USA");
  url("cubikon.de","Cubikon (DE)");
  url("cutcorner.com.ua","CutCorner");
  url("letscubit.com","LetsCubeIt");
  url("lightake.com","LighTake");
  url("magiccubemall.com","MagicCubeMall");
  url("speedcubeshop.com.au","Speedcubeshop");
  url("thecubespecialists.com","TheCubeSpecialists");
  url("thecubicle.us","TheCubicle");
  url("thepuzzlestore.uk","ThePuzzleStore");
  url("zcube.hk","ZCube");
  title("Forum");
  url("speedsolving.com","Speedsolving");
  url("twistypuzzles.com","Twistypuzzles");
  url("reddit.com/r/cubers","Reddit /r/cubers");
  title("Timer");
  url("localhost/HTTimer/Timer/index.html","CMOSTimer");
  url("qqtimer.net","QQTimer");
  url("cstimer.net/timer.php","CsTimer");
  url("bestsiteever.ru/zbll","ZBLL-Trainer");
  ?>
</div>
