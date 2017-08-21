<script src="lib/tablesorter.js"></script>
<link rel="stylesheet" type="text/css" href="lib/tablesorter2.css" />
<div class="container">
<script>var data=<?php
$data=file_get_contents("../CubeDB/data.json");
$data=explode("//ENDOFDATA",$data);
$data=$data[0];
echo $data;
?>;
noc=0; //number of cubes
function build(){
  var i,j,c_b,html="<table id='products' class='table table-hover table-condensed table-striped'><thead><tr><th>Company</th><th>Model name</th><th>Type</th><!--<th>Colors</th>--><th>Size</th><!--<th>Edit</th>--></tr></head><tbody>";
  for(i=0;i<data.length;++i){
    c_b=data[i].name;
    for(j=0;j<data[i].cubes.length;++j){
      html+="<tr><td>"+c_b+
      "</td><td>"+data[i].cubes[j].name+
      "</td><td>"+{"222":"2x2x2","333":"3x3x3 Rubik's cube","444":"4x4x4","555":"5x5x5","666":"6x6x6","777":"7x7x7","pyra":"Pyraminx","mega":"Megaminx","skb":"Skewb","sq1":"Square-1"}[data[i].cubes[j].type]+
      //"</td><td>"+data[i].cubes[j].colors+
      "</td><td>"+(data[i].cubes[j].size||"-")+(data[i].cubes[j].size&&"mm"||"")+
      //"</td><td><a href='index.php?show=cubedbeditrequest&cid="+i+"&id="+j+"' role='button' class='btn btn-default btn-xs'>Request Edit</a>"
      "</td></tr>";
      ++noc;
    }
  }
  html+="</tbody></table>Listed "+noc+" cube models.";
  document.getElementById("out").innerHTML=html;
}
</script>
  <h1>CubeDB List</h1>
  <h4>Filter:</h4>
  <span class="cubing-icon event-222" onclick="search('2x2x2');"></span>
  <span class="cubing-icon event-333" onclick="search('3x3x3');"></span>
  <span class="cubing-icon event-444" onclick="search('4x4x4');"></span>
  <span class="cubing-icon event-555" onclick="search('5x5x5');"></span>
  <span class="cubing-icon event-666" onclick="search('6x6x6');"></span>
  <span class="cubing-icon event-777" onclick="search('7x7x7');"></span>
  <span class="cubing-icon event-minx" onclick="search('Megaminx');"></span>
  <span class="cubing-icon event-pyram" onclick="search('Pyraminx');"></span>
  <span class="cubing-icon event-skewb" onclick="search('Skewb');"></span>
  <span class="cubing-icon event-sq1" onclick="search('Square-1');"></span>
  <span onclick="search('')">–</span>
  <div id="out"></div>
  <br/>
  <a role="button" href="index.php?show=createcube" class="btn btn-success btn-big">Request adding a cube model</a>
  <br/>
  &nbsp;
</div>
<script>
build();
$(document).ready(function(){
  $("#products").tablesorter({sortList: [[0,0], [1,0]], theme:"blue"});
  $("table").filterTable({label:"",filterExpression:'filterTableFindAll'});
});
function search(what){
  $('.filter-table input').val(what).focus().trigger('click');
}
</script>
