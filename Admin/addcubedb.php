<div class="container">
<?php
if(isset($_POST["submit"])){
  $error=[];
  $company=$_POST["company"];
  $name=$_POST["name"];
  $size=$_POST["size"];
  $type=$_POST["type"];

  if(strlen($name)>32){
    array_push($error,"The name is too large! Max size is 32 characters!");
  }

  if(count($error)==0){
    echo '<div class="alert alert-success" role="alert">Your request was submitted!</div>';
    $sql="INSERT INTO CubeDB (cid,name,size,typeid,adminchecked) VALUES ($company,'$name',$size,$type,1);";
    mysqli_query($db,$sql);
    echo mysqli_error($db);
  }else{
    echo '<div class="alert alert-danger" role="alert">'.implode("<br/>",$error).'</div>';
  }
} else {
?>
  <h1>Add cube to CubeDB</h1>
<form class="form-horizontal" action="" method="POST">
  <!--
  Form generated with http://bootsnipp.com/forms
  -->
<fieldset>
<div class="form-group">
  <label class="col-md-4 control-label" for="company">Company</label>
  <div class="col-md-4">
    <select class="form-control" name="company">
      <?php
      $sql="SELECT name,id FROM CubeDBCompany ORDER BY name ASC;";
      $result=mysqli_query($db,$sql);
      while($row=mysqli_fetch_assoc($result)){
        echo "<option value='$row[id]'>$row[name]</option>";
      }
      ?>
    </select>
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="type">Type</label>
  <div class="col-md-4">
    <select class="form-control" name="type">
      <?php
      $sql="SELECT name,id FROM CubeDBTypes ORDER BY name ASC;";
      $result=mysqli_query($db,$sql);
      while($row=mysqli_fetch_assoc($result)){
        echo "<option value='$row[id]'>$row[name]</option>";
      }
      ?>
    </select>
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="name">Cube name</label>
  <div class="col-md-4">
  <input id="name" name="name" placeholder="" class="form-control input-md" required="required" type="text" maxlength="18"/>
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="site">Size [mm]</label>
  <div class="col-md-4">
    <input class="form-control" id="size" name="size"></input>
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="submitoptions">I agree with the rules</label>
  <div class="col-md-4">
    <label class="radio-inline" for="submitoptions-0">
      <input name="submitoptions" id="submitoptions-0" value="0" checked="checked" type="radio"/>
      No
    </label>
    <label class="radio-inline" for="submitoptions-1">
      <input name="submitoptions" id="submitoptions-1" value="1" type="radio"/>
      Yes
    </label>
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="submit"></label>
  <div class="col-md-4">
    <button id="submit" name="submit" class="btn btn-default">Submit</button>
  </div>
</div>

</fieldset>
</form>

<?php
}
?>
</div>
