<?php

function yani_price_range_slider_callback( $atts, $content){
	$attributes = shortcode_atts(
		array(
			"id" => ""
		),
		$atts
	);

	ob_start();

	include("templates/price-range-slider.tmpl.php");
	return ob_get_clean();

}
add_shortcode( "yani_price_range_slider", "yani_price_range_slider_callback" );

?>
