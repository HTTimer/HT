<link rel="stylesheet" type="text/css" href="lib/timeline.css"/>
<div class="container">
  <div class="row ">
      <div class="col-md-offset-2 col-md-8 col-sm-12 top-margin" >
          <h2 style="margin-left:50px;">History of Cube request #<?php echo $_GET["id"]+7; ?></h2>
          <div>
              <ul class="timeline">
                  <li class="time-label">
                      <br />
                      <br />
                  </li>

                  <?php
                  if($_GET["id"]<0)$_GET["id"]=0;

                  function generate($date,$type){
                    if($type==0){
                      $title="Request sent";
                      $body="Your request was sent.";
                    }elseif($type==1){
                      $title="Request seen";
                      $body="Your request was seen by a administrator.";
                    }elseif($type==2){
                      $title="Your request was not accepted.";
                      $body="Reason: The description does not fit the cube model.<br/>
                      Solution: Please edit your description and re-request adding.";
                    }elseif($type==3){
                      $title="Your request was accepted!";
                      $body="Your cube model is now included in our CubeDB.<br/>
                      You can find it in the current HTTimer. It will be included in all future versions.<br/>";
                    }elseif($type==4){
                      $title="Comment";
                      $body="The administrator commented on your request.";
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

                  $data=file_get_contents("../CubeDB/requests/changerequests.json");
                  $data=json_decode($data);
                  $data=$data[$_GET["id"]]->steps;
                  for($i=0;$i<count($data);$i++){
                    echo generate($data[$i]->date,$data[$i]->type);
                  }
                  ?>
                  <li>
                      <i class="fa fa-clock-o"></i>
                  </li>
              </ul>
          </div>
      </div>
  </div>
</div>
