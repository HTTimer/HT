<html data-ng-app="algxApp" data-ng-controller="algxController">
<head>

  <meta http-equiv="Content-type" content="text/html;charset=UTF-8">
  <meta name="viewport" content="minimal-ui" />

  <title data-ng-bind="alg | title:title">alg.cubing.net</title>

  <meta property="og:image" content="https://alg.cubing.net/social-media-image.png" />

  <link href="../AlgView/alg.cubing.net.css" rel="stylesheet" type="text/css" />
  <link href="../AlgView/viewer.css" rel="stylesheet" type="text/css" />
  <link href="../AlgView/lib/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />

  <!-- twisty.js libraries and code -->
  <script src="../AlgView/twisty.js/lib/jquery-1.11.0.min.js"></script>
  <script src="../AlgView/twisty.js/lib/Three.js"></script>
  <script src="../AlgView/twisty.js/twisty.js"></script>
  <script src="../AlgView/twisty.js/alg/alg_jison.js"></script>
  <script src="../AlgView/twisty.js/alg/alg.js"></script>
  <script src="../AlgView/twisty.js/puzzles/cube.js"></script>

  <!-- alg.cubing.net libraries and code -->
  <script src="../AlgView/lib/angular.js"></script>
  <script src="../AlgView/lib/angular-debounce.js"></script>
  <script src="../AlgView/lib/clipboard.js"></script>
  <script src="../AlgView/lib/elastic.js"></script>
  <script src="../AlgView/alg.cubing.net.js"></script>

  <link href="lib/bootstrap.min.css" rel="stylesheet" />
  <link href="lib/custom.css" rel="stylesheet" />
  <script src="lib/bootstrap.min.js"></script>
</head>
<body>
  <?php
  $login=false;
  include_once("../Website/menu.php");
  ?>
  <div id="toast" style="display:none;">Message.</div>

  <div id="display-wrapper" data-ng-class="{'fullscreen': view.fullscreen, 'algDelayed': algDelayed || setupDelayed, 'invalid': algStatus == 'invalid' || setupStatus == 'invalid'}">

    <div
      id="viewer"
    >
    </div><div id="controls">
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
      >
    </div>

  </div><div id="info-wrapper" data-ng-show="view.infoPane">
    <div id="info">

      <h1>
        <textarea
          id="title"
          data-msd-elastic
          data-ng-trim="false"
          data-ng-model="title"
          placeholder="CMOS CubeView"
          data-debounce="200"
        ></textarea>
      </h1>

      <div data-ng-show="!(view.id == 'playback' && setup == '')">
        <h2 data-ng-bind="type.setup">Setup</h2>
        <textarea
          id="setup"
          class="moves"
          data-ng-model="setup"
          data-ng-trim="false"
          data-ng-class="[setupStatus]"
          data-ng-class="{'invalid': !setupValid, 'hoverHighlight': view.highlightMoveFields}"
          data-msd-elastic
          placeholder="Click here to add {{type.setup_moves}}."
          data-debounce="1000"
          data-debounce-callback="setupDebounce"
          style="height: 2em;"
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
          data-debounce="1000"
          data-debounce-callback="algDebounce"
          style="height: 2em;"
        ></textarea>
        </div>

      </div>
      <div data-ng-show="view.extraControls">

        <div>

          <h2>Settings</h2>
          <div class="section">
            <select
              data-ng-model="puzzle"
              data-ng-options="p.name group for p in puzzle_list"
            ></select><select
              data-ng-model="stage"
              data-ng-options="s.name group by s.group for s in stage_list"
              data-ng-disabled="puzzle.name != '3x3x3'"
            ></select><select
              data-ng-model="type"
              data-ng-options="a.name group by a.group for a in type_list"
            ></select>

            <br>
            Color Scheme:

            <select data-ng-model="scheme" data-ng-options="s.name for s in scheme_list"></select>
            <!--label data-ng-repeat="s in schemes">
              <input
                type="radio"
                data-ng-model="$parent.scheme"
                data-ng-value="s"
              />
              {{s.display}}
            </label-->
            <input class="current_scheme" type="text" data-ng-model="custom_scheme" data-ng-show="scheme.custom" data-ng-value="scheme.scheme"/>
            <input class="current_scheme" type="text" data-ng-show="!scheme.custom" data-ng-readonly="true" data-ng-value="scheme.scheme"/>
          </div>

          <div>
            <h2>Playback Options</h2>
            <div class="section">
              <!--Speed: <input type="range" min="0.1" max="6" step="0.1" style="vertical-align: middle;" data-ng-model="speed"> (<span data-ng-bind="speed">1</span>x)<br>-->
              <input id="hint_stickers" type="checkbox" data-ng-model="hint_stickers" /> <label for="hint_stickers">Hint Stickers</label>
              <!--<input id="hollow" type="checkbox" data-ng-model="hollow" /> <label for="hollow">Hollow</label>-->
            </div>
          </div>

          <div>
            <h2>Tools</h2>
            <div class="section buttons" id="tools">
              <button data-ng-click="expand();">Expand</button><button
                data-ng-click="simplify();">Simplify</button><br><button
                data-ng-click="clear();"><i class="fa fa-square-o"></i> Clear</button><button
                data-ng-click="reset();"><i class="fa fa-power-off"></i> Reset</button><br><button
                data-ng-click="mirrorAcrossM();" title="Mirror across M"><i class="fa fa-arrows-h"></i> Mirror (M)</button><button
                data-ng-click="mirrorAcrossS();" title="Mirror across S"><i class="fa fa-expand"></i> Mirror (S)</button><br><button
                data-ng-click="invert();"><i class="fa fa-backward"></i> Invert</button><!--<button
                data-ng-click="removeComments();">Remove Comments</button><br>--><button
                data-ng-click="image();"><i class="fa fa-image"></i> Image</button><!--<button
                data-ng-click="toggleServiceWorker();"><i class="fa {{serviceWorkerIcon}}"></i> Offline</button>-->
              <center><div id="canvasPNG"></div></center>
            </div>
          </div>
