<div class="container">
  <h1>Change session &lt;new session&gt;</h1>
  <form class="form-horizontal" method="POST" action="index.php?show=Timerconfig/sessions_add_">
    <div class="form-group">
      <label class="col-md-4 control-label" for="name">Session name</label>
      <div class="col-md-4">
        <input id="name" name="name" placeholder="pizza" class="form-control input-md" type="text" maxlength="32"/>
      </div>
    </div>

    <div class="form-group">
      <label class="col-md-4 control-label" for="s">Solve type</label>
      <div class="col-md-4">
        <select id="s" name="solvetype" class="form-control input-md">
          <option>2H</option>
          <option>OH</option>
          <option>BLD</option>
          <option>OH BLD</option>
          <option>FT</option>
          <option>FMC</option>
        </select>
      </div>
    </div>

    <div class="form-group">
      <label class="col-md-4 control-label" for="opt">Options</label>
      <div class="col-md-4">
      <div class="checkbox">
        <label for="opt-0">
          <input name="opt" id="opt-0" value="1" type="checkbox"/>
          Deactivate
        </label>
    	</div>
      </div>
    </div>

    <div class="form-group">
      <label class="col-md-4 control-label" for="submit">Submit</label>
      <div class="col-md-4">
        <button id="submit" name="submit" class="btn btn-success">Add</button>
      </div>
    </div>

  </form>
</div>
