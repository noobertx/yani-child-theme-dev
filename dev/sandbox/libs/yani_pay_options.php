<?php

function yani_pay_options_callback( $atts, $content){
	$attributes = shortcode_atts(
		array(
			"id" => ""
		),
		$atts
	);

	ob_start();
	include("templates/pay-options.tmpl.php");
	return ob_get_clean();

}
add_shortcode( "yani_pay_options", "yani_pay_options_callback" );

?>
