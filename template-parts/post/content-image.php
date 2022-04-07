<article <?php post_class(); ?>>				
	<div class="post__inner">
		<div class="post__content">			
			<?php the_content();?>
		</div>
		<div class="post__meta">
			<?php //_themename_post_meta();?>
		</div>
		<?php get_template_part("template-parts/post/footer");?>
	</div>
</article>