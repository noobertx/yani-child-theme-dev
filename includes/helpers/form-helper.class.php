<?php
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! class_exists( '_Yani_Form_Helper' ) ) {
	class _Yani_Form_Helper{
		private static $instance = null;	

		public function get_required_field_symbol( $field ,$symbol=" *") {
	        $required_fields = _yani_theme()->get_option('required_fields');
	        
	        if(array_key_exists($field, $required_fields)) {
	            $field = $required_fields[$field];
	            if( $field != 0 ) {
	                return $symbol;
	            }
	        }
	        
	        return '';
	    }	
	    public function get_multiselect($value) {
	        $is_multiselect = $this->is_multiselect($value);

	        if($is_multiselect) {
	            return 'multiple';
	        }
	        return '';
	    }


	    public function get_form_type() {
	        $form_type = _yani_theme()->get_option('form_type', 'custom_form');

	        if($form_type == 'contact_form_7_gravity_form' || $form_type == 'contact_form_7' || $form_type == 'gravity_form' || $form_type == 'hubspot') {
	            return true;
	        }
	        return false;
	    }
		

	    public function is_multiselect($value = false) {
	        if($value) {
	            return true;
	        }
	        return false;
	    }

	    public function show_google_reCaptcha() {
	        $enable_reCaptcha = _yani_theme()->get_option('enable_reCaptcha');
	        $recaptha_site_key = _yani_theme()->get_option('recaptha_site_key');
	        $recaptha_secret_key = _yani_theme()->get_option('recaptha_secret_key');

	        if( $enable_reCaptcha != 0 && !empty($recaptha_site_key) && !empty($recaptha_secret_key) ) {
	            return true;
	        }
	        return false;

	    }
	    public function render_hirarchical_options($taxonomy_name, $taxonomy_terms, $searched_term, $prefix = " " ){

	        if (!empty($taxonomy_terms) && taxonomy_exists($taxonomy_name)) {
	            foreach ($taxonomy_terms as $term) {

	                if( $taxonomy_name == 'property_area' ) {
	                    $term_meta= get_option( "_yani_property_area_$term->term_id");
	                    $parent_city = sanitize_title($term_meta['parent_city']);

	                    if ($searched_term == $term->slug) {
	                        echo '<option data-ref="' . urldecode($term->slug) . '" data-belong="'.urldecode($parent_city).'" value="' . urldecode($term->slug) . '" selected="selected">' . esc_attr($prefix) . esc_attr($term->name) . '</option>';
	                    } else {
	                        echo '<option data-ref="' . urldecode($term->slug) . '" data-belong="'.urldecode($parent_city).'" value="' . urldecode($term->slug) . '">' . esc_attr($prefix) . esc_attr($term->name) .'</option>';
	                    }
	                    
	                } elseif( $taxonomy_name == 'property_city' ) {
	                    $term_meta= get_option( "_yani_property_city_$term->term_id");
	                    $parent_state = sanitize_title($term_meta['parent_state']);

	                    if ($searched_term == $term->slug) {
	                        echo '<option data-ref="' . urldecode($term->slug) . '" data-belong="'.urldecode($parent_state).'" value="' . urldecode($term->slug) . '" selected="selected">' . esc_attr($prefix) . esc_attr($term->name) . '</option>';
	                    } else {
	                        echo '<option data-ref="' . urldecode($term->slug) . '" data-belong="'.urldecode($parent_state).'" value="' . urldecode($term->slug) . '">' . esc_attr($prefix) . esc_attr($term->name) .'</option>';
	                    }

	                } elseif( $taxonomy_name == 'property_state' ) {

	                    $term_meta = get_option( "_yani_property_state_$term->term_id");
	                    $parent_country = sanitize_title($term_meta['parent_country']);

	                    if ($searched_term == $term->slug) {
	                        echo '<option data-ref="' . urldecode($term->slug) . '" data-belong="'.urldecode($parent_country).'" value="' . urldecode($term->slug) . '" selected="selected">' . esc_attr($prefix) . esc_attr($term->name) . '</option>';
	                    } else {
	                        echo '<option data-ref="' . urldecode($term->slug) . '" data-belong="'.urldecode($parent_country).'" value="' . urldecode($term->slug) . '">' . esc_attr($prefix) . esc_attr($term->name) .'</option>';
	                    }

	                } elseif( $taxonomy_name == 'property_country' ) {
	            
	                    if ($searched_term == $term->slug) {
	                        echo '<option data-ref="' . urldecode($term->slug) . '" value="' . urldecode($term->slug) . '" selected="selected">' . esc_attr($prefix) . esc_attr($term->name) . '</option>';
	                    } else {
	                        echo '<option data-ref="' . urldecode($term->slug) . '" value="' . urldecode($term->slug) . '">' . esc_attr($prefix) . esc_attr($term->name) .'</option>';
	                    }

	                } else {

	                    if ($searched_term == $term->slug) {
	                        echo '<option value="' . urldecode($term->slug) . '" selected="selected">' . esc_attr($prefix) . esc_attr($term->name) . '</option>';
	                    } else {
	                        echo '<option value="' . urldecode($term->slug) . '">' . esc_attr($prefix) . esc_attr($term->name) . '</option>';
	                    }
	                }


	                $child_terms = get_terms($taxonomy_name, array(
	                    'hide_empty' => false,
	                    'parent' => $term->term_id
	                ));

	                if (!empty($child_terms)) {
	                    $this->render_hirarchical_options( $taxonomy_name, $child_terms, $searched_term, "- ".$prefix );
	                }
	            }
	        }
	    }
	    public function get_taxonomies_for_edit_listing_multivalue( $listing_id, $taxonomy ){

	        $taxonomy_terms_ids= array();
	        $taxonomy_terms = get_the_terms( $listing_id, $taxonomy );

	        if ( $taxonomy_terms && ! is_wp_error( $taxonomy_terms ) ) {
	            foreach( $taxonomy_terms as $term ) {
	                $taxonomy_terms_ids[] = intval( $term->term_id );
	            }
	        }

	        $parent_taxonomy = get_terms(
	            array(
	                $taxonomy
	            ),
	            array(
	                'orderby'       => 'name',
	                'order'         => 'ASC',
	                'hide_empty'    => false,
	                'parent' => 0
	            )
	        );

	        $this->get_taxonomies_for_edit_listing_multivalue_child( $taxonomy, $parent_taxonomy, $taxonomy_terms_ids );

	    }

	    public function get_taxonomies_for_edit_listing_multivalue_child($taxonomy, $parent_taxonomy, $terms_ids, $prefix = " " ){

	        if (!empty($parent_taxonomy)) {
	                    
	            foreach ($parent_taxonomy as $p_tax) {

	                if ( in_array( $p_tax->term_id, $terms_ids ) ) {
	                    echo '<option value="' . $p_tax->term_id . '" selected="selected">'. $prefix . $p_tax->name . '</option>';
	                } else {
	                    echo '<option value="' . $p_tax->term_id . '">'. $prefix . $p_tax->name . '</option>';
	                }

	                $get_child_tax = get_terms($taxonomy, array(
	                    'hide_empty' => false,
	                    'parent' => $p_tax->term_id
	                ));

	                if (!empty($get_child_tax)) {
	                    $this->get_taxonomies_for_edit_listing_multivalue_child( $taxonomy, $get_child_tax, $terms_ids, "- ".$prefix );
	                }

	            }
	        }
	    }

	    public function get_taxonomies_with_id_value($taxonomy, $parent_taxonomy, $taxonomy_id, $prefix = " " ){

        if (!empty($parent_taxonomy)) {
            foreach ($parent_taxonomy as $term) {
                if ($taxonomy_id != $term->term_id) {
                    echo '<option value="' . $term->term_id . '">' . $prefix . $term->name . '</option>';
                } else {
                    echo '<option value="' . $term->term_id . '" selected="selected">' . $prefix . $term->name . '</option>';
                }
                $get_child_terms = get_terms($taxonomy, array(
                    'hide_empty' => false,
                    'parent' => $term->term_id
                ));

                if (!empty($get_child_terms)) {
                    $this->get_taxonomies_with_id_value( $taxonomy, $get_child_terms, $taxonomy_id, "- ".$prefix );
                }
            }
        }
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

function _yani_form() {
	return _Yani_Form_Helper::get_instance();
}