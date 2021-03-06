<div class="header-contact-wrap navbar-expand-lg d-flex align-items-center justify-content-between">
	<?php if( _yani_theme()->get_option('hd2_contact_info') != '0' || _yani_theme()->get_option('hd2_address_info') != '0' || _yani_theme()->get_option('hd2_timing_info') != '0' ) { ?>

	<?php
	   $contact_icon = _yani_theme()->get_option('hd2_contact_icon');
	   $contact_phone = _yani_theme()->get_option('hd2_contact_phone');
	   $contact_email = _yani_theme()->get_option('hd2_contact_email');

	   $address_icon = _yani_theme()->get_option('hd2_address_icon');
	   $address_line1 = _yani_theme()->get_option('hd2_address_line1');
	   $address_line2 = _yani_theme()->get_option('hd2_address_line2');

	   $timing_icon = _yani_theme()->get_option('hd2_timing_icon');
	   $timing_hours = _yani_theme()->get_option('hd2_timing_hours');
	   $timing_days = _yani_theme()->get_option('hd2_timing_days');

	    $allowed_html = array(
	        'i' => array(
	            'class' => array()
	        )
	    );
	?>

		<?php if( _yani_theme()->get_option('hd2_contact_info') != '0' ) { ?>
		<div class="header-contact header-contact-1 d-flex align-items-center flex-fill">
			<div class="header-contact-left">
				<i class="yani-icon icon-phone ml-1"></i>
			</div><!-- header-contact-left -->
			<div class="header-contact-right">
				<div><a href="tel://<?php echo esc_attr( $contact_phone ); ?>"><?php echo esc_attr( $contact_phone ); ?></a></div>
				<div><a href="mailto:<?php echo esc_attr( $contact_email ); ?>"><?php echo esc_attr( $contact_email ); ?></a></div>
			</div><!-- .header-contact-right -->
		</div><!-- .header-contact -->
		<?php } ?>

		<?php if( _yani_theme()->get_option('hd2_address_info') != '0' ) { ?>
		<div class="header-contact header-contact-2 d-flex align-items-center flex-fill">
			<div class="header-contact-left">
				<i class="yani-icon icon-pin ml-1"></i>
			</div><!-- header-contact-left -->
			<div class="header-contact-right">
				<div><?php echo esc_attr( $address_line1 ); ?></div>
				<div><?php echo esc_attr( $address_line2 ); ?></div>
			</div><!-- .header-contact-right -->
		</div><!-- .header-contact -->
		<?php } ?>


		<?php if( _yani_theme()->get_option('hd2_timing_info') != '0' ){ ?>
		<div class="header-contact header-contact-3 d-flex align-items-center flex-fill">
			<div class="header-contact-left">
				<i class="yani-icon icon-time-clock-circle ml-1"></i>
			</div><!-- header-contact-left -->
			<div class="header-contact-right">
				<div><?php echo esc_attr( $timing_hours ); ?></div>
				<div><?php echo esc_attr( $timing_days ); ?></div>
			</div><!-- .header-contact-right -->
		</div><!-- .header-contact -->
		<?php } ?>

	<?php } ?>

	<div class="header-contact header-contact-4 d-flex align-items-center">
		<?php get_template_part('template-parts/header/partials/social-icons'); ?>
	</div><!-- .header-contact -->
</div><!-- .header-contact-wrap -->


