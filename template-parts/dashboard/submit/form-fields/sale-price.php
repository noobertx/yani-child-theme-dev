<div class="form-group">
	<label for="prop_price">
		<?php echo yani_option('cl_sale_price', 'Sale or Rent Price').yani_required_field('sale_rent_price'); ?>	
	</label>

	<input class="form-control" name="prop_price" <?php yani_required_field_2('sale_rent_price'); ?> id="prop_price" value="<?php
    if (yani_edit_property()) {
        yani_field_meta('property_price');
    }
    ?>" placeholder="<?php echo yani_option('cl_sale_price_plac', 'Enter the price'); ?>" type="text">
</div>