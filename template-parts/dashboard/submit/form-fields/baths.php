<div class="form-group">
	<label for="prop_baths">
		<?php echo _yani_theme()->get_option('cl_bathrooms', 'Bathrooms')._yani_form()->get_required_field_symbol('bathrooms'); ?>
	</label>

	<input class="form-control" id="prop_baths" <?php _yani_form()->get_required_field_symbol('bathrooms'); ?> name="prop_baths" value="<?php
    if (_yani_post()->can_be_editted()) {
        echo _yani_field()->get_field_meta('property_bathrooms');
    }
    ?>" placeholder="<?php echo _yani_theme()->get_option('cl_bathrooms_plac', 'Enter number of bathrooms'); ?>" <?php _yani_field()->input_attr_for_bbr(); ?>>

    <?php if( !_yani_field()->is_bedsbaths_range() ) { ?>
	<small class="form-text text-muted"><?php echo _yani_theme()->get_option('cl_only_digits', 'Only digits'); ?></small>
	<?php } ?>
</div>