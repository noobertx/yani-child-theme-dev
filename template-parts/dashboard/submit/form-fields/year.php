<div class="form-group">
	<label for="prop_year_built">
		<?php echo _yani_theme()->get_option('cl_year_built', 'Year Built')._yani_form()->get_required_field_symbol( 'year_built' ); ?>
	</label>

	<input class="form-control" <?php _yani_form()->get_required_field_symbol('year_built'); ?> name="prop_year_built" value="<?php
    if (_yani_post()->can_be_editted()) {
        echo _yani_field()->get_field_meta('property_year');
    }
    ?>" placeholder="<?php echo _yani_theme()->get_option('cl_year_built_plac', 'Enter year built'); ?>" type="text">
	<small class="form-text text-muted"><?php echo _yani_theme()->get_option('cl_only_digits', 'Only digits'); ?></small>
</div><!-- form-group -->