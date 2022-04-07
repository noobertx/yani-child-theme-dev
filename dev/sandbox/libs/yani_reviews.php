<?php

function yani_reviews_callback( $atts, $content){
	$attributes = shortcode_atts(
		array(
			"id" => ""
		),
		$atts
	);

	ob_start();
	require("templates/review-form.tmpl.php");
	return ob_get_clean();

}
add_shortcode( "yani_reviews", "yani_reviews_callback" );

?>
