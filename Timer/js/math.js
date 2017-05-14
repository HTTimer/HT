/*
 * math.js
 */
var math = (function() {
	const DNF = -1; //Number representation of a DNF

	/*
	 * math:Init()
	 */
	function init() {

	}

	/*
	 * math:getMean(times)
	 * @param times Array of solves to get an mean of
	 * @returns mean of times, or -1 in case of DNF
	 */
	function getMean(times) {
		var cntdnf, cnttime, i, sum;
		sum = 0;
		cntdnf = 0;
		cnttime = 0;
		for (i = 0; i < times.length; ++i) {
			if (times[i].zeit > 0) sum += times[i].zeit;
			else cntdnf++;
			cnttime++;
		}
		if (cntdnf > 0) {
			return DNF;
		}
		return sum / (cnttime);

	}
	/*
	 * math:getAverage(times)
	 * @param times Array of solves to get an average of
	 * @returns average of times, or -1 in case of DNF
	 * @Todo remove best and worst 5%
	 */
	function getAverage(times) {
		var cntdnf, cnttime, sum, i;
		cntdnf = 0;
		cnttime = 0;
		sum = 0;
		for (i = 0; i < times.length; ++i) {
			if (times[i].zeit > 0) sum += times[i].zeit,
				cnttime++;
			else cntdnf++;
		}
		if (cntdnf > times.length * 0.05) return DNF;
		return sum / (cnttime);
	}

	/*
	 * math:getBest(times)
	 * @param times Array of solves
	 * @returns the best time
	 */
	function getBest(times) {
		var best = DNF,
			i;
		for (i = 0; i < times.length; ++i)
			if (times[i].zeit < best) best = times[i].zeit;
		return best;
	}

	/*
	 * math:getWorst(times)
	 * @param times Array of solves
	 * @returns the best time
	 */
	function getWorst(times) {
		var worst = DNF,
			i;
		for (i = 0; i < times.length; ++i)
			if (times[i].zeit > worst) worst = times[i].zeit;
		return worst;
	}

	/*
	 * math:getBestMean(times,off)
	 * @param times Array of all solves
	 * @param off Int average size
	 * @returns best mean of off of all given times
	 */
	function getBestMean(times, off) {
		var best = +Infinity,
			i, j, averageTimeList;
		if (times.length < off) return DNF;
		for (i = off; i < times.length; ++i) {
			averageTimeList = [];
			for (j = 0; j < off; ++j) averageTimeList.push(times[i - j]);
			if (getAverage(averageTimeList) < best) best = getAverage(averageTimeList);
		}
		return best == +Infinity ? DNF : best;
	}

	/*
	 * math:getBestMean(times,off)
	 * @param times Array of all solves
	 * @param off Int average size
	 * @returns current mean of off of all given times
	 */
	function getCurrentMean(times, off) {
		var newTimes = [],
			i;
		if (times.length < off) return DNF;
		for (i = times.length - 1; i > times.length - off - 1; --i)
			newTimes.push(times[i]);
		return getMean(newTimes);
	}

	/*
	 * math:format(time)
	 * @param time Int in milliseconds
	 * @returns formatted time as string
	 */
	function format(time) {
		var useMilliseconds = core.get("optUseMilliseconds");
		var bits, secs, mins, hours, s;
		if (time < 0) return "DNF";
		time = Math.round(time / (useMilliseconds ? 1 : 10));
		bits = time % (useMilliseconds ? 1000 : 100);
		time = (time - bits) / (useMilliseconds ? 1000 : 100);
		secs = time % 60;
		mins = ((time - secs) / 60) % 60;
		hours = (time - secs - 60 * mins) / 3600;
		s = "" + bits;

		//Fill 0s
		if (bits < 10) s = "0" + s;
		if (bits < 100 && useMilliseconds) s = "0" + s;
		s = secs + "." + s;
		//Fill 0s and append minutes if neccessary
		if (secs < 10 && (mins > 0 || hours > 0)) s = "0" + s;
		if (mins > 0 || hours > 0) s = mins + ":" + s;
		if (mins < 20 && hours > 0) s = "0" + s;
		if (hours > 0) s = hours + ":" + s;
		return lcd(s);
	}

	/*
	 * math:formatPenalty(solve)
	 * @param solve solve Object
	 * @returns formatted time as string
	 */
	function formatPenalty(solve) {
		var time = solve.zeit,
			ret, nrofPlus, i;
		if (solve.penalty == -1) return "DNF";
		if (solve.penalty > 0) time += solve.penalty;
		ret = format(time);
		if (solve.penalty / 1000 % 2 == 0) nrofPlus = solve.penalty / 2000;
		else nrofPlus = (solve.penalty - 1) / 2000;
		for (i = 0; i < nrofPlus; ++i) ret += "+";
		return ret;
	}

	/*
	 * math:algInvert(alg,type)
	 * @param alg String algorithm
	 * @return inverted alg
	 */
	function algInvert(alg) {
		var i, out = [];
		alg = alg.split(" ");
		for (i = 0; i < alg.length; ++i) {
			out.unshift(alg[i][alg[i].length - 1] == "'" ? alg[i][0] : (alg[i][alg[i].length - 1] == "2" ? alg[i] : alg[i][0] + "'"));
		}
		return out.join(' ');
	}

	/*
	 * math:applyPenalty(time,p)
	 * @param time time in ms, <0 for DNF(-time)
	 * @param p Penalty in seconds, +seconds for adding, -seconds for removing, -1 for removing DNF, +1 for setting DNF
	 * @returns time + penalty p
	 */
	function applyPenalty(time, p) {
		if (time < 0) {
			if (p == -1) return -time;
			return time;
		}
		if (p == 1) return -time;
		if (p == -1) return time;
		return time + p * 1000;
	}

	/*
	 * math:lcd(s)
	 * Some digital Fonts need fixing for the width of the 1. This can be done here when changing the font.
	 */
	function lcd(s) {
		//return s.replace(1, " 1");
		return s;
	}

	/*
	 * math:formatDate(ms)
	 * @param ms Int
	 */
	function formatDate(ms) {
		var dt;

		function addZ(n) {
			return (n < 10 ? '0' : '') + n;
		}
		dt = new Date(ms);
		return dt.getFullYear() + "/" + (dt.getMonth() + 1) + "/" + dt.getDate() + " " + addZ(dt.getHours()) + ':' + addZ(dt.getMinutes()) + ':' + addZ(dt.getSeconds()) + "." + dt.getMilliseconds();
	}

	/*
	 * math:invertAlg(alg)
	 * @param alg String Algorithm
	 * @returns alg in reverse
	 */
	function invertAlg(alg) {
		var alg = alg.split(" "),
			i;
		for (i = 0; i < alg.length; ++i) {
			if (alg[i][alg[i].length - 1] == "2") alg[i][alg[i].length - 1] = "2";
			else if (alg[i][alg[i].length - 1] == "'") alg[i][alg[i].length - 1] = "";
			else alg[i][alg[i].length - 1] = "'";
		}
		return alg.reverse().join(" ");
	}

	return {
		init: init,
		mean: getMean,
		average: getAverage,
		best: getBest,
		worst: getWorst,
		bestMean: getBestMean,
		currentMean: getCurrentMean,
		format: format,
		formatPenalty: formatPenalty,
		algInvert: algInvert,
		applyPenalty: applyPenalty,
		formatDate: formatDate,
		invertAlg: invertAlg
	}
})();
