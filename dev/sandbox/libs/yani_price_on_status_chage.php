<?php

function yani_parallax_callback( $atts, $content){
	$attributes = shortcode_atts(
		array(
			"id" => ""
		),
		$atts
	);

	ob_start();
	require("templates/parallax.tmpl.php");
	return ob_get_clean();

}
add_shortcode( "yani_parallax", "yani_parallax_callback" );

?>