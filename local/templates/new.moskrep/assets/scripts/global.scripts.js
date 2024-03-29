var doc = document.documentElement;
doc.setAttribute("data-useragent", navigator.userAgent),
"ontouchstart" in window || window.DocumentTouch && document instanceof DocumentTouch ? document.documentElement.classList.add("js-touch") : document.documentElement.classList.add("js-no-touch"),
$("#maps-trigger-01").click((function (a) {
        $("[data-pickup-maps]").removeClass("is-active"),
        $("#pickup-maps-01").addClass("is-active")
})),
$("#maps-trigger-02").click((function (a) {
        $("[data-pickup-maps]").removeClass("is-active"),
        $("#pickup-maps-02").addClass("is-active")
})),
$("#maps-trigger-03").click((function (a) {
        $("[data-pickup-maps]").removeClass("is-active"),
        $("#pickup-maps-03").addClass("is-active")
})),
$("#maps-trigger-04").click((function (a) {
        $("[data-pickup-maps]").removeClass("is-active"),
        $("#pickup-maps-04").addClass("is-active")
})),
$("#primary-banner__close").click((function (a) {
        $("#primary-banner").addClass("is-disabled"),
        $("#primary-banner").removeClass("is-active")
})),
$("#main-nav__open").click((function (a) {
        $("#main-nav__wrap").addClass("is-active"),
        $("#main-nav__wrap").removeClass("is-disabled")
})),
$("#main-nav__close").click((function (a) {
        $("#main-nav__wrap").addClass("is-disabled"),
        $("#main-nav__wrap").removeClass("is-active")
})),
$("#catalog-nav__close").click((function (a) {
        $("#catalog-nav__toggle").addClass("is-disabled"),
        $("#catalog-nav__toggle").removeClass("is-active")
})),
document.documentElement.clientWidth < 991 && $("#catalog-nav__toggle").click((function (a) {
        $("#catalog-nav__toggle").addClass("is-active"),
        $("#catalog-nav__toggle").removeClass("is-disabled")
})),
document.documentElement.clientWidth > 990 && ( /*$(".catalog-nav__toggle").hasClass("catalog-nav__toggle--special")||*/ $("#catalog-nav__toggle").click((function (a) {
        $("#catalog-nav__toggle").addClass("is-active"),
        $("#catalog-nav__toggle").removeClass("is-disabled")
})));
var catalogNav__toggle = document.getElementById("catalog-nav__toggle"),
        catalogNav__wrap = document.getElementById("catalog-nav__wrap");
$(".catalog-nav__toggle").hasClass("catalog-nav__toggle--special") || $("#catalog-nav__toggle").click((function (a) {
        $("#catalog-nav__toggle").addClass("is-active"),
        $("#catalog-nav__toggle").removeClass("is-disabled")
})), catalogNav__toggle.onmouseout = function (a) {
        $(".catalog-nav__toggle").hasClass("is-active") && ($("#catalog-nav__toggle").addClass("is-disabled"), $("#catalog-nav__toggle").removeClass("is-active"))
},/*catalogNav__wrap.onmouseover = function (a) {
        $("#catalog-nav__toggle").addClass("is-active"),
        $("#catalog-nav__toggle").removeClass("is-disabled")
}, catalogNav__wrap.onmouseout=function(a){$("#catalog-nav__toggle").addClass("is-disabled"),$("#catalog-nav__toggle").removeClass("is-active")}),*/
document.documentElement.clientWidth < 991 && $(".catalog-nav__lvl1-toggle").click((function (a) {
        a.preventDefault(),
        $(this).addClass("is-active")
})), document.documentElement.clientWidth > 990 && ($(".catalog-nav__lvl1-toggle").hover((function () {
        $(".catalog-nav__lvl1-toggle").removeClass("is-active"),
        $(".catalog-nav__lvl1-toggle").removeClass("is-selected"),
        $(this).addClass("is-active"),
        $(".catalog-nav__wrap").addClass("is-active")
}), (function () {
        $(".catalog-nav__lvl1-toggle").removeClass("is-active"),
        $(this).addClass("is-selected"),
        $(".catalog-nav__wrap").removeClass("is-active")
})), $(".catalog-nav__lvl1-link").hover((function () {
        $(".catalog-nav__lvl1-toggle").removeClass("is-active"),
        $(".catalog-nav__lvl1-toggle").removeClass("is-selected")
})), $(".catalog-nav__wrap").hover((function () {}), (function () {
        $(".catalog-nav__lvl1-toggle").removeClass("is-active"),
        $(".catalog-nav__lvl1-toggle").removeClass("is-selected")
})), $(".catalog-nav__lvl2").hover((function () {
        $(this).addClass("is-active"),
        $(".catalog-nav__wrap").addClass("is-active")
}), (function () {
        $(this).removeClass("is-active"),
        $(".catalog-nav__lvl1-toggle").removeClass("is-selected"),
        $(".catalog-nav__wrap").removeClass("is-active")
}))), $("[data-lvl2-back]").click((function (a) {
        $(".catalog-nav__lvl1-toggle").removeClass("is-active")
})), document.documentElement.clientWidth < 991 && $(".catalog-nav__lvl2-toggle").click((function (a) {
        a.preventDefault(),
        $(this).addClass("is-active")
})), document.documentElement.clientWidth > 990 && ($(".catalog-nav__lvl2-toggle").hover((function () {
        $(".catalog-nav__lvl2-toggle").removeClass("is-active"),
        $(".catalog-nav__lvl2-toggle").removeClass("is-selected"),
        $(this).addClass("is-active"),
        $(".catalog-nav__wrap").addClass("is-active")
}), (function () {
        $(".catalog-nav__lvl2-toggle").removeClass("is-active"),
        $(this).addClass("is-selected"),
        $(".catalog-nav__wrap").removeClass("is-active")
})), $(".catalog-nav__lvl2-link").hover((function () {
        $(".catalog-nav__lvl2-toggle").removeClass("is-active"),
        $(".catalog-nav__lvl2-toggle").removeClass("is-selected"),
        $(".catalog-nav__wrap").removeClass("is-active")
})), $(".catalog-nav__lvl2").hover((function () {}), (function () {
        $(".catalog-nav__lvl2-toggle").removeClass("is-active"),
        $(".catalog-nav__lvl2-toggle").removeClass("is-selected")
})), $(".catalog-nav__lvl3").hover((function () {
        $(this).addClass("is-active"),
        $(".catalog-nav__wrap").addClass("is-active")
}), (function () {
        $(this).removeClass("is-active"),
        $(".catalog-nav__lvl2-toggle").removeClass("is-selected"),
        $(".catalog-nav__wrap").removeClass("is-active")
}))), $("[data-lvl3-back]").click((function (a) {
        $(".catalog-nav__lvl2-toggle").removeClass("is-active")
})), $("#catalog-filter-trigger").click((function (a) {
        $("#catalog-filter").addClass("is-active"),
        $("#catalog-filter").removeClass("is-disabled")
})), $("#catalog-filter-trigger2").click((function (a) {
        $("#catalog-filter").addClass("is-active"),
        $("#catalog-filter").removeClass("is-disabled")
})), $("#catalog-filter__close").click((function (a) {
        $("#catalog-filter").addClass("is-disabled"),
        $("#catalog-filter").removeClass("is-active")
}));