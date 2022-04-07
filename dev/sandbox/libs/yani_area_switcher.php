<?php

function yani_area_switcher_callback( $atts, $content){
	$attributes = shortcode_atts(
		array(
			"id" => ""
		),
		$atts
	);

	ob_start();
	include("templates/area-switcher.tmpl.php");
	return ob_get_clean();

}
add_shortcode( "yani_area_switcher", "yani_area_switcher_callback" );

?>
