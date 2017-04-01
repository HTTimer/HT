/**
 * jquery.filterTable
 *
 * This plugin will add a search filter to tables. When typing in the filter,
 * any rows that do not contain the filter will be hidden.
 *
 * Utilizes bindWithDelay() if available. https://github.com/bgrins/bindWithDelay
 *
 * @version v1.5.7
 * @author Sunny Walker, swalker@hawaii.edu
 * @license MIT
 */
! function($) {
	var e = $.fn.jquery.split("."),
		t = parseFloat(e[0]),
		i = parseFloat(e[1]);
	t < 2 && i < 8 ? ($.expr[":"].filterTableFind = function(e, t, i) {
		return $(e).text().toUpperCase().indexOf(i[3].toUpperCase().replace(/"""/g, '"').replace(/"\\"/g, "\\")) >= 0
	}, $.expr[":"].filterTableFindAny = function(e, t, i) {
		var n = i[3].split(/[\s,]/),
			r = [];
		return $.each(n, function(e, t) {
			var i = t.replace(/^\s+|\s$/g, "");
			i && r.push(i)
		}), !!r.length && function(e) {
			var t = !1;
			return $.each(r, function(i, n) {
				if ($(e).text().toUpperCase().indexOf(n.toUpperCase().replace(/"""/g, '"').replace(/"\\"/g, "\\")) >= 0) return t = !0, !1
			}), t
		}
	}, $.expr[":"].filterTableFindAll = function(e, t, i) {
		var n = i[3].split(/[\s,]/),
			r = [];
		return $.each(n, function(e, t) {
			var i = t.replace(/^\s+|\s$/g, "");
			i && r.push(i)
		}), !!r.length && function(e) {
			var t = 0;
			return $.each(r, function(i, n) {
				$(e).text().toUpperCase().indexOf(n.toUpperCase().replace(/"""/g, '"').replace(/"\\"/g, "\\")) >= 0 && t++
			}), t === r.length
		}
	}) : ($.expr[":"].filterTableFind = jQuery.expr.createPseudo(function(e) {
		return function(t) {
			return $(t).text().toUpperCase().indexOf(e.toUpperCase().replace(/"""/g, '"').replace(/"\\"/g, "\\")) >= 0
		}
	}), $.expr[":"].filterTableFindAny = jQuery.expr.createPseudo(function(e) {
		var t = e.split(/[\s,]/),
			i = [];
		return $.each(t, function(e, t) {
			var n = t.replace(/^\s+|\s$/g, "");
			n && i.push(n)
		}), !!i.length && function(e) {
			var t = !1;
			return $.each(i, function(i, n) {
				if ($(e).text().toUpperCase().indexOf(n.toUpperCase().replace(/"""/g, '"').replace(/"\\"/g, "\\")) >= 0) return t = !0, !1
			}), t
		}
	}), $.expr[":"].filterTableFindAll = jQuery.expr.createPseudo(function(e) {
		var t = e.split(/[\s,]/),
			i = [];
		return $.each(t, function(e, t) {
			var n = t.replace(/^\s+|\s$/g, "");
			n && i.push(n)
		}), !!i.length && function(e) {
			var t = 0;
			return $.each(i, function(i, n) {
				$(e).text().toUpperCase().indexOf(n.toUpperCase().replace(/"""/g, '"').replace(/"\\"/g, "\\")) >= 0 && t++
			}), t === i.length
		}
	})), $.fn.filterTable = function(e) {
		var t = {
				autofocus: !1,
				callback: null,
				containerClass: "filter-table",
				containerTag: "p",
				filterExpression: "filterTableFind",
				hideTFootOnFilter: !1,
				highlightClass: "alt",
				ignoreClass: "",
				ignoreColumns: [],
				inputSelector: null,
				inputName: "",
				inputType: "search",
				label: "Filter:",
				minChars: 1,
				minRows: 8,
				placeholder: "search this table",
				preventReturnKey: !0,
				quickList: [],
				quickListClass: "quick",
				quickListClear: "",
				quickListGroupTag: "",
				quickListTag: "a",
				visibleClass: "visible"
			},
			i = function(e) {
				return e.replace(/&/g, "&amp;").replace(/"/g, "&quot;").replace(/</g, "&lt;").replace(/>/g, "&gt;")
			},
			n = $.extend({}, t, e),
			r = function(e, t) {
				var i = e.find("tbody");
				if ("" === t || t.length < n.minChars) i.find("tr").show().addClass(n.visibleClass), i.find("td").removeClass(n.highlightClass), n.hideTFootOnFilter && e.find("tfoot").show();
				else {
					var r = i.find("td");
					if (i.find("tr").hide().removeClass(n.visibleClass), r.removeClass(n.highlightClass), n.hideTFootOnFilter && e.find("tfoot").hide(), n.ignoreColumns.length) {
						var a = [];
						n.ignoreClass && (r = r.not("." + n.ignoreClass)), a = r.filter(":" + n.filterExpression + '("' + t + '")'), a.each(function() {
							var e = $(this),
								t = e.parent().children().index(e);
							$.inArray(t, n.ignoreColumns) === -1 && e.addClass(n.highlightClass).closest("tr").show().addClass(n.visibleClass)
						})
					} else n.ignoreClass && (r = r.not("." + n.ignoreClass)), r.filter(":" + n.filterExpression + '("' + t + '")').addClass(n.highlightClass).closest("tr").show().addClass(n.visibleClass)
				}
				n.callback && n.callback(t, e)
			};
		return this.each(function() {
			var e = $(this),
				t = e.find("tbody"),
				a = null,
				l = null,
				s = null,
				c = !0;
			if ("TABLE" === e[0].nodeName && t.length > 0 && (0 === n.minRows || n.minRows > 0 && t.find("tr").length >= n.minRows) && !e.prev().hasClass(n.containerClass)) {
				if (n.inputSelector && 1 === $(n.inputSelector).length ? (s = $(n.inputSelector), a = s.parent(), c = !1) : (a = $("<" + n.containerTag + " />"), "" !== n.containerClass && a.addClass(n.containerClass), a.prepend(n.label + " "), s = $('<input class="tablesorter-input" type="' + n.inputType + '" placeholder="' + n.placeholder + '" name="' + n.inputName + '" />'), n.preventReturnKey && s.on("keydown", function(e) {
						if (13 === (e.keyCode || e.which)) return e.preventDefault(), !1
					})), n.autofocus && s.attr("autofocus", !0), $.fn.bindWithDelay ? s.bindWithDelay("keyup", function() {
						r(e, $(this).val())
					}, 200) : s.bind("keyup", function() {
						r(e, $(this).val())
					}), s.bind("click search input paste blur", function() {
						r(e, $(this).val())
					}), c && a.append(s), n.quickList.length > 0 || n.quickListClear) {
					if (l = n.quickListGroupTag ? $("<" + n.quickListGroupTag + " />") : a, $.each(n.quickList, function(e, t) {
							var r = $("<" + n.quickListTag + ' class="' + n.quickListClass + '" />');
							r.text(i(t)), "A" === r[0].nodeName && r.attr("href", "#"), r.bind("click", function(e) {
								e.preventDefault(), s.val(t).focus().trigger("click")
							}), l.append(r)
						}), n.quickListClear) {
						var o = $("<" + n.quickListTag + ' class="' + n.quickListClass + '" />');
						o.html(n.quickListClear), "A" === o[0].nodeName && o.attr("href", "#"), o.bind("click", function(e) {
							e.preventDefault(), s.val("").focus().trigger("click")
						}), l.append(o)
					}
					l !== a && a.append(l)
				}
				c && e.before(a)
			}
		})
	}
}(jQuery);
