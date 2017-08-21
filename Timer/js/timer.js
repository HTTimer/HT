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

	var moduleList = ["algSets", "core", "counter", "cube", "error", "goals", "html", "layout", "scramble", "sessions", "stats", "keyboard", "translate"];
	var version = ["4", "3", "0", "A"]; // This is the development version, the "real" version 1.0.0 starts at 4.3.0A dev. This is because it was renamed from HTTimer to CMOSTimer at Version HT4.3.0A dev.
	version = [version[0] - 3, version[1] - 3, version[2]].join(".") + " " + version[3]; // build the real version

	function init() {
		var i, config, check, html;

		core.init();

		//Let the server check, whether the user is logged in. Assume, the user is not, in case it fails.
		core.set("login", false);

		//Check if all modules have been loaded
		for (i = 0; i < moduleList.length; ++i) {
			if (!window[moduleList[i]])
				error.error("LoadError");
		}

		//Check browser
		var isIE = /*@cc_on=true;@*/false;
		if (isIE) {
			//Do something. I suggest downloading Firefox.  ^_^
		}

		config = start.timeListData;

		//Apply stylesheet
		layout.setTheme(start.TimerTheme);
		//Set some variables
		//Set variables using core.set (and core.get to get them) are NOT const and will be exported.
		core.set("running", false);
		core.set("log", "");
		core.set("optTimeStatistics", start.TimeStatistics);
		core.set("optDisplayPb", start.TimeStatsPb);
		if (typeof core.list.length === "undefined") {
			core.set("importVersion", config && config.version || version);
			core.set("version", version);
			core.set("language", "EN");
			//core.set("config", config || core.get("config"));
			core.set("config", {"sessionData": start.sessions,"timeList": start.timeList,"currentSession": start.currentSession});
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
		/*layout.write("BOTTOMMENU", `<div class="bottom-menu" onclick="Mousetrap.trigger('o o');"><span class="keycodes">o o (open)/o c (close)</span> Disabled</div>
			<div class="bottom-menu" onclick="Mousetrap.trigger('g g');"><span class="keycodes">g g (open) g c (close)</span> Disabled</div>
			<div class="bottom-menu" onclick="//Mousetrap.trigger('a a');"><span class="keycodes">a a/a c</span> Disabled</div>
			<div class="bottom-menu" onclick="Mousetrap.trigger('i i');"><span class="keycodes">i i/i c</span> Import/Export</div>
			<div class="bottom-menu" onclick="Mousetrap.trigger('l l');"><span class="keycodes">l l/l c</span> Disabled</div>
			<div class="bottom-menu" onclick="Mousetrap.trigger('m m');"><span class="keycodes">m m/m c</span> Disabled</div>
			<div class="bottom-menu" onclick="Mousetrap.trigger('p p');"><span class="keycodes">p p/p c</span> Statistics</div>`);*/
		layout.write("LOGO", `CMOSTimer <small>V${version} ${transl("Alpha Graphic")}</small><span id="timingModeRevert"></span>`);
		layout.write("TIME", `<span class="keycodes">space</span>0.000`);
		layout.write("PORT", `<button onclick="importCsTimer();">Import from csTimer</button><button onclick="alert(timer.exportCsv());">Export CSV</button>`);
		layout.write("HELP", "CMOSTimer is a general speedcubing timer. TODO");

		//Initialize components
		counter.init();
		algSets.init();
		goals.init();
		scramble.init();
		keyboard.init();
		stats.init();
		options.init();
		cube.init(start.myCubes);

		//Generate scramble and display it
		scramble.neu();
		scramble.draw();

		//Display Sessions
		scramble.sessionSwitchInit();
		counter.sessionSwitchInit();
		stats.sessionSwitchInit();
		stats.update();
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
