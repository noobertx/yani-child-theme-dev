<?php

function yani_contact_agent_form_callback( $atts, $content){
	$attributes = shortcode_atts(
		array(
			"id" => ""
		),
		$atts
	);

	ob_start();
	include("templates/contact-form-agent.tmpl.php");
	return ob_get_clean();

}
add_shortcode( "yani_contact_agent_form", "yani_contact_agent_form_callback" );

?>
