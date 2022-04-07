<article <?php post_class(); ?>>				
	<div>
		Posted on 
		<a href="<?php echo get_permalink()?>">
			<time date-time="<?echo get_the_date("c");?>">
				<?php echo get_the_date();?>
			</time>
		</a>
		By 
		<a href="<?echo get_author_posts_url(get_the_author_meta('ID'));?>">
			<?php echo get_the_author();?>
		</a>
	</div>
	<div class="post__inner">
		<div class="post__content">
			<?php the_content();?>
		</div>
		<div class="post__meta">
			<?php //_themename_post_meta();?>
		</div>
	</div>
		<?php get_template_part("template-parts/post/footer");?>
</article>