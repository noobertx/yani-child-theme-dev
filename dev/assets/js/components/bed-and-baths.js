/* ------------------------------------------------------------------------ */
/* Beds and baths
/* ------------------------------------------------------------------------ */
    
(function($){

    var beds_baths = function(btn_action, btn_count, btn_val) {
        $('.'+btn_action).on('click', function(e) {
            e.preventDefault();
            var current_val = parseInt($('.'+btn_val).val()) || 0;

            if(btn_action == 'btn_count_plus' || btn_action == 'btn_beds_plus') {
                current_val++;

            } else { 
                if(current_val == 0)
                return;
                current_val--;
            }
            
            $('.'+btn_count).text(current_val);
            $('.'+btn_val).val(current_val);
        });

    }
    beds_baths('btn_count_plus', 'baths_count', 'bathrooms');
    beds_baths('btn_count_minus', 'baths_count', 'bathrooms');

    beds_baths('btn_beds_plus', 'beds_count', 'bedrooms');
    beds_baths('btn_beds_minus', 'beds_count', 'bedrooms');

    $('.btn-apply').on('click', function(e) {
        e.preventDefault();
        $('.advanced-search-v3 .btn-group .dropdown-menu').removeClass('show');
    });

    $('.clear-baths').on('click', function(e) {
        e.preventDefault();
        $('.baths_count').text('0');
        $('.bathrooms').val('');
    });

    $('.clear-beds').on('click', function(e) {
        e.preventDefault();
        $('.beds_count').text('0');
        $('.bedrooms').val('');
    });

    $('.clear-checkboxes').on('click', function(e) {
        e.preventDefault();
        $(this).parents('.btn-group').find('input[type="checkbox"]').prop("checked", false).attr('checked', false);
    });
})(jQuery)