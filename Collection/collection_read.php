<div class="container">
  <h2>Collection</h2>
  <ul class="list-group">
  <?php
  $sql="SELECT c.id, c.defective, d.name, e.name as company, f.name as color
  FROM Collection c
  INNER JOIN CubeDB d on c.cid = d.id
  INNER JOIN CubeDBCompany e on d.cid = e.id
  INNER JOIN CubeDBColors f on c.color = f.id
  WHERE uid=$uid;";
  $result=mysqli_query($db,$sql);
  while($row=mysqli_fetch_assoc($result)){
    echo "<li id='el_$row[id]' class='list-group-item' onclick='switchLinks($row[id])'>$row[company] $row[name] (color: $row[color]) ".($row["defective"]?"defective":"")."</li>";
  }
  echo mysqli_error($db);
  ?>
  </ul>
  <br/>
  <a class="btn btn-success" href="index.php?show=Collection/collection_add">Add cube</a>
  <a class="btn btn-success" id="link_a" href="">Remove selected</a>
  <a class="btn btn-success" id="link_b" href="">Mark selected as defect</a>
  <a class="btn btn-success" id="link_c" href="">Toggle defection state on selected</a>
  <br/>
</div>
<script>
var currentActive=0;
function switchLinks(nr){
  if(currentActive!=0){
    document.getElementById("el_"+currentActive).style.color="inherit";
  }
  document.getElementById("el_"+nr).style.color="red";
  currentActive=nr;
  document.getElementById("link_a").href="index.php?show=Collection/collection_delete&nr="+nr;
  document.getElementById("link_b").href="index.php?show=Collection/collection_update_defect&nr="+nr;
  document.getElementById("link_c").href="index.php?show=Collection/collection_toggle_defect&nr="+nr;
}
</script>
