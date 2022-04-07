<?php if(yani_option('disable_detail_btn', 1)) { ?>
<a class="btn btn-primary btn-item" href="<?php echo esc_url(get_permalink()); ?>">
	<?php echo yani_option('glc_detail_btn', 'Details'); ?>
</a><!-- btn-item -->
<?php } ?>