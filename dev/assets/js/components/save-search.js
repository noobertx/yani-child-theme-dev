/*--------------------------------------------------------------------------
 *  Save Search
 * -------------------------------------------------------------------------*/
 (function($){
$("#save_search_click").on('click', function(e) {
    e.preventDefault();

    var $this = $(this);

    var search_args = $('input[name="search_args"]').val();
    var security = $('input[name="yani_save_search_ajax"]').val();
    var search_URI = $('input[name="search_URI"]').val();

    if( parseInt( userID, 10 ) === 0 ) {
            yani_login_modal();
    } else {
        $.ajax({
            url: ajaxurl,
            data: {
                'action': 'yani_save_search',
                'search_args': search_args,
                'search_URI': search_URI,
                'yani_save_search_ajax': security,
            },
            method: 'POST',
            dataType: 'JSON',

            beforeSend: function () {
                $this.find('.yani-loader-js').addClass('loader-show');
            },
            success: function (response) {
                if (response.success) {
                    $('#save_search_click').attr('disabled', true);
                }
            },
            error: function (xhr, status, error) {
                var err = eval("(" + xhr.responseText + ")");
                console.log(err.Message);
            },
            complete: function () {
                $this.find('.yani-loader-js').removeClass('loader-show');
            }
        });
    }

});
})(jQuery)