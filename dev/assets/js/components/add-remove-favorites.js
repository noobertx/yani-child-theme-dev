/*--------------------------------------------------------------------------
*   Add or remove favorites
* -------------------------------------------------------------------------*/
(function($){
    var ajaxurl = yani_vars.ajaxurl;
    var userID = yani_vars.userID;
    window.yani_init_add_favorite = function(ajaxurl, userID) {
        jQuery(".add-favorite-js").on('click', function (e) {
            e.preventDefault();
            var curnt = jQuery(this);
            var listID = jQuery(this).attr('data-listid');

            add_to_favorite( ajaxurl, listID, curnt, userID );
            return false;
        });
    }

    window.yani_init_remove_favorite = function(ajaxurl, userID) {
        jQuery(".remove_fav").on('click', function () {
            var curnt = jQuery(this);
            var listID = jQuery(this).attr('data-listid');
            add_to_favorite( ajaxurl, listID, curnt, userID );
            var itemWrap = curnt.parents('tr').remove();
        });
    }

    function add_to_favorite( ajaxurl, listID, curnt, userID ) {
        if( parseInt( userID, 10 ) === 0 || userID == undefined) {
            jQuery('#login-register-form').modal('show');
            jQuery('.login-form-tab').addClass('active show');
            jQuery('.modal-toggle-1.nav-link').addClass('active');
        } else {

            var $parents = curnt.parents('.item-wrap');
            var preview_loader = $parents.find('.preview_loader');

            jQuery.ajax({
                type: 'post',
                url: ajaxurl,
                dataType: 'json',
                data: {
                    'action': 'add_to_favorite',
                    'listing_id': listID
                },
                beforeSend: function( ) {
                    preview_loader.empty().append(''
                        +'<div class="yani-overlay-loading">'
                        +'<div class="overlay-placeholder">'
                        +'<div class="loader-ripple spinner">'
                        +'<div class="bounce1"></div>'
                        +'<div class="bounce2"></div>'
                        +'<div class="bounce3"></div>'
                        +'</div>'
                        +'</div>'
                        +'</div>'
                    );
                },
                complete: function(){
                    preview_loader.empty();
                },
                success: function( data ) {
                    if( data.added ) {
                        curnt.children('i').addClass('text-danger');
                    } else {
                        curnt.children('i').removeClass('text-danger');
                    }
                    preview_loader.empty();
                },
                complete: function(){

                },
                error: function(xhr, status, error) {
                    var err = eval("(" + xhr.responseText + ")");
                    console.log(err.Message);
                }
            });
        } // End else
    }

    /*--------------------------------------------------------------------------
     *   Add or remove favorites
     * -------------------------------------------------------------------------*/
    window.yani_init_add_favorite(ajaxurl, userID);
    window.yani_init_remove_favorite(ajaxurl, userID);
})(jQuery)