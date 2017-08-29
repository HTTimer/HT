<div class="container">
  <h1>Add Goal</h1>
  <form class="form-horizontal" action="index.php?show=Goals/add_&id=<?php echo $_GET["id"]; ?>" method="POST">
    <fieldset>

  <!-- Appended Input-->
  <div class="form-group">
    <label class="col-md-4 control-label" for="time">Time</label>
    <div class="col-md-4">
      <div class="input-group">
        <input id="time" name="time" class="form-control" placeholder="42" required="required" type="number"/>
        <span class="input-group-addon">ms</span>
      </div>

    </div>
  </div>
  <!-- Button Drop Down -->
  <div class="form-group">
    <label class="col-md-4 control-label" for="formatsolves">Format</label>
    <div class="col-md-4">
      <div class="input-group">
        <div class="input-group-btn">
          <button type="button" id="a" class="btn btn-default dropdown-toggle" onclick="btnclicked()">
            Mean of
          </button>
        </div>
        <input type="hidden" name="formatam" id="formatam" value="m"/>
        <input id="formatsolves" name="formatsolves" class="form-control" placeholder="number of solves" required="required" type="text"/>
      </div>
    </div>
  </div>
  <div class="form-group">
    <label class="col-md-4 control-label" for="submit">Submit</label>
    <div class="col-md-4">
      <button id="submit" name="submit" class="btn btn-success">Submit</button>
    </div>
  </div>
  </fieldset>
  </form>
</div>
<script>
var state=true;//mo:true,ao:false
function btnclicked(){
  state=!state;
  document.getElementById("a").innerHTML=state?"Mean of":"Average of";
  document.getElementById("formatam").setAttribute("value",state?"m":"a");
}
</script>
