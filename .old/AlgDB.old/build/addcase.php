<?php
function addcase($name,$case){
  file_put_contents("../data/$name/cases",file_get_contents("../data/$name/cases").",".$case);
  mkdir("../data/$name/$case");
  touch("../data/$name/$case/algorithms");
}
function addcases($name,$cases){
  for($i=0;$i<count($cases);++$i)
    addcase($name,$cases[$i]);
}
?>
