<?php
class yani_Property_Listings{
	private static $instance = null;		

	function __construct() {
    	add_filter('yani_submit_listing', array($this,'submit_listing'));
    	add_action('wp_ajax_yani_property_on_hold', array($this,'property_on_hold' ));
    	add_action('wp_ajax_yani_relist_free', array($this,'relist_free'));
    	add_action('wp_ajax_nopriv_yani_property_clone', array($this,'property_clone' ));
		add_action('wp_ajax_yani_property_clone', array($this,'property_clone' ));
		add_action('wp_ajax_nopriv_yani_delete_property', array($this,'delete_property' ));
		add_action('wp_ajax_yani_delete_property', array($this,'delete_property' ));
  	}


	public function submit_listing($new_property) {

        $userID = get_current_user_id();
        $listings_admin_approved = _yani_theme()->get_option('listings_admin_approved');
        $edit_listings_admin_approved = _yani_theme()->get_option('edit_listings_admin_approved');
        $enable_paid_submission = _yani_theme()->get_option('enable_paid_submission');

        // Title
        if( isset( $_POST['prop_title']) ) {
            $new_property['post_title'] = sanitize_text_field( $_POST['prop_title'] );
        }

        if( $enable_paid_submission == 'membership' ) {
            $user_submit_has_no_membership = isset($_POST['user_submit_has_no_membership']) ? $_POST['user_submit_has_no_membership'] : '';
        } else {
            $user_submit_has_no_membership = 'no';
        }

        // Description
        if( isset( $_POST['prop_des'] ) ) {
            $new_property['post_content'] = wp_kses_post( $_POST['prop_des'] );
        }

        $new_property['post_author'] = $userID;

        $submission_action = $_POST['action'];
        $prop_id = 0;

        if( $submission_action == 'add_property' ) {

            if( _yani_user()->is_admin() ) {
                $new_property['post_status'] = 'publish';
            } else {
                if( $listings_admin_approved != 'yes' && ( $enable_paid_submission == 'no' || $enable_paid_submission == 'free_paid_listing' || $enable_paid_submission == 'membership' ) ) {
                    if( $user_submit_has_no_membership == 'yes' ) {
                        $new_property['post_status'] = 'draft';
                    } else {
                        $new_property['post_status'] = 'publish';
                    }
                } else {
                    if( $user_submit_has_no_membership == 'yes' && $enable_paid_submission = 'membership' ) {
                        $new_property['post_status'] = 'draft';
                    } else {
                        $new_property['post_status'] = 'pending';
                    }
                }
            }

            /*
             * Filter submission arguments before insert into database.
             */
            $new_property = apply_filters( 'yani_before_submit_property', $new_property );
            $prop_id = wp_insert_post( $new_property );

            if( $prop_id > 0 ) {
                $submitted_successfully = true;
                if( $enable_paid_submission == 'membership'){ // update package status
                    _yani_membership()->update_package_listings( $userID );
                }
            }

        } else if( $submission_action == 'update_property' ) {

            $new_property['ID'] = intval( $_POST['prop_id'] );

            if( get_post_status( intval( $_POST['prop_id'] ) ) == 'draft' ) {
                if( $enable_paid_submission == 'membership') {
                    _yani_membership()->update_package_listings($userID);
                }
                if( $listings_admin_approved != 'yes' && ( $enable_paid_submission == 'no' || $enable_paid_submission == 'free_paid_listing' || $enable_paid_submission == 'membership' ) ) {
                    $new_property['post_status'] = 'publish';
                } else {
                    $new_property['post_status'] = 'pending';
                }
            } elseif( $edit_listings_admin_approved == 'yes' ) {
                    $new_property['post_status'] = 'pending';
            }

            if( _yani_user()->is_admin() ) {
                $new_property['post_status'] = 'publish';
            }

            /*
             * Filter submission arguments before update property.
             */
            $new_property = apply_filters( 'yani_before_update_property', $new_property );
            $prop_id = wp_update_post( $new_property );

        }

        if( $prop_id > 0 ) {


            if(class_exists('yani_Fields_Builder')) {
                $fields_array = yani_Fields_Builder::get_form_fields();
                if(!empty($fields_array)):
                    foreach ( $fields_array as $value ):
                        $field_name = $value->field_id;
                        $field_type = $value->type;

                        if( isset( $_POST[$field_name] ) && !empty( $_POST[$field_name] ) ) {

                            if( $field_type == 'checkbox_list' || $field_type == 'multiselect' ) {
                                delete_post_meta( $prop_id, 'yani_'.$field_name );
                                foreach ( $_POST[ $field_name ] as $value ) {
                                    add_post_meta( $prop_id, 'yani_'.$field_name, sanitize_text_field( $value ) );
                                }
                            } else {
                                update_post_meta( $prop_id, 'yani_'.$field_name, sanitize_text_field( $_POST[$field_name] ) );
                            }

                        } else {
                            delete_post_meta( $prop_id, 'yani_'.$field_name );
                        }

                    endforeach; 
                endif;
            }


            if( $user_submit_has_no_membership == 'yes' ) {
                update_user_meta( $userID, 'user_submit_has_no_membership', $prop_id );
                update_user_meta( $userID, 'user_submitted_without_membership', 'yes' );
            }

            // Add price post meta
            if( isset( $_POST['prop_price'] ) ) {
                update_post_meta( $prop_id, 'yani_property_price', sanitize_text_field( $_POST['prop_price'] ) );

                if( isset( $_POST['prop_label'] ) ) {
                    update_post_meta( $prop_id, 'yani_property_price_postfix', sanitize_text_field( $_POST['prop_label']) );
                }
            }

            //price prefix
            if( isset( $_POST['prop_price_prefix'] ) ) {
                update_post_meta( $prop_id, 'yani_property_price_prefix', sanitize_text_field( $_POST['prop_price_prefix']) );
            }

            // Second Price
            if( isset( $_POST['prop_sec_price'] ) ) {
                update_post_meta( $prop_id, 'yani_property_sec_price', sanitize_text_field( $_POST['prop_sec_price'] ) );
            }

            // currency
            if( isset( $_POST['currency'] ) ) {
                update_post_meta( $prop_id, 'yani_currency', sanitize_text_field( $_POST['currency'] ) );
                if(class_exists('yani_Currencies')) {
                    $currencies = yani_Currencies::get_property_currency_2($prop_id, $_POST['currency']);

                    update_post_meta( $prop_id, 'yani_currency_info', $currencies );
                }
            }


            // Area Size
            if( isset( $_POST['prop_size'] ) ) {
                update_post_meta( $prop_id, 'yani_property_size', sanitize_text_field( $_POST['prop_size'] ) );
            }

            // Area Size Prefix
            if( isset( $_POST['prop_size_prefix'] ) ) {
                update_post_meta( $prop_id, 'yani_property_size_prefix', sanitize_text_field( $_POST['prop_size_prefix'] ) );
            }

            // Land Area Size
            if( isset( $_POST['prop_land_area'] ) ) {
                update_post_meta( $prop_id, 'yani_property_land', sanitize_text_field( $_POST['prop_land_area'] ) );
            }

            // Land Area Size Prefix
            if( isset( $_POST['prop_land_area_prefix'] ) ) {
                update_post_meta( $prop_id, 'yani_property_land_postfix', sanitize_text_field( $_POST['prop_land_area_prefix'] ) );
            }

            // Bedrooms
            if( isset( $_POST['prop_beds'] ) ) {
                update_post_meta( $prop_id, 'yani_property_bedrooms', sanitize_text_field( $_POST['prop_beds'] ) );
            }

            // Bedrooms
            if( isset( $_POST['prop_rooms'] ) ) {
                update_post_meta( $prop_id, 'yani_property_rooms', sanitize_text_field( $_POST['prop_rooms'] ) );
            }

            // Bathrooms
            if( isset( $_POST['prop_baths'] ) ) {
                update_post_meta( $prop_id, 'yani_property_bathrooms', sanitize_text_field( $_POST['prop_baths'] ) );
            }

            // Garages
            if( isset( $_POST['prop_garage'] ) ) {
                update_post_meta( $prop_id, 'yani_property_garage', sanitize_text_field( $_POST['prop_garage'] ) );
            }

            // Garages Size
            if( isset( $_POST['prop_garage_size'] ) ) {
                update_post_meta( $prop_id, 'yani_property_garage_size', sanitize_text_field( $_POST['prop_garage_size'] ) );
            }

            // Virtual Tour
            if( isset( $_POST['virtual_tour'] ) ) {
                update_post_meta( $prop_id, 'yani_virtual_tour', $_POST['virtual_tour'] );
            }

            // Year Built
            if( isset( $_POST['prop_year_built'] ) ) {
                update_post_meta( $prop_id, 'yani_property_year', sanitize_text_field( $_POST['prop_year_built'] ) );
            }

            // Property ID
            $auto_property_id = _yani_theme()->get_option('auto_property_id');
            if( $auto_property_id != 1 ) {
                if (isset($_POST['property_id'])) {
                    update_post_meta($prop_id, 'yani_property_id', sanitize_text_field($_POST['property_id']));
                }
            } else {
                    update_post_meta($prop_id, 'yani_property_id', $prop_id );
            }

            // Property Video Url
            if( isset( $_POST['prop_video_url'] ) ) {
                update_post_meta( $prop_id, 'yani_video_url', sanitize_text_field( $_POST['prop_video_url'] ) );
            }

            // property video image - in case of update
            $property_video_image = "";
            $property_video_image_id = 0;
            if( $submission_action == "update_property" ) {
                $property_video_image_id = get_post_meta( $prop_id, 'yani_video_image', true );
                if ( ! empty ( $property_video_image_id ) ) {
                    $property_video_image_src = wp_get_attachment_image_src( $property_video_image_id, 'yani-property-detail-gallery' );
                    $property_video_image = $property_video_image_src[0];
                }
            }

            // clean up the old meta information related to images when property update
            if( $submission_action == "update_property" ){
                delete_post_meta( $prop_id, 'yani_property_images' );
                delete_post_meta( $prop_id, 'yani_attachments' );
                delete_post_meta( $prop_id, 'yani_agents' );
                delete_post_meta( $prop_id, 'yani_property_agency' );
                delete_post_meta( $prop_id, '_thumbnail_id' );
            }

            // Property Images
            if( isset( $_POST['propperty_image_ids'] ) ) {
                if (!empty($_POST['propperty_image_ids']) && is_array($_POST['propperty_image_ids'])) {
                    $property_image_ids = array();
                    foreach ($_POST['propperty_image_ids'] as $prop_img_id ) {
                        $property_image_ids[] = intval( $prop_img_id );
                        add_post_meta($prop_id, 'yani_property_images', $prop_img_id);
                    }

                    // featured image
                    if( isset( $_POST['featured_image_id'] ) ) {
                        $featured_image_id = intval( $_POST['featured_image_id'] );
                        if( in_array( $featured_image_id, $property_image_ids ) ) {
                            update_post_meta( $prop_id, '_thumbnail_id', $featured_image_id );

                            /* if video url is provided but there is no video image then use featured image as video image */
                            if ( empty( $property_video_image ) && !empty( $_POST['prop_video_url'] ) ) {
                                update_post_meta( $prop_id, 'yani_video_image', $featured_image_id );
                            }
                        }
                    } elseif ( ! empty ( $property_image_ids ) ) {
                        update_post_meta( $prop_id, '_thumbnail_id', $property_image_ids[0] );

                        /* if video url is provided but there is no video image then use featured image as video image */
                        if ( empty( $property_video_image ) && !empty( $_POST['prop_video_url'] ) ) {
                            update_post_meta( $prop_id, 'yani_video_image', $property_image_ids[0] );
                        }
                    }
                }
            }

            if( isset( $_POST['propperty_attachment_ids'] ) ) {
                    $property_attach_ids = array();
                    foreach ($_POST['propperty_attachment_ids'] as $prop_atch_id ) {
                        $property_attach_ids[] = intval( $prop_atch_id );
                        add_post_meta($prop_id, 'yani_attachments', $prop_atch_id);
                    }
            }
 

            // Add property type
            if( isset( $_POST['prop_type'] ) && ( $_POST['prop_type'] != '-1' ) ) {
                $type = array_map( 'intval', $_POST['prop_type'] );
                wp_set_object_terms( $prop_id, $type, 'property_type' );
            } else {
                wp_set_object_terms( $prop_id, '', 'property_type' );
            }

            // Add property status
            if( isset( $_POST['prop_status'] ) && ( $_POST['prop_status'] != '-1' ) ) {
                $prop_status = array_map( 'intval', $_POST['prop_status'] );
                wp_set_object_terms( $prop_id, $prop_status, 'property_status' );
            } else {
                wp_set_object_terms( $prop_id, '', 'property_status' );
            }

            // Add property status
            if( isset( $_POST['prop_labels'] ) ) {
                $prop_labels = array_map( 'intval', $_POST['prop_labels'] );
                wp_set_object_terms( $prop_id, $prop_labels, 'property_label' );
            } else {
                wp_set_object_terms( $prop_id, '', 'property_label' );
            }

            // Country
            if( isset( $_POST['country'] ) ) {
                $property_country = sanitize_text_field( $_POST['country'] );
                $country_id = wp_set_object_terms( $prop_id, $property_country, 'property_country' );
            } else {
                $default_country = _yani_theme()->get_option('default_country');
                $country_id = wp_set_object_terms( $prop_id, $default_country, 'property_country' );
            }
            
            // Postal Code
            if( isset( $_POST['postal_code'] ) ) {
                update_post_meta( $prop_id, 'yani_property_zip', sanitize_text_field( $_POST['postal_code'] ) );
            }

            
            if( isset( $_POST['locality'] ) ) {
                $property_city = sanitize_text_field( $_POST['locality'] );
                $city_id = wp_set_object_terms( $prop_id, $property_city, 'property_city' );

                $yani_meta = array();
                $yani_meta['parent_state'] = isset( $_POST['administrative_area_level_1'] ) ? $_POST['administrative_area_level_1'] : '';
                if( !empty( $city_id) && isset( $_POST['administrative_area_level_1'] ) ) {
                    update_option('_yani_property_city_' . $city_id[0], $yani_meta);
                }
            }

            if( isset( $_POST['neighborhood'] ) ) {
                $property_area = sanitize_text_field( $_POST['neighborhood'] );
                $area_id = wp_set_object_terms( $prop_id, $property_area, 'property_area' );

                $yani_meta = array();
                $yani_meta['parent_city'] = isset( $_POST['locality'] ) ? $_POST['locality'] : '';
                if( !empty( $area_id) && isset( $_POST['locality'] ) ) {
                    update_option('_yani_property_area_' . $area_id[0], $yani_meta);
                }
            }


            // Add property state
            if( isset( $_POST['administrative_area_level_1'] ) ) {
                $property_state = sanitize_text_field( $_POST['administrative_area_level_1'] );
                $state_id = wp_set_object_terms( $prop_id, $property_state, 'property_state' );

                $yani_meta = array();
                $country_short = isset( $_POST['country'] ) ? $_POST['country'] : '';
                if(!empty($country_short)) {
                   $country_short = strtoupper($country_short); 
                } else {
                    $country_short = '';
                }
                
                $yani_meta['parent_country'] = $country_short;
                if( !empty( $state_id) ) {
                    update_option('_yani_property_state_' . $state_id[0], $yani_meta);
                }
            }
           
            // Add property features
            if( isset( $_POST['prop_features'] ) ) {
                $features_array = array();
                foreach( $_POST['prop_features'] as $feature_id ) {
                    $features_array[] = intval( $feature_id );
                }
                wp_set_object_terms( $prop_id, $features_array, 'property_feature' );
            }

            // additional details
            if( isset( $_POST['additional_features'] ) ) {
                $additional_features = $_POST['additional_features'];
                if( ! empty( $additional_features ) ) {
                    update_post_meta( $prop_id, 'additional_features', $additional_features );
                    update_post_meta( $prop_id, 'yani_additional_features_enable', 'enable' );
                }
            } else {
                update_post_meta( $prop_id, 'additional_features', '' );
            }

            //Floor Plans
            if( isset( $_POST['floorPlans_enable'] ) ) {
                $floorPlans_enable = $_POST['floorPlans_enable'];
                if( ! empty( $floorPlans_enable ) ) {
                    update_post_meta( $prop_id, 'yani_floor_plans_enable', $floorPlans_enable );
                }
            }

            if( isset( $_POST['floor_plans'] ) ) {
                $floor_plans_post = $_POST['floor_plans'];
                if( ! empty( $floor_plans_post ) ) {
                    update_post_meta( $prop_id, 'floor_plans', $floor_plans_post );
                }
            }

            //Multi-units / Sub-properties
            if( isset( $_POST['multiUnits'] ) ) {
                $multiUnits_enable = $_POST['multiUnits'];
                if( ! empty( $multiUnits_enable ) ) {
                    update_post_meta( $prop_id, 'yani_multiunit_plans_enable', $multiUnits_enable );
                }
            }

            if( isset( $_POST['yani_multi_units'] ) ) {
                $yani_multi_units = $_POST['yani_multi_units'];
                if( ! empty( $yani_multi_units ) ) {
                    update_post_meta( $prop_id, 'yani_multi_units', $yani_multi_units );
                }
            }

            // Make featured
            if( isset( $_POST['prop_featured'] ) ) {
                $featured = intval( $_POST['prop_featured'] );
                update_post_meta( $prop_id, 'yani_featured', $featured );
            }

            // yani_loggedintoview
            if( isset( $_POST['login-required'] ) ) {
                $featured = intval( $_POST['login-required'] );
                update_post_meta( $prop_id, 'yani_loggedintoview', $featured );
            }

            // Mortgage
            if( $submission_action == 'add_property' ) {
                update_post_meta( $prop_id, 'yani_mortgage_cal', 0 );
                
            }

            // Private Note
            if( isset( $_POST['private_note'] ) ) {
                $private_note = wp_kses_post( $_POST['private_note'] );
                update_post_meta( $prop_id, 'yani_private_note', $private_note );
            }

            // disclaimer 
            if( isset( $_POST['property_disclaimer'] ) ) {
                $property_disclaimer = wp_kses_post( $_POST['property_disclaimer'] );
                update_post_meta( $prop_id, 'yani_property_disclaimer', $property_disclaimer );
            }

            //Energy Class
            if(isset($_POST['energy_class'])) {
                $energy_class = sanitize_text_field($_POST['energy_class']);
                update_post_meta( $prop_id, 'yani_energy_class', $energy_class );
            }
            if(isset($_POST['energy_global_index'])) {
                $energy_global_index = sanitize_text_field($_POST['energy_global_index']);
                update_post_meta( $prop_id, 'yani_energy_global_index', $energy_global_index );
            }
            if(isset($_POST['renewable_energy_global_index'])) {
                $renewable_energy_global_index = sanitize_text_field($_POST['renewable_energy_global_index']);
                update_post_meta( $prop_id, 'yani_renewable_energy_global_index', $renewable_energy_global_index );
            }
            if(isset($_POST['energy_performance'])) {
                $energy_performance = sanitize_text_field($_POST['energy_performance']);
                update_post_meta( $prop_id, 'yani_energy_performance', $energy_performance );
            }
            if(isset($_POST['epc_current_rating'])) {
                $epc_current_rating = sanitize_text_field($_POST['epc_current_rating']);
                update_post_meta( $prop_id, 'yani_epc_current_rating', $epc_current_rating );
            }
            if(isset($_POST['epc_potential_rating'])) {
                $epc_potential_rating = sanitize_text_field($_POST['epc_potential_rating']);
                update_post_meta( $prop_id, 'yani_epc_potential_rating', $epc_potential_rating );
            }


            // Property Payment
            if( isset( $_POST['prop_payment'] ) ) {
                $prop_payment = sanitize_text_field( $_POST['prop_payment'] );
                update_post_meta( $prop_id, 'yani_payment_status', $prop_payment );
            }


            if( isset( $_POST['yani_agent_display_option'] ) ) {

                $prop_agent_display_option = sanitize_text_field( $_POST['yani_agent_display_option'] );

                if( $prop_agent_display_option == 'agent_info' ) {

                    $prop_agent = $_POST['yani_agents'];

                    if(is_array($prop_agent)) {
                        foreach ($prop_agent as $agent) {
                            add_post_meta($prop_id, 'yani_agents', intval($agent) );
                        }
                    }
                    update_post_meta( $prop_id, 'yani_agent_display_option', $prop_agent_display_option );

                    if (_yani_user()->role_is("yani_agency")) {
                        $user_agency_id = get_user_meta( $userID, 'yani_author_agency_id', true );
                        if( !empty($user_agency_id)) {
                            update_post_meta($prop_id, 'yani_property_agency', $user_agency_id);
                        }
                    }

                } elseif( $prop_agent_display_option == 'agency_info' ) {

                    $user_agency_ids = $_POST['yani_property_agency'];

                    if (_yani_user()->role_is("yani_agency")) {
                        $user_agency_id = get_user_meta( $userID, 'yani_author_agency_id', true );
                        if( !empty($user_agency_id)) {
                            update_post_meta($prop_id, 'yani_property_agency', $user_agency_id);
                            update_post_meta($prop_id, 'yani_agent_display_option', $prop_agent_display_option);
                        } else {
                            update_post_meta( $prop_id, 'yani_agent_display_option', 'author_info' );
                        }

                    } else {

                        if(is_array($user_agency_ids)) {
                            foreach ($user_agency_ids as $agency) {
                                add_post_meta($prop_id, 'yani_property_agency', intval($agency) );
                            }
                        }
                        update_post_meta($prop_id, 'yani_agent_display_option', $prop_agent_display_option);
                    }
                    
                    
                } else {
                    update_post_meta( $prop_id, 'yani_agent_display_option', $prop_agent_display_option );
                }

            } else {

                if (_yani_user()->role_is("yani_agency")) {
                    $user_agency_id = get_user_meta( $userID, 'yani_author_agency_id', true );
                    if( !empty($user_agency_id) ) {
                        update_post_meta($prop_id, 'yani_agent_display_option', 'agency_info');
                        update_post_meta($prop_id, 'yani_property_agency', $user_agency_id);
                    } else {
                        update_post_meta( $prop_id, 'yani_agent_display_option', 'author_info' );
                    }

                } elseif(_yani_user()->role_is("yani_agent")){
                    $user_agent_id = get_user_meta( $userID, 'yani_author_agent_id', true );

                    if ( !empty( $user_agent_id ) ) {

                        update_post_meta($prop_id, 'yani_agent_display_option', 'agent_info');
                        update_post_meta($prop_id, 'yani_agents', $user_agent_id);

                    } else {
                        update_post_meta($prop_id, 'yani_agent_display_option', 'author_info');
                    }

                } else {
                    update_post_meta($prop_id, 'yani_agent_display_option', 'author_info');
                }
            }

            // Address
            if( isset( $_POST['property_map_address'] ) ) {
                update_post_meta( $prop_id, 'yani_property_map_address', sanitize_text_field( $_POST['property_map_address'] ) );
                update_post_meta( $prop_id, 'yani_property_address', sanitize_text_field( $_POST['property_map_address'] ) );
            }

            if( ( isset($_POST['lat']) && !empty($_POST['lat']) ) && (  isset($_POST['lng']) && !empty($_POST['lng'])  ) ) {
                $lat = sanitize_text_field( $_POST['lat'] );
                $lng = sanitize_text_field( $_POST['lng'] );
                $streetView = sanitize_text_field( $_POST['prop_google_street_view'] );
                $lat_lng = $lat.','.$lng;

                update_post_meta( $prop_id, 'yani_geolocation_lat', $lat );
                update_post_meta( $prop_id, 'yani_geolocation_long', $lng );
                update_post_meta( $prop_id, 'yani_property_location', $lat_lng );
                update_post_meta( $prop_id, 'yani_property_map', '1' );
                update_post_meta( $prop_id, 'yani_property_map_street_view', $streetView );

            }
            

            if( $submission_action == 'add_property' ) {
                do_action( 'yani_after_property_submit', $prop_id );

                if( _yani_theme()->get_option('add_new_property') == 1 ) {
                    yani_webhook_post( $_POST, 'yani_add_new_property' );
                }

            } else if ( $submission_action == 'update_property' ) {
                do_action( 'yani_after_property_update', $prop_id );

                if( _yani_theme()->get_option('add_new_property') == 1 ) {
                    yani_webhook_post( $_POST, 'yani_update_property' );
                }
            }

        return $prop_id;
        }
    }

