<?php

function yani_listing_preview_callback( $atts, $content){
	$attributes = shortcode_atts(
		array(
			"id" => ""
		),
		$atts
	);

	ob_start();
	include("templates/listing-preview.tmpl.php");
	return ob_get_clean();

}
add_shortcode( "yani_listing_preview", "yani_listing_preview_callback" );

?>
