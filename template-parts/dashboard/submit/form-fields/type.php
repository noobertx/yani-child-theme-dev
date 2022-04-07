<div class="form-group">
	<label for="prop_type">
		<?php echo _yani_theme()->get_option('cl_prop_type', 'Property Type')._yani_form()->get_required_field_symbol('prop_type'); ?>		
	</label>
	<select name="prop_type[]" data-size="5" <?php _yani_form()->get_required_field_symbol('prop_type'); ?> id="prop_type" class="selectpicker form-control bs-select-hidden" title="<?php echo _yani_theme()->get_option('cl_select', 'Select'); ?>" data-selected-text-format="count > 2" data-live-search="true" data-actions-box="true" <?php echo _yani_form()->get_multiselect(_yani_theme()->get_option('ams_type', 0)); ?> data-select-all-text="<?php echo _yani_theme()->get_option('cl_select_all', 'Select All'); ?>" data-deselect-all-text="<?php echo _yani_theme()->get_option('cl_deselect_all', 'Deselect All'); ?>" data-none-results-text="<?php echo _yani_theme()->get_option('cl_no_results_matched', 'No results matched');?> {0}" data-count-selected-text="{0} <?php echo _yani_theme()->get_option('cl_prop_types', 'Types'); ?>">
		
		<?php
        if( !_yani_form()->is_multiselect(_yani_theme()->get_option('ams_type', 0)) ) {
            echo '<option value="">'._yani_theme()->get_option('cl_select', 'Select').'</option>';
        }
        if (_yani_post()->can_be_editted()) {
            global $property_data;
            _yani_form()->get_taxonomies_for_edit_listing_multivalue( $property_data->ID, 'property_type');

        } else {
                            
        $property_types_terms = get_terms (
            array(
                "property_type"
            ),
            array(
                'orderby' => 'name',
                'order' => 'ASC',
                'hide_empty' => false,
                'parent' => 0
            )
        );

        _yani_form()->get_taxonomies_with_id_value( 'property_type', $property_types_terms, -1);
        }
        ?>

	</select><!-- selectpicker -->
</div><!-- form-group -->