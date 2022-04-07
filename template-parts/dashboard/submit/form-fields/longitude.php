<?php global $yani_local; ?>
<div class="form-group">
	<label for="lng"><?php echo _yani_theme()->get_option( 'cl_longitude', 'Longitude' ); ?></label>
	<input class="form-control" id="longitude" name="lng" value="<?php
    if (_yani_post()->can_be_editted()) {
        $lng = _yani_field()->get_field_meta('property_location');
        $lng = explode(",", $lng);
        if(!empty($lng[1])) {
        	echo sanitize_text_field($lng[1]);
        }
    }
    ?>" placeholder="<?php echo _yani_theme()->get_option('cl_longitude_plac', 'Enter address longitude'); ?>" type="text">
</div>