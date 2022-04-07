<?php 
$header = yani_option('header_style'); 
if( !empty(yani_option('hd1_4_phone')) && yani_option('hd1_4_phone_enable', 0) && ( $header == 1 || $header == 4 ) ) { ?>
<li class="btn-phone-number">
	<a href="tel:<?php echo yani_option('hd1_4_phone'); ?>"><i class="yani-icon icon-phone-actions-ring mr-1"></i> <?php echo yani_option('hd1_4_phone'); ?></a>
</li>
<?php } ?>