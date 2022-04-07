(function($){
	
window.getWindowWidth =function() {
        return Math.max( $(window).width(), window.innerWidth);
    }

    window.getWindowHeight =function() {
        return Math.max( $(window).height(), window.innerHeight);
    }
	
})(jQuery)