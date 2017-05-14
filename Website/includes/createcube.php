<div class="container" style="margin-top:50px;">
<script>
s=" abcdefghijk2lmnOpqr8stuvwxyzAB0CDEFGHIJKLM-.,N3oPQRSTUVWX7YZ4569{[]}+#*'@~’¹²³¼½¬ł€¶ŧ←↓→øþſðđŋħł«¢„“”1µ·…<>|a»–…·öäüäöäüä";

function ask(){
  company=prompt("Company","MoYu");
  model=prompt("Model","AoLong V2");
}

function convert(a){
  // Very secure encrypting method
  for(var i=0,l=[];i<a.length;++i)
    l.push(s[s.indexOf(a[i])+4]);
  return l.join``;
}

function out(c,m){
  document.getElementById("out").innerHTML=document.getElementById("s").value="<textarea>" +
  convert("0" + JSON.stringify({name:company+" "+model,type:undefined,colors:0})+"EOF"+(+new Date())) +
  "</textarea>";
  document.getElementById("out").style.visibility="visible";
  document.getElementById("save").style.visibility="visible";
}
</script>
<h2>Generate own cube model</h2>
If you use CMOSTimer and have a cube model to add to your virtual collection you can't find, you can generate the code to import here.<br/>
You can also use this to request adding a cube model to HT.<br/>
Begin by clicking "Generate cube" at the bottom.
After putting in the neccessary data, copy and paste the code into the timer:
<div id="out" style="visibility:hidden;"><textarea>You must generate a cube!</textarea></div>
<button onclick="ask();out(company,model);" class="btn btn-default">Generate cube</button>
<br/><br/>
<div id="save" style="visibility:hidden">
  <form class="form-horizontal" action="index.php?show=savecube" method="POST">
    <!--
    Form generated with http://bootsnipp.com/forms
    -->
  <fieldset>

  <!-- Form Name -->
  <legend>Save cube data</legend>

  <div class="form-group">
    <label class="col-md-4 control-label" for="name">Cube name</label>
    <div class="col-md-4">
    <input id="name" name="name" placeholder="" class="form-control input-md" required="required" type="text" maxlength="18"/>
    </div>
  </div>

  <div class="form-group">
    <label class="col-md-4 control-label" for="comment">Comment</label>
    <div class="col-md-4">
      <textarea class="form-control" id="comment" name="comment"></textarea>
    </div>
  </div>

  <div class="form-group">
    <label class="col-md-4 control-label" for="submitoptions">Request adding this cube to HT</label>
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

  <input type="hidden" name="code" value="" id="s"/>

  </fieldset>
  </form>
  <br/>
  <legend>Your saved cubes</legend>
  <table class="table table-condensed table-striped table-hover">
    <thead>
      <tr><td><b>Name</b></td><td><b>Model</b></td><td><b>Code</b></td><td><b>Request Status</b></td></tr>
    </thead>
    <tbody>
      <tr>
        <td>meinerstercube</td><td>MoYu AoLong V2</td><td>F+creqicccNS6ydDS,SrkdYOcPcgSpSuwccF'I8JFov{R5RRvv5ORR[{R</td><td>not requested <button class="btn btn-xs btn-default">Request adding to HT</button></td>
      </tr><tr>
        <td>abc</td><td>DaYan ZhanChi</td><td>F+creqicccHe6erd92erG2lcPcgSpSuwccF'I8JFo{[F}F]{O[vF5[O<}{</td><td>Added to HT 2.8 Beta <a role="button" href="index.php?show=cuberequest&id=0" class="btn btn-xs btn-default">View request log</a></td>
      </tr><tr>
        <td>abcdefghijk2lmnOp</td><td>FangShi ShuanRen V2</td><td>F+creqicccJerkW2ldW2yerVirdYOcPcgSpSuwccF'I8JFoR5Rv<]F}FO}O<<[O5</td><td>Won't be added <a role="button" href="index.php?show=cuberequest&id=1" class="btn btn-xs btn-default">View request log</a></td>
      </tr>
    </tbody>
  </table>
</div>
</div>
