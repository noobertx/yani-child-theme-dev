<?php

function yani_status_charts_callback( $atts, $content){
	$attributes = shortcode_atts(
		array(
			"id" => ""
		),
		$atts
	);

	ob_start();
	include("templates/status-charts.tmpl.php");
	return ob_get_clean();

}
add_shortcode( "yani_status_charts", "yani_status_charts_callback" );

?>
