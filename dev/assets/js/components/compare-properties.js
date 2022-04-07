/* ------------------------------------------------------------------------ */
/* compare properties
/* ------------------------------------------------------------------------ */
(function($){
    
    $('.show-compare-panel').click(function () {
        $(this).toggleClass('active');
        $('.compare-property-active').addClass('compare-property-active-push-toleft');
        $('#compare-property-panel').addClass('compare-property-panel-open');
        //disableOther( 'show-compare-panel' );
    });
    $('.close-compare-panel').click(function () {
        $(this).toggleClass('active');
        $('.compare-property-active').removeClass('compare-property-active-push-toleft');
        $('#compare-property-panel').removeClass('compare-property-panel-open');
        //disableOther( 'show-compare-panel' );
    });

})(jQuery)