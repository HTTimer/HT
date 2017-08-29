<div class="container">
  <?php
  $s=@$_GET["s"];
if(isset($_GET["s"])){
  ?>
  <h1>AlgSearch for <a href="index.php?show=AlgDB/algsearch"><?php echo $s; ?></a></h1>
<table class="table table-condensed table-striped table-hover">
  <thead>
    <tr><th>Set</th><th>Case</th><th>Alg</th></tr>
  </thead>
  <tbody>
  <?php
  $sql='SELECT a.alg,a.cid,c.name as cname,c.sid,s.name as sname FROM CMOS.AlgDbAlg as a INNER JOIN CMOS.AlgDbCases c ON c.id=a.cid INNER JOIN CMOS.AlgDbSets s ON s.id=c.sid WHERE a.alg LIKE "%'.$s.' %" ORDER BY s.name,c.name,a.alg;';
  $result=mysqli_query($db,$sql);
  while($row=mysqli_fetch_assoc($result)){
    echo "<tr>
    <td><a href='index.php?show=AlgDB/lsset&id=$row[sid]'>$row[sname]</a></td>
    <td><a href='index.php?show=AlgDB/lscase&set=$row[sid]&alg=$row[cid]'>$row[cname]</a></td>
    <td>$row[alg]</td></tr>";
  }
}else{
  ?>
  <h1>Search AlgDB</h1>
  <form action="index.php" method="GET">
    <input name="s" placeholder="Algorithm" type="text" class="form-control"/>
    <input type="submit" class="form-control" value="Search"/>
    <input type="hidden" name="show" value="AlgDB/algsearch"/>
  </form>
  <?php
}
?>
</tbody>
</table>
</div>
