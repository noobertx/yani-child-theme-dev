/*--------------------------------------------------------------------------
 *  Property Schedule Contact Form
 * -------------------------------------------------------------------------*/
(function($){

    $( '.schedule_contact_form').on('click', function(e) {
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
            success: function(response) {
                if( response.success ) {
                    $form.find('input[name="name"], input[name="phone"], input[name="email"]').val('');
                    $form.find('textarea').val('');
                    $result.empty().append('<div class="alert alert-success alert-dismissible fade show" role="alert">'+response.msg+'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                } else {
                    $result.empty().append('<div class="alert alert-danger alert-dismissible fade show" role="alert">'+response.msg+'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
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