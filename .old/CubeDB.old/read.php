<?php
function read_data(){
  $data=file_get_contents("data.json");
  $data=explode("//ENDOFDATA",$data);
  $data=$data[0];
  return $data;
}
echo read_data();
?>
