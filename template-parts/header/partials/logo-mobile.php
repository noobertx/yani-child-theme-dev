<?php
$mobile_logo = _yani_theme()->get_option( 'mobile_logo', false, 'url' );
$logo_height = _yani_theme()->get_option('retina_mobilelogo_height');
$logo_width = _yani_theme()->get_option('retina_mobilelogo_width');
?>
<div class="logo logo-mobile">
	<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
	    <?php if( !empty( $mobile_logo ) ) { ?>
	       <img src="<?php echo esc_url( $mobile_logo ); ?>" height="<?php echo esc_attr($logo_height); ?>" width="<?php echo esc_attr($logo_width); ?>" alt="Mobile logo">
	    <?php } ?>
	</a>
</div>