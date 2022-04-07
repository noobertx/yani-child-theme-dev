/*--------------------------------------------------------------------------
 *  Currency Switcher
 * -------------------------------------------------------------------------*/
(function($){	 
    var currencySwitcherList = $('#hz-currency-switcher-list');
    if( currencySwitcherList.length > 0 ) {

        $('#hz-currency-switcher-list > li').on('click', function(e) {
        
            var selectedCurrencyCode = $(this).data( 'currency-code' );

            if ( selectedCurrencyCode ) {

                $('#yani-switch-to-currency').val( selectedCurrencyCode );
                var yani_switch_to_currency = $('#yani-switch-to-currency').val();
                yani_processing_modal(processing_text);

                $.ajax({
                    url: ajaxurl,
                    dataType: 'JSON',
                    method: 'POST',
                    data: {
                        'action' : 'yani_currency_converter',
                        'currency_converter' : selectedCurrencyCode
                    },
                    success: function (res) {
                        if( res.success ) {
                            window.location.reload( true );
                        } else {
                            console.log( res );
                        }
                    },
                    error: function (xhr, status, error) {
                        var err = eval("(" + xhr.responseText + ")");
                        console.log(err.Message);
                    }
                });

            }

        });
    }
})(jQuery)