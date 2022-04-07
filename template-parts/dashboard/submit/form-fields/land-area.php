<div class="form-group">
	<label for="prop_land_area">
		<?php echo _yani_theme()->get_option('cl_land_size', 'Land Area')._yani_form()->get_required_field_symbol( 'land_area' ); ?>
	</label>

	<input class="form-control" id="prop_land_area" <?php _yani_form()->get_required_field_symbol('land_area'); ?> name="prop_land_area" value="<?php
    if (_yani_post()->can_be_editted()) {
        echo _yani_field()->get_field_meta('property_bedrooms');
    }
    ?>" placeholder="<?php echo _yani_theme()->get_option('cl_land_size_plac', 'Enter property land area size'); ?>" type="text">
	<small class="form-text text-muted"><?php echo _yani_theme()->get_option('cl_only_digits', 'Only digits'); ?></small>
</div>