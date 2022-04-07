/* ------------------------------------------------------------------------ */
/*  availability calendar cells height
/* ------------------------------------------------------------------------ */
(function($){	
	var $win = $(window);
	function setCalendarCellHeight() {
	    var calendarCellWidth = $('.block-availability-calendars .search-calendar li').innerWidth();
	    $('.block-availability-calendars .search-calendar li').css('height', calendarCellWidth);
	    $('.block-availability-calendars .search-calendar li').css('line-height', calendarCellWidth + 'px');
	}
	setCalendarCellHeight();
	$win.on('resize', function () {
	    setCalendarCellHeight();
	});
})(jQuery)