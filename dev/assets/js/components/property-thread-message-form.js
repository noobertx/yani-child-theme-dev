/*
 * Property Thread Message Form
 * -----------------------------*/
(function($){
    var ajaxurl = yani_vars.ajaxurl;

    $( '.start_thread_message_form').on('click', function(e) {

        e.preventDefault();

        var $this = $(this);
        var $form = $this.parents( 'form' );
        var $result = $form.find('.form_messages');

        $.ajax({
            url: ajaxurl,
            data: $form.serialize(),
            method: $form.attr('method'),
            dataType: "JSON",

            beforeSend: function( ) {
                $this.find('.yani-loader-js').addClass('loader-show');
            },
            success: function( response ) {
                $this.find('.yani-loader-js').removeClass('loader-show');
                // window.location.replace( response.url );
            },
            complete: function(){
                $this.find('.yani-loader-js').removeClass('loader-show');
            }
        });

    });
})(jQuery)