<div class="search-result-none text-center">	
	<h3><?php esc_html_e("Nothing Found here, Try to search ?","_themename"); ?></h3>
	<?php get_search_form(); ?>

	<?php the_widget('WP_Widget_Recent_Posts',[
		'title' => __('Take a look at out Lastest Post','_themename'),
		'number' => 3
	]); ?>
</div>