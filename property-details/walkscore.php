<?php
$yani_walkscore = _yani_theme()->get_option('yani_walkscore');
$yani_walkscore_api = _yani_theme()->get_option('yani_walkscore_api');

if( $yani_walkscore != 0 && $yani_walkscore_api != '' ) {
?>
<div class="property-walkscore-wrap property-section-wrap" id="property-walkscore-wrap">
	<div class="block-wrap">
		<div class="block-title-wrap d-flex justify-content-between align-items-center">
			<h2><?php echo _yani_theme()->get_option('sps_walkscore', 'WalkScore'); ?></h2>
		</div><!-- block-title-wrap -->
		<div class="block-content-wrap">

			<?php //yani_walkscore($post->ID); ?>

		</div><!-- block-content-wrap -->
	</div><!-- block-wrap -->
</div><!-- property-walkscore-wrap -->
<?php } ?>