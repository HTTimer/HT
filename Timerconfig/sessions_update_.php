<div class="container"><?php
$name=$_POST["name"];
$id=$_POST["id"];
$solvetype=$_POST["solvetype"];
$method=$_POST["method"];
$sql="UPDATE TimeSessions SET name='$name' WHERE id=$id;";
$result=mysqli_query($db,$sql);
echo mysqli_error($db);
$sql="UPDATE TimeSessions SET solveType='$solvetype' WHERE id=$id;";
$result=mysqli_query($db,$sql);
echo mysqli_error($db);
$sql="UPDATE TimeSessions SET method=$method WHERE id=$id;";
$result=mysqli_query($db,$sql);
echo mysqli_error($db);
?>
<script>window.location.href="index.php?show=Timerconfig/sessions";</script>
</div>
