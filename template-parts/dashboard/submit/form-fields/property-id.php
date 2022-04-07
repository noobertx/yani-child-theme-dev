<div class="form-group">
	<label for="property_id">
		<?php echo _yani_theme()->get_option('cl_prop_id', 'Property ID')._yani_form()->get_required_field_symbol( 'prop_id' ); ?>
	</label>

	<input class="form-control" id="property_id" <?php _yani_form()->get_required_field_symbol('prop_id'); ?> name="property_id" value="<?php
    if (_yani_post()->can_be_editted()) {
        echo _yani_field()->get_field_meta('property_id');
    }
    ?>" placeholder="<?php echo _yani_theme()->get_option('cl_prop_id_plac', 'Enter property ID'); ?>" type="text">
	<small class="form-text text-muted"><?php echo _yani_theme()->get_option('cl_prop_id_tooltip', 'For example: HZ-01'); ?></small>
</div>