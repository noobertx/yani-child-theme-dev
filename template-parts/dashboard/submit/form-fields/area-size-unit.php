<?php global $area_prefix_default, $area_prefix_changeable; ?>
<div class="form-group">
	<label for="prop_size_prefix"><?php echo _yani_theme()->get_option('cl_area_size_postfix', 'Size Postfix'); ?></label>

	<input class="form-control" id="prop_size_prefix" name="prop_size_prefix" value="<?php
    if (_yani_post()->can_be_editted()) {
        echo _yani_field()->get_field_meta('property_size_prefix');
    } else { echo esc_html($area_prefix_default); }
    ?>" placeholder="<?php echo _yani_theme()->get_option('cl_area_size_postfix_plac', 'Enter the size postfix'); ?>" type="text" <?php if( $area_prefix_changeable != 1 ){ echo 'readonly'; }?>>
	<small class="form-text text-muted"><?php echo _yani_theme()->get_option('cl_area_size_postfix_tooltip', 'For example: Sq Ft'); ?></small>
</div>