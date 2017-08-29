<?php
function addalgorithm($name,$cname,$case,$ccase){
  $ret="";
  $urlcase=str_replace(" ","%20",$case);
  $cname=str_replace(" ","%20",$cname);
  $data = file_get_contents("http://algdb.net/set/$cname/$urlcase");
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
  file_put_contents("../data/$name/$ccase/algorithms",$ret);
  return $ret;
}

function addalgorithmsN($name,$cname,$cases,$ccases){
  for($i=0;$i<count($cases);++$i)
    addalgorithm($name,$cname,$cases[$i],$ccases[$i]);
}

function addalgorithms($name,$cases){
  for($i=0;$i<count($cases);++$i)
    addalgorithm($name,$name,$cases[$i],$cases[$i]);
}
?>
