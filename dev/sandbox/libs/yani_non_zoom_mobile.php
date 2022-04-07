<?php

function yani_non_zoom_mobile_callback( $atts, $content){
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
add_shortcode( "yani_non_zoom_mobile", "yani_non_zoom_mobile_callback" );

?>