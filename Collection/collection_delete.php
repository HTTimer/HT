<div class="container">
<?php
$nr=$_GET["nr"];

$sql="DELETE FROM Collection WHERE id=$nr;";
mysqli_query($db,$sql);
echo mysqli_error($db);
?>
Done.
</div>