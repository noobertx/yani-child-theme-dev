<?php
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! class_exists( '_Yani_Property_Helper' ) ) {
	class _Yani_Property_Helper{
		private static $instance = null;

		

	    public function get_details_section_fields() {
	        $array = array(
	            'beds',
	            'baths',
	            'rooms',
	            'area-size',
	            'area-size-unit',
	            'land-area',
	            'land-area-unit',
	            'garage',
	            'garage-size',
	            'property-id',
	            'year'
	        );
	        return $array;
	    }

	    public function get_property_price ( $listing_price ) {

        	$final_price="";
            if( $listing_price ) {
                $listing_price = _yani_price()->get_clean_price_20($listing_price);
                
                $currency_maker = _yani_price()->currency_maker();

                $listings_currency = $currency_maker['currency'];
                $price_decimals = $currency_maker['decimals'];
                $listing_currency_pos = $currency_maker['currency_position'];
                $price_thousands_separator = $currency_maker['thousands_separator'];
                $price_decimal_point_separator = $currency_maker['decimal_point_separator'];
            
                $short_prices = _yani_theme()->get_option('short_prices');

                if($short_prices != 1 ) {

                    $listing_price = doubleval( $listing_price );
                    if ( class_exists( 'FCC_Rates' ) && _yani_theme()->check_theme_option("currency_switcher_enable") && isset( $_COOKIE[ "yani_set_current_currency" ] ) ) {

                        $listing_price = apply_filters( 'yani_currency_switcher_filter', $listing_price );
                        return $listing_price;
                    }               


                } else {
                    $final_price = yani_number_shorten($listing_price, $price_decimals);
                }
                if(  $listing_currency_pos == 'before' ) {
                    return $listings_currency . $final_price;
                } else {
                    return $final_price . $listings_currency;
                }

            } else {
                $listings_currency = '';
            }

            return $listings_currency;
        }

        public function get_v1_4_meta_type() {
            $v1_4_meta_type = _yani_theme()->get_option('v1_4_meta_type');
            if($v1_4_meta_type == 'icons') {
                $icons_class = 'item-amenities-with-icons';
            } elseif($v1_4_meta_type == 'text') {
                $icons_class = 'item-amenities-without-icons';
            } else {
                $icons_class = '';
            }

            return $icons_class;
        } 

        public function get_v2_meta_type() {
            $v2_meta_type = _yani_theme()->get_option('v2_meta_type');
            if($v2_meta_type == 'icons') {
                $icons_class = 'item-amenities-with-icons';
            } elseif($v2_meta_type == 'without_icons') {
                $icons_class = 'item-amenities-without-icons';
            } else {
                $icons_class = '';
            }

            return $icons_class;
        } 

        public function hide_calculator() {
            $term_status = wp_get_post_terms( get_the_ID(), 'property_status', array("fields" => "all"));

            if ( ! empty( $term_status ) && ! is_wp_error( $term_status ) ) {

                $cal_where = _yani_theme()->get_option('cal_where');
                if( empty($cal_where) ) {
                    $cal_where = array();
                }
                
                if( in_array( $term_status[0]->term_id, $cal_where ) ) {
                    return false;
                }
            }
           
            return true;
        }

        public function get_property_agent($prop_id) {

            $agent_display_option = get_post_meta( $prop_id, 'yani_agent_display_option', true );
            $prop_agent_display = get_post_meta( $prop_id, 'yani_agents', true );
            $listing_agent = '';
            $prop_agent_num = $agent_num_call = $prop_agent = $prop_agent_link = $property_agent = '';
            if( $prop_agent_display != '-1' && $agent_display_option == 'agent_info' ) {

                $prop_agent_ids = get_post_meta( $prop_id, 'yani_agents' );
                // remove invalid ids
                $prop_agent_ids = array_filter( $prop_agent_ids, function($hz){
                    return ( $hz > 0 );
                });

                $prop_agent_ids = array_unique( $prop_agent_ids );

                if ( ! empty( $prop_agent_ids ) ) {
                    $agents_count = count( $prop_agent_ids );
                    $listing_agent = array();
                    foreach ( $prop_agent_ids as $agent ) {
                        if ( 0 < intval( $agent ) ) {
                            $agent_args = array();
                            $agent_args[ 'agent_id' ] = intval( $agent );
                            $agent_args[ 'agent_name' ] = get_the_title( $agent_args[ 'agent_id' ] );
                            $agent_args[ 'agent_mobile' ] = get_post_meta( $agent_args[ 'agent_id' ], 'yani_agent_mobile', true );
                            $agent_num_call = str_replace(array('(',')',' ','-'),'', $agent_args[ 'agent_mobile' ]);
                            $agent_args[ 'agent_email' ] = get_post_meta( $agent_args[ 'agent_id' ], 'yani_agent_email', true );
                            $agent_args[ 'link' ] = get_permalink($agent_args[ 'agent_id' ]);
                            $listing_agent[] = _yani_agent()->get_agent_info( $agent_args, 'for_grid_list' );
                        }
                    }
                }

            } elseif( $agent_display_option == 'agency_info' ) {

                $prop_agency_ids = get_post_meta( $prop_id, 'yani_property_agency' );
                // remove invalid ids
                $prop_agency_ids = array_filter( $prop_agency_ids, function($hz){
                    return ( $hz > 0 );
                });

                $prop_agency_ids = array_unique( $prop_agency_ids );

                if ( ! empty( $prop_agency_ids ) ) {
                    $agency_count = count( $prop_agency_ids );
                    $listing_agent = array();
                    foreach ( $prop_agency_ids as $agency ) {
                        if ( 0 < intval( $agency ) ) {
                            $agency_args = array();
                            $agency_args[ 'agent_id' ] = intval( $agency );
                            $agency_args[ 'agent_name' ] = get_the_title( $agency_args[ 'agent_id' ] );
                            $agency_args[ 'agent_mobile' ] = get_post_meta( $agency_args[ 'agent_id' ], 'yani_agency_mobile', true );
                            $agent_num_call = str_replace(array('(',')',' ','-'),'', $agency_args[ 'agent_mobile' ]);
                            $agency_args[ 'agent_email' ] = get_post_meta( $agency_args[ 'agent_id' ], 'yani_agency_email', true );
                            $agency_args[ 'link' ] = get_permalink($agency_args[ 'agent_id' ]);
                            $listing_agent[] = _yani_agent()->get_agent_info( $agency_args, 'for_grid_list' );
                        }
                    }
                }

            } else {

                $listing_agent = array();
                $author_args = array();
                $author_args[ 'agent_name' ] = get_the_author();
                $author_args[ 'agent_mobile' ] = get_the_author_meta( 'yani_author_mobile' );
                $agent_num_call = str_replace(array('(',')',' ','-'),'', get_the_author_meta( 'yani_author_mobile' ));
                $author_args[ 'agent_email' ] = get_the_author_meta( 'email' );
                $author_args[ 'link' ] = get_author_posts_url( get_the_author_meta( 'ID' ) );

                $listing_agent[] = _yani_agent()->get_agent_info( $author_args, 'for_grid_list' );
            }
            return $listing_agent;
        }

    	public  function propperty_id_prefix( $property_id ) {
	        $property_id_prefix = _yani_theme()->get_option('property_id_prefix');
	        if( !empty( $property_id_prefix ) ) {
	            $property_id = $property_id_prefix.$property_id;
	        }
	        return $property_id;
	    }


	    public function get_agent_info_bottom( $args, $type, $is_single = true ) {

            $view_listing = _yani_theme()->get_option('agent_view_listing');
            $agent_phone_num = _yani_theme()->get_option('agent_phone_num');
            if( empty($args['agent_name']) ) {
                return '';
            }
            if( $type == 'for_grid_list' ) {
                return '<a href="'.$args[ 'link' ].'">'.$args[ 'agent_name' ].'</a> ';

            } elseif( $type == 'agent_form' ) {
                $output = '';

                $output .= '<div class="agent-details">';
                    $output .= '<div class="d-flex align-items-center">';
                        
                        $output .= '<div class="agent-image">';
                            if ( $is_single == false ) :
                                $output .= '<input type="checkbox" checked="checked" class="houzez-hidden multiple-agent-check" name="target_email[]" value="' . $args['agent_email'] . '" >';
                            endif;
                            
                            $output .= '<a href="'.$args[ 'link' ].'">';
                                $output .= '<img class="rounded" src="'.$args[ 'picture' ].'" alt="'.$args[ 'agent_name' ].'" width="80" height="80">';
                            $output .= '</a>';
                        $output .= '</div>';

                        $output .= '<ul class="agent-information list-unstyled">';
                            
                            if ( !empty( $args[ 'agent_name' ] ) ) :
                            $output .= '<li class="agent-name">';
                                $output .= '<i class="yani-icon icon-single-neutral mr-1"></i> '.$args[ 'agent_name' ];
                            $output .= '</li>';
                            endif;


                            $output .= '<li class="agent-phone-wrap clearfix">';

                                if ( !empty( $args[ 'agent_phone' ] ) && _yani_theme()->get_option('agent_phone_num', 1) ) :
                                $output .= '<i class="yani-icon icon-phone mr-1"></i>';
                                $output .= '<span class="agent-phone '.yani_get_show_phone().'">';
                                     $output .= '<a href="tel:'.esc_attr( $args[ 'agent_phone_call' ] ).'">'.esc_attr($args[ 'agent_phone' ]).'</a>';
                                $output .= '</span>';
                                endif;

                                if ( !empty( $args[ 'agent_mobile' ] ) && _yani_theme()->get_option('agent_mobile_num', 1) ) :
                                $output .= '<i class="yani-icon icon-mobile-phone mr-1"></i>';
                                $output .= '<span class="agent-phone '.yani_get_show_phone().'">';
                                     $output .= '<a href="tel:'.esc_attr( $args[ 'agent_mobile_call' ] ).'">'.esc_attr($args[ 'agent_mobile' ]).'</a>';
                                $output .= '</span>';
                                endif;

                                if ( !empty( $args[ 'agent_skype' ] ) && $args[ 'agent_skype' ] != "#" && _yani_theme()->get_option('agent_skype_con', 1) ) :
                                $output .= '<i class="yani-icon icon-video-meeting-skype mr-1"></i>';
                                $output .= '<span>';
                                     $output .= '<a href="skype:'.esc_attr( $args[ 'agent_skype' ] ).'?call">'.esc_attr( $args[ 'agent_skype' ] ).'</a>';
                                $output .= '</span>';
                                endif;

                                if ( !empty( $args[ 'agent_whatsapp' ] ) && _yani_theme()->get_option('agent_whatsapp_num', 1) ) :
                                $output .= '<i class="yani-icon icon-messaging-whatsapp mr-1"></i>';
                                $output .= '<span>';
                                     $output .= '<a target="_blank" href="https://api.whatsapp.com/send?phone='.esc_attr( $args[ 'agent_whatsapp_call' ] ).'&text='._yani_theme()->get_option('spl_con_interested', "Hello, I am interested in").' ['.get_the_title().'] '.get_permalink().'">'.esc_html__('WhatsApp', _yani_theme()->get_text_domain()).'</a>';
                                $output .= '</span>';
                                endif;

                            $output .= '</li>';


                            if( _yani_theme()->get_option('agent_con_social', 1) ) {
                                $output .= '<li class="agent-social-media">';
                                    
                                    if( !empty( $args[ 'facebook' ] ) ) :
                                    $output .= '<span>';
                                        $output .= '<a class="btn-facebook" target="_blank" href="'.esc_url($args['facebook']).'">';
                                            $output .= '<i class="yani-icon icon-social-media-facebook mr-2"></i>';
                                        $output .= '</a>';
                                    $output .= '</span>';
                                    endif;
                                    
                                    if( !empty( $args[ 'instagram' ] ) ) :
                                    $output .= '<span>';
                                        $output .= '<a class="btn-instagram" target="_blank" href="'.esc_url($args['instagram']).'">';
                                            $output .= '<i class="yani-icon icon-social-instagram mr-2"></i>';
                                        $output .= '</a>';
                                    $output .= '</span>';
                                    endif;

                                    if( !empty( $args[ 'twitter' ] ) ) :
                                    $output .= '<span>';
                                        $output .= '<a class="btn-twitter" target="_blank" href="'.esc_url($args['twitter']).'">';
                                            $output .= '<i class="yani-icon icon-social-media-twitter mr-2"></i>';
                                        $output .= '</a>';
                                    $output .= '</span>';
                                    endif;

                                    if( !empty( $args[ 'linkedin' ] ) ) :
                                    $output .= '<span>';
                                        $output .= '<a class="btn-linkedin" target="_blank" href="'.esc_url($args['linkedin']).'">';
                                            $output .= '<i class="yani-icon icon-professional-network-linkedin mr-2"></i>';
                                        $output .= '</a>';
                                    $output .= '</span>';
                                    endif;

                                    if( !empty( $args[ 'googleplus' ] ) ) :
                                    $output .= '<span>';
                                        $output .= '<a class="btn-google-plus" target="_blank" href="'.esc_url($args['googleplus']).'">';
                                            $output .= '<i class="yani-icon icon-social-media-google-plus-1 mr-2"></i>';
                                        $output .= '</a>';
                                    $output .= '</span>';
                                    endif;

                                    if( !empty( $args[ 'youtube' ] ) ) :
                                    $output .= '<span>';
                                        $output .= '<a class="btn-youtube" target="_blank" href="'.esc_url($args['youtube']).'">';
                                           $output .= '<i class="yani-icon icon-social-video-youtube-clip mr-2"></i>';
                                        $output .= '</a>';
                                    $output .= '</span>';
                                    endif;

                                $output .= '</li>';
                            }
                        $output .= '</ul>';
                    $output .= '</div>';
                $output .= '</div>';


                return $output;

            }

        }

        public function delete_property_attachments($postid) {
            
            // We check if the global post type isn't ours and just return
            global $post_type;

            if ($post_type == 'yani_reviews') {
                _yani_listings()->adjust_listing_rating_on_delete($postid); 
            }

           
            if ($post_type == 'property') {
                $media = get_children(array(
                    'post_parent' => $postid,
                    'post_type' => 'attachment'
                ));
                if (!empty($media)) {
                    foreach ($media as $file) {
                        wp_delete_attachment($file->ID);
                    }
                }
                $attachment_ids = get_post_meta($postid, 'yani_property_images', false);
                if (!empty($attachment_ids)) {
                    foreach ($attachment_ids as $id) {
                        wp_delete_attachment($id);
                    }
                }
            }
            return;
        }

        public function delete_property_attachments_frontend($postid) {
                
            // We check if the global post type isn't ours and just return
            global $post_type;

            $media = get_children(array(
                'post_parent' => $postid,
                'post_type' => 'attachment'
            ));
            if (!empty($media)) {
                foreach ($media as $file) {
                    wp_delete_attachment($file->ID);
                }
            }
            $attachment_ids = get_post_meta($postid, 'yani_property_images', false);
            if (!empty($attachment_ids)) {
                foreach ($attachment_ids as $id) {
                    wp_delete_attachment($id);
                }
            }
            return;
        }

        public function get_area_unit_label() {
            $measurement_unit_adv_search = _yani_theme()->get_option('measurement_unit_adv_search');

            if( $measurement_unit_adv_search == 'sqft' ) {
                $measurement_unit_adv_search = _yani_theme()->get_option('measurement_unit_sqft_text');
            } elseif( $measurement_unit_adv_search == 'sq_meter' ) {
                $measurement_unit_adv_search = _yani_theme()->get_option('measurement_unit_square_meter_text');
            }

            return $measurement_unit_adv_search;
        }

        public function get_meta($index, $term_id = false, $field = false ) {

            $defaults = array(
                'color_type' => 'inherit',
                'color' => '#000000',
                'ppp' => ''
            );

            if ( $term_id ) {
                $meta = get_option( $field.$term_id );
                $meta = wp_parse_args( (array) $meta, $defaults );
            } else {
                $meta = $defaults;
            }

            if ( $field ) {
                if ( isset( $meta[$field] ) ) {
                    return $meta[$field];
                } else {
                    return false;
                }
            }
            return $meta;
        }

        public function update_property_colors( $option,$cat_id, $color, $type ) {

            $colors = (array)get_option( 'yani_cat_colors' );

            if ( array_key_exists( $cat_id, $colors ) ) {

                if ( $type == 'inherit' ) {
                    unset( $colors[$cat_id] );
                } elseif ( $colors[$cat_id] != $color ) {
                    $colors[$cat_id] = $color;
                }

            } else {

                if ( $type != 'inherit' ) {
                    $colors[$cat_id] = $color;
                }
            }

            update_option( $option, $colors );

        }

        public  function render_number_list($list_for) {
            $num_array = array(1,2,3,4,5,6,7,8,9,10);
            $searched_num = '';

            if( $list_for == 'bedrooms' ) {
                if( isset( $_GET['bedrooms'] ) ) {
                    $searched_num = $_GET['bedrooms'];
                }

                $adv_beds_list = _yani_theme()->get_option('adv_beds_list');
                if( !empty($adv_beds_list) ) {
                    $adv_beds_list_array = explode( ',', $adv_beds_list );

                    if( is_array( $adv_beds_list_array ) && !empty( $adv_beds_list_array ) ) { 
                        $temp_adv_beds_list_array = array();
                        foreach( $adv_beds_list_array as $beds ) {
                            $temp_adv_beds_list_array[] = $beds;
                        }

                        if( !empty( $temp_adv_beds_list_array ) ) {
                            $num_array = $temp_adv_beds_list_array;
                        }
                    }
                }
            }

            if( $list_for == 'bathrooms' ) {
                if( isset( $_GET['bathrooms'] ) ) {
                    $searched_num = $_GET['bathrooms'];
                }

                $adv_baths_list = _yani_theme()->get_option('adv_baths_list');
                if( !empty($adv_baths_list) ) {
                    $adv_baths_list_array = explode( ',', $adv_baths_list );

                    if( is_array( $adv_baths_list_array ) && !empty( $adv_baths_list_array ) ) {
                        $temp_adv_baths_list_array = array();
                        foreach( $adv_baths_list_array as $baths ) {
                            $temp_adv_baths_list_array[] = $baths;
                        }

                        if( !empty( $temp_adv_baths_list_array ) ) {
                            $num_array = $temp_adv_baths_list_array;
                        }
                    }
                }
            }

            if( $list_for == 'rooms' ) {
                if( isset( $_GET['rooms'] ) ) {
                    $searched_num = $_GET['rooms'];
                }

                $adv_rooms_list = _yani_theme()->get_option('adv_rooms_list');
                if( !empty($adv_rooms_list) ) {
                    $adv_rooms_list_array = explode( ',', $adv_rooms_list );

                    if( is_array( $adv_rooms_list_array ) && !empty( $adv_rooms_list_array ) ) {
                        $temp_adv_rooms_list_array = array();
                        foreach( $adv_rooms_list_array as $rooms ) {
                            $temp_adv_rooms_list_array[] = $rooms;
                        }

                        if( !empty( $temp_adv_rooms_list_array ) ) {
                            $num_array = $temp_adv_rooms_list_array;
                        }
                    }
                }
            }

            if( !empty( $num_array ) ) {
                $num_array = array_filter($num_array, 'strlen');

                foreach( $num_array as $num ){
                    $option_label = '';
                    
                    $option_label = $num;

                    if( $num == '0' ) {
                        $option_label = _yani_theme()->get_option('srh_studio', 'Studio');
                    }

                    if( $searched_num == $num ) {
                        echo '<option value="'.esc_attr( $num ).'" selected="selected">'.esc_attr( $option_label ).'</option>';
                    } else {
                        echo '<option value="'.esc_attr( $num ).'">'.esc_attr( $option_label ).'</option>';
                    }
                }
            }

            $any_text = _yani_theme()->get_option('srh_any', esc_html__( 'Any', _yani_theme()->get_text_domain()));

            if( $searched_num == 'any' )  {
                echo '<option value="any" selected="selected">'.$any_text.'</option>';
            } else {
                echo '<option value="any">'.$any_text.'</option>';
            }

        }

        public function get_land_area_size( $propID ) {
            $prop_area_size = '';
            $prop_size     = get_post_meta( $propID, 'yani_property_land', true );
            $base_area = _yani_theme()->get_option('yani_base_area');

            if( !empty( $prop_size ) ) {

                if( isset( $_COOKIE[ "yani_current_area" ] ) ) {
                    if( $_COOKIE[ "yani_current_area" ] == 'sq_meter' && $base_area != 'sq_meter'  ) {
                        $prop_size = $prop_size * 0.09290304; //m2 = ft2 x 0.09290304

                    } elseif( $_COOKIE[ "yani_current_area" ] == 'sqft' && $base_area != 'sqft' ) {
                        $prop_size = $prop_size / 0.09290304; //ft2 = m2 ÷ 0.09290304
                    }
                }

                $prop_area_size = esc_attr( round($prop_size, 3) );

            }
            return $prop_area_size;

        }

        public function get_land_size_unit( $propID ) {
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
                    $prop_size_prefix = get_post_meta( $propID, 'yani_property_land_postfix', true);
                }
            }
            return $prop_size_prefix;
        }

       public function get_property_size( $position ) {

            $propID = get_the_ID();
            if( $position == 'before' ) {
                $prop_size = _yani_listing()->get_size_unit( $propID ).' '._yani_listing()->get_area_size( $propID );
            } else {
                $prop_size = _yani_listing()->get_area_size( $propID ).' '._yani_listing()->get_size_unit( $propID );
            }
            return  $prop_size;
        }


        public function get_property_land_area( $position ) {

            $propID = get_the_ID();
            $land_area_unit = get_post_meta( $propID, 'yani_property_land_postfix', true);
            $land_area = get_post_meta( $propID, 'yani_property_land', true);

            if( $position == 'before' ) {
                $prop_size = _yani_listing()->get_size_unit( $propID ).' '._yani_listing()->get_area_size( $propID );
            } else {
                $prop_size = _yani_listing()->get_area_size( $propID ).' '._yani_listing()->get_size_unit( $propID );
            }
            return  $prop_size;
        }

        public function get_property_size_by_id( $propID, $position ) {

            // Since v1.3.0
            if( $position == 'before' ) {
                $prop_size = _yani_listing()->get_size_unit( $propID ).' '._yani_listing()->get_area_size( $propID );
            } else {
                $prop_size = _yani_listing()->get_area_size( $propID ).' '._yani_listing()->get_size_unit( $propID );
            }
            return  $prop_size;
        }

        public function get_property_land_area_by_id( $propID, $position ) {

            // Since v1.3.0
            if( $position == 'before' ) {
                $prop_size = _yani_listing()->get_size_unit( $propID ).' '._yani_listing()->get_area_size( $propID );
            } else {
                $prop_size = _yani_listing()->get_area_size( $propID ).' '._yani_listing()->get_size_unit( $propID );
            }
            return  $prop_size;
        }


        public function render_property_slider_meta()    {
            $propID = get_the_ID();
            $prop_bed     = get_post_meta( get_the_ID(), 'yani_property_bedrooms', true );
            $prop_bath     = get_post_meta( get_the_ID(), 'yani_property_bathrooms', true );
            $prop_size     = get_post_meta( get_the_ID(), 'yani_property_size', true );

            $measurement_unit_global = _yani_theme()->get_option('measurement_unit_global');
            if( $measurement_unit_global == 1 ) {
                $prop_size_prefix = _yani_theme()->get_option('measurement_unit');
            } else {
                $prop_size_prefix = get_post_meta(get_the_ID(), 'yani_property_size_prefix', true);
            }

            echo '<ul class="list-inline">';
            if( !empty( $prop_bed ) ) {
                $prop_bed = esc_attr( $prop_bed );
                $prop_bed_lebel = ($prop_bed > 1 ) ? esc_html__( 'Beds', 'houzez' ) : esc_html__( 'Bed', 'houzez' );

                echo '<li>';
                echo '<strong>'.$prop_bed_lebel .':</strong> '. $prop_bed;
                echo '</li>';
            }
            if( !empty( $prop_bath ) ) {
                $prop_bath = esc_attr( $prop_bath );
                $prop_bath_lebel = ($prop_bath > 1 ) ? esc_html__( 'Baths', 'houzez' ) : esc_html__( 'Bath', 'houzez' );

                echo '<li>';
                echo '<strong>'.$prop_bath_lebel .'</strong> '. $prop_bath;
                echo '</li>';
            }
            if( !empty( $prop_size ) ) {
                $prop_size = esc_attr( $prop_size );

                echo '<li>';
                echo '<strong>'._yani_listing()->get_size_unit( $propID ) .':</strong> '. _yani_listing()->get_area_size( $propID );
                echo '</li>';
            }
            echo '</ul>';

        }

        public function update_property_from_draft( $property_id ) {
            $listings_admin_approved = yani_theme()->get_option('listings_admin_approved');

            if( $listings_admin_approved != 'yes' ) {
                $prop_status = 'publish';
            } else {
                $prop_status = 'pending';
            }

            $updated_property = array(
                'ID' => $property_id,
                'post_type' => 'property',
                'post_status' => $prop_status
            );
            $prop_id = wp_update_post( $updated_property );
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

function _yani_property() {
	return _Yani_Property_Helper::get_instance();
}