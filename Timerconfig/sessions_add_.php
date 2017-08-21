<div class="container"><?php
$name=$_POST["name"];
$sql="INSERT INTO TimeSessions (uid,name,active,writable,type) VALUES ($uid,'$name',1,1,1);";
$result=mysqli_query($db,$sql);
echo mysqli_error($db);
?>
</div>
