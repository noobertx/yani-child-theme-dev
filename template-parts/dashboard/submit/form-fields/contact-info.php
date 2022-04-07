<?php 
global $yani_local, $prop_meta_data; 
$agents_posts = get_posts(array('post_type' => 'yani_agent', 'posts_per_page' => -1, 'suppress_filters' => 0));
$agency_posts = get_posts(array('post_type' => 'yani_agency', 'posts_per_page' => -1, 'suppress_filters' => 0));
$agent_display_option = _yani_field()->get_field_meta('agent_display_option');
$agents_array = isset($prop_meta_data['yani_agents']) ? $prop_meta_data['yani_agents'] : array();
$agencies_array = isset($prop_meta_data['yani_property_agency']) ? $prop_meta_data['yani_property_agency'] : array();

$agent_hidden_class = $agency_hidden_class = 'houzez-hidden';
if($agent_display_option == 'agent_info') {
	$agent_hidden_class = '';

} else if($agent_display_option == 'agency_info') {
	$agency_hidden_class = '';
}

if(empty($agent_display_option)) {
	$agent_display_option = 'author_info';
	if(_yani_user()->role_is("yani_agency")) {
		$agent_display_option = 'agency_info';
	}
}

$agency_info_text = _yani_theme()->get_option('cl_agency_info', 'Agency Info (Choose agency from the list below)');
if(_yani_user()->role_is("yani_agency")) {
	$agency_info_text = _yani_theme()->get_option('cl_agency_info2', 'Agency Info');
}

?>
<div class="form-group">

	<?php if ( ! _yani_user()->role_is("yani_agency") ) { ?>
	<label class="control control--checkbox ">
		<input <?php checked($agent_display_option, 'author_info', true); ?> type="radio" name="yani_agent_display_option" value="author_info"> <?php echo _yani_theme()->get_option('cl_author_info', 'Author Info'); ?>
		<span class="control__indicator"></span>
	</label>
	<?php  } ?>

	<label class="control control--checkbox">
		<input <?php checked($agent_display_option, 'agent_info', true); ?> type="radio" value="agent_info" name="yani_agent_display_option"> <?php echo _yani_theme()->get_option('cl_agent_info', 'Agent Info (Choose agent from the list below)'); ?>
		<span class="control__indicator"></span>
	</label>

	<div class="agents-dropdown <?php echo esc_attr($agent_hidden_class); ?> form-group ml-2 form-group col-sm-12 col-md-5">
		<select name="yani_agents[]" class="selectpicker form-control bs-select-hidden" title="<?php echo _yani_theme()->get_option('cl_agent_info_plac', 'Select an Agent'); ?>" data-live-search="true" data-selected-text-format="count > 2"  data-actions-box="false" multiple>
			<?php

			if ( _yani_user()->role_is("yani_agency") ) {
	            if (!empty($agents_posts)) {
	            	$i = 0;
	            	$output = '';
	            	$agency_id = get_user_meta(get_current_user_id(), 'yani_author_agency_id', true);
	                foreach ($agents_posts as $agent_post) {
	          	
	          			if( $agency_id == get_post_meta($agent_post->ID, 'yani_agent_agencies', true) ) {
		                    $output .= '<option ';

		                    if(_yani_post()->can_be_editted()) {
		                    	if( in_array($agent_post->ID, $agents_array) ) {
		                    		$output .= ' selected';
		                    	}
		                    }

		                    $output .= ' value="'.$agent_post->ID.'">'.$agent_post->post_title.'</option>';
		                }

	                    $i++;
	                }

	                echo $output;
	            }
	        } else {

	        	if (!empty($agents_posts)) {
	            	$i = 0;
	            	$output = '';
	                foreach ($agents_posts as $agent_post) {
	          
	                    $output .= '<option ';

	                    if(_yani_post()->can_be_editted()) {
	                    	if( in_array($agent_post->ID, $agents_array) ) {
	                    		$output .= ' selected';
	                    	}
	                    }

	                    $output .= ' value="'.$agent_post->ID.'">'.$agent_post->post_title.'</option>';

	                    $i++;
	                }

	                echo $output;
	            }

	        }
            ?>
		</select>
	</div>

	<label class="control control--checkbox">
		<input <?php checked($agent_display_option, 'agency_info', true); ?> type="radio" value="agency_info" name="yani_agent_display_option"> <?php echo $agency_info_text; ?>
		<span class="control__indicator"></span>
	</label>

	<?php if ( ! _yani_user()->role_is("yani_agency") ) { ?>
	<div class="agencies-dropdown <?php echo esc_attr($agency_hidden_class); ?> listform-group ml-2 form-group col-sm-12 col-md-5">
		<select name="yani_property_agency[]" class="selectpicker form-control bs-select-hidden" title="<?php echo _yani_theme()->get_option('cl_agency_info_plac', 'Select an Agency'); ?>" data-live-search="true" data-selected-text-format="count > 2"  data-actions-box="false" multiple>
            <?php
            if (!empty($agency_posts)) {
            	$i = 0;
            	$output = '';
                foreach ($agency_posts as $agency) {
          
                    $output .= '<option ';

                    if(_yani_post()->can_be_editted()) {
                    	if( in_array($agency->ID, $agencies_array) ) {
                    		$output .= ' selected';
                    	}
                    }

                    $output .= ' value="'.$agency->ID.'">'.$agency->post_title.'</option>';

                    $i++;
                }

                echo $output;
            }
            ?>
		</select>
	</div>
	<?php } ?>

	<label class="control control--checkbox">
		<input <?php checked($agent_display_option, 'none', true); ?> type="radio" value="none" name="yani_agent_display_option"> <?php echo _yani_theme()->get_option('cl_not_display', 'Do not display'); ?>
		<span class="control__indicator"></span>
	</label>

</div>