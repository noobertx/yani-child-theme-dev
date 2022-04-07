<div class="form-group">
	<label for="prop_beds">
		<?php echo _yani_theme()->get_option('cl_bedrooms', 'Bedrooms')._yani_form()->get_required_field_symbol('bedrooms'); ?>
	</label>
	<input class="form-control" name="prop_beds" <?php _yani_form()->get_required_field_symbol('bedrooms'); ?> id="prop_beds" value="<?php
    if (_yani_post()->can_be_editted()) {
        echo _yani_field()->get_field_meta('property_bedrooms');
    }
    ?>" placeholder="<?php echo _yani_theme()->get_option('cl_bedrooms_plac', 'Enter number of bedrooms'); ?>" <?php _yani_field()->input_attr_for_bbr(); ?>>

    <?php if( !_yani_field()->is_bedsbaths_range() ) { ?>
	<small class="form-text text-muted"><?php echo _yani_theme()->get_option('cl_only_digits', 'Only digits'); ?></small>
	<?php } ?>
</div>