	public function property_on_hold() {

        if ( isset( $_POST['propID'] ) ) {

            global $wpdb;
            if (! isset( $_POST['propID'] ) ) {
                wp_die('No post to put on hold has been supplied!');
            }
            $post_id = absint( $_POST['propID'] );
            
            $post_status = get_post_status( $post_id );

            // wp_send_json_success($post_status);
            if($post_status == 'publish') { 
                $post = array(
                    'ID'            => $post_id,
                    'post_status'   => 'on_hold'
                );
            } elseif ($post_status == 'on_hold') {
                $post = array(
                    'ID'            => $post_id,
                    'post_status'   => 'publish'
                );
            }
            $post_id =  wp_update_post($post);
            
            return true;
        }

    }

    public function relist_free() {
        $listings_admin_approved = _yani_theme()->get_option('listings_admin_approved');

        if( $listings_admin_approved != 'yes' ) {
            $prop_status = 'publish';
        } else {
            $prop_status = 'pending';
        }
        
        $propID = $_POST['propID'];
        $updated_property = array(
            'ID' => $propID,
            'post_type' => 'property',
            'post_status' => $prop_status,
            'post_date'     => current_time( 'mysql' ),
        );
        $post_id = wp_update_post( $updated_property );
    }

	public function prop_sort( $query_args ) {
        $sort_by = '';
        if ( isset( $_GET['sortby'] ) ) {
            $sort_by = $_GET['sortby'];
        } else {

            if ( _yani_template()->is_listings_template() ) {
                $sort_by = get_post_meta( get_the_ID(), 'yani_properties_sort', true );

            } else if( is_page_template( array( 'template/template-search.php' )) ) {
                
                $sort_by = _yani_theme()->get_option('search_default_order');
                
            } else if ( is_tax() ) {
                $sort_by = _yani_theme()->get_option('taxonomy_default_order');
                
            } else if(is_singular('yani_agent')) {
                $sort_by = _yani_theme()->get_option('agent_listings_order');

            } else if(is_singular('yani_agency')) {
                $sort_by = _yani_theme()->get_option('agency_listings_order');

            }
        }

        if ( $sort_by == 'a_price' ) {
            $query_args['orderby'] = 'meta_value_num';
            $query_args['meta_key'] = 'yani_property_price';
            $query_args['order'] = 'ASC';
        } else if ( $sort_by == 'd_price' ) {
            $query_args['orderby'] = 'meta_value_num';
            $query_args['meta_key'] = 'yani_property_price';
            $query_args['order'] = 'DESC';
        } else if ( $sort_by == 'featured' ) {
            $query_args['meta_key'] = 'yani_featured';
            $query_args['meta_value'] = '1';
            $query_args['orderby'] = 'meta_value date';
        } else if ( $sort_by == 'a_date' ) {
            $query_args['orderby'] = 'date';
            $query_args['order'] = 'ASC';
        } else if ( $sort_by == 'd_date' ) {
            $query_args['orderby'] = 'date';
            $query_args['order'] = 'DESC';
        } else if ( $sort_by == 'featured_first' ) {
            $query_args['orderby'] = 'meta_value date';
            $query_args['meta_key'] = 'yani_featured';
        } else if ( $sort_by == 'featured_top' ) {
            $query_args['orderby'] = 'meta_value date';
            $query_args['meta_key'] = 'yani_featured';
        }

        return apply_filters( 'yani_sort_properties', $query_args );

    }

