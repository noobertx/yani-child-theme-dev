<?php

function yani_direct_message_callback( $atts, $content){
	$attributes = shortcode_atts(
		array(
			"id" => ""
		),
		$atts
	);

	ob_start();
	require("templates/direct-message.tmpl.php");
	return ob_get_clean();

}
add_shortcode( "yani_direct_message", "yani_direct_message_callback" );

?>
