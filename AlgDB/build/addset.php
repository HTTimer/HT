<?php
function addset($name){
  file_put_contents("../data/algsets",file_get_contents("../data/algsets").",".$name);
  mkdir("../data/".$name);
  touch("../data/".$name."/cases");
}
?>
