<?php

function yani_search_tabs_callback( $atts, $content){
	$attributes = shortcode_atts(
		array(
			"id" => ""
		),
		$atts
	);

	ob_start();
	include("templates/search-tabs.tmpl.php");
	return ob_get_clean();

}
add_shortcode( "yani_search_tabs", "yani_search_tabs_callback" );

?>
