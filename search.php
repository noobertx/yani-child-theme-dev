<?php get_header();?>
<?php $sidebarClass = (is_active_sidebar('primary-sidebar')) ? "has-sidebar" : "" ?>
<div id="page" class="<?php echo $sidebarClass;?>">
<main>
	
	<header class="search-header container mx-auto">
		<h1 class="text-center">
			<?php printf(esc_html__("Search Results for %s","_themename"),get_search_query()); ?>
		</h1>
		<div class="text-center">			
			<?php get_search_form();?>
		</div>
	</header>
	<?php get_template_part('loop'); ?>
</main>
<?php if(is_active_sidebar('primary-sidebar')) { ?>
<?php get_sidebar();?>
<?php } ?>
</div>

<?php get_footer();?>