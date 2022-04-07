<?php
global $hide_fields;
$prop_id = _yani_property_listing()->get_listing_data('property_id');
$prop_price = _yani_property_listing()->get_listing_data('property_price');
$prop_size = _yani_property_listing()->get_listing_data('property_size');
$land_area = _yani_property_listing()->get_listing_data('property_land');
$bedrooms = _yani_property_listing()->get_listing_data('property_bedrooms');
$rooms = _yani_property_listing()->get_listing_data('property_rooms');
$bathrooms = _yani_property_listing()->get_listing_data('property_bathrooms');
$year_built = _yani_property_listing()->get_listing_data('property_year');
$garage = _yani_property_listing()->get_listing_data('property_garage');
$property_status = _yani_taxonomy()->get_taxonomy_simple('property_status');
$property_type = _yani_taxonomy()->get_taxonomy_simple('property_type');
$garage_size = _yani_property_listing()->get_listing_data('property_garage_size');
$additional_features = get_post_meta( get_the_ID(), 'additional_features', true);
?>
<div class="detail-wrap">
	<ul class="<?php echo _yani_theme()->get_option('prop_details_cols', 'list-2-cols'); ?> list-unstyled">
		<?php
        if( !empty( $prop_id ) && $hide_fields['prop_id'] != 1 ) {
            echo '<li>
	                <strong>'._yani_theme()->get_option('spl_prop_id', 'Property ID').':</strong> 
	                <span>'._yani_property()->propperty_id_prefix($prop_id).'</span>
                </li>';
        }

        if( !empty( $prop_price ) && $hide_fields['sale_rent_price'] != 1 ) {
            echo '<li>
	                <strong>'._yani_theme()->get_option('spl_price', 'Price'). ':</strong> 
	                <span>'._yani_listing()->get_price().'</span>
                </li>';
        }

        if( !empty( $prop_size ) && $hide_fields['area_size'] != 1 ) {
            echo '<li>
	                <strong>'._yani_theme()->get_option('spl_prop_size', 'Property Size'). ':</strong> 
	                <span>'._yani_listing()->get_size( 'after' ).'</span>
                </li>';
        }

        if( !empty( $land_area ) && $hide_fields['land_area'] != 1 ) {
            // echo '<li>
	           //      <strong>'._yani_theme()->get_option('spl_land', 'Land Area'). ':</strong> 
	           //      <span>'.yani_property_land_area( 'after' ).'</span>
            //     </li>';
        }
        if( !empty( $bedrooms ) && $hide_fields['bedrooms'] != 1 ) {
            $bedrooms_label = ($bedrooms > 1 ) ? _yani_theme()->get_option('spl_bedrooms', 'Bedrooms') : _yani_theme()->get_option('spl_bedroom', 'Bedroom');

            echo '<li>
	                <strong>'.esc_attr($bedrooms_label).':</strong> 
	                <span>'.esc_attr( $bedrooms ).'</span>
                </li>';
        }
        if( !empty( $rooms ) && $hide_fields['rooms'] != 1 ) {
            $rooms_label = ($rooms > 1 ) ? _yani_theme()->get_option('spl_rooms', 'Rooms') : _yani_theme()->get_option('spl_room', 'Room');

            echo '<li>
                    <strong>'.esc_attr($rooms_label).':</strong> 
                    <span>'.esc_attr( $rooms ).'</span>
                </li>';
        }
        if( !empty( $bathrooms ) && $hide_fields['bathrooms'] != 1 ) {

            $bath_label = ($bathrooms > 1 ) ? _yani_theme()->get_option('spl_bathrooms', 'Bathrooms') : _yani_theme()->get_option('spl_bathroom', 'Bathroom');
            echo '<li>
	                <strong>'.esc_attr($bath_label).':</strong> 
	                <span>'.esc_attr( $bathrooms ).'</span>
                </li>';
        }
        if( $garage != "" && $hide_fields['garages'] != 1 ) {

            $garage_label = ($garage > 1 ) ? _yani_theme()->get_option('spl_garages', 'Garages') : _yani_theme()->get_option('spl_garage', 'Garage');
            echo '<li>
	                <strong>'.esc_attr($garage_label).':</strong> 
	                <span>'.esc_attr( $garage ).'</span>
                </li>';
        }
        if( !empty( $garage_size ) && $hide_fields['garages'] != 1 ) {
            echo '<li>
	                <strong>'._yani_theme()->get_option('spl_garage_size', 'Garage Size').':</strong> 
	                <span>'.esc_attr( $garage_size ).'</span>
                </li>';
        }
        if( !empty( $year_built ) && $hide_fields['year_built'] != 1 ) {
            echo '<li>
	                <strong>'._yani_theme()->get_option('spl_year_built', 'Year Built').':</strong> 
	                <span>'.esc_attr( $year_built ).'</span>
                </li>';
        }
        if( !empty( $property_type ) && ($hide_fields['prop_type']) != 1 ) {
            echo '<li class="prop_type">
	                <strong>'._yani_theme()->get_option('spl_prop_type', 'Property Type').':</strong> 
	                <span>'.esc_attr( $property_type ).'</span>
                </li>';
        }
        if( !empty( $property_status ) && ($hide_fields['prop_status']) != 1 ) {
            echo '<li class="prop_status">
	                <strong>'._yani_theme()->get_option('spl_prop_status', 'Property Status').':</strong> 
	                <span>'.esc_attr( $property_status ).'</span>
                </li>';
        }

        //Custom Fields
        // if(class_exists('yani_Fields_Builder')) {
        // $fields_array = yani_Fields_Builder::get_form_fields(); 

        //     if(!empty($fields_array)) {
        //         foreach ( $fields_array as $value ) {

        //             $field_type = $value->type;
        //             $meta_type = true;

        //             if( $field_type == 'checkbox_list' || $field_type == 'multiselect' ) {
        //                 $meta_type = false;
        //             }

        //             $data_value = get_post_meta( get_the_ID(), 'yani_'.$value->field_id, $meta_type );
        //             $field_title = $value->label;
        //             $field_id = yani_clean_20($value->field_id);
                    
        //             $field_title = yani_wpml_translate_single_string($field_title);

        //             if( $meta_type == true ) {
        //                 $data_value = yani_wpml_translate_single_string($data_value);
        //             } else {
        //                 $data_value = yani_array_to_comma($data_value);
        //             }

        //             if(!empty($data_value) && $hide_fields[$field_id] != 1) {
        //                 echo '<li class="'.esc_attr($field_id).'"><strong>'.esc_attr($field_title).':</strong> <span>'.esc_attr( $data_value ).'</span></li>';
        //             }
        //         }
        //     }
        // }
        ?>
	</ul>
</div>

<?php if( !empty( $additional_features[0]['yani_additional_feature_title'] ) && $hide_fields['additional_details'] != 1 ) { ?>
	<div class="block-title-wrap">
		<h3><?php echo _yani_theme()->get_option('sps_additional_details', 'Additional details'); ?></h3>
	</div><!-- block-title-wrap -->
	<ul class="list-2-cols list-unstyled">
		<?php
        foreach( $additional_features as $ad_del ):
            echo '<li><strong>'.esc_attr( $ad_del['yani_additional_feature_title'] ).':</strong> <span>'.esc_attr( $ad_del['yani_additional_feature_value'] ).'</span></li>';
        endforeach;
        ?>
	</ul>	
<?php } ?>