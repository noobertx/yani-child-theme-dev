<div class="form-group">
	<label for="prop_label">
		<?php echo yani_option('cl_price_postfix', 'After The Price Label').yani_required_field('price_label'); ?>
	</label>

	<input class="form-control" name="prop_label" <?php yani_required_field_2('price_label'); ?> id="prop_label" value="<?php
    if (yani_edit_property()) {
        yani_field_meta('property_price_postfix');
    }
    ?>" placeholder="<?php echo yani_option('cl_price_postfix_plac', 'Enter the label after price'); ?>" type="text">

	<small class="form-text text-muted"><?php echo yani_option('cl_price_postfix_tooltip', 'For example: Monthly'); ?></small>
</div>