<?php

function yani_bed_baths_callback( $atts, $content){
	$attributes = shortcode_atts(
		array(
			"id" => ""
		),
		$atts
	);

	ob_start();
	require("templates/bed-and-baths.tmpl.php");
	return ob_get_clean();

}
add_shortcode( "yani_bed_baths", "yani_bed_baths_callback" );

?>
