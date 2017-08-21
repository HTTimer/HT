<?php
$username=$_COOKIE['HTTimer-login'];
$evt=$_GET["evt"];
file_put_contents($evt."/users",file_get_contents($evt."/users").",".$username);
?>
<a href="view.php?evt=<?php echo $evt; ?>&h">Joined!</a>
