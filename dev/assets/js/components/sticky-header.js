 /* ------------------------------------------------------------------------ */
    /*  STICKY HEADER
    /* ------------------------------------------------------------------------ */

    (function($){

    var only_nav_sticky = 1;    	
    var wp_is_mobile = yani_vars.wp_is_mobile;
    var is_top_header = 0;
    var desktop_header_search_enabled  = 1;

    var header_area = $('#main-nav');
    var header_area_height = header_area.innerHeight();
    var advanced_search_nav = $('.advanced-search-nav');
    var advanced_search_nav_height = advanced_search_nav.innerHeight();
    var make_search_sticky_position = header_area_height + advanced_search_nav_height;

    var header_nav = $('#main-nav');



    if( only_nav_sticky && !wp_is_mobile ) {
        yani_sticky_nav();
    }

    function yani_sticky_nav() {
        $(window).scroll(function() {
            var scroll = $(window).scrollTop();
            var admin_nav = $('#wpadminbar').height();
            var top_banner_margin = 0;
            var thisHeight = header_nav.outerHeight();
            top_banner_margin = thisHeight;

            if(is_top_header) {
                var top_bar_wrap = $('#site-top').height();
                top_banner_margin = top_banner_margin + top_bar_wrap;
            }

            if(only_nav_sticky === 0) {
                return;
            }


            if( admin_nav == 'null' ) { admin_nav = 0; }

            if (scroll > header_area_height ) { 
                header_nav.addClass('sticky-nav-area');
                header_nav.css('top', admin_nav);

                if (scroll >= header_area_height +20 ) { 
                    header_nav.addClass('yani-in-view');
                    $('#main-wrap').css('margin-top', thisHeight);
                }

            } else { 
                header_nav.removeClass('sticky-nav-area');
                header_nav.removeAttr("style");
                if (scroll <= header_area_height ) { 
                    header_nav.removeClass('yani-in-view');
                }
                $('#main-wrap').css('margin-top', 0);
            }
        });
    }
})(jQuery)