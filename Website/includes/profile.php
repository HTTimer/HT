<?php
if(isset($_GET["u"]))
  $user=$_GET["u"];
else
  $user=$username;

$userfile=explode("\n",file_get_contents("../Users/$user/Data"));
$uname=$userfile[0];
$WCA=$userfile[1];
$speedsolving=$userfile[2];
$speedcube=$userfile[3];
$reddit=$userfile[4];
$twistypuzzles=$userfile[5];
$points=$userfile[6];
$country=$userfile[7];
?>
<div class="container">
  <h1>Profile of <?php echo $uname; ?></h1>
  WCA-ID: <a href="https://www.worldcubeassociation.org/persons/<?php echo $WCA; ?>"><?php echo $WCA; ?></a><br/>
  <?php if($speedsolving!="")echo "Speedsolving.com username: $speedsolving<br/>"; ?>
  <?php if($speedcube!="")echo "Speedcube.de username: $speedcube<br/>"; ?>
  <?php if($reddit!="")echo "Reddit /r/cubers username: $reddit<br/>"; ?>
  <?php if($twistypuzzles!="")echo "Speedsolving.com username: $twistypuzzles<br/>"; ?>
  <?php if($country!="")echo "Country: $country<br/>"; ?>
</div>
