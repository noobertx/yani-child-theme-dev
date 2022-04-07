/* ------------------------------------------------------------------------ */
/* login and register links
/* ------------------------------------------------------------------------ */
(function($){
$('.login-link a').on('click', function () {
    $('.modal-toggle-1').addClass("active");
    $('.modal-toggle-2').removeClass("active");
    $('.register-form-tab').removeClass("active").removeClass("show");
    $('.login-form-tab').addClass("active").addClass("show");
});
$('.register-link a').click(function () {
    $('.modal-toggle-2').addClass("active");
    $('.modal-toggle-1').removeClass("active");
    $('.register-form-tab').addClass("active").addClass("show");
    $('.login-form-tab').removeClass("active").removeClass("show");
});
})(jQuery)