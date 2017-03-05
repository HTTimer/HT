<?php
echo "<h1>Error 404 - the file you requested was not found on this server.</h1>";
if(explode("/",$_GET["_url"])[1]=="index"){
  // include("Website/index.php");
}
?>
Please contact the administrator of this page if you followed a link on this page.
Check the URL for typing mistakes like typing indx instead of index.<br/>
<a href="../Website/index.php">Go to home</a>
