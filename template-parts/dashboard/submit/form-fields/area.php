<?php
$area = '';
if (_yani_post()->can_be_editted()) {
	global $property_data;

	$area = _yani_taxonomy()->get_post_term_slug($property_data->ID, 'property_area');
}
?>
<div class="form-group">
	<label for="neighborhood"><?php echo _yani_theme()->get_option( 'cl_area', 'Area' )._yani_form()->get_required_field_symbol('area'); ?></label>

	<?php
	if(_yani_theme()->get_option('location_dropdowns') == 'yes') { ?>
		<select name="neighborhood" data-area="<?php echo esc_attr($area); ?>" data-size="5" id="neighborhood" <?php _yani_form()->get_required_field_symbol('area'); ?> class=" houzezSelectFilter houzezFourthList selectpicker form-control bs-select-hidden" data-live-search="true" data-none-results-text="<?php echo _yani_theme()->get_option('cl_no_results_matched', 'No results matched');?> {0}">
            <?php
	        if (_yani_post()->can_be_editted()) {
	            global $property_data;
	            yani_taxonomy_edit_hirarchical_options_for_search( $property_data->ID, 'property_area');

	        } else {
	         
	        echo '<option value="">'._yani_theme()->get_option('cl_none', 'None').'</option>';                  
	        $property_area_terms = get_terms (
	            array(
	                "property_area"
	            ),
	            array(
	                'orderby' => 'name',
	                'order' => 'ASC',
	                'hide_empty' => false,
	                'parent' => 0
	            )
	        );

	        yani_hirarchical_options( 'property_area', $property_area_terms, -1);
	        }
	        ?>
        </select>

	<?php
	} else {
	?>
		<input class="form-control" id="neighborhood" <?php _yani_form()->get_required_field_symbol('area'); ?> name="neighborhood" value="<?php
	    if (_yani_post()->can_be_editted()) {
	        global $property_data;
		    echo _yani_taxonomy()->taxonomy_by_postID( $property_data->ID, 'property_area' );
	    }
	    ?>" placeholder="<?php echo _yani_theme()->get_option( 'cl_area_plac', 'Enter the area' ); ?>" type="text">
    <?php } ?>
</div>