    public function property_clone() {

        if ( isset( $_POST['propID'] ) ) {

            global $wpdb;
            if (! isset( $_POST['propID'] ) ) {
                wp_die('No post to duplicate has been supplied!');
            }
            $post_id = absint( $_POST['propID'] );
            $post = get_post( $post_id );
            $current_user = wp_get_current_user();
            $new_post_author = $current_user->ID;

            if (isset( $post ) && $post != null) {

                /*
                 * new post data array
                 */
                $args = array(
                    'comment_status' => $post->comment_status,
                    'ping_status'    => $post->ping_status,
                    'post_author'    => $new_post_author,
                    'post_content'   => $post->post_content,
                    'post_excerpt'   => $post->post_excerpt,
                    'post_name'      => $post->post_name,
                    'post_parent'    => $post->post_parent,
                    'post_password'  => $post->post_password,
                    'post_status'    => 'draft',
                    'post_title'     => $post->post_title,
                    'post_type'      => $post->post_type,
                    'to_ping'        => $post->to_ping,
                    'menu_order'     => $post->menu_order
                );

                /*
                 * insert the post by wp_insert_post() function
                 */
                $new_post_id = wp_insert_post( $args );

                /*
                 * get all current post terms ad set them to the new post draft
                 */
                $taxonomies = get_object_taxonomies($post->post_type); // returns array of taxonomy names for post type, ex array("category", "post_tag");
                foreach ($taxonomies as $taxonomy) {
                    $post_terms = wp_get_object_terms($post_id, $taxonomy, array('fields' => 'slugs'));
                    wp_set_object_terms($new_post_id, $post_terms, $taxonomy, false);
                }

                /*
                 * duplicate all post meta just in two SQL queries
                 */
                $post_meta_infos = $wpdb->get_results("SELECT meta_key, meta_value FROM $wpdb->postmeta WHERE post_id=$post_id");
                if (count($post_meta_infos)!=0) {
                    $sql_query = "INSERT INTO $wpdb->postmeta (post_id, meta_key, meta_value) ";
                    foreach ($post_meta_infos as $meta_info) {
                        $meta_key = $meta_info->meta_key;
                        $meta_value = addslashes($meta_info->meta_value);
                        $sql_query_sel[]= "SELECT $new_post_id, '$meta_key', '$meta_value'";
                    }
                    $sql_query.= implode(" UNION ALL ", $sql_query_sel);
                    $wpdb->query($sql_query);
                }

                update_post_meta( $new_post_id, 'yani_featured', 0 );
                update_post_meta( $new_post_id, 'yani_payment_status', 'not_paid' );

                $dashboard_listings = _yani_template()->get_template_link('template/user_dashboard_properties.php');
                $dashboard_listings = add_query_arg( 'cloned', 1, $dashboard_listings );

                echo json_encode( array(
                    'success'   => true,
                    'redirect'  => $dashboard_listings,
                    'message' => 'Successfully cloned',
                ));
                /*
                 * finally, redirect to the edit post screen for the new draft
                 */
                // wp_redirect( admin_url( 'post.php?action=edit&post=' . $new_post_id ) );
                wp_die();
            } else {
                echo json_encode( array(
                    'success'   => false,
                    'message' => 'Failed',
                ));
                wp_die('Post creation failed, could not find original post: ' . $post_id);
            }

        }

    }

