<?php

function yani_type_charts_callback( $atts, $content){
	$attributes = shortcode_atts(
		array(
			"id" => ""
		),
		$atts
	);

	ob_start();
	include("templates/types-charts.tmpl.php");
	return ob_get_clean();

}
add_shortcode( "yani_type_charts", "yani_type_charts_callback" );

?>
