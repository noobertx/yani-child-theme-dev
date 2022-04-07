<?php
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! class_exists( '_Yani_Map_Helper' ) ) {
	class _Yani_Map_Helper{
		private static $instance = null;		

		public function get_map_system() {
	        $yani_map_system = _yani_theme()->get_option('yani_map_system');

	        if($yani_map_system == 'osm' || $yani_map_system == 'mapbox') {
	            $map_system = 'osm';
	        } elseif($yani_map_system == 'google' && _yani_theme()->get_option('googlemap_api_key') != "") {
	            $map_system = 'google';
	        } else {
	            $map_system = 'osm';
	        }
	        return $map_system;
		}    

	    public  function get_all_countries( $selected = '' ) {
	        $taxonomy  = 'property_country';
	        $args = array(
	            'hide_empty'  => false
	        );
	        $tax_terms      =   get_terms($taxonomy,$args);
	        $select_country    =   '';

	        foreach ($tax_terms as $tax_term) {
	            $select_country.= '<option value="' . $tax_term->slug.'" ';
	            if($tax_term->slug == $selected){
	                $select_country.= ' selected="selected" ';
	            }
	            $select_country.= ' >' . $tax_term->name . '</option>';
	        }
	        return $select_country;
	    }

	    public function get_current_area() {
	        if ( isset( $_COOKIE[ "yani_current_area" ] ) ) {
	            $current_area = $_COOKIE[ "yani_current_area" ];
	        }

	        if ( empty( $current_area ) ) {
	            $current_area = _yani_theme()->get_option('yani_base_area');
	        }

	        return $current_area;
	    }

	    public function metabox_map_type() {
	        $yani_map_system = _yani_theme()->get_option('yani_map_system');

	        if($map_system == 'osm' || $map_system == 'mapbox') {
	            $map_system = 'osm';
	        } elseif($map_system == 'google') {
	            $map_system = 'map';
	        } else {
	            $map_system = 'osm';
	        }
	        return $map_system;
	    }

	    public function get_map_api_key() {

	        $yani_map_system = $this->get_map_system();   
	        $mapbox_api_key = _yani_theme()->get_option('mapbox_api_key');   
	        $googlemap_api_key = _yani_theme()->get_option('googlemap_api_key'); 

	        if($yani_map_system == 'google') {
	            $googlemap_api_key = urlencode( $googlemap_api_key );
	            return $googlemap_api_key;

	        } elseif($yani_map_system == 'osm') {
	            $mapbox_api_key = urlencode( $mapbox_api_key );
	            return $mapbox_api_key;
	        }
	    }

	    public function is_map_in_section() {
	        if(_yani_theme()->get_option('map_in_section') == 1) {
	            return true;

	        } elseif(isset($_GET['map_in_section']) && $_GET['map_in_section'] == 'yes') {
	            return true;

	        } elseif( _yani_theme()->get_option('prop-top-area') == 'v6' ) {

	            return true;
	        }
	        return false;
	    }

	    public function yani_enqueue_maps_api() {
	        if($this->get_map_system() == 'google') {

	            $this->enqueue_google_api(); 
	            $this->enqueue_geo_location_js();

	        } else {
	            $this->enqueue_osm_api();
	            $this->enqueue_osm_location_js();
	        }
	    }

	    public function enqueue_google_api() {

	        if( !wp_script_is('yani-google-map-api') ) {
	            $googlemap_api_key = _yani_theme()->get_option('googlemap_api_key');
	            wp_enqueue_script('yani-google-map-api', 'https://maps.google.com/maps/api/js?libraries=places&language=' . get_locale() . '&key=' . esc_html($googlemap_api_key), array(), false, false);
	            wp_script_add_data( 'yani-google-map-api', 'defer', true );
	             
	        }
	    }

	    public function yani_enqueue_geo_location_js() {

	        if( !wp_script_is('google-map-properties') ) {
	            $map_options = array();
	            wp_register_script( 'google-map-properties', get_theme_file_uri('/js/google-map-properties' . _yani_theme()->minify_js() . '.js'), array( 'jquery', 'yani-google-map-api' ), YANI_THEME_VERSION, true );
	            wp_localize_script( 'google-map-properties', 'yani_map_properties', $map_options );
	            wp_enqueue_script( 'google-map-properties' );
	            wp_script_add_data( 'google-map-properties', 'async', true );
	        }
	    }

	    public function yani_enqueue_osm_location_js() {

	        if( !wp_script_is('yani-osm-properties') ) {
	            $map_options = array();
	            wp_register_script( 'yani-osm-properties', get_theme_file_uri('/js/osm-properties' . _yani_theme()->minify_js() . '.js'), array( 'jquery', 'leaflet' ), YANI_THEME_VERSION, true );
	            wp_localize_script( 'yani-osm-properties', 'yani_map_properties', $map_options );
	            wp_enqueue_script( 'yani-osm-properties' );
	            
	        }
	    }
	    public function enqueue_osm_api() {
	        if( !wp_script_is('leaflet') ) {
	            // Enqueue leaflet CSS
	            wp_enqueue_style( 'leaflet', 'https://unpkg.com/leaflet@1.7.1/dist/leaflet.css', array(), '1.7.1' );

	            // Enqueue leaflet JS
	            wp_enqueue_script( 'leaflet', 'https://unpkg.com/leaflet@1.7.1/dist/leaflet.js', array(), '1.7.1', true );
	            
	        }
	    }

	    public function countries_dropdown($country_searched = '' ) {
	        global $wpdb;
	        $sql_2 = $wpdb->prepare( "SELECT * from $wpdb->postmeta WHERE meta_key = '%s' GROUP BY meta_value ORDER BY meta_value ASC", 'yani_property_country');

	        $countries = $wpdb->get_results( $sql_2, OBJECT_K );

	        foreach( $countries as $con ) {
	            if( !empty($con->meta_value) ) {
	                if ($country_searched == $con->meta_value) {
	                    echo '<option value="' . $con->meta_value . '" selected="selected">' . $this->country_code_to_country($con->meta_value) . '</option>';
	                } else {
	                    echo '<option value="' . $con->meta_value . '">' . $this->country_code_to_country($con->meta_value) . '</option>';
	                }
	            }
	        }
	    }

	    function country_code_to_country( $code ){
	        $country = '';
	        if( $code == 'AF' ) $country = esc_html__('Afghanistan', _yani_theme()->get_text_domain());
	        if( $code == 'AX' ) $country = esc_html__('Aland Islands', _yani_theme()->get_text_domain());
	        if( $code == 'AL' ) $country = esc_html__('Albania', _yani_theme()->get_text_domain());
	        if( $code == 'DZ' ) $country = esc_html__('Algeria', _yani_theme()->get_text_domain());
	        if( $code == 'AS' ) $country = esc_html__('American Samoa', _yani_theme()->get_text_domain());
	        if( $code == 'AD' ) $country = esc_html__('Andorra', _yani_theme()->get_text_domain());
	        if( $code == 'AO' ) $country = esc_html__('Angola', _yani_theme()->get_text_domain());
	        if( $code == 'AI' ) $country = esc_html__('Anguilla', _yani_theme()->get_text_domain());
	        if( $code == 'AQ' ) $country = esc_html__('Antarctica', _yani_theme()->get_text_domain());
	        if( $code == 'AG' ) $country = esc_html__('Antigua and Barbuda', _yani_theme()->get_text_domain());
	        if( $code == 'AR' ) $country = esc_html__('Argentina', _yani_theme()->get_text_domain());
	        if( $code == 'AM' ) $country = esc_html__('Armenia', _yani_theme()->get_text_domain());
	        if( $code == 'AW' ) $country = esc_html__('Aruba', _yani_theme()->get_text_domain());
	        if( $code == 'AU' ) $country = esc_html__('Australia', _yani_theme()->get_text_domain());
	        if( $code == 'AT' ) $country = esc_html__('Austria', _yani_theme()->get_text_domain());
	        if( $code == 'AZ' ) $country = esc_html__('Azerbaijan', _yani_theme()->get_text_domain());
	        if( $code == 'BS' ) $country = esc_html__('Bahamas the', _yani_theme()->get_text_domain());
	        if( $code == 'BH' ) $country = esc_html__('Bahrain', _yani_theme()->get_text_domain());
	        if( $code == 'BD' ) $country = esc_html__('Bangladesh', _yani_theme()->get_text_domain());
	        if( $code == 'BB' ) $country = esc_html__('Barbados', _yani_theme()->get_text_domain());
	        if( $code == 'BY' ) $country = esc_html__('Belarus', _yani_theme()->get_text_domain());
	        if( $code == 'BE' ) $country = esc_html__('Belgium', _yani_theme()->get_text_domain());
	        if( $code == 'BZ' ) $country = esc_html__('Belize', _yani_theme()->get_text_domain());
	        if( $code == 'BJ' ) $country = esc_html__('Benin', _yani_theme()->get_text_domain());
	        if( $code == 'BM' ) $country = esc_html__('Bermuda', _yani_theme()->get_text_domain());
	        if( $code == 'BT' ) $country = esc_html__('Bhutan', _yani_theme()->get_text_domain());
	        if( $code == 'BO' ) $country = esc_html__('Bolivia', _yani_theme()->get_text_domain());
	        if( $code == 'BA' ) $country = esc_html__('Bosnia and Herzegovina', _yani_theme()->get_text_domain());
	        if( $code == 'BW' ) $country = esc_html__('Botswana', _yani_theme()->get_text_domain());
	        if( $code == 'BV' ) $country = esc_html__('Bouvet Island (Bouvetoya)', _yani_theme()->get_text_domain());
	        if( $code == 'BR' ) $country = esc_html__('Brazil', _yani_theme()->get_text_domain());
	        if( $code == 'IO' ) $country = esc_html__('British Indian Ocean Territory (Chagos Archipelago)', _yani_theme()->get_text_domain());
	        if( $code == 'VG' ) $country = esc_html__('British Virgin Islands', _yani_theme()->get_text_domain());
	        if( $code == 'BN' ) $country = esc_html__('Brunei Darussalam', _yani_theme()->get_text_domain());
	        if( $code == 'BG' ) $country = esc_html__('Bulgaria', _yani_theme()->get_text_domain());
	        if( $code == 'BF' ) $country = esc_html__('Burkina Faso', _yani_theme()->get_text_domain());
	        if( $code == 'BI' ) $country = esc_html__('Burundi', _yani_theme()->get_text_domain());
	        if( $code == 'KH' ) $country = esc_html__('Cambodia', _yani_theme()->get_text_domain());
	        if( $code == 'CM' ) $country = esc_html__('Cameroon', _yani_theme()->get_text_domain());
	        if( $code == 'CA' ) $country = esc_html__('Canada', _yani_theme()->get_text_domain());
	        if( $code == 'CV' ) $country = esc_html__('Cape Verde', _yani_theme()->get_text_domain());
	        if( $code == 'KY' ) $country = esc_html__('Cayman Islands', _yani_theme()->get_text_domain());
	        if( $code == 'CF' ) $country = esc_html__('Central African Republic', _yani_theme()->get_text_domain());
	        if( $code == 'TD' ) $country = esc_html__('Chad', _yani_theme()->get_text_domain());
	        if( $code == 'CL' ) $country = esc_html__('Chile', _yani_theme()->get_text_domain());
	        if( $code == 'CN' ) $country = esc_html__('China', _yani_theme()->get_text_domain());
	        if( $code == 'CX' ) $country = esc_html__('Christmas Island', _yani_theme()->get_text_domain());
	        if( $code == 'CC' ) $country = esc_html__('Cocos (Keeling) Islands', _yani_theme()->get_text_domain());
	        if( $code == 'CO' ) $country = esc_html__('Colombia', _yani_theme()->get_text_domain());
	        if( $code == 'KM' ) $country = esc_html__('Comoros the', _yani_theme()->get_text_domain());
	        if( $code == 'CD' ) $country = esc_html__('Congo', _yani_theme()->get_text_domain());
	        if( $code == 'CG' ) $country = esc_html__('Congo the', _yani_theme()->get_text_domain());
	        if( $code == 'CK' ) $country = esc_html__('Cook Islands', _yani_theme()->get_text_domain());
	        if( $code == 'CR' ) $country = esc_html__('Costa Rica', _yani_theme()->get_text_domain());
	        if( $code == 'CI' ) $country = esc_html__("Cote d'Ivoire", _yani_theme()->get_text_domain());
	        if( $code == 'HR' ) $country = esc_html__('Croatia', _yani_theme()->get_text_domain());
	        if( $code == 'CU' ) $country = esc_html__('Cuba', _yani_theme()->get_text_domain());
	        if( $code == 'CW' ) $country = esc_html__('Curaçao', _yani_theme()->get_text_domain());
	        if( $code == 'CY' ) $country = esc_html__('Cyprus', _yani_theme()->get_text_domain());
	        if( $code == 'CZ' ) $country = esc_html__('Czech Republic', _yani_theme()->get_text_domain());
	        if( $code == 'DK' ) $country = esc_html__('Denmark', _yani_theme()->get_text_domain());
	        if( $code == 'DJ' ) $country = esc_html__('Djibouti', _yani_theme()->get_text_domain());
	        if( $code == 'DM' ) $country = esc_html__('Dominica', _yani_theme()->get_text_domain());
	        if( $code == 'DO' ) $country = esc_html__('Dominican Republic', _yani_theme()->get_text_domain());
	        if( $code == 'EC' ) $country = esc_html__('Ecuador', _yani_theme()->get_text_domain());
	        if( $code == 'EG' ) $country = esc_html__('Egypt', _yani_theme()->get_text_domain());
	        if( $code == 'SV' ) $country = esc_html__('El Salvador', _yani_theme()->get_text_domain());
	        if( $code == 'GQ' ) $country = esc_html__('Equatorial Guinea', _yani_theme()->get_text_domain());
	        if( $code == 'ER' ) $country = esc_html__('Eritrea', _yani_theme()->get_text_domain());
	        if( $code == 'EE' ) $country = esc_html__('Estonia', _yani_theme()->get_text_domain());
	        if( $code == 'ET' ) $country = esc_html__('Ethiopia', _yani_theme()->get_text_domain());
	        if( $code == 'FO' ) $country = esc_html__('Faroe Islands', _yani_theme()->get_text_domain());
	        if( $code == 'FK' ) $country = esc_html__('Falkland Islands (Malvinas)', _yani_theme()->get_text_domain());
	        if( $code == 'FJ' ) $country = esc_html__('Fiji the Fiji Islands', _yani_theme()->get_text_domain());
	        if( $code == 'FI' ) $country = esc_html__('Finland', _yani_theme()->get_text_domain());
	        if( $code == 'FR' ) $country = esc_html__('France', _yani_theme()->get_text_domain());
	        if( $code == 'GF' ) $country = esc_html__('French Guiana', _yani_theme()->get_text_domain());
	        if( $code == 'PF' ) $country = esc_html__('French Polynesia', _yani_theme()->get_text_domain());
	        if( $code == 'TF' ) $country = esc_html__('French Southern Territories', _yani_theme()->get_text_domain());
	        if( $code == 'GA' ) $country = esc_html__('Gabon', _yani_theme()->get_text_domain());
	        if( $code == 'GM' ) $country = esc_html__('Gambia the', _yani_theme()->get_text_domain());
	        if( $code == 'GE' ) $country = esc_html__('Georgia', _yani_theme()->get_text_domain());
	        if( $code == 'DE' ) $country = esc_html__('Germany', _yani_theme()->get_text_domain());
	        if( $code == 'GH' ) $country = esc_html__('Ghana', _yani_theme()->get_text_domain());
	        if( $code == 'GI' ) $country = esc_html__('Gibraltar', _yani_theme()->get_text_domain());
	        if( $code == 'GR' ) $country = esc_html__('Greece', _yani_theme()->get_text_domain());
	        if( $code == 'GL' ) $country = esc_html__('Greenland', _yani_theme()->get_text_domain());
	        if( $code == 'GD' ) $country = esc_html__('Grenada', _yani_theme()->get_text_domain());
	        if( $code == 'GP' ) $country = esc_html__('Guadeloupe', _yani_theme()->get_text_domain());
	        if( $code == 'GU' ) $country = esc_html__('Guam', _yani_theme()->get_text_domain());
	        if( $code == 'GT' ) $country = esc_html__('Guatemala', _yani_theme()->get_text_domain());
	        if( $code == 'GG' ) $country = esc_html__('Guernsey', _yani_theme()->get_text_domain());
	        if( $code == 'GN' ) $country = esc_html__('Guinea', _yani_theme()->get_text_domain());
	        if( $code == 'GW' ) $country = esc_html__('Guinea-Bissau', _yani_theme()->get_text_domain());
	        if( $code == 'GY' ) $country = esc_html__('Guyana', _yani_theme()->get_text_domain());
	        if( $code == 'HT' ) $country = esc_html__('Haiti', _yani_theme()->get_text_domain());
	        if( $code == 'HM' ) $country = esc_html__('Heard Island and McDonald Islands', _yani_theme()->get_text_domain());
	        if( $code == 'VA' ) $country = esc_html__('Holy See (Vatican City State)', _yani_theme()->get_text_domain());
	        if( $code == 'HN' ) $country = esc_html__('Honduras', _yani_theme()->get_text_domain());
	        if( $code == 'HK' ) $country = esc_html__('Hong Kong', _yani_theme()->get_text_domain());
	        if( $code == 'HU' ) $country = esc_html__('Hungary', _yani_theme()->get_text_domain());
	        if( $code == 'IS' ) $country = esc_html__('Iceland', _yani_theme()->get_text_domain());
	        if( $code == 'IN' ) $country = esc_html__('India', _yani_theme()->get_text_domain());
	        if( $code == 'ID' ) $country = esc_html__('Indonesia', _yani_theme()->get_text_domain());
	        if( $code == 'IR' ) $country = esc_html__('Iran', _yani_theme()->get_text_domain());
	        if( $code == 'IQ' ) $country = esc_html__('Iraq', _yani_theme()->get_text_domain());
	        if( $code == 'IE' ) $country = esc_html__('Ireland', _yani_theme()->get_text_domain());
	        if( $code == 'IM' ) $country = esc_html__('Isle of Man', _yani_theme()->get_text_domain());
	        if( $code == 'IL' ) $country = esc_html__('Israel', _yani_theme()->get_text_domain());
	        if( $code == 'IT' ) $country = esc_html__('Italy', _yani_theme()->get_text_domain());
	        if( $code == 'JM' ) $country = esc_html__('Jamaica', _yani_theme()->get_text_domain());
	        if( $code == 'JP' ) $country = esc_html__('Japan', _yani_theme()->get_text_domain());
	        if( $code == 'JE' ) $country = esc_html__('Jersey', _yani_theme()->get_text_domain());
	        if( $code == 'JO' ) $country = esc_html__('Jordan', _yani_theme()->get_text_domain());
	        if( $code == 'KZ' ) $country = esc_html__('Kazakhstan', _yani_theme()->get_text_domain());
	        if( $code == 'KE' ) $country = esc_html__('Kenya', _yani_theme()->get_text_domain());
	        if( $code == 'KI' ) $country = esc_html__('Kiribati', _yani_theme()->get_text_domain());
	        if( $code == 'KP' ) $country = esc_html__('Korea', _yani_theme()->get_text_domain());
	        if( $code == 'KR' ) $country = esc_html__('Korea', _yani_theme()->get_text_domain());
	        if( $code == 'KW' ) $country = esc_html__('Kuwait', _yani_theme()->get_text_domain());
	        if( $code == 'KG' ) $country = esc_html__('Kyrgyz Republic', _yani_theme()->get_text_domain());
	        if( $code == 'LA' ) $country = esc_html__('Lao', _yani_theme()->get_text_domain());
	        if( $code == 'LV' ) $country = esc_html__('Latvia', _yani_theme()->get_text_domain());
	        if( $code == 'LB' ) $country = esc_html__('Lebanon', _yani_theme()->get_text_domain());
	        if( $code == 'LS' ) $country = esc_html__('Lesotho', _yani_theme()->get_text_domain());
	        if( $code == 'LR' ) $country = esc_html__('Liberia', _yani_theme()->get_text_domain());
	        if( $code == 'LY' ) $country = esc_html__('Libyan Arab Jamahiriya', _yani_theme()->get_text_domain());
	        if( $code == 'LI' ) $country = esc_html__('Liechtenstein', _yani_theme()->get_text_domain());
	        if( $code == 'LT' ) $country = esc_html__('Lithuania', _yani_theme()->get_text_domain());
	        if( $code == 'LU' ) $country = esc_html__('Luxembourg', _yani_theme()->get_text_domain());
	        if( $code == 'MO' ) $country = esc_html__('Macao', _yani_theme()->get_text_domain());
	        if( $code == 'MK' ) $country = esc_html__('Macedonia', _yani_theme()->get_text_domain());
	        if( $code == 'MG' ) $country = esc_html__('Madagascar', _yani_theme()->get_text_domain());
	        if( $code == 'MW' ) $country = esc_html__('Malawi', _yani_theme()->get_text_domain());
	        if( $code == 'MY' ) $country = esc_html__('Malaysia', _yani_theme()->get_text_domain());
	        if( $code == 'MV' ) $country = esc_html__('Maldives', _yani_theme()->get_text_domain());
	        if( $code == 'ML' ) $country = esc_html__('Mali', _yani_theme()->get_text_domain());
	        if( $code == 'MT' ) $country = esc_html__('Malta', _yani_theme()->get_text_domain());
	        if( $code == 'MH' ) $country = esc_html__('Marshall Islands', _yani_theme()->get_text_domain());
	        if( $code == 'MQ' ) $country = esc_html__('Martinique', _yani_theme()->get_text_domain());
	        if( $code == 'MR' ) $country = esc_html__('Mauritania', _yani_theme()->get_text_domain());
	        if( $code == 'MU' ) $country = esc_html__('Mauritius', _yani_theme()->get_text_domain());
	        if( $code == 'YT' ) $country = esc_html__('Mayotte', _yani_theme()->get_text_domain());
	        if( $code == 'MX' ) $country = esc_html__('Mexico', _yani_theme()->get_text_domain());
	        if( $code == 'FM' ) $country = esc_html__('Micronesia', _yani_theme()->get_text_domain());
	        if( $code == 'MD' ) $country = esc_html__('Moldova', _yani_theme()->get_text_domain());
	        if( $code == 'MC' ) $country = esc_html__('Monaco', _yani_theme()->get_text_domain());
	        if( $code == 'MN' ) $country = esc_html__('Mongolia', _yani_theme()->get_text_domain());
	        if( $code == 'ME' ) $country = esc_html__('Montenegro', _yani_theme()->get_text_domain());
	        if( $code == 'MS' ) $country = esc_html__('Montserrat', _yani_theme()->get_text_domain());
	        if( $code == 'MA' ) $country = esc_html__('Morocco', _yani_theme()->get_text_domain());
	        if( $code == 'MZ' ) $country = esc_html__('Mozambique', _yani_theme()->get_text_domain());
	        if( $code == 'MM' ) $country = esc_html__('Myanmar', _yani_theme()->get_text_domain());
	        if( $code == 'NA' ) $country = esc_html__('Namibia', _yani_theme()->get_text_domain());
	        if( $code == 'NR' ) $country = esc_html__('Nauru', _yani_theme()->get_text_domain());
	        if( $code == 'NP' ) $country = esc_html__('Nepal', _yani_theme()->get_text_domain());
	        if( $code == 'AN' ) $country = esc_html__('Netherlands Antilles', _yani_theme()->get_text_domain());
	        if( $code == 'NL' ) $country = esc_html__('Netherlands the', _yani_theme()->get_text_domain());
	        if( $code == 'NC' ) $country = esc_html__('New Caledonia', _yani_theme()->get_text_domain());
	        if( $code == 'NZ' ) $country = esc_html__('New Zealand', _yani_theme()->get_text_domain());
	        if( $code == 'NI' ) $country = esc_html__('Nicaragua', _yani_theme()->get_text_domain());
	        if( $code == 'NE' ) $country = esc_html__('Niger', _yani_theme()->get_text_domain());
	        if( $code == 'NG' ) $country = esc_html__('Nigeria', _yani_theme()->get_text_domain());
	        if( $code == 'NU' ) $country = esc_html__('Niue', _yani_theme()->get_text_domain());
	        if( $code == 'NF' ) $country = esc_html__('Norfolk Island', _yani_theme()->get_text_domain());
	        if( $code == 'MP' ) $country = esc_html__('Northern Mariana Islands', _yani_theme()->get_text_domain());
	        if( $code == 'NO' ) $country = esc_html__('Norway', _yani_theme()->get_text_domain());
	        if( $code == 'OM' ) $country = esc_html__('Oman', _yani_theme()->get_text_domain());
	        if( $code == 'PK' ) $country = esc_html__('Pakistan', _yani_theme()->get_text_domain());
	        if( $code == 'PW' ) $country = esc_html__('Palau', _yani_theme()->get_text_domain());
	        if( $code == 'PS' ) $country = esc_html__('Palestinian Territory', _yani_theme()->get_text_domain());
	        if( $code == 'PA' ) $country = esc_html__('Panama', _yani_theme()->get_text_domain());
	        if( $code == 'PG' ) $country = esc_html__('Papua New Guinea', _yani_theme()->get_text_domain());
	        if( $code == 'PY' ) $country = esc_html__('Paraguay', _yani_theme()->get_text_domain());
	        if( $code == 'PE' ) $country = esc_html__('Peru', _yani_theme()->get_text_domain());
	        if( $code == 'PH' ) $country = esc_html__('Philippines', _yani_theme()->get_text_domain());
	        if( $code == 'PN' ) $country = esc_html__('Pitcairn Islands', _yani_theme()->get_text_domain());
	        if( $code == 'PL' ) $country = esc_html__('Poland', _yani_theme()->get_text_domain());
	        if( $code == 'PT' ) $country = esc_html__('Portugal, Portuguese Republic', _yani_theme()->get_text_domain());
	        if( $code == 'PR' ) $country = esc_html__('Puerto Rico', _yani_theme()->get_text_domain());
	        if( $code == 'QA' ) $country = esc_html__('Qatar', _yani_theme()->get_text_domain());
	        if( $code == 'RE' ) $country = esc_html__('Reunion', _yani_theme()->get_text_domain());
	        if( $code == 'RO' ) $country = esc_html__('Romania', _yani_theme()->get_text_domain());
	        if( $code == 'RU' ) $country = esc_html__('Russian Federation', _yani_theme()->get_text_domain());
	        if( $code == 'RW' ) $country = esc_html__('Rwanda', _yani_theme()->get_text_domain());
	        if( $code == 'BL' ) $country = esc_html__('Saint Barthelemy', _yani_theme()->get_text_domain());
	        if( $code == 'SH' ) $country = esc_html__('Saint Helena', _yani_theme()->get_text_domain());
	        if( $code == 'KN' ) $country = esc_html__('Saint Kitts and Nevis', _yani_theme()->get_text_domain());
	        if( $code == 'LC' ) $country = esc_html__('Saint Lucia', _yani_theme()->get_text_domain());
	        if( $code == 'MF' ) $country = esc_html__('Saint Martin', _yani_theme()->get_text_domain());
	        if( $code == 'PM' ) $country = esc_html__('Saint Pierre and Miquelon', _yani_theme()->get_text_domain());
	        if( $code == 'VC' ) $country = esc_html__('Saint Vincent and the Grenadines', _yani_theme()->get_text_domain());
	        if( $code == 'WS' ) $country = esc_html__('Samoa', _yani_theme()->get_text_domain());
	        if( $code == 'SM' ) $country = esc_html__('San Marino', _yani_theme()->get_text_domain());
	        if( $code == 'ST' ) $country = esc_html__('Sao Tome and Principe', _yani_theme()->get_text_domain());
	        if( $code == 'SA' ) $country = esc_html__('Saudi Arabia', _yani_theme()->get_text_domain());
	        if( $code == 'SN' ) $country = esc_html__('Senegal', _yani_theme()->get_text_domain());
	        if( $code == 'RS' ) $country = esc_html__('Serbia', _yani_theme()->get_text_domain());
	        if( $code == 'SC' ) $country = esc_html__('Seychelles', _yani_theme()->get_text_domain());
	        if( $code == 'SL' ) $country = esc_html__('Sierra Leone', _yani_theme()->get_text_domain());
	        if( $code == 'SG' ) $country = esc_html__('Singapore', _yani_theme()->get_text_domain());
	        if( $code == 'SK' ) $country = esc_html__('Slovakia (Slovak Republic)', _yani_theme()->get_text_domain());
	        if( $code == 'SI' ) $country = esc_html__('Slovenia', _yani_theme()->get_text_domain());
	        if( $code == 'SB' ) $country = esc_html__('Solomon Islands', _yani_theme()->get_text_domain());
	        if( $code == 'SO' ) $country = esc_html__('Somalia, Somali Republic', _yani_theme()->get_text_domain());
	        if( $code == 'ZA' ) $country = esc_html__('South Africa', _yani_theme()->get_text_domain());
	        if( $code == 'GS' ) $country = esc_html__('South Georgia and the South Sandwich Islands', _yani_theme()->get_text_domain());
	        if( $code == 'ES' ) $country = esc_html__('Spain', _yani_theme()->get_text_domain());
	        if( $code == 'LK' ) $country = esc_html__('Sri Lanka', _yani_theme()->get_text_domain());
	        if( $code == 'SD' ) $country = esc_html__('Sudan', _yani_theme()->get_text_domain());
	        if( $code == 'SR' ) $country = esc_html__('Suriname', _yani_theme()->get_text_domain());
	        if( $code == 'SJ' ) $country = esc_html__('Svalbard & Jan Mayen Islands', _yani_theme()->get_text_domain());
	        if( $code == 'SZ' ) $country = esc_html__('Swaziland', _yani_theme()->get_text_domain());
	        if( $code == 'SE' ) $country = esc_html__('Sweden', _yani_theme()->get_text_domain());
	        if( $code == 'CH' ) $country = esc_html__('Switzerland', _yani_theme()->get_text_domain());
	        if( $code == 'SY' ) $country = esc_html__('Syrian Arab Republic', _yani_theme()->get_text_domain());
	        if( $code == 'TW' ) $country = esc_html__('Taiwan', _yani_theme()->get_text_domain());
	        if( $code == 'TJ' ) $country = esc_html__('Tajikistan', _yani_theme()->get_text_domain());
	        if( $code == 'TZ' ) $country = esc_html__('Tanzania', _yani_theme()->get_text_domain());
	        if( $code == 'TH' ) $country = esc_html__('Thailand', _yani_theme()->get_text_domain());
	        if( $code == 'TL' ) $country = esc_html__('Timor-Leste', _yani_theme()->get_text_domain());
	        if( $code == 'TG' ) $country = esc_html__('Togo', _yani_theme()->get_text_domain());
	        if( $code == 'TK' ) $country = esc_html__('Tokelau', _yani_theme()->get_text_domain());
	        if( $code == 'TO' ) $country = esc_html__('Tonga', _yani_theme()->get_text_domain());
	        if( $code == 'TT' ) $country = esc_html__('Trinidad and Tobago', _yani_theme()->get_text_domain());
	        if( $code == 'TN' ) $country = esc_html__('Tunisia', _yani_theme()->get_text_domain());
	        if( $code == 'TR' ) $country = esc_html__('Turkey', _yani_theme()->get_text_domain());
	        if( $code == 'TM' ) $country = esc_html__('Turkmenistan', _yani_theme()->get_text_domain());
	        if( $code == 'TC' ) $country = esc_html__('Turks and Caicos Islands', _yani_theme()->get_text_domain());
	        if( $code == 'TV' ) $country = esc_html__('Tuvalu', _yani_theme()->get_text_domain());
	        if( $code == 'UG' ) $country = esc_html__('Uganda', _yani_theme()->get_text_domain());
	        if( $code == 'UA' ) $country = esc_html__('Ukraine', _yani_theme()->get_text_domain());
	        if( $code == 'UAE' ) $country = esc_html__('United Arab Emirates', _yani_theme()->get_text_domain());
	        if( $code == 'GB' ) $country = esc_html__('United Kingdom', _yani_theme()->get_text_domain());
	        if( $code == 'US' ) $country = esc_html__('United States', _yani_theme()->get_text_domain());
	        if( $code == 'UM' ) $country = esc_html__('United States Minor Outlying Islands', _yani_theme()->get_text_domain());
	        if( $code == 'VI' ) $country = esc_html__('United States Virgin Islands', _yani_theme()->get_text_domain());
	        if( $code == 'UY' ) $country = esc_html__('Uruguay, Eastern Republic of', _yani_theme()->get_text_domain());
	        if( $code == 'UZ' ) $country = esc_html__('Uzbekistan', _yani_theme()->get_text_domain());
	        if( $code == 'VU' ) $country = esc_html__('Vanuatu', _yani_theme()->get_text_domain());
	        if( $code == 'VE' ) $country = esc_html__('Venezuela', _yani_theme()->get_text_domain());
	        if( $code == 'VN' ) $country = esc_html__('Vietnam', _yani_theme()->get_text_domain());
	        if( $code == 'WF' ) $country = esc_html__('Wallis and Futuna', _yani_theme()->get_text_domain());
	        if( $code == 'EH' ) $country = esc_html__('Western Sahara', _yani_theme()->get_text_domain());
	        if( $code == 'YE' ) $country = esc_html__('Yemen', _yani_theme()->get_text_domain());
	        if( $code == 'ZM' ) $country = esc_html__('Zambia', _yani_theme()->get_text_domain());
	        if( $code == 'ZW' ) $country = esc_html__('Zimbabwe', _yani_theme()->get_text_domain());
	        if( $country == '') $country = $code;
	        return $country;
	    }

	    function countries_list() {
	        $Countries = array(
	            'US' => esc_html__('United States', _yani_theme()->get_text_domain()),
	            'CA' => esc_html__('Canada', _yani_theme()->get_text_domain()),
	            'AU' => esc_html__('Australia', _yani_theme()->get_text_domain()),
	            'FR' => esc_html__('France', _yani_theme()->get_text_domain()),
	            'DE' => esc_html__('Germany', _yani_theme()->get_text_domain()),
	            'IS' => esc_html__('Iceland', _yani_theme()->get_text_domain()),
	            'IE' => esc_html__('Ireland', _yani_theme()->get_text_domain()),
	            'IT' => esc_html__('Italy', _yani_theme()->get_text_domain()),
	            'ES' => esc_html__('Spain', _yani_theme()->get_text_domain()),
	            'SE' => esc_html__('Sweden', _yani_theme()->get_text_domain()),
	            'AT' => esc_html__('Austria', _yani_theme()->get_text_domain()),
	            'BE' => esc_html__('Belgium', _yani_theme()->get_text_domain()),
	            'FI' => esc_html__('Finland', _yani_theme()->get_text_domain()),
	            'CZ' => esc_html__('Czech Republic', _yani_theme()->get_text_domain()),
	            'DK' => esc_html__('Denmark', _yani_theme()->get_text_domain()),
	            'NO' => esc_html__('Norway', _yani_theme()->get_text_domain()),
	            'GB' => esc_html__('United Kingdom', _yani_theme()->get_text_domain()),
	            'CH' => esc_html__('Switzerland', _yani_theme()->get_text_domain()),
	            'NZ' => esc_html__('New Zealand', _yani_theme()->get_text_domain()),
	            'RU' => esc_html__('Russian Federation', _yani_theme()->get_text_domain()),
	            'PT' => esc_html__('Portugal', _yani_theme()->get_text_domain()),
	            'NL' => esc_html__('Netherlands', _yani_theme()->get_text_domain()),
	            'IM' => esc_html__('Isle of Man', _yani_theme()->get_text_domain()),
	            'AF' => esc_html__('Afghanistan', _yani_theme()->get_text_domain()),
	            'AX' => esc_html__('Aland Islands ', _yani_theme()->get_text_domain()),
	            'AL' => esc_html__('Albania', _yani_theme()->get_text_domain()),
	            'DZ' => esc_html__('Algeria', _yani_theme()->get_text_domain()),
	            'AS' => esc_html__('American Samoa', _yani_theme()->get_text_domain()),
	            'AD' => esc_html__('Andorra', _yani_theme()->get_text_domain()),
	            'AO' => esc_html__('Angola', _yani_theme()->get_text_domain()),
	            'AI' => esc_html__('Anguilla', _yani_theme()->get_text_domain()),
	            'AQ' => esc_html__('Antarctica', _yani_theme()->get_text_domain()),
	            'AG' => esc_html__('Antigua and Barbuda', _yani_theme()->get_text_domain()),
	            'AR' => esc_html__('Argentina', _yani_theme()->get_text_domain()),
	            'AM' => esc_html__('Armenia', _yani_theme()->get_text_domain()),
	            'AW' => esc_html__('Aruba', _yani_theme()->get_text_domain()),
	            'AZ' => esc_html__('Azerbaijan', _yani_theme()->get_text_domain()),
	            'BS' => esc_html__('Bahamas', _yani_theme()->get_text_domain()),
	            'BH' => esc_html__('Bahrain', _yani_theme()->get_text_domain()),
	            'BD' => esc_html__('Bangladesh', _yani_theme()->get_text_domain()),
	            'BB' => esc_html__('Barbados', _yani_theme()->get_text_domain()),
	            'BY' => esc_html__('Belarus', _yani_theme()->get_text_domain()),
	            'BZ' => esc_html__('Belize', _yani_theme()->get_text_domain()),
	            'BJ' => esc_html__('Benin', _yani_theme()->get_text_domain()),
	            'BM' => esc_html__('Bermuda', _yani_theme()->get_text_domain()),
	            'BT' => esc_html__('Bhutan', _yani_theme()->get_text_domain()),
	            'BO' => esc_html__('Bolivia, Plurinational State of', _yani_theme()->get_text_domain()),
	            'BQ' => esc_html__('Bonaire, Sint Eustatius and Saba', _yani_theme()->get_text_domain()),
	            'BA' => esc_html__('Bosnia and Herzegovina', _yani_theme()->get_text_domain()),
	            'BW' => esc_html__('Botswana', _yani_theme()->get_text_domain()),
	            'BV' => esc_html__('Bouvet Island', _yani_theme()->get_text_domain()),
	            'BR' => esc_html__('Brazil', _yani_theme()->get_text_domain()),
	            'IO' => esc_html__('British Indian Ocean Territory', _yani_theme()->get_text_domain()),
	            'BN' => esc_html__('Brunei Darussalam', _yani_theme()->get_text_domain()),
	            'BG' => esc_html__('Bulgaria', _yani_theme()->get_text_domain()),
	            'BF' => esc_html__('Burkina Faso', _yani_theme()->get_text_domain()),
	            'BI' => esc_html__('Burundi', _yani_theme()->get_text_domain()),
	            'KH' => esc_html__('Cambodia', _yani_theme()->get_text_domain()),
	            'CM' => esc_html__('Cameroon', _yani_theme()->get_text_domain()),
	            'CV' => esc_html__('Cape Verde', _yani_theme()->get_text_domain()),
	            'KY' => esc_html__('Cayman Islands', _yani_theme()->get_text_domain()),
	            'CF' => esc_html__('Central African Republic', _yani_theme()->get_text_domain()),
	            'TD' => esc_html__('Chad', _yani_theme()->get_text_domain()),
	            'CL' => esc_html__('Chile', _yani_theme()->get_text_domain()),
	            'CN' => esc_html__('China', _yani_theme()->get_text_domain()),
	            'CX' => esc_html__('Christmas Island', _yani_theme()->get_text_domain()),
	            'CC' => esc_html__('Cocos (Keeling) Islands', _yani_theme()->get_text_domain()),
	            'CO' => esc_html__('Colombia', _yani_theme()->get_text_domain()),
	            'KM' => esc_html__('Comoros', _yani_theme()->get_text_domain()),
	            'CG' => esc_html__('Congo', _yani_theme()->get_text_domain()),
	            'CD' => esc_html__('Congo, the Democratic Republic of the', _yani_theme()->get_text_domain()),
	            'CK' => esc_html__('Cook Islands', _yani_theme()->get_text_domain()),
	            'CR' => esc_html__('Costa Rica', _yani_theme()->get_text_domain()),
	            'CI' => esc_html__("Cote d'Ivoire", _yani_theme()->get_text_domain()),
	            'HR' => esc_html__('Croatia', _yani_theme()->get_text_domain()),
	            'CU' => esc_html__('Cuba', _yani_theme()->get_text_domain()),
	            'CW' => esc_html__('Curaçao', _yani_theme()->get_text_domain()),
	            'CY' => esc_html__('Cyprus', _yani_theme()->get_text_domain()),
	            'DJ' => esc_html__('Djibouti', _yani_theme()->get_text_domain()),
	            'DM' => esc_html__('Dominica', _yani_theme()->get_text_domain()),
	            'DO' => esc_html__('Dominican Republic', _yani_theme()->get_text_domain()),
	            'EC' => esc_html__('Ecuador', _yani_theme()->get_text_domain()),
	            'EG' => esc_html__('Egypt', _yani_theme()->get_text_domain()),
	            'SV' => esc_html__('El Salvador', _yani_theme()->get_text_domain()),
	            'GQ' => esc_html__('Equatorial Guinea', _yani_theme()->get_text_domain()),
	            'ER' => esc_html__('Eritrea', _yani_theme()->get_text_domain()),
	            'EE' => esc_html__('Estonia', _yani_theme()->get_text_domain()),
	            'ET' => esc_html__('Ethiopia', _yani_theme()->get_text_domain()),
	            'FK' => esc_html__('Falkland Islands (Malvinas)', _yani_theme()->get_text_domain()),
	            'FO' => esc_html__('Faroe Islands', _yani_theme()->get_text_domain()),
	            'FJ' => esc_html__('Fiji', _yani_theme()->get_text_domain()),
	            'GF' => esc_html__('French Guiana', _yani_theme()->get_text_domain()),
	            'PF' => esc_html__('French Polynesia', _yani_theme()->get_text_domain()),
	            'TF' => esc_html__('French Southern Territories', _yani_theme()->get_text_domain()),
	            'GA' => esc_html__('Gabon', _yani_theme()->get_text_domain()),
	            'GM' => esc_html__('Gambia', _yani_theme()->get_text_domain()),
	            'GE' => esc_html__('Georgia', _yani_theme()->get_text_domain()),
	            'GH' => esc_html__('Ghana', _yani_theme()->get_text_domain()),
	            'GI' => esc_html__('Gibraltar', _yani_theme()->get_text_domain()),
	            'GR' => esc_html__('Greece', _yani_theme()->get_text_domain()),
	            'GL' => esc_html__('Greenland', _yani_theme()->get_text_domain()),
	            'GD' => esc_html__('Grenada', _yani_theme()->get_text_domain()),
	            'GP' => esc_html__('Guadeloupe', _yani_theme()->get_text_domain()),
	            'GU' => esc_html__('Guam', _yani_theme()->get_text_domain()),
	            'GT' => esc_html__('Guatemala', _yani_theme()->get_text_domain()),
	            'GG' => esc_html__('Guernsey', _yani_theme()->get_text_domain()),
	            'GN' => esc_html__('Guinea', _yani_theme()->get_text_domain()),
	            'GW' => esc_html__('Guinea-Bissau', _yani_theme()->get_text_domain()),
	            'GY' => esc_html__('Guyana', _yani_theme()->get_text_domain()),
	            'HT' => esc_html__('Haiti', _yani_theme()->get_text_domain()),
	            'HM' => esc_html__('Heard Island and McDonald Islands', _yani_theme()->get_text_domain()),
	            'VA' => esc_html__('Holy See (Vatican City State)', _yani_theme()->get_text_domain()),
	            'HN' => esc_html__('Honduras', _yani_theme()->get_text_domain()),
	            'HK' => esc_html__('Hong Kong', _yani_theme()->get_text_domain()),
	            'HU' => esc_html__('Hungary', _yani_theme()->get_text_domain()),
	            'IN' => esc_html__('India', _yani_theme()->get_text_domain()),
	            'ID' => esc_html__('Indonesia', _yani_theme()->get_text_domain()),
	            'IR' => esc_html__('Iran, Islamic Republic of', _yani_theme()->get_text_domain()),
	            'IQ' => esc_html__('Iraq', _yani_theme()->get_text_domain()),
	            'IL' => esc_html__('Israel', _yani_theme()->get_text_domain()),
	            'JM' => esc_html__('Jamaica', _yani_theme()->get_text_domain()),
	            'JP' => esc_html__('Japan', _yani_theme()->get_text_domain()),
	            'JE' => esc_html__('Jersey', _yani_theme()->get_text_domain()),
	            'JO' => esc_html__('Jordan', _yani_theme()->get_text_domain()),
	            'KZ' => esc_html__('Kazakhstan', _yani_theme()->get_text_domain()),
	            'KE' => esc_html__('Kenya', _yani_theme()->get_text_domain()),
	            'KI' => esc_html__('Kiribati', _yani_theme()->get_text_domain()),
	            'KP' => esc_html__('Korea, Democratic People\'s Republic of', _yani_theme()->get_text_domain()),
	            'KR' => esc_html__('Korea, Republic of', _yani_theme()->get_text_domain()),
	            'KV' => esc_html__('kosovo', _yani_theme()->get_text_domain()),
	            'KW' => esc_html__('Kuwait', _yani_theme()->get_text_domain()),
	            'KG' => esc_html__('Kyrgyzstan', _yani_theme()->get_text_domain()),
	            'LA' => esc_html__('Lao People\'s Democratic Republic', _yani_theme()->get_text_domain()),
	            'LV' => esc_html__('Latvia', _yani_theme()->get_text_domain()),
	            'LB' => esc_html__('Lebanon', _yani_theme()->get_text_domain()),
	            'LS' => esc_html__('Lesotho', _yani_theme()->get_text_domain()),
	            'LR' => esc_html__('Liberia', _yani_theme()->get_text_domain()),
	            'LY' => esc_html__('Libyan Arab Jamahiriya', _yani_theme()->get_text_domain()),
	            'LI' => esc_html__('Liechtenstein', _yani_theme()->get_text_domain()),
	            'LT' => esc_html__('Lithuania', _yani_theme()->get_text_domain()),
	            'LU' => esc_html__('Luxembourg', _yani_theme()->get_text_domain()),
	            'MO' => esc_html__('Macao', _yani_theme()->get_text_domain()),
	            'MK' => esc_html__('Macedonia', _yani_theme()->get_text_domain()),
	            'MG' => esc_html__('Madagascar', _yani_theme()->get_text_domain()),
	            'MW' => esc_html__('Malawi', _yani_theme()->get_text_domain()),
	            'MY' => esc_html__('Malaysia', _yani_theme()->get_text_domain()),
	            'MV' => esc_html__('Maldives', _yani_theme()->get_text_domain()),
	            'ML' => esc_html__('Mali', _yani_theme()->get_text_domain()),
	            'MT' => esc_html__('Malta', _yani_theme()->get_text_domain()),
	            'MH' => esc_html__('Marshall Islands', _yani_theme()->get_text_domain()),
	            'MQ' => esc_html__('Martinique', _yani_theme()->get_text_domain()),
	            'MR' => esc_html__('Mauritania', _yani_theme()->get_text_domain()),
	            'MU' => esc_html__('Mauritius', _yani_theme()->get_text_domain()),
	            'YT' => esc_html__('Mayotte', _yani_theme()->get_text_domain()),
	            'MX' => esc_html__('Mexico', _yani_theme()->get_text_domain()),
	            'FM' => esc_html__('Micronesia, Federated States of', _yani_theme()->get_text_domain()),
	            'MD' => esc_html__('Moldova, Republic of', _yani_theme()->get_text_domain()),
	            'MC' => esc_html__('Monaco', _yani_theme()->get_text_domain()),
	            'MN' => esc_html__('Mongolia', _yani_theme()->get_text_domain()),
	            'ME' => esc_html__('Montenegro', _yani_theme()->get_text_domain()),
	            'MS' => esc_html__('Montserrat', _yani_theme()->get_text_domain()),
	            'MA' => esc_html__('Morocco', _yani_theme()->get_text_domain()),
	            'MZ' => esc_html__('Mozambique', _yani_theme()->get_text_domain()),
	            'MM' => esc_html__('Myanmar', _yani_theme()->get_text_domain()),
	            'NA' => esc_html__('Namibia', _yani_theme()->get_text_domain()),
	            'NR' => esc_html__('Nauru', _yani_theme()->get_text_domain()),
	            'NP' => esc_html__('Nepal', _yani_theme()->get_text_domain()),
	            'NC' => esc_html__('New Caledonia', _yani_theme()->get_text_domain()),
	            'NI' => esc_html__('Nicaragua', _yani_theme()->get_text_domain()),
	            'NE' => esc_html__('Niger', _yani_theme()->get_text_domain()),
	            'NG' => esc_html__('Nigeria', _yani_theme()->get_text_domain()),
	            'NU' => esc_html__('Niue', _yani_theme()->get_text_domain()),
	            'NF' => esc_html__('Norfolk Island', _yani_theme()->get_text_domain()),
	            'MP' => esc_html__('Northern Mariana Islands', _yani_theme()->get_text_domain()),
	            'OM' => esc_html__('Oman', _yani_theme()->get_text_domain()),
	            'PK' => esc_html__('Pakistan', _yani_theme()->get_text_domain()),
	            'PW' => esc_html__('Palau', _yani_theme()->get_text_domain()),
	            'PS' => esc_html__('Palestinian Territory, Occupied', _yani_theme()->get_text_domain()),
	            'PA' => esc_html__('Panama', _yani_theme()->get_text_domain()),
	            'PG' => esc_html__('Papua New Guinea', _yani_theme()->get_text_domain()),
	            'PY' => esc_html__('Paraguay', _yani_theme()->get_text_domain()),
	            'PE' => esc_html__('Peru', _yani_theme()->get_text_domain()),
	            'PH' => esc_html__('Philippines', _yani_theme()->get_text_domain()),
	            'PN' => esc_html__('Pitcairn', _yani_theme()->get_text_domain()),
	            'PL' => esc_html__('Poland', _yani_theme()->get_text_domain()),
	            'PR' => esc_html__('Puerto Rico', _yani_theme()->get_text_domain()),
	            'QA' => esc_html__('Qatar', _yani_theme()->get_text_domain()),
	            'RE' => esc_html__('Reunion', _yani_theme()->get_text_domain()),
	            'RO' => esc_html__('Romania', _yani_theme()->get_text_domain()),
	            'RW' => esc_html__('Rwanda', _yani_theme()->get_text_domain()),
	            'BL' => esc_html__('Saint Barthélemy', _yani_theme()->get_text_domain()),
	            'SH' => esc_html__('Saint Helena', _yani_theme()->get_text_domain()),
	            'KN' => esc_html__('Saint Kitts and Nevis', _yani_theme()->get_text_domain()),
	            'LC' => esc_html__('Saint Lucia', _yani_theme()->get_text_domain()),
	            'MF' => esc_html__('Saint Martin (French part)', _yani_theme()->get_text_domain()),
	            'PM' => esc_html__('Saint Pierre and Miquelon', _yani_theme()->get_text_domain()),
	            'VC' => esc_html__('Saint Vincent and the Grenadines', _yani_theme()->get_text_domain()),
	            'WS' => esc_html__('Samoa', _yani_theme()->get_text_domain()),
	            'SM' => esc_html__('San Marino', _yani_theme()->get_text_domain()),
	            'ST' => esc_html__('Sao Tome and Principe', _yani_theme()->get_text_domain()),
	            'SA' => esc_html__('Saudi Arabia', _yani_theme()->get_text_domain()),
	            'SN' => esc_html__('Senegal', _yani_theme()->get_text_domain()),
	            'RS' => esc_html__('Serbia', _yani_theme()->get_text_domain()),
	            'SC' => esc_html__('Seychelles', _yani_theme()->get_text_domain()),
	            'SL' => esc_html__('Sierra Leone', _yani_theme()->get_text_domain()),
	            'SG' => esc_html__('Singapore', _yani_theme()->get_text_domain()),
	            'SX' => esc_html__('Sint Maarten (Dutch part)', _yani_theme()->get_text_domain()),
	            'SK' => esc_html__('Slovakia', _yani_theme()->get_text_domain()),
	            'SI' => esc_html__('Slovenia', _yani_theme()->get_text_domain()),
	            'SB' => esc_html__('Solomon Islands', _yani_theme()->get_text_domain()),
	            'SO' => esc_html__('Somalia', _yani_theme()->get_text_domain()),
	            'ZA' => esc_html__('South Africa', _yani_theme()->get_text_domain()),
	            'GS' => esc_html__('South Georgia and the South Sandwich Islands', _yani_theme()->get_text_domain()),
	            'LK' => esc_html__('Sri Lanka', _yani_theme()->get_text_domain()),
	            'SD' => esc_html__('Sudan', _yani_theme()->get_text_domain()),
	            'SR' => esc_html__('Suriname', _yani_theme()->get_text_domain()),
	            'SJ' => esc_html__('Svalbard and Jan Mayen', _yani_theme()->get_text_domain()),
	            'SZ' => esc_html__('Swaziland', _yani_theme()->get_text_domain()),
	            'SY' => esc_html__('Syrian Arab Republic', _yani_theme()->get_text_domain()),
	            'TW' => esc_html__('Taiwan, Province of China', _yani_theme()->get_text_domain()),
	            'TJ' => esc_html__('Tajikistan', _yani_theme()->get_text_domain()),
	            'TZ' => esc_html__('Tanzania, United Republic of', _yani_theme()->get_text_domain()),
	            'TH' => esc_html__('Thailand', _yani_theme()->get_text_domain()),
	            'TL' => esc_html__('Timor-Leste', _yani_theme()->get_text_domain()),
	            'TG' => esc_html__('Togo', _yani_theme()->get_text_domain()),
	            'TK' => esc_html__('Tokelau', _yani_theme()->get_text_domain()),
	            'TO' => esc_html__('Tonga', _yani_theme()->get_text_domain()),
	            'TT' => esc_html__('Trinidad and Tobago', _yani_theme()->get_text_domain()),
	            'TN' => esc_html__('Tunisia', _yani_theme()->get_text_domain()),
	            'TR' => esc_html__('Turkey', _yani_theme()->get_text_domain()),
	            'TM' => esc_html__('Turkmenistan', _yani_theme()->get_text_domain()),
	            'TC' => esc_html__('Turks and Caicos Islands', _yani_theme()->get_text_domain()),
	            'TV' => esc_html__('Tuvalu', _yani_theme()->get_text_domain()),
	            'UG' => esc_html__('Uganda', _yani_theme()->get_text_domain()),
	            'UA' => esc_html__('Ukraine', _yani_theme()->get_text_domain()),
	            'UAE' => esc_html__('United Arab Emirates', _yani_theme()->get_text_domain()),
	            'UM' => esc_html__('United States Minor Outlying Islands', _yani_theme()->get_text_domain()),
	            'UY' => esc_html__('Uruguay', _yani_theme()->get_text_domain()),
	            'UZ' => esc_html__('Uzbekistan', _yani_theme()->get_text_domain()),
	            'VU' => esc_html__('Vanuatu', _yani_theme()->get_text_domain()),
	            'VE' => esc_html__('Venezuela, Bolivarian Republic of', _yani_theme()->get_text_domain()),
	            'VN' => esc_html__('Viet Nam', _yani_theme()->get_text_domain()),
	            'VG' => esc_html__('Virgin Islands, British', _yani_theme()->get_text_domain()),
	            'VI' => esc_html__('Virgin Islands, U.S.', _yani_theme()->get_text_domain()),
	            'WF' => esc_html__('Wallis and Futuna', _yani_theme()->get_text_domain()),
	            'EH' => esc_html__('Western Sahara', _yani_theme()->get_text_domain()),
	            'YE' => esc_html__('Yemen', _yani_theme()->get_text_domain()),
	            'ZM' => esc_html__('Zambia', _yani_theme()->get_text_domain()),
	            'ZW' => esc_html__('Zimbabwe', _yani_theme()->get_text_domain())
	        );
	        return $Countries;
	    }
		public static function get_instance() {

			// If the single instance hasn't been set, set it now.
			if ( null == self::$instance ) {
				self::$instance = new self;
			}
			return self::$instance;
		}	    
	}
}

function _yani_map() {
	return _Yani_Map_Helper::get_instance();
}