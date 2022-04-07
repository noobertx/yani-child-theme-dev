
/* ------------------------------------------------------------------------ */
/* Top Banner Full Screen
/* ------------------------------------------------------------------------ */
(function($){
    var yani_is_splash = yani_vars.yani_is_splash;
    var header_area = $('.header-main-wrap');
    var header_area_height = header_area.innerHeight();
    var setTopBannerFullScreen = function() {
    var totalTopBarsHeight = 0;
    var searchH = 0;
    var topBarH = 0;
    var totalBannerHeight = 0;
    var window_height = $(window).innerHeight();
    var admin_bar = $('#wpadminbar');
    var topBarB = $('.top-bar-wrap');
    var admin_bar_height = admin_bar.outerHeight();
    searchH = (window_height-header_area_height);  

    
    var advanced_search_nav = $('.advanced-search-nav');
    var advanced_search_nav_height = advanced_search_nav.innerHeight();

    if( header_area.hasClass('header-transparent-wrap') ) {
        if( topBarB.length ) {
            topBarH = topBarB.outerHeight();
        }
        totalBannerHeight =  window.getWindowHeight() - (topBarH + admin_bar_height);

    } else {

        if( header_area.length && advanced_search_nav.length && !advanced_search_nav.hasClass('search-hidden')) {
            totalTopBarsHeight = parseInt(header_area_height) + parseInt(advanced_search_nav_height);

        } else if(header_area.length) {
            totalTopBarsHeight = parseInt(header_area_height);

        }
        totalBannerHeight =  window.getWindowHeight() - (totalTopBarsHeight + admin_bar_height);
    }

    $('.top-banner-wrap-fullscreen').css( 'height', totalBannerHeight );
    }

    if( !yani_is_splash && $('.top-banner-wrap-fullscreen').length > 0 ) {
        $(document).ready(function() {
            setTopBannerFullScreen();
        });

        $(window).on('resize', function () {
            setTopBannerFullScreen();
        });
    }
})(jQuery)