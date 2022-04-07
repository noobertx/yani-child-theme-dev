/* ------------------------------------------------------------------------ */
    /*  partners slider
    /* ------------------------------------------------------------------------ */
(function($){
    var yani_rtl = yani_vars.yani_rtl;
    var partners_carousel = $('.partners-slider-wrap');
    if( partners_carousel.length > 0 ) {
        partners_carousel.slick({
            rtl: yani_rtl,
            lazyLoad: 'ondemand',
            infinite: true,
            speed: 300,
            slidesToShow: 4,
            arrows: true,
            adaptiveHeight: true,
            dots: true,
            appendArrows: '.partners-module-slider',
            prevArrow: $('.partner-prev-js'),
            nextArrow: $('.partner-next-js'),
            responsive: [{
                    breakpoint: 992,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                },
                {
                    breakpoint: 769,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
            ]
        });
    }
})(jQuery)