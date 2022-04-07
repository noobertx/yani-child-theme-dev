<?php

function yani_partner_slider_callback( $atts, $content){
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
	<div class="partners-module partners-module-slider">

            <div class="property-carousel-buttons-wrap">
                <button type="button" class="partner-prev-js slick-prev btn-primary-outlined"><?php esc_html_e('Prev', _yani_theme()->get_text_domain()); ?></button>
                <button type="button" class="partner-next-js slick-next btn-primary-outlined"><?php esc_html_e('Next', _yani_theme()->get_text_domain()); ?></button>
            </div><!-- property-carousel-buttons-wrap -->

            <div class="partners-slider-wrap houzez-all-slider-wrap">
            	<?php foreach($listings as $listing_item){ ?>
            		<div class="partner-item">
                        <a target="_blank" href="#">
                        	<?php echo get_the_post_thumbnail($listing_item['id']);?>
                        </a>
                    </div>
            	<?php } ?>

            </div><!-- testimonials-slider -->
        </div><!-- testimonials-module -->

	<?php
	return ob_get_clean();

}
add_shortcode( "yani_partner_slider", "yani_partner_slider_callback" );

?>
