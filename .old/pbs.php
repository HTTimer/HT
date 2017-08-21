<div class="container">
  <h2>PB list</h2>
  <textarea style="width:100%;height:100px;" id="te">
<?php
$pbfile=explode("\n",file_get_contents("../Users/$username/PBs"));
for($i=0;$i<count($pbfile)-1;++$i){
  $pbfile[$i]=explode(";",$pbfile[$i]);
  echo implode(
    [
      fl($pbfile[$i][0],8),
      fl($pbfile[$i][1],7),
      fl($pbfile[$i][3],11),
      $pbfile[$i][4],
      "",
      $pbfile[$i][6].";Cube: ".$pbfile[$i][5]
    ],
  " ")."\n";
}
function fl($a,$b){
  while(strlen($a)<$b)
    $a.=" ";
  return $a;
}
?>
  </textarea>
  <br/>
  <button onclick="document.getElementById('te').select();" class="btn btn-success">Select all</button>
</div>
