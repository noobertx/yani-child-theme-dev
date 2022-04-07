<div class="form-group">
	<label for="prop_rooms">
		<?php echo _yani_theme()->get_option('cl_rooms', 'Rooms')._yani_form()->get_required_field_symbol('rooms'); ?>
	</label>
	<input class="form-control" name="prop_rooms" <?php _yani_form()->get_required_field_symbol('rooms'); ?> id="prop_rooms" value="<?php
   	if (_yani_post()->can_be_editted()) {
         echo _yani_field()->get_field_meta('property_bedrooms');
    }
    ?>" placeholder="<?php echo _yani_theme()->get_option('cl_rooms_plac', 'Enter number of rooms'); ?>" <?php _yani_field()->input_attr_for_bbr(); ?>>
    <?php if( !_yani_field()->is_bedsbaths_range()  ) { ?>
	<small class="form-text text-muted"><?php echo _yani_theme()->get_option('cl_only_digits', 'Only digits'); ?></small>
	<?php } ?>
</div>