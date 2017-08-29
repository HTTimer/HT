<div class="container">
  <h2>Userlist</h2>
  <?php
  $sql="SELECT * FROM Users;";
  $result=mysqli_query($db,$sql);
  echo mysqli_num_rows($result);
  echo " users registered!<br/><ul class='list-group'>";
  while($row=mysqli_fetch_assoc($result)){
    echo "<li class='list-group-item'><a href='index.php?show=Profile/profile&u=$row[id]'>$row[uname]</a></li>";
  }
  ?></ul>
</div>
