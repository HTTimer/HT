<link rel="stylesheet" type="text/css" href="lib/timeline.css"/>
<div class="container">
  <div class="row">
      <div class="col-md-offset-2 col-md-8 col-sm-12 top-margin" >
          <h2 style="margin-left:50px;">History of Alg request #<?php echo $_GET["id"]; ?></h2>
          <div>
              <ul class="timeline">
                  <li class="time-label">
                      <br/><br/>
                  </li>

                  <?php
                  $id=$_GET["id"];

                  function generate($data){
                    if(count(explode(",",$data))<2)return;
                    global $case;
                    global $algorithm;

                    $date=explode(",",$data)[1];
                    $type=explode(",",$data)[0];
                    if($type==0){
                      $title="Request sent";
                      $body="Your request was sent. Request details:<br/>Case: $case<br/>Algorithm: $algorithm<br/>Database: CMOSAlgDB/Public";
                    }elseif($type==1){
                      $title="Request seen";
                      $body="Your request was seen by a administrator.";
                    }elseif($type==2){
                      $title="Your request was not accepted.";
                      $body="Possible reasons are:
                      <ul><li>The alg does not work<li>The alg is a dublicate<li>The alg uses nonstandard notation";
                    }elseif($type==3){
                      $title="Your request was accepted!";
                      $body="Your cube model is now included in CMOSAlgDB. Thank you for your contribution!";
                      // @TODO write ID into Finished-File for easier sorting later on
                    }elseif($type==4){
                      $title="Comment";
                      $body="The administrator commented on your request. The message is:<br/>'".explode(",",$data)[2]."'";
                    }else{
                      $title="Error";
                      $body="HTSoftware encountered an internal error.";
                    }
                    return '<li>
                        <i class="fa fa-user bg-'.($type==3?"green":($type==2?"red":"grey")).'"></i>
                        <div class="timeline-item">
                            <span class="time"><i class="fa fa-clock-o"></i>'.$date.'</span>
                            <h3 class="timeline-header">'.$title.'</h3>
                            <div class="timeline-body">
                                '.$body.'
                            </div>
                        </div>
                    </li>';
                  }

                  $data=file_get_contents("../AlgDB/addrequests/$id");
                  $data=explode("\n",$data);
                  $algorithm=$data[0];
                  $case=$data[1];
                  for($i=2;$i<count($data);$i++){
                    echo generate($data[$i]);
                  }
                  ?>
                  <li>
                      <i class="fa fa-clock-o"></i>
                  </li>
              </ul>
          </div>
      </div>
  </div>
  <?php
  if($isAdministrator){
  ?>
  <div class="row">
    <div class="col-md-offset-2 col-md-8 col-sm-12 top-margin" >
      <div class="btn-group" role="group">
        <br/>
        <button class="btn btn-success" onclick="window.location.href='../AlgDB/closerequest.php?yes&id=<?php echo $id; ?>';">Close and accept</button>
        <button class="btn btn-success" onclick="window.location.href='../AlgDB/closerequest.php?no&id=<?php echo $id; ?>';">Close and don't accept</button>
        <button class="btn btn-success" onclick="window.location.href='../AlgDB/commentrequest.php?id=<?php echo $id; ?>';">Comment</button>
        <br/>
      </div>
    </div>
  </div>
  <?php } ?>
</div>
