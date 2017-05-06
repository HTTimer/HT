<div class="container">
  <h2>Cubing documents</h2>
  <ul class="list-group">
  <?php
    if ($handle = opendir('../Documents/')) {
      $blacklist = array('.', '..', 'uploads');
      while (false !== ($file = readdir($handle))) {
          if (!in_array($file, $blacklist)) {
              add($file);
          }
      }
      closedir($handle);
    }

    function add($file){
      $a=explode("\n",file_get_contents("../Documents/$file/information"));
      hinzufuegen($a[1],$a[2],$a[0],explode(" ",$a[3]),$file);
    }

    function hinzufuegen($name,$inhalt,$author,$tags,$id){
      echo '<li class="list-group-item">
        <div class="row">
          <div class="col-md-7">
            <h4><a href="index.php?show=documents_view&id='.$id.'">'.$name.'</a> ';
      for($i=0;$i<count($tags);++$i){
        echo '<span class="label label-default">'.$tags[$i].'</span> ';
      }
      echo '</h4>
            '.substr($inhalt,0,150).'...
          </div>
          <div class="col-md-5">
            <span class="glyphicon glyphicon-pencil"></span>
            <a href="includes/documents_download.php?id='.$id.'"><span class="glyphicon glyphicon-save-file"></span></a>
            <br/><br/>
            Size: '.strlen($inhalt).' bytes<br/>
            Author: '.$author.'
          </div>
        </div>
      </li>';
    }

  ?>
  </ul>
</div>
