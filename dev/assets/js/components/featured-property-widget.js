/* ------------------------------------------------------------------------ */
/*  featured property widget
/* ------------------------------------------------------------------------ */
(function($){
    var yani_rtl = yani_vars.yani_rtl;
var widget_featured_carousel = $('.widget-featured-property-slider');
if( widget_featured_carousel.length > 0 ) {
    widget_featured_carousel.slick({
        rtl: yani_rtl,
        speed: 300,
        slidesToShow: 1,
        arrows: true,
        adaptiveHeight: true,
        dots: true,
        responsive: [{
                breakpoint: 992,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
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