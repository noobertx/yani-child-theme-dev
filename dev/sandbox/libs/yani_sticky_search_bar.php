<?php

function yani_sticky_search_bar_callback( $atts, $content){
	$attributes = shortcode_atts(
		array(
			"id" => ""
		),
		$atts
	);

	ob_start();
	echo "Should be merged with mobile search form overlay";
	return ob_get_clean();

}
add_shortcode( "yani_sticky_search_bar", "yani_sticky_search_bar_callback" );

?>
