<div class="container">
  <h1>Register</h1>
  <!--<a href="index.php?show=Timer-Server/register" role="button" class="btn btn-success">Free account</a>-->
  <form class="form-horizontal" method="POST" action="index.php?show=Login/doregister">
    <fieldset>

    <!-- Text input-->
    <div class="form-group">
      <label class="col-md-4 control-label" for="uname">Username</label>
      <div class="col-md-4">
      <input id="uname" name="uname" class="form-control input-md" required="required" type="text"/>

      </div>
    </div>

    <!-- Text input-->
    <div class="form-group">
      <label class="col-md-4 control-label" for="wca">WCA-ID</label>
      <div class="col-md-4">
      <input id="wca" name="wca" class="form-control input-md" type="text"()>

      </div>
    </div>

    <!-- Text input-->
    <div class="form-group">
      <label class="col-md-4 control-label" for="email">E-Mail</label>
      <div class="col-md-4">
      <input id="email" name="email" class="form-control input-md" required="required" type="email"/>

      </div>
    </div>

    <!-- Password input-->
    <div class="form-group">
      <label class="col-md-4 control-label" for="pass">Password</label>
      <div class="col-md-4">
        <input id="pass" name="pass" class="form-control input-md" required="required" type="password"/>

      </div>
    </div>

    <!-- Password input-->
    <div class="form-group">
      <label class="col-md-4 control-label" for="pass2">Repeat password</label>
      <div class="col-md-4">
        <input id="pass2" name="pass2" class="form-control input-md" required="required" type="password"/>

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

</div>
