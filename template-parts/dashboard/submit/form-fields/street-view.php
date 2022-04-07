<div class="form-group">
	<label for="prop_google_street_view"><?php echo yani_option('cl_street_view', 'Street View'); ?></label>
	<select name="prop_google_street_view" class="selectpicker form-control bs-select-hidden" title="" data-live-search="false">
		<option <?php selected( yani_get_field_meta('property_map_street_view'), 'hide' ); ?> value="hide"><?php echo yani_option('cl_hide', 'Hide'); ?></option>
        <option <?php selected( yani_get_field_meta('property_map_street_view'), 'show' ); ?> value="show"><?php echo yani_option('cl_show', 'Show'); ?></option>
	</select><!-- selectpicker -->
</div>