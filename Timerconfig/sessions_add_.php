<div class="container"><?php
$name=$_POST["name"];
$solvetype=$_POST["solvetype"];
$sql="INSERT INTO TimeSessions (uid,name,active,writable,type,scrambler,solveType) VALUES ($uid,'$name',1,1,1,1,'$solvetype');";
$result=mysqli_query($db,$sql);
echo mysqli_error($db);

$sql="SELECT COUNT(*) as COUNT FROM CMOS.TimeSessions WHERE uid=1;";
$result=mysqli_query($db,$sql);
$row=mysqli_fetch_assoc($result);
$row["COUNT"]++;
touch("Users/$username/".$row["COUNT"].".session");
file_put_contents("Users/$username/".$row["COUNT"].".session","[]");
echo mysqli_error($db);
?>
</div>
<script>window.location.href="index.php?show=Timerconfig/sessions";</script>
