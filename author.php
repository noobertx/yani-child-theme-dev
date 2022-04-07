<?php get_header();?>
<?php

	$author = get_user_by( 'slug', get_query_var( 'author_name' ) );
	$author_id = get_the_author_meta('ID');
	$author_posts = count_user_posts($author->ID);
	$author_display = get_the_author_meta('display_name',$author->ID);
	$author_posts_url = get_the_author_meta('user_description',$author->ID);
	$author_description = get_the_author_meta('user_description',$author->ID);
	$author_website = get_the_author_meta('user_url',$author->ID);
?>
<?php $sidebarClass = (is_active_sidebar('primary-sidebar')) ? "has-sidebar" : "" ?>
<div id="page" class="<?php echo $sidebarClass;?>">
<main>
	<section class="page-banner">
		
	<header >
		<?php ?>
		<?php echo get_avatar($author,100); ?>

		<div class="author__info">
		<h1 class="light article-title"><?php echo (esc_html($author_display)) ? esc_html($author_display) :  the_archive_title(); ;?></h1>
			<?php printf(esc_html(_n('%s post', '%s posts',$author_posts,'_themename')),number_format_i18n($author_posts));	?>
			|
			<?php if($author_website) { ?>
				<a href="<?php echo esc_url($author_website);?>" class="" target="_blank">Visit Website</a>			
			<?php } ?>
		</div>

		<p class="author__description">
			<?php echo esc_html($author_description);?>
		</p>
	</header>	
	</section>

	<?php get_template_part('loop','author'); ?>
</main>
</div>

<?php get_footer();?>