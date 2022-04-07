(function($){
	var paypal_connecting = yani_vars.paypal_connecting;
	var ajaxurl = yani_vars.ajaxurl;

	 var paypal_per_listing_payment = function( property_id, is_prop_featured, is_prop_upgrade, relist_mode ) {

        $.ajax({
            type: 'post',
            url: ajaxurl,
            data: {
                'action': 'yani_property_paypal_payment',
                'prop_id': property_id,
                'is_prop_featured': is_prop_featured,
                'is_prop_upgrade': is_prop_upgrade,
                'relist_mode': relist_mode,
            },
            success: function( response ) {
            	console.log(response);
                window.location.href = response;
            },
            error: function(xhr, status, error) {
                var err = eval("(" + xhr.responseText + ")");
                console.log(err.Message);
            }
        });
    }



	$('#yani_complete_order').on('click', function(e) {
        e.preventDefault();
        var hform, relist_mode, payment_gateway, yani_listing_price, property_id, is_prop_featured, is_prop_upgrade;

        payment_gateway = $("input[name='yani_payment_type']:checked").val();
        is_prop_featured = $("input[name='featured_pay']").val();
        is_prop_upgrade = $("input[name='is_upgrade']").val();
        relist_mode = $("input[name='relist_mode']").val();

        property_id = $('#yani_property_id').val();
        yani_listing_price = $('#yani_listing_price').val();

        if( payment_gateway == 'paypal' ) {
            yani_processing_modal( paypal_connecting );
            paypal_per_listing_payment( property_id, is_prop_featured, is_prop_upgrade, relist_mode);

        } else if ( payment_gateway == 'stripe' ) {
            hform = $(this).parents('form');
            if( is_prop_featured === '1' ) {
                hform.find('.yani_stripe_simple_featured button').trigger( "click" );
            } else {
                hform.find('.yani_stripe_simple button').trigger("click");
            }
        } else if ( payment_gateway == 'direct_pay' ) {
            yani_processing_modal( processing_text );
            bank_transfer_per_listing(property_id, yani_listing_price);
        }
        return;

    });
})(jQuery)