<?php

function yani_mobile_search_form_overlay_callback( $atts, $content){
	$attributes = shortcode_atts(
		array(
			"id" => ""
		),
		$atts
	);

	ob_start();?>		
	Displays Search bar on mobile Devices
	<section class="advanced-search advanced-search-nav mobile-search-nav yani_sticky" data-sticky='1'>
		<div class="container">
			<div class="advanced-search-v1">
				<div class="d-flex">
					<div class="flex-search flex-grow-1">
						<div class="form-group">
							<div class="search-icon">
								<input type="text" class="form-control" placeholder="Search" onfocus="blur();">
							</div><!-- search-icon -->
						</div><!-- form-group -->
					</div><!-- flex-search -->
				</div><!-- d-flex -->
			</div><!-- advanced-search-v1 -->
		</div><!-- container -->
	</section><!-- advanced-search -->
	<?php return ob_get_clean();

}
add_shortcode( "yani_mobile_search_form_overlay", "yani_mobile_search_form_overlay_callback" );

?>
