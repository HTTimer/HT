<script src="lib/tablesorter.js"></script>
<link rel="stylesheet" type="text/css" href="lib/tablesorter2.css" />
<div class="container">
  <h1>Add Cube to Collection</h1>
  <form method="POST" action="index.php?show=Collection/collection_add_">
    <table id='products' class='table table-hover table-condensed table-striped'><thead><tr><th>Company</th><th>Model name</th><th>Type</th><th>Size</th></tr></thead><tbody>
      <?php
      $sql="
      SELECT p.id, p.name as cubename, p.size, a.name as ptype, b.name as company
      FROM CMOS.CubeDB p
      INNER JOIN CMOS.CubeDBTypes a ON p.typeid = a.id
      INNER JOIN CMOS.CubeDBCompany b ON p.cid = b.id
      WHERE p.adminchecked = true;";
      $result=mysqli_query($db,$sql);
      while($row = mysqli_fetch_assoc($result)){
        echo "<tr onclick='lselect($row[id])'><td>
          $row[company]
        </td><td>
          $row[cubename]
        </td><td>
          $row[ptype]
        </td><td>
          $row[size]
        </td></tr>";
      }
      ?>
    </tbody></table>
    <select class="form-control" name="color">
      <?php
      $sql="
      SELECT * FROM CMOS.CubeDBColors ORDER BY name ASC;";
      $result=mysqli_query($db,$sql);
      while($row = mysqli_fetch_assoc($result)){
        echo "<option value='$row[id]'>$row[name]</option>";
      }
      ?>
    </select>
    <br/>
    <input type="hidden" name="cube" id="cube" value=""/>
    <input type="submit" name="submit" class="btn btn-success btn-big">Add</a>
  </form>
</div>
<script>
$(document).ready(function(){
  $("#products").tablesorter({sortList: [[0,0], [1,0]], theme:"blue"});
  $("table").filterTable({label:"",filterExpression:'filterTableFindAll'});
});
function search(what){
  $('.filter-table input').val(what).focus().trigger('click');
}
function lselect(id){
  document.getElementById("cube").value=id;
}
</script>
