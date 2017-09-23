<div class="container">
  <h1>Session configuration</h1>
  <ul class="list-group">
  <?php
  $sql="SELECT * FROM TimeSessions WHERE uid=$uid;";
  $result=mysqli_query($db,$sql);
  while($row=mysqli_fetch_assoc($result)){
    $disabled=$row["writable"]?'':" disabled";
    $color=$row["active"]?'':' list-group-item-danger';
    $type=[" (global session)"," (user defined session)"][$row["type"]];
    echo "<li class='list-group-item$color'>
      <div class='row'>
        <div class='col-md-8'><b>$row[name]</b>$type</div>
        <div class='col-md-4'>
          <a href='index.php?show=Timerconfig/sessions_update&id=$row[id]' type='button' class='btn btn-default btn-sm'$disabled>
            <span class='btn btn-xs'>Edit</span>
          </a>
          <a href='index.php?show=Timerconfig/selectscrambler&id=$row[id]' type='button' class='btn btn-default btn-sm'$disabled>
            <span class='btn btn-xs'>Edit scrambler</span>
          </a>
        </div>
      </div>
    </li>";
  }
  ?>
  </ul>
  <a class="btn btn-success" href="index.php?show=Timerconfig/sessions_add">Add</a>
</div>
