<div id="header-mobile" class="header-mobile d-flex align-items-center d-lg-none" data-sticky="<?php echo _yani_theme()->get_option('mobile-menu-sticky', 0); ?> ">
	<div class="header-mobile-left">
		<button class="btn toggle-button-left">
			<i class="yani-icon icon-navigation-menu"></i>
		</button><!-- toggle-button-left -->	
	</div><!-- .header-mobile-left -->
	<div class="header-mobile-center flex-grow-1">
		<?php get_template_part('template-parts/header/partials/logo-mobile'); ?>
	</div>

	<div class="header-mobile-right">
		<?php if( _yani_theme()->get_option('header_login') || _yani_theme()->get_option('header_register') || _yani_theme()->get_option('create_lisiting_enable') ) { ?>
		<button class="btn toggle-button-right">
			<i class="yani-icon icon-single-neutral-circle ml-1"></i>
		</button><!-- toggle-button-right -->	
		<?php } ?>
	</div><!-- .header-mobile-right -->
	
</div><!-- header-mobile -->