<div class="form-group">
	<label for="prop_labels">
		<?php echo yani_option('cl_prop_label', 'Property Label').yani_required_field('prop_labels'); ?>		
	</label>

	<select name="prop_labels[]" id="prop_labels" <?php yani_required_field_2('prop_labels'); ?> class="selectpicker labels-select-picker form-control bs-select-hidden" data-selected-text-format="count > 2" title="<?php echo yani_option('cl_select', 'Select'); ?>" data-none-results-text="<?php echo yani_option('cl_no_results_matched', 'No results matched');?> {0}" data-live-search="false" data-actions-box="true" <?php yani_multiselect(yani_option('ams_label', 0)); ?> data-select-all-text="<?php echo yani_option('cl_select_all', 'Select All'); ?>" data-deselect-all-text="<?php echo yani_option('cl_deselect_all', 'Deselect All'); ?>" data-count-selected-text="{0} <?php echo yani_option('cl_prop_labels', 'Labels'); ?>">
		<?php
        if( !yani_is_multiselect(yani_option('ams_label', 0)) ) {
            echo '<option value="">'.yani_option('cl_select', 'Select').'</option>';
        }
        if (yani_edit_property()) {
            global $property_data;
            yani_get_taxonomies_for_edit_listing_multivalue( $property_data->ID, 'property_label');

        } else {
                           
        $property_label_terms = get_terms (
            array(
                "property_label"
            ),
            array(
                'orderby' => 'name',
                'order' => 'ASC',
                'hide_empty' => false,
                'parent' => 0
            )
        );

        yani_get_taxonomies_with_id_value( 'property_label', $property_label_terms, -1);
        }
        ?>
	</select><!-- selectpicker -->
</div><!-- form-group -->