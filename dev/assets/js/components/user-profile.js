(function($){


    if ( typeof yani_vars !== "undefined" ) {

        var user_id = yani_vars.userID;
        var ajaxurl = yani_vars.ajaxurl;
        var yani_upload_nonce = yani_vars.yani_upload_nonce;
        var verify_file_type = yani_vars.verify_file_type;
        var yani_site_url = yani_vars.yani_site_url;
        var gdpr_agree_text = yani_vars.gdpr_agree_text;
        var processing_text = yani_vars.processing_text;


        /*-------------------------------------------------------------------
         *  GDPR Request
         * ------------------------------------------------------------------*/
         $('#yani_gdpr_form').on('submit', function(e) {
            e.preventDefault();
            var $this = $(this);
            var $messages = $('#gdpr-msg');

            var data = {
                'action' : 'yani_gdrf_data_request',
                'gdpr_data_type' : $('input[name=gdrf_data_type]:checked', '#yani_gdpr_form').val(),
                'gdrf_data_email' : $('#gdrf_data_email').val(),
                'gdrf_data_nonce' : $('#yani_gdrf_data_nonce').val(),
            };
            
            $.ajax({
                type: 'POST',
                url: ajaxurl,
                data: data,
                beforeSend: function( ) {
                    $this.find('.yani-loader-js').addClass('loader-show');
                },
                complete: function(){
                    $this.find('.yani-loader-js').removeClass('loader-show');
                },
                success: function (res) {

                    if(res.success) {
                        $messages.empty().append('<div class="alert alert-success" role="alert">'+ res.data +'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                    } else {
                        $messages.empty().append('<div class="alert alert-danger" role="alert">'+ res.data +'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                    }

                },
                error: function(xhr, status, error) {
                    var err = eval("(" + xhr.responseText + ")");
                    console.log(err.Message);
                }
            });

         });

         /*-------------------------------------------------------------------
         *  Cancel Stripe
         * ------------------------------------------------------------------*/
        $('#yani_stripe_cancel').click(function(){
            var stripe_user_id, cancel_msg;
            stripe_user_id = $(this).attr('data-stripeid');
            cancel_msg = $(this).attr('data-message');
            $('#stripe_cancel_success').text(processing_text);

            $.ajax({
                type: 'POST',
                url: ajaxurl,
                data: {
                    'action' : 'yani_cancel_stripe'
                },
                success: function (data) {
                    $('#stripe_cancel_success').text(cancel_msg);
                },
                error: function (errorThrown) {
                }
            });
        });

        /*-------------------------------------------------------------------
         *  Register Agency agent
         * ------------------------------------------------------------------*/
        $('#yani_agency_agent_register').on('click', function(e){
            e.preventDefault();

            var currnt = $(this);
            var $form = $(this).parents('form');
            var $messages = $('#aa_register_message');
            $messages.empty();

            $.ajax({
                type: 'post',
                url: ajaxurl,
                dataType: 'json',
                data: $form.serialize(),
                beforeSend: function () {
                    currnt.find('.yani-loader-js').addClass('loader-show');
                },
                complete: function(){
                    currnt.find('.yani-loader-js').removeClass('loader-show');
                },
                success: function( response ) {
                    if( response.success ) {
                        $('#aa_username, #aa_email, #aa_firstname, #aa_lastname, #aa_password').val('');
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
            return;
        });


        /*-------------------------------------------------------------------
         *  Register Agency agent update
         * ------------------------------------------------------------------*/
        $('#yani_agency_agent_update').on('click', function(e){
            e.preventDefault();

            var currnt = $(this);
            var $form = $(this).parents('form');
            var $messages = $('#aa_register_message');

            $.ajax({
                type: 'post',
                url: ajaxurl,
                dataType: 'json',
                data: $form.serialize(),
                beforeSend: function () {
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
                },
                error: function(xhr, status, error) {
                    var err = eval("(" + xhr.responseText + ")");
                    console.log(err.Message);
                }
            });
            return;
        });

        /*-------------------------------------------------------------------
         *  Update Profile [user_profile.php]
         * ------------------------------------------------------------------*/
        $(".yani_update_profile").click( function(e) {
            e.preventDefault();

            var $this = $(this);
            var $form = $this.parents( 'form' );
            var $block = $this.parents( '.dashboard-content-block' );
            var $result = $block.find('.notify');

            var description = tinyMCE.get('about').getContent();
            

            var gdpr_agreement;

            if($('#gdpr_agreement').length > 0 ) {
                if(!$('#gdpr_agreement').is(":checked")) {
                    jQuery('#profile_message').empty().append('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-hide="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+gdpr_agree_text+'</div>');
                    $(".dashboard-content-area").animate({ scrollTop: 0 }, "slow");
                    return false;
                } else {
                    gdpr_agreement = 'checked';
                }
            } 

            $.ajax({
                url: ajaxurl,
                data: $form.serialize() + "&bio="+description,
                method: $form.attr('method'),
                dataType: "JSON",

                beforeSend: function( ) {
                    $this.find('.yani-loader-js').addClass('loader-show');
                },
                success: function(data) { 
                    if( data.success ) {
                        $result.empty().append('<div class="alert alert-success alert-dismissible fade show" role="alert">'+data.msg+'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                    } else {
                        $result.empty().append('<div class="alert alert-danger alert-dismissible fade show" role="alert">'+data.msg+'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                    }
                },
                error: function(errorThrown) {

                },
                complete: function(){
                    $this.find('.yani-loader-js').removeClass('loader-show');
                }
            });

        });

        /*-------------------------------------------------------------------
         *  Change Password [user-profile.php]
         * ------------------------------------------------------------------*/
        $("#yani_change_pass").click( function(e) {
            e.preventDefault();
            var securitypassword, oldpass, newpass, confirmpass;

            var $this = $(this);
            newpass          = $("#newpass").val();
            confirmpass      = $("#confirmpass").val();
            securitypassword = $("#yani-security-pass").val();

            $.ajax({
                type: 'POST',
                dataType: 'json',
                url:   ajaxurl,
                data: {
                    'action'      : 'yani_ajax_password_reset',
                    'newpass'     : newpass,
                    'confirmpass' : confirmpass,
                    'yani-security-pass' : securitypassword,
                },
                beforeSend: function( ) {
                    $this.find('.yani-loader-js').addClass('loader-show');
                },
                success: function(data) {
                    if( data.success ) {
                        jQuery('#password_reset_msgs').empty().append('<p class="success text-success"><i class="fa fa-check"></i> '+ data.msg +'</p>');
                        jQuery('#newpass, #confirmpass').val('');
                    } else {
                        jQuery('#password_reset_msgs').empty().append('<p class="error text-danger"><i class="fas fa-times"></i> '+ data.msg +'</p>');
                    }
                },
                error: function(errorThrown) {

                },
                complete: function(){
                    $this.find('.yani-loader-js').removeClass('loader-show');
                }
            });

        });

        $('#yani_delete_account').click(function(e){
            e.preventDefault();

            var confirm = window.confirm("Are you sure!, you want to delete a account.");

            if ( confirm == true ) {

                $.ajax({
                    type: 'post',
                    url: ajaxurl,
                    dataType: 'json',
                    data: {
                        'action': 'yani_delete_account'
                    },
                    beforeSend: function () {
                        profile_processing_modal(processing_text);
                    },
                    success: function( response ) {
                        if( response.success ) {
                            window.location.href = yani_site_url;
                        }
                    },
                    error: function(xhr, status, error) {
                        var err = eval("(" + xhr.responseText + ")");
                        console.log(err.Message);
                    }
                });

            }

        });

        $('.yani_delete_agency_agent').click(function(e){
            e.preventDefault();

            var confirm = window.confirm("Are you sure!, you want to delete a account.");
            var agent_id = $(this).attr('data-agentid');
            var agent_delete_security = $('#agent_delete_security').val();

            if ( confirm == true ) {

                $.ajax({
                    type: 'post',
                    url: ajaxurl,
                    dataType: 'json',
                    data: {
                        'action': 'yani_delete_agency_agent',
                        'agent_delete_security': agent_delete_security,
                        'agent_id': agent_id
                    },
                    beforeSend: function () {
                        profile_processing_modal(processing_text);
                    },
                    success: function( response ) {
                        if( response.success ) {
                            window.location.reload();
                        }
                    },
                    error: function(xhr, status, error) {
                        var err = eval("(" + xhr.responseText + ")");
                        console.log(err.Message);
                    }
                });

            }

        });


        $( '#yani_user_role' ).on( 'change', function(e) {
            e.preventDefault();

            var user_role = $( this ).val();
            var nonce    = $('#yani-role-security-pass').val();
            var _wp_http_referer = $( 'input[name="_wp_http_referer"]' ).val();

            $.ajax({
                type: 'post',
                url: ajaxurl,
                dataType: 'json',
                data: {
                    'action': 'yani_change_user_role',
                    'role': user_role,
                    'yani-role-security-pass' : nonce,
                    '_wp_http_referer' : _wp_http_referer
                },
                beforeSend: function () {
                    profile_processing_modal(processing_text);
                },
                success: function( response ) {
                    if( response.success ) {
                        window.location.reload(true);
                    }
                },
                error: function(xhr, status, error) {
                    var err = eval("(" + xhr.responseText + ")");
                    console.log(err.Message);
                }
            });
        });

        $( '#yani_user_currency' ).on( 'change', function(e) {
            e.preventDefault();

            var user_currency = $( this ).val();
            var nonce    = $('#yani-user-currency-security-pass').val();

            $.ajax({
                type: 'post',
                url: ajaxurl,
                dataType: 'json',
                data: {
                    'action': 'yani_change_user_currency',
                    'currency': user_currency,
                    'yani-user-currency-security-pass' : nonce
                },
                beforeSend: function () {
                    profile_processing_modal(processing_text);
                },
                success: function( response ) {
                    if( response.success ) {
                        window.location.reload();
                    }
                },
                error: function(xhr, status, error) {
                    var err = eval("(" + xhr.responseText + ")");
                    console.log(err.Message);
                }
            });
        });

        var profile_processing_modal = function ( msg ) {
            var process_modal ='<div class="modal fade" id="yani_modal" tabindex="-1" role="dialog" aria-labelledby="yaniModalLabel" aria-hidden="true"><div class="modal-dialog"><div class="modal-content"><div class="modal-body yani_messages_modal">'+msg+'</div></div></div></div></div>';
            jQuery('body').append(process_modal);
            jQuery('#yani_modal').modal();
        }

        var profile_processing_modal_close = function ( ) {
            jQuery('#yani_modal').modal('hide');
        }

        /*-------------------------------------------------------------------
         *  Upload user profile image
         * ------------------------------------------------------------------*/
        var yani_plupload = new plupload.Uploader({
            browse_button: 'select_user_profile_photo',
            file_data_name: 'yani_file_data_name',
            multi_selection : false,
            url: ajaxurl + "?action=yani_user_picture_upload&verify_nonce=" + yani_upload_nonce + "&user_id=" + user_id,
            filters: {
                mime_types : [
                    { title : verify_file_type, extensions : "jpg,jpeg,gif,png" }
                ],
                max_file_size: '12000kb',
                prevent_duplicates: true
            }
        });
        yani_plupload.init();

        yani_plupload.bind('FilesAdded', function(up, files) {
            var yani_thumbnail = "";
            plupload.each(files, function(file) {
                yani_thumbnail += '<div id="imageholder-' + file.id + '" class="yani-thumb">' + '' + '</div>';
            });
            document.getElementById('yani_profile_photo').innerHTML = yani_thumbnail;
            up.refresh();
            yani_plupload.start();
        });

        yani_plupload.bind('UploadProgress', function(up, file) {
            document.getElementById( "imageholder-" + file.id ).innerHTML = '<span>' + file.percent + "%</span>";
        });

        yani_plupload.bind('Error', function( up, err ) {
            document.getElementById('yani_upload_errors').innerHTML += "<br/>" + "Error #" + err.code + ": " + err.message;
        });

        yani_plupload.bind('FileUploaded', function ( up, file, ajax_res ) {
            var response = $.parseJSON( ajax_res.response );

            if ( response.success ) {

                var yani_profile_thumb = '<img class="img-fluid" src="' + response.url + '" alt="" />' +
                    '<input type="hidden" class="profile-pic-id" id="profile-pic-id" name="profile-pic-id" value="' + response.attachment_id + '"/>';

                document.getElementById( "imageholder-" + file.id ).innerHTML = yani_profile_thumb;

            } else {
                console.log ( response );
            }
        });

    }

})(jQuery)