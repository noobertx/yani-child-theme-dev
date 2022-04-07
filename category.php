<?php get_header();?>
<?php $sidebarClass = (is_active_sidebar('primary-sidebar')) ? "has-sidebar" : "" ?>
<div id="page" class="<?php echo $sidebarClass;?>">
<main>	
	<section class="page-banner">		
		<header>
			<?php printf( __( 'Category Archives: %s', 'twentyfourteen' ), single_cat_title( '', false ) ); ?>
		</header>
	</section>

	<?php get_template_part('loop'); ?>
</main>
<?php if(is_active_sidebar('primary-sidebar')) { ?>
<?php get_sidebar();?>
<?php } ?>
</div>

<?php get_footer();?>