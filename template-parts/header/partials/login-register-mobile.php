<?php
$create_lisiting_enable = _yani_theme()->get_option('create_lisiting_enable');
$header_create_listing_template = _yani_template()->get_template_link('template/user_dashboard_submit.php');
$create_listing_button_required_login = _yani_theme()->get_option('create_listing_button');
?>
<nav class="navi-login-register slideout-menu slideout-menu-right" id="navi-user">
	
	<?php if( $create_lisiting_enable != 0 ) { ?>
	<a class="btn btn-create-listing" href="<?php echo esc_url( $header_create_listing_template ); ?>"><?php echo _yani_theme()->get_option('dsh_create_listing', 'Create a Listing'); ?></a>
	<?php } ?>


    <?php if( class_exists('yani_login_register') && ( _yani_theme()->get_option('header_login') || _yani_theme()->get_option('header_register') ) ): ?>
	<ul class="logged-in-nav">
		
		<?php if( _yani_theme()->get_option('header_login')) { ?>
		<li class="login-link">
			<a href="#" data-toggle="modal" data-target="#login-register-form"><i class="yani-icon icon-lock-5 mr-1"></i> <?php echo esc_html__('Login', _yani_theme()->get_text_domain()); ?></a>
		</li><!-- .has-chil -->
		<?php } ?>

		<?php if( _yani_theme()->get_option('header_register')) { ?>
		<li class="register-link">
			<a href="#" data-toggle="modal" data-target="#login-register-form"><i class="yani-icon icon-single-neutral-circle mr-1"></i> <?php echo esc_html__('Register', _yani_theme()->get_text_domain()); ?></a>
		</li>
		<?php } ?>
		
	</ul><!-- .main-nav -->
	<?php endif; ?>
</nav><!-- .navi -->


