<script src="lib/tablesorter.js"></script>
<link rel="stylesheet" type="text/css" href="lib/tablesorter2.css" />
<div class="container">
  <h1>CubeDB List</h1>
  <h4>Filter:</h4>
  <span class="cubing-icon event-222"   onclick="search('2x2x2');"   ></span>
  <span class="cubing-icon event-333"   onclick="search('3x3x3');"   ></span>
  <span class="cubing-icon event-444"   onclick="search('4x4x4');"   ></span>
  <span class="cubing-icon event-555"   onclick="search('5x5x5');"   ></span>
  <span class="cubing-icon event-666"   onclick="search('6x6x6');"   ></span>
  <span class="cubing-icon event-777"   onclick="search('7x7x7');"   ></span>
  <span class="cubing-icon event-minx"  onclick="search('Megaminx');"></span>
  <span class="cubing-icon event-pyram" onclick="search('Pyraminx');"></span>
  <span class="cubing-icon event-skewb" onclick="search('Skewb');"   ></span>
  <span class="cubing-icon event-sq1"   onclick="search('Square-1');"></span>
  <span onclick="search('')">–</span>
  <div id="out">
    <table id='products' class='table table-hover table-condensed table-striped'>
      <thead><tr><th>Company</th><th>Model name</th><th>Type</th><th title="edge length without stickers/tiles/logo">Size [mm]</th></tr></thead><tbody>
      <?php
      $sql="
      SELECT p.id, p.name as cubename, p.size, a.name as ptype, b.name as company
      FROM CMOS.CubeDB p
      INNER JOIN CMOS.CubeDBTypes a ON p.typeid = a.id
      INNER JOIN CMOS.CubeDBCompany b ON p.cid = b.id
      WHERE p.adminchecked = true;";
      $result=mysqli_query($db,$sql);
      while($row = mysqli_fetch_assoc($result)){
        $size=$row["size"]==0?"<span title='no information'>-</span>":$row["size"];
        echo "<tr><td>
          $row[company]
        </td><td>
          $row[cubename]
        </td><td>
          $row[ptype]
        </td><td>
          $size
        </td></tr>";
      }
      ?>
    </tbody></table>
  </div>
  <br/>
  <a role="button" href="index.php?show=CubeDB/addcubedb" class="btn btn-success btn-big">Request adding a cube model</a>
  <br/>
  &nbsp;
</div>
<script>
$(document).ready(function(){
  $("#products").tablesorter({sortList: [[0,0], [1,0]], theme:"blue"});
  $("table").filterTable({label:"",filterExpression:'filterTableFindAll'});
});
function search(what){
  $('.filter-table input').val(what).focus().trigger('click');
}
</script>
