<?php

function yani_autocomplete_result_callback( $atts, $content){
	$attributes = shortcode_atts(
		array(
			"id" => ""
		),
		$atts
	);

	ob_start();
	require("templates/price-on-status-change.tmpl.php");
	return ob_get_clean();

}
add_shortcode( "yani_autocomplete_result", "yani_autocomplete_result_callback" );

?>