<div class="container">
  <h2>Collection</h2>
  <ul class="list-group">
  <?php
  if(!$login)die("Login");
  $collection=explode("\n",file_get_contents("../Users/$username/Collection"));
  for($i=0;$i<count($collection)-1;++$i){
    $tmp=explode(",",$collection[$i]);
    if($tmp[1]==0)
      echo "<li id='el_".$i."' class='list-group-item' onclick='switchLinks(".$i.")'>".$tmp[3]." ".$tmp[4]." (color: ".$tmp[5].")".($tmp[6]=="1"?" defective":"")."</li>";
  }
  if(count($collection)==1)echo "<i>Add a cube to get started</i><br/>";
  ?>
  </ul>
  <br/>
  <a class="btn btn-success" href="index.php?show=collection_add">Add cube</a>
  <a class="btn btn-success" id="link_a" href="">Remove selected</a>
  <a class="btn btn-success" id="link_b" href="">Mark selected as defect</a>
  <a class="btn btn-success" id="link_c" href="">Toggle defection state on selected</a>
  <br/><br/>
</div>
<script>
var currentActive=0;
function switchLinks(nr){
  document.getElementById("el_"+currentActive).style.color="inherit";
  document.getElementById("el_"+nr).style.color="red";
  currentActive=nr;
  document.getElementById("link_a").href="index.php?show=collection_delete&nr="+nr;
  document.getElementById("link_b").href="index.php?show=collection_update_defect&nr="+nr;
  document.getElementById("link_c").href="index.php?show=collection_toggle_defect&nr="+nr;
}
</script>
