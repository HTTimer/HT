<div class="container">
<?php
if(isset($_POST["submit"])){
  $content=mysqli_real_escape_string($db,$_POST["content"]);
  $header=mysqli_real_escape_string($db,$_POST["header"]);
  $user=$_POST["to"];
  $error=[];
  if(strlen($content)>65535){
    array_push($error,"Content has a maxlength of 65535 bytes");
  }
  if(strlen($header)>31){
    array_push($error,"Header has a maxlength of 32 bytes");
  }
  $sql="SELECT * FROM Users WHERE uname='$user';";
  $result=mysqli_query($db,$sql);
  if(mysqli_num_rows($result)<1){
    array_push($error,"Cound not find user $user");
  }else{
    $row=mysqli_fetch_assoc($result);
    $lol=$row["id"];
  }
  if(count($error)==0){
    echo '<div class="alert alert-success" role="alert">Your message was submitted</div>';
    $sql="INSERT INTO Messages (uid1,uid2,header,content) VALUES ($uid,$lol,'$header','$content');";
    $result=mysqli_query($db,$sql);
    echo mysqli_error($db);
  }else{
    echo '<div class="alert alert-danger" role="alert">'.implode("<br/>",$error).'</div>';
  }
}else{
?>
<h1>Write a message</h1>
<form class="form-horizontal" method="POST">
<fieldset>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="to">To User:</label>
  <div class="col-md-4">
  <input id="to" name="to" placeholder="Username" class="form-control input-md" required="" type="text"/>
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="header">Header</label>
  <div class="col-md-4">
  <input id="header" name="header" placeholder="" class="form-control input-md" required="required" type="text" maxlength="32"/>
  </div>
</div>

<!-- Textarea -->
<div class="form-group">
  <label class="col-md-4 control-label" for="content">Message</label>
  <div class="col-md-4">
    <textarea class="form-control" id="content" name="content"></textarea>
  </div>
</div>

<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="submit"></label>
  <div class="col-md-4">
    <button id="submit" name="submit" class="btn btn-success">Submit</button>
  </div>
</div>

</fieldset>
</form>
<?php } ?>
</div>
