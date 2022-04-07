<?php

function yani_currency_switcher_callback( $atts, $content){
	$attributes = shortcode_atts(
		array(
			"id" => ""
		),
		$atts
	);

	ob_start();
	include("templates/currency-switcher.tmpl.php");
	return ob_get_clean();

}
add_shortcode( "yani_currency_switcher", "yani_currency_switcher_callback" );

?>
