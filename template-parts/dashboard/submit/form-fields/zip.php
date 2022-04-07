<?php global $yani_local; ?>
<div class="form-group">
	<label for="postal_code"><?php echo _yani_theme()->get_option('cl_zip', 'Postal Code / Zip'); ?></label>

	<input class="form-control" id="zip" name="postal_code" value="<?php
    if (_yani_post()->can_be_editted()) {
        echo _yani_field()->get_field_meta('property_zip');
    }
    ?>" placeholder="<?php echo _yani_theme()->get_option('cl_zip_plac', 'Enter your property zip code'); ?>" type="text">
</div>