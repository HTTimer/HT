<?php
$json="[";

function indexiere($url,$split1,$split2,$split,$remove,$xpl,$name){
  global $json;
  $json.='{"name":"'.$name.'","algs":[';
  $code = file_get_contents($url);
  $code = explode($split1,$code)[1];
  $code = explode($split2,$code)[0];
  $code = explode($split,$code);
  for($i=0;$i<count($code)-1;++$i){
    $code[$i] = implode(explode($remove,$code[$i]),"");
    $code[$i] = explode($xpl,$code[$i]);
    $json.= '{"name":"'.splithtml($code[$i][1]).'","image":"';
    $json.= explode('"',explode("</td>",$code[$i][2])[0])[1].'","alg":[';
    $k = explode("<br />",explode("</td>",$code[$i][3])[0]);
    for($j=0;$j<count($k)-1;$j++){
      $json.='{"name":"'.$k[$j].'","likes":[],"dislikes":[]},';
    }
    $json=substr($json, 0,-1);
    $json.=']},';
  }
  $json=substr($json, 0,-1);
  $json.="]},";
}
function splithtml($a){
  return explode("<",explode(">",$a)[1])[0];
}
indexiere("http://www.algdb.net/Set/OLL","<tbody>","</tbody>","</tr>",'<tr class="">',"<td>","OLL");
indexiere("http://www.algdb.net/Set/PLL","<tbody>","</tbody>","</tr>",'<tr class="">',"<td>","PLL");
indexiere("http://www.algdb.net/Set/ELL","<tbody>","</tbody>","</tr>",'<tr class="">',"<td>","ELL");
indexiere("http://www.algdb.net/Set/WVLS","<tbody>","</tbody>","</tr>",'<tr class="">',"<td>","WVLS");
indexiere("http://www.algdb.net/Set/F2L","<tbody>","</tbody>","</tr>",'<tr class="">',"<td>","F2L");
$json=substr($json, 0,-1);
$json.="]";
echo $json;
?>
