/*
 * scramble.js
 */

var scramble = (function() {
	var type, cur_scramble;

	/*
	 * scramble:Init()
	 * - Set default scrambler type to 3x3x3 WCA
	 * - Set the current scramble to "".
	 */
	function init() {
		type = "333jsss";
		cur_scramble = "";
	}

	/*
	 * scramble:sessionSwitchInit()
	 */
	function sessionSwitchInit() {
		//change type
		type = sessions.current().scrambleType;
		neu();
		draw();
	}

	/*
	 * scramble:ret(v)
	 * @param v the value to return
	 * @return v
	 */
	function ret(v) {
		return v;
	}

	/*
	 * scramble:draw()
	 * draws the current scramble
	 */
	function draw() {
		layout.write("SCRAMBLE", `
		<div><span><div style="display:table-cell;vertical-align:middle;height:43px;"> ${cur_scramble} </div></span></div>
		<div class="${core.get('optHideScrambleBar')?'hidden':''}" id="lol">
				<span style='text-align:middle;'>
					<div style="display:table-cell;vertical-align:middle;height:43px;">
						<!--${transl("Length")} <input type="number" maxlength="3" length="5" value="-1" min="-1" max="4200" step="1"/>-->
					</div>
				</span>
				<span style='float:left;'>
					<table cellspacing="0" cellpadding="0">
						<tr>
							<td class='SCRAMBLERSELECT'><span class='item' onclick="scramble.drawSelect();">${transl("Select scrambler")}</span></td>
						</tr>
					</table>
				</span>
				<span style='float:right;'>
					<div style="display:table-cell;vertical-align:middle;height:43px;">
						<!--${html.keycode("t l")} &lt; ${transl("Last scramble")}\&nbsp;\&nbsp;-->
						    ${html.keycode("t n")} <span onclick="scramble.neu();scramble.draw();">${transl("Next scramble")} &gt;</span>
					</div>
				</span>
			</div>`);
	}

	/*
	 * scramble:drawSelect()
	 * Remap all function calls to the new system
	 */
	function drawSelect() {
		selectScrambler1();
	}

	/*
	 * scrambe:selectScrambler1()
	 * Display the first screen of scramble selecting
	 */
	function selectScrambler1() {
		var wca = ["2x2x2", "3x3x3", "4x4x4", "5x5x5", "6x6x6", "7x7x7", "Pyraminx", "Megaminx", "Square-1", "Skewb", "Cuboid", "Dodecahedra", "Other", "Relays", "Jokes"];
		var html = "<select size='15'>",
			i;
		for (i = 0; i < wca.length; ++i) {
			html += "<option onclick='scramble.selectScrambler2(" + i + ")'>" + wca[i] + "</option>";
		}
		html += "</select><br/><br/><br/>";
		html += "<button onclick='scramble.displayExtendet();'>View scramblers provided<br/>by other users</button>";

		layout.write("SCRAMBLESELECT1", html);
		layout.write("SCRAMBLESELECT2", "");
		layout.write("SCRAMBLESELECT3", "");
		layout.write("SCRAMBLESELECT4", "");
		document.getElementsByClassName('SCRAMBLESELECT')[0].style.display = "block";
	}

	/*
	 * scrambe:selectScrambler2(i)
	 * @param i Int
	 * Display the second screen of scramble selecting
	 */
	function selectScrambler2(i) {
		var html = "<select size='15'>",
			j;
		for (j = 0; j < data[i].length; ++j) {
			html += "<option onclick='scramble.selectScrambler3(" + i + "," + j + ")'>" + data[i][j] + "</option>";
		}
		html += "</select>";

		layout.write("SCRAMBLESELECT4", "");
		layout.write("SCRAMBLESELECT3", "");
		layout.write("SCRAMBLESELECT2", html);
	}

	/*
	 * scrambe:selectScrambler3(i,j)
	 * @param i Int
	 * @param j Int
	 * Switch to the selected scrambler
	 */
	function selectScrambler3(i, j) {
		neu();
		draw();
		switchScrambler(data2[i][j]);
		document.getElementsByClassName('SCRAMBLESELECT')[0].style.display = "none";
	}

	var data = [
		["WCA", "Random moves", "&lt;R,U&gt;", "&lt;R2,U&gt;", "&lt;R,U,F,D,B,L&gt;", "Short", "BLD", "BLD Random orientation moves", "Transparent"],
		["WCA", "Random moves", "&lt;R,U&gt;", "&lt;R,U,F&gt;", "&lt;R,U,L&gt;", "Short", "BLD", "BLD Random orientation moves", "Transparent", "Center orientation", "Half center orientation"],
		["WCA", "Random moves", "&lt;R,r,U,u&gt;", "Edges only", "Short", "BLD", "BLD Random orientation moves", "Transparent", "Supercube"],
		["WCA", "Random moves", "&lt;R,r,U,u&gt;", "Edges only", "Short", "BLD", "BLD Random orientation moves", "Center orientation"],
		["WCA", "Random moves", "Edges only", "Short", "BLD", "BLD Random orientation moves", "Supercube"],
		["WCA", "Random moves", "Edges only", "Short", "BLD", "BLD Random orientation moves", "Center orientation"],
		["WCA", "Random State", "Pyraminx Duo"],
		["WCA"],
		["Random moves", "No Shapeshift", "EP only"],
		["WCA", "Random moves", "Sledge scrambler", "CO only"],
		["1x2x2", "1x3x3", "2x2x3", "2x2x4", "2x2x5", "2x2x6", "3x3x4", "3x3x5", "4x4x2", "4x4x3", "4x4x5", "4x4x6", "4x4x7", "4x4x8", "5x5x3", "5x5x4", "5x5x6", "5x5x7", "6x6x4", "6x6x5", "6x6x8", "7x7x5", "7x7x9"],
		["Kilominx", "Megaminx", "Master Kilominx", "Gigaminx", "Elite Kilominx", "Teraminx", "Petaminx", "Examinx"],
		["Master Pyraminx", "Professor Pyraminx", "Pyramorphix", "Mastermorphix", "Megamorphix", "Helicopter cube (jumbled)", "Helicopter cube", "Curvy copter (jumbled)", "Curvy copter", "Octahedron (face turning)", "Octahedron (corner turning)"],
		["2x2x2-3x3x3", "2x2x2-4x4x4", "2x2x2-5x5x5", "2x2x2-6x6x6", "2x2x2-7x7x7", "2x2x2-8x8x8", "2x2x2-9x9x9", "Pyraminx, Megaminx, Skewb", "2x2x2, 3x3x3, Pyraminx, Skewb", "WCA", "Parity"],
		["1x1x1 &lt;x,y,z&gt;", "1x1x1 &lt;R,U,F&gt;", "1x1x1 BLD", "Monominx"]
	];
	var data2 = [
		["222jsss", "222", "222RU", "222R2U", "222RUFDBL", "222sh", "BLD", "222BLDROM", "222T"],
		["333jsss", "333", "333RU", "333RUF", "333RUL", "333sh", "333BLD", "333BLDROM", "333T", "333Co", "333HCo"],
		["444jsss", "444", "444RrUu", "555Eo", "444sh", "444BLD", "444BLDROM", "444T", "444Su"],
		["555jsss", "555", "555RrUu", "555Eo", "555sh", "555BLD", "555BLDROM", "555Co"],
		["666jsss", "666", "666Eo", "666sh", "666BLD", "666BLDROM", "666Su"],
		["777jsss", "777", "777Eo", "777sh", "777BLD", "777BLDR", "777Co"],
		["Pyra", "Pyra", "Pyra"],
		["Mega"],
		["Square1", "No Shapeshift", "EP only"],
		["Skewb", "Skewb", "SkewbSledge", "SkewbCO"],
		["122", "133", "223", "224", "225", "226", "334", "335", "442", "443", "445", "446", "447", "448", "553", "554", "556", "557", "664", "665", "668", "775", "779"],
		["Kilo", "Mega", "MKilo", "Giga", "MGiga", "Tera", "Peta", "Exa"],
		["Pyra", "Pyra", "222", "333", "444", "HeliCumb", "Heli", "CurvyJumb", "Curvy", "FTO", "CTO"],
		["Relay 222,333", "Relay 222,333,444", "Relay 222,333,444,555", "Relay 222,333,444,555,666", "Relay 222,333,444,555,666,777", "Relay 222,333,444,555,666,777 888", "Relay 222,333,444,555,666,777 888,999", "Relay Pyra,Mega,Skewb", "Relay 222,333,Pyra,Skewb", "Relay 222,333,444,555,666,777,333,333BLD,444BLD,555BLD,Skewb,Mega,Pyra,333 Clock,Square1", "Relay 444,666,Square1"],
		["111alt", "111", "111BLD", "Mono"]
	];

	/*
	 * scramble:neu()
	 * @returns a new scramble of type type
	 */
	function neu() {
		// Generating new scrambles has changed from V4.2.0: Previously, all scrambles were
		// generated, the fitting one was chosen and all others were thrown away. Now, only
		// the neccessary ones are generated, which is much faster and efficient => faster.

		// Scramble with 333jsss (WCA 3x3x3) per default
		var defaultScrambler = "333jsss";

		// Define suffixes for different types of puzzles
		var cubicSuffix = ["", "'", "2"],
			pyraSuffix = ["", "'"],
			noSuffix = [""];

		// Store moves here for easier referencing
		var moves = {
			//Moves in this group are prefixed with C for cubic, P for Pyramid, O for Octahedron, D for Dodecatedron and X for other
			"C1": ["x", "y", "z"],
			"C2": ["R", "U", "F"],
			"C3": ["R", "U", "F", "D", "B", "L"],
			"C4": ["R", "U", "F", "D", "B", "L", "r", "u", "f"],
			"C5": ["R", "U", "F", "D", "B", "L", "r", "u", "f", "d", "b", "l"],
			"C6": ["R", "U", "F", "D", "B", "L", "r", "u", "f", "d", "b", "l", "3r", "3u", "3f"],
			"C7": ["R", "U", "F", "D", "B", "L", "r", "u", "f", "d", "b", "l", "3r", "3u", "3f", "3d", "3b", "3l"],
			"D0": ["y", "y'", "y2", "y2'"],
			"D2": ["R", "D"],
			"D3": ["R", "D"],
			"D4": ["R", "D", "r", "d"],
			"D5": ["R", "D", "r", "d"],
			"D6": ["R", "D", "r", "d", "3r", "3d"],
			"D7": ["R", "D", "r", "d", "3r", "3d"],
			"D9:": ["R", "D", "r", "d", "3r", "3d", "4r", "4d"],
			"D11": ["R", "D", "r", "d", "3r", "3d", "4r", "4d", "5r", "5d"],
			"P2": ["R", "U", "L", "B"],

			//Functional groups of moves
			"RU": ["R", "U"],
			"RUF": ["R", "U", "F"],
			"RUL": ["R", "U", "L"],
			"RrUu": ["R", "r", "U", "u"],
			"R2U": ["R2", "U", "U2", "U'"],

			//Special groups of moves
			"SP_SKEWB_CO": ["x", "x'", "z", "z2", "z'", "x2", "R' F R F' R' F R F'"],
			"SP_SKEWB_SLEDGE": ["x", "x'", "z", "z'", "z2", "x2", "y", "y'", "y2", "Sledge", "Sledge"]
		};

		// Some often used opposite tables
		var opposites = {
			"NORMAL": {
				"U": "D",
				"F": "B",
				"L": "R"
			}
		}

		//ScrambleDefinition:[ScrambleFunction,[Arguments]]
		var typeToDefinitionsMapping = {
			//WCA Puzzles + 1x1x1
			"111": [scramble, [moves.C2, cubicSuffix, 5]],
			"222": [scramble, [moves.C2, cubicSuffix, 11]],
			"333": [scramble, [moves.C3, cubicSuffix, 22]],
			"444": [scramble, [moves.C4, cubicSuffix, 50]],
			"555": [scramble, [moves.C5, cubicSuffix, 80]],
			"666": [scramble, [moves.C6, cubicSuffix, 110]],
			"777": [scramble, [moves.C7, cubicSuffix, 140]],
			"Pyra": [scramble, [moves.P2, pyraSuffix, 11]],
			"Skewb": [scramble, [moves.P2, pyraSuffix, 11]], //Skewb is cubic but has 4 axis like a pyra
			"Square1": [ret, ["Not available"]],
			"Mega": [scrambleMega, [moves.D3, ["U", "U'"], 10, 5]],

			//Alternavie scramlers
			"111alt": [scramble, [moves.C1, cubicSuffix, 5]],

			"111BLD": [scrambleBld, [moves.C2, cubicSuffix, 6]],
			"222BLD": [scrambleBld, [moves.C2, cubicSuffix, 11]],
			"333BLD": [scrambleBld, [moves.C3, cubicSuffix, 22]],
			"444BLD": [scrambleBld, [moves.C4, cubicSuffix, 50]],
			"555BLD": [scrambleBld, [moves.C5, cubicSuffix, 80]],
			"666BLD": [scrambleBld, [moves.C6, cubicSuffix, 110]],
			"777BLD": [scrambleBld, [moves.C7, cubicSuffix, 140]],

			//Short scramblers
			"111sh": [scramble, [moves.C1, cubicSuffix, 3]],
			"222sh": [scramble, [moves.C2, cubicSuffix, 7]],
			"333sh": [scramble, [moves.C3, cubicSuffix, 15]],
			"444sh": [scramble, [moves.C4, cubicSuffix, 30]],
			"555sh": [scramble, [moves.C5, cubicSuffix, 50]],
			"666sh": [scramble, [moves.C6, cubicSuffix, 80]],
			"777sh": [scramble, [moves.C7, cubicSuffix, 110]],

			//Minxes
			"Mono": [scrambleMega, [moves.D2, moves.D0, 5, 3]],
			"Kilo": [scrambleMega, [moves.D2, moves.D0, 10, 5]],
			"MKilo": [scrambleMega, [moves.D4, moves.D0, 15, 5]],
			"Giga": [scrambleMega, [moves.D5, moves.D0, 20, 5]],
			"MGiga": [scrambleMega, [moves.D6, moves.D0, 15, 10]],
			"Tera": [scrambleMega, [moves.D7, moves.D0, 20, 10]],
			"Peta": [scrambleMega, [moves.D9, moves.D0, 20, 15]],
			"Exa": [scrambleMega, [moves.D11, moves.D0, 20, 20]],

			//Subsets
			"222RU": [scramble, [moves.RU, cubicSuffix, 10]],
			"222R2U": [scramble, [moves.R2U, noSuffix, 8]],
			"222RUFDBL": [scramble, [moves.C3, cubicSuffix, 11]],
			"333RU": [scramble, [moves.RU, cubicSuffix, 21]],
			"333RUF": [scramble, [moves.RUF, cubicSuffix, 21]],
			"333RUL": [scramble, [moves.RUL, cubicSuffix, 21]],
			"444RrUu": [scramble, [moves.RrUu, cubicSuffix, 42]],

			//Special
			"SkewbSledge": [scramble, [moves.SP_SKEWB_SLEDGE, noSuffix, 11]],
			"SkewbCO": [scramble, [moves.SP_SKEWB_CO, noSuffix, 11]],

			//Cuboids
			"122": [scramble, [
				["R2", "U2"], noSuffix, 3
			]],
			"133": [scramble, [
				["R2", "L2", "U2", "D2"], noSuffix, 7
			]],
			"223": [scramble, [cuboidMoves(2, 3), noSuffix, 9, opposites.NORMAL]],
			"224": [scramble, [cuboidMoves(2, 4), noSuffix, 18]],
			"225": [N22CuboidMoves, [5, 13]],
			"226": [scramble, [cuboidMoves(2, 6), noSuffix, 28]],
			"334": [scramble, [cuboidMoves(3, 4), noSuffix, 25]],
			"335": [scramble, [cuboidMoves(3, 5), noSuffix, 35]],
			"442": [scramble, [cuboidMoves(4, 2), noSuffix, 35]],
			"443": [scramble, [cuboidMoves(4, 3), noSuffix, 35]],
			"445": [scramble, [cuboidMoves(4, 5), noSuffix, 50]],
			"446": [scramble, [cuboidMoves(4, 6), noSuffix, 70]],
			"447": [scramble, [cuboidMoves(4, 7), noSuffix, 95]],
			"448": [scramble, [cuboidMoves(4, 8), noSuffix, 135]],
			"553": [scramble, [cuboidMoves(5, 3), noSuffix, 35]],
			"554": [scramble, [cuboidMoves(5, 4), noSuffix, 55]],
			"556": [scramble, [cuboidMoves(5, 6), noSuffix, 135]],
			"557": [scramble, [cuboidMoves(5, 7), noSuffix, 175]],
			"664": [scramble, [cuboidMoves(6, 4), noSuffix, 175]],
			"665": [scramble, [cuboidMoves(6, 5), noSuffix, 175]],
			"668": [scramble, [cuboidMoves(6, 8), noSuffix, 175]],
			"775": [scramble, [cuboidMoves(7, 5), noSuffix, 175]],
			"779": [scramble, [cuboidMoves(7, 9), noSuffix, 175]]
		};

		// Get needed definition
		var definition = typeToDefinitionsMapping[type] || defaultScrambler;

		// Remove the old scramble image
		clearScrambleImage();

		//Relays: Have type in form of "Relay Scrambler1,Scrambler2,...,ScramblerN"
		if (type.split(" ")[0] == "Relay") {
			var relayScramble = [],
				i, type2 = type;
			for (i = 0; i < type2.split(" ")[1].split(",").length; ++i) {
				type = type2.split(" ")[1].split(",")[i];
				// We can only compute one scramble at once with neu() , so call it
				// There can't be infinite recursion as long as no scrambler starts
				// with  "Relay " ,  as we only call ourselves if that is the  case
				relayScramble.push(neu());
			}
			type = type2;
			definition = [ret, [relayScramble.join("<br/>")]];
		} else if (type.split(" ")[0] == "ALG") {
			//Custom scrambler for practising Algsets
			definition = [ret, [algSets.sets[core.get("algCountingData")[0]][core.get("algCountingData")[1]].alg]];
		} else if (type == "777jsss") {
			definition = scrambleImagescrambler("777");
		} else if (type == "666jsss") {
			definition = scrambleImagescrambler("666");
		} else if (type == "555jsss") {
			definition = scrambleImagescrambler("555");
		} else if (type == "444jsss") {
			definition = scrambleImagescrambler("444");
		} else if (type == "333jsss") {
			definition = scrambleImagescrambler("333");
		} else if (type == "222jsss") {
			definition = scrambleImagescrambler("222");
		} else if (type.split(" ")[0] == "EXTENDED") {
			definition = [ret, [eval(xscrambles[type.split(" ")[1]].code)]];
		}

		// Call scramble function
		if (typeof definition[0] === "function")
			cur_scramble = definition[0].apply(null, definition[1]);
		else
			console.log("This scrambler does not work.");

		// Update session scrambler select
		sessions.display();
		sessions.current().scramblerType = type;

		return cur_scramble;
	}

	// @TODO: implement edgescramblers (example call) return edgescramble("r b2",["b2 r'","b2 U2 r U2 r U2 r U2 r"],["u"],30);

	/*
	 * scramble:cuboidMoves
	 * @param height Int
	 * @param width Int
	 * @return Array[String] allowed moves to scramble a width*width*height cuboid
	 */
	function cuboidMoves(width, height) {
		var ishalf = width % 2 == 0,
			moves = [],
			outerhalf = ishalf ? (width - 2) / 2 : (width - 1) / 2,
			i, halfheight = height % 2 == 0 ? height / 2 : (height - 1) / 2;
		for (i = 0; i < outerhalf; ++i) {
			moves.push((i > 0 ? i + 1 : "") + "F2");
			moves.push((i > 0 ? i + 1 : "") + "R2");
			moves.push((i > 0 ? i + 1 : "") + "L2");
			moves.push((i > 0 ? i + 1 : "") + "B2");
		}
		if (ishalf && width / 2 > 1) {
			moves.push(width / 2 + "F2");
			moves.push(width / 2 + "R2");
		} else if (ishalf) {
			// 2x2xN Cuboids would have 1F2 and 1R2, which is unusual and complex
			// A better way to scramble 2x2xN cuboids is to use N22CuboidMoves.
			moves.push("F2");
			moves.push("R2");
		}
		for (i = 0; i < halfheight; ++i) {
			moves.push((i > 0 ? i + 1 : "") + "D");
			moves.push((i > 0 ? i + 1 : "") + "D2");
			moves.push((i > 0 ? i + 1 : "") + "D'");
			moves.push((i > 0 ? i + 1 : "") + "U");
			moves.push((i > 0 ? i + 1 : "") + "U2");
			moves.push((i > 0 ? i + 1 : "") + "U'");
		}
		return moves;
	}

	/*
	 * scramble:N22CuboidMoves(height,length)
	 * scramble 2x2xN cuboids
	 * @param height Int
	 * @param length Int
	 * @return scramble
	 */
	function N22CuboidMoves(height, length) {
		var scramble = [],
			i, j, k, layers = [];
		for (j = 1; j < height; ++j)
			if (j < height / 2)
				layers[j] = (j > 1 ? j : "") + "U";
			else
				layers[j] = ((height - j) > 1 ? (height - j) : "") + "D";
		for (i = 0; i < length; ++i) {
			for (j = 1; j < height; ++j)
				if ((k = Math.round(Math.random() * 3)) > 0)
					scramble.push(layers[j] + (k == 3 ? "'" : k == 1 ? "" : 2));
			scramble.push(rndEl(["R2", "F2"]));
		}
		return scramble.join(" ");
	}

	/*
	 * scramble:scrambleImagescrambler(s)
	 * @param s
	 * @return ScrambleDefinition
	 */
	function scrambleImagescrambler(s) {
		var newDiv;
		scramblers[s].scramble();
		scramblers[s].imagestring(0);
		newDiv = document.createElement("div");
		scramblers[s].drawScramble(newDiv, scramblers[s].posit, 250, 200);
		layout.write("SCRAMBLEIMAGE", newDiv.innerHTML);
		return [ret, [scramblers[s].scramblestring(0)]];
	}

	/*
	 * scramble:clearScrambleImage()
	 * since not all scramblers have an image generating function, we must
	 * clear the space of the previous scramble image to only show correct data
	 */
	function clearScrambleImage() {
		layout.write("SCRAMBLEIMAGE", "");
	}

	/*
	 * scramble:rndEl(x)
	 * @param x Array[Int]
	 * @return Random element of x
	 */

	function rndEl(x) {
		return x[~~(Math.random() * x.length)];
	}

	/*
	 * scramble:rn(n)
	 * @param n Int range
	 * @return Int random number in range n
	 */

	function rn(n) {
		return ~~(Math.random() * n);
	}

	/*
	 * scramble:scramble(turns,suffixes,length)
	 * @param turns Array[String]
	 * @param suffixes Array[String], length>0
	 * @param length Int
	 * @param oppositeTable Object[String: String]
	 * @return scramble
	 */
	function scramble(turns, suffixes, length, oppositeTable) {
		var i, j, moves = [],
			scrambleMoves = [];
		if (!oppositeTable) oppositeTable = {};

		// Check: We can't generate a scramble with only one move available and more than one move needed
		// Check: We need at least one suffix. It may be "".
		if ((turns.length < 2 && length > 1) || suffixes.length < 1) return;

		// Generate list of all combinations of turns and suffixes
		for (i = 0; i < turns.length; ++i)
			for (j = 0; j < suffixes.length; ++j)
				moves.push("" + turns[i] + suffixes[j]);

		// Add moves until the needed length is reached
		while (scrambleMoves.length < length) {
			scrambleMoves.push(rndEl(moves));
			// Don't do A[n] A[m]
			if (scrambleMoves.length > 1 && scrambleMoves[scrambleMoves.length - 1][0] == scrambleMoves[scrambleMoves.length - 2][0])
				scrambleMoves.pop();
			// Don't do A[n] B[m] A[o] if A is opposite to B
			if (scrambleMoves.length > 1 && oppositeTable[scrambleMoves[scrambleMoves.length - 1][0]] == scrambleMoves[scrambleMoves.length - 2][0])
				scrambleMoves.pop();
		}
		return scrambleMoves.join(" ");
	}

	/*
	 * scramble:scramble(turns,suffixes,length)
	 * @param turns
	 * @param suffixes
	 * @param length
	 * @return scramble
	 */
	function scrambleBld(turns, suffixes, length, oppositeTable) {
		return scramble(turns, suffixes, length, oppositeTable) + " " + scramble(["x", "y", "z"], ["", "'", "2"], 2);
	}

	/*
	 * scramble:scrambleMega(turns,rotations,movesPerRow,rows)
	 * @param turns Array[String]
	 * @param rotations Array[String]
	 * @param movesPerRow Int
	 * @param rows Int
	 * @param Scramble for Dodecahedron with given moves and size
	 */
	function scrambleMega(turns, rotations, movesPerRow, rows) {
		var i, j, alg = "",
			turnsIndex = 0;
		for (i = 0; i < rows; ++i) {
			for (j = 0; j < movesPerRow; ++j) {
				alg += turns[turnsIndex++] + rndEl(["++", "--"]) + " ";
				if (turnsIndex > turns.length - 1)
					turnsIndex = 0;
			}
			alg += rndEl(rotations) + "<br>";
			turnsIndex = rn(turns.length);
		}
		return alg;
	}

	/*
	 * scramble:edgescramble(start,end,moves,len)
	 * @param start String
	 * @param end Array[String]
	 * @param moves Array[String]
	 * @param length Int
	 */
	function edgescramble(start, end, moves, len) {
		var u, d, ud, movemis, triggers, trigger, i, done, v, x, j, layer, turn, cubesuff;

		cubesuff = ["", "2", "'"];
		u = 0, d = 0, movemis = [];
		triggers = [
			["R", "R'"],
			["R'", "R"],
			["L", "L'"],
			["L'", "L"],
			["F'", "F"],
			["F", "F'"],
			["B", "B'"],
			["B'", "B"]
		];
		ud = ["U", "D"];
		scramble = start;
		for (i = 0; i < moves.length; i++)
			movemis[i] = 0;

		for (i = 0; i < len; i++) {
			done = false;
			while (!done) {
				v = "";
				for (j = 0; j < moves.length; j++) {
					x = rn(4);
					movemis[j] += x;
					if (x != 0) {
						done = true;
						v += " " + moves[j] + cubesuff[x - 1];
					}
				}
			}
			trigger = rn(8);
			layer = rn(2);
			turn = rn(3);
			scramble += v + " " + triggers[trigger][0] + " " + ud[layer] + cubesuff[turn] + " " + triggers[trigger][1];
			if (layer == 0)
				u += turn + 1;
			if (layer == 1)
				d += turn + 1;
		}

		for (i = 0; i < moves.length; i++) {
			x = 4 - (movemis[i] % 4);
			if (x < 4)
				scramble += " " + moves[i] + cubesuff[x - 1];
		}
		u = 4 - (u % 4);
		d = 4 - (d % 4);
		if (u < 4)
			scramble += " U" + cubesuff[u - 1];
		if (d < 4)
			scramble += " D" + cubesuff[d - 1];
		scramble += " " + rndEl(end);
		return scramble;
	}

	/*
	 * scramble:get_scramble()
	 * @return the current scramble
	 */
	function get_scramble() {
		return cur_scramble;
	}

	/*
	 * scramble:get_type()
	 * @return the current scrambler type
	 */
	function get_type() {
		return type;
	}

	/*
	 * scramble:switchScrambler(to)
	 * @param to String scramblertype
	 */
	function switchScrambler(to) {
		type = to;
		sessions.current().scrambleType = type;
		neu();
		draw();
	}

	/*
	 * scramble:displayExtendet()
	 */
	function displayExtendet() {
		var html = "",
			i;
		for (i = 0; i < xscrambles.length; ++i) {
			html += "<h3>" + xscrambles[i].uname + ":" + xscrambles[i].sname + "</h3>" +
				xscrambles[i].description + "<br/>" + (xscrambles[i].compatibleVersion != "all" ? "This scrambler may be incompatible with your timer version. " : "") + "<button onclick='scramble.switchScrambler(\"EXTENDED " + i + "\");document.getElementsByClassName(\"SCRAMBLESELECT\")[0].style.display=\"none\";'>select</button>"
		}
		html += "<br/><br/><button onclick='scramble.drawSelect();'>Select from normal scramblers</button>"
		layout.write("SCRAMBLESELECT1", html);
		layout.write("SCRAMBLESELECT2", "");
		layout.write("SCRAMBLESELECT3", "");
		layout.write("SCRAMBLESELECT4", "");
	}

	var xscrambles = [{
		"uname": "YTCuber",
		"sname": "Random Number scrambler",
		"description": "Sets the scramble to a random number between 0 and 1, rounded to 3 decimals.",
		"compatibleVersion": "all",
		"code": "Math.round(Math.random()*1e3)/1e3;",
	}, {
		"uname": "YTCuber",
		"sname": "1x1x3",
		"description": "Uses U and D moves. Orient the puzzle, so that the three layers go from bottom to top.",
		"compatibleVersion": "all",
		"code": "['U','Ui','D','Di','U Di','U2','D2','Ui D','U2 D2','U2 Di','D2 Ui'][~~(Math.random() * 11)]"
	}];

	return {
		init: init,
		sessionSwitchInit: sessionSwitchInit,
		scramble: scramble,
		switchScrambler: switchScrambler,
		neu: neu,
		draw: draw,
		drawSelect: drawSelect,
		getScramble: get_scramble,
		get_type: get_type,
		displayExtendet: displayExtendet,
		selectScrambler3: selectScrambler3,
		selectScrambler2: selectScrambler2,
		selectScrambler1: selectScrambler1
	}
})();
