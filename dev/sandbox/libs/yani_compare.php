<?php

function yani_compare_callback( $atts, $content){
	$attributes = shortcode_atts(
		array(
			"id" => ""
		),
		$atts
	);

	ob_start();
	?> Compare Listings is shown on the sidebar<br><?php
	require_once("templates/compare.tmpl.php");
	return ob_get_clean();

}
add_shortcode( "yani_compare", "yani_compare_callback" );

?>
