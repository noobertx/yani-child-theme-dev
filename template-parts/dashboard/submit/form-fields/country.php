<?php
$country = '';
if (_yani_post()->can_be_editted()) {
	global $property_data;

	$country = _yani_taxonomy()->get_post_term_slug($property_data->ID, 'property_country');
}
?>
<div class="form-group">
	<label><?php echo _yani_theme()->get_option('cl_country', 'Country')._yani_form()->get_required_field_symbol('country'); ?></label>
	<?php
	if(_yani_theme()->get_option('location_dropdowns') == 'yes') { ?>
		<select name="country" id="country" data-country="<?php echo esc_attr($country); ?>" data-target="houzezSecondList" <?php _yani_form()->get_required_field_symbol('country'); ?> class="houzezSelectFilter houzezFirstList selectpicker form-control bs-select-hidden" data-size="5" data-none-results-text="<?php echo _yani_theme()->get_option('cl_no_results_matched', 'No results matched');?> {0}" data-live-search="true">
            <?php
	        if (_yani_post()->can_be_editted()) {
	            
	            yani_taxonomy_edit_hirarchical_options_for_search( $property_data->ID, 'property_country');

	        } else {
	        
	        echo '<option value="">'._yani_theme()->get_option('cl_none', 'None').'</option>';
	                      
	        $property_country_terms = get_terms (
	            array(
	                "property_country"
	            ),
	            array(
	                'orderby' => 'name',
	                'order' => 'ASC',
	                'hide_empty' => false,
	                'parent' => 0
	            )
	        );

	        yani_hirarchical_options( 'property_country', $property_country_terms, -1);
	        }
	        ?>
        </select>

	<?php
	} else {
	?>
		<input class="form-control" name="country" <?php _yani_form()->get_required_field_symbol('country'); ?> id="country" value="<?php
	    if (_yani_post()->can_be_editted()) {
	    	global $property_data;
	        echo _yani_taxonomy()->taxonomy_by_postID( $property_data->ID, 'property_country' );
	    }
	    ?>" placeholder="<?php echo _yani_theme()->get_option('cl_country_plac', 'Enter your property country'); ?>" type="text">
	<?php } ?>
</div>