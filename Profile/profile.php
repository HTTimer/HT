<?php
$sql="SELECT * FROM Users WHERE id=".$_GET["u"].";";
$result=mysqli_query($db,$sql);
$row=mysqli_fetch_assoc($result);
$wca=$row["wca"];
$uname=$row["uname"];
$email=$row["email"];
?>
<div class="container">
  <h1>Profile of <?php echo $uname; ?></h1>
  WCA-ID: <a href="https://www.worldcubeassociation.org/persons/<?php echo $wca; ?>"><?php echo $wca; ?></a><br/>
  E-Mail: <a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a><br/>
</div>
