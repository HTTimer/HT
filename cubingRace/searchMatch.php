<?php
$wca_events=["2x2x2","3x3x3","4x4x4","5x5x5","6x6x6","7x7x7","Onehanded","Pyraminx","Megaminx","Square-1","Skewb"];
for($i=0;$i<count($wca_events);++$i){
  echo "<a href='join.php?evt=".$wca_events[$i]."'>Join ".$wca_events[$i]."</a><br/>";
}
?>
