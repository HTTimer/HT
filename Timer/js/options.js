/*
 * options.js
 * only change things in draw
 */

var options = (function() {
	/*
	 * options:Init()
	 */
	function init() {
		//Add categories. Each one is represented with its own tab.
		addCategory("Display");
		addCategory("Timer");
		addCategory("Layout");
		addCategory("Scramble");
		addCategory("Statistics");

		//Add Options to the categories.
		addOption(0, "Hide scramble when timing", 1, ["core.set('optHideScrambleWhenTiming',true)", "core.set('optHideScrambleWhenTiming',false)", false]);
		addOption(0, "Show milliseconds", 1, ["core.set('optUseMilliseconds',true)", "core.set('optUseMilliseconds',false)", true]);

		addOption(2, "Show scramble select", 1, ["core.set('optHideScrambleBar',false);", "core.set('optHideScrambleBar',true);", false]);
		addOption(2, "Show virtual stackmat timer", 1, ["document.getElementById('stackmat-base').style.display='block';", "document.getElementById('stackmat-base').style.display='none';", true]);
		addOption(2, "Show scramble image for NxNxN, 8>N>1", 1, ["", "", true]);

		addOption(1, "Use Inspection", 1, [",", ",", true]);

		addOption(3, "Default scramble type for new Session", 0, "");

		//Set defaults for options. Each option key begins with "opt", followed by an uppercase letter.
		core.set("optUseMilliseconds", true);
		core.set("optHideScrambleWhenTiming", false);
		core.set("optHideLog", true);
		core.set("optUseCheats", false);
		core.set("optDisplayFake", true);

		core.set("optHideScrambleBar", false);
		core.set("optHideScrambleImage", false);
		core.set("optHideTimeInDetails", true);

		core.set("optUseInspection", true);
		core.set("optInspectColor", true);
		core.set("optInspectColor8", "black");
		core.set("optInspectColor12", "#ff0");
		core.set("optInspectColor15", "#f80");
		core.set("optInspectColor17", "#f00");

		core.set("optDefaultScrambleTypeForNewSession", "333");

		draw();
	}

	var currentCategory = 0;

	function draw() {
		layout.write("OPTIONS", `
		<div class="col-1">
		<h3>Display</h3>
		<div class="options-option">
			<label class="option-description" for="optUseMilliseconds">Show milliseconds:</label>
			<div class="option-button">
				<input type="checkbox" onclick="core.set('optUseMilliseconds',${core.get('optUseMilliseconds')?'false':'true'});options.draw();" id="optUseMilliseconds"${core.get('optUseMilliseconds')?' checked="checked"':''}/>
			</div>
		</div>
		<div style="clear:both;"></div>
		<div class="options-option">
			<label class="option-description" for="optInspectColor">Color inspection time after 8, 12, 15 seconds:</label>
			<div class="option-button"><button onclick="core.set('optInspectColor',${core.get('optInspectColor')?'false':'true'});options.draw();">
				${core.get('optInspectColor')?'Disable':'Enable'}</button>
			</div>
		</div>
		<div style="clear:both;"></div>
		<div class="options-option">
			<label class="option-description" for="optInspectColor">Show log:</label>
			<div class="option-button">
				<button onclick="document.getElementsByClassName('LOG')[0].style.display='${core.get("optHideLog")?"block":"none"}';core.set('optHideLog',${core.get('optHideLog')?'false':'true'});options.draw();">
				${core.get('optHideLog')?'Enable':'Disable'}</button>
			</div>
		</div>
		<div style="clear:both;"></div>
		<div class="options-option">
			<label class="option-description" for="optInspectColor">Show solve time in details:</label>
			<div class="option-button">
				<button onclick="core.set('optHideTimeInDetails',${core.get('optHideTimeInDetails')?'false':'true'});options.draw();">
				${core.get('optHideTimeInDetails')?'Enable':'Disable'}</button>
			</div>
		</div>
		<div style="clear:both;"></div>
		<h3>Timer</h3>
		<div class="options-option">
			<label class="option-description" for="optInspectColor">Show scramble select:</label>
			<div class="option-button"><button onclick="core.set('optHideScrambleBar',${core.get('optHideScrambleBar')?'false':'true'});options.draw();">
				${core.get('optHideScrambleBar')?'Enable':'Disable'}</button>
			</div>
		</div>
		<div style="clear:both;"></div>
		<div class="options-option">
			<label class="option-description" for="optInspectColor">Enable displaying "Fake":</label>
			<div class="option-button"><button onclick="core.set('optDisplayFake',${core.get('optDisplayFake')?'false':'true'});options.draw();">
				${core.get('optDisplayFake')?'Disable':'Enable'}</button>
			</div>
		</div>
		<div style="clear:both;"></div>
		<div class="options-option">
			<label class="option-description" for="optInspectColor">Show virtual stackmat timer:</label>
			<div class="option-button">
				<button onclick="document.getElementById('stackmat-base').style.display='${core.get("optHideScrambleImage")?"block":"none"}';core.set('optHideScrambleImage',${core.get('optHideScrambleImage')?'false':'true'});options.draw();">
				${core.get('optHideScrambleImage')?'Disable':'Enable'}</button>
			</div>
		</div>
		<div style="clear:both;"></div>
		<div class="options-option">
			<label class="option-description" for="optInspectColor">Allow cheating:</label>
			<div class="option-button">
				<button onclick="core.set('optUseCheats',${core.get('optUseCheats')?'false':'true'});options.draw();">
				${core.get('optUseCheats')?'Disable':'Enable'}</button>
			</div>
		</div>
		<div style="clear:both;"></div>
		</div>
		<div class="col-2">
		<h3>Design</h3>
		<div class="multibutton">
			<button onclick='layout.setTheme(0)' class="buttonstart">white</button>
			<button onclick='layout.setTheme(1)' class="buttonmiddle">yellow</button>
			<button onclick='layout.setTheme(2)' class="buttonmiddle">orange</button>
			<button onclick='layout.setTheme(3)' class="buttonmiddle">green</button>
			<button onclick='layout.setTheme(6)' class="buttonmiddle">blue 1</button>
			<button onclick='layout.setTheme(4)' class="buttonmiddle">blue 2</button>
			<button onclick='layout.setTheme(7)' class="buttonend">cstimer</button>
		</div>
		<br/><br/>
		Color 1: <input type="color" onchange='layout.themes[layout.themes.length-1][1][1]=(this.value.split("#")[1]);layout.setTheme(5)'/><br/>
		Color 2: <input type="color" onchange='layout.themes[layout.themes.length-1][2][1]=(this.value.split("#")[1]);layout.setTheme(5)'/><br/>
		<br/>

		<label class="option-description">Color inspection time based on time:</label>
		<button onclick="core.set('optInspectColor',${core.get('optInspectColor')?'false':'true'});options.draw();">
			${core.get('optInspectColor')?'Disable':'Enable'}</button>
		<br/>
		Inspection time color <8s: <input type="color" onchange='core.set("optInspectColor8",this.value);'/><br/>
		Inspection time color <12s: <input type="color" onchange='core.set("optInspectColor12",this.value);'/><br/>
		Inspection time color <15s: <input type="color" onchange='core.set("optInspectColor15",this.value);'/><br/>
		Inspection time color >15s: <input type="color" onchange='core.set("optInspectColor17",this.value);'/><br/>
		<!--<button onclick='layout.themes[layout.themes.length-1][1][1]=prompt("Color 1 as Hex value (example: 434343)");layout.setTheme(5)'>Change color 1</button><br/>
		<button onclick='layout.themes[layout.themes.length-1][2][1]=prompt("Color 3 as Hex value (example: 434343)");layout.setTheme(5)'>Change color 2</button><br/>-->
		</div>
		`);
	}

	/*
	 * options:display(c)
	 * @param c CategoryID, optional, defaults to 0
	 */
	function display(c) {
		var code, i;
		if (!c) c = currentCategory || 0;
		code = "<table class='striped'><tr>";
		for (i = 0; i < categories.length; ++i) {
			code += "<td onclick='options.display(" + i + ");'>" + categories[i] + "</td>";
		}
		code += "</tr></table><br/><table>";
		code += options[c] + "</table>";
		layout.write("OPTIONS", code);
	}

	/*
	 * options:addOption()
	 * @param cid Int CategoryID
	 * @param name String Description of Option
	 * @param type Int 0:Button, 1:Switch, 2:Select
	 * @param affect String|Array[affect] Javascript-code to do, may not contain ", ` and '
	 * Switch: affect is [1,2,3], 3 is default value (true=checked), 1 is action when switch is on, 2 when off
	 */
	var options = [];

	function addOption(cid, name, type, affect) {
		var code = "<tr><td>" + name + "</td><td>";
		if (type == 0)
			code += "<button onclick='" + affect + "'>" + name + "</button>";
		if (type == 1)
			code += '<label class="switch"><input type="checkbox"' + (affect[2] == true ? " checked " : " ") + 'onclick="if(this.checked){' + affect[0] + '}else{' + affect[1] + '}"><div class="slider round"></div></label>';
		code += "</td></tr>";
		options[cid] += code;
	}

	/*
	 * options:addCategory()
	 * @param name String
	 */
	var categories = [];

	function addCategory(name) {
		categories.push(name);
		options.push("");
	}

	return {
		init: init,
		display: display,
		currentCategory: currentCategory,
		options: options,
		draw: draw
	}
})();
