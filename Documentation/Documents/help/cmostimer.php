<div class="container">
  <h1 onclick="show('index');">CMOSTimer help</h1>
  <div id="index">
    <li onclick="show('uioverview');">Show UI Overview</li>
    <li onclick="show('options');">Show Options help</li>
    <li onclick="show('scrambler');">Show Scrambler help</li>
  </div>
  <!-- UI Overview -->
  <div id="uioverview">
    <h2>UserInterface overview</h2>
    <img src="../Documentation/Documents/help/overview.jpeg" width="100%"/>
    <br/>
    <ol>
      <li onclick="show('versionnumber');">Version Number</li>
      <li>Time list</li>
      <li>"Select scrambler" button</li>
      <li>Current scramble</li>
      <li>Sesssion, Type, Method and cube</li>
      <li>"Next scramble >" button</li>
      <li>Statistics</li>
      <li>Scramble image</li>
      <li>"Details" button</li>
      <li>Solve ID and Penalty buttons</li>
      <li>Current Time</li>
      <li>Other features</li>
    </ol>
    <br/>
  </div>
  <div id="versionnumber">
    <h2>Version number</h2>
    The version number is a String indicating what version your are using.
    <pre>CMOSTimer V1.0.0 A Alpha Graphic</pre>
    <kbd>CMOSTimer</kbd> means, that you are using CMOSTimer. Really old versions may have <kbd>HTTimer</kbd> written there instead.<br/>
    <kbd>V</kbd> indicates that the following characters up to the next space are the version number.<br/>
    <kbd>1.0.0</kbd> is the Version number.<br/>
    <kbd>A Alpha</kbd> means, that this is an Alpha version. There can also be <kbd>B Beta</kbd> or <kbd>R</kbd>(Released) in there.<br/>
    <kbd>Graphic</kbd> tells you that you have the graphic version.
  </div>

  <!-- Options help -->
  <div id="options">
    Explain the options here.
  </div>
  <div id="option-showscrambleselect">
    <h2>Options: Show scramble select</h2>
    This option shows or hides the "Show scramble" and the "Next scramble >" buttons. The buttons are showed per default.<br/>
    <ol>
      <li>Open the options menu. <a nohref="nohref" onclick="show('openoptions');">Click here to view how to do that.</a></li>
      <li>Go to the section "Timer", and find "Show scramble select".</li>
      <li>Click the button "Disable" or "Enable" to Disable or Enable the scrambler select button.</li>
      <li>Close the options.</li>
      <li>Refresh the displayed scramble.  You can do that by doing a solve, clicking the "next scramble" button or switching to another session.</li>
    </ol>
  </div>
  <div id="openoptions">
    <h2>Options: open the options menu</h2>
    Click "Options" at the bottom left.
  </div>

  <!-- Scrambler help -->
  <div id="scrambler">
    <h2>The scrambler</h2>
    <h3>Description</h3>
    The scrambler is a part of CMOSTimer, that tells you, what moves to apply to the puzzle before solving. The moves are written to the top middle.<br/>
    You can select the scrambler by clicking the "select scramble" button.<br/>
    To see, where these buttons are, look at the <a nohref="nohref" onclick="show('uioverview');">UI overview</a>.<br/>
    <h3>Scramble type</h3>
    The scramble type determines what algorithm to use to get the scramble move sequence. The type is assigned to a session, that means you always have the same type in a session (as long as you don't change the scramble type), even if you did solves on another session in between.<br/>
    <h3>Changing the scramble type</h3>
    <ol>
      <li>Click "Select scrambler".</li>
      <li>Select the shape the puzzle you want to have a scrambler for has by clicking.</li>
      <li>Select the number of axis the puzzle you want to have a scrambler for has by clicking.</li>
      <li>Select the number of layers the puzzle you want to have a scrambler for has by clicking.</li>
      <li>Select the algorithm effect you want to have by clicking. <kbd>&lt;R,U,F&gt;</kbd> means, that only moves on the faces of R, U and F are used. This sometimes intentionally keeps parts of the puzzle solved.</li>
    </ol>
    <img src="../Documentation/Documents/help/scramble-select.png" width="42%"/>
    <h3>Other questions</h3>
    To find out, what scramble types are used, when performing a setup using the "Setup"-Dialog, look <a nohref="nohref" onclick="show('setup');">here</a>.<br/>
    If you can't find the "select scrambler" button, look <a nohref="nohref" onclick="show('option-showscrambleselect');">here</a>.
  </div>

  <!-- other -->
  <div id="setup">
    <h1>Setup dialog</h1>

    What scramble types are used?
  </div>
</div>
<style>
h1 {
  font-size: 50px;
}
.container > div {
  display:none;
}
li[onclick] {
  text-decoration: underline;
  cursor: pointer;
}
<?php if(isset($_GET["timerembed"])){ ?>
nav {
  display:none !important;
}
<?php } ?>
</style>
<script>
var current="index";
function show(a){
  document.getElementById(current).style.display="none";
  current=a;
  document.getElementById(current).style.display="block";
}
show(current);
</script>
