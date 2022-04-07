<?php

function yani_tooltip_callback( $atts, $content){
	$attributes = shortcode_atts(
		array(
			"id" => ""
		),
		$atts
	);

	ob_start();
	include("templates/tooltip.tmpl.php");
	return ob_get_clean();

}
add_shortcode( "yani_tooltip", "yani_tooltip_callback" );

?>