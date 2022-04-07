<?php

function yani_drop_down_menus_callback( $atts, $content){
	$attributes = shortcode_atts(
		array(
			"id" => ""
		),
		$atts
	);

	ob_start();
	echo "Hover on the main navigation to display submenu item in a drop down";
	return ob_get_clean();

}
add_shortcode( "yani_drop_down_menus", "yani_drop_down_menus_callback" );

?>