<?php

function yani_masonry_blogs_callback( $atts, $content){
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
add_shortcode( "yani_masonry_blogs", "yani_masonry_blogs_callback" );

?>
