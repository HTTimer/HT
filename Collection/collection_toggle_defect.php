<div class="container">
<?php
$nr=$_GET["nr"];

$sql="UPDATE Collection SET defective=NOT defective WHERE id=$nr;";
mysqli_query($db,$sql);
echo mysqli_error($db);
?>
Done.
</div>
