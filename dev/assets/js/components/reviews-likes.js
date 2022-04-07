(function($){
    var ajaxurl =yani_vars.ajaxurl;
     var review_likes = function() {
        $('.hz-like-dislike-js').on('click', function(e) {
            e.preventDefault();
            var $this = jQuery(this);
            var $parent = $this.parents('.likes-container-js');

            if($this.hasClass('already-voted')){
                $parent.find( '.vote-msg' ).text($this.data('msg')).show();
                var hideMessage = function(){
                    $parent.find( '.vote-msg' ).hide();
                };
                setTimeout(hideMessage, 3000);
            
            } else {

                var review_id = $this.data('id');
                var type = $this.data('type');

                $.ajax({
                    type: 'post',
                    url: ajaxurl,
                    dataType: "JSON",
                    data: {
                        'action': 'reviews_likes_dislikes',
                        'type': type,
                        'review_id': review_id,
                    },
                    beforeSend: function( ) {
                        $parent.find('.vote-msg').empty();
                        $parent.find('.yani-loader-js').addClass('loader-show');

                        if(type == 'likes') {
                            $('.review-dislike-button a').removeClass('already-voted');
                        } else if(type == 'dislikes') {
                            $('.review-like-button a').removeClass('already-voted');
                        }
                    },
                    success: function(res) {
                        if(res.success) {
                            $parent.find('.likes-count').text(res.likes);
                            $parent.find('.dislikes-count').text(res.dislikes);
                            $parent.find('.vote-msg').text(res.msg).show();
                        } else {
                            $parent.find('.vote-msg').text(res.msg).show();
                        }

                        var hideMessage = function(){
                            $parent.find( '.vote-msg' ).hide();
                        };
                        setTimeout(hideMessage, 3000);
                        $this.addClass('already-voted');
                    },
                    error: function(xhr, status, error) {
                        var err = eval("(" + xhr.responseText + ")");
                        console.log(err.Message);
                    },
                    complete: function(){
                        $parent.find('.yani-loader-js').removeClass('loader-show');
                    }

                });
            }

        });
    }
    review_likes();
})(jQuery)