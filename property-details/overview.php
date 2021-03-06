<?php
$prop_id = _yani_property_listing()->get_listing_data('property_id');
?>
<div class="property-overview-wrap property-section-wrap" id="property-overview-wrap">
	<div class="block-wrap">
		
		<div class="block-title-wrap d-flex justify-content-between align-items-center">
			<h2><?php echo _yani_theme()->get_option('sps_overview', 'Overview'); ?></h2>

			<?php if( !empty( $prop_id ) && _yani_theme()->get_option('show_id_head', 1) ) { ?>
			<div><strong><?php echo _yani_theme()->get_option('spl_prop_id', 'Property ID'); ?>:</strong> <?php echo _yani_property()->propperty_id_prefix($prop_id); ?></div>
			<?php } ?>
		</div><!-- block-title-wrap -->

		<div class="d-flex property-overview-data">
			<?php get_template_part('property-details/partials/overview-data'); ?>
		</div><!-- d-flex -->
	</div><!-- block-wrap -->
</div><!-- property-overview-wrap -->