<!--
          <h2>Forum Link
            <button
              id="copyShort"
              class="clipboard"
              data-ng-show="! type.reconstruction"
              style="margin: 0; padding: 2px 6px; width: 2em; font-size: 0.75em">
              <i class="fa fa-clipboard"></i>
            </button>
            <button
              id="copyLong"
              class="clipboard"
              data-ng-show="type.reconstruction"
              style="margin: 0; padding: 2px 6px; width: 2em; font-size: 0.75em"><i
              class="fa fa-clipboard"></i>
            </button>
          </h2>

          <div class="section" id="share">
          <div data-ng-show="! type.reconstruction">
            <input type="text"
              class="sharetext"
              readonly="readonly"
              data-ng-model="share_forum_short"
              onclick="this.focus(); this.select();"
              value="[Short forum link will appear here.]"/>
          </div>
          <div data-ng-show="type.reconstruction"><textarea class="sharetext"
              readonly="readonly"
              onclick="this.focus(); this.select();"
              data-ng-bind="share_forum_long"
            >[Long forum link will appear here.]</textarea>
          </div>
          </div>

          <h2>Examples</h2>
          <div class="section buttons" id="examples">
            <button href="" data-ng-click="demo('mats-4.74');">WR
            </button><button href="" data-ng-click="demo('T-Perm');">T
            </button><button href="" data-ng-click="demo('Sune');">Sune
            </button><button href="" data-ng-click="demo('notation');">Notation
            </button><button onclick="location.href = 'https://www.speedsolving.com/wiki/index.php/OLL'">OLLs
            </button><button onclick="location.href = 'http://www.speedsolving.com/wiki/index.php/PLL'">PLLs</button>
          </div>

          <h2>Info</h2>
          <div class="section buttons" id="info-section">
            <button onclick="location.href = 'https://github.com/cubing/alg.cubing.net/issues/51'">Features
            </button><button onclick="location.href = 'https://github.com/cubing/alg.cubing.net'">GitHub
            </button><button onclick="location.href = 'https://www.speedsolving.com/forum/showthread.php?46468-alg-cubing-net'">speedsolving.com
            </button><button onclick="location.href = './source/alg.cubing.net.zip'">Download
            </button>
        </div>-->
      </div>
    </div>
  </div>
</body>
</html>
