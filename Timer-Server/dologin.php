<?php
$uname=$_POST['uname'];
$pass=$_POST['pword'];
$accounts=file_get_contents("accounts.pptm");
if(strstr($accounts,"$uname,$pass")){
	echo "Logged in successfully.";
	setcookie("HTTimer-login",$uname,0,NULL,NULL,false,true);
}else{
	echo "Wrong username or password";
	$cookiesSet = array_keys($_COOKIE);
	for($x=0;$x<count($cookiesSet);$x++)setcookie($cookiesSet[$x],"",time()-1);
}
?>