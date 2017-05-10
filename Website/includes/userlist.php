<div class="container">
  <h2>Userlist</h2>
  Total users registered: <?php
  $dirs=0;
  $x="../Users/";
  $y=scandir($x);
  foreach($y as $z){
    if(is_dir($z)){
      ++$dirs;
    }
  }
  echo "$dirs<br/><ul>";

  if ($handle = opendir('../Users/')) {
    $blacklist = array('.', '..', 'uploads');
    while (false !== ($file = readdir($handle))) {
        if (!in_array($file, $blacklist)) {
            echo "<li><a href='index.php?show=profile&u=$file'>$file</a>";
        }
    }
    closedir($handle);
  }
  ?></ul>
</div>
