<div class="container">
  <script>var data=<?php
  $data=file_get_contents("../CubeDB/data.json");
  $data=explode("//ENDOFDATA",$data);
  $data=$data[0];
  echo $data;
  ?>;
  function build(i){
    var j,c_b,html="Select model:<br/><table id='products' class='table table-hover table-condensed table-striped'><thead><tr><th>Company</th><th>Model name</th><th>Type</th><!--<th>Colors</th>--><th>Size</th></tr></head><tbody>";
    c_b=data[i].name;
    for(j=0;j<data[i].cubes.length;++j){
      html+="<tr><td>"+c_b+
      "</td><td><a nohref='nohref' onclick='buildS("+i+","+j+")'>"+data[i].cubes[j].name+
      "</a></td><td>"+{"222":"2x2x2","333":"3x3x3","444":"4x4x4","555":"5x5x5","666":"6x6x6","777":"7x7x7","pyra":"Pyraminx","mega":"Megaminx","skb":"Skewb","sq1":"Square-1"}[data[i].cubes[j].type]+
      "</td><td>"+(data[i].cubes[j].size||"-")+(data[i].cubes[j].size&&"mm"||"")+
      "</td></tr>";
    }
    html+="</tbody></table>";
    document.getElementById("out").innerHTML=html;
  }
  function buildC(){
    var html="Select company: <select>",i;
    for(i=0;i<data.length;++i)
      html+="<option onclick='build("+i+")'>"+data[i].name+"</option>";
    html+="</select>";
    html+='<br/><a nohref="nohref" class="btn btn-success" onclick="alert(\'Please select a company, a cube model and a color!\');">Add</a>'
    document.getElementById("out").innerHTML=html;
  }
  function buildS(i,j){
    var html="Select color: <select>",k,colors=["select","black","white","stickerless","yellow","red","orange","green","blue","brown","primary","grey","transparent","transparent red","transparent green","transparent blue","transparent stickerless"];
    for(k=0;k<colors.length;++k)
      html+="<option onclick='buildFinalize("+i+","+j+",\""+colors[k]+"\")'>"+colors[k]+"</option>";
    html+="</select>";
    document.getElementById("out").innerHTML=html;
  }
  function buildFinalize(i,j,k){
    window.location.href="index.php?show=collection_add_&c="+data[i].name+"&m="+data[i].cubes[j].name+"&d="+k;
  }
  </script>
  <h2>Add Cube to collection</h2>
  <div id="out"></div>

</div>
<script>
buildC();
</script>
