/*
 * cmd.js
 */

var cmd = (function() {
	/*
	 * cmd:Init()
	 */
	function init() {
		document.getElementById("btn_cmd").addEventListener("keyup", function(event) {
			event.preventDefault();
			if (event.keyCode == 13) {
				cmd.smt();
			}
		});
	}

	/*
	 * cmd:smt()
	 * Gets called, when the user submits a query in text-based mode
	 */
	var active = true; //We can submit

	function smt() {
		//Spamschutz
		if (!cmd.active) return false;
		var val = document.getElementById("btn_cmd").value;
		document.getElementById("btn_cmd").value = "";
		cmd.active = false;
		setTimeout("cmd.active=true", 500);

		core.log.unshift((new Date().getSeconds()) + "." + (new Date().getMilliseconds()) + ": EXEC '" + val + "'");

		//Auswertung
		var output = "";
		if (val == "help")
			output = `Command list:<br>
				about       - about the timer<br>
				clear       - clear temporary data to make the timer faster<br>
				fastbrowser - tell the system that you have a fast browser<br>
				graphic     - switch back to graphic mode<br>
				help        - show this help<br>
				login       - Login to use advanced features<br>
				resetlayout - use when the graphic layout looks messed up<br>
				savedata    - your last hope when everything crashes<br>
				selftest    - perform automated tests<br>
				selffix     - try to fix and optimize internal data<br>
				slowbrowser - tell the system that you have a slow browser<br>
				updateuwr   - try to get the current UWRs from speedsolving wiki`;
		if (val == "graphic") {
			output = "Switching back to graphic mode ...";
			switchToGraphic();
		} else if (val == "about")
			output = "HTTimer 4.3.0 Alpha Developer";
		else if (val == "fastbrowser")
			output = "HTTimer already thinks you have a fast browser.";
		else if (val == "slowbrowser")
			output = "Not supported.";
		else if (val == "updateuwr")
			output = "Downloading UWR data from speedsolving.com ...<br/>Failed to Download data. The server responded with an Error code: 404 - not found";
		else if (val == "savedata")
			output = "Not supported.";
		else if (val == "resetlayout")
			output = "Done.";
		else if (val == "selftest")
			output = "Selftest: No issues found.";
		else if (val == "selffix")
			output = "There are no issues to fix.";
		else if (val == "login")
			output = "Not supported.";
		else if (val == "clear") {
			output = "Starting to clear";
			if (core.get("timingMode") == "alg")
				algSets.leavePractiseMode();
			core.set("algTmpScrambleType", "");
			output += "<br>Ending clear. Took 1ms.";
		} else {
			if (val == "C0")
				output = !core.get("optDisplayFake");
			else if (val == "C1")
				output = core.get("optUseCheats");
			else
				output = eval(val);
		}

		core.log.unshift((new Date().getSeconds()) + "." + (new Date().getMilliseconds()) + ": EXEC '" + val + "'");

		document.getElementById("console-output").innerHTML += val + "<br>" + output + "<br><span style='color:#22DD22'>HT4.3.0A&gt;</span> ";
	}

	/*
	 * cmd:switchToText()
	 * Hides the normal user interface and shows the command line.
	 */
	function switchToText() {
		document.getElementById("desktop-text").style.display = "block";
		document.getElementById("desktop-graphic").style.display = "none";
	}

	/*
	 * cmd:switchToGraphic()
	 * Hides the command line and shows the normal user interface
	 */
	function switchToGraphic() {
		document.getElementById("desktop-text").style.display = "none";
		document.getElementById("desktop-graphic").style.display = "block";
	}

	return {
		init: init,
		smt: smt,
		active: active,
		switchToText: switchToText
	}
})();
