<?php
echo "<h1>404</h1>";
if(explode("/",$_GET["_url"])[1]=="index"){
  include("Website/index.php");
}
?>
