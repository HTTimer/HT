<html data-ng-app="algxApp" data-ng-controller="algxController">
  <link href="../AlgView/alg.cubing.net.css" rel="stylesheet" type="text/css" />
  <link href="../AlgView/viewer.css" rel="stylesheet" type="text/css" />
  <link href="../AlgView/lib/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
  <script src="../AlgView/twisty.js/lib/jquery-1.11.0.min.js"></script>
  <script src="../AlgView/twisty.js/lib/Three.js"></script>
  <script src="../AlgView/twisty.js/twisty.js"></script>
  <script src="../AlgView/twisty.js/alg/alg_jison.js"></script>
  <script src="../AlgView/twisty.js/alg/alg.js"></script>
  <script src="../AlgView/twisty.js/puzzles/cube.js"></script>
  <script src="../AlgView/lib/angular.js"></script>
  <script src="../AlgView/lib/angular-debounce.js"></script>
  <script src="../AlgView/lib/clipboard.js"></script>
  <script src="../AlgView/lib/elastic.js"></script>
  <script src="../AlgView/alg.cubing.net.js"></script>
  <link href="lib/bootstrap.min.css" rel="stylesheet" />
  <link href="lib/custom.css" rel="stylesheet" />
  <script src="lib/bootstrap.min.js"></script>

  <?php
  include_once("../Website/menu.php");
  ?>
  <div id="toast" style="display:none;">Message.</div>

  <div id="info-wrapper" data-ng-show="view.infoPane">
    <div id="info">

      <h1>
        <textarea
          id="title"
          data-msd-elastic
          data-ng-trim="false"
          data-ng-model="title"
          placeholder="CMOS CubeAlgView"
          data-debounce="200"
        >CMOS CubeAlgView</textarea>
      </h1>

      <h2>Showing <b><?php echo $_GET["algname"]; ?></b> from set <b><?php echo $_GET["set"]; ?></b></h2>

      <div data-ng-show="!(view.id == 'playback' && setup == '')">
        <h2 data-ng-bind="type.setup">Setup (Inverse Algorithm)</h2>
        <textarea
          id="setup"
          class="moves"
          data-ng-model="setup"
          data-ng-trim="false"
          data-ng-class="[setupStatus]"
          data-ng-class="{'invalid': !setupValid, 'hoverHighlight': view.highlightMoveFields}"
          data-msd-elastic
          placeholder="Click here to add {{type.setup_moves}}."
          data-debounce="400"
          data-debounce-callback="setupDebounce"
          style="height: 4em;"
          disabled="disabled"
        ></textarea>
      </div>

      <div>
        <h2><span data-ng-bind="type.alg">Algorithm</span><span id="metrics">
                (<span data-ng-bind="obtm">0</span>obtm,
                <span data-ng-bind="obqtm">0</span>obqtm,
                <span data-ng-bind="btm">0</span>btm,
                <span data-ng-bind="etm">0</span>etm)
              </span></h2>
        <div id="algorithm_wrapper">
        <div id="algorithm_shadow" class="moves"><span id="start">
          </span><span id="middle" class="highlight" style="display: none;">
          </span></div>
        <textarea
          id="algorithm"
          class="moves"
          data-ng-model="alg"
          data-ng-trim="false"
          data-ng-class="[algStatus]"
          data-ng-class="{'hoverHighlight': view.highlightMoveFields}"
          data-msd-elastic
          placeholder="Click here to add {{type.alg_moves}}."
          autofocus
          data-debounce="400"
          data-debounce-callback="algDebounce"
          style="height: 4em;"
          disabled="disabled"
        ></textarea>
        </div>

      </div>
      <div data-ng-show="view.extraControls">
        <div>
          <div>
            <h2>Options</h2>
            <div class="section">
              <!--Speed: <input type="range" min="0.1" max="6" step="0.1" style="vertical-align: middle;" data-ng-model="speed"> (<span data-ng-bind="speed">1</span>x)<br>-->
              <input id="hint_stickers" type="checkbox" data-ng-model="hint_stickers" /> <label for="hint_stickers">Show Hint Stickers</label>
              <!--<input id="hollow" type="checkbox" data-ng-model="hollow" /> <label for="hollow">Hollow</label>-->
            </div>
          </div
      </div>
    </div>
  </div></div></div><div id="display-wrapper" data-ng-class="{'fullscreen': view.fullscreen, 'algDelayed': algDelayed || setupDelayed, 'invalid': algStatus == 'invalid' || setupStatus == 'invalid'}">

    <div id="viewer"></div>
    <div id="controls">
      <!-- http://localhost/HTTimer/Website/index.php?show=..%2F..%2FAlgView%2Findex&setup=R_U_R-_U-_R-_F_R2_U-_R-_U-_R_U_R-_F-&alg=R_U_R-_U-_R-_F_R2_U-_R-_U-_R_U_R-_F-&set=PLL&algname=T-Perm -->
      <!--<button class="control" id="cycleView" title="Change View" data-ng-click="nextView()">
        <i class="fa fa-cube"></i>
      </button>--><button class="control" id="reset" title="Reset">
        <i class="fa fa-fast-backward">Reset</i>
      </button><button class="control" id="back" title="Back (1 move)">
        <i class="fa fa-mail-reply">Back</i>
      </button><button class="control" id="play" title="Play">
        <i class="fa fa-play" data-ng-show="!animating">Play</i><i class="fa fa-pause" data-ng-show="animating">Pause</i>
      </button><button class="control" id="forward" title="Step forward (1 move)">
        <i class="fa fa-mail-forward">Forward</i>
      </button><button class="control" id="skip" title="Skip to End">
        <i class="fa fa-fast-forward">End</i>
      </button>
    </div><div id="progress">
      <input
        id="currentMove"
        data-ng-model="current_move"
        type="range"
        min="0"
        max="1"
        step="0.01"
      />
    </div>
  </div>
</html>
