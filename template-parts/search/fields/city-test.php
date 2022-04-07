<div class="form-group">
	<select name="location[]" data-target="yaniFourthList" data-size="5" class="yaniSelectFilter yaniCityFilter yaniThirdList selectpicker <?php _yani_theme()->get_ajax_search(); ?> yani-city-js form-control bs-select-hidden" title="<?php echo _yani_theme()->get_option('srh_cities', 'All Cities'); ?>" data-selected-text-format="count > 1" data-live-search="true" data-actions-box="true" <?php yani_multiselect(_yani_theme()->get_option('ms_city', 0)); ?> data-none-results-text="<?php echo _yani_theme()->get_option('cl_no_results_matched', 'No results matched');?> {0}" data-container="body">
		
		<?php
		global $post;
		if( !yani_is_multiselect(_yani_theme()->get_option('ms_city', 0)) ) {
			echo '<option value="">'._yani_theme()->get_option('srh_cities', 'All Cities').'</option>';
		}

		$yani_locations = get_post_meta($post->ID, 'yani_locations', false);
        $default_locations = isset($yani_locations) && is_array($yani_locations) ? $yani_locations : array();

		$city = isset($_GET['location']) ? $_GET['location'] : $default_locations;
        yani_get_search_taxonomies('property_city', $city );

		?>
	</select><!-- selectpicker -->
</div><!-- form-group -->