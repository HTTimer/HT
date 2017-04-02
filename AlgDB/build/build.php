<?php
include("addcase.php");
include("addset.php");
include("addalgorithms.php");

// Uncomment the following code to get all AlgSet data from AlgDB.net

/*addset("PLL");
addcases("PLL",["Aa","Ab","E","F","Ga","Gb","Gc","Gd","H","Ja","Jb","Jb","Na","Nb","Ra","Rb","T","Ua","Ub","V","Y","Z"]);
addalgorithms("PLL",["Aa","Ab","E","F","Ga","Gb","Gc","Gd","H","Ja","Jb","Jb","Na","Nb","Ra","Rb","T","Ua","Ub","V","Y","Z"]);

addset("OLL");
addcases("OLL",["OLL 1","OLL 2","OLL 3","OLL 4","OLL 6","OLL 6","OLL 7","OLL 8","OLL 9","OLL 10",
                "OLL 11","OLL 12","OLL 13","OLL 14","OLL 16","OLL 16","OLL 17","OLL 18","OLL 19","OLL 20",
                "OLL 21","OLL 22","OLL 23","OLL 24","OLL 26","OLL 26","OLL 27","OLL 28","OLL 29","OLL 30",
                "OLL 31","OLL 32","OLL 33","OLL 34","OLL 36","OLL 36","OLL 37","OLL 38","OLL 39","OLL 40",
                "OLL 41","OLL 42","OLL 43","OLL 44","OLL 46","OLL 46","OLL 47","OLL 48","OLL 49","OLL 50",
                "OLL 51","OLL 52","OLL 53","OLL 54","OLL 56","OLL 56","OLL 57"]);
echo addalgorithms("OLL",["OLL 1","OLL 2","OLL 3","OLL 4","OLL 6","OLL 6","OLL 7","OLL 8","OLL 9","OLL 10",
                "OLL 11","OLL 12","OLL 13","OLL 14","OLL 16","OLL 16","OLL 17","OLL 18","OLL 19","OLL 20",
                "OLL 21","OLL 22","OLL 23","OLL 24","OLL 26","OLL 26","OLL 27","OLL 28","OLL 29","OLL 30",
                "OLL 31","OLL 32","OLL 33","OLL 34","OLL 36","OLL 36","OLL 37","OLL 38","OLL 39","OLL 40",
                "OLL 41","OLL 42","OLL 43","OLL 44","OLL 46","OLL 46","OLL 47","OLL 48","OLL 49","OLL 50",
                "OLL 51","OLL 52","OLL 53","OLL 54","OLL 56","OLL 56","OLL 57"]);
addset("F2L");
$list=[];
for($i=1;$i<42;++$i)array_push($list,"F2L ".$i);
print_r($list);
addcases("F2L","F2L",$list);
echo addalgorithms("F2L",$list);

addset("COLL");
addcases("COLL",["T1","T2","T3","T4","T5","T6"]);
addcases("COLL",["U1","U2","U3","U4","U5","U6"]);
addcases("COLL",["L1","L2","L3","L4","L5","L6"]);
addcases("COLL",["S1","S2","S3","S4","S5","S6"]);
addcases("COLL",["AS1","AS2","AS3","AS4","AS5","AS6"]);
addcases("COLL",["H1","H2","H3","H4"]);
addalgorithmsN("COLL","COLL T",["F1","F2","F3","F4","F5","F6"],["T1","T2","T3","T4","T5","T6"]);
addalgorithmsN("COLL","COLL U",["E1","E2","E3","E4","E5","E6"],["U1","U2","U3","U4","U5","U6"]);
addalgorithmsN("COLL","COLL L",["D1","D2","D3","D4","D5","D6"],["L1","L2","L3","L4","L5","L6"]);
addalgorithmsN("COLL","COLL S",["C1","C2","C3","C4","C5","C6"],["S1","S2","S3","S4","S5","S6"]);
addalgorithmsN("COLL","COLL AS",["B1","B2","B3","B4","B5","B6"],["AS1","AS2","AS3","AS4","AS5","AS6"]);
addalgorithmsN("COLL","COLL H",["H1","H2","H3","H4"],["H1","H2","H3","H4"]);

addset("ZBLL");
$list=[];
for($i=1;$i<73;++$i)array_push($list,"ZBLL T ".$i);
addcases("ZBLL",$list);
addalgorithmsN("ZBLL","ZBLL T",$list,$list);
$list=[];
for($i=1;$i<73;++$i)array_push($list,"ZBLL U ".$i);
addcases("ZBLL",$list);
addalgorithmsN("ZBLL","ZBLL U",$list,$list);
$list=[];
for($i=1;$i<73;++$i)array_push($list,"ZBLL L ".$i);
addcases("ZBLL",$list);
addalgorithmsN("ZBLL","ZBLL L",$list,$list);
$list=[];
for($i=1;$i<73;++$i)array_push($list,"ZBLL Pi ".$i);
addcases("ZBLL",$list);
addalgorithmsN("ZBLL","ZBLL Pi",$list,$list);
$list=[];
for($i=1;$i<73;++$i)array_push($list,"ZBLL S ".$i);
addcases("ZBLL",$list);
addalgorithmsN("ZBLL","ZBLL S",$list,$list);
$list=[];
for($i=1;$i<73;++$i)array_push($list,"ZBLL AS ".$i);
addcases("ZBLL",$list);
addalgorithmsN("ZBLL","ZBLL AS",$list,$list);
$list=[];
for($i=1;$i<40;++$i)array_push($list,"ZBLL H ".$i);
addcases("ZBLL",$list);
addalgorithmsN("ZBLL","ZBLL H",$list,$list);*/
?>
