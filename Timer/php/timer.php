<?php
// Read preference file
//$preference_file="../Users/$username/Preferences";
//$preferences=file_get_contents($preference_file);

// Define preferenes and defaults
$prefs="";

// Get significant key-value pairs
$sql="SELECT ky,value FROM Configuration WHERE uid=$uid;";
$result=mysqli_query($db,$sql);
while($row=mysqli_fetch_assoc($result)){
  $prefs.='"'.$row["ky"].'":"'.$row["value"].'",';
}
$prefs.="'a':0";

// Read Collection file
$sql="SELECT c.id, d.name, e.name as company, f.name as color
FROM Collection c
INNER JOIN CubeDB d on c.cid = d.id
INNER JOIN CubeDBCompany e on d.cid = e.id
INNER JOIN CubeDBColors f on c.color = f.id
WHERE uid=$uid;";
$collectionString=[];
$result=mysqli_query($db,$sql);
while($row=mysqli_fetch_assoc($result)){
  array_push($collectionString,'{"company":"'.$row["company"].'","model":"'.$row["name"].'","color":"'.$row["color"].'","identifier":'.$row["id"].'}');
}

// Build Collection JSON
$collectionString=implode(",",$collectionString);

function scramblertotype($id){
  $sql="SELECT * FROM Scrambler WHERE id=$id;";
  global $db;
  $result=mysqli_query($db,$sql);
  $cnt=0;
  while($row=mysqli_fetch_assoc($result)){
    return substr($row["action"],1);
  }
}

// Get Session data
$sessions=[];
$sql="SELECT t.name,t.scrambler,t.solveType,m.name AS method FROM TimeSessions t INNER JOIN Methods m ON m.id=t.method WHERE t.uid=$uid;";
$result=mysqli_query($db,$sql);
$cnt=0;
while($row=mysqli_fetch_assoc($result)){
  $cnt++;
  array_push($sessions,'{"phases":1,"inspection":0,"solveType":"'.$row["solveType"].'","method":"'.$row["method"].'","scrambleType":"'.scramblertotype($row["scrambler"]).'","cube":[null,"no cube"],"scramblerType":"'.scramblertotype($row["scrambler"]).'","name":"'.$row["name"].'"}');
}
$sessions=implode(",",$sessions);

// Get TimeListData
$timeListData=[];
for($i=1;$i<$cnt+1;++$i){
  $timeListData_file="Users/$username/".$i.".session";
  array_push($timeListData,file_get_contents($timeListData_file));
}
$timeListData2=implode(",",$timeListData);
?>
