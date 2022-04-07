<?php

function mobile_search_form_overlay_callback( $atts, $content){
	$attributes = shortcode_atts(
		array(
			"id" => ""
		),
		$atts
	);

	ob_start();
	echo "Feature Available Soon";
	return ob_get_clean();

}
add_shortcode( "mobile_search_form_overlay", "mobile_search_form_overlay_callback" );

?>
