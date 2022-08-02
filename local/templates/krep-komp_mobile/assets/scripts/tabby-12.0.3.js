/*! tabbyjs v12.0.3 | (c) 2019 Chris Ferdinandi | MIT License | http://github.com/cferdinandi/tabby */
Element.prototype.matches || (Element.prototype.matches = Element.prototype.msMatchesSelector || Element.prototype.webkitMatchesSelector),


function (e, t) {
        "function" == typeof define && define.amd ? define([], (function () {
                return t(e)
        })) : "object" == typeof exports ? module.exports = t(e) : e.Tabby = t(e)
}("undefined" != typeof global ? global : "undefined" != typeof window ? window : this, (function (e) {
        "use strict";
        var t = {
                idPrefix: "tabby-toggle_",
        default:
                "[data-tabby-default]"
        },
                r = function (t) {
                        if (t && "true" != t.getAttribute("aria-selected")) {
                                var r = document.querySelector(t.hash);
                                if (r) {
                                        var o = function (e) {
                                                var t = e.closest('[role="tablist"]');
                                                if (!t) return {};
                                                var r = t.querySelector('[role="tab"][aria-selected="true"]');
                                                if (!r) return {};
                                                var o = document.querySelector(r.hash);
                                                return r.setAttribute("aria-selected", "false"),
                                                r.setAttribute("tabindex", "-1"),
                                                o ? (o.setAttribute("hidden", "hidden"), {
                                                        previousTab: r,
                                                        previousContent: o
                                                }) : {
                                                        previousTab: r
                                                }
                                        }(t);
                                        !
                                        function (e, t) {
                                                e.setAttribute("aria-selected", "true"),
                                                e.setAttribute("tabindex", "0"),
                                                t.removeAttribute("hidden"),
                                                e.focus()
                                        }(t, r),
                                        o.tab = t,
                                        o.content = r,


                                        function (t, r) {
                                                var o;
                                                "function" == typeof e.CustomEvent ? o = new CustomEvent("tabby", {
                                                        bubbles: !0,
                                                        cancelable: !0,
                                                        detail: r
                                                }) : (o = document.createEvent("CustomEvent")).initCustomEvent("tabby", !0, !0, r),
                                                t.dispatchEvent(o)
                                        }(t, o)
                                }
                        }
                };
        return function (o, n) {
                var i, a, u = {
                        destroy: function () {
                                var e = a.querySelectorAll("a");
                                Array.prototype.forEach.call(e, (function (e) {
                                        var t = document.querySelector(e.hash);
                                        t &&
                                        function (e, t, r) {
                                                e.id.slice(0, r.idPrefix.length) === r.idPrefix && (e.id = ""),
                                                e.removeAttribute("role"),
                                                e.removeAttribute("aria-controls"),
                                                e.removeAttribute("aria-selected"),
                                                e.removeAttribute("tabindex"),
                                                e.closest("li").removeAttribute("role"),
                                                t.removeAttribute("role"),
                                                t.removeAttribute("aria-labelledby"),
                                                t.removeAttribute("hidden")
                                        }(e, t, i)
                                })),
                                a.removeAttribute("role"),
                                document.documentElement.removeEventListener("click", l, !0),
                                a.removeEventListener("keydown", c, !0),
                                i = null,
                                a = null
                        },
                        setup: function () {
                                if (a = document.querySelector(o)) {
                                        var e = a.querySelectorAll("a");
                                        a.setAttribute("role", "tablist"),
                                        Array.prototype.forEach.call(e, (function (e) {
                                                var t = document.querySelector(e.hash);
                                                t &&
                                                function (e, t, r) {
                                                        e.id || (e.id = r.idPrefix + t.id),
                                                        e.setAttribute("role", "tab"),
                                                        e.setAttribute("aria-controls", t.id),
                                                        e.closest("li").setAttribute("role", "presentation"),
                                                        t.setAttribute("role", "tabpanel"),
                                                        t.setAttribute("aria-labelledby", e.id),
                                                        e.matches(r.
                                                default) ? e.setAttribute("aria-selected", "true") : (e.setAttribute("aria-selected", "false"), e.setAttribute("tabindex", "-1"), t.setAttribute("hidden", "hidden"))
                                                }(e, t, i)
                                        }))
                                }
                        },
                        toggle: function (e) {
                                var t = e;
                                "string" == typeof e && (t = document.querySelector(o + ' [role="tab"][href*="' + e + '"]')),
                                r(t)
                        }
                },
                        l = function (e) {
                                var t = e.target.closest(o + ' [role="tab"]');
                                t && (e.preventDefault(), r(t))
                        },
                        c = function (e) {
                                var t = document.activeElement;
                                t.matches(o + ' [role="tab"]') && (["ArrowUp", "ArrowDown", "ArrowLeft", "ArrowRight", "Up", "Down", "Left", "Right", "Home", "End"].indexOf(e.key) < 0 ||
                                function (e, t) {
                                        var o = function (e) {
                                                var t = e.closest('[role="tablist"]'),
                                                        r = t ? t.querySelectorAll('[role="tab"]') : null;
                                                if (r) return {
                                                        tabs: r,
                                                        index: Array.prototype.indexOf.call(r, e)
                                                }
                                        }(e);
                                        if (o) {
                                                var n, i = o.tabs.length - 1;
                                                ["ArrowUp", "ArrowLeft", "Up", "Left"].indexOf(t) > -1 ? n = o.index < 1 ? i : o.index - 1 : ["ArrowDown", "ArrowRight", "Down", "Right"].indexOf(t) > -1 ? n = o.index === i ? 0 : o.index + 1 : "Home" === t ? n = 0 : "End" === t && (n = i),
                                                r(o.tabs[n])
                                        }
                                }(t, e.key))
                        };
                return i = function () {
                        var e = {};
                        return Array.prototype.forEach.call(arguments, (function (t) {
                                for (var r in t) {
                                        if (!t.hasOwnProperty(r)) return;
                                        e[r] = t[r]
                                }
                        })),
                        e
                }(t, n || {}),
                u.setup(),


                function (t) {
                        if (!(e.location.hash.length < 1)) {
                                var o = document.querySelector(t + ' [role="tab"][href*="' + e.location.hash + '"]');
                                r(o)
                        }
                }(o),
                document.documentElement.addEventListener("click", l, !0),
                a.addEventListener("keydown", c, !0),
                u
        }
}));