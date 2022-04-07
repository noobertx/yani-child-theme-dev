<?php

function yani_search_price_status_change_callback( $atts, $content){
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
add_shortcode( "yani_search_price_status_change", "yani_search_price_status_change_callback" );

?>
