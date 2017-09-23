<?php
$id=$_GET["id"];
$sql="SELECT * FROM TimeSessions WHERE id=$id;";
$result=mysqli_query($db,$sql);
while($row=mysqli_fetch_assoc($result)){
  $name=$row["name"];
  $writable=$row["writable"];
  $active=$row["active"];
}
//if($writable==0)die("<div class='container'>Error (E42): Don't edit a writable only session!</div>");
?>
<div class="container">
  <h1>Update session <?php echo $id; ?></h1>
  <form class="form-horizontal" method="POST" action="index.php?show=Timerconfig/sessions_update_">
    <div class="form-group">
      <label class="col-md-4 control-label" for="name">Session name</label>
      <div class="col-md-4">
        <input id="name" name="name" value="<?php echo $name; ?>" class="form-control input-md" type="text" maxlength="32"/>
      </div>
    </div>

    <div class="form-group">
      <label class="col-md-4 control-label" for="s">Solve type</label>
      <div class="col-md-4">
        <select id="s" name="solvetype" class="form-control input-md">
          <option>2H</option>
          <option>OH</option>
          <option>BLD</option>
          <option>OH BLD</option>
          <option>FT</option>
          <option>FMC</option>
        </select>
      </div>
    </div>

    <div class="form-group">
      <label class="col-md-4 control-label" for="m">Method</label>
      <div class="col-md-4">
        <select id="m" name="method" class="form-control input-md">
          <?php
          $sql="SELECT t.scrambler,s.category FROM TimeSessions t INNER JOIN Scrambler s ON s.id=t.scrambler WHERE t.id=$id;";
          $result=mysqli_query($db,$sql);
          while($row=mysqli_fetch_assoc($result)){
            $category=$row["category"];
            $scrambler=$row["scrambler"];
          }
          $sql="SELECT id,name FROM Methods WHERE category=$category ORDER BY name ASC;";
          $result=mysqli_query($db,$sql);
          while($row=mysqli_fetch_assoc($result)){
            echo "<option value='$row[id]'>$row[name]</option>";
          }
          ?>
        </select>
      </div>
    </div>

    <div class="form-group">
      <label class="col-md-4 control-label" for="opt">Options</label>
      <div class="col-md-4">
      <div class="checkbox">
        <label for="opt-0">
          <input name="opt" id="opt-0" value="1" type="checkbox"<?php echo $active?"":" checked='checked'"; ?>/>
          Deactivate
        </label>
    	</div>
      </div>
    </div>

    <div class="form-group">
      <label class="col-md-4 control-label" for="submit">Submit</label>
      <div class="col-md-4">
        <button id="submit" name="submit" class="btn btn-success">Update</button>
      </div>
    </div>

    <input type="hidden" name="id" value="<?php echo $id; ?>"/>

  </form>
</div>
