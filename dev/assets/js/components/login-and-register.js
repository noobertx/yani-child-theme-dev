/* ------------------------------------------------------------------------ */
/*  Yani login and regsiter
 /* ------------------------------------------------------------------------ */
 (function($){
var ajaxurl =yani_vars.ajaxurl;
var yani_login_modal = function() {
    jQuery('#login-register-form').modal('show');
    jQuery('.login-form-tab').addClass('active show');
    jQuery('.modal-toggle-1.nav-link').addClass('active');
}

$('#yani-login-btn').on('click', function(e){
    e.preventDefault();
    var currnt = $(this);
    yani_login( currnt );
});

$('#yani-register-btn').on('click', function(e){
    e.preventDefault();
    var currnt = $(this);
    yani_register( currnt );
});

var yani_login = function( currnt ) {
    var $form = currnt.parents('form');
    var $messages = $('#hz-login-messages');

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
                $messages.empty().append('<div class="alert alert-success" role="alert"><i class="yani-icon icon-check-circle-1 mr-1"></i>'+ response.msg +'</div>');
                
                window.location.replace( response.redirect_to );

            } else {
                $messages.empty().append('<div class="alert alert-danger" role="alert"><i class="yani-icon icon-check-circle-1 mr-1"></i>'+ response.msg +'</div>');
            }

            currnt.find('.yani-loader-js').removeClass('loader-show');

            // if(yani_reCaptcha == 1) {
            //     $form.find('.g-recaptcha-response').remove();
            //     if( g_recaptha_version == 'v3' ) {
            //         yaniReCaptchaLoad();
            //     } else {
            //         yaniReCaptchaReset();
            //     }
            // }
        },
        error: function(xhr, status, error) {
            var err = eval("(" + xhr.responseText + ")");
            console.log(err.Message);
        }
    })

} // end yani_login

var yani_register = function ( currnt ) {

    var $form = currnt.parents('form');
    var $messages = $('#hz-register-messages');

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
                $messages.empty().append('<div class="alert alert-success" role="alert"><i class="yani-icon icon-check-circle-1 mr-1"></i>'+ response.msg +'</div>');
            } else {
                $messages.empty().append('<div class="alert alert-danger" role="alert"><i class="yani-icon icon-check-circle-1 mr-1"></i>'+ response.msg +'</div>');
            }

            currnt.find('.yani-loader-js').removeClass('loader-show');
            // if(yani_reCaptcha == 1) {
            //     $form.find('.g-recaptcha-response').remove();
            //     if( g_recaptha_version == 'v3' ) {
            //         yaniReCaptchaLoad();
            //     } else {
            //         yaniReCaptchaReset();
            //     }
            // }
        },
        error: function(xhr, status, error) {
            var err = eval("(" + xhr.responseText + ")");
            console.log(err.Message);
        }
    });
}


$( '#yani_forgetpass').on('click', function(){
    var user_login = $('#user_login_forgot').val(),
        security    = $('#yani_resetpassword_security').val();

    var $this = $(this);
    var $messages = $('#reset_pass_msg');

    $.ajax({
        type: 'post',
        url: ajaxurl,
        dataType: 'json',
        data: {
            'action': 'yani_reset_password',
            'user_login': user_login,
            'security': security
        },
        beforeSend: function( ) {
            $this.find('.yani-loader-js').addClass('loader-show');
        },
        complete: function(){
            $this.find('.yani-loader-js').removeClass('loader-show');
        },
        success: function( response ) {
            if( response.success ) {
                $messages.empty().append('<div class="alert alert-success" role="alert"><i class="yani-icon icon-check-circle-1 mr-1"></i>'+ response.msg +'</div>');
            } else {
                $messages.empty().append('<div class="alert alert-danger" role="alert"><i class="yani-icon icon-check-circle-1 mr-1"></i>'+ response.msg +'</div>');
            }
        },
        error: function(xhr, status, error) {
            var err = eval("(" + xhr.responseText + ")");
            console.log(err.Message);
        }
    });

});


if( $('#yani_reset_password').length > 0 ) {
    $('#yani_reset_password').click( function(e) {
        e.preventDefault();

        var $this = $(this);
        var rg_login = $('input[name="rp_login"]').val();
        var rp_key = $('input[name="rp_key"]').val();
        var pass1 = $('input[name="pass1"]').val();
        var pass2 = $('input[name="pass2"]').val();
        var security = $('input[name="yani_resetpassword_security"]').val();
        var $messages = $('#reset_pass_msg_2');

        $.ajax({
            type: 'post',
            url: ajaxurl,
            dataType: 'json',
            data: {
                'action': 'yani_reset_password_2',
                'rq_login': rg_login,
                'password': pass1,
                'confirm_pass': pass2,
                'rp_key': rp_key,
                'security': security
            },
            beforeSend: function( ) {
                $this.find('.yani-loader-js').addClass('loader-show');
            },
            complete: function(){
                $this.find('.yani-loader-js').removeClass('loader-show');
            },
            success: function(response) {
                if( response.success ) {
                    $messages.empty().append('<div class="alert alert-success" role="alert"><i class="yani-icon icon-check-circle-1 mr-1"></i>'+ response.msg +'</div>');
                    jQuery('#oldpass, #newpass, #confirmpass').val('');
                } else {
                    $messages.empty().append('<div class="alert alert-danger" role="alert"><i class="yani-icon icon-check-circle-1 mr-1"></i>'+ response.msg +'</div>');
                }
            },
            error: function(errorThrown) {

            }

        });

    } );
}


$('.hz-facebook-login').on('click', function () {
    var current = $(this);
    yani_login_via_facebook( current );
});

var yani_login_via_facebook = function ( current ) {
    var $messages = $('.hz-social-messages');

    $.ajax({
        type: 'POST',
        url: ajaxurl,
        dataType: 'json',
        data: {
            'action' : 'yani_facebook_login_oauth'
        },
        beforeSend: function( ) {
            $messages.empty().append('<div class="alert alert-success" role="alert"><i class="yani-icon icon-check-circle-1 mr-1"></i>'+ login_loading +'</div>');
            current.find('.yani-loader-js').addClass('loader-show');
        },
        complete: function(){
            current.find('.yani-loader-js').removeClass('loader-show');
        },
        success: function (response) { 
            if(response.success) {
                window.location.replace( response.url );
            } else {
                $messages.empty().append('<div class="alert alert-danger" role="alert"><i class="yani-icon icon-check-circle-1 mr-1"></i>'+ response.message +'</div>');
            }
            
        },
        error: function(xhr, status, error) {
            var err = eval("(" + xhr.responseText + ")");
            console.log(err.Message);
        }
    });
}

$('.hz-google-login').on('click', function () {
    var current = $(this);
    yani_login_via_google( current );
});

var yani_login_via_google = function ( current ) {
    var $form = current.parents('form');
    var $messages = $('#hz-login-messages');

    $.ajax({
        type: 'POST',
        url: ajaxurl,
        data: {
            'action' : 'yani_google_login_oauth'
        },
        beforeSend: function( ) {
            $messages.empty().append('<div class="alert alert-success" role="alert"><i class="yani-icon icon-check-circle-1 mr-1"></i>'+ login_loading +'</div>');
            current.find('.yani-loader-js').addClass('loader-show');
        },
        complete: function(){
            current.find('.yani-loader-js').removeClass('loader-show');
        },
        success: function (data) { 
            window.location.replace( data );
        },
        error: function(xhr, status, error) {
            var err = eval("(" + xhr.responseText + ")");
            console.log(err.Message);
        }
    });
}

})(jQuery)