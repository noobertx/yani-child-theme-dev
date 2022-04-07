/* ------------------------------------------------------------------------ */
/*  autocomplete result position
/* ------------------------------------------------------------------------ */
(function($){

    function setAutoCompleteResultPosition() {
        var parallax_banner_inner_height = $('.top-banner-wrap').innerHeight();
        var banner_caption_inner_height = $('.banner-caption').innerHeight();
        var autocomplete_search_position = (parallax_banner_inner_height - (parallax_banner_inner_height - banner_caption_inner_height) / 2);

        $('#yani-auto-complete-banner').css('top', autocomplete_search_position);
    }

    $(window).on('load', function(){
        setAutoCompleteResultPosition();
    });
    
    $(window).on('resize', function () {
        setAutoCompleteResultPosition();
    });
})(jQuery)