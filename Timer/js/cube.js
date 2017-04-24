var cube = (function() {
	var collection = [];

	/*
	 * cube:init()
	 */
	function init(myCubes) {
		cube.collection = collection = myCubes;
		for (i = 0; i < collection.length; ++i) {
			cube.collection[i].name = collection[i].company + " " + collection[i].model + " " + collection[i].color;
		}
	}


	/*
	 * cube:display_collection()
	 */

	function display_collection() {
		var html = "<h2>Cube collection</h2>",
			i;
		for (i = 0; i < cube.collection.length; ++i) {
			html += cube.collection[i].name + "<br/>";
		}
		layout.write("COLLECTION", html);
	}

	function identifierToName(identifier) {
		var name = "no Cube";
		for (i = 0; i < cube.collection.length; ++i) {
			if (cube.collection[i].identifier == identifier)
				name = cube.collection[i].name;
		}
		return name;
	}

	return {
		init: init,
		display_collection: display_collection,
		collection: collection,
		identifierToName: identifierToName
	}
})();
