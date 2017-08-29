<?php
function getMean($times,$start=0,$size=NULL){
  $sum=0;
  if($size==NULL)$size=count($times)-1;
  else $size+=$start;

  for($i=$start+1;$i<$size+1;++$i){
    if($times[$i]>0)
      $sum+=$times[$i];
    else
      return -1;
  }
  return $sum/($size-$start);
}

function getAverage($json,$start=0,$size=NULL){
  $sum=0;
  if($size==NULL)$size=count($json)-1;
  else $size+=$start;

  $cntdnf=0;
  $cnttime=0;
  $min=0xFFFFFFFF;
  $max=0;

  for($i=$start+1;$i<$size+1;++$i){
    if($json[$i]["penalty"] > -1){
      $sum+=$json[$i]["zeit"]+$json[$i]["penalty"];
      ++$cnttime;
    }else ++$cntdnf;
    if($json[$i]["zeit"]+$json[$i]["penalty"] < $min) $min=$json[$i]["zeit"]+$json[$i]["penalty"];
    if($json[$i]["zeit"]+$json[$i]["penalty"] > $max) $min=$json[$i]["zeit"]+$json[$i]["penalty"];
  }

  if($cntdnf > (1+$size*0.05)) return -1;
  if($size-$start==1)return $min;
  return ($sum - $min - ($cntdnf==0?$max:0)) / ($cnttime -1 + ($cntdnf==0*-1));
}

function getBestMean($times,$x){
  if($x>count($times)) return -1;
  $best=0xFFFFFFFF;
  for($i=0;$i<count($times)-$x;++$i)
    if(getMean($times,$i,$x)<$best)
      $best=getMean($times,$i,$x);
  return $best;
}

function getBestAverage($json,$x){
  if($x>count($json)) return -1;
  $best=0xFFFFFFFF;
  for($i=0;$i<count($json)-$x;++$i)
    if(getAverage($json,$i,$x)<$best&&getAverage($json,$i,$x)>0)
      $best=getAverage($json,$i,$x);
  return $best;
}

function format($time){
  if($time<0)return "DNF";

  $time=round($time);
  $bits=$time%1000;
  $time=($time-$bits)/1000;
  $secs=$time%60;
  $mins=(($time-$secs)/60)%60;
  $hours=($time-$secs-60*$mins)/3600;
  $s="".$bits;

  if($bits<10)$s="0".$s;
  if($bits<100)$s="0".$s;
  $s=$secs.".".$s;


  //Fill 0s and append minutes if neccessary
  if ($secs < 10 && ($mins > 0 || $hours > 0)) $s = "0" . $s;
  if ($mins > 0 || $hours > 0) $s = $mins . ":" . $s;
  if ($mins < 20 && $hours > 0) $s = "0" . $s;
  if ($hours > 0) $s = $hours + ":" . $s;
  return $s;
}
?>
