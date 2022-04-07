<ul class="contact-details">
	<?php if( !empty(get_theme_mod('_themename_slogan'))){ ?>
	<li class="">
		<i class="yani-icon icon-user mr-1"></i> <?php echo get_theme_mod('_themename_slogan'); ?>
	</li>
	<?php } ?>
	<?php if( !empty(get_theme_mod('_themename_phone'))){ ?>
	<li class="">
		<a href="tel:<?php echo get_theme_mod('_themename_phone'); ?>"><i class="yani-icon icon-phone-actions-ring mr-1"></i> <?php echo get_theme_mod('_themename_phone'); ?></a>
	</li>
	<?php } ?>
	<?php if( !empty(get_theme_mod('_themename_email'))){ ?>
	<li class="">
		<a href="mailto:<?php echo get_theme_mod('_themename_email'); ?>"><i class="yani-icon icon-envelope mr-1"></i> <?php echo get_theme_mod('_themename_email'); ?></a>
	</li>
	<?php } ?>
</ul>