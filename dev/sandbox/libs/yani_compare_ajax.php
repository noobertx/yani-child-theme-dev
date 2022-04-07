<?php

function yani_compare_ajax_callback( $atts, $content){
	$attributes = shortcode_atts(
		array(
			"id" => ""
		),
		$atts
	);

	ob_start();
	echo "Feature Available Soon";
	return ob_get_clean();

}
add_shortcode( "yani_compare_ajax", "yani_compare_ajax_callback" );

?>
