<?php
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! class_exists( '_Yani_Field_Helper' ) ) {
	class _Yani_Field_Helper{
		private static $instance = null;		
		public static function get_instance() {

			// If the single instance hasn't been set, set it now.
			if ( null == self::$instance ) {
				self::$instance = new self;
			}
			return self::$instance;
		}

		public function get_field_meta($field_name, $escape = true) {
	        global $prop_meta_data;

	        $prefix = 'yani_';
	        $field_name = $prefix.$field_name;

	        if (isset($prop_meta_data[$field_name])) {
	            if($escape) {
	                return sanitize_text_field($prop_meta_data[$field_name][0]);
	            } else {
	                return $prop_meta_data[$field_name][0];
	            }
	        } else {
	            return;
	        }
	    }
	    // Property Meta
	    public function is_bedsbaths_range() {
	        $is_enabled = _yani_theme()->get_option( 'range-bedsroomsbaths', 0 );

	        if( $is_enabled ) {
	            return true;
	        }

	        return false;
	    }

	    public function input_attr_for_bbr() {
        
	        $return = 'type="number" min="1" max="99"';
	        if( $this->is_bedsbaths_range() ) {
	            $return = 'type="text"';
	        }

	        echo $return;

	    }

	    public function get_listing_fields_for_icons() {
	        $array = array(
	            'bed' => esc_html__('Bed', _yani_theme()->get_text_domain()),
	            'room' => esc_html__('Room', _yani_theme()->get_text_domain()),
	            'bath' => esc_html__('Bath', _yani_theme()->get_text_domain()),
	            'garage' => esc_html__('Garage', _yani_theme()->get_text_domain()),
	            'area-size' => esc_html__('Area Size', _yani_theme()->get_text_domain()),
	            'land-area' => esc_html__('Land Area Size', _yani_theme()->get_text_domain()),
	            'year-built' => esc_html__('Year Built', _yani_theme()->get_text_domain()),
	            'property-id' => esc_html__('Property ID', _yani_theme()->get_text_domain()),
	        );
	        return $array;
	    }

	    public function get_listing_fields_for_icons_luxury() {
        $array = array(
            'icon_prop_id' => esc_html__('Property ID', _yani_theme()->get_text_domain()),
            'icon_bedrooms' => esc_html__('Bedrooms', _yani_theme()->get_text_domain()),
            'icon_rooms' => esc_html__('Rooms', _yani_theme()->get_text_domain()),
            'icon_bathrooms' => esc_html__('Bathrooms', _yani_theme()->get_text_domain()),
            'icon_prop_size' => esc_html__('Property Size', _yani_theme()->get_text_domain()),
            'icon_prop_land' => esc_html__('Land Size', _yani_theme()->get_text_domain()),
            'icon_garage_size' => esc_html__('Garage Size', _yani_theme()->get_text_domain()),
            'icon_garage' => esc_html__('Garage', _yani_theme()->get_text_domain()),
            'icon_year' => esc_html__('Year Built', _yani_theme()->get_text_domain()),
        );
        return $array;
    }

    public function get_overview_composer_fields() {
        $array = array(
            'type',
            'bedrooms',
            'rooms',
            'bathrooms',
            'garage',
            'area-size',
            'land-area',
            'year-built',
            'property-id',
        );
        return $array;
    }

	}
}

function _yani_field() {
	return _Yani_Field_Helper::get_instance();
}