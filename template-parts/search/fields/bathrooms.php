<div class="form-group">
	<select name="bathrooms" data-size="5" class="selectpicker <?php _yani_search()->get_ajax_search(); ?> form-control bs-select-hidden" title="<?php echo _yani_theme()->get_option('srh_bathrooms', 'Bathrooms'); ?>" data-live-search="false">
		<option value=""><?php echo _yani_theme()->get_option('srh_bathrooms', 'Bathrooms'); ?></option>
        <?php _yani_property()->render_number_list('bathrooms'); ?>
	</select><!-- selectpicker -->
</div>