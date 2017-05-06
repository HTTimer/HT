<div class="container">
  <h2>Collection</h2>
  <?php
  if(!$login)die("Login");
  $collection=explode("\n",file_get_contents("../Users/$username/Collection"));
  for($i=0;$i<count($collection)-1;++$i){
    $tmp=explode(",",$collection[$i]);
    if($tmp[1]==0)
      echo $tmp[3]." ".$tmp[4]." (color: ".$tmp[5].")<br/>";
  }
  ?>
  <a class="btn btn-success" href="index.php?show=collection_add">Add cube</a>
  <a class="btn btn-success" href="">Remove selected</a>
  <a class="btn btn-success" href="">Mark selected as defect</a>
  <a class="btn btn-success" href="">Toggle defection state on selected</a>
</div>
<script>
function switchLinks(nr){
  
}
</script>
