<?php
function addalgorithm($name,$case){
  $ret="";
  $urlcase=str_replace(" ","%20",$case);
  $data = file_get_contents("http://algdb.net/set/$name/$urlcase");
  $data = explode("<tbody>",$data)[1];
  $data = explode("</tbody>",$data)[0];
  $data = explode("</tr>",$data);
  for($i=0;$i<count($data)-1;++$i){
    $data[$i]=explode("<tr>",$data[$i]);
    for($j=0;$j<count($data[$i]);++$j){
      ++$j;
      $ret .= str_replace("&#39;","'",explode("<",explode(">",explode("</td>",$data[$i][$j])[0])[2])[0]).",0,0,0\n";
    }
  }
  file_put_contents("../data/$name/$case/algorithms",$ret);
  return $ret;
}

function addalgorithms($name,$cases){
  for($i=0;$i<count($cases);++$i)
    addalgorithm($name,$cases[$i]);
}
?>
