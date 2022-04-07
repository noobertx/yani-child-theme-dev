<?php

function yani_review_like_callback( $atts, $content){
	$attributes = shortcode_atts(
		array(
			"id" => ""
		),
		$atts
	);

	ob_start();
	require("templates/review-likes.tmpl.php");
	return ob_get_clean();

}
add_shortcode( "yani_review_like", "yani_review_like_callback" );

?>
