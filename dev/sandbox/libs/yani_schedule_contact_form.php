<?php

function yani_schedule_contact_form_callback( $atts, $content){
	$attributes = shortcode_atts(
		array(
			"id" => ""
		),
		$atts
	);

	ob_start();
	include("templates/schedule-contact-form.tmpl.php");
	return ob_get_clean();

}
add_shortcode( "yani_schedule_contact_form", "yani_schedule_contact_form_callback" );

?>