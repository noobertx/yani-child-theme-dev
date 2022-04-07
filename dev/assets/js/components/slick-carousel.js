(function($){
	var myCarousel = $(".slick-carousel");
	myCarousel.each(function(e) {        
		var data = $(this).attr("data-slick");
	    $(this).slick(JSON.parse(data));
	  });
})(jQuery)