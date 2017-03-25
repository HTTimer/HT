/*
 * algSets.js
 */

var algSets = (function() {
	var currentSet = 0;

	/*
	 * algSets:Init()
	 */
	function init() {

	}

	/*
	 * algSets:display()
	 */
	function display() {
		var outhtml = html.td("<span onclick='algSets.favorite()'>Favorites</span>"),
			outhtml2 = ' <table class="table table-condensed table-hover table-striped">',
			data = window.algs[currentSet],
			i;

		// Menu
		for (i = 0; i < window.algs.length; ++i) {
			outhtml += html.td("<span onclick='algSets.switchCurrentSet(" + i + ");'>" + window.algs[i].name + "</span>");
		}
		outhtml += html.td("<span onclick='algSets.addSet();'>+</span>");
		outhtml = html.table("<tr>" + outhtml + "</tr>");

		// Headline
		outhtml += html.el("h2", "<span onclick='algSets.changeSetName()'><u>" + data.name + "</u></span> <span onclick='algSets.removeSet()'>x</span> <span onclick='algSets.addAlg()'>+</span>");

		// Algs
		for (i = 0; i < data.algs.length; ++i) {
			outhtml2 += html.tr(
				"<span onclick='algSets.changeName(" + i + ")'>" + data.algs[i].name + "</span>",
				"<span onclick='algSets.changeAlg (" + i + ")'>" + data.algs[i].alg[0].name + "</span>",
				"Flags",
				"x",
				//"<span onclick='algSets.toggleStar(" + i + ");'>" + (data.algs[i].flags.star ? "Unfavorite" : "Favorite") + "</span>",
				"<span onclick='algSets.invert(" + i + ")'>invert</span>",
				//"learn",
				//sets[currentSet][i].practiseTimes.length > 0 ? math.format(math.average(sets[currentSet][i].practiseTimes)) + "s" : "DNF",
				//"<span onclick='algSets.enterPractiseMode(" + currentSet + "," + i + ")'>practise</span>",
				"<span onclick='algSets.algCubingNet(" + i + ")'>view</span>",
				"help",
				"statistics"
			);
		}
		outhtml2 += "</table>";
		outhtml += html.table(outhtml2);

		// Buttons
		outhtml += "<br/><button onclick='algSets.addSet()'>" + transl("Add set") + "</button>";
		outhtml += "     <button onclick='algSets.importSet()'>" + transl("Add set") + " (Import code)</button>"
		outhtml += "<br/><button onclick='algSets.removeSet()'>" + transl("Remove current set") + "</button>";
		layout.write("ALGSETS", outhtml);

		/*core.set("algSets", sets);
		core.set("algProps", setprops);*/

		return html;
	}

	/*
	 * algSets:addSet()
	 */
	function addSet() {
		window.algs.push({
			name: "Set name",
			algs: []
		});
		display();
	}

	/*
	 * algSets:removeSet(i)
	 * @param i Int
	 * @TODO remove set of i (lol)
	 */
	function removeSet(i) {
		display();
	}

	/*
	 * algSets:addAlg()
	 */
	function addAlg() {
		window.algs[currentSet].algs.push({
			name: prompt("Name"),
			alg: [{
				likes: [],
				dislikes: [],
				name: prompt("Alg"),
			}]
		});
		display();
	}


	/*
	 * algSets:changeSetName()
	 */
	function changeSetName() {
		window.algs[currentSet].name = prompt("Set new name", window.algs[currentSet].name);
		display();
	}

	/*
	 * algSets:changeName(i)
	 * @param i Int
	 */
	function changeName(i) {
		window.algs[currentSet].algs[i].name = prompt("Set new name", window.algs[currentSet].algs[i].name);
		display();
	}

	/*
	 * algSets:changeAlg(i)
	 * @param i int
	 */
	function changeAlg(i) {
		window.algs[currentSet].algs[i].alg[0].name = prompt("Set new Algorithm", window.algs[currentSet].algs[i].alg[0].name);
		display();
	}

	/*
	 * algSets:switchCurrentSet(i)
	 * @param i int
	 */
	function switchCurrentSet(i) {
		currentSet = i;
		display();
	}

	/*
	 * algSets:toggleStar(i)
	 * @param i int
	 */
	function toggleStar(i) {
		sets[currentSet][i].flags.star = !sets[currentSet][i].flags.star;
		display();
	}

	/*
	 * algSets:invert(i)
	 * @param i int
	 */
	function invert(i) {
		window.algs[currentSet].algs[i].alg[0].name = math.invertAlg(window.algs[currentSet].algs[i].alg[0].name);
		display();
	}

	/*
	 * algSets:algCubingNet(i)
	 * @param i int
	 */
	function algCubingNet(i) {
		var alg = window.algs[currentSet].algs[i].alg[0].name;
		layout.write("ALGSETS", '<iframe src="https://alg.cubing.net/?alg=' + alg + '&setup=' + math.invertAlg(alg) + '&view=fullscreen" width="800" height="550"></iframe>'); //77.247.30.42
	}

	/*
	 * algSets:favorite()
	 */
	function favorite() {
		var html = "<span onclick='algSets.display();'>back</span><br/>",
			i, j, favalgs = [];
		for (i = 0; i < sets.length; ++i) {
			for (j = 0; j < sets[i].length; ++j) {
				if (sets[i][j].flags.star)
					favalgs.push(sets[i][j]);
			}
		}

		//The algs are stored in favalgs
		for (i = 0; i < favalgs.length; ++i) {
			html += favalgs[i].name + ": " + favalgs[i].alg + "<br/>";
		}
		layout.write("ALGSETS", html);
	}

	/*
	 * algSets:addTime(where,time)
	 * @param where
	 * @param time Int time in ms
	 */
	function addTime(where, time) {
		sets[where[0]][where[1]].practiseTimes.push({
			zeit: time,
			penalty: 0
		});
	}

	/*
	 * algSets:enterPractiseMode(i,j)
	 * @param i Int
	 * @param j Int
	 */
	function enterPractiseMode(i, j) {
		core.set("timingMode", "alg");
		core.set("algCountingData", [i, j]);
		core.set("algTmpScrambleType", sessions.current().scrambleType);
		scramble.switchScrambler("ALG ");
		Mousetrap.trigger("a c");
		document.getElementById("timingModeRevert").innerHTML = `<span onclick='algSets.leavePractiseMode();'>&nbsp;back</span>`;
	}

	/*
	 * algSets:leavePractiseMode()
	 */
	function leavePractiseMode() {
		core.set("timingMode", "up");
		Mousetrap.trigger("a a");
		document.getElementById("timingModeRevert").innerHTML = "";
		sessions.current().scrambleType = core.get("algTmpScrambleType");
		sessions.switchS(core.get("config").currentSession + 1);
		sessions.switchS(core.get("config").currentSession);
	}

	/*
	 * algSets:practiseUpdateLeft()
	 */
	function practiseUpdateLeft() {
		var times = algSets.sets[core.get("algCountingData")[0]][core.get("algCountingData")[1]].practiseTimes,
			code = html.tr("Id", transl("Time"), "Mo3", "Ao5"),
			i;

		for (i = 0; i < times.length; ++i) {
			//We build a table row containing id, time, current mo3 and current ao5
			code += html.tr(
				(i + 1),
				math.formatPenalty(times[i]),
				i > 1 ? math.format(math.mean([times[i], times[i - 1], times[i - 2]])) : "-",
				i > 3 ? math.format(math.average([times[i], times[i - 1], times[i - 2], times[i - 3], times[i - 4]])) : "-"
			); //.insert(3, " onclick='stats.showBig(" + i + ")'"); //For detailed solve information later on
		}
		code = html.table(code);
		layout.write("TIMELIST", code);
	}

	return {
		init: init,
		display: display,
		addSet: addSet,
		addAlg: addAlg,
		removeSet: removeSet,
		changeSetName: changeSetName,
		changeAlg: changeAlg,
		changeName: changeName,
		switchCurrentSet: switchCurrentSet,
		toggleStar: toggleStar,
		invert: invert,
		algCubingNet: algCubingNet,
		favorite: favorite,
		addTime: addTime,
		enterPractiseMode: enterPractiseMode,
		leavePractiseMode: leavePractiseMode,
		practiseUpdateLeft: practiseUpdateLeft
	}
})();
