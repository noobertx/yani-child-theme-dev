/* ------------------------------------------------------------------------ */
/*  Price Range Slider
/* ------------------------------------------------------------------------ */

(function($){

	var is_halfmap = yani_vars.is_halfmap;
	var for_rent_price_slider = yani_vars.for_rent_price_slider;
	var search_price_range_min = parseInt( yani_vars.search_min_price_range );
    var search_price_range_max = parseInt( yani_vars.search_max_price_range );
    var search_price_range_min_rent = parseInt( yani_vars.search_min_price_range_for_rent );
    var currency_position = parseInt( yani_vars.currency_position );
    var currency_symb =  yani_vars.currency_symbol ;
    var thousands_separator  =  yani_vars.thousands_separator ;

    var thousandSeparator = (n) => {
        if (typeof n === 'number') {
            n += '';
            var x = n.split('.');
            var x1 = x[0];
            var x2 = x.length > 1 ? '.' + x[1] : '';
            var rgx = /(\d+)(\d{3})/;
            while (rgx.test(x1)) {
                x1 = x1.replace(rgx, '$1' + thousands_separator + '$2');
            }
            return x1 + x2;
        } else {
            return n;
        }
    }

    var price_range_search = function( min_price, max_price ) {
        $(".price-range").slider({
            range: true,
            min: min_price,
            max: max_price,
            values: [min_price, max_price],
            slide: function (event, ui) {
                if( currency_position == 'after' ) {
                    var min_price_range = thousandSeparator(ui.values[0]) + currency_symb;
                    var max_price_range = thousandSeparator(ui.values[1]) + currency_symb;
                } else {
                    var min_price_range = currency_symb + thousandSeparator(ui.values[0]);
                    var max_price_range = currency_symb + thousandSeparator(ui.values[1]);
                }
                $(".min-price-range-hidden").val( ui.values[0] );
                $(".max-price-range-hidden").val( ui.values[1] );

                $(".min-price-range").text( min_price_range );
                $(".max-price-range").text( max_price_range );
            },
            stop: function( event, ui ) {
                
            },
            change: function( event, ui ) {  }
        });

        if( currency_position == 'after' ) {
            var min_price_range = thousandSeparator($(".price-range").slider("values", 0)) + currency_symb;
            var max_price_range = thousandSeparator($(".price-range").slider("values", 1)) + currency_symb;
        } else {
            var min_price_range = currency_symb + thousandSeparator($(".price-range").slider("values", 0));
            var max_price_range = currency_symb + thousandSeparator($(".price-range").slider("values", 1));
        }

        $(".min-price-range").text(min_price_range);
        $(".max-price-range").text(max_price_range);
        $(".min-price-range-hidden").val($(".price-range").slider("values", 0));
        $(".max-price-range-hidden").val($(".price-range").slider("values", 1));
        
    }

    if($( ".price-range").length > 0 && is_halfmap != 1) {
        var selected_status_adv_search = $('.status-js').val();
        if( selected_status_adv_search == for_rent_price_slider ){
            price_range_search(search_price_range_min_rent, search_price_range_max_rent);
        } else {
            price_range_search( search_price_range_min, search_price_range_max );
        }

        $('.status-js').on('change', function(){
            var search_status = $(this).val();
            if( search_status == for_rent_price_slider ) {
                price_range_search(search_price_range_min_rent, search_price_range_max_rent);
            } else { 
                price_range_search( search_price_range_min, search_price_range_max );
            }
        });

        $('.status-tab-js').on('click', function() {
            var tab_status = $(this).data('val');
            if( tab_status == for_rent_price_slider ) {
                price_range_search(search_price_range_min_rent, search_price_range_max_rent);
            } else { 
                price_range_search( search_price_range_min, search_price_range_max );
            }
        });
    }

})(jQuery)