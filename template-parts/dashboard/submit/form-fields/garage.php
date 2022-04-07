<div class="form-group">
	<label for="prop_garage">
		<?php echo _yani_theme()->get_option('cl_garage', 'Garages')._yani_form()->get_required_field_symbol('garages'); ?>
	</label>
	<input class="form-control" id="prop_garage" <?php _yani_form()->get_required_field_symbol('garages'); ?> name="prop_garage" value="<?php
    if (_yani_post()->can_be_editted()) {
        echo _yani_field()->get_field_meta('property_garage');
    }
    ?>" placeholder="<?php echo _yani_theme()->get_option('cl_garage_plac', 'Enter number of garages'); ?>" type="number" min="1" max="99">
	<small class="form-text text-muted"><?php echo _yani_theme()->get_option('cl_only_digits', 'Only digits'); ?></small>
</div>