<div class="container">
  <h2>Select scrambler</h2>
  <form action="index.php?show=Timerconfig/selectscrambler_" method="POST">
    <select class="form-control" name="scrambler">
      <?php
      $sql="SELECT s.id,s.name,c.name as ente FROM Scrambler as s INNER JOIN CubeDBTypes c ON c.id=s.category WHERE uid=2 ORDER BY c.id;";
      $result=mysqli_query($db,$sql);
      while($row=mysqli_fetch_assoc($result)){
        echo "<option value=".$row["id"].">".$row["ente"]." ".htmlspecialchars($row["name"])."</option>";
      }
      ?>
    </select>
    <input type="hidden" name="id" value="<?php echo $_GET["id"];?>"/>
    <br/>
    <input role="button" type="submit" name="submit" value="Set!" class="btn btn-success"/>
  </form>
</div>
