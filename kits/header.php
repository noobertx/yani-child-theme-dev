<!DOCTYPE <?php language_attributes();?>>
<html>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="profile" href="https://gmpg.org/xfn/11" />
    <meta name="format-detection" content="telephone=no">
	<?php wp_head();?>
</head>
<body <?php body_class();?>>
	<?php wp_body_open(); ?>
	
	<?php get_template_part('template-parts/header/nav-mobile'); ?>

	<?php 
	if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'header' ) ) {
		get_template_part('template-parts/header/main'); 
	}?>