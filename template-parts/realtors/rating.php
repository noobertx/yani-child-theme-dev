<?php 
if(is_author()) {
	global $author_id;
	$rating_id = $author_id;
} else {
	$rating_id = get_the_ID();
}
$total_ratings = get_post_meta($rating_id, 'yani_total_rating', true); 

if( empty( $total_ratings ) ) {
	$total_ratings = 0;
}
?>

<div class="rating-score-wrap flex-grow-1">
	<div class="d-flex">
	    <?php if(is_singular( array('yani_agent', 'yani_agency') ) && $total_ratings != 0) { ?>
	        <span class="rating-score-text"><?php echo esc_attr(round($total_ratings, 2)); ?></span>
	    <?php } else if(is_author() && $total_ratings != 0 ) { ?>
	    	<span class="rating-score-text"><?php echo esc_attr(round($total_ratings, 2)); ?></span>
	    <?php } ?>

	    <div class="stars">
		    <?php echo yani_get_stars($total_ratings, false); ?>
		</div>
	    
	    <?php if(is_singular( array('yani_agent', 'yani_agency') ) || is_author() ) { ?>
	        <a class="all-reviews" href="#review-scroll"><?php echo esc_html__('See all reviews', _yani_theme()->get_text_domain()); ?></a>
	    <?php } ?>
	</div>
</div><!-- rating-score-wrap -->