<?php
$uname=$_POST['uname'];
$pass=$_POST['pword'];

$sql="SELECT * FROM Users WHERE uname='$uname' and pw='$pass';";
$result=mysqli_query($db,$sql);
$id=mysqli_fetch_assoc($result);
$login=mysqli_num_rows($result)>0;

if($login){
	setcookie("HTTimer-login",$id["id"],0,"/");
	echo "Logged in successfully. Redirecting ...";
	echo "<script>window.location.href='index.php'</script></script>";
}else{
	echo "Wrong username or password";
	$cookiesSet = array_keys($_COOKIE);
	for($x=0;$x<count($cookiesSet);$x++)setcookie($cookiesSet[$x],"",time()-1);
}
?>
