/*--------------------------------------------------------------------------
 *  Area Switcher
 * -------------------------------------------------------------------------*/
(function($){	
	var ajaxurl =yani_vars.ajaxurl;
	var processing_text =yani_vars.processing_text;
    var areaSwitcherList = $('#area-switcher-list-js');
    if( areaSwitcherList.length > 0 ) {

        $('#area-switcher-list-js > li').on('click', function(e) {
            //e.stopPropagation();
            
            var selectedAreaCode = $(this).data( 'area-code' );
            if ( selectedAreaCode ) {

                $('#yani-switch-to-area').val( selectedAreaCode );
                var yani_switch_to_area = $('#yani-switch-to-area').val();
                yani_processing_modal(processing_text);

                $.ajax({
                    url: ajaxurl,
                    dataType: 'JSON',
                    method: 'POST',
                    data: {
                        'action' : 'yani_switch_area',
                        'switch_to_area' : yani_switch_to_area,
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