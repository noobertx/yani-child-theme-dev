<?php get_header();
$sidebarClass = (is_active_sidebar('primary-sidebar')) ? "has-sidebar" : "";
$page_layout_meta = get_post_meta(get_the_ID(),'__themename_page_layout',true);
$sidebar_position = get_post_meta(get_the_ID(),'__themename_sidebar_position',true); 
$sidebarClass = (($page_layout_meta=="sidebar-left" || $page_layout_meta=="sidebar-right") && $sidebar_position=="sidebar-top") ? "has-sidebar" : ""; ?>
<div id="page  " class="<?php echo ($sidebarClass!="") ? $sidebarClass." d-flex justify-space-between " : "";?> <?php echo $page_layout_meta; ?>">
	<?php
		if((isset($custom_wprig_opt) && $custom_wprig_opt['opt-page-layout']=="left-sidebar") || ($page_layout_meta =="sidebar-left" && $sidebar_position=="sidebar-top")):
			if(is_active_sidebar('primary-sidebar')) : 
				get_sidebar();
			endif;
		endif;
	?>

	<main class="<?php echo ($sidebarClass!="") ? "main-container": ""; ?> ">
		<?php if(have_posts()){ ?>
			<?php while(have_posts()){ ?>
				<?php the_post(); ?>
				<?php if (is_single()) { ?>
					<?php get_template_part('template-parts/post/content','single'); ?>
				<?php }else{ ?>
					<?php get_template_part('template-parts/post/content'); ?>
				<?php } ?>
			<?php }?>
		<section class="container mx-auto d-flex justify-content-end">			
			<?php echo  the_posts_pagination(); ?>
			<?php echo previous_post_link(); ?>
			<?php echo next_post_link(); ?>
		</section>
		<section class="container mx-auto ">			
			<?php comments_template(); ?>  
		</section>
		<?php }else{ ?>
				<?php get_template_part('template-parts/post/content','none'); ?>
		<?php } ?>
	</main>
	<?php $sidebarClass = (is_active_sidebar('primary-sidebar') && ($page_layout_meta =="sidebar-right")) ? "container mx-auto" : "" ;?>
	<?php	if(isset($custom_wprig_opt) && $custom_wprig_opt['opt-page-layout']=="right-sidebar" || ($page_layout_meta =="sidebar-right" && $sidebar_position=="sidebar-top")):
				if(is_active_sidebar('primary-sidebar')) : 
					get_sidebar();
				endif;
			endif;
	?>
</div>
<?php get_footer();?>