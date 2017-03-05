<div class="container">
  <?php
  $cid=$_GET["cid"];
  $id =$_GET["id" ];
  ?>
<form class="form-horizontal" action="index.php?show=requestchange.php" method="POST">
<fieldset>

  <input type="hidden" name="cid" value="<?php echo $cid; ?>"/>
  <input type="hidden" name="id" value="<?php echo $id; ?>"/>

<!-- Form Name -->
<legend>Request changes to a cube</legend>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="company">Company name</label>
  <div class="col-md-4">
  <input id="company" name="company" value="MoYu" class="form-control input-md" required="required" type="text"/>

  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="model">Model name</label>
  <div class="col-md-4">
  <input id="model" name="model" value="AoLong V2" class="form-control input-md" required="required" type="text"/>

  </div>
</div>

<!-- Appended Input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="size">Edge length</label>
  <div class="col-md-4">
    <div class="input-group">
      <input id="size" name="size" class="form-control" placeholder="57" value="57" required="required" type="text"/>
      <span class="input-group-addon">mm</span>
    </div>

  </div>
</div>
<!-- Multiple Checkboxes -->
<div class="form-group">
  <label class="col-md-4 control-label" for="store">Cube store availability</label>
  <div class="col-md-4">
  <div class="checkbox">
    <label for="store-0">
      <input name="store" id="store-0" value="0" type="checkbox"/>
      TheCubicle.us
    </label>
	</div>
  <div class="checkbox">
    <label for="store-1">
      <input name="store" id="store-1" value="1" type="checkbox"/>
      ZCube.hk
    </label>
	</div>
  <div class="checkbox">
    <label for="store-2">
      <input name="store" id="store-2" value="2" type="checkbox"/>
      Championscubestore.com
    </label>
	</div>
  <div class="checkbox">
    <label for="store-3">
      <input name="store" id="store-3" value="3" type="checkbox"/>
      CubeZZ.com
    </label>
	</div>
  <div class="checkbox">
    <label for="store-4">
      <input name="store" id="store-4" value="4" type="checkbox"/>
      Cubikon.de
    </label>
	</div>
  <div class="checkbox">
    <label for="store-5">
      <input name="store" id="store-5" value="5" type="checkbox"/>
      SpeedCubeShop.com
    </label>
	</div>
  <div class="checkbox">
    <label for="store-6">
      <input name="store" id="store-6" value="" type="checkbox"/>
      TheCubeSpecialists.com
    </label>
	</div>
  </div>
</div>

<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="submit">Request Changes</label>
  <div class="col-md-4">
    <input type="submit" id="submit" name="submit" role="button" class="btn btn-success" value="Submit" />
  </div>
</div>

</fieldset>
</form>
</div>
