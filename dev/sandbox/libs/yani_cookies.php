<?php

function yani_cookies_callback( $atts, $content){
	$attributes = shortcode_atts(
		array(
			"id" => ""
		),
		$atts
	);

	ob_start();
	?> Allows Item to be compared using cookies<br><?php
	return ob_get_clean();

}
add_shortcode( "yani_cookies", "yani_cookies_callback" );

?>
