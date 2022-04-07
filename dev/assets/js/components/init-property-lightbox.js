/* ------------------------------------------------------------------------ */
/*  property lightbox
/* ------------------------------------------------------------------------ */
(function($){

    $('.btn-expand').click(function () {
        $('.lightbox-gallery-wrap').toggleClass("lightbox-gallery-full-wrap");
        $('#lightbox-slider-js').slick('refresh');
    });
    $('.btn-email').click(function () {
        $('.lightbox-form-wrap').toggleClass("lightbox-form-wrap-show");
    });
})(jQuery)