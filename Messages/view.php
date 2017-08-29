<div class="container">
  <h1>Messages for you</h1>
  <div class="list-group">
  <?php
  $sql="SELECT
  m.header,m.content,u.uname
  FROM Messages m
  INNER JOIN Users u ON m.uid1=u.id
  WHERE uid2=$uid;"; //uid1 -> Von, uid2 -> An
  $result=mysqli_query($db,$sql);
  while($row=mysqli_fetch_assoc($result)){
    echo "<a nohref='nohref' class='list-group-item'>
      <h4 class='list-group-item-heading'>from $row[uname]: $row[header]</h4>
      <p class='list-group-item-text'>".nl2br($row["content"])."</p>
    </a>";
  }
  ?>
  </div>
  <h1>Messages from you</h1>
  <div class="list-group">
  <?php
  $sql="SELECT
  m.header,m.content,u.uname
  FROM Messages m
  INNER JOIN Users u ON m.uid2=u.id
  WHERE uid1=$uid;"; //uid1 -> Von, uid2 -> An
  $result=mysqli_query($db,$sql);
  while($row=mysqli_fetch_assoc($result)){
    echo "<a nohref='nohref' class='list-group-item'>
      <h4 class='list-group-item-heading'>to $row[uname]: $row[header]</h4>
      <p class='list-group-item-text'>".nl2br($row["content"])."</p>
    </a>";
  }
  ?>
  </div>
  <a role="button" class="btn  btn-success" href="index.php?show=Messages/write">Write message</a>
</div>
