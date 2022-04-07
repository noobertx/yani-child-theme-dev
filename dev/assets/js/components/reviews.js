/*-----------------------------------------------------------------------------------*/
/* Reviews 
/*-----------------------------------------------------------------------------------*/
(function($){

	var ajaxurl =yani_vars.ajaxurl;
    $('#submit-review').on('click', function(e) {
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
                    $result.empty().append('<div class="alert alert-success alert-dismissible fade show" role="alert">'+response.msg+'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                    window.location.replace( response.review_link );
                } else {
                    $result.empty().append('<div class="alert alert-danger alert-dismissible fade show" role="alert">'+response.msg+'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                }
            },
            error: function(xhr, status, error) {
                var err = eval("(" + xhr.responseText + ")");
                console.log(err.Message);
            },
            complete: function() {
                $this.find('.yani-loader-js').removeClass('loader-show');
            }
        });
    });

    var listing_review_ajax = function(sortby, listing_id, paged) {
        var review_container = $('#yani_reviews_container');
        var review_post_type = $('input[name="review_post_type"]').val();
        
        $.ajax({
            type: 'post',
            url: ajaxurl,
            data: {
                'action': 'yani_ajax_review',
                'sortby': sortby,
                'listing_id': listing_id,
                'review_post_type': review_post_type,
                'paged': paged
            },
            beforeSend: function( ) {
                
                review_container.empty().append(''
                    +'<div id="yani-map-loading">'
                    +'<div class="mapPlaceholder">'
                    +'<div class="loader-ripple spinner">'
                    +'<div class="bounce1"></div>'
                    +'<div class="bounce2"></div>'
                    +'<div class="bounce3"></div>'
                    +'</div>'
                    +'</div>'
                    +'</div>'
                );

                $('html, body').animate({
                    scrollTop: $("#property-review-wrap").offset().top-50
                }, 'slow');
            },
            success: function(data) {
                review_container.empty();
                review_container.html(data);
                review_likes();
                
            },
            error: function(xhr, status, error) {
                var err = eval("(" + xhr.responseText + ")");
                console.log(err.Message);
            },
            complete: function(){
                
            }

        });
    }

    if($('#sort_review').length > 0) {
        $('#sort_review').on('change', function() {
            var sortby = $(this).val();
            var listing_id = $('input[name="listing_id"]').val();
            var paged = 1;
            $('#review_paged').val(paged);
            $('#review_prev').attr('disabled', true);
            $('#review_next').attr('disabled', false);
            listing_review_ajax(sortby, listing_id, paged);
            return;
        }); 
    }

    if($('#review_next').length > 0) {
        $('#review_next').on('click', function(e) {
            e.preventDefault();
            $('#review_prev').removeAttr('disabled');
            var sortby = $('#sort_review').val();
            var total_pages = $('#total_pages').val();
            var listing_id = $('input[name="listing_id"]').val();
            var paged = $('#review_paged').val();
            paged = Number(paged)+1;
            $('#review_paged').val(paged);

            if(paged == total_pages) {
                $(this).attr('disabled', true);
            }
            listing_review_ajax(sortby, listing_id, paged);
            return;
        }); 
    }

    if($('#review_prev').length > 0) {
        $('#review_prev').on('click', function(e) {
            e.preventDefault();
            $('#review_next').removeAttr('disabled');
            var sortby = $('#sort_review').val();
            var listing_id = $('input[name="listing_id"]').val();
            var paged = $('#review_paged').val();
            paged = Number(paged)-1;
            $('#review_paged').val(paged);
            if(paged <= 1) {
                $(this).attr('disabled', true);
            }
            listing_review_ajax(sortby, listing_id, paged);
            return;
        }); 
    }
})(jQuery)