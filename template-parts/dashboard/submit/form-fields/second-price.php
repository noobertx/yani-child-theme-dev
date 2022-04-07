<div class="form-group">
	<label><?php echo yani_option('cl_second_price', 'Second Price (Optional)').yani_required_field('prop_second_price'); ?></label>

	<input class="form-control" name="prop_sec_price" <?php yani_required_field_2('prop_second_price'); ?> id="prop_sec_price" value="<?php
    if (yani_edit_property()) {
        yani_field_meta('property_sec_price');
    }
    ?>" placeholder="<?php echo yani_option('cl_second_price_plac', 'Enter the second price'); ?>" type="text">
</div><!-- form-group -->