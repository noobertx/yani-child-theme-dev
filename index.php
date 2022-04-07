<?php get_header();?>
<?php $sidebarClass = (is_active_sidebar('primary-sidebar')) ? "has-sidebar" : "" ?>
<div id="page" class="<?php echo $sidebarClass;?>">
<?php
		if($custom_wprig_opt['opt-page-layout']=="left-sidebar"):
			if(is_active_sidebar('primary-sidebar')) : 
				get_sidebar();
			endif;
		endif;
	?>

	
<main>
<?php get_template_part('loop','single'); ?>
</main>
<?php
		if($custom_wprig_opt['opt-page-layout']=="right-sidebar"):
			if(is_active_sidebar('primary-sidebar')) : 
				get_sidebar();
			endif;
		endif;
	?>

</div>

<?php get_footer();?>