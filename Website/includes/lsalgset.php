<script>var data=<?php
echo file_get_contents("../AlgDB/data.js");
?>[<?php
echo $_GET["set"];
?>];</script>
<div class="container">
  <h1 id="name"></h1>
  <div id="asdf"></div>
</div>
<script>
document.getElementById("name").innerHTML=data.name;
for(var i=0,html=' <table class="table table-condensed table-hover table-striped">';i<data.algs.length;++i){
  html+="<tr><td><a href='index.php?show=algdata&set=<?php echo $_GET["set"]; ?>&alg="+i+"'>"+data.algs[i].name+"</a></td><td>"+data.algs[i].alg[0].name+"</td></tr>"
}
document.getElementById("asdf").innerHTML=html+"</table>";
</script>
