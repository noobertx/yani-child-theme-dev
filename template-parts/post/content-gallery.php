

<article <?php post_class(); ?>>				

	<div class="post__inner">
		
			<?php if(get_the_post_thumbnail() !== "" && (!get_post_gallery() || is_single())){ ?>
				<div class="post__thumbnail">
					<?php the_post_thumbnail('large');?>
				</div>
			<?php } ?>
			<?php if(!is_single() !== "" && get_post_gallery()){ ?>
				<div class="post__gallery">
					<?php
						$gallery = get_post_gallery(get_the_ID(),false);
						$gallery = explode(",",$gallery['ids']);

						foreach($gallery as $id){
							echo wp_get_attachment_image($id,'large');
						}
					?>
				</div>
			<?php } ?>

			<?php get_template_part("template-parts/post/header")?>

			<?php if(is_single()){ ?>
				<div class="post__content">
					<?php the_content();?>
					<?php wp_link_pages();?>
				</div>
			<?php }else { ?>
				<div class="post__excerpt">
					<?php the_excerpt()?>
				</div>
			<?php } ?>
		</div>
	<?php 
		if(!is_single()) {
			get_template_part("template-parts/post/footer");
		} 
		
		if(!is_single()) {
			_theme_readmore_link();
		} 
	?>

</article>