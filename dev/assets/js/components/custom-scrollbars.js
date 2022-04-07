/* ------------------------------------------------------------------------ */
/* custom scroll bars
/* ------------------------------------------------------------------------ */
(function($){
    yani_is_mobile  = 0;
    if (yani_is_mobile) {
        //console.log('You are using a mobile device!');
    } else {

        if( $('.deals-table-wrap').length > 0 ) {
            $('.deals-table-wrap').overlayScrollbars({
                overflowBehavior: {
                    x: "scroll",
                    y: "scroll"
                },
            });
        }

    }
})(jQuery)