<?php
global $post;

$yani_main_menu_trans = '';
if( _themename_template()->is_postid_needed() ) {
	$yani_main_menu_trans = get_post_meta($post->ID, 'yani_main_menu_trans', true);
}
$splash_logo = _themename_theme()->get_option( 'custom_logo_splash', false, 'url' );
//colormag_site_logo_heading
$custom_logo = get_theme_mod('colormag_site_logo_heading');
// $custom_logo = _themename_theme()->get_option( 'custom_logo', false, 'url' );
$splash_logolink_type = _themename_theme()->get_option('splash-logolink-type');
$splash_logolink = _themename_theme()->get_option('splash-logolink');

if( is_page_template( 'template/template-splash.php' ) ) {
	if($splash_logolink_type == 'custom') {
		$splash_logo_link = $splash_logolink;
	} else {
		$splash_logo_link = home_url( '/' );
	}
} else {
	$splash_logo_link = home_url( '/' );
}

$logo_height = _themename_theme()->get_option('retina_logo_height');
$logo_width = _themename_theme()->get_option('retina_logo_width');

?>
<?php if ( is_page_template( 'template/template-splash.php' ) || ($yani_main_menu_trans == 'yes' && _themename_theme()->get_option('header_style') == '4' ) && !wp_is_mobile() ) { ?>
	<div class="logo logo-splash">
		<a href="<?php echo esc_url( $splash_logo_link ); ?>">
			<?php if( !empty( $splash_logo ) ) { ?>
				<img src="<?php echo esc_url( $splash_logo ); ?>" height="<?php echo esc_attr($logo_height); ?>" width="<?php echo esc_attr($logo_width); ?>" alt="logo">
			<?php } ?>
		</a>
	</div>
<?php } else { ?>
	<div class="logo logo-desktop">
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
			<?php if( !empty( $custom_logo ) ) { ?>
				<img src="<?php echo esc_url( $custom_logo ); ?>" height="<?php echo esc_attr($logo_height); ?>" width="<?php echo esc_attr($logo_width); ?>" alt="logo">
			<?php } ?>
		</a>
	</div>
<?php } ?>