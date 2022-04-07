<?php

function yani_close_menu_callback( $atts, $content){
	$attributes = shortcode_atts(
		array(
			"id" => ""
		),
		$atts
	);

	ob_start();
	echo "<span style='color:red'>Deprecated </span> : Merged With Mobile Menu";
	return ob_get_clean();

}
add_shortcode( "yani_close_menu", "yani_close_menu_callback" );

?>