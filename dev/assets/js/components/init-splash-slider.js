/* ------------------------------------------------------------------------ */
/*  splash page slider 
/* ------------------------------------------------------------------------ */
(function($){
      var yani_rtl = yani_vars.yani_rtl;
var splash_slider_wrap = $('.splash-slider-wrap');
if(splash_slider_wrap.length > 0) {
    splash_slider_wrap.slick({
        rtl: yani_rtl,
        lazyLoad: 'ondemand',
        adaptiveHeight: true,
        autoplay: true,
        infinite: true,
        speed: 300,
        fade: true,
        slidesToShow: 1,
        arrows: false,
    });
}
})(jQuery)