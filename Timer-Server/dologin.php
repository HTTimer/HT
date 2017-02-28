<?php
$uname=$_POST['uname'];
$pass=$_POST['pword'];
$accounts=json_decode("[".file_get_contents("accounts.pptm")."]");
$login=false;

for($i=0;$i<count($accounts);++$i){
	if($accounts[$i][0]==$uname){
		if($accounts[$i][1]==$pass){
			echo "Logged in successfully. Redirecting ...";
			echo "<script>window.location.href='../'</script></script>";
			setcookie("HTTimer-login",$uname,0,"/");
			$login=true;
		}
	}
}

if(!$login){
	echo "Wrong username or password";
	$cookiesSet = array_keys($_COOKIE);
	for($x=0;$x<count($cookiesSet);$x++)setcookie($cookiesSet[$x],"",time()-1);
}
?>
