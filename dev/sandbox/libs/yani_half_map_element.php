<?php

function yani_half_map_element_callback( $atts, $content){
	$attributes = shortcode_atts(
		array(
			"id" => ""
		),
		$atts
	);

	ob_start();
	echo "Feature is underconstction";
	// include("templates/half-map-wrap.tmpl.php");
	return ob_get_clean();

}
add_shortcode( "yani_half_map_element", "yani_half_map_element_callback" );

?>
