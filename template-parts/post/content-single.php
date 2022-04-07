<?php 
$sidebarClass = (is_active_sidebar('primary-sidebar')) ? "has-sidebar" : "";
$page_layout_meta = get_post_meta(get_the_ID(),'__themename_page_layout',true);
$sidebar_position = get_post_meta(get_the_ID(),'__themename_sidebar_position',true); 
$sidebarClass = (($page_layout_meta=="sidebar-left" || $page_layout_meta=="sidebar-right") && $sidebar_position=="sidebar-bottom") ? "has-sidebar" : ""; ?>

<section <?php post_class(); ?>>
	
<article >

	<?php

	$style_attr = "";
	if(has_post_thumbnail() ){ 
		$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'largel' )[0];
		$style_attr = "style='background-image:url(\"".$image ."\");'";
	} 

	echo _themename_delete_post();
	?>

		<div class="post__thumbnail post__thumbnail--cover" <?php echo $style_attr;?> >
			<div class="post__thumbnail--cover-content-wrap d-flex align-items-center position-relative">
				<div class="post__thumbnail--cover--text-area text-center  h-50 p-3 mx-auto d-flex align-items-center flex-column">
					<h2 class="display-3 font-weight-normal ">
						<a href="<?php the_permalink();?>" title="<?php the_title_attribute();?>" class="text-white"> <?php the_title(); ?></a>
					</h2>
					<?php if(has_category()){ ?>
						<div class="single-post-categories p-2 text-white d-flex">
							<span>Posted In </span>
							<?php echo get_the_category_list(); ?>
						</div>
					<?php }	?>
					<?php if(has_tag()){ ?>
					<div class="single-post-tags p-2 text-white d-flex">
						<?php echo get_the_tag_list(); ?>						
					</div>
					<?php }	?>
				</div>
			</div>
			<?php //the_post_thumbnail('large');?>
		</div>


	<div class="<?php echo ($sidebarClass!="") ? $sidebarClass." d-flex justify-space-between " : "";?> <?php echo $page_layout_meta; ?>">
		<?php
		if((isset($custom_wprig_opt) && $custom_wprig_opt['opt-page-layout']=="left-sidebar") || ($page_layout_meta =="sidebar-left" && $sidebar_position=="sidebar-bottom")):
			if(is_active_sidebar('primary-sidebar')) : 
				get_sidebar();
			endif;
		endif;
		?>
		<div class="post-content <?php echo ($sidebarClass!="") ? "main-container": "container mx-auto"; ?>">
			<?php the_content();?>
			<?php //get_template_part('template-parts/single/author'); ?>
			
		</div>
		<?php
		if((isset($custom_wprig_opt) && $custom_wprig_opt['opt-page-layout']=="right-sidebar") || ($page_layout_meta =="sidebar-right" && $sidebar_position=="sidebar-bottom")):
			if(is_active_sidebar('primary-sidebar')) : 
				get_sidebar();
			endif;
		endif;
		?>
	</div>
</article>
</section>