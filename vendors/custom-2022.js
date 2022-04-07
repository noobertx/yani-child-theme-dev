(function($){

	$("#navbarSupportedContent").on("mouseenter",".menu-item-has-children",function(e){
		$(this).find(">.dropdown-menu").addClass("show")
	}).on("mouseleave",".menu-item-has-children",function(e){
		$(this).find(">.dropdown-menu").removeClass("show")
	})

	$("#navbarSupportedContent").on("click",".menu-button ",function(e){
		e.preventDefault();
		var $menu_button = $(this);
		var $menu_link = $menu_button.parent();
		var $menu_item = $menu_link.parent();

			console.log($menu_item)
		if($menu_item.find(".dropdown-menu").hasClass("show")){
			$menu_item.find(".dropdown-menu").removeClass("show");
			$menu_link.attr("aria-expanded",'false');

			// $menu_button.find(".menu-button-show").attr("aria-hidden","false") 
			// $menu_button.find(".menu-button-hide").attr("aria-hidden","true") 
		}else{
			$menu_item.find(".dropdown-menu").addClass("show");
			$menu_link.attr("aria-expanded",'true')	;
			// $menu_button.find(".menu-button-show").attr("aria-hidden","true") 
			// $menu_button.find(".menu-button-hide").attr("aria-hidden","false") 
		}
	})

})(jQuery)