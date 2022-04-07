<?php

function yani_login_links_callback( $atts, $content){
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
add_shortcode( "yani_login_links", "yani_login_links_callback" );

?>
