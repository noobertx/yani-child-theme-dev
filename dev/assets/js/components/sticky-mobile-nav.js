    (function($){

    var ajaxurl =yani_vars.ajaxurl;
    var only_nav_sticky = 1;        
    var wp_is_mobile = yani_vars.wp_is_mobile;

    var is_top_header = 0;
    var desktop_header_search_enabled  = 1;


    // if($('.header-fixed  .header-inner-wrap').length){
    //     var header_area = $('.header-fixed  .header-inner-wrap');       
    //     var header_nav = $('.header-fixed .header-inner-wrap');
    // }else if ($('.header-creative').length || $('.header-overlay').length){

    // }else{
        var header_area = $('#main-nav');
        // var header_area = $('#main-nav');
        var header_nav = $('#main-nav');
        // var header_nav = $('#main-nav');
    // }

    // console.log(header_area,header_nav);
    

    if(header_area && header_nav){
        var header_area_height = header_area.innerHeight() + header_area.offset().top; 
        // if( only_nav_sticky && !wp_is_mobile ) {
            yani_sticky_mobile_nav();
        // }
    }

    function yani_sticky_mobile_nav() {
        $(window).scroll(function() {
            var scroll = $(window).scrollTop();
            var admin_nav = $('#wpadminbar').height();
            var top_banner_margin = 0;
            var thisHeight = header_nav.outerHeight();
            top_banner_margin = thisHeight;

            if(is_top_header) {
                var top_bar_wrap = $('.top-bar-wrap').height();
                top_banner_margin = top_banner_margin + top_bar_wrap;
            }

            if(only_nav_sticky === 0) {
                return;
            }


            if( admin_nav == 'null' ) { admin_nav = 0; }

            if (scroll > header_area_height) { 


                header_nav.addClass('sticky-nav-area');
                header_nav.css('top', admin_nav);

                // console.log(thisHeight)
                if (scroll >= header_area_height + 10) { 
                    // setTimeout(function(){                        
                        header_nav.addClass('yani-in-view');
                    // },250)
                    // $('#main-wrap').css('margin-top', (thisHeight*2)+75);
                }

            } else { 
                header_nav.removeClass('sticky-nav-area');
                header_nav.removeAttr("style");
                if (scroll <= header_area_height) { 
                    header_nav.removeClass('yani-in-view');
                }
                $('#main-wrap').css('margin-top', 0);
            }
        });
    }
})(jQuery)