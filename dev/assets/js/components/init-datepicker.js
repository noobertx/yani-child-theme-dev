/* ------------------------------------------------------------------------ */
/* datepicker
/* ------------------------------------------------------------------------ */
(function($){
    var yani_date_language = yani_vars.yani_date_language;
    if($('.db_input_date').length > 0) { 
        $('.db_input_date').datepicker({
            format : "yyyy-mm-dd",
            clearBtn: true,
            autoclose: true,
            language: yani_date_language
        });
    }
})(jQuery)