<div class="container">
  <h1>News History</h1>
  <ul>
    <!-- Newsbot -->
    <?php
    $sql="SELECT type,content FROM News;";
    $result=mysqli_query($db,$sql);
    while($row=mysqli_fetch_assoc($result)){
      echo '<li>'.$row["content"].[" added to CubeDB",""," added to AlgDB"][$row["type"]]."</li>";
    }
    ?>
  </ul>
</div>
