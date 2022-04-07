/*--------------------------------------------------------------------------
 *   Contact agent form on agent detail page
 * -------------------------------------------------------------------------*/
(function($){	
	var ajaxurl =yani_vars.ajaxurl;		
	var yani_reCaptcha = yani_vars.yani_reCaptcha;
    $('#contact_realtor_btn').on('click', function(e) {
        e.preventDefault();
        var current_element = $(this);
        var $this = $(this);
        var $form = $this.parents( 'form' );

        jQuery.ajax({
            type: 'post',
            url: ajaxurl,
            data: $form.serialize(),
            method: $form.attr('method'),
            dataType: "JSON",

            beforeSend: function( ) {
                $this.find('.yani-loader-js').addClass('loader-show');
            },
            success: function( res ) {
                if( res.success ) {
                    $('.form_messages').eyani_contact_agent_formmpty().append('<div class="alert alert-success alert-dismissible fade show" role="alert">'+res.msg+'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                } else {
                    $('.form_messages').empty().append('<div class="alert alert-danger alert-dismissible fade show" role="alert">'+res.msg+'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                }

                $this.find('.yani-loader-js').removeClass('loader-show');
                if(yani_reCaptcha == 1) {
                    $form.find('.g-recaptcha-response').remove();
                    if( g_recaptha_version == 'v3' ) {
                        yaniReCaptchaLoad();
                    } else {
                        yaniReCaptchaReset();
                    }
                }
            },
            error: function(xhr, status, error) {
                var err = eval("(" + xhr.responseText + ")");
                console.log(err.Message);
            },
            complete: function(){
                $this.find('.yani-loader-js').removeClass('loader-show');
            }

        });
    });

})(jQuery)