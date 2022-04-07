<?php
$content = apply_filters('the_content',get_the_content());
$audio = get_media_embedded_in_content(get_the_content(),array('audio','iframe'));

?>

<article <?php post_class(); ?>>				

	<div class="post__inner">
		
			<?php if(get_the_post_thumbnail() !== "" && empty($video)){ ?>
				<div class="post__thumbnail">
					<?php the_post_thumbnail('large');?>
				</div>
			<?php } ?>
			<?php if(!is_single() !== "" && !empty($audio)){ ?>
				<div class="post__video">
					<?php echo $audio[0];?>
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