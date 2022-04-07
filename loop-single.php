
<?php
global $custom_wprig_opt;
		if($custom_wprig_opt['opt-page-layout']=="left-sidebar"):
			if(is_active_sidebar('primary-sidebar')) : 
				get_sidebar();
			endif;
		endif;
	?>

<?php if(have_posts()){ ?>
	<?php while(have_posts()){ ?>
		<?php the_post(); ?>
		<?php get_template_part('template-parts/post/content',get_post_format()); ?>
	<?php }?>
	<div class="pagination-wrap">		
		<?php the_posts_pagination(); ?>
	</div>
<?php }else{ ?>
		<?php get_template_part('template-parts/post/content','none'); ?>
<?php } ?>
<?php comments_template();?>

<?php
		if($custom_wprig_opt['opt-page-layout']=="right-sidebar"):
			if(is_active_sidebar('primary-sidebar')) : 
				get_sidebar();
			endif;
		endif;
?>

