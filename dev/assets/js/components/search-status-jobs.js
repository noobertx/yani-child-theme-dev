/*-----------------------------------------------------------------------------------*/
/* Search Status tabs
/*-----------------------------------------------------------------------------------*/
(function($){
$('.yani-status-tabs li a').on('click', function(e) {
    e.preventDefault();
    var $this = $(this);
    var status = $this.data('val');

    $('#search-tabs').val(status);

    var $form = $('.yani-search-form-js');
    property_status_changed(status, $form);

});

})(jQuery)