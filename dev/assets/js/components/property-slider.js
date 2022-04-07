/* ------------------------------------------------------------------------ */
/*  property slider
/* ------------------------------------------------------------------------ */
(function($){
var yani_rtl = yani_vars.yani_rtl;
var property_banner_slider = $('.property-slider');
if( property_banner_slider.length > 0 ) {
    
    var autoplay = property_banner_slider.data('autoplay');
    var slider_loop = property_banner_slider.data('loop');
    var slider_speed = property_banner_slider.data('speed');

    var s_loop = false;
    if(slider_loop == 1) {
        s_loop = true;
    }

    property_banner_slider.slick({
        rtl: yani_rtl,
        autoplay: autoplay,
        autoplaySpeed: slider_speed,
        lazyLoad: 'ondemand',
        infinite: s_loop,
        speed: 300,
        slidesToShow: 1,
        arrows: true,
        adaptiveHeight: true
    });
}

var property_detail_gallery = $('#property-gallery-js');
if( property_detail_gallery.length > 0 ) { 
    property_detail_gallery.lightSlider({
        rtl: yani_rtl,
        gallery:true,
        item:1,
        thumbItem:8,
        slideMargin: 0,
        speed:500,
        adaptiveHeight: true,
        auto:false,
        loop:true,
        prevHtml: '<button type="button" class="slick-prev slick-arrow"></button>',
        nextHtml: '<button type="button" class="slick-next slick-arrow"></button>',
        onSliderLoad: function() {
            property_detail_gallery.removeClass('cS-hidden');
        }  
    });
}

var lightbox_slider_js = $('#lightbox-slider-js');
if( lightbox_slider_js.length > 0 ) {
    
    lightbox_slider_js.slick({
        rtl: yani_rtl,
        lazyLoad: 'ondemand',
        infinite: true,
        speed: 300,
        slidesToShow: 1,
        arrows: true,
        adaptiveHeight: true,
    });

    $('.yani-trigger-popup-slider-js').on('click', function (e) {
        e.preventDefault();
            
        var slider_num = parseInt( $(this).data('slider-no') );
        setTimeout(function(){ 
            lightbox_slider_js.slick('slickGoTo', slider_num - 1);
        }, 200);
    });

}


var listing_slider_variable_width = $('.listing-slider-variable-width');
if( listing_slider_variable_width.length > 0 ) {
    listing_slider_variable_width.slick({
        rtl: yani_rtl,
        lazyLoad: 'ondemand',
        infinite: true,
        speed: 300,
        slidesToShow: 1,
        centerMode: true,
        variableWidth: true,
        arrows: true,
        adaptiveHeight: true
    });  

    $('.property-detail-v5 #pills-gallery-tab').on('click', function() {
        
        /*if( !listing_slider_variable_width.hasClass('hz-slick-refreshed') ) {
            listing_slider_variable_width.slick('setPosition');
            listing_slider_variable_width.slick('refresh');
            listing_slider_variable_width.addClass('hz-slick-refreshed');
        }*/
    });
}
})(jQuery)