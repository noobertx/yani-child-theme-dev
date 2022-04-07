/* ------------------------------------------------------------------------ */
/* prevent advanced search dropdowns from closing on clicks
/* ------------------------------------------------------------------------ */
(function($){
	$('.advanced-search-dropdown').on('click', function (e) {
    	e.stopPropagation();
	});
})(jQuery)