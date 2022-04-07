<?php

function yani_modal_callback( $atts, $content){
	$attributes = shortcode_atts(
		array(
			"id" => ""
		),
		$atts
	);

	ob_start();
	?>
		<a href="javascript:void(0)" class="btn bg-primary" onClick="yani_processing_modal('Processing...')">Processing</a>
		<a href="javascript:void(0)" class="btn bg-secondary" onClick="yani_processing_modal('Loading...')">Loading</a>
		<a href="javascript:void(0)" class="btn bg-accent" onClick="yani_processing_modal('Logging you in...')">Login</a>
		<a href="javascript:void(0)" class="btn bg-light text-primary" onClick="yani_processing_modal('Redirecting...')">Redirect</a>

		<p>&nbsp;</p>
		<div id="radius-range-slider" class="distance-range"></div>
	<?php
	return ob_get_clean();

}
add_shortcode( "yani_modal", "yani_modal_callback" );

?>
