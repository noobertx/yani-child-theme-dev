<?php
/*
Template Name:Blank
*/

?>

<?php get_header();?>
<?php $sidebarClass = (is_active_sidebar('primary-sidebar')) ? "has-sidebar" : "" ?>
<div id="page" class="<?php echo $sidebarClass;?> full-width-page">

<main >
	<?php while(have_posts()){ the_post(); ?> 
		<article <?php post_class();?>>
			<?php the_content(); ?>
		</article>
	<?php } ?>
</main>

</div>

<?php get_footer();?>