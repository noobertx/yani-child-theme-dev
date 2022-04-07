(function($){
     /*--------------------------------------------------------------------------
     *  Direct message
     * -------------------------------------------------------------------------*/

    var ajaxurl = yani_vars.ajaxurl;
    $('.msg-login-required').on('click', function() {
        $('.modal-toggle-1').addClass("active");
        jQuery('.login-form-tab').addClass('active show');
    });

    $( '.yani-send-message').on('click', function(e) {
        e.preventDefault();

        var $result;
        var $this = $(this);
        var $form = $this.parents( 'form' );
        var $form_wrap = $this.parents( '.property-form-wrap' );
        $result = $form_wrap.find('.form_messages');
        var $is_bottom = $('.is_bottom').val();
        if($is_bottom == 'bottom') {
            $result = $form.find('.form_messages');
        }
        $result.empty();

        var property_id = $('input[name="listing_id"]').val();
        var message = $form.find('.hz-form-message').val();
        var security = $('input[name="property_agent_contact_security"]').val();

        $.ajax({
            url: ajaxurl,
            data: {
                'action' : 'yani_start_thread',
                'property_id' : property_id,
                'message' : message,
                'start_thread_form_ajax' : security,
            },
            method: $form.attr('method'),
            dataType: "JSON",

            beforeSend: function( ) {
                $this.find('.yani-loader-js').addClass('loader-show');
            },
            success: function(response) {
                if( response.success ) {
                    
                    $form.find('input[name="name"], input[name="mobile"], input[name="email"]').val('');
                    $form.find('textarea').val('');
                    if($is_bottom == 'bottom') {
                        $result.empty().append('<div class="alert alert-success alert-dismissible fade show" role="alert">'+response.msg+'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                    } else {
                        $result.empty().append('<p class="success text-success"><i class="fa fa-check"></i> '+ response.msg +'</p>');
                    }
                } else {
                    if($is_bottom == 'bottom') {
                        $result.empty().append('<div class="alert alert-danger alert-dismissible fade show" role="alert">'+response.msg+'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                    } else {
                        $result.empty().append('<p class="error text-danger"><i class="fas fa-times"></i> '+ response.msg +'</p>');
                    }
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
                
                if( yani_vars.agent_redirection != '' ) {
                    setTimeout(function(){
                        window.location.replace(yani_vars.agent_redirection);
                    }, 500);
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