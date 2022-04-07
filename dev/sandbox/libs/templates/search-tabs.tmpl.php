Search tabs under construction
<div class="houzez-search-form-js">
	<ul class="houzez-status-tabs nav nav-pills justify-content-center" role="tablist" data-toggle="buttons">
	<li class="nav-item">
		<a class="nav-link active" data-val="" data-toggle="pill" href="#" role="tab" aria-selected="true">
			All Features
		</a>
	</li>
	<?php
	$terms_status = get_terms(
        array(
            'skill'
        ),
        array(
            'orderby'       => 'count',
            'order'         => 'DESV',
            'hide_empty'    => true,
            'parent' => 0
        )
    );

    if (!empty($terms_status)) {
        $i = 0;      
        foreach ($terms_status as $status) { 

        	if($i == 8) {
        		break;
        	}
        	echo '<li class="nav-item">
					<a class="nav-link" data-val="'.esc_attr($status->slug).'" data-toggle="pill" href="#" role="tab" aria-selected="true">
						'.esc_attr($status->name).'
					</a>
				</li>';
			$i++;
        }
    }
	?>
	<input type="hidden" name="status[]" id="search-tabs">
</ul>
	<div class="search-banner-wrap">		
		<div class="d-flex flex-sm-max-column">
			<div class="flex-search">
				<div class="form-group">
					<select name="status[]" data-size="5" class="selectpicker status-js <?php _yani_search()->get_ajax_search(); ?> form-control bs-select-hidden" title="<?php echo _yani_theme()->get_option('srh_status', 'Status'); ?>" data-live-search="false" data-selected-text-format="count > 1" data-actions-box="true" <?php _yani_form()->get_multiselect(_yani_theme()->get_option('ms_status', 0)); ?> data-select-all-text="<?php echo _yani_theme()->get_option('cl_select_all', 'Select All'); ?>" data-deselect-all-text="<?php echo _yani_theme()->get_option('cl_deselect_all', 'Deselect All'); ?>" data-none-results-text="<?php echo _yani_theme()->get_option('cl_no_results_matched', 'No results matched');?> {0}" data-count-selected-text="{0} <?php echo _yani_theme()->get_option('srh_statuses', 'Statues'); ?>" data-container="body">
						<?php
						global $post; 
						if( !_yani_form()->is_multiselect(_yani_theme()->get_option('ms_status', 0)) ) {
							echo '<option value="">'._yani_theme()->get_option('srh_status', 'Status').'</option>';
						}

						$args = array(
				            'exclude' => _yani_theme()->get_option('search_exclude_status')
				        );

				        $yani_status = get_post_meta($post->ID, 'yani_status', false);
				        $default_status = isset($yani_status) && is_array($yani_status) ? $yani_status : array();

						$status = isset($_GET['status']) ? $_GET['status'] : $default_status;
				        _yani_search()->get_taxonomies('property_status', $status, $args );

						?>
					</select><!-- selectpicker -->
				</div><!-- form-group -->
			</div>
			<div class="flex-search">
				<button type="submit" class="btn btn-search btn-secondary btn-full-width">Search</button>
			</div>
		</div>
	</div>
</div>