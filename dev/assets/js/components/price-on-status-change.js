(function($){
/*--------------------------------------------------------------------------
     *  Change search price on status change
     * -------------------------------------------------------------------------*/
    var property_status_changed = function(prop_status, $form) { 
        
        if( prop_status == for_rent ) { 
            $form.find('.prices-for-all').addClass('hide');
            $form.find('.prices-for-all select').attr('disabled','disabled');
            $form.find('.prices-only-for-rent').removeClass('hide');
            $form.find('.prices-only-for-rent select').removeAttr('disabled','disabled');
            $form.find('.prices-only-for-rent select').selectpicker('refresh');
        } else {  
            $form.find('.prices-only-for-rent').addClass('hide');
            $form.find('.prices-only-for-rent select').attr('disabled','disabled');
            $form.find('.prices-for-all').removeClass('hide');
            $form.find('.prices-for-all select').removeAttr('disabled','disabled');
            $form.find('.prices-for-all select').selectpicker('refresh');
        }
    }
    $('.status-js').on('change', function(e){
        var selected_status = $(this).val();
        var $form = $(this).parents('form');
        property_status_changed(selected_status, $form);
    });

    $('.status-tab-js').on('click', function() {
        var tab_selected_status = $(this).data('val');
        var $form = $(this).parents('form');
        property_status_changed(tab_selected_status, $form);
    });



    /* On page load*/
    var selected_status = $('.status-js').val();
    if( selected_status == for_rent ) {
        var $form = $('.yani-search-form-js');
        property_status_changed(selected_status, $form);
    } else {
        var $form = $('.yani-search-form-js');
        property_status_changed('dummy', $form);
    }

    /* On page load status tab */
    var selected_status_tab = $('.status-tab-js').val();
    if( selected_status_tab == for_rent ) {
        var $tab_form = $('.yani-search-builder-form-js'); 
        property_status_changed(selected_status_tab, $tab_form);
    } else {
        var $tab_form = $('.yani-search-builder-form-js');
        property_status_changed( selected_status_tab, $tab_form );
    }
})(jQuery)