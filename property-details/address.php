<?php
$google_map_address = _yani_property_listing()->get_listing_data('property_map_address');
$google_map_address_url = "http://maps.google.com/?q=".$google_map_address;
?>
<div class="property-address-wrap property-section-wrap" id="property-address-wrap">
	<div class="block-wrap">
		<div class="block-title-wrap d-flex justify-content-between align-items-center">
			<h2><?php echo _yani_theme()->get_option('sps_address', 'Address'); ?></h2>

			<?php if( !empty($google_map_address) ) { ?>
			<a class="btn btn-primary btn-slim" href="<?php echo esc_url($google_map_address_url); ?>" target="_blank"><i class="yani-icon icon-maps mr-1"></i> <?php echo _yani_theme()->get_option('spl_ogm', 'Open on Google Maps' ); ?></a>
			<?php } ?>

		</div><!-- block-title-wrap -->
		<div class="block-content-wrap">
			<ul class="<?php echo _yani_theme()->get_option('prop_address_cols', 'list-2-cols'); ?> list-unstyled">
				<?php get_template_part('property-details/partials/address-data'); ?>
			</ul>	
		</div><!-- block-content-wrap -->

		<?php if(_yani_map()->is_map_in_section() && _yani_property_listing()->get_listing_data('property_map')) { ?>
		<div id="houzez-single-listing-map" class="block-map-wrap">
		</div><!-- block-map-wrap -->
		<?php } ?>

	</div><!-- block-wrap -->
</div><!-- property-address-wrap -->