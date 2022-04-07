<?php

$author_id = 3;
$post = get_post(17361);
$review_title = $review_content = $rating = $review_id = '';
$is_update = false;
$submit_review = esc_html__('Submit Review', _yani_theme()->get_text_domain());
if($is_update) {
	$submit_review = esc_html__('Update Review', _yani_theme()->get_text_domain());
}

if(is_author()) {
	$review_post_type = "yani_author";
	$permalink = get_author_posts_url($author_id);
	$listing_id = $author_id;
} else {
	$review_post_type = get_post_type( $post->ID );
	$permalink = get_permalink();
	$listing_id = $post->ID;
}
?>
<div class="block-content-wrap">
	<form method="post">
		<input type="hidden" name="review-security" value="<?php echo wp_create_nonce('review-nonce'); ?>"/>
        <input type="hidden" name="listing_id" value="<?php echo intval($listing_id); ?>"/>
        <input type="hidden" name="review_id" value="<?php echo intval($review_id); ?>"/>
        <input type="hidden" name="listing_title" value="<?php echo the_title(); ?>"/>
        <input type="hidden" name="permalink" value="<?php echo esc_url($permalink); ?>"/>
        <input type="hidden" name="review_post_type" value="<?php echo esc_attr($review_post_type); ?>">
        <input type="hidden" name="action" value="yani_submit_review">
        <input type="hidden" name="is_update" value="<?php echo esc_attr($is_update); ?>">

		<div class="form_messages"></div>
		<div class="row">
			
			<?php if( ! is_user_logged_in() ): ?>
			<div class="col-md-12 col-sm-12">
				<div class="form-group">
					<label><?php esc_html_e('Email', _yani_theme()->get_text_domain()); ?></label>
					<input class="form-control" name="review_email" placeholder="<?php esc_html_e('you@example.com', _yani_theme()->get_text_domain()); ?>" type="text">
				</div>
			</div>
			<?php endif; ?>

			<div class="col-md-6 col-sm-12">
				<div class="form-group">
					<label><?php esc_html_e('Title', _yani_theme()->get_text_domain()); ?></label>
					<input class="form-control" name="review_title" value="<?php echo esc_attr($review_title); ?>" placeholder="<?php esc_html_e('Enter a title', _yani_theme()->get_text_domain()); ?>" type="text">
				</div>
			</div>
			<div class="col-md-6 col-sm-12">
				<div class="form-group">
					<label><?php esc_html_e('Rating', _yani_theme()->get_text_domain()); ?></label>
					<select name="review_stars" class="selectpicker form-control bs-select-hidden" title="<?php esc_html_e('Select', _yani_theme()->get_text_domain()); ?>" data-live-search="false">
						<option value=""><?php esc_html_e('Select', _yani_theme()->get_text_domain()); ?></option>
						<option <?php selected($rating, 1, true); ?> value="1"><?php esc_html_e('1 Star - Poor', _yani_theme()->get_text_domain()); ?></option>
						<option <?php selected($rating, 2, true); ?> value="2"><?php esc_html_e('2 Star -  Fair', _yani_theme()->get_text_domain()); ?></option>
						<option <?php selected($rating, 3, true); ?> value="3"><?php esc_html_e('3 Star - Average', _yani_theme()->get_text_domain()); ?></option>
						<option <?php selected($rating, 4, true); ?> value="4"><?php esc_html_e('4 Star - Good', _yani_theme()->get_text_domain()); ?></option>
						<option <?php selected($rating, 5, true); ?> value="5"><?php esc_html_e('5 Star - Excellent', _yani_theme()->get_text_domain()); ?></option>
					</select><!-- selectpicker -->
				</div>
			</div>
			<div class="col-sm-12 col-xs-12">
				<div class="form-group form-group-textarea">
					<label><?php esc_html_e('Review', _yani_theme()->get_text_domain()); ?></label>
					<textarea class="form-control" name="review" rows="5" placeholder="<?php esc_html_e('Write a review', _yani_theme()->get_text_domain()); ?>"><?php echo esc_attr($review_content); ?></textarea>
				</div>
			</div><!-- col-sm-12 col-xs-12 -->
			<div class="col-sm-12 col-xs-12">
				<button id="submit-review" class="btn btn-secondary btn-sm-full-width">
					<?php get_template_part('template-parts/loader'); ?>
					<?php echo esc_attr($submit_review); ?>
				</button>
			</div><!-- col-sm-12 col-xs-12 -->
		</div><!-- row -->
	</form>
</div><!-- block-content-wrap -->