<?php

function yani_agent_phone_number_callback( $atts, $content){
	$attributes = shortcode_atts(
		array(
			"id" => ""
		),
		$atts
	);

	ob_start();
	include("templates/agent-phone-number.tmpl.php");
	return ob_get_clean();

}
add_shortcode( "yani_agent_phone_number", "yani_agent_phone_number_callback" );

?>