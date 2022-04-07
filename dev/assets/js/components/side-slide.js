(function($){
	$(".side-slide-toggle").on("click",function(e){
		e.preventDefault();
		var target = $(this).data("target");
		var targetEl = "#"+target;	
		var width = $(targetEl).data("width");

		if($("body.header-creative").hasClass("show-side-slide")){
			$("body").removeClass("show-side-slide")				
			$(targetEl).css({"width":0})

		}else{
			if($(targetEl).length){
				if(!$("body").hasClass("show-side-slide")){
					$("body").addClass("show-side-slide")				
					$(targetEl).css({"width":width+"px"})
				}

			}
			$(targetEl).find(".close-wrapper").on("click",function(e){
				e.preventDefault();
				$("body").removeClass("show-side-slide")				
				$(targetEl).css({"width":0})
			})
		}
	})

})(jQuery)