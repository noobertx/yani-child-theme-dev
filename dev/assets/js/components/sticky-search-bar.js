/* ------------------------------------------------------------------------ */
/*  sticky search bar
/* ------------------------------------------------------------------------ */
(function($){
    var advanced_search_nav = $('.advanced-search-nav');
    var yaniStickyTop = 0;
    var only_nav_sticky = advanced_search_nav.data('sticky');
    var wp_is_mobile = yani_vars.wp_is_mobile;
    var yani_nav_sticky_height = advanced_search_nav.innerHeight();

    if(only_nav_sticky === 1) {
        yaniStickyTop = yani_nav_sticky_height;
        if( !wp_is_mobile ) {
            desktop_header_search_enabled = 0;
        }
    }


    var advanced_search_nav_height = advanced_search_nav.innerHeight();

    var listing_nav_area_height = $('.property-navigation-wrap').innerHeight();
    if( listing_nav_area_height == null ) {
        listing_nav_area_height = 0;
    }
    if( $('.yani_sticky').length > 0 ) {
        $('.yani_sticky').theiaStickySidebar({
            additionalMarginTop: yaniStickyTop + advanced_search_nav_height + listing_nav_area_height,
            minWidth: 768,
            updateSidebarHeight: false
        });
        console.log("this is working right ??")
    }

})(jQuery)