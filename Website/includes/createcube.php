<?php
die("This feature will be added in the near future.");
?><div class="container" style="margin-top:50px;">
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
</div><!--most important information:
I developed a cubing timer, collection manager and algorithm system. You can open it here (http://cmostimer.000webhostapp.com/CMOSTimer) and view the source code at github (https://github.com/HTTimer/HT/tree/develop). You can register your own account, or use the following test login data:

Username: testuser2
Password: test

Continue here for more information (you don't need to read this)

The "Cubing management and optimization system" includes an algorithm database, timer and cube collection.

The algorithm database is meant to be an alternative to algdb with a better structure and the ability to select the orientation of the case you prefer. It can also generate memorization help for some algorithms. It currently has PLL, OLL, F2L, ZBLL COLL and some 4x4 Parity algorithms.

The timer is nearly at the level of csTimer. It features sessions for all WCA-Events, more than 50 scramble generators, tracks time, method and cube you used and can generate statistics from this data. A lot of options allow you to change time format, inspection, colors and more. You can import from csTimer. The data is saved automatically on the server and is connected with your account.

The collection feature needs some work, but is meant to give an overview of your collection, find the cheapest cubes, generate lists of solves per cube and maybe make suggestion of what cubes you may like. A database of some cube types is included as cubeDB. It works as it is giving information about company, model name, type and size (planned: cube store availability and prices), but does not have all speedcubes listed yet.

To continue development on useful things, I would like to get your feedback what I should improve or what new stuff is worth adding. You can send it here, write me a message on speedsolving or reddit or open an issue in github.


Rubiks cube timing and progress optimization system

My project idea is a system for optimizing your progress in speedsolving Rubik's cubes. Optimizing should include:
- measure your times and get statistics like best single time or global average
- recreate your collection of puzzles virtually and find the cheapest way of upgrading the hardware
- suggest ways of improving based on your average and execution time of your algorithms

For that, a few more things are needed:
- database of the most common cube models (and the ability for users to create their own)
- database of algorithms
- account management system for accounts to store data for each user individually

You don't need to be able to solve a Rubik's cube or have one to be able to contribute to this project. I chose this topic because it has a lot of possible features and is something some people need.
It is possible to learn a lot of things with this project: managing a project, website building and designing, databases, ...

As the whole thing is going to be a Website/Web application, it is helpful to understand at least the basics of HTML, CSS and JavaScript. The server-side part is PHP maybe. Having at least one person knowing databases (SQL?) and how to connect them to PHP is helpful, as I only know about storing data in text files.
I already have experience in parts of the idea like the time measurement system, but the whole project is a bit too big for me.
If you're interested now, please join!
-->
