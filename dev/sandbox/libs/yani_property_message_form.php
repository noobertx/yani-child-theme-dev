<?php

function yani_property_message_form_callback( $atts, $content){
	$attributes = shortcode_atts(
		array(
			"id" => ""
		),
		$atts
	);

	ob_start();
	require("templates/property-thread-message-form.tmpl.php");
	return ob_get_clean();

}
add_shortcode( "yani_property_message_form", "yani_property_message_form_callback" );

?>
