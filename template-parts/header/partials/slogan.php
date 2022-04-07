<ul class="contact-details">
	<?php if( !empty(_yani_theme()->get_option('top_bar_slogan'))){ ?>
	<li class="">
		<i class="yani-icon icon-user mr-1"></i> <?php echo _yani_theme()->get_option('top_bar_slogan'); ?>
	</li>
	<?php } ?>
	<?php if( !empty(_yani_theme()->get_option('top_bar_phone'))){ ?>
	<li class="">
		<a href="tel:<?php echo _yani_theme()->get_option('top_bar_phone'); ?>"><i class="yani-icon icon-phone-actions-ring mr-1"></i> <?php echo _yani_theme()->get_option('top_bar_phone'); ?></a>
	</li>
	<?php } ?>
	<?php if( !empty(_yani_theme()->get_option('top_bar_email'))){ ?>
	<li class="">
		<a href="mailto:<?php echo _yani_theme()->get_option('top_bar_email'); ?>"><i class="yani-icon icon-envelope mr-1"></i> <?php echo _yani_theme()->get_option('top_bar_email'); ?></a>
	</li>
	<?php } ?>
</ul>