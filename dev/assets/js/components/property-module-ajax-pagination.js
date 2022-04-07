/*--------------------------------------------------------------------------
 *  Property Module Ajax Pagination
 * -------------------------------------------------------------------------*/
(function($){
var ajaxurl =yani_vars.ajaxurl;
var properties_module_section = $('#properties_module_section');
if( properties_module_section.length > 0 ) {

    $("body").on('click', '.yani-load-more a', function(e) {
        e.preventDefault();
        var $this = $(this);
        var $wrap = $this.closest('#properties_module_section').find('#module_properties');
        var prop_limit = $this.data('prop-limit');
        var paged = $this.data('paged');
        var card_version = $this.data('card');
        var type = $this.data('type');
        var status = $this.data('status');
        var state = $this.data('state');
        var city = $this.data('city');
        var country = $this.data('country');
        var area = $this.data('area');
        var label = $this.data('label');
        var user_role = $this.data('user-role');
        var featured_prop = $this.data('featured-prop');
        var offset = $this.data('offset');
        var sortby = $this.data('sortby');

        $.ajax({
            type: 'POST',
            url: ajaxurl,
            data: {
                'action': 'yani_loadmore_properties',
                'prop_limit': prop_limit,
                'paged': paged,
                'card_version': card_version,
                'type': type,
                'status': status,
                'state': state,
                'city': city,
                'country': country,
                'area': area,
                'label': label,
                'user_role': user_role,
                'featured_prop': featured_prop,
                'sort_by': sortby,
                'offset': offset
            },
            beforeSend: function( ) {
                $this.find('.yani-loader-js').addClass('loader-show');
            },
            complete: function(){
                $this.find('.yani-loader-js').removeClass('loader-show');
            },
            success: function (data) { 
                if(data == 'no_result') {
                     $this.closest('#properties_module_section').find('.yani-load-more').fadeOut('fast').remove();
                     return;
                }
                var $wrap = $this.closest('#properties_module_section').find('#module_properties');
                $wrap.append(data);
                $this.data("paged", paged+1);
                $this.find('i').remove();

                yani_init_add_favorite(ajaxurl, userID);
                yani_init_remove_favorite(ajaxurl, userID);
                yani_listing_lightbox(ajaxurl, processing_text, yani_rtl, userID);
                compare_for_ajax();
                $('[data-toggle="tooltip"]').tooltip();

            },
            error: function (xhr, status, error) {
                var err = eval("(" + xhr.responseText + ")");
                console.log(err.Message);
            }

        });

    }); 

}
})(jQuery)