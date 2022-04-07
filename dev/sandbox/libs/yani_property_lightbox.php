<?php

function yani_property_lightbox_callback( $atts, $content){
	$attributes = shortcode_atts(
		array(
			"id" => ""
		),
		$atts
	);

	ob_start();
	echo "Done";
	return ob_get_clean();

}
add_shortcode( "yani_property_lightbox", "yani_property_lightbox_callback" );

?>
