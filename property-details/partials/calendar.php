<?php
global $post;
$booking_shortcode = get_post_meta($post->ID, 'yani_booking_shortcode', true);

if(!empty($booking_shortcode)) {

	echo do_shortcode($booking_shortcode);
}