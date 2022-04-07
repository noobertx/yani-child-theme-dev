<?php global $yani_local; ?>
<div class="form-group">
	<label for="property_map_address">
		<?php echo _yani_theme()->get_option('cl_address', 'Address')._yani_form()->get_required_field_symbol('property_map_address'); ?>		
	</label>

	<input class="form-control" id="geocomplete" <?php _yani_form()->get_required_field_symbol('property_map_address'); ?> name="property_map_address" value="<?php
    if (_yani_post()->can_be_editted()) {
        echo _yani_field()->get_field_meta('property_map_address');
    }
    ?>" autocomplete="off" placeholder="<?php echo _yani_theme()->get_option('cl_address_plac', 'Enter your property address'); ?>" type="text">
</div>