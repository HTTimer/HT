<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
<?php
$name = $_POST['uname'];
$wca = $_POST['wca'];
$pword = $_POST['pword'];
$pword2 = $_POST['pword2'];
$errName="";
$errName2="";
$errName3="";
$errName4="";
$errName5="";

if (!$_POST['uname']||strlen($_POST["uname"])<3) {
	$errName = 'Your username has to have at lease three (3) characters.';
}
if (!$_POST['pword']) {
	$errName2 = 'Please enter your password';
}
if (!$_POST['pword2']) {
	$errName3 = 'Please repeat your password';
}
if ($pword != $pword2) {
	$errName4 = 'The two passwords don\'t match!';
}
if (is_dir("../Users/$name")){
	$errName5='This username already exists!';
}


if (!$errName && !$errName2 && !$errName3 && !$errName4 && !$errName5) {
	echo '<div class="alert alert-success">Thank You! <a href="../index.php">Complete registration.</a></div>';
	file_put_contents("accounts.pptm",",".json_encode([$name,$pword,$wca,$pword==$pword2]),FILE_APPEND|LOCK_EX);
	mkdir("../Users/$name");
	touch("../Users/$name/Algsets");
	touch("../Users/$name/Collection");
	touch("../Users/$name/Data");
	touch("../Users/$name/PBs");
	touch("../Users/$name/Pointlog");
	touch("../Users/$name/Preferences");
	touch("../Users/$name/Timersave");
	file_put_contents("../Users/$name/Timersave",'{"timeList":[[],[],[],[],[],[],[],[],[],[],[],[],[],[],[],[],[]],"currentScrambler":"333","customScramblerList":[],"algSets":[],"goals":[],"sessionData":[{"phases":1,"inspection":0,"name":"2x2x2","solveType":"normal","method":"","scrambleType":"222jsss","cube":[null,"no cube"],"scramblerType":"333jsss"},{"phases":1,"inspection":0,"name":"3x3x3","solveType":"normal","method":"","scrambleType":"333jsss","cube":[null,"no cube"]},{"phases":1,"inspection":0,"name":"4x4x4","solveType":"normal","method":"","scrambleType":"444jsss","cube":[null,"no cube"]},{"phases":1,"inspection":0,"name":"5x5x5","solveType":"normal","method":"","scrambleType":"555jsss","cube":[null,"no cube"]},{"phases":1,"inspection":0,"name":"6x6x6","solveType":"normal","method":"","scrambleType":"666jsss","cube":[null,"no cube"]},{"phases":1,"inspection":0,"name":"7x7x7","solveType":"normal","method":"","scrambleType":"777jsss","cube":[null,"no cube"]},{"phases":1,"inspection":0,"name":"Pyraminx","solveType":"normal","method":"","scrambleType":"Pyra","cube":[null,"no cube"]},{"phases":1,"inspection":0,"name":"Megaminx","solveType":"normal","method":"","scrambleType":"Mega","cube":[null,"no cube"]},{"phases":1,"inspection":0,"name":"3x3x3 Onehanded","solveType":"OH","method":"","scrambleType":"333","cube":[null,"no cube"]},{"phases":1,"inspection":0,"name":"3x3x3 BLD","solveType":"BLD","method":"","scrambleType":"333","cube":[null,"no cube"]},{"phases":1,"inspection":0,"name":"4x4x4 BLD","solveType":"BLD","method":"","scrambleType":"444","cube":[null,"no cube"]},{"phases":1,"inspection":0,"name":"5x5x5 BLD","solveType":"BLD","method":"","scrambleType":"555","cube":[null,"no cube"]},{"phases":1,"inspection":0,"name":"3x3x3 MBLD","solveType":"BLD","method":"","scrambleType":"333","cube":[null,"no cube"]},{"phases":1,"inspection":0,"name":"Square-1","solveType":"normal","method":"","scrambleType":"Square1","cube":[null,"no cube"]},{"phases":1,"inspection":0,"name":"Skewb","solveType":"normal","method":"","scrambleType":"Skewb","cube":[null,"no cube"]},{"phases":1,"inspection":0,"name":"3x3x3 Fewest moves","solveType":"normal","method":"","scrambleType":"333","cube":[null,"no cube"],"scramblerType":"333"},{"phases":1,"inspection":0,"name":"3x3x3 Feet","solveType":"FT","method":"","scrambleType":"333jsss","cube":[null,"no cube"]}],"currentSession":0}');
	touch("../Users/$name/Tmp");
}else{
	echo "<div class='alert alert-danger'>Sorry there was an error registering. Please try again. Error(s): $errName $errName2 $errName3 $errName4.</div>";
}
?>
