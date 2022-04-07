/* ------------------------------------------------------------------------ */
/*  parallax
/* ------------------------------------------------------------------------ */
(function($){    
    var header_parallax = $('.parallax');
    if( header_parallax.length > 0 ) {
        header_parallax.parallaxBackground({
            parallaxBgPosition: "center center",
            parallaxBgRepeat: "no-repeat",
            parallaxBgSize: "cover",
            parallaxSpeed: "0.25",
        });
    }
})(jQuery)