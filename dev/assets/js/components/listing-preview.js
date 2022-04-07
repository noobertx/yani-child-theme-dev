/* ------------------------------------------------------------------------ */
/*  Listing Preview
/* ------------------------------------------------------------------------ */ 
var ajaxurl = yani_vars.ajaxurl;
var userID = yani_vars.userID;
var processing_text = yani_vars.processing_text;
var yani_rtl  = yani_vars.yani_rtl ;
yani_listing_lightbox(ajaxurl, processing_text, yani_rtl, userID);

/*--------------------------------------------------------------------------
*   Listing Preview
* -------------------------------------------------------------------------*/
function yani_listing_lightbox(ajaxurl, processing_text, yani_rtl, userID) {
        
    jQuery('.hz-show-lightbox-js').on('click', function() {

        var listing_id = jQuery(this).data('listid');
        var $parents = jQuery(this).parents('.item-wrap');
        var preview_loader = $parents.find('.preview_loader');

        jQuery.ajax({
            type: 'post',
            url: ajaxurl,
            data: {
                'action': 'load_lightbox_content',
                'listing_id': listing_id
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
            success: function( response ) {
                
                jQuery('#hz-listing-model-content').html(response);

                jQuery('#yani-listing-lightbox').modal('show'); 

                jQuery('.lightbox-slider').not('.slick-initialized').slick({
                    rtl: yani_rtl,
                    lazyLoad: 'ondemand',
                    infinite: true,
                    speed: 300,
                    slidesToShow: 1,
                    arrows: true,
                    adaptiveHeight: true,
                });

                jQuery('#yani-listing-lightbox').on('shown.bs.modal', function (e) {
                    jQuery('.lightbox-slider').slick('setPosition');
                    jQuery('.lightbox-slider').slick('refresh');
                });
                

                jQuery('.btn-expand').on('click', function () {
                    jQuery('.lightbox-gallery-wrap').toggleClass("lightbox-gallery-full-wrap");
                    jQuery('.lightbox-slider').slick('setPosition');
                    
                });

                jQuery('.btn-email').on('click', function () {
                    jQuery('.lightbox-form-wrap').toggleClass("lightbox-form-wrap-show");
                });

                window.yani_init_add_favorite(ajaxurl, userID);
                window.yani_init_remove_favorite(ajaxurl, userID);

            },
            error: function(xhr, status, error) {
                var err = eval("(" + xhr.responseText + ")");
                console.log(err.Message);
            }
        })

    });
}
