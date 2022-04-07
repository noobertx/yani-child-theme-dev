<?php

function yani_property_slider_callback( $atts, $content){
	$attributes = shortcode_atts(
		array(
			"id" => ""
		),
		$atts
	);
	$listings = [
		['id'=>2725,'title'=>"Property 1"],
		['id'=>4396,'title'=>"Property 2"],
		['id'=>2687,'title'=>"Property 3"],
		['id'=>2677,'title'=>"Property 4"],
		['id'=>2669,'title'=>"Property 5"],
		['id'=>4392,'title'=>"Property 6"]
	];
	ob_start();

	?>
	<div class="widget-featured-property-slider">
		<?php foreach($listings as $listing_item){ ?>
			<div class="featured-property-item-widget">
				<div class="item-wrap item-wrap-v3">
					<div class="listing-image-wrap">
						<div class="listing-thumb">
							<a href="#" class="listing-featured-thumb hover-effect">
								<?php echo get_the_post_thumbnail($listing_item['id']);?>
							</a>
						</div>
					</div>
					<div class="labels-wrap labels-right">
						<?php echo '<a href="#" class="label-status label status-color-2">Status</a>';	?>
					</div>
					<?php
					echo '<span class="label-featured label">'._yani_theme()->get_option('cl_featured_label', esc_html__( 'Featured', 'houzez' )).'</span>';
					?>
					<ul class="item-price-wrap hide-on-list"><li> $200 </li></ul>
					<address class="item-address">#11 Brooksport Some City At A Country	</address>
				</div>
			</div>
		<?php } ?>		
	</div>
	<?php
	return ob_get_clean();

}
add_shortcode( "yani_property_slider", "yani_property_slider_callback" );

?>
