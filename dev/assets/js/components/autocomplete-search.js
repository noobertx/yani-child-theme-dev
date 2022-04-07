(function($){
    var ajaxurl =yani_vars.ajaxurl;
    var keyword_autocomplete =yani_vars.keyword_autocomplete;
    var autosearch_text  = yani_vars.autosearch_text ;
    keyword_autocomplete = 1;
    /*--------------------------------------------------------------------------
     *  AutoComplete Search
     * -------------------------------------------------------------------------*/

     console.log(keyword_autocomplete+ "Autocomplete");
    if( keyword_autocomplete != 0 ) {
        var yaniAutoComplete = function () {

            var ajaxCount = 0;
            var auto_complete_container = $('.auto-complete');
            var lastLenght = 0;

            $('.yani-keyword-autocomplete').keyup(function() {

                var $this = $( this );
                var $dataType = $this.data('type');
                var $form = $this.parents( 'form');
                
                if( $dataType == 'banner' ) {
                    var auto_complete_container = $( '#yani-auto-complete-banner' );
                } else {
                    var auto_complete_container = $form.find( '.auto-complete' );
                }

                var keyword = $( this ).val();
                
                keyword = $.trim( keyword );
                var currentLenght = keyword.length;

                if ( currentLenght >= 2 && currentLenght != lastLenght ) {

                    lastLenght = currentLenght;
                    auto_complete_container.fadeIn();

                    $.ajax({
                        type: 'POST',
                        url: ajaxurl,
                        data: {
                            'action': 'yani_get_auto_complete_search',
                            'key': keyword,
                        },
                        beforeSend: function( ) {
                            ajaxCount++;
                            if ( ajaxCount == 1 ) {
                                auto_complete_container.html('<ul class="list-group"><li class="list-group-item"><i class="fa fa-spinner fa-spin fa-fw"></i> '+autosearch_text+ '</li></ul>');
                            }
                        },
                        success: function(data) {
                            ajaxCount--;
                            if ( ajaxCount == 0 ) {
                                auto_complete_container.show();
                                if( data != '' ) {
                                    auto_complete_container.empty().html(data).bind();
                                }
                            }
                        },
                        error: function(errorThrown) {
                            ajaxCount--;
                            if ( ajaxCount == 0 ) {
                                auto_complete_container.html('<ul class="list-group"><li class="list-group-item"><i class="fa fa-spinner fa-spin fa-fw"></i> '+autosearch_text+ '</li></ul>');
                            }
                        }
                    });

                } else {
                    if ( currentLenght != lastLenght ) {
                        auto_complete_container.fadeOut();
                    }
                }

            });
            auto_complete_container.on( 'click', 'li', function (){
                $('.yani-keyword-autocomplete').val( $( this ).data( 'text' ) );
                auto_complete_container.fadeOut();
            }).bind();
        }
        yaniAutoComplete();
    }
})(jQuery)