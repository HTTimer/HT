<script>var data=<?php
echo file_get_contents("../AlgDB/data.js");
?>[<?php
echo $_GET["set"];
?>].algs[<?php
echo $_GET["alg"];
?>];</script>
<div class="container">
  <h1 id="name"></h1>
  <div id="asdf"></div>
</div>
<script>
document.getElementById("name").innerHTML=data.name;
for(var i=0,html=' <table class="table table-condensed table-hover table-striped">';i<data.alg.length;++i){
  html+="<tr><td>Algorithm "+(i+1)+" ("+data.alg[i].likes.length+" Likes/"+data.alg[i].dislikes.length+" Dislikes)</td><td>"+data.alg[i].name+"</td></tr>";
}
document.getElementById("asdf").innerHTML=html+"</table>";
</script>
