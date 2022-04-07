<?php

function yani_properties_sorting_callback( $atts, $content){
	$attributes = shortcode_atts(
		array(
			"id" => ""
		),
		$atts
	);

	ob_start();
	include("templates/property-sorting.tmpl.php");
	return ob_get_clean();

}
add_shortcode( "yani_properties_sorting", "yani_properties_sorting_callback" );

?>
