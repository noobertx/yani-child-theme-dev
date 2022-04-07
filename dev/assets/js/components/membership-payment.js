/* ------------------------------------------------------------------------ */
/*  Select Membership payment
/* ------------------------------------------------------------------------ */
(function($){
    var ajaxurl = yani_vars.ajaxurl;
    var userID = yani_vars.userID;
    var paypal_connecting  = yani_vars.paypal_connecting ;
    
     var yani_paypal_package_payment = function( yani_package_price, yani_package_name, yani_package_id ) {

        $.ajax({
            type: 'POST',
            url: ajaxurl,
            data: {
                'action'    : 'yani_paypal_package_payment',
                'yani_package_price' : yani_package_price,
                'yani_package_name'  : yani_package_name,
                'yani_package_id'  : yani_package_id
            },
            success: function (data) { //alert(data); return false;
                window.location.href = data;
            },
            error: function(xhr, status, error) {
                var err = eval("(" + xhr.responseText + ")");
                console.log(err.Message);
            }
        });
    }

    var yani_recuring_paypal_package_payment = function(  yani_package_price, yani_package_name, yani_package_id  ) {

        jQuery.ajax({
            type: 'POST',
            url: ajaxurl,
            data: {
                'action'               : 'yani_recuring_paypal_package_payment',
                'yani_package_name'  : yani_package_name,
                'yani_package_id'    : yani_package_id,
                'yani_package_price' : yani_package_price
            },
            success: function (data) {
                window.location.href = data;
            },
            error: function(xhr, status, error) {
                var err = eval("(" + xhr.responseText + ")");
                console.log(err.Message);
            }
        });
    }

    var direct_bank_transfer_package = function( yani_package_id, yani_package_price, yani_package_name ) {

        jQuery.ajax({
            type: 'POST',
            url: ajaxurl,
            data: {
                'action'           : 'yani_direct_pay_package',
                'selected_package' : yani_package_id,
            },
            success: function (data) {
                window.location.href = data;

            },
            error: function (errorThrown) {}
        });
    }

    var yani_free_membership_package = function ( yani_package_id ) {
        jQuery.ajax({
            type: 'POST',
            url: ajaxurl,
            data: {
                'action'           : 'yani_free_membership_package',
                'selected_package' : yani_package_id,
            },
            success: function (data) {
                window.location.href = data;

            },
            error: function (errorThrown) {}
        });
    }

    var yani_membership_data = function(currnt) {
        var payment_gateway = $("input[name='yani_payment_type']:checked").val();
        var yani_package_price = $("input[name='yani_package_price']").val();
        var yani_package_id    = $("input[name='yani_package_id']").val();
        var yani_package_name  = $("#yani_package_name").text();

        if( payment_gateway == 'paypal' ) {
            yani_processing_modal( paypal_connecting );
            if ($('#paypal_package_recurring').is(':checked')) {
                yani_recuring_paypal_package_payment( yani_package_price, yani_package_name, yani_package_id );
            } else {
                yani_paypal_package_payment( yani_package_price, yani_package_name, yani_package_id );
            }

        } else if ( payment_gateway == 'stripe' ) {
            var hform = currnt.parents('form');
            hform.find('.yani_stripe_membership button').trigger( "click" );

        } else if ( payment_gateway == 'direct_pay' ) {
            yani_processing_modal( processing_text );
            direct_bank_transfer_package( yani_package_id, yani_package_price, yani_package_name );

        } else {
            yani_processing_modal( processing_text );
            yani_free_membership_package(  yani_package_id );
        }

        return false;
    }

    var yani_register_user_with_membership = function ( currnt ) {

        var $form = currnt.parents('form');
        var $messages = $('#packmem-msgs');

        $.ajax({
            type: 'post',
            url: ajaxurl,
            dataType: 'json',
            data: $form.serialize(),
            beforeSend: function( ) {
                currnt.find('.yani-loader-js').addClass('loader-show');
            },
            complete: function(){
                currnt.find('.yani-loader-js').removeClass('loader-show');
            },
            success: function( response ) {
                if( response.success ) {
                    yani_membership_data(currnt);
                } else {
                    $('html, body').animate({
                        scrollTop: $(".frontend-submission-page").offset().top
                    }, 'slow');
                    $messages.empty().append('<div class="alert alert-danger alert-dismissible fade show" role="alert">'+response.msg+'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                }
            },
            error: function(xhr, status, error) {
                var err = eval("(" + xhr.responseText + ")");
                console.log(err.Message);
            }
        });
    }

    $('#yani_complete_membership').on('click', function(e) {
        e.preventDefault();
        var currnt = $(this);
        if( parseInt( userID, 10 ) === 0 || userID == undefined) {
            yani_register_user_with_membership( currnt );
            return;
        }
        yani_membership_data(currnt);
    } );
})(jQuery)