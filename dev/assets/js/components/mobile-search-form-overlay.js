/* ------------------------------------------------------------------------ */
/* mobile search form overlay
/* ------------------------------------------------------------------------ */
$(document).ready(function () {
    $(".mobile-search-nav").click(function () {
        $("#overlay-search-advanced-module").toggleClass("open");
    });
});
$(document).ready(function () {
    $(".overlay-search-module-close, .overly_is_halfmap .half-map-search-js-btn").click(function () {
        $("#overlay-search-advanced-module").toggleClass("open");
    });
});