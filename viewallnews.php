<div class="container">
  <h1>News History</h1>
  <ul>
    <!-- Newsbot -->
    <?php
    $file=explode("\n",file_get_contents("data/newsbot.csv"));
    for($i=0;$i<count($file)-1;++$i){
      echo '<li>'.$file[$i]."</li>";
    }
    ?>
  </ul>
</div>
