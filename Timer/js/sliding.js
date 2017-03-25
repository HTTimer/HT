/*
 * sliding.js
 */

var sliding = (function() {
	function init() {
		// Register eventhandler
		document.onkeydown = function(event) {
			switch (event.keyCode) {
				case 83: //S
					currentPosition = scrambleBad(size);
					displayBoard(size, currentPosition, colors);
					break;
				case 37: //<
					keyMove("l", currentPosition, size);
					break;
				case 39: //>
					keyMove("r", currentPosition, size);
					break;
				case 38: //^
					keyMove("u", currentPosition, size);
					break;
				case 40: //v
					keyMove("d", currentPosition, size);
					break;
				case 32: //Space
					stopTimer();
					break;
			}
			event.cancelBubble = true;
			return event.returnValue = false;
		}
		displayBoard(size, currentPosition, colors);
	}

	function update() {
		displayBoard(size, currentPosition, colors);
	}

	var settings = ["continue", "row", "row"];
	//"continue" or "rowcolumn": numbernaming, "row","fringe","grid": colors, font color def like second param
	var colors = ["#FF0000", "#FF4000", "#FF8000", "#FFBF00", "#FFFF00", "#BFFF00", "#80FF00", "#40FF00", "#00FF00", "#00FF40", "#00FF9F", "#00FFBF", "#00BFFF", "#0080FF", "#0040FF", "#0000FF", "#4000FF", "#8000FF", "#BF00FF", "#FF00FF", "#FF00BF", "#FF0080", "#FF0040", "#848484"];
	var size = [4, 4]; //hoehe,breite
	var currentPosition = generateStartposition(size, settings);
	var timerRunning = false;
	var solved = false;
	var timeHistory = [];
	var running = false;
	var runstart = +new Date();
	var zoom = 1.00;

	function startTimer() {
		if (running) return;
		running = true;
		runstart = +new Date();
	}

	function stopTimer() {
		if (!running) return;
		running = false;
		timeHistory.push({
			size: size,
			time: +new Date() - runstart,
			date: +new Date()
		});
		currentPosition = generateStartposition(size, settings);
		displayBoard(size, currentPosition, colors);
	}

	function generateStartposition(size, settings) {
		var position = [],
			i, j
		for (i = 0; i < size[0]; ++i) {
			position.push([]);
			for (j = 0; j < size[1]; ++j) {
				position[i][j] = settings[0] == "continue" ? (j + 1) + i * size[0] : i + j + [];
			}
		}
		position[position.length - 1][position[position.length - 1].length - 1] = "";
		return position;
	}

	function scrambleBad(size) {
		var foo = [],
			i, j, position = [];

		for (i = 0; i < size[0] * size[1]; i++) {
			i == 0 ? foo.push("") : foo.push(i);
		}
		foo = shuffle(foo);
		for (i = 0; i < size[0]; ++i) {
			position.push([]);
			for (j = 0; j < size[1]; ++j) {
				position[i][j] = foo.pop();
			}
		}
		return position;
	}

	function findEmpty(currentPosition) {
		var i, j;
		for (i = 0; i < size[0]; ++i) {
			for (j = 0; j < size[1]; ++j) {
				if (currentPosition[i][j] == "") {
					return [i, j]
				};
			}
		}
		return false;
	}

	function move(tofield, currentPosition, size) {
		var empty = findEmpty(currentPosition);
		currentPosition[empty[0]][empty[1]] = currentPosition[tofield[0]][tofield[1]];
		currentPosition[tofield[0]][tofield[1]] = "";
		moveWasDone();
	}

	function keyMove(direction, currentPosition, size) {
		var empty = findEmpty(currentPosition);
		if ((direction == "u" && empty[0] == 0) ||
			(direction == "d" && empty[0] == size[0] - 1) ||
			(direction == "l" && empty[1] == 0) ||
			(direction == "r" && empty[1] == size[1] - 1)
		) return false;
		direction == "u" && move([empty[0] - 1, empty[1]], currentPosition, size);
		direction == "d" && move([empty[0] + 1, empty[1]], currentPosition, size);
		direction == "l" && move([empty[0], empty[1] - 1], currentPosition, size);
		direction == "r" && move([empty[0], empty[1] + 1], currentPosition, size);
		update();
	}

	function moveWasDone() {
		!running && startTimer();
	}

	function shuffle(array) {
		var currentIndex = array.length,
			temporaryValue, randomIndex;
		while (0 !== currentIndex) {
			randomIndex = Math.floor(Math.random() * currentIndex);
			currentIndex -= 1;
			temporaryValue = array[currentIndex];
			array[currentIndex] = array[randomIndex];
			array[randomIndex] = temporaryValue;
		}
		return array;
	}

	function displayBoard(size, currentPosition, colors) {
		var htmltext = "<table cellspacing='0' cellpadding='0'>",
			i, j;
		for (i = 0; i < size[0]; ++i) {
			htmltext += "<tr>";
			for (j = 0; j < size[1]; ++j) {
				function getColor(config, number) {
					if (number == "") return "grey";

					number--;
					var retval;
					var size = config.size;

					var colors = config.colors;
					grenze = size[0] < size[1] ? size[1] : size[0];

					//color-repeat
					if (config.colorRepeat > 0) {
						if (config.colorRepeat < config.colors.length / 2) {
							colors = ["#FF0000", "#FF8000", "#FFFF00", "#80FF00", "#00FF00", "#00FF9F", "#00BFFF", "#0040FF", "#4000FF", "#BF00FF", "#FF00BF", "#FF0040"];
							colors = colors.concat(colors);
							while (colors.length > config.colorRepeat) colors.pop();
							while (colors.length < grenze) colors = colors.concat(colors);
						}
					} else {
						while (colors.length < grenze) colors = colors.concat(colors);
					}

					//sceme
					// Warning: this code is unmaintainable. Do not try to fix it.
					// Increment the following variable as a warning to the next user:
					const total_hours_wasted_here = 5;

					if (config.sceme == "row") {
						retval = colors[(number - (number % size[0])) / size[0] + 1];
					} else if (config.sceme == "fringe") {
						var val;
						var colorindex = (number - (number % size[0])) / size[0] - 1;
						if (number % size[1] - 1 < colorindex) colorindex = number % size[1] - 1;
						retval = colors[colorindex + 1];
					} else if (config.sceme == "grid") {
						var griddistance = Math.round(size[0] / 4);
						var zeile = (number - (number % size[0])) / size[0];
						var spalte = number % size[1];
						var block = (zeile - zeile % griddistance) / griddistance;
						var block2 = (spalte - spalte % griddistance) / griddistance;
						retval = colors[(block + 1) * (block2 + 1) + block];
					}

					//area-visible
					if (config.areaVisible.length == 4) {
						if ((
								(config.areaVisible[0] < number % size[1] - 1) ||
								(config.areaVisible[1] > number % size[1] - 1)) &&
							((config.areaVisible[2] < (number - (number % size[0])) / size[0] - 1) ||
								(config.areaVisible[3] > (number - (number % size[0])) / size[0] - 1))
						) {
							return "black";
						}
					}

					return retval;
				}
				var color = getColor({
					size: size,
					sceme: "fringe",
					currentPosition: currentPosition,
					colors: colors,
					colorRepeat: 0,
					areaVisible: 0
				}, currentPosition[i][j]);
				var color2 = getColor({
					size: size,
					sceme: "row",
					currentPosition: currentPosition,
					colors: colors,
					colorRepeat: 10,
					areaVisible: 0
				}, currentPosition[i][j]);
				if (size[0] > 15 || size[1] > 15) {
					htmltext += "<td bgcolor='" + color + "' style='width:" + window.innerHeight / size[0] * .98 * zoom + "px;height:" + window.innerHeight / size[0] * .98 * zoom + "px;font-size:" + 1 / size[0] * 300 * zoom + "pt;border-bottom:2px solid " + color2 + ";'>" + currentPosition[i][j] + "</td>";
				} else {
					htmltext += "<td bgcolor='" + color + "' style='width:" + window.innerHeight / size[0] * .98 * zoom + "px;height:" + window.innerHeight / size[0] * .98 * zoom + "px;font-size:" + 1 / size[0] * 300 * zoom + "pt;border-bottom:2px solid " + color2 + ";' onmouseover='move([" + i + "," + j + "],currentPosition,size);displayBoard(size,currentPosition,colors);'>" + currentPosition[i][j] + "</td>";
				}
			}
			htmltext += "</tr>";
		}
		htmltext += "</table>";
		document.getElementById("board").innerHTML = htmltext;
	}

	return {
		init: init,
		update: update
	}
})();

/*
This Code had some HTML and CSS when I wrote it a few years ago
<div id="board"></div><div id="right">Help: Press Space to stop timer, scramble and move to start timer<br>scramble with s<br>boards >15 in one direc have no mouse ctrl.</div>
<style>
table {
		border-collapse:collapse;
}
td,th {
		padding:0;
	text-align:center;
}
#right {
	position:absolute;
	top:0;
	right:0;
	bottom:0;
	width:300px;
	border-left:1px solid black;
}
</style>
*/
