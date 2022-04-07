<?php

function yani_property_navigation_callback( $atts, $content){
	$attributes = shortcode_atts(
		array(
			"id" => ""
		),
		$atts
	);

	ob_start();
	require ("templates/property-navigation.tmpl.php");
	return ob_get_clean();

}
add_shortcode( "yani_property_navigation", "yani_property_navigation_callback" );

?>
