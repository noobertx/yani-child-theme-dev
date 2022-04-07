<?php 
$state = '';
if (_yani_post()->can_be_editted()) {
	global $property_data;

	$state = _yani_taxonomy()->get_post_term_slug($property_data->ID, 'property_state');
}
?>
<div class="form-group">
	<label for="administrative_area_level_1"><?php echo _yani_theme()->get_option('cl_state', 'County/State')._yani_form()->get_required_field_symbol('state'); ?></label>

	<?php
	if(_yani_theme()->get_option('location_dropdowns') == 'yes') { ?>
		<select name="administrative_area_level_1" data-state="<?php echo esc_attr($state); ?>" data-target="houzezThirdList" <?php _yani_form()->get_required_field_symbol('state'); ?> id="countyState" class="houzezSelectFilter houzezSecondList selectpicker form-control bs-select-hidden" data-size="5" data-none-results-text="<?php echo _yani_theme()->get_option('cl_no_results_matched', 'No results matched');?> {0}" data-live-search="true">
            <?php
	        if (_yani_post()->can_be_editted()) {
	            global $property_data;
	            yani_taxonomy_edit_hirarchical_options_for_search( $property_data->ID, 'property_state');

	        } else {
	        
	        echo '<option value="">'._yani_theme()->get_option('cl_none', 'None').'</option>';               
	        $property_state_terms = get_terms (
	            array(
	                "property_state"
	            ),
	            array(
	                'orderby' => 'name',
	                'order' => 'ASC',
	                'hide_empty' => false,
	                'parent' => 0
	            )
	        );

	        yani_hirarchical_options( 'property_state', $property_state_terms, -1);
	        }
	        ?>
        </select>

	<?php
	} else {
	?>
		<input class="form-control" id="countyState" <?php _yani_form()->get_required_field_symbol('state'); ?> name="administrative_area_level_1" value="<?php
	    if (_yani_post()->can_be_editted()) {
	    	global $property_data;
	        echo _yani_taxonomy()->taxonomy_by_postID( $property_data->ID, 'property_state' );
	    }
	    ?>" placeholder="<?php echo _yani_theme()->get_option('cl_state_plac', 'Enter your property county/state'); ?>" type="text">
    <?php } ?>
</div>