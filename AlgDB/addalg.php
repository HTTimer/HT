<div class="container">
  <h1>Add algorithm to CMOSAlgDb</h1>
  <form class="form-horizontal" method="POST" action="index.php?show=AlgDB/addalg_&set=<?php echo $_GET["set"]; ?>&alg=<?php echo $_GET["alg"]; ?>">
    <fieldset>

    <div class="form-group">
      <label class="col-md-4 control-label" for="alg">Algorithm</label>
      <div class="col-md-4">
      <input id="alg" name="alg" placeholder="Your algorithm here" class="form-control input-md" required="required" type="text" />

      </div>
    </div>

    <div class="form-group">
      <label class="col-md-4"></label>
      <div class="col-md-4">
        <label class="checkbox-inline">
          The following is true for my algorithm:<ul><li>The algorithm solves the case.<li>The algorithm is written in conventional notation.<li>The algorithm does not exist in CMOSAlgDb currently.</ul>
        </label>
      </div>
    </div>

    <div class="form-group">
      <label class="col-md-4 control-label" for="check">I agree</label>
      <div class="col-md-4">
        <label class="checkbox-inline" for="check-0">
          <input name="check" id="check-0" value="Yes" type="checkbox" />
          Yes
        </label>
      </div>
    </div>

    <div class="form-group">
      <label class="col-md-4 control-label" for="submit">Add</label>
      <div class="col-md-4">
        <input type="submit" id="submit" name="submit" class="btn btn-success" />
      </div>
    </div>

    </fieldset>
  </form>

</div>
