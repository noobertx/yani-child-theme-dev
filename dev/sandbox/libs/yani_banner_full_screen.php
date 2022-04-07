<?php

function yani_banner_full_screen_callback( $atts, $content){
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
add_shortcode( "yani_banner_full_screen", "yani_banner_full_screen_callback" );

?>
