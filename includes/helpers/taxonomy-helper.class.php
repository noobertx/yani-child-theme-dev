<?php
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! class_exists( '_Yani_Taxonomy_Helper' ) ) {
	class _Yani_Taxonomy_Helper{
		private static $instance = null;	

		public function get_taxonomy_simple( $tax_name ) {        
	        $terms = wp_get_post_terms( get_the_ID(), $tax_name, array("fields" => "names"));
	        if (!empty($terms) && ! is_wp_error( $terms ) ) {
	            
	            $temp_array = array();
	 
	            foreach ( $terms as $term ) {
	                $temp_array[] = $term;
	            }
	                                 
	            $result = join( ", ", $temp_array );
	            return $result;
	        }
	        return '';
	    }

	    public function get_post_term_slug( $post_id, $tax_name ) {
	        $terms = get_the_terms( $post_id, $tax_name );
	        if ( !empty( $terms ) ){
	            // get the first term
	            $term = array_shift( $terms );
	            return $term->slug;
	        }
	    }

	    public function taxonomy_by_postID( $property_id, $taxonomy_name ){

	        $tax_terms = get_the_terms( $property_id, $taxonomy_name );
	        $tax_name = '';
	        if( !empty($tax_terms) ){
	            foreach( $tax_terms as $tax_term ){
	                $tax_name = $tax_term->name;
	                break;
	            }
	        }
	        return $tax_name;
	    }

	    public function hide_empty_taxonomies() {
	        $state_city_area_dropdowns = _yani_theme()->get_option('state_city_area_dropdowns');
	        if( $state_city_area_dropdowns != 0 ) {
	            $hide_empty = true;
	        } else {
	            $hide_empty = false;
	        }

	        return $hide_empty;
	    }

	    public function check_for_taxonomy($tax_setting_name) {

	        if(class_exists('yani_Taxonomies')) {
	            if(yani_Taxonomies::get_setting($tax_setting_name) != 'disabled') {
	                return true;
	            } else {
	                return false;
	            }
	        }

	        return true;
	    }

	    public function is_tax() {
	        if(is_tax(
	                array(
	                    'property_type',
	                    'property_status',
	                    'property_feature',
	                    'property_label',
	                    'property_country',
	                    'property_state',
	                    'property_city',
	                    'property_area'
	                )
	            )
	        ) {
	            return true;
	        }
	        return false;
	    }

	    public  function get_taxonomy_simple_2( $tax_name, $propID ) { //function yani_taxonomy_simple_2

	        $terms = wp_get_post_terms( $propID, $tax_name, array("fields" => "names"));
	        if (!empty($terms) && ! is_wp_error( $terms )){
	            $temp_array = array();
	 
	            foreach ( $terms as $term ) {
	                $temp_array[] = $term;
	            }
	                                 
	            $result = join( ", ", $temp_array );
	            return $result;
	        }
	        return '';
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

function _yani_taxonomy() {
	return _Yani_Taxonomy_Helper::get_instance();
}