/*!
 * pickadate.js v3.4.0, 2014/02/15
 * By Amsul, http://amsul.ca
 * Hosted on http://amsul.github.io/pickadate.js
 * Licensed under MIT
 */
!function (a) {
    "function" == typeof define && define.amd ? define("picker", ["jquery"], a) : this.Picker = a(jQuery)
}(function (a) {
    function b(d, e, g, h) {
        function i() {
            return b._.node("div", b._.node("div", b._.node("div", b._.node("div", s.component.nodes(n.open), p.box), p.wrap), p.frame), p.holder)
        }

        function j() {
            q.data(e, s).addClass(p.input).val(q.data("value") ? s.get("select", o.format) : d.value).on("focus." + n.id + " click." + n.id, m), o.editable || q.on("keydown." + n.id, function (a) {
                var b = a.keyCode, c = /^(8|46)$/.test(b);
                return 27 == b ? (s.close(), !1) : void((32 == b || c || !n.open && s.component.key[b]) && (a.preventDefault(), a.stopPropagation(), c ? s.clear().close() : s.open()))
            }), c(d, {haspopup: !0, expanded: !1, readonly: !1, owns: d.id + "_root" + (s._hidden ? " " + s._hidden.id : "")})
        }

        function k() {
            s.$root.on({focusin: function (a) {
                s.$root.removeClass(p.focused), c(s.$root[0], "selected", !1), a.stopPropagation()
            }, "mousedown click": function (b) {
                var c = b.target;
                c != s.$root.children()[0] && (b.stopPropagation(), "mousedown" != b.type || a(c).is(":input") || "OPTION" == c.nodeName || (b.preventDefault(), d.focus()))
            }}).on("click", "[data-pick], [data-nav], [data-clear]", function () {
                var c = a(this), e = c.data(), f = c.hasClass(p.navDisabled) || c.hasClass(p.disabled), g = document.activeElement;
                g = g && (g.type || g.href) && g, (f || g && !a.contains(s.$root[0], g)) && d.focus(), e.nav && !f ? s.set("highlight", s.component.item.highlight, {nav: e.nav}) : b._.isInteger(e.pick) && !f ? s.set("select", e.pick).close(!0) : e.clear && s.clear().close(!0)
            }), c(s.$root[0], "hidden", !0)
        }

        function l() {
            var b = ["string" == typeof o.hiddenPrefix ? o.hiddenPrefix : "", "string" == typeof o.hiddenSuffix ? o.hiddenSuffix : "_submit"];
            s._hidden = a('<input type=hidden name="' + b[0] + d.name + b[1] + '"id="' + b[0] + d.id + b[1] + '"' + (q.data("value") || d.value ? ' value="' + s.get("select", o.formatSubmit) + '"' : "") + ">")[0], q.on("change." + n.id,function () {
                s._hidden.value = d.value ? s.get("select", o.formatSubmit) : ""
            }).after(s._hidden)
        }

        function m(a) {
            a.stopPropagation(), "focus" == a.type && (s.$root.addClass(p.focused), c(s.$root[0], "selected", !0)), s.open()
        }

        if (!d)return b;
        var n = {id: d.id || "P" + Math.abs(~~(Math.random() * new Date))}, o = g ? a.extend(!0, {}, g.defaults, h) : h || {}, p = a.extend({}, b.klasses(), o.klass), q = a(d), r = function () {
            return this.start()
        }, s = r.prototype = {constructor: r, $node: q, start: function () {
            return n && n.start ? s : (n.methods = {}, n.start = !0, n.open = !1, n.type = d.type, d.autofocus = d == document.activeElement, d.type = "text", d.readOnly = !o.editable, d.id = d.id || n.id, s.component = new g(s, o), s.$root = a(b._.node("div", i(), p.picker, 'id="' + d.id + '_root"')), k(), o.formatSubmit && l(), j(), o.container ? a(o.container).append(s.$root) : q.after(s.$root), s.on({start: s.component.onStart, render: s.component.onRender, stop: s.component.onStop, open: s.component.onOpen, close: s.component.onClose, set: s.component.onSet}).on({start: o.onStart, render: o.onRender, stop: o.onStop, open: o.onOpen, close: o.onClose, set: o.onSet}), d.autofocus && s.open(), s.trigger("start").trigger("render"))
        }, render: function (a) {
            return a ? s.$root.html(i()) : s.$root.find("." + p.box).html(s.component.nodes(n.open)), s.trigger("render")
        }, stop: function () {
            return n.start ? (s.close(), s._hidden && s._hidden.parentNode.removeChild(s._hidden), s.$root.remove(), q.removeClass(p.input).removeData(e), setTimeout(function () {
                q.off("." + n.id)
            }, 0), d.type = n.type, d.readOnly = !1, s.trigger("stop"), n.methods = {}, n.start = !1, s) : s
        }, open: function (e) {
            return n.open ? s : (q.addClass(p.active), c(d, "expanded", !0), s.$root.addClass(p.opened), c(s.$root[0], "hidden", !1), e !== !1 && (n.open = !0, q.trigger("focus"), f.on("click." + n.id + " focusin." + n.id,function (a) {
                var b = a.target;
                b != d && b != document && 3 != a.which && s.close(b === s.$root.children()[0])
            }).on("keydown." + n.id, function (c) {
                var e = c.keyCode, f = s.component.key[e], g = c.target;
                27 == e ? s.close(!0) : g != d || !f && 13 != e ? a.contains(s.$root[0], g) && 13 == e && (c.preventDefault(), g.click()) : (c.preventDefault(), f ? b._.trigger(s.component.key.go, s, [b._.trigger(f)]) : s.$root.find("." + p.highlighted).hasClass(p.disabled) || s.set("select", s.component.item.highlight).close())
            })), s.trigger("open"))
        }, close: function (a) {
            return a && (q.off("focus." + n.id).trigger("focus"), setTimeout(function () {
                q.on("focus." + n.id, m)
            }, 0)), q.removeClass(p.active), c(d, "expanded", !1), s.$root.removeClass(p.opened + " " + p.focused), c(s.$root[0], "hidden", !0), c(s.$root[0], "selected", !1), n.open ? (n.open = !1, f.off("." + n.id), s.trigger("close")) : s
        }, clear: function () {
            return s.set("clear")
        }, set: function (b, c, d) {
            var e, f, g = a.isPlainObject(b), h = g ? b : {};
            if (d = g && a.isPlainObject(c) ? c : d || {}, b) {
                g || (h[b] = c);
                for (e in h)f = h[e], e in s.component.item && s.component.set(e, f, d), ("select" == e || "clear" == e) && q.val("clear" == e ? "" : s.get(e, o.format)).trigger("change");
                s.render()
            }
            return d.muted ? s : s.trigger("set", h)
        }, get: function (a, c) {
            return a = a || "value", null != n[a] ? n[a] : "value" == a ? d.value : a in s.component.item ? "string" == typeof c ? b._.trigger(s.component.formats.toString, s.component, [c, s.component.get(a)]) : s.component.get(a) : void 0
        }, on: function (b, c) {
            var d, e, f = a.isPlainObject(b), g = f ? b : {};
            if (b) {
                f || (g[b] = c);
                for (d in g)e = g[d], n.methods[d] = n.methods[d] || [], n.methods[d].push(e)
            }
            return s
        }, off: function () {
            var a, b, c = arguments;
            for (a = 0, namesCount = c.length; namesCount > a; a += 1)b = c[a], b in n.methods && delete n.methods[b];
            return s
        }, trigger: function (a, c) {
            var d = n.methods[a];
            return d && d.map(function (a) {
                b._.trigger(a, s, [c])
            }), s
        }};
        return new r
    }

    function c(b, c, e) {
        if (a.isPlainObject(c))for (var f in c)d(b, f, c[f]); else d(b, c, e)
    }

    function d(a, b, c) {
        a.setAttribute(("role" == b ? "" : "aria-") + b, c)
    }

    function e(b, c) {
        a.isPlainObject(b) || (b = {attribute: c}), c = "";
        for (var d in b) {
            var e = ("role" == d ? "" : "aria-") + d, f = b[d];
            c += null == f ? "" : e + '="' + b[d] + '"'
        }
        return c
    }

    var f = a(document);
    return b.klasses = function (a) {
        return a = a || "picker", {picker: a, opened: a + "--opened", focused: a + "--focused", input: a + "__input", active: a + "__input--active", holder: a + "__holder", frame: a + "__frame", wrap: a + "__wrap", box: a + "__box"}
    }, b._ = {group: function (a) {
        for (var c, d = "", e = b._.trigger(a.min, a); e <= b._.trigger(a.max, a, [e]); e += a.i)c = b._.trigger(a.item, a, [e]), d += b._.node(a.node, c[0], c[1], c[2]);
        return d
    }, node: function (b, c, d, e) {
        return c ? (c = a.isArray(c) ? c.join("") : c, d = d ? ' class="' + d + '"' : "", e = e ? " " + e : "", "<" + b + d + e + ">" + c + "</" + b + ">") : ""
    }, lead: function (a) {
        return(10 > a ? "0" : "") + a
    }, trigger: function (a, b, c) {
        return"function" == typeof a ? a.apply(b, c || []) : a
    }, digits: function (a) {
        return/\d/.test(a[1]) ? 2 : 1
    }, isDate: function (a) {
        return{}.toString.call(a).indexOf("Date") > -1 && this.isInteger(a.getDate())
    }, isInteger: function (a) {
        return{}.toString.call(a).indexOf("Number") > -1 && a % 1 === 0
    }, ariaAttr: e}, b.extend = function (c, d) {
        a.fn[c] = function (e, f) {
            var g = this.data(c);
            return"picker" == e ? g : g && "string" == typeof e ? (b._.trigger(g[e], g, [f]), this) : this.each(function () {
                var f = a(this);
                f.data(c) || new b(this, c, d, e)
            })
        }, a.fn[c].defaults = d.defaults
    }, b
});