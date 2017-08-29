<div class="container"><?php
$name=$_POST["name"];
$sql="INSERT INTO TimeSessions (uid,name,active,writable,type,scrambler) VALUES ($uid,'$name',1,1,1,1);";
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
