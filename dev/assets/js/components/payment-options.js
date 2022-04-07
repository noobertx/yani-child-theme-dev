/* ------------------------------------------------------------------------ */
/*  PAYPAL & Stripe OPTIONS
/* ------------------------------------------------------------------------ */
(function($){

    $('.method-select input').on('change',function () {
        if($(this).is(':checked')) {
            $('.recurring-payment-wrap').slideUp();
            $(this).parents('.payment-method-block').next('.recurring-payment-wrap').slideDown();
        }else{
            $('.recurring-payment-wrap').slideUp();
        }
    });
    function paypal_option(ele){
        if($(ele).attr('checked')) {
            $(ele).parents('.payment-method-block').next('.recurring-payment-wrap').slideDown();
        }else{
            $(ele).parents('.payment-method-block').next('.recurring-payment-wrap').slideUp();
        }
    }

    paypal_option('.paypal-method');
    paypal_option('.stripe-method');

    $('button.stripe-button-el span').prepend('<i class="fa fa-credit-card"></i>');
    $('#stripe_package_recurring').click(function () {
        if( $(this).attr('checked') ) {
            $('.yani_payment_form').append('<input type="hidden" name="yani_stripe_recurring" id="yani_stripe_recurring" value="1">');
        }else{
            $('#yani_stripe_recurring').remove();
        }
    });

})(jQuery)