/*
 * core.js
 */

var core = (function() {
	var list = {};
	var start = new Date();

	/*
	 * core:Init()
	 */
	function init() {
		core.start = new Date();
	}

	/*
	 * core:Set(key,value)
	 * @param key   String
	 * @param value String
	 *
	 * Registers value with the identifier key, and marks it to be included in every export
	 */
	function set(key, value) {
		var tr = (new Error).stack;
		tr = tr.split("\n");
		for (var i = 0; i < tr.length; ++i)
			tr[i] = tr[i].split("@")[0] + "@" + tr[i].split("/")[tr[i].split("/").length - 1];
		log.unshift((new Date().getSeconds() - core.start.getSeconds()) + "." + (new Date().getMilliseconds()) + ": SET " + key + " TO " + value + " BY \n" + tr.join("\n"));
		core.list[key] = value;
	}

	/*
	 * core:get(key)
	 * @param key String
	 * @return String The variable that has been found using key. Returns "" on error.
	 */
	var log = [];

	function get(key) {
		var tr = (new Error).stack;
		tr = tr.split("\n");
		for (var i = 0; i < tr.length; ++i)
			tr[i] = tr[i].split("@")[0] + "@" + tr[i].split("/")[tr[i].split("/").length - 1];
		log.unshift((new Date().getSeconds() - core.start.getSeconds()) + "." + (new Date().getMilliseconds()) + ": GET " + key + " BY\n" + tr.join("\n"));
		return core.list[key];
	}

	/*
	 * core:getAll()
	 * returns the whole list, useful for exporting
	 */
	function getAll() {
		return core.list;
	}

	function displayLog() {
		layout.write("LOG", html.el("pre", log.join("\n")).substr(0, 100000));
	}

	return {
		init: init,
		get: get,
		set: set,
		getAll: getAll,
		displayLog: displayLog,
		list: list,
		log: log,
		start: start
	}
})();
