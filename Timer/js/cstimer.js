function importCsTimer() {
	var data = JSON.parse(prompt("Paste the content of an csTimer export file here"));
	var properties = JSON.parse(data.properties);
	var sessionsNames = JSON.parse(properties.sessionName);
	var sessionsScramblers = JSON.parse(properties.sessionScr);

	for (var key in sessionsNames) {
		if (sessionsNames.hasOwnProperty(key)) {
			if (data["session" + key]) {
				console.log("found session " + key + ", created " + sessionsNames[key]);
				sessions.create(1, 15, sessionsNames[key], "normal", "", "333jsss");
				data["session" + key] = JSON.parse(data["session" + key]);
				for (var i = 0; i < data["session" + key].length; ++i) {
					console.log("found solve with time: " + data["session" + key][i][0][1]);
					core.get("config").timeList[core.get("config").timeList.length - 1].push({
						startTime: 0,
						endTime: data["session" + key][i][0][1],
						currentInspection: 1,
						zeit: data["session" + key][i][0][1],
						penalty: 0,
						flags: {
							fake: false,
							uwr: false,
							overinspect: false,
							csImport: true
						},
						scramble: data["session" + key][i][1],
						cube: [null, "no cube"],
						solveType: "normal",
						method: ""
					});
				}
			}
		}
	}
	sessions.display();

	server.saveTime();
}
