<?php
$price=3.58;
$title="QiYi Skewb";
$color="black";
$mag=false;
$package=true;
$data=[
  [3.58,"QiYi Skewb","black",false,false,"http://www.championscubestore.com/images/s/201607/14674500770.jpg"],
  [0.94,"YJ GuanLong Skewb","black",false,false,"http://www.championscubestore.com/images/s/201612/1481027915IgH.JPG"],
  [1.36,"YJ GuanLong Square-1","black",false,false,"http://www.championscubestore.com/images/s/201609/14733987462Kn.JPG"],
  [1.44,"ShengShou Aurora 2x2","black",false,false,"http://www.championscubestore.com/images/s/201408/14094938380.jpg"],
  [ .59,"ShengShou old 2x2","black",false,false,"http://www.championscubestore.com/images/s/201107/13111592580.jpg"],
  [ .44,"YJ GuanLong 3x3","black",false,false,"http://www.championscubestore.com/images/s/201411/14148462750.jpg"],
  [2.79,"YJ YuHu Megaminx","black",false,false,"http://www.championscubestore.com/images/s/201509/14430120940.jpg"],
  [1.97,"MF5","stickerless",false,false,"http://www.championscubestore.com/images/s/201703/1489412602AB7.JPG"],
  [2.79,"MF5s","stickerless",false,false,"http://www.championscubestore.com/images/s/201610/1476756215KyU.jpg"],
  [9.33,"QiYi WuShuang 5x5","black",false,true,"http://www.championscubestore.com/images/s/201607/14694488320.jpg"],
  [ .44,"YJ GuanLong 3x3","black",false,false,"http://www.championscubestore.com/images/s/201411/14148462750.jpg"],
  [ .44,"YJ GuanLong 3x3","black",false,false,"http://www.championscubestore.com/images/s/201411/14148462750.jpg"]
];
?>
<!doctype html>
<html>
<head>
  <script src="../lib/jquery.min.js"></script> <!-- JQuery 3.1.1 -->
  <link href="../lib/bootstrap.min.css" rel="stylesheet" />
  <link href="../lib/custom.css" rel="stylesheet" />
  <link rel="stylesheet" href="../lib/cubing-icons.css" />
  <link rel="stylesheet" href="../lib/font.css" />
  <script src="../lib/bootstrap.min.js"></script>
  <script src="../lib/tablefilter.js"></script>
</head>
<body>
  <div class="container">
    <h1>Shop</h1>
    <?php
    $g=0;
    for($i=0;$i<count($data);++$i){
      $price=$data[$i][0];
      $title=$data[$i][1];
      $color=$data[$i][2];
      $mag=$data[$i][3];
      $package=$data[$i][4];
      $img=$data[$i][5];
      $g+=round((1+$price*2+($mag?7:0))*2)/2;
    ?>
      <div class="row">
        <div class="col-md-5">
          <h3><?php echo $title; ?></h3>
          <ul>
            <li>Color: <?php echo $color; ?></li>
            <li><?php echo $mag?"":"not "; ?>magnetised<!--, magnetisation cost $7<?php echo $mag?"included":""; ?>--></li>
            <li><?php echo $package?"":"not "; ?>in original package</li>
          </ul>
        </div>
        <div class="col-md-3">
          <h4><b><?php echo round((1+$price*2+($mag?7:0))*2)/2; ?>&euro;</b></h4>
          <br/>
          <br/>
          Order ID: <?php echo $i; ?>
        </div>
        <div class="col-md-2"></div>
        <div class="col-md-3"><img src="<?php echo $img; ?>" height="150"/></div>
      </div>
    <?php
    }
    echo "<!--Gesamtwert: $g €-->";
    ?>
  </div>
</body>
</html>
