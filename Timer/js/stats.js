/*
 * stats.js
 */

String.prototype.insert = function(index, string) {
	var ind = index < 0 ? this.length + index : index;
	return this.substring(0, ind) + string + this.substring(ind, this.length);
};

var stats = (function() {
	/*
	 * stats:Init()
	 */
	function init() {
		update();
	}

	/*
	 * stats:sessionSwitchInit()
	 */
	function sessionSwitchInit() {
		currentBig = -1;
	}

	/*
	 * stats:update();
	 */
	function update() {
		var times, i, code, sizes;

		times = core.get("config").timeList[core.get("config").currentSession];
		code = "";

		code += html.tr("Id", transl("Time"), "Mo3", "Ao5");

		// We build a table with each row containing id, time, current mo3 and current ao5
		for (i = 0; i < times.length; ++i) {
			code += html.tr(
				(i + 1),
				math.formatPenalty(times[i]),
				i > 1 ? math.format(math.mean([times[i], times[i - 1], times[i - 2]])) : "-",
				i > 3 ? math.format(math.average([times[i], times[i - 1], times[i - 2], times[i - 3], times[i - 4]])) : "-"
			).insert(3, " onclick='stats.showBig(" + i + ")'"); //For detailed solve information
		}
		code = html.table(code);
		layout.write("TIMELIST", code);

		// Statistics
		code = "";
		if (sessions.current().solveType != "FMC" && sessions.current().solveType != "BLD" && sessions.current().solveType != "OH BLD")
			sizes = [1, 5, 12, 50, 100, 1000, 10000];
		else
			sizes = [1, 3, 25, 100];
		if (sessions.current().solveType == "FT")
			sizes.pop();

		code += html.tr(html.el("b", transl("Statistics")), html.el("b", transl("Best")), html.el("b", transl("Current")));
		for (i = 0; i < sizes.length; ++i) {
			code += html.tr("Mo" + sizes[i], math.format(math.bestMean(core.get("config").timeList[core.get("config").currentSession], sizes[i])), math.format(math.currentMean(core.get("config").timeList[core.get("config").currentSession], sizes[i])));
		}
		code = html.table(code);

		layout.write("STATS", code);
	}

	/*
	 * stats:showBig(i)
	 * @param i Int SolveID
	 */
	var currentBig = -1;

	function showBig(i) {
		if (i != currentBig) {
			document.querySelector(".TIMELIST table tbody tr:nth-child(" + (i + 2) + ")").style.background = "#CCC";
			document.querySelector(".TIMELIST table tbody tr:nth-child(" + (currentBig + 2) + ")").style.background = "white";
		}
		currentBig = i;
		var code = "",
			solve = core.get("config").timeList[core.get("config").currentSession][i];
		code = "<table cellspacing='0' cellpadding='0'><th>" + math.formatPenalty(solve) + "</th><td>#" + (i + 1) + "<br/><span onclick='stats.togglePenalty(" + i + ",2)'>"
		if (solve.penalty == 2000)
			code += "<b>+2</b>";
		else
			code += "+2";
		code += "</span><br/><span onclick='stats.togglePenalty(" + i + ",-1)'>"
		if (solve.penalty == -1)
			code += "<b>DNF</b>";
		else
			code += "DNF";
		code += "</span></td><td><span onclick='stats.showDetails(" + i + ")'>Details</span><br>" +
			(core.get("optUseCheats") ? "<span onclick='stats.showCheats(" + i + ")'>Cheats</span>" : "") +
			"<br>" +
			(solve.flags.fake && core.get("optDisplayFake") ? "Fake" : "\&nbsp;") +
			"</td></table>";
		layout.write("TIME", code);
		layout.write("FLAGS", "");
	}

	/*
	 * stats:showDetails(i)
	 * @param i Int SolveID
	 */
	function showDetails(i) {
		var solve, flags, i, j, code;
		solve = core.get("config").timeList[core.get("config").currentSession][i],

			//Compute flags
			flags = ["Fail", "Mess up", "Pop", "OLL Skip", "PLL Skip", "Explosion",
				"COLL Skip", "CMLL Skip", "CxLL Skip", "EOLine Skip", "EOLL Skip", "EPLL Skip",
				"CPLL Skip", "LL Skip", "6 move Last layer", "VLS to PLL Skip", "fake", "UWR",
			];

		if (solve.scrambletype == "Pyra")
			flags.push("0 Tips", "1 Tip", "2 Tips", "3 Tips", "4 Tips");
		//@TODO Generate this from scramble

		if (solve.scrambletype == "444" ||
			solve.scrambletype == "666" ||
			solve.scrambletype == "Square1")
			flags.push("Parity", "Parity mess up");

		if (solve.scrambletype != "Pyra" &&
			solve.scrambletype != "Square1")
			flags.push("Corner twist");

		if (solve.penalty < 0 &&
			solve.scrambletype != "Pyra" &&
			solve.scrambletype != "Square1" &&
			solve.scrambletype != "Skewb" &&
			solve.scrambletype != "222")
			flags.push("M-Slice DNF");

		if (solve.scrambletype == "222" ||
			solve.scrambletype == "444" ||
			solve.scrambletype == "666")
			flags.push("internal misalignment")

		// Display some general data
		code = transl("Scramble") + ": " + solve.scramble + "<br/>";
		if (!core.get("optHideTimeInDetails"))
			code += "Time: " + math.format(solve.zeit) + "s<br/>";
		code += "Inspction time: " + math.format(solve.currentInspection) + "s<br/>";
		code += "Start date: " + math.formatDate(solve.startTime) + "<br/>";
		code += "End date: " + math.formatDate(solve.endTime) + "<br/>";
		code += "Session: " + sessions.current().name + "<br/>";
		code += "Penalty: " + (solve.penalty < 0 ? "DNF" : solve.penalty > 1 ? "+2" : "none") + "<br/>";
		code += "<span onclick='layout.write(\"FLAGS\",\"\")'>Hide details</span>";

		j = i;

		// Display Flags
		//for (i = 0; i < flags.length; ++i)
		//code += "<input type='checkbox'" + (solve.flags[i] ? " checked" : "") + " onclick='core.get(\"config\").timeList[core.get(\"config\").currentSession][" + j + "].flags." + flags[i] + "=!core.get(\"config\").timeList[core.get(\"config\").currentSession][" + j + "].flags." + flags[i] + ";'/>" + flags[i] + "\&nbsp;";

		layout.write("FLAGS", code);
	}

	/*
	 * stats:showCheats(i)
	 * @param i Int SolveID
	 */
	function showCheats(i) {
		var solve = core.get("config").timeList[core.get("config").currentSession][i],
			html = "Cheats:<br/>";
		html += "<button onclick='core.get(\"config\").timeList[core.get(\"config\").currentSession][" + i + "].zeit=prompt(\"Neue Zeit\",\"" + solve.zeit + "\");stats.update();'>change time</button><br/>";
		html += "<span onclick='layout.write(\"FLAGS\",\"\")'>Hide cheats</span>";
		layout.write("FLAGS", html);
	}

	/*
	 * stats:togglePenalty(i,p)
	 * @param i Int SolveID
	 * @param p Int Penalty (2 for +2, -1 for DNF)
	 */
	function togglePenalty(i, p) {
		var solve = core.get("config").timeList[core.get("config").currentSession][i];
		if (solve.penalty / 1e3 == p)
			solve.penalty = 0;
		else if (solve.penalty == 0 && p > 0)
			solve.penalty = p * 1e3;
		if (solve.penalty == -1 && p == -1)
			solve.penalty = 0;
		else if (p == -1)
			solve.penalty = -1;
		stats.update();
		showBig(currentBig);
	}

	/*
	 * stats:display();
	 * Displays the statistics
	 */
	function display() {
		var solves, i, pbList, cur, outhtml;

		// Get array of PBs
		solves = core.get("config").timeList[core.get("config").currentSession];
		cur = +Infinity;
		pbList = [];
		for (i = 0; i < solves.length; ++i) {
			if (solves[i].zeit < cur) {
				cur = solves[i].zeit + 1;
				pbList.push(i);
			}
		}

		// Generate table
		outhtml = "<h3>PB improvements</h3>";
		outhtml += html.tr("ID", "Time", "Improvement", "Solves as PB", "Time as PB", "Date")
		for (i = 0; i < pbList.length; ++i) {
			outhtml += html.tr(
				i,
				math.format(solves[pbList[i]].zeit),
				i > 0 ? (math.format(solves[pbList[i - 1]].zeit - solves[pbList[i]].zeit)) : "-",
				i == pbList.length - 1 ? "-" : pbList[i + 1] - pbList[i],
				i == pbList.length - 1 || i < 1 ? "-" : solves[pbList[i + 1]].endTime - solves[pbList[i]].endTime + "ms",
				math.formatDate(solves[pbList[i]].endTime)
			);
		}
		outhtml = html.table(outhtml);

		outhtml = "Generating statistics for current session with " +
			core.get("config").timeList[core.get("config").currentSession].length +
			" solves.<br/><br/>" +
			outhtml + "<h3>Solve graph</h3><div id='holder'></div>";
		layout.write("STATISTICS", outhtml);

		Raphael(function() {
			var sessions = [],
				values = [];
			for (i = 0; i < core.get("config").timeList.length; ++i) {
				sessions.push(core.get("config").sessionData[i].name);
				values.push([]);
				for (j = 0; j < core.get("config").timeList[i].length; ++j) {
					values[i].push(core.get("config").timeList[i][j].zeit);
				}
			}
			var r = Raphael("holder", 620, 250),
				e = [],
				clr = [],
				months = sessions,
				now = 0,
				month = r.text(310, 27, months[now]).attr({
					fill: "#000",
					stroke: "none",
					"font": '100 18px "Helvetica Neue", Helvetica, "Arial Unicode MS", Arial, sans-serif'
				}),
				rightc = r.circle(364, 27, 10).attr({
					fill: "#fff",
					stroke: "none"
				}),
				right = r.path("M360,22l10,5 -10,5z").attr({
					fill: "#000"
				}),
				leftc = r.circle(256, 27, 10).attr({
					fill: "#fff",
					stroke: "none"
				}),
				left = r.path("M260,22l-10,5 10,5z").attr({
					fill: "#000"
				}),
				c = r.path("M0,0").attr({
					fill: "none",
					"stroke-width": 4,
					"stroke-linecap": "round"
				}),
				bg = r.path("M0,0").attr({
					stroke: "none",
					opacity: .3
				}),
				dotsy = [];

			function randomPath(length, j) {
				var path = "",
					x = 10,
					y = 0;

				dotsy[j] = dotsy[j] || [];
				for (var i = 0; i < length; i++) {
					dotsy[j][i] = core.get("config").timeList[j][i].zeit / math.worst(core.get("config").timeList[j]) * 200;
					if (i) {
						x += 20;
						y = 240 - dotsy[j][i];
						path += "," + [x, y];
					} else {
						path += "M" + [10, (y = 240 - dotsy[j][i])] + "R";
					}
				}
				return path;
			}
			for (var i = 0; i < sessions.length; i++) {
				values[i] = randomPath(core.get("config").timeList[i].length, i);
				clr[i] = Raphael.getColor(1);
			}
			c.attr({
				path: values[0],
				stroke: clr[0]
			});
			bg.attr({
				path: values[0] + "L590,250 10,250z",
				fill: clr[0]
			});
			var animation = function() {
				var time = 500;
				if (now == 15) {
					now = 0;
				}
				if (now == -1) {
					now = 11;
				}
				var anim = Raphael.animation({
					path: values[now],
					stroke: clr[now]
				}, time, "<>");
				c.animate(anim);
				bg.animateWith(c, anim, {
					path: values[now] + "L590,250 10,250z",
					fill: clr[now]
				}, time, "<>");
				month.attr({
					text: months[now]
				});
			};
			var next = function() {
					now++;
					animation();
				},
				prev = function() {
					now--;
					animation();
				};
			rightc.click(next);
			right.click(next);
			leftc.click(prev);
			left.click(prev);
		});
	}

	return {
		init: init,
		sessionSwitchInit: sessionSwitchInit,
		update: update,
		showBig: showBig,
		showDetails: showDetails,
		showCheats: showCheats,
		togglePenalty: togglePenalty,
		display: display
	}
})();
