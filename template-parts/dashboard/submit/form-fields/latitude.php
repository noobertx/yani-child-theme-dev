<?php global $yani_local; ?>
<div class="form-group">
	<label for="lat"><?php echo _yani_theme()->get_option( 'cl_latitude', 'Latitude' ); ?></label>

	<input class="form-control" id="latitude" name="lat" value="<?php
    if (_yani_post()->can_be_editted()) {
        $lat = _yani_field()->get_field_meta('property_location');
        $lat = explode(",", $lat);
        if(!empty($lat[0])) {
        	echo sanitize_text_field($lat[0]);
        }
    }
    ?>" placeholder="<?php echo _yani_theme()->get_option('cl_latitude_plac', 'Enter address latitude'); ?>" type="text">
</div>