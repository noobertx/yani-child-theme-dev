<?php 
$header_width = _yani_theme()->get_option('header_4_width');
if( _yani_template()->is_splash() ) {
	$header_width = _yani_theme()->get_option('splash_layout');
}
if(_yani_template()->is_half_map()) {
    $header_width = 'container-fluid';
}
$sticky_header = _yani_theme()->get_option('main-menu-sticky', 0);
?>

<?php	$set_header_bg = _themename_sanitize_footer_bg(get_theme_mod("set_header_bg","dark"));?>
<div id="header-section" class="header-desktop header-v4 bg-<?php echo $set_header_bg; ?>" data-sticky="<?php echo intval($sticky_header); ?>">
	<div class="<?php echo esc_attr($header_width); ?>">
		<div class="header-inner-wrap">
			<div class="navbar d-flex align-items-center">

				<?php get_template_part('template-parts/header/partials/logo'); ?>
				<nav class="main-nav on-hover-menu navbar navbar-expand-lg flex-grow-1 navbar-dark text-white">
					<?php get_template_part('template-parts/header/partials/nav'); ?>
				</nav><!-- main-nav -->

				<?php //get_template_part('template-parts/header/user-nav'); ?>

			</div><!-- navbar -->
		</div><!-- header-inner-wrap -->
	</div><!-- .container -->    
</div><!-- .header-v1 -->