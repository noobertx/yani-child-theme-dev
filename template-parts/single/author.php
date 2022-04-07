<?php
	$author_id = get_the_author_meta('ID');
	$author_posts = get_the_author_posts();
	$author_display = get_the_author();
	$author_posts_url = get_author_posts_url($author_id);
	$author_description = get_the_author_meta('user_description');
	$author_website = get_the_author_meta('user_url');
?>
<div class="author-card d-flex space-between">		
	<div class="author-avatar">
		<?php echo get_avatar($author_id,265); ?>
	</div>
	<div class="author-avatar__content d-flex flex-column p-4">
		<div class="author__title ">
			<?php if($author_website) { ?>
			<a href="<?php echo esc_url($author_website);?>" target="_blank">				
			<?php } ?>
				<?php echo esc_html($author_display);?>
			<?php if($author_website) { ?>
			</a>
			<?php } ?>
		</div>
		<div class="author__info mt-2">
			<a href="<?php echo esc_url($author_posts_url);?>" target="_blank">				
				<?php
					printf(esc_html(_n('%s post', '%s posts',$author_posts,'_themename')),number_format_i18n($author_posts));
				?>
			</a>
		</div>
		<div class="author__desc mt-2">
				<?php echo $author_description; ?>
		</div>
	</div>
</div>