<div class="container">
  Total users registered: <?php
  $dirs=0;
  $x="../Users/";
  $y=scandir($x);
  foreach($y as $z){
    if(is_dir($z)){
      ++$dirs;
    }
  }
  echo "$dirs";
  ?>
</div>
