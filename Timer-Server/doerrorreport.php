<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
<?php
$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];
$human = intval($_POST['human']);
$errName=$errMail=$errMessage=$errHuman="";

// Check if name has been entered
if (!$_POST['name']) {
	$errName = 'Please enter your name';
}

// Check if email has been entered and is valid
if (!$_POST['email'] || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
	$errMail = 'Please enter a valid email address';
}

//Check if message has been entered
if (!$_POST['message']) {
	$errMessage = 'Please enter your message';
}

//Check if simple anti-bot test is correct
if ($human !== 5) {
	$errHuman = 'Your anti-spam is incorrect';
}

if (!$errName && !$errMail && !$errMessage && !$errHuman) {
	echo '<div class="alert alert-success">Thank You! <a href="../Website/index.php">Go Home</a></div>';
	file_put_contents("errors.pptm",implode(",",[$name,$email,$message,$human]).";",FILE_APPEND | LOCK_EX);
}else{
	echo "<div class='alert alert-danger'>Sorry, there was an error sending your message. Please try again later. Error(s): $errName $errMail $errMessage $errHuman.</div>";
}
?>
