/*
 * server.js
 */

var server = (function() {
	/*
	 * server:Init()
	 */
	function init() {

	}

	const SERVER_PATH = "../Timer-Server/";
	const TIMER_PATH = "../Timer/";

	/*
	 * server:json(url)
	 * @param url String Url
	 * @param callback Function
	 * Example use: server.json("js/goals.js",function(t){console.log(t.response);})
	 */
	function json(url, callback, params) {
		var jsonFile = new XMLHttpRequest();
		jsonFile.open("POST", url, true);
		// Source of the next 3 lines: openjs.com/articles/ajax_xmlhttp_using_post.php
		jsonFile.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		jsonFile.setRequestHeader("Content-length", params.length);
		jsonFile.setRequestHeader("Connection", "close");
		jsonFile.send(params);
		jsonFile.onload = function() {
			callback(jsonFile)
		};
	}

	function saveTime() {
		server.json("../Timer-Server/changeoptions.php", function(t) {
			console.log("Saved data: " + t.response);
		}, "change=timelist&value=" + JSON.stringify(core.get("config")));
	}

	return {
		init: init,
		json: json,
		saveTime: saveTime
	}
})();
