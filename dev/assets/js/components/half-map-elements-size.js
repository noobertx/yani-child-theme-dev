/* ------------------------------------------------------------------------ */
/*  half map elements size
/* ------------------------------------------------------------------------ */
(function($){
    var $win = $(window);
    var elementor_location_header_height = 0;
    function setSectionHeight() {
        var window_height = $(window).innerHeight();
        var header_area = $('.header-main-wrap');
        var header_area_height = header_area.innerHeight();
        var sections_height = window_height - header_area_height;
        var advanced_search_nav = $('.advanced-search-nav');
        var advanced_search_nav_height = advanced_search_nav.innerHeight();

        sections_height = sections_height - advanced_search_nav_height;
        sections_height = sections_height - elementor_location_header_height;

        if ($(window).width() >= 767) { 
            $('.half-map-left-wrap, .half-map-right-wrap').css('height', sections_height);
        } else { 
            $('.map-on-right .half-map-right-wrap').css('height', sections_height);
            $('.map-on-right .half-map-left-wrap').css('height', '100vh');
            $('.map-on-left .half-map-right-wrap').css('height', sections_height);
            $('.map-on-left .half-map-left-wrap').css('height', '100vh');
        }
    }
    // setSectionHeight();
    $win.on('resize', function () {
        // setSectionHeight();
    });
})(jQuery)

