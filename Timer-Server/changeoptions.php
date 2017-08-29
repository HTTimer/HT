<?php
$db=mysqli_connect("localhost","CMOSSystem","test");
mysqli_set_charset($db,"utf8");
mysqli_select_db($db,"CMOS");

if (mysqli_connect_errno()){
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$login=isset($_COOKIE["HTTimer-login"]);
if($login)
  $username=$_COOKIE["HTTimer-login"];
else
  $username="testuser3";
$change=$_POST["change"];
//$userfile=explode("\n",file_get_contents("../Users/$username/Preferences"));
//TimerTheme, TimeStatistics, TimeStatsPb
if($change=="theme"){
  $sql="UPDATE Configuration SET value='$_POST[value]' WHERE uid=1 AND ky='TimerTheme';";
  $result=mysqli_query($db,$sql);
}else if($change=="timelist"){
  echo $_POST["session"];
  file_put_contents("../Users/CMOSTimer-developer/".($_POST["session"]+1).".session",$_POST["value"]);
  //file_put_contents("totalsolves",file_get_contents("totalsolves")+1);
  //file_put_contents("../Users/$username/Totalsolves",file_get_contents("../Users/$username/Totalsolves")+1);
}else if($change=="timestatistics"){
  $sql="UPDATE Configuration SET value='$_POST[value]' WHERE uid=1 AND ky='TimeStatistics';";
  $result=mysqli_query($db,$sql);
}else if($change=="timestatspb"){
  $sql="UPDATE Configuration SET value='$_POST[value]' WHERE uid=1 AND ky='TimeStatsPb';";
  $result=mysqli_query($db,$sql);
}

mysqli_close($db);
?>
