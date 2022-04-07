<?php

function yani_compare_properties_callback( $atts, $content){
	$attributes = shortcode_atts(
		array(
			"id" => ""
		),
		$atts
	);

	ob_start();
	?> Compare Listings is shown on the sidebar<br><?php
	return ob_get_clean();

}
add_shortcode( "yani_compare_properties", "yani_compare_properties_callback" );

?>
