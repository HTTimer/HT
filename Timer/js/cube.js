var cube = (function() {

	/*
	 * cube:init()
	 */
	function init(a) {
		if (typeof a === "undefined") return
		data = JSON.parse(a);
	}

	var colors = [
		["Black", "White"],
		["black", "white", "stickerless"],
		["stickerless"]
	];

	/*
	 * cube:display()
	 * cube:display2()
	 * displays an select field for cube types
	 */
	function display() {
		var html = "<select size='" + data.length + "'>",
			i;
		for (i = 0; i < data.length; ++i) {
			html += "<option onclick='cube.display2(" + i + ")'>" + data[i].name + "</option>"
		}
		html += "</select>";

		document.getElementsByClassName('CUBESELECT')[0].style.display = "block";
		layout.write("CUBESELECT1", html);
	}

	function display2(i) {
		var html = "<select size='" + data.length + "'>",
			j;
		for (j = 0; j < data[i].cubes.length; ++j) {
			html += "<option onclick='cube.set(" + i + "," + j + ")'>" + data[i].cubes[j].name + "</option>";
		}
		html += "</select>"
		layout.write("CUBESELECT2", html);
		for (j = 0, html = "<select size='" + data.length + "'>"; j < ["black", "white"].length; ++j) {
			html += "<option onclick='cube.set(" + j + ");cube.close();'>" + ["black", "white"][j] + "</option>";
		}
		html += "</select>"
		layout.write("CUBESELECT3", html);
	}

	/*
	 * cube:getSelected()
	 * returns the value of the cube selected by calling display and filling in
	 * the form
	 */
	function getSelected() {
		return [currentData, data[currentData[0]].name +
			" " + data[currentData[0]].cubes[currentData[1]].name +
			" " + colors[data[currentData[0]].cubes[currentData[1]].colors][currentData[2]]
		];
	}

	var currentData = [];

	/*
	 * cube:set()
	 */
	function set() {
		if (arguments.length == 2)
			return currentData = [arguments[0], arguments[1]];
		currentData.push(arguments[0]);
	}

	/*
	 * cube:close()
	 * closes the window opened to select the puzzle
	 */
	function close() {
		document.getElementsByClassName('CUBESELECT')[0].style.display = "none";
		cube_collection.push(getSelected());
		display_collection();
		sessions.display();
	}

	/*
	 * cube:display_collection()
	 */
	var cube_collection = [];

	function display_collection() {
		var html = "<h2>Cube collection</h2>",
			i;
		for (i = 0; i < cube_collection.length; ++i) {
			html += cube_collection[i][1] + "<br/>";
		}
		html += "<br/><button onclick='cube.display()'>Add cube</button>";
		layout.write("COLLECTION", html);
	}

	return {
		init: init,
		display: display,
		display2: display2,
		getSelected: getSelected,
		set: set,
		close: close,

		display_collection: display_collection,
		cube_collection: cube_collection
	}
})();
