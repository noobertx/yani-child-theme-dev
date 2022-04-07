/* ------------------------------------------------------------------------ */
/*  switch view
/* ------------------------------------------------------------------------ */
(function($){
	console.log("Loaded Switch View");
	$('.switch-btn').on("click", function () {
	    $('.switch-btn').removeClass('active');
	    $(this).addClass('active');
	    if ($(this).hasClass('btn-list')) {
	        $('.listing-view').removeClass('grid-view').addClass('list-view');
	    } else if ($(this).hasClass('btn-grid')) {
	        $('.listing-view').removeClass('list-view').addClass('grid-view');
	    }
	});
})(jQuery)