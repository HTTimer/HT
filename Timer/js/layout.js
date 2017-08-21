/*
 * layout.js
 */

var layout = (function() {
	/*
	 * layout:Init()
	 */
	function init() {

	}

	/*
	 * layout:dispay()
	 */
	function display() {
		layout.write("LAYOUT", `Theme settings `);
	}

	/*
	 * layout:setFullLayout
	 * @TODO
	 */
	function setFullLayout(top, right, bottom, left, middle) {

	}

	/*
	 * layout:setTheme(id)
	 * @param id Int
	 * Changes the color of several parts of the timer
	 * var themes contains colors for predefined themes in white, yellow, orange, green, blue
	 */

	var themes = [
		//PREDEFINED
		[
			["WHITE", "FFF"],
			["COMPONENTBACKGROUND", "F5F5F5"],
			["MAINCOLOR", "CCC"],
			["LIGHTFONT", "444444"]
		],
		[
			["WHITE", "FFF"],
			["COMPONENTBACKGROUND", "FFFF00"],
			["MAINCOLOR", "DDDD00"],
			["LIGHTFONT", "555555"]
		],
		[
			["WHITE", "FFF"],
			["COMPONENTBACKGROUND", "FFA500"],
			["MAINCOLOR", "EEBB11"],
			["LIGHTFONT", "444443"]
		],
		[
			["WHITE", "FFF"],
			["COMPONENTBACKGROUND", "AAEE00"],
			["MAINCOLOR", "44DD33"],
			["LIGHTFONT", "232323"]
		],
		[
			["WHITE", "EEE"],
			["COMPONENTBACKGROUND", "3333BB"],
			["MAINCOLOR", "1111EE"],
			["LIGHTFONT", "444443"]
		],
		//CUSTOM
		[
			["WHITE", "FFF"],
			["COMPONENTBACKGROUND", "F5F5F5"],
			["MAINCOLOR", "CCC"],
			["LIGHTFONT", "444444"]
		],
		//PREDEFINED
		[
			["WHITE", "FFF"],
			["COMPONENTBACKGROUND", "21bcdf"],
			["MAINCOLOR", "2961e8"],
			["LIGHTFONT", "444444"]
		],
		[
			["WHITE", "FFF"],
			["COMPONENTBACKGROUND", "222277"],
			["MAINCOLOR", "99CC33"],
			["LIGHTFONT", "444444"]
		],
		[
			["WHITE", "FFF"],
			["COMPONENTBACKGROUND", "DD0000"],
			["MAINCOLOR", "BB0000"],
			["LIGHTFONT", "990000"]
		],
		[
			["WHITE", "FFF"],
			["COMPONENTBACKGROUND", "800080"],
			["MAINCOLOR", "722272"],
			["LIGHTFONT", "633363"]
		],
		[
			["WHITE", "000"],
			["COMPONENTBACKGROUND", "FF1493"],
			["MAINCOLOR", "EE0382"],
			["LIGHTFONT", "DD0271"]
		],
		//PREDEFINED
		[
			["WHITE", "FFF"],
			["COMPONENTBACKGROUND", "DDDD00"],
			["MAINCOLOR", "FFFF00"],
			["LIGHTFONT", "555555"]
		],
		[
			["WHITE", "FFF"],
			["COMPONENTBACKGROUND", "EEBB11"],
			["MAINCOLOR", "FFA500"],
			["LIGHTFONT", "444443"]
		],
		[
			["WHITE", "FFF"],
			["COMPONENTBACKGROUND", "44DD33"],
			["MAINCOLOR", "AAEE00"],
			["LIGHTFONT", "232323"]
		],
		[
			["WHITE", "EEE"],
			["COMPONENTBACKGROUND", "1111EE"],
			["MAINCOLOR", "3333BB"],
			["LIGHTFONT", "444443"]
		],
		//CUSTOM
		[

		],
		//PREDEFINED
		[
			["WHITE", "FFF"],
			["COMPONENTBACKGROUND", "2961e8"],
			["MAINCOLOR", "21bcdf"],
			["LIGHTFONT", "444444"]
		],
		[
			["WHITE", "FFF"],
			["COMPONENTBACKGROUND", "99CC33"],
			["MAINCOLOR", "222277"],
			["LIGHTFONT", "444444"]
		],
		[
			["WHITE", "FFF"],
			["COMPONENTBACKGROUND", "BB0000"],
			["MAINCOLOR", "DD0000"],
			["LIGHTFONT", "990000"]
		],
		[
			["WHITE", "FFF"],
			["COMPONENTBACKGROUND", "722272"],
			["MAINCOLOR", "800080"],
			["LIGHTFONT", "633363"]
		],
		[
			["WHITE", "000"],
			["COMPONENTBACKGROUND", "EE0382"],
			["MAINCOLOR", "FF1493"],
			["LIGHTFONT", "DD0271"]
		],
		[
			["WHITE", "FFF"],
			["COMPONENTBACKGROUND", "CCC"],
			["MAINCOLOR", "F5F5F5"],
			["LIGHTFONT", "444444"]
		]
	];

	function setTheme(id) {
		style.convert(themes[id], themes[0]);
		server.json("Timer-Server/changeoptions.php", function(t) {
			console.log("Loaded theme: " + t.response);
		}, "change=theme&value=" + id);
	}

	/*
	 * layout:write
	 * @param where String document class name
	 * @param what String what to write into those elements
	 *
	 * Source: https://stackoverflow.com/questions/11489716/how-to-use-innerhtml-with-class#answer-11489731
	 * Is modified to accept where and what and reformatted
	 */
	function write(where, what) {
		var items = document.getElementsByClassName(where),
			i, len;

		// loop through all elements having class name where
		for (i = 0, len = items.length; i < len; i++) {
			items[i].innerHTML = what;
		}
	}

	return {
		init: init,
		display: display,
		setFullLayout: setFullLayout,
		write: write,
		setTheme: setTheme,
		themes: themes
	}
})();
