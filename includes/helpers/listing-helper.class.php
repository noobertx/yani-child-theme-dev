<?php
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! class_exists( '_Yani_Listing_Helper' ) ) {
	class _Yani_Listing_Helper{
		private static $instance = null;		

		public function get_price() {

	        $sale_price = get_post_meta( get_the_ID(), 'yani_property_price', true);
	        $second_price     = get_post_meta( get_the_ID(), 'yani_property_sec_price', true );
	        $price_postfix = get_post_meta( get_the_ID(), 'yani_property_price_postfix', true);
	        $price_prefix  = get_post_meta( get_the_ID(), 'yani_property_price_prefix', true );
	        $price_separator = _yani_theme()->get_option('currency_separator');

	        $output = '';
	        $price_as_text = doubleval( $sale_price );
	        if( !$price_as_text ) {
	            $output .= '<span class="item-price item-price-text">'.$sale_price. '</span>';
	            return $output;
	        }

	        if( !empty( $price_prefix ) ) {
	            $price_prefix = '<span class="price-start">'.$price_prefix.'</span>';
	        }

	        if (!empty($sale_price)) {

	            if (!empty($price_postfix)) {
	                if( empty( $second_price ) ) {
	                    $price_postfix = $price_separator . $price_postfix;
	                } else {
	                    $price_postfix = '';
	                }
	            }

	            return $price_prefix.' '._yani_property()->get_property_price($sale_price) . $price_postfix;

	        }
	    }

	    public function get_user_num_posted_listings( $userID ) {
	        $args = array(
	            'post_type'   => 'property',
	            'post_status' => 'any',
	            'author'      => $userID,

	        );
	        $posts = new WP_Query( $args );
	        return $posts->found_posts;
	        wp_reset_postdata();
	    }

	    public function check_remaining_listings($user_id) { //function get_featured_remaining_listings
        	return get_the_author_meta( 'package_featured_listings' , $user_id );
    	}

	    public function get_size( $position ) {

	        $propID = get_the_ID();
	        if( $position == 'before' ) {
	            $prop_size = $this->get_size_unit( $propID ).' '.$this->get_area_size( $propID );
	        } else {
	            $prop_size = $this->get_area_size( $propID ).' '.$this->get_size_unit( $propID );
	        }
	        return  $prop_size;
	    }

	    public function get_area_size( $propID ) {
	        $prop_area_size = '';
	        $prop_size     = get_post_meta( $propID, 'yani_property_size', true );
	        $yani_base_area = _yani_theme()->get_option('yani_base_area');

	        if( !empty( $prop_size ) ) {

	            if( isset( $_COOKIE[ "yani_current_area" ] ) ) {
	                if( $_COOKIE[ "yani_current_area" ] == 'sq_meter' && $yani_base_area != 'sq_meter'  ) {
	                    $prop_size = $prop_size * 0.09290304; //m2 = ft2 x 0.09290304

	                } elseif( $_COOKIE[ "yani_current_area" ] == 'sqft' && $yani_base_area != 'sqft' ) {
	                    $prop_size = $prop_size / 0.09290304; //ft2 = m2 ÷ 0.09290304
	                }
	            }

	            $prop_area_size = esc_attr( round($prop_size, 2) );

	        }
	        return $prop_area_size;

	    }

	    public function  get_size_unit( $propID ) {
	        $measurement_unit_global = _yani_theme()->get_option('measurement_unit_global');
	        $area_switcher_enable = _yani_theme()->get_option('area_switcher_enable');

	        if( $area_switcher_enable != 0 ) {
	            $prop_size_prefix = _yani_theme()->get_option('yani_base_area');

	            if( isset( $_COOKIE[ "yani_current_area" ] ) ) {
	                $prop_size_prefix =$_COOKIE[ "yani_current_area" ];
	            }

	            if( $prop_size_prefix == 'sqft' ) {
	                $prop_size_prefix = _yani_theme()->get_option('measurement_unit_sqft_text');
	            } elseif( $prop_size_prefix == 'sq_meter' ) {
	                $prop_size_prefix = _yani_theme()->get_option('measurement_unit_square_meter_text');
	            }

	        } else {
	            if ($measurement_unit_global == 1) {
	                $prop_size_prefix = _yani_theme()->get_option('measurement_unit');

	                if( $prop_size_prefix == 'sqft' ) {
	                    $prop_size_prefix = _yani_theme()->get_option('measurement_unit_sqft_text');
	                } elseif( $prop_size_prefix == 'sq_meter' ) {
	                    $prop_size_prefix = _yani_theme()->get_option('measurement_unit_square_meter_text');
	                }

	            } else {
	                $prop_size_prefix = get_post_meta( $propID, 'yani_property_size_prefix', true);
	            }
	        }
	        return $prop_size_prefix;
	    }

	    public function get_listing_data_by_id($field, $ID) {
	        $prefix = 'yani_';
	        $data = get_post_meta($ID, $prefix.$field, true);

	        if($data != '') {
	            return $data;
	        }
	        return '';
	    }

	    public function get_current_listings( $userID ) {
	        $args = array(
	            'post_type'   => 'property',
	            'post_status' => 'any',
	            'author'      => $userID,

	        );
	        $posts = new WP_Query( $args );
	        return $posts->found_posts;
	        wp_reset_postdata();
	    }

	    public function get_current_featured_listings( $userID ) {

	        $args = array(
	            'post_type'     =>  'property',
	            'post_status'   =>  'any',
	            'author'        =>  $userID,
	            'meta_query'    =>  array(
	                array(
	                    'key'   => 'yani_featured',
	                    'value' => 1,
	                    'meta_compare '=>'='
	                )
	            )
	        );
	        $posts = new WP_Query( $args );
	        return $posts->found_posts;
	        wp_reset_postdata();

	    }

	    public  function render_listing_meta_v1(){
	        $propID = get_the_ID();
	        $prop_bed     = get_post_meta( get_the_ID(), 'yani_property_bedrooms', true );
	        $prop_bath     = get_post_meta( get_the_ID(), 'yani_property_bathrooms', true );
	        $prop_size     = get_post_meta( $propID, 'yani_property_size', true );

	        if( empty($prop_bed) && empty($prop_bath) && empty($prop_size) ) { return; }

	        $output = '';
	        $output .= '<p>';
	        if( !empty( $prop_bed ) ) {
	            $prop_bed = esc_attr( $prop_bed );
	            $prop_bed_lebel = ($prop_bed > 1 ) ? esc_html__( 'Beds', 'yani' ) : esc_html__( 'Bed', 'yani' );

	            $output .= '<span class="h-beds">';
	            $output .= $prop_bed_lebel .': '. $prop_bed;
	            $output .= '</span>';
	        }
	        if( !empty( $prop_bath ) ) {
	            $prop_bath = esc_attr( $prop_bath );
	            $prop_bath_lebel = ($prop_bath > 1 ) ? esc_html__( 'Baths', 'yani' ) : esc_html__( 'Bath', 'yani' );

	            $output .= '<span class="h-baths">';
	            $output .= $prop_bath_lebel .': '. $prop_bath;
	            $output .= '</span>';
	        }

	        $listing_area_size = $this->get_area_size( $propID );

	        if( !empty( $listing_area_size ) ) {
	            $output .= '<span class="h-area">';
	            $output .= $this->get_size_unit($propID) . ': ' . $this->get_area_size($propID);
	            $output .= '</span>';
	        }

	        $output .= '</p>';

	        return $output;

	    }

	    public function render_listing_meta_v1_without_p(){
	        $propID = get_the_ID();
	        $prop_bed     = get_post_meta( get_the_ID(), 'yani_property_bedrooms', true );
	        $prop_bath     = get_post_meta( get_the_ID(), 'yani_property_bathrooms', true );
	        $prop_size     = get_post_meta( $propID, 'yani_property_size', true );

	        if( empty($prop_bed) && empty($prop_bath) && empty($prop_size) ) { return; }

	        $output = '';
	        if( !empty( $prop_bed ) ) {
	            $prop_bed = esc_attr( $prop_bed );
	            $prop_bed_lebel = ($prop_bed > 1 ) ? esc_html__( 'Beds', 'yani' ) : esc_html__( 'Bed', 'yani' );

	            $output .= '<span class="h-beds">';
	            $output .= $prop_bed_lebel .': '. $prop_bed;
	            $output .= '</span>';
	        }
	        if( !empty( $prop_bath ) ) {
	            $prop_bath = esc_attr( $prop_bath );
	            $prop_bath_lebel = ($prop_bath > 1 ) ? esc_html__( 'Baths', 'yani' ) : esc_html__( 'Bath', 'yani' );

	            $output .= '<span class="h-baths">';
	            $output .= $prop_bath_lebel .': '. $prop_bath;
	            $output .= '</span>';
	        }

	        $listing_area_size = $this->get_area_size( $propID );

	        if( !empty( $listing_area_size ) ) {
	            $output .= '<span class="h-area">';
	            $output .= $this->get_size_unit($propID) . ': ' . $this->get_area_size($propID);
	            $output .= '</span>';
	        }

	        return $output;

	    }

   		public function   render_listing_meta_v3() {
	        $propID = get_the_ID();
	        $prop_bed     = get_post_meta( get_the_ID(), 'yani_property_bedrooms', true );
	        $prop_bath     = get_post_meta( get_the_ID(), 'yani_property_bathrooms', true );
	        $prop_size     = get_post_meta( $propID, 'yani_property_size', true );

	        if( empty($prop_bed) && empty($prop_bath) && empty($prop_size) ) { return; }

	        $output = '';
	        $output .= '<ul class="item-amenities">';
	        if( !empty( $prop_bed ) ) {
	            $prop_bed = esc_attr( $prop_bed );
	            $prop_bed_lebel = ($prop_bed > 1 ) ? esc_html__( 'Bedrooms', 'yani' ) : esc_html__( 'Bedroom', 'yani' );

	            $output .= '<li class="h-beds">';
	            $output .= '<span>'.$prop_bed.'</span>';
	            $output .= $prop_bed_lebel;
	            $output .= '</li>';
	        }
	        if( !empty( $prop_bath ) ) {
	            $prop_bath = esc_attr( $prop_bath );
	            $prop_bath_lebel = ($prop_bath > 1 ) ? esc_html__( 'Bathrooms', 'yani' ) : esc_html__( 'Bathroom', 'yani' );

	            $output .= '<li class="h-baths">';
	            $output .= '<span>'.$prop_bath.'</span>';
	            $output .= $prop_bath_lebel;
	            $output .= '</li>';
	        }

	        $listing_area_size = yani_get_area_size( $propID );

	        if( !empty( $listing_area_size ) ) {
	            $output .= '<li class="h-area">';
	            $output .= '<span>'.yani_get_area_size($propID).'</span>';
	            $output .= yani_get_size_unit($propID);
	            $output .= '</li>';

	        }

	        $output .= '</ul>';

	        return $output;

	    }

	    public  function render_listing_meta_widget()    {
	        $prop_bed     = get_post_meta( get_the_ID(), 'yani_property_bedrooms', true );
	        $prop_bath     = get_post_meta( get_the_ID(), 'yani_property_bathrooms', true );
	        $prop_size     = get_post_meta( get_the_ID(), 'yani_property_size', true );
	        //$prop_size_prefix     = get_post_meta( get_the_ID(), 'yani_property_size_prefix', true );

	        if( !empty( $prop_bed ) ) {
	            $prop_bed = esc_attr( $prop_bed );
	            $prop_bed_lebel = ($prop_bed > 1 ) ? esc_html__( 'beds', 'yani' ) : esc_html__( 'bed', 'yani' );

	            echo esc_attr( $prop_bed ).' '.esc_attr( $prop_bed_lebel ).' • ';
	        }
	        if( !empty( $prop_bath ) ) {
	            $prop_bath = esc_attr( $prop_bath );
	            $prop_bath_lebel = ($prop_bath > 1 ) ? esc_html__( 'baths', 'yani' ) : esc_html__( 'bath', 'yani' );

	            echo esc_attr( $prop_bath ).' '. esc_attr( $prop_bath_lebel ).' • ';
	        }
	        if( !empty( $prop_size ) ) {
	            echo yani_property_size( 'after' );
	        }

	    }

	    public function render_listing_meta_v2()    {
	        $prop_bed     = get_post_meta( get_the_ID(), 'yani_property_bedrooms', true );
	        $prop_bath     = get_post_meta( get_the_ID(), 'yani_property_bathrooms', true );
	        $prop_size     = get_post_meta( get_the_ID(), 'yani_property_size', true );
	        //$prop_size_prefix     = get_post_meta( get_the_ID(), 'yani_property_size_prefix', true );

	        if( !empty( $prop_bed ) ) {
	            $prop_bed = esc_attr( $prop_bed );
	            $prop_bed_lebel = ($prop_bed > 1 ) ? esc_html__( 'bd', 'yani' ) : esc_html__( 'bd', 'yani' );

	            echo '<li>';
	            echo esc_attr( $prop_bed ).' '. esc_attr( $prop_bed_lebel );
	            echo '</li>';
	        }
	        if( !empty( $prop_bath ) ) {
	            $prop_bath = esc_attr( $prop_bath );
	            $prop_bath_lebel = ($prop_bath > 1 ) ? esc_html__( 'ba', 'yani' ) : esc_html__( 'ba', 'yani' );

	            echo '<li>';
	            echo esc_attr( $prop_bath ).' '. esc_attr( $prop_bath_lebel );
	            echo '</li>';
	        }
	        if( !empty( $prop_size ) ) {

	            echo '<li>';
	            echo yani_property_size( 'after' );
	            echo '</li>';
	        }

    }

    	public function get_user_num_posted_featured_listings( $userID ) {

	        $args = array(
	            'post_type'     =>  'property',
	            'post_status'   =>  'any',
	            'author'        =>  $userID,
	            'meta_query'    =>  array(
	                array(
	                    'key'   => 'yani_featured',
	                    'value' => 1,
	                    'meta_compare '=>'='
	                )
	            )
	        );
	        $posts = new WP_Query( $args );
	        return $posts->found_posts;
	        wp_reset_postdata();

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

function _yani_listing() {
	return _Yani_Listing_Helper::get_instance();
}