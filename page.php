<?php get_header();?>
<?php $sidebarClass = (is_active_sidebar('primary-sidebar')) ? "container mx-auto" : "" ;?>
<?php $sidebarClass = "";
?>
<div id="page  " class=" <?php echo ($sidebarClass!= "" ) ? 'd-flex justify-space-between'.$sidebarClass : '';?>">
<?php
	// $custom_wprig_opt['opt-page-layout']="left-sidebar";
	$custom_wprig_opt['opt-page-layout']="right-sidebar";
		if(isset($custom_wprig_opt) && $custom_wprig_opt['opt-page-layout']=="left-sidebar"):
			if(is_active_sidebar('primary-sidebar')) : 
				get_sidebar();
			endif;
		endif;
	?>

<main class="<?php echo ($sidebarClass!="") ? "main-container": ""; ?>">

<?php //$hide_title = get_post_meta(get_the_ID(),"__themename_hide_title",false)[0]; ?>
<?php $hide_title = "no"; ?>
	<header class="page__header container mx-auto">
		<div class="page__title">
			<?php 
				if($hide_title!="yes" ){ ?>
					<h1><?php the_title(); ?> </h1>
				<?php  } ?>	
		</div>
	</header>
	<div class="page__content container mx-auto">
		<?php the_content();?>			
	</div>
</main>

<?php $sidebarClass = (is_active_sidebar('primary-sidebar')) ? "container mx-auto" : "" ; $sidebarClass="";?>
<?php
		 if(isset($custom_wprig_opt) && $custom_wprig_opt['opt-page-layout']=="right-sidebar" &&  $sidebarClass!=""):
			if(is_active_sidebar('primary-sidebar')) : 
				get_sidebar();
			endif;
		 endif;
	?>

</div>

<?php get_footer();?>