<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
<?php
$name = $_POST['uname'];
$wca = $_POST['wca'];
$pword = $_POST['pword'];
$pword2 = $_POST['pword2'];

if (!$_POST['uname']) {
	$errName = 'Please enter your name';
}
if (!$_POST['pword']) {
	$errName2 = 'Please enter your password';
}
if (!$_POST['pword2']) {
	$errName3 = 'Please repeat your password';
}


if (!$errName && !$errName2 && !$errName3) {
	echo '<div class="alert alert-success">Thank You!</div>';
	file_put_contents("accounts.pptm",implode(",",[$name,$pword,$wca,$pword==$pword2])."\n",FILE_APPEND | LOCK_EX);
}else{
	echo "<div class='alert alert-danger'>Sorry there was an error registering. Please try again. Error(s): $errName $errName2 $errName3.</div>";
}
?>
