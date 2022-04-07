<?php

function yani_testimonial_slider_callback( $atts, $content){
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

            <div class="testimonials-module testimonials-module-slider-v1 testimonials-module-v1">
                <div class="testimonials-slider-wrap-v1 houzez-all-slider-wrap">
                	<?php foreach($listings as $listing_item){ ?>
                	<div class="testimonial-item testimonial-item-v1">
                		<div class="testimonial-thumb dfg">
                			<?php get_the_post_thumbnail($listing_item['id']);?>
                		</div>
                		<div class="testimonial-logo"></div>
                		<div class="testimonial-body">
                			Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nihil iste suscipit ab, amet? Amet minus quibusdam, assumenda deleniti cumque delectus error impedit culpa, similique consequuntur placeat molestias quo sequi. Possimus?
                		</div>
                		<div class="testimonial-info">
                			<strong><?php echo esc_attr($listing_item['title']); ?></strong>
                			<em>
                				Position
                			</em>
                		</div>
                	</div>
                	<?php } ?>
                </div><!-- testimonials-slider -->
            </div><!-- testimonials-module -->

	<?php
	return ob_get_clean();

}
add_shortcode( "yani_testimonial_slider", "yani_testimonial_slider_callback" );

?>
