<?php

function yani_mobile_menu_callback( $atts, $content){
	$attributes = shortcode_atts(
		array(
			"id" => ""
		),
		$atts
	);

	ob_start();
	echo "Open This page on your mobile device and use mobile nav to visit pages on this website";
	return ob_get_clean();

}
add_shortcode( "yani_mobile_menu", "yani_mobile_menu_callback" );

?>