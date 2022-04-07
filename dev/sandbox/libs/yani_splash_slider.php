<?php

function yani_splash_slider_callback( $atts, $content){
	$attributes = shortcode_atts(
		array(
			"id" => ""
		),
		$atts
	);

	ob_start();
	echo "Demo is too big for this page";
	// include("templates/splash-slider.tmpl.php");
	return ob_get_clean();

}
add_shortcode( "yani_splash_slider", "yani_splash_slider_callback" );

?>
