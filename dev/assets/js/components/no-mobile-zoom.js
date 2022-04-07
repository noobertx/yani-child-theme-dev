/* ------------------------------------------------------------------------ */
/*  avoid zoom when double click on mobile devices
/* ------------------------------------------------------------------------ */
(function($){

    $.fn.nodoubletapzoom = function () {
        $(this).bind('touchstart', function preventZoom(e) {
            var t2 = e.timeStamp,
                t1 = $(this).data('lastTouch') || t2,
                dt = t2 - t1,
                fingers = e.originalEvent.touches.length;
            $(this).data('lastTouch', t2);
            if (!dt || dt > 500 || fingers > 1) return;

            e.preventDefault();
            $(this).trigger('click').trigger('click');
        });
    };

})(jQuery)    