    public function get_listing_data($field, $single = true) {
        $prefix = 'fave_';
        $data = get_post_meta(get_the_ID(), $prefix.$field, $single);
        
        if($data != '') {
            return $data;
        }
        return '';
    }


    public function delete_property(){

        $dashboard_listings = _yani_template()->get_template_link('template/user_dashboard_properties.php');
        $dashboard_listings = add_query_arg( 'deleted', 1, $dashboard_listings );

        $nonce = $_REQUEST['security'];
        if ( ! wp_verify_nonce( $nonce, 'delete_my_property_nonce' ) ) {
            $ajax_response = array( 'success' => false , 'reason' => esc_html__( 'Security check failed!', _yani_theme()->get_text_domain() ) );
            echo json_encode( $ajax_response );
            die;
        }

        if ( !isset( $_REQUEST['prop_id'] ) ) {
            $ajax_response = array( 'success' => false , 'reason' => esc_html__( 'No Property ID found', _yani_theme()->get_text_domain() ) );
            echo json_encode( $ajax_response );
            die;
        }

        $propID = $_REQUEST['prop_id'];
        $post_author = get_post_field( 'post_author', $propID );

        global $current_user;
        wp_get_current_user();
        $userID      =   $current_user->ID;

        if ( $post_author == $userID ) {

            if( get_post_status($propID) != 'draft' ) {
                _yani_attachment()->delete_property_attachments_frontend($propID);
            }
            wp_delete_post( $propID );
            $ajax_response = array( 'success' => true , 'redirect' => $dashboard_listings, 'mesg' => esc_html__( 'Property Deleted', _yani_theme()->get_text_domain() ) );
            echo json_encode( $ajax_response );
            die;
        } else {
            $ajax_response = array( 'success' => false , 'reason' => esc_html__( 'Permission denied', _yani_theme()->get_text_domain() ) );
            echo json_encode( $ajax_response );
            die;
        }

    }

