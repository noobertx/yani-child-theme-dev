<?php

function yani_featured_property_widget_callback( $atts, $content){
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
add_shortcode( "yani_featured_property_widget", "yani_featured_property_widget_callback" );

?>
