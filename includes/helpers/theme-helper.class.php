<?php
if ( ! defined( 'WPINC' ) ) {
	die;
}
if ( ! class_exists( '_Yani_Theme_Helper' ) ) {
	class _Yani_Theme_Helper{
		private static $instance = null;
		private $text_domain = "yani";

		public function init(){
			add_filter( 'style_loader_src', array($this,'remove_wp_ver_css_js'), 9999 );
			add_filter( 'script_loader_src', array($this,'remove_wp_ver_css_js'), 9999 );
			add_filter('redirect_canonical', array($this,'disable_redirect_canonical'));
			// add_action('widgets_init', array($this,'remove_recent_comments_style'));

    		add_action( 'elementor/theme/register_locations', array($this,'register_elementor_templates_locations' ));
    		add_filter('wp_dropdown_users', array($this,'author_override'));

			add_filter('body_class', array($this,'browser_body_class'));

			if ( !defined('WPSEO_VERSION') && !class_exists('NY_OG_Admin')) {
        		add_action( 'wp_head', array($this,'add_opengraph'), 5 );
    		}
		}
		

		public function get_option( $id, $fallback = false, $param = false ) {
			if ( isset( $_GET['yani_'.$id] ) ) {
				if ( '-1' == $_GET['yani_'.$id] ) {
					return false;
				} else {
					return $_GET['yani_'.$id];
				}
			} else {
				global $yani_option;
				if ( $fallback == false ) $fallback = '';
				$output = ( isset($yani_option[$id]) && $yani_option[$id] !== '' ) ? $yani_option[$id] : $fallback;
				if ( !empty($yani_option[$id]) && $param ) {
					$output = $yani_option[$id][$param];
				}
			}
			return $output;
		} 

		public function get_date() {
        	return date_i18n( get_option('date_format') );
    	}

    	public  function get_time() {
        	return date_i18n( get_option('time_format') );
    	}

		public function get_text_domain(){
			return $this->text_domain;
		}

		public function is_woocommerce() {

	        if( $this->get_option('yani_payment_gateways', 'yani_custom_gw') == 'gw_woocommerce' && class_exists( 'WooCommerce' ) ) {
	            return true;
	        } else {
	            return false;
	        }
	    }   
	   
		

	    

   		public function is_elementor(){
	        global $post;
	        if ( did_action( 'elementor/loaded' ) ) {
	            return \Elementor\Plugin::$instance->db->is_built_with_elementor($post->ID);
	        }
	        return false;
	    }

	    public function minify_js() {
	        $minify_js = $this->option('minify_js');
	        $js_minify_prefix = '';
	        if ($minify_js != 0) {
	            $js_minify_prefix = '.min';
	        }
	        return $js_minify_prefix;
	    }

	    public function remove_wp_ver_css_js( $src ) {
        	if ( $this->get_option( 'remove_scripts_version', '1' ) ) {
            	if ( strpos( $src, 'ver=' ) ) {
                	$src = remove_query_arg( 'ver', $src );
            	}
        	}
        	return $src;
    	}

    	public function disable_redirect_canonical($redirect_url)    {

	        if (is_singular(array('yani_agent', 'yani_agency'))) {
	            $redirect_url = false;
	        }

	        return $redirect_url;
	    }

	    public  function wpml_translate_single_string($string_name) {
	        $translated_string = apply_filters('wpml_translate_single_string', $string_name, 'yani_cfield', $string_name );

	        return $translated_string;
	    }

	    public function  update_recent_colors( $color, $num_col = 10 ) {
	        if ( empty( $color ) )
	            return false;

	        $current = get_option( 'yani_recent_colors' );
	        if ( empty( $current ) ) {
	            $current = array();
	        }

	        $update = false;

	        if ( !in_array( $color, $current ) ) {
	            $current[] = $color;
	            if ( count( $current ) > $num_col ) {
	                $current = array_slice( $current, ( count( $current ) - $num_col ), ( count( $current ) - 1 ) );
	            }
	            $update = true;
	        }

	        if ( $update ) {
	            update_option( 'yani_recent_colors', $current );
	        }
	    }





	    public function http_or_https() {
	        if (is_ssl()) {
	            $http_or_https = 'https';
	        } else {
	            $http_or_https = 'http';
	        }

	        return $http_or_https;
	    }

	    public function objectToArray ($object) {

	        if(!is_object($object) && !is_array($object))
	            return $object;

	        return array_map(array($this,'objectToArray'), (array) $object);
	    }

	    public function add_opengraph() {
	        if ( is_singular( 'property' ) ) {

	            global $post;
	            if ( has_excerpt( $post->ID ) ) {
	                $description = strip_tags( get_the_excerpt() );
	            } else {
	                $description = str_replace( "\r\n", ' ', substr( strip_tags( strip_shortcodes( $post->post_content ) ), 0, 160 ) );
	            }
	            if ( empty( $description ) ) {
	                $description = get_bloginfo( 'description' );
	            }

	            echo '<meta property="og:title" content="' . get_the_title() . '"/>';
	            echo '<meta property="og:description" content="' . $description . '" />';
	            echo '<meta property="og:type" content="article"/>';
	            echo '<meta property="og:url" content="' . get_permalink() . '"/>';
	            echo '<meta property="og:site_name" content="' . get_bloginfo( 'name' ) . '"/>';
	            if ( has_post_thumbnail( $post->ID ) ) {
	                $thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
	                if( !empty($thumbnail_src) ) {
	                    echo '<meta property="og:image" content="' . esc_attr( $thumbnail_src[ 0 ] ) . '"/>';
	                }
	            }

	        }
	    }


	    public function clean($string)    {
        	$string = preg_replace('/&#36;/', '', $string);
        	$string = preg_replace('/[^A-Za-z0-9\-]/', '', $string);
        	$string = preg_replace('/\D/', '', $string);
        	return $string;
    	}

    	public function clean_20($string) {
       		$string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
	       return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
	    }


	    public function array_to_comma( $arr_array = array() ) {
        
	       if ( !empty($arr_array) ) {
	            
	            $temp_array = array();
	 
	            foreach ( $arr_array as $item ) {

	                $item = $this->wpml_translate_single_string($item);
	                $temp_array[] = $item;
	            }
	                                 
	            $result = join( ", ", $temp_array );
	            return $result;
	        }
	        return '';
	    }

	    public function register_elementor_templates_locations( $elementor_theme_manager ) {

	        $elementor_theme_manager->register_location( 'header' );
	        $elementor_theme_manager->register_location( 'footer' );
	        $elementor_theme_manager->register_location( 'single' );
	        $elementor_theme_manager->register_location( 'archive' );
	    }


	    public function check_classic_editor() {
	        if( class_exists('Classic_Editor') || isset( $_GET['classic-editor'] ) ) {
	            return true;
	        }
	        return false;
	    }

		public function check_theme_option($option,$value=true,$return=true) {
	        if( $this->get_option($option, $value) ) {
	            return $return;
	        }
	        return '';
	    }

		public function is_ajax_request() {
        	if ( ! empty( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && strtolower( $_SERVER['HTTP_X_REQUESTED_WITH'] ) == 'xmlhttprequest' ) {
            	return true;
        	}
        	return false;
    	}

    	

    	public function get_get_local() {
	        $local = get_locale();
	        $local = explode('_', $local);

	        if( isset( $local[0] ) && !empty($local[0]) ) {
	            return $local[0];
	        }
	        
	        return 'en';
	    }

	   	public function enable_svg_type($mimes) {
      		$mimes['svg'] = 'image/svg+xml';
      		return $mimes;
    	}

    	

	    

	    public function generate_unique_key(){

	        $key = uniqid();
	        return $key;
	    }

	    public function browser_body_class($classes) {
        global $post;
        
        if(_yani_template()->is_dashboard()) {
            $classes[] = 'yani-dashboard';
        }    
        
        if ( is_page_template( 'template/template-onepage.php' ) ) {
            $classes[] = 'yani-onepage-mode';
        }

        if( _yani_template()->is_half_map() ) {
            $classes[] = 'yani-halfmap-page';
        }

        $yani_head_trans = 'no';

        $classes[] = $this->get_header_style();

        // if( _yani_template()->is_postid_needed() ) {
        //     $header_type = get_post_meta($post->ID, 'yani_header_type', true);
        //     print_r($header_type );
        //     $yani_page_header_search = get_post_meta($post->ID, 'yani_page_header_search', true);
        //     if ($yani_page_header_search != 'yes') {
        //         $yani_head_trans = get_post_meta($post->ID, 'yani_main_menu_trans', true);

        //         $classes[] = 'transparent-'.$yani_head_trans;
        //     }
        //     $classes[] = 'yani-header-'.$header_type;
        // }
            
        return $classes;
    }

    public function return_formatted_date($date_unix) {

        $return_date = '';
        if(!empty($date_unix)) {
            $return_date = date(get_option( 'date_format' ), $date_unix);
        }
        return $return_date;
        
    }

    public function get_formatted_time($date_unix) {

        $return_time = '';
        if(!empty($date_unix)) {
            $return_time = date(get_option( 'time_format' ), $date_unix);
        }
        return $return_time;
        
    }

    public function traverse_comma_string($string) {
        if(!empty($string)) {
            $string_array = explode(',', $string);
            
            if(!empty($string_array[0])) {
                return $string_array;
            }
        }
        return '';
    }


    public function get_localization() {


		$localization = array(

			/*------------------------------------------------------
			* Theme
			*------------------------------------------------------*/
			'choose_currency' 			=> esc_html__( 'Choose Currency', $this->get_text_domain() ),
			'disable' 			=> esc_html__( 'Disable', $this->get_text_domain() ),
			'enable' 			=> esc_html__( 'Enable', $this->get_text_domain() ),
			'any' 				=> esc_html__( 'Any', $this->get_text_domain() ),
			'none'				=> esc_html__( 'None', $this->get_text_domain() ),
			'by_text' 			=> esc_html__( 'by', $this->get_text_domain() ),
			'at_text' 			=> esc_html__( 'at', $this->get_text_domain() ),
			'goto_dash' 		=> esc_html__( 'Go to Dashboard', $this->get_text_domain() ),
			'read_more' 		=> esc_html__( 'Read More', $this->get_text_domain() ),
			'continue_reading' 	=> esc_html__( 'Continue reading', $this->get_text_domain() ),
			'follow_us' 		=> esc_html__( 'Follow us', $this->get_text_domain() ),
			'property' 			=> esc_html__( 'Property', $this->get_text_domain() ),
			'properties' 		=> esc_html__( 'Properties', $this->get_text_domain() ),
			'404_page' 			=> esc_html__( 'Back to Homepage', $this->get_text_domain() ),
			'at' 				=> esc_html__( 'at', $this->get_text_domain() ),
			'licenses' 			=> esc_html__( 'License', $this->get_text_domain() ),
			'agent_license' 	=> esc_html__( 'Agent License', $this->get_text_domain() ),
			'tax_number' 		=> esc_html__( 'Tax Number', $this->get_text_domain() ),
			'languages' 		=> esc_html__( 'Language', $this->get_text_domain() ),
			'specialties_label' => esc_html__( 'Specialties', $this->get_text_domain() ),
			'service_area' 		=> esc_html__( 'Service Areas', $this->get_text_domain() ),
			'agency_agents' 	=> esc_html__( 'Agents:', $this->get_text_domain() ),
			'agency_properties' => esc_html__( 'Properties listed', $this->get_text_domain() ),
			'email' 			=> esc_html__( 'Email', $this->get_text_domain() ),
			'website' 			=> esc_html__( 'Website', $this->get_text_domain() ),
			'submit' 			=> esc_html__( 'Submit', $this->get_text_domain() ),
			'join_discussion' 	=> esc_html__( 'Join The Discussion', $this->get_text_domain() ),
			'your_name'	 		=> esc_html__( 'Your Name', $this->get_text_domain() ),
			'your_email'	 	=> esc_html__( 'Your Email', $this->get_text_domain() ),
			'blog_search'	 	=> esc_html__( 'Search', $this->get_text_domain() ),
			'featured'	 		=> esc_html__( 'Featured', $this->get_text_domain() ),
			'label_featured'	=> esc_html__( 'Featured', $this->get_text_domain() ),
			'view_my_prop'	 	=> esc_html__( 'View Listings', $this->get_text_domain() ),
			'office_colon'	 	=> esc_html__( 'Office', $this->get_text_domain() ),
			'mobile_colon'	 	=> esc_html__( 'Mobile', $this->get_text_domain() ),
			'fax_colon'	 	    => esc_html__( 'Fax', $this->get_text_domain() ),
			'email_colon'	 	=> esc_html__( 'Email', $this->get_text_domain() ),
			'follow_us'	 		=> esc_html__( 'Follow us', $this->get_text_domain() ),
			'type'		 		=> esc_html__( 'Type', $this->get_text_domain() ),
			'address'		 	=> esc_html__( 'Address', $this->get_text_domain() ),
			'city'		 		=> esc_html__( 'City', $this->get_text_domain() ),
			'state_county'      => esc_html__( 'State/County', $this->get_text_domain() ),
			'zip_post'		    => esc_html__( 'Zip/Post Code', $this->get_text_domain() ),
			'country'		    => esc_html__( 'Country', $this->get_text_domain() ),
			'prop_size'		    => esc_html__( 'Property Size', $this->get_text_domain() ),
			'prop_id'		    => esc_html__( 'Property ID', $this->get_text_domain() ),
			'garage'		    => esc_html__( 'Garage', $this->get_text_domain() ),
			'garage_size'		=> esc_html__( 'Garage Size', $this->get_text_domain() ),
			'year_built'		=> esc_html__( 'Year Built', $this->get_text_domain() ),
			'time_period'		=> esc_html__( 'Time Period', $this->get_text_domain() ),
			'unlimited_listings'=> esc_html__( 'Unlimited Listings', $this->get_text_domain() ),
			'featured_listings' => esc_html__( 'Featured Listings', $this->get_text_domain() ),
			'package_taxes' 	=> esc_html__( 'Tax', $this->get_text_domain() ),
			'get_started' 		=> esc_html__( 'Get Started', $this->get_text_domain() ),
			'save_search'	 	=> esc_html__( 'Save this Search?', $this->get_text_domain() ),
			'sort_by'		 	=> esc_html__( 'Sort by:', $this->get_text_domain() ),
			'default_order'	    => esc_html__( 'Default Order', $this->get_text_domain() ),
			'price_low_high'	=> esc_html__( 'Price (Low to High)', $this->get_text_domain() ),
			'price_high_low'	=> esc_html__( 'Price (High to Low)', $this->get_text_domain() ),
			'date_old_new'		=> esc_html__( 'Date Old to New', $this->get_text_domain() ),
			'date_new_old'		=> esc_html__( 'Date New to Old', $this->get_text_domain() ),
			'bank_transfer'		=> esc_html__( 'Direct Bank Transfer', $this->get_text_domain() ),
			'order_number'		=> esc_html__( 'Order Number', $this->get_text_domain() ),
			'payment_method' 	=> esc_html__( 'Payment Method', $this->get_text_domain() ),
			'date'				=> esc_html__( 'Date', $this->get_text_domain() ),
			'total'				=> esc_html__( 'Total', $this->get_text_domain() ),
			'submit'			=> esc_html__( 'Submit', $this->get_text_domain() ),
			'search_listing'	=> esc_html__( 'Search Listing', $this->get_text_domain() ),


			'view_all_results'	=> esc_html__( 'View All Results', $this->get_text_domain() ),
			'listins_found'		=> esc_html__( 'Listings found', $this->get_text_domain() ),
			'auto_result_not_found'		=> esc_html__( 'We didn’t find any results', $this->get_text_domain() ),
			'auto_view_lists'		=> esc_html__( 'View Listing', $this->get_text_domain() ),
			'auto_listings'		=> esc_html__( 'Listing', $this->get_text_domain() ),
			'auto_city'		=> esc_html__( 'City', $this->get_text_domain() ),
			'auto_area'		=> esc_html__( 'Area', $this->get_text_domain() ),
			'auto_state'		=> esc_html__( 'State', $this->get_text_domain() ),


			'search_invoices'	=> esc_html__( 'Search Invoices', $this->get_text_domain() ),
			'total_invoices'	=> esc_html__( 'Total Invoices:', $this->get_text_domain() ),
			'start_date'		=> esc_html__( 'Start date', $this->get_text_domain() ),
			'end_date'			=> esc_html__( 'End date', $this->get_text_domain() ),
			'invoice_type'		=> esc_html__( 'Type', $this->get_text_domain() ),
			'invoice_listing'	=> esc_html__( 'Listing', $this->get_text_domain() ),
			'invoice_package'	=> esc_html__( 'Package', $this->get_text_domain() ),
			'invoice_feat_list'		=> esc_html__( 'Listing with Featured', $this->get_text_domain() ),
			'invoice_upgrade_list'	=> esc_html__( 'Upgrade to Featured', $this->get_text_domain() ),
			'invoice_status'	=> esc_html__( 'Status', $this->get_text_domain() ),
			'paid'				=> esc_html__( 'Paid', $this->get_text_domain() ),
			'not_paid'			=> esc_html__( 'Not Paid', $this->get_text_domain() ),
			'order'				=> esc_html__( 'Order', $this->get_text_domain() ),
			'view_details'		=> esc_html__( 'View Details', $this->get_text_domain() ),
			'payment_details'	=> esc_html__( 'Payment details', $this->get_text_domain() ),
			'property_title'	=> esc_html__( 'Property Title', $this->get_text_domain() ),
			'billing_type'		=> esc_html__( 'Billing Type', $this->get_text_domain() ),
			'billing_for'		=> esc_html__( 'Billing For', $this->get_text_domain() ),
			'invoice_price'		=> esc_html__( 'Total Price:', $this->get_text_domain() ),
			'customer_details'	=> esc_html__( 'Customer details:', $this->get_text_domain() ),
			'customer_name'		=> esc_html__( 'Name:', $this->get_text_domain() ),
			'customer_email'	=> esc_html__( 'Email:', $this->get_text_domain() ),
			'search_agency_name'	=> esc_html__( 'Enter agency name', $this->get_text_domain() ),
			'search_agent_name'	=> esc_html__( 'Enter agent name', $this->get_text_domain() ),
			'search_agent_btn'	=> esc_html__( 'Search Agent', $this->get_text_domain() ),
			'search_agency_btn'	=> esc_html__( 'Search Agency', $this->get_text_domain() ),
			'all_agent_cats'	=> esc_html__( 'All Categories', $this->get_text_domain() ),
			'all_agent_cities'	=> esc_html__( 'All Cities', $this->get_text_domain() ),


			'saved_search_not_found'=> esc_html__( 'You don\'t have any saved search', $this->get_text_domain() ),
			'properties_not_found'=> esc_html__( 'You don\'t have any properties yet!', $this->get_text_domain() ),
			'favorite_not_found'=> esc_html__( 'You don\'t have any favorite properties yet!', $this->get_text_domain() ),
			'email_already_registerd' => esc_html__( 'This email address is already registered', $this->get_text_domain() ),
			'invalid_email' => esc_html__( 'Invalid email address.', $this->get_text_domain() ),
			'yani_plugin_required' => esc_html__( 'Please install and activate Houzez theme functionality plugin', $this->get_text_domain() ),

			// Agents
			'view_profile' => esc_html__( 'View Profile', $this->get_text_domain() ),

			/*------------------------------------------------------
			* Common
			*------------------------------------------------------*/
			'next_text' => esc_html__('Next', $this->get_text_domain()),
			'prev_text' => esc_html__('Prev', $this->get_text_domain()),
			'view_label' => esc_html__('View', $this->get_text_domain()),
			'views_label' => esc_html__('Views', $this->get_text_domain()),
			'visits_label' => esc_html__('Visits', $this->get_text_domain()),
			'unique_label' => esc_html__('Unique', $this->get_text_domain()),

			/*------------------------------------------------------
			* Custom Post Types
			*------------------------------------------------------*/


		);

		return $localization;
	}

	public function get_header_style($firstpartonly=false){
			$header_layout = false;
			$header_layout =  $this->get_option('header_style');
			if (strpos($header_layout, ',')) {

			// multiple header parameters

			$a_header_layout = explode(',', $header_layout);

			// return ONLY first parameter

			if ($firstpartonly) {
				return 'header-'.$a_header_layout[0];
			}

			foreach ((array)$a_header_layout as $key => $val) {
				$a_header_layout[$key] = 'header-'. $val;
			}
			
			$header = implode(' ', $a_header_layout);
			
			} else {
				// one parameter
				$header = 'header-'. $header_layout;
			}

			return $header;
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


function _yani_theme() {
	return _Yani_Theme_Helper::get_instance();
}

return _Yani_Theme_Helper::get_instance()->init();