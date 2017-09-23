<br/><br/><br/><?php
$solve=array("zeit"=>3000,"penalty"=>0);
$solve2=array("zeit"=>6000,"penalty"=>-1);
$json=array($solve,$solve,$solve,$solve,$solve,$solve,$solve,$solve,$solve,$solve,$solve,$solve2);
function getAverage($json,$start,$size){
  $sum=0;

  $cntdnf=0;
  $cnttime=0;
  $min=0xFFFFFFFF;
  $max=0;

  for($i=$start;$i<$start+$size;++$i){
    // precalc some values to save execution time
    // this saved 2 seconds of goals with 2k solves
    $solve=$json[$i];
    $spenalty=$solve['penalty'];
    $stotal=$solve['zeit']+$spenalty;

    if($spenalty > -1){
      $sum+=$stotal;
      ++$cnttime;
      if($stotal < $min) $min=$stotal;
      if($stotal > $max) $max=$stotal;
    }else ++$cntdnf;
  }

  echo $cnttime - 1 - ($cntdnf==0);

  if($cntdnf > (1+$i/20)) return -1;
  if($size==1) return $min;
  if($cnttime -3 + ($cntdnf==0*-1)==0) return "DNF";
  return ($sum - $min - ($cntdnf==0?$max:0)) / ($cnttime - 1 - ($cntdnf==0));
}
echo getAverage($json,0,5);
?>
