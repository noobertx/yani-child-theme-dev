(function($){


	function strip_tags(input,allowed){
		allowed = (((allowed | '') + '')
		.toLowerCase()
		.match(/<[a-z][a-z0-9]*>/g) || [])
		.join('')

		var tags = /<\/?([a-z][a-z0-9]*)\b[^>]*>/gi,
		commentsAndPHPTags = /<!--[\s\S]*?-->|<\?(?:php)?[\s\S]*?\?>/gi;


		return input.replace(commentsAndPHPTags,'').replace(tags,function($0,$1){
			return allowed.indexOf('<'+$1.toLowerCase()+'>') > -1 ? $0 : '';
		});
	}

	wp.customize('set_copyright_text',function(value){
		value.bind(function(to){
			$(".info-wrap").html(strip_tags(to,'<a>'));
		})
	})

	wp.customize('blogname',function(value){
		value.bind(function(to){
			$("#header-section .logo span.h1").html(to);
		})
	})

	wp.customize('set_footer_links_color',function(value){
		value.bind(function(to){
			$("#site-footer a ").css({"color":to})
		})
	})


	//set_header_links_color

	wp.customize('set_header_links_color',function(value){
		value.bind(function(to){
			$("#navbarSupportedContent a  span").css({"color":to})
		})
	})

})(jQuery)