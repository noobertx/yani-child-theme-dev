<div class="form-group">
	<label for="prop_price_prefix"><?php echo yani_option('cl_price_prefix', 'Price Prefix'); ?></label>

	<input class="form-control" id="prop_price_prefix" name="prop_price_prefix" value="<?php
    if (yani_edit_property()) {
        yani_field_meta('property_price_prefix');
    }
    ?>" placeholder="<?php echo yani_option('cl_price_prefix_plac', 'Enter the price prefix'); ?>" type="text">

	<small class="form-text text-muted"><?php echo yani_option('cl_price_prefix_tooltip', 'For example: Start from'); ?></small>
</div><!-- form-group -->