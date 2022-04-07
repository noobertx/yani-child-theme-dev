/* ------------------------------------------------------------------------ */
/* compare Listings
/* ------------------------------------------------------------------------ */
(function($){  

var compare_url =yani_vars.compare_url;
var compare_add_icon =yani_vars.compare_add_icon;
var compare_remove_icon =yani_vars.compare_remove_icon;
var add_compare_text  =yani_vars.add_compare_text ;
var remove_compare_text  =yani_vars.remove_compare_text ;
var compare_limit  =yani_vars.compare_limit ;
var listings_compare  =yani_vars.listings_compare ;
var limit_item_compare  =yani_vars.limit_item_compare ;
function add_to_compare(compare_url, compare_add_icon, compare_remove_icon, add_compare_text, remove_compare_text, compare_limit, listings_compare, limit_item_compare) {
    jQuery('a.compare-btn').attr('href', compare_url + '?ids=' + yaniGetCookie('yani_compare_listings'));

    var listings_compare = yaniGetCookie('yani_compare_listings');

    if (listings_compare.length > 0) {
        jQuery('.compare-property-label').fadeIn(1000);
    }

    if(listings_compare && listings_compare.length){
        listings_compare = listings_compare.split(',');
        if(listings_compare.length){
            for(var i = 0 ; i < listings_compare.length; i++){
                jQuery( '.yani_compare[data-listing_id="'+listings_compare[i]+'"] i').removeClass('icon-add-circle').addClass('icon-subtract-circle');
                jQuery( '.yani_compare[data-listing_id="'+listings_compare[i]+'"]').attr('title', remove_compare_text);
            }
            jQuery('.compare-property-label').find('.compare-count').html(listings_compare.length);
        }

        jQuery('.yani_compare').tooltip('hide').attr('data-original-title', remove_compare_text);

    }else{
        listings_compare = [];
    }
    jQuery( '.yani_compare' ).on('click', function(e) {
        e.preventDefault();

        var listings_compare = yaniGetCookie('yani_compare_listings');

        if(listings_compare && listings_compare.length) {
            listings_compare = listings_compare.split(',');
        } else {
            listings_compare = [];
        }

        var listing_id = jQuery( this ).data( 'listing_id' );
        var index = listings_compare.indexOf( listing_id.toString() );
        var image_div = jQuery(this).parents('.item-wrap');
        var thumb_url = image_div.find('img').attr('src');

        if( index == -1 ){
            if(listings_compare.length >= limit_item_compare){
                alert(compare_limit);
            }else{ 

                jQuery('.compare-wrap').append('<div class="compare-item remove-'+listing_id+'"><a href="" class="remove-compare remove-icon" data-listing_id="'+listing_id+'"><i class="yani-icon icon-remove-circle"></i></a><img class="img-fluid" src="'+thumb_url+'" width="200" height="150" alt="Thumb"></div>');

                jQuery(this).attr('title', remove_compare_text);
                jQuery(this).tooltip('dispose').tooltip('show');
                jQuery(this).find('i').removeClass('icon-add-circle').addClass('icon-subtract-circle');
                listings_compare.push(listing_id.toString());
                yaniSetCookie('yani_compare_listings', listings_compare.join(','), 30);
                jQuery('.compare-property-label').find('.compare-count').html(listings_compare.length);
                jQuery('a.compare-btn').attr('href', compare_url + '?ids=' + yaniGetCookie('yani_compare_listings'));
                jQuery('.compare-property-label').fadeIn(1000);
                jQuery(this).toggleClass('active');
                jQuery('.compare-property-active').addClass('compare-property-active-push-toleft' );
                jQuery('#compare-property-panel').addClass('compare-property-panel-open');

                remove_from_compare(listings_compare, compare_add_icon, compare_remove_icon, add_compare_text, remove_compare_text);
            }
        }else{

            jQuery('div.remove-'+listing_id).remove();
            jQuery(this).attr('title', add_compare_text);
            jQuery(this).tooltip('dispose').tooltip('show');
            jQuery(this).find('i').removeClass('icon-subtract-circle').addClass('icon-add-circle');
            listings_compare.splice(index, 1);
            yaniSetCookie('yani_compare_listings', listings_compare.join(','), 30);
            jQuery('.compare-property-label').find('.compare-count').html(listings_compare.length);
            jQuery('a.compare-btn').attr('href', compare_url + '?ids=' + yaniGetCookie('yani_compare_listings'));
            
            if (listings_compare.length > 0) {
                jQuery('.compare-property-label').fadeIn(1000);
                jQuery(this).toggleClass('active');
                jQuery('.compare-property-active').addClass('compare-property-active-push-toleft' );
                jQuery('#compare-property-panel').addClass('compare-property-panel-open');
            } else {
                jQuery('.compare-property-label').fadeOut(1000);
            }
        }
        return false;
        
    });
}


function remove_from_compare(listings_compare, compare_add_icon, compare_remove_icon, add_compare_text, remove_compare_text) {
    jQuery('.remove-compare').on('click', function(e){
        e.preventDefault();
        
        if(typeof listings_compare == 'object') {
    
            listings_compare = listings_compare.toString();
        }

        if(listings_compare && listings_compare.length){
            listings_compare = listings_compare.split(',');
            if(listings_compare.length){
                
                jQuery('.compare-property-label').find('.compare-count').html(listings_compare.length);
            }
        }else{
            listings_compare = [];
        }

        var listing_id = jQuery( this ).data( 'listing_id' );
        var index = listings_compare.indexOf( listing_id.toString() );
        listings_compare.splice(index, 1);
        yaniSetCookie('yani_compare_listings', listings_compare.join(','), 30);
        jQuery('.compare-property-label').find('.compare-count').html(listings_compare.length);

        jQuery('.compare-'+listing_id).attr('title', add_compare_text);
        jQuery('.compare-'+listing_id).tooltip('hide').attr('data-original-title', add_compare_text);
        jQuery('.compare-'+listing_id).find('i').removeClass('icon-subtract-circle').addClass('icon-add-circle');
        jQuery(this).parents('.compare-item').remove();
    });
}

function yaniSetCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+ d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
};

function yaniGetCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for(var i = 0; i <ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
};

function compare_for_ajax() {
    var listings_compare = yaniGetCookie('yani_compare_listings');
    var limit_item_compare = 4;
    add_to_compare(compare_url, compare_add_icon, compare_remove_icon, add_compare_text, remove_compare_text, compare_limit, listings_compare, limit_item_compare );
    remove_from_compare(listings_compare, compare_add_icon, compare_remove_icon, add_compare_text, remove_compare_text);
}

    $('.compare-property-label').on('click', function() {
        $(this).toggleClass('active');
        $('.compare-property-active').addClass('compare-property-active-push-toleft' );
        $('#compare-property-panel').addClass('compare-property-panel-open');
    });
    $('.close-compare-panel').on('click', function() {
        $(this).toggleClass('active');
        $('.compare-property-active').removeClass('compare-property-active-push-toleft' );
        $('#compare-property-panel').removeClass('compare-property-panel-open');
    });
    var listings_compare = yaniGetCookie('yani_compare_listings');

    var limit_item_compare = 4;
    add_to_compare(compare_url, compare_add_icon, compare_remove_icon, add_compare_text, remove_compare_text, compare_limit, listings_compare, limit_item_compare );
    remove_from_compare(listings_compare, compare_add_icon, compare_remove_icon, add_compare_text, remove_compare_text);

})(jQuery)