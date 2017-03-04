<div class="container">
<script>var data=<?php
$data=file_get_contents("../CubeDB/data.json");
$data=explode("//ENDOFDATA",$data);
$data=$data[0];
echo $data;
?>;
function build(){
  var i,j,c_b,html="<table class='table table-hover table-condensed'><tr><td><b>Company</b></td><td><b>Model name</b></td><td><b>Type</b></td><td><b>Colors</b></td></tr>";
  for(i=0;i<data.length;++i){
    c_b=data[i].name;
    for(j=0;j<data[i].cubes.length;++j){
      html+="<tr><td>"+c_b+
      "</td><td>"+data[i].cubes[j].name+
      "</td><td>"+{"222":"2x2x2","333":"3x3x3","444":"4x4x4","555":"5x5x5","666":"6x6x6","777":"7x7x7","pyra":"Pyraminx","mega":"Megaminx","skb":"Skewb","sq1":"Square-1"}[data[i].cubes[j].type]+
      "</td><td>"+data[i].cubes[j].colors+
      "</td></tr>";
    }
  }
  html+="</table>";
  document.getElementById("out").innerHTML=html;
}
</script>
  <h3>CubeDB List</h3>
  <div id="out"></div>
</div>
<script>
build();
</script>
