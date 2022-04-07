/* ------------------------------------------------------------------------ */
/*  property navigation
/* ------------------------------------------------------------------------ */
(function($){
    var yaniStickyTop = 92;
var yani_listing_nav = $('.property-navigation-wrap');

if( yani_listing_nav.length > 0 ) {
    $(document).scroll(function() {
        var y = $(this).scrollTop();

        yani_listing_nav.css('top', yaniStickyTop);
        if (y > 300) {
            yani_listing_nav.fadeIn(250);
        } else {
            yani_listing_nav.fadeOut(0);
        }
    });

    $(".property-navigation-item a.target").click(function (event) {
        event.preventDefault();
        $("html, body").animate({
            scrollTop: $($(this).attr("href")).offset().top - 84
        }, 500);
    });

    $(window).on('scroll', function () {
        $('.property-section-wrap').each(function () {
            if ($(window).scrollTop() >= $(this).offset().top - 86) {
                var id = $(this).attr('id');
                $('.target').removeClass('active');
                $('.target[href="#' + id + '"]').addClass('active');
            } else if ($(window).scrollTop() <= 0) {
                $('.target').removeClass('active');
            }
        });
    });
}
})(jQuery)