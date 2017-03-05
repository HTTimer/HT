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
<style>
.timeline {
  margin: 0 0 30px 0;
  padding: 0;
  list-style: none;
}
.timeline:before {
  content: '';
  position: absolute;
  top: 0px;
  bottom: 0;
  width: 5px;
  background: #ddd;
  left: 45px;
  border: 1px solid #eee;
  margin: 0;
  -webkit-border-radius: 2px;
  -moz-border-radius: 2px;
  border-radius: 2px;
}
.timeline > li {
  position: relative;
  margin-right: 10px;
  margin-bottom: 15px;
}
.timeline > li:before,
.timeline > li:after {
  display: table;
  content: " ";
}
.timeline > li:after {
  clear: both;
}
.timeline > li > .timeline-item {
  margin-top: 10px;
  border: 0px solid #dfdfdf;
  background: #fff;
  color: #555;
  margin-left: 60px;
  margin-right: 15px;
  padding: 5px;
  position: relative;
  box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.1);
}
.timeline > li > .timeline-item > .time {
  color: #999;
  float: right;
  margin: 2px 0 0 0;
}
.timeline > li > .timeline-item > .timeline-header {
  margin: 0;
  color: #555;
  border-bottom: 1px solid #f4f4f4;
  padding: 5px;
  font-size: 20px;
  line-height: 1.1;
}
.timeline > li > .timeline-item > .timeline-header > a {
  font-weight: 600;
}
.timeline > li > .timeline-item > .timeline-body,
.timeline > li > .timeline-item > .timeline-footer {
  padding: 10px;
}
.timeline > li.time-label > span {
  font-weight: 600;
  padding: 5px;
  display: inline-block;
  background-color: #fff;
  box-shadow: 0 1px 1px rgba(0, 0, 0, 0.5);
  -webkit-border-radius: 4px;
  -moz-border-radius: 4px;
  border-radius: 4px;
}
.timeline > li > .fa,
.timeline > li > .glyphicon,
.timeline > li > .ion {
  box-shadow: 0 1px 1px rgba(0, 0, 0, 0.2);
  width: 30px;
  height: 30px;
  font-size: 15px;
  line-height: 30px;
  position: absolute;
  color: #666;
  background: #eee;
  border-radius: 50%;
  text-align: center;
  left: 18px;
  top: 0;
}
.bg-red,
.bg-yellow,
.bg-aqua,
.bg-blue,
.bg-light-blue,
.bg-green,
.bg-black {
  color: #f9f9f9 !important;
}
.bg-gray {
  background-color: #eaeaec !important;
}
.bg-black {
  background-color: #222222 !important;
}
.bg-red {
  background-color: #f56954 !important;
}
.bg-yellow {
  background-color: #f39c12 !important;
}
.bg-blue {
  background-color: #37AFFF !important;
}
.bg-light-blue {
  background-color: #3c8dbc !important;
}
.bg-green {
  background-color: #00a65a !important;
}

.text-red {
  color: #f56954 !important;
}
.text-yellow {
  color: #f39c12 !important;
}
.text-blue {
  color: #0073b7 !important;
}
.text-light-blue {
  color: #3c8dbc !important;
}
.text-green {
  color: #00a65a !important;
}}</style>
