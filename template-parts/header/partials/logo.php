<?php
global $post;

$yani_main_menu_trans = '';
if( _yani_template()->is_postid_needed() ) {
	$yani_main_menu_trans = get_post_meta($post->ID, 'yani_main_menu_trans', true);
}
$splash_logo = _yani_theme()->get_option( 'custom_logo_splash', false, 'url' );
$custom_logo = _yani_theme()->get_option( 'custom_logo', false, 'url' );
$splash_logolink_type = _yani_theme()->get_option('splash-logolink-type');
$splash_logolink = _yani_theme()->get_option('splash-logolink');

if( is_page_template( 'template/template-splash.php' ) ) {
	if($splash_logolink_type == 'custom') {
		$splash_logo_link = $splash_logolink;
	} else {
		$splash_logo_link = home_url( '/' );
	}
} else {
	$splash_logo_link = home_url( '/' );
}

$logo_height = _yani_theme()->get_option('retina_logo_height');
$logo_width = _yani_theme()->get_option('retina_logo_width');

?>

<?php if ( is_page_template( 'template/template-splash.php' ) || ($yani_main_menu_trans == 'yes' && _yani_theme()->get_option('header_style') == '4' ) && !wp_is_mobile() ) { ?>
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
			<?php }else{ 
					$custom_logo_id = get_theme_mod( 'custom_logo' );
					$logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );
					 
					if ( has_custom_logo() ) {
					    echo '<img src="' . esc_url( $logo[0] ) . '" alt="' . get_bloginfo( 'name' ) . '">';
					} else {
						if(!empty(get_bloginfo('name'))){ ?>
							<span class="h1"><?php echo get_bloginfo('name') ?></span>
						<?php }else{ ?>
					    <span class="h1">YANI</span>
						<?php }  ?>
						<?php
					}
				} ?>
		</a>
	</div>
<?php } ?>