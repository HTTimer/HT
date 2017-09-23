<?php
$name = $_POST['uname'];
$wca = $_POST['wca'];
$pword = $_POST['pass'];
$pword2 = $_POST['pass2'];
$email = $_POST['email'];
$errName="";
$errName2="";
$errName3="";
$errName4="";
$errName5="";

if (!$_POST['uname']||strlen($_POST["uname"])<3) {
	$errName = 'Your username has to have at lease three (3) characters.';
}
if (!$_POST['pass']) {
	$errName2 = 'Please enter your password';
}
if (!$_POST['pass2']) {
	$errName3 = 'Please repeat your password';
}
if ($pword != $pword2) {
	$errName4 = 'The two passwords don\'t match';
}
if (is_dir("Users/$name")){
	$errName5='This username already exists';
}

function q(){
	global $sql;
	global $db;
	mysqli_query($db,$sql);
	echo mysqli_error($db)."<br/>";
}

if (!$errName && !$errName2 && !$errName3 && !$errName4 && !$errName5) {
	echo '<div class="container"><div class="alert alert-success">Thank You! <a href="../index.php">Complete registration.</a></div></div>';
	mkdir("Users/$name");
	for($i=1;$i<12;++$i){
		touch("Users/$name/$i.session");
		file_put_contents("Users/$name/$i.session","[]");
	}


	$sql='INSERT INTO Users (uname,pw,email,wca) VALUES ("'.$name.'","'.$pword.'","'.$email.'","'.$wca.'");';q();

	$uid=mysqli_fetch_assoc(mysqli_query($db,"SELECT id FROM Users WHERE uname='".$name."';"))["id"];
	$sql='INSERT INTO TimeSessions (uid, name, writable, type, active, scrambler, solveType) VALUES ('.$uid.',"2x2x2",0,0,1,1,"2H");';q();
	$sql='INSERT INTO TimeSessions (uid, name, writable, type, active, scrambler, solveType) VALUES ('.$uid.',"3x3x3",0,0,1,2,"2H");';q();
	$sql='INSERT INTO TimeSessions (uid, name, writable, type, active, scrambler, solveType) VALUES ('.$uid.',"4x4x4",0,0,1,21,"2H");';q();
	$sql='INSERT INTO TimeSessions (uid, name, writable, type, active, scrambler, solveType) VALUES ('.$uid.',"5x5x5",0,0,1,30,"2H");';q();
	$sql='INSERT INTO TimeSessions (uid, name, writable, type, active, scrambler, solveType) VALUES ('.$uid.',"6x6x6",0,0,1,38,"2H");';q();
	$sql='INSERT INTO TimeSessions (uid, name, writable, type, active, scrambler, solveType) VALUES ('.$uid.',"7x7x7",0,0,1,45,"2H");';q();
	$sql='INSERT INTO TimeSessions (uid, name, writable, type, active, scrambler, solveType) VALUES ('.$uid.',"Pyraminx",0,0,1,1,"2H");';q();
	$sql='INSERT INTO TimeSessions (uid, name, writable, type, active, scrambler, solveType) VALUES ('.$uid.',"Megaminx",0,0,1,52,"2H");';q();
	$sql='INSERT INTO TimeSessions (uid, name, writable, type, active, scrambler, solveType) VALUES ('.$uid.',"Skewb",0,0,1,53,"2H");';q();
	$sql='INSERT INTO TimeSessions (uid, name, writable, type, active, scrambler, solveType) VALUES ('.$uid.',"Square-1",0,0,1,1,"2H");';q();
	$sql='INSERT INTO TimeSessions (uid, name, writable, type, active, scrambler, solveType) VALUES ('.$uid.',"3x3x3 Onehanded",0,0,1,2,"OH");';q();
	$sql='INSERT INTO TimeSessions (uid, name, writable, type, active, scrambler, solveType) VALUES ('.$uid.',"3x3x3 Blindfolded",0,0,1,2,"BLD");';q();

	$sql="INSERT INTO Configuration (ky,value,uid) VALUES ('TimerTheme','0',$uid);";q();
	$sql="INSERT INTO Configuration (ky,value,uid) VALUES ('TimeStatsPb','0',$uid);";q();
	$sql="INSERT INTO Configuration (ky,value,uid) VALUES ('TimeStatistics','single,mo3,ao5,ao12,ao50,ao100,ao1000,ao10000;single,mo3,ao5,ao12,ao50,ao100,ao500;single,mo3,ao5,mo5,mo10,ao12,mo50;single,mo3,ao5,mo5,mo10,mo12;single,mo3,ao5,mo5,ao12,mo12,ao50;single,mo3,ao5,mo5,mo10,ao12',$uid);";q();
	$sql="INSERT INTO Messages (uid1,uid2,header,content) VALUES (2,$uid,'Welcome','Welcome to your new CMOSTimer account! You successfully completed registration.');";q();

}else{
	echo "<div class='container'><div class='alert alert-danger'>Sorry there was an error registering. Please try again. Error(s): $errName $errName2 $errName3 $errName4 $errName5.</div></div>";
}
?>
