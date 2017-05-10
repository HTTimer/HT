/*
 * timer.js - main timer file for HTTimer
 * Requires all modules in moduleList
 * Each module is in a file called <moduleName>.js in the folder js.
 */

timer = (function() {
	/*
	 * Timer:Init()
	 *
	 * - Check if all modules have been loaded
	 * - Check Browser
	 * - Try to load data from previous sessions of HT
	 *   - Version check data
	 * - Set global variables
	 * - Write Layout
	 * - Initialize components
	 */

	var moduleList = ["algSets", "cmd", "core", "counter", "cube", "error", "goals", "html", "layout", "scramble", "sessions", "stats", "keyboard", "translate"];
	var version = ["4", "3", "0", "A"]; // This is the development version, the "real" version 1.0.0 starts at 4.3.0A dev. This is because it was renamed from HTTimer to CMOSTimer at Version HT4.3.0A dev.
	version = [version[0] - 3, version[1] - 3, version[2]].join(".") + " " + version[3]; // build the real version

	function init() {
		var i, config, check, html;

		core.init();

		//Let the server check, whether the user is logged in. Assume, the user is not, in case it fails.
		core.set("login", false);
		server.json("../Timer-Server/isloggedin.php", function(t) {
			core.set("login", !!t.response);
		});

		//Check if all modules have been loaded
		for (i = 0; i < moduleList.length; ++i) {
			if (!window[moduleList[i]])
				error.error("LoadError");
		}

		//Check browser
		var isIE = /*@cc_on=true;@*/ false;
		if (isIE) {
			//Do something. I suggest downloading Firefox.  ^_^
		}

		//@TODO: Backup data

		//Try to load data from previous sessions
		//Old versions saves will not get lost, as they save in HTexport, while we
		//save in HTExport and HTAutoSave

		//TEST MODE ONLY: Always start new Session
		config = {
			timeList: [
				[{
					"startTime": 1492862010666,
					"endTime": 1492862011210,
					"currentInspection": 461,
					"zeit": 545,
					"penalty": 0,
					"flags": {
						"fake": false,
						"uwr": false,
						"overinspect": false
					},
					"scramble": "F2 U L F2 D2 B' D' U L R F2 L' U L' F2 R2 F L B' F2",
					"scrambletype": "222jsss",
					"cube": [null, "no cube"],
					"solveType": "normal",
					"method": ""
				}],
				[],
				[],
				[],
				[],
				[],
				[],
				[],
				[],
				[],
				[],
				[],
				[],
				[],
				[],
				[]
			],
			currentScrambler: "333",
			customScramblerList: [],
			algSets: [],
			goals: [],
			sessionData: [{
				"phases": 1,
				"inspection": 0,
				"name": "2x2x2",
				"solveType": "normal",
				"method": "",
				"scrambleType": "222jsss",
				"cube": [null, "no cube"],
				"scramblerType": "222jsss"
			}, {
				"phases": 2,
				"inspection": 0,
				"name": "3x3x3",
				"solveType": "normal",
				"method": "",
				"scrambleType": "333jsss",
				"cube": [null, "no cube"]
			}, {
				"phases": 1,
				"inspection": 0,
				"name": "4x4x4",
				"solveType": "normal",
				"method": "",
				"scrambleType": "444jsss",
				"cube": [null, "no cube"]
			}, {
				"phases": 1,
				"inspection": 0,
				"name": "5x5x5",
				"solveType": "normal",
				"method": "",
				"scrambleType": "555jsss",
				"cube": [null, "no cube"]
			}, {
				"phases": 1,
				"inspection": 0,
				"name": "6x6x6",
				"solveType": "normal",
				"method": "",
				"scrambleType": "666jsss",
				"cube": [null, "no cube"]
			}, {
				"phases": 1,
				"inspection": 0,
				"name": "7x7x7",
				"solveType": "normal",
				"method": "",
				"scrambleType": "777jsss",
				"cube": [null, "no cube"]
			}, {
				"phases": 1,
				"inspection": 0,
				"name": "Pyraminx",
				"solveType": "normal",
				"method": "",
				"scrambleType": "Pyra",
				"cube": [null, "no cube"]
			}, {
				"phases": 1,
				"inspection": 0,
				"name": "Megaminx",
				"solveType": "normal",
				"method": "",
				"scrambleType": "Mega",
				"cube": [null, "no cube"]
			}, {
				"phases": 1,
				"inspection": 0,
				"name": "3x3x3 Onehanded",
				"solveType": "OH",
				"method": "",
				"scrambleType": "333",
				"cube": [null, "no cube"]
			}, {
				"phases": 1,
				"inspection": 0,
				"name": "3x3x3 BLD",
				"solveType": "BLD",
				"method": "",
				"scrambleType": "333",
				"cube": [null, "no cube"]
			}, {
				"phases": 1,
				"inspection": 0,
				"name": "4x4x4 BLD",
				"solveType": "BLD",
				"method": "",
				"scrambleType": "444",
				"cube": [null, "no cube"]
			}, {
				"phases": 1,
				"inspection": 0,
				"name": "5x5x5 BLD",
				"solveType": "BLD",
				"method": "",
				"scrambleType": "555",
				"cube": [null, "no cube"]
			}, {
				"phases": 1,
				"inspection": 0,
				"name": "3x3x3 MBLD",
				"solveType": "BLD",
				"method": "",
				"scrambleType": "333",
				"cube": [null, "no cube"]
			}, {
				"phases": 1,
				"inspection": 0,
				"name": "Square-1",
				"solveType": "normal",
				"method": "",
				"scrambleType": "Square1",
				"cube": [null, "no cube"]
			}, {
				"phases": 1,
				"inspection": 0,
				"name": "Skewb",
				"solveType": "normal",
				"method": "",
				"scrambleType": "Skewb",
				"cube": [null, "no cube"]
			}, {
				"phases": 1,
				"inspection": 0,
				"name": "3x3x3 Fewest moves",
				"solveType": "normal",
				"method": "",
				"scrambleType": "333",
				"cube": [null, "no cube"],
				"scramblerType": "333"
			}],
			currentSession: 0
		};

		//Apply stylesheet
		layout.setTheme(start.timerTheme);
		//Set some variables
		//Set variables using core.set (and core.get to get them) are NOT const and will be exported.
		core.set("running", false);
		core.set("log", "");
		if (typeof core.list.length === "undefined") {
			core.set("importVersion", config && config.version || version);
			core.set("version", version);
			core.set("language", "EN");
			core.set("config", config || core.get("config"));
			core.set("timingMode", "up"); //May be "up", "down". Everything else means "not timing"

			//Write layout. This has absolutely no effect right now
			if (config && config.layout) {
				layout.setFullLayout(config.layout);
			} else {
				layout.setFullLayout("SCRAMBLE", "", "SCRAMBLEIMAGE", "TIMELIST", "TIME|CurrentAo5,CurrentAo12");
			}
		}

		setInterval(core.displayLog, 500);

		//Write text to some places
		layout.write("BOTTOMMENU", `<div class="bottom-menu" onclick="Mousetrap.trigger('o o');"><span class="keycodes">o o (open)/o c (close)</span> Options</div>
			<div class="bottom-menu" onclick="Mousetrap.trigger('g g');"><span class="keycodes">g g (open) g c (close)</span> Goals</div>
			<div class="bottom-menu" onclick="Mousetrap.trigger('a a');"><span class="keycodes">a a/a c</span> AlgSets</div>
			<div class="bottom-menu" onclick="Mousetrap.trigger('i i');"><span class="keycodes">i i/i c</span> Import/Export</div>
			<div class="bottom-menu" onclick="Mousetrap.trigger('l l');"><span class="keycodes">l l/l c</span> Help</div>
			<div class="bottom-menu" onclick="Mousetrap.trigger('m m');"><span class="keycodes">m m/m c</span> Collection</div>
			<div class="bottom-menu" onclick="Mousetrap.trigger('p p');"><span class="keycodes">p p/p c</span> Statistics</div>`);
		layout.write("LOGO", `CMOSTimer <small onclick="cmd.switchToText()">V${version} ${transl("Alpha Graphic")}</small><span id="timingModeRevert"></span>`);
		layout.write("TIME", `<span class="keycodes">space</span>0.000`);
		layout.write("PORT", `<button onclick="alert(timer.exportCsv());">Export CSV</button>`);
		//layout.write("HELP", `<iframe src="../Website/index.php?show=../../Documentation/Documents/help/cmostimer&timerembed" width="100%" height="700"></iframe>This space here is not filled yet.`);
		document.getElementById("console-output").innerHTML = "You are viewing the text-based mode of CMOSTimer. Type help and press enter to get Help. Press tab to focus command input.<br><span style='color:#22DD22'>HT4.3.0A&gt;</span></span><input class='text-input' id='btn_cmd' type='text'/>"

		//Initialize components
		counter.init();
		algSets.init();
		goals.init();
		scramble.init();
		keyboard.init();
		stats.init();
		cmd.init();
		options.init();
		cube.init(start.myCubes);

		//Generate scramble and display it
		scramble.neu();
		scramble.draw();

		//Display Sessions
		sessions.display();

		//Autosave
		setInterval(function() {
			localStorage.HTAutoSave = JSON.stringify(core.getAll());
		}, 5e3);


		//Initialize scramblers
		scramblers["222"].initialize();
		scramblers["333"].initialize();
		scramblers["444"].initialize();
		scramblers["555"].initialize();
		scramblers["666"].initialize();
		scramblers["777"].initialize();

		// We don't need the starting values anymore.
		window.start = false;
	}


	function exportCode() {
		return JSON.stringify(core.getAll())
	}

	function exportCsv() {
		var solves = core.get("config").timeList[core.get("config").currentSession],
			i, csv = "";
		for (i = 0; i < solves.length; ++i)
			csv += [solves[i].zeit, solves[i].scramble].join(",") + "\n";
		return csv;
	}

	return {
		init: init,
		exportCode: exportCode,
		exportCsv: exportCsv
	}
})();
