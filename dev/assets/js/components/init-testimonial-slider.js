/* ------------------------------------------------------------------------ */
/*  testimonial slider
/* ------------------------------------------------------------------------ */
(function($){
var yani_rtl = yani_vars.yani_rtl;
var prev_text = yani_vars.prev_text;
var next_text = yani_vars.next_text;
var testimonials_slider_v1 = $('.testimonials-slider-wrap-v1');
if( testimonials_slider_v1.length > 0 ) {
    
    testimonials_slider_v1.slick({
        rtl: yani_rtl,
        lazyLoad: 'ondemand',
        infinite: true,
        autoplay: true,
        speed: 300,
        slidesToShow: 1,
        arrows: true,
        adaptiveHeight: true,
        dots: true,
        appendArrows: '.testimonials-module-slider-v1',
        prevArrow: '<button type="button" class="slick-prev btn-primary-outlined">'+prev_text+'</button>',
        nextArrow: '<button type="button" class="slick-next btn-primary-outlined">'+next_text+'</button>',
    });
}

var testimonials_slider_v2 = $('.testimonials-slider-wrap-v2');
if( testimonials_slider_v2.length > 0 ) {
    testimonials_slider_v2.slick({
        rtl: yani_rtl,
        lazyLoad: 'ondemand',
        infinite: true,
        autoplay: true,
        speed: 300,
        slidesToShow: 3,
        arrows: true,
        adaptiveHeight: true,
        dots: true,
        appendArrows: '.testimonials-module-slider-v2',
        prevArrow: '<button type="button" class="slick-prev btn-primary-outlined">'+prev_text+'</button>',
        nextArrow: '<button type="button" class="slick-next btn-primary-outlined">'+next_text+'</button>',
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