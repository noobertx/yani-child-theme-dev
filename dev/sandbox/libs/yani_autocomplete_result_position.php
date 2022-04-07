<?php

function yani_autocomplete_result_position_callback( $atts, $content){
	$attributes = shortcode_atts(
		array(
			"id" => ""
		),
		$atts
	);

	ob_start();
	require("templates/autocomplete_result_position.tmpl.php");
	return ob_get_clean();

}
add_shortcode( "yani_autocomplete_result_position", "yani_autocomplete_result_position_callback" );

?>