<div class="form-group">
	<label for="prop_garage_size"><?php echo _yani_theme()->get_option('cl_garage_size', 'Garages Size'); ?></label>

	<input class="form-control" id="prop_garage_size" name="prop_garage_size" value="<?php
    if (_yani_post()->can_be_editted()) {
        echo _yani_field()->get_field_meta('property_garage_size');
    }
    ?>" placeholder="<?php echo _yani_theme()->get_option('cl_garage_size_plac', 'Enter the garages size'); ?>" type="text">
	<small class="form-text text-muted"><?php echo _yani_theme()->get_option('cl_garage_size_tooltip', 'For example: 200 Sq Ft'); ?></small>
</div>