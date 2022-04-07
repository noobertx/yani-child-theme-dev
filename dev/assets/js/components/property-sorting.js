/*-----------------------------------------------------------------------------------*/
/* PROPERTIES SORTING
/*-----------------------------------------------------------------------------------*/
(function($){
function insertParam(key, value) {
    key = encodeURI(key);
    value = encodeURI(value);

    // get querystring , remove (?) and covernt into array
    var qrp = document.location.search.substr(1).split('&');

    // get qrp array length
    var i = qrp.length;
    var j;
    while (i--) {
        //covert query strings into array for check key and value
        j = qrp[i].split('=');

        // if find key and value then join
        if (j[0] == key) {
            j[1] = value;
            qrp[i] = j.join('=');
            break;
        }
    }

    if (i < 0) {
        qrp[qrp.length] = [key, value].join('=');
    }
    // reload the page
    document.location.search = qrp.join('&');

}

$('#sort_properties').on('change', function() {
    var key = 'sortby';
    var value = $(this).val();
    insertParam( key, value );
});

$('#insights_filter').on('change', function() {
    var key = 'listing_id';
    var value = $(this).val();
    insertParam( key, value );
});

$('#yani-gmap-full').on('click', function() {
    var $this = $(this);
    if($this.hasClass('active')) {
        $this.removeClass('active');
        $this.parents('.map-wrap').removeClass('yani-fullscreen-map');
    } else {
        $this.parents('.map-wrap').addClass('yani-fullscreen-map');
        $this.addClass('active');
    }
    
});
})(jQuery)