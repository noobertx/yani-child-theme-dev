<?php

function yani_add_remove_favorites_callback( $atts, $content){
	$attributes = shortcode_atts(
		array(
			"id" => ""
		),
		$atts
	);

	ob_start();
	echo "Click on the heart button on the listings and Item Will be added on the favorites ";
	return ob_get_clean();

}
add_shortcode( "yani_add_remove_favorites", "yani_add_remove_favorites_callback" );

?>
