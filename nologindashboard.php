<div class="container">
<h1>Welcome to your dashboard, not logged in user!</h1>
<div class="row">
  <div class="col-md-7">
    You are viewing the front page of CMOS (Cubing Management and Optimization System), the <a href="index.php?show=Text/compare">best</a> cubing software in the world.
    You can use most features, but you need to create an account and log in for those saving or changing data.
    If you want to try CMOS out before registering, you can log in as "testuser" with password "test23".<br/>
    CMOS is a collection of useful cubing software. It includes a timer, cube database, algorithm database, goal management, collection management and statistics.
  </div>
  <div class="col-md-5">
    <h3>News</h3>
    <div class="row">
      <ul>
        <!-- Newsbot -->
        <?php
        $sql="SELECT type,content FROM News ORDER BY id DESC LIMIT 5;";
        $result=mysqli_query($db,$sql);
        while($row=mysqli_fetch_assoc($result)){
          echo '<li>'.$row["content"].[" added to CubeDB",""," added to AlgDB"][$row["type"]]."</li>";
        }
        ?>
      </ul>
      <ul><a href='index.php?show=viewallnews'>[View all]</a></ul><br/>
    </div>
  </div>
</div>
</div>
