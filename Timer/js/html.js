/*
 * html.js
 * Generates HTML-Tags with contents
 */

var html = (function() {
	/*
	 * html:Init()
	 */
	function init() {

	}

	/*
	 * html:tr()
	 * @params contents of tds
	 * @returns html tr with tds inside
	 */
	function tr() {
		var total = "",
			i;

		for (i = 0; i < arguments.length; ++i) {
			total += el("td", arguments[i]);
		}

		return el("tr", total);
	}

	/*
	 * html:table(tr)
	 * @param tr Code for all trs
	 * @returns a html table containig the trs from tr
	 */
	function table(tr) {
		return el("table", tr);
	}

	/*
	 * html:td(val)
	 * @param val Code for td
	 * @returns a td containing val
	 */
	function td(val) {
		return el("td", val);
	}

	/*
	 * html:el(elm,val)
	 * @param elm String Code for el
	 * @param val String|Int value
	 * @returns a elm containing val
	 * @author YTCuber
	 * Don't change this method
	 * If you need to change this method, create your own one
	 */
	function el(elm, val) {
		if (elm == "br" || elm == "hr")
			return "<" + elm + "/>";
		if (val == "")
			return "<" + elm + "/>";
		return "<" + elm + ">" + val + "</" + elm + ">";
	}

	/*
	 * html:toggle(id)
	 * @param id Id for element to toggle visibility
	 * @TODO This function shouldn't be here
	 */
	function toggle(id) {
		var elem = document.getElementById(id);
		if (elem.style.display != "") {
			if (elem.style.display == "none")
				elem.style.display = "block";
			else
				elem.style.display = "none";
		} else {
			elem.style.display = "block";
		}
	}

	/*
	 * html:keycode(code)
	 * @param code String Text to put into the element
	 * @return HTML containg the keycode with a class, which makes it display on pressing alt
	 */
	function keycode(code) {
		return '<span class="keycodes">' + code + '</span>'
	}

	return {
		init: init,
		tr: tr,
		td: td,
		table: table,
		toggle: toggle,
		el: el,
		keycode: keycode
	}
})();
