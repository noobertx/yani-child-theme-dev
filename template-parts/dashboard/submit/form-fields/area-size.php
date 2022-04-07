<div class="form-group">
	<label for="prop_size">
		<?php echo _yani_theme()->get_option('cl_area_size', 'Area Size')._yani_form()->get_required_field_symbol('area_size'); ?>		
	</label>

	<input class="form-control" id="prop_size" <?php _yani_form()->get_required_field_symbol('area_size'); ?> name="prop_size" value="<?php
    if (_yani_post()->can_be_editted()) {
        echo _yani_field()->get_field_meta('property_size');
    }
    ?>" placeholder="<?php echo _yani_theme()->get_option('cl_area_size_plac', 'Enter property area size'); ?>" type="text">
	<small class="form-text text-muted"><?php echo _yani_theme()->get_option('cl_only_digits', 'Only digits'); ?></small>
</div>