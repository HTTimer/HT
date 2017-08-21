<div class="container"><?php
$name=$_POST["name"];
$id=$_POST["id"];
$sql="UPDATE TimeSessions SET name='$name' WHERE id=$id;";
$result=mysqli_query($db,$sql);
echo mysqli_error($db);
?>
</div>
