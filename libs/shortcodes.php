<?php
	add_shortcode("_themename_gallery","_themename_gallery_callback");
	function _themename_gallery_callback($atts=[],$content = null,$tag = ""){

		extract(shortcode_atts([
			"id" => ""
		],$atts,$tag));

		$ids = explode(",",$id);

		return "Shortcodes should be included in a plugin not within the theme";
	}

	function _themename_gallery_atts_func(){
		return [
			"id" => ""
		];
	}
	add_filter("shortcode_atts___themename_gallery","_themename_gallery_atts_func");

	add_shortcode("_themename_delivery_zip","_themename_delivery_zip_callback");
	function _themename_delivery_zip_callback($atts=[],$content = null,$tag = ""){
		extract(shortcode_atts([
			"id" => "",
			"title" => "Check Our Delivery Areas",
			"link" => "#",
			"button_text" => "PICK YOUR BOX",
			"label" => ""
		],$atts,$tag));

		ob_start(); ?>
		<div class="_themename-delivery-areas text-center">			
			<h2><?php echo $title;?></h2>
			<div class="delivery-area-status"></div>
			<div action="#" method="POST" id="frm-check-service-area">
				<input class="form-control" data-val="true" data-val-regex="Please specify a valid Zip Code." data-val-regex-pattern="^\d{5}(-\d{4})?$" data-val-required="The Zip Code field is required." id="postal-code" name="postalCode" placeholder="Enter your zip code" type="text" value="">
				<button id="btnGo"> Go </button>
			</div>
		</div>
			
		<?php
		_themename_delivery_banner_cta($link,$button_text);
		$output_string =  ob_get_contents();
		ob_end_clean();
		return $output_string;
	}

	function _themename_delivery_banner_cta($link,$button_text){ ?>
		<div class="_themename-delivery-areas-banner text-center">		
			<h2>Customizable Produce & Grocery Boxes</h2>
			<h3 class="secondary">FOR TUESDAY DELIVERY</h3>
			<a href="#" id="btn-change-location">Change Location &raquo;</a>

			<a href="<?php echo $link;?>" class="btn btn-block bg-primary white"><?php echo $button_text;?></a>
		</div>
	<?php }
?>