    public function get_price_v1($listing_id = '') {

        if(empty($listing_id)) {
            $listing_id = get_the_ID();
        } 
        
        $output = '';
        $sale_price     = get_post_meta( $listing_id, 'yani_property_price', true );
        $second_price   = get_post_meta( $listing_id, 'yani_property_sec_price', true );
        $price_postfix  = get_post_meta( $listing_id, 'yani_property_price_postfix', true );
        $price_prefix   = get_post_meta( $listing_id, 'yani_property_price_prefix', true );
        $price_separator = _yani_theme()->get_option('currency_separator');

        $price_as_text = doubleval( $sale_price );
        if( !$price_as_text ) {
            if( is_singular( 'property' ) ) {
                $output .= '<li class="item-price item-price-text price-single-listing-text">'.$sale_price. '</li>';
                return $output;
            }
            $output .= '<li class="item-price item-price-text">'.$sale_price. '</li>';
            return $output;
        }

        if( !empty( $price_prefix ) ) {
            $price_prefix = '<span class="price-prefix">'.$price_prefix.' </span>';
        }

        if (!empty( $sale_price ) ) {

            if (!empty( $price_postfix )) {
                $price_postfix = $price_separator . $price_postfix;
            }

            if (!empty( $sale_price ) && !empty( $second_price ) ) {

                if( is_singular( 'property' ) ) {
                    $output .= '<li class="item-price">'.$price_prefix. _yani_property()->get_property_price($sale_price) . '</li>';
                    if (!empty($second_price)) {
                        $output .= '<li class="item-sub-price">';
                        $output .= _yani_property()->get_property_price($second_price) . $price_postfix;
                        $output .= '</li>';
                    }
                } else {
                    $output .= '<li class="item-price">'.$price_prefix.' '._yani_property()->get_property_price($sale_price) . '</li>';
                    if (!empty($second_price)) {
                        $output .= '<li class="item-sub-price">';
                        $output .= _yani_property()->get_property_price($second_price) . $price_postfix;
                        $output .= '</li>';
                    }
                }
            } else {
                if (!empty( $sale_price )) {
                    if( is_singular( 'property' ) ) {
                        $output .= '<li class="item-price">';
                        $output .= $price_prefix. _yani_property()->get_property_price($sale_price) . $price_postfix;
                        $output .= '</li>';
                    } else {
                        $output .= '<li class="item-price">';
                        $output .= $price_prefix;
                        $output .= _yani_property()->get_property_price($sale_price) . $price_postfix;
                        $output .= '</li>';
                    }
                }
            }

        }
        return $output;
    
    }

    public  function get_listing_composer_fields() {
        $array = array(
            'bed',
            'room',
            'bath',
            'garage',
            'area-size',
            'land-area',
            'year-built',
            'property-id',
        );
        return $array;
    }

	public static function get_instance() {

		// If the single instance hasn't been set, set it now.
		if ( null == self::$instance ) {
			self::$instance = new self;
		}
		return self::$instance;
	}
}

function _yani_property_listing() {
	return yani_Property_Listings::get_instance();
}

_yani_property_listing();
?>