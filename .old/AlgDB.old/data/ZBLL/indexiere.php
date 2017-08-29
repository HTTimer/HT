<div class="container"><?php
$cases=explode(",","F2L 1,F2L 2,F2L 3,F2L 4,F2L 5,F2L 6,F2L 7,F2L 8,F2L 9,F2L 10,F2L 11,F2L 12,F2L 13,F2L 14,F2L 15,F2L 16,F2L 17,F2L 18,F2L 19,F2L 20,F2L 21,F2L 22,F2L 23,F2L 24,F2L 25,F2L 26,F2L 27,F2L 28,F2L 29,F2L 30,F2L 31,F2L 32,F2L 33,F2L 34,F2L 35,F2L 36,F2L 37,F2L 38,F2L 39,F2L 40,F2L 41");
$sql="";
for($i=0;$i<count($cases);++$i){
  $sql.="INSERT INTO CMOS.AlgDbCases (name,sid) VALUES ('".str_replace("F2L ","",$cases[$i])."',8);";
  $current=$cases[$i];
  $algorithms=explode("\n",file_get_contents("AlgDB.old/data/F2L/$current/algorithms"));
  for($j=0;$j<count($algorithms);++$j)
    $sql.='INSERT INTO CMOS.AlgDbAlg (cid,alg) VALUES ('.(591+$i).',"'.explode(",",$algorithms[$j])[0].'");';
}
echo $sql."DELETE FROM CMOS.AlgDbAlg WHERE alg='';\n";
?>
</div>
