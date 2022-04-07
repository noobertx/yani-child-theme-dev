<?php
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! class_exists( '_Yani_AJAX_Helper' ) ) {
	class _Yani_AJAX_Helper{
		private static $instance = null;	

		public function init(){			
			add_action( 'wp_ajax_nopriv_yani_register', array($this,'register' ));
			add_action( 'wp_ajax_yani_register', array($this,'register' ));
			add_action( 'wp_ajax_yani_update_profile', array($this,'update_profile' ));
			add_action( 'wp_ajax_yani_user_picture_upload', array($this,'user_picture_upload' ));   
			
			add_action('wp_ajax_load_lightbox_content', array($this,'get_listing_model'));
			add_action('wp_ajax_nopriv_load_lightbox_content', array($this,'get_listing_model'));
			add_action( 'wp_ajax_yani_add_to_favorite', array($this,'add_favorites' ));
			add_action( 'wp_ajax_nopriv_yani_loadmore_properties', array($this,'loadmore_properties' ));
			add_action( 'wp_ajax_yani_loadmore_properties', array($this,'loadmore_properties' ));
			add_action( 'wp_ajax_nopriv_yani_property_agent_contact', array($this,'property_agent_contact' ));
			add_action( 'wp_ajax_yani_property_agent_contact', array($this,'property_agent_contact' ));
			add_action( 'wp_ajax_nopriv_yani_start_thread', array($this,'start_thread' ));
			add_action( 'wp_ajax_yani_start_thread', array($this,'start_thread' ));
			add_action( 'wp_ajax_nopriv_yani_thread_message', array($this,'init_thread_message' ));
			add_action( 'wp_ajax_yani_thread_message', array($this,'init_thread_message' ));
			add_action( 'wp_ajax_nopriv_yani_contact_realtor', array($this,'contact_realtor' ));
			add_action( 'wp_ajax_yani_contact_realtor', array($this,'contact_realtor' ));
			add_action( 'wp_ajax_nopriv_yani_get_auto_complete_search', array($this,'get_auto_complete_search' ));
			add_action( 'wp_ajax_yani_get_auto_complete_search', array($this,'get_auto_complete_search' ));
			add_action('wp_ajax_yani_property_paypal_payment', array($this,'property_paypal_payment'));
			add_action( 'wp_ajax_nopriv_reviews_likes_dislikes', array($this,'reviews_likes_dislikes' ));
			add_action( 'wp_ajax_reviews_likes_dislikes', array($this,'reviews_likes_dislikes' ));
			add_action( 'wp_ajax_nopriv_yani_submit_review', array($this,'submit_review' ));
			add_action( 'wp_ajax_yani_submit_review', array($this,'submit_review' ));

			add_action( 'wp_ajax_nopriv_yani_paypal_package_payment',array($this, 'paypal_package_payment' ));
			add_action( 'wp_ajax_yani_paypal_package_payment',array($this, 'paypal_package_payment' ));

			add_action( 'wp_ajax_nopriv_yani_delete_property', array($this,'delete_property' ));
			add_action( 'wp_ajax_yani_delete_property', array($this,'delete_property' ));
			add_action( 'wp_ajax_nopriv_yani_property_clone', array($this,'property_clone' ));
			add_action( 'wp_ajax_yani_property_clone', array($this,'property_clone' ));
			// add_action( 'wp_ajax_yani_property_on_hold', array($this,'property_on_hold' ));

		}	
		public function register() {

        check_ajax_referer('yani_register_nonce', 'yani_register_security');

        $allowed_html = array();

        $usermane          = trim( sanitize_text_field( wp_kses( $_POST['username'], $allowed_html ) ));
        $email             = trim( sanitize_text_field( wp_kses( $_POST['useremail'], $allowed_html ) ));
        $term_condition    = wp_kses( $_POST['term_condition'], $allowed_html );
        $enable_password = _yani_theme()->get_option('enable_password');
        $response = $_POST["g-recaptcha-response"];

        do_action('yani_before_register');

        $user_role = get_option( 'default_role' );

        if( isset( $_POST['role'] ) && $_POST['role'] != '' ){
            $user_role = isset( $_POST['role'] ) ? sanitize_text_field( wp_kses( $_POST['role'], $allowed_html ) ) : $user_role;
        } else {
            $user_role = $user_role;
        }

        $term_condition = ( $term_condition == 'on') ? true : false;

        if( !$term_condition ) {
            echo json_encode( array( 'success' => false, 'msg' => esc_html__('You need to agree with terms & conditions.', 'houzez-login-register') ) );
            wp_die();
        }

        $firstname = isset( $_POST['first_name'] ) ? $_POST['first_name'] : '';
        if( empty($firstname) && _yani_theme()->get_option('register_first_name', 0) == 1 ) {
            echo json_encode( array( 'success' => false, 'msg' => esc_html__('The first name field is empty.', 'houzez-login-register') ) );
            wp_die();
        }

        $lastname = isset( $_POST['last_name'] ) ? $_POST['last_name'] : '';
        if( empty($lastname) && _yani_theme()->get_option('register_last_name', 0) == 1 ) {
            echo json_encode( array( 'success' => false, 'msg' => esc_html__('The last name field is empty.', 'houzez-login-register') ) );
            wp_die();
        }

        $phone_number = isset( $_POST['phone_number'] ) ? $_POST['phone_number'] : '';
        if( empty($phone_number) && _yani_theme()->get_option('register_mobile', 0) == 1 ) {
            echo json_encode( array( 'success' => false, 'msg' => esc_html__('Please enter your number', 'houzez-login-register') ) );
            wp_die();
        }

        if( empty( $usermane ) ) {
            echo json_encode( array( 'success' => false, 'msg' => esc_html__('The username field is empty.', 'houzez-login-register') ) );
            wp_die();
        }
        if( strlen( $usermane ) < 3 ) {
            echo json_encode( array( 'success' => false, 'msg' => esc_html__('Minimum 3 characters required', 'houzez-login-register') ) );
            wp_die();
        }
        if (preg_match("/^[0-9A-Za-z_]+$/", $usermane) == 0) {
            echo json_encode( array( 'success' => false, 'msg' => esc_html__('Invalid username (do not use special characters or spaces)!', 'houzez-login-register') ) );
            wp_die();
        }
        if( username_exists( $usermane ) ) {
            echo json_encode( array( 'success' => false, 'msg' => esc_html__('This username is already registered.', 'houzez-login-register') ) );
            wp_die();
        }
        if( empty( $email ) ) {
            echo json_encode( array( 'success' => false, 'msg' => esc_html__('The email field is empty.', 'houzez-login-register') ) );
            wp_die();
        }

        if( email_exists( $email ) ) {
            echo json_encode( array( 'success' => false, 'msg' => esc_html__('This email address is already registered.', 'houzez-login-register') ) );
            wp_die();
        }

        if( !is_email( $email ) ) {
            echo json_encode( array( 'success' => false, 'msg' => esc_html__('Invalid email address.', 'houzez-login-register') ) );
            wp_die();
        }

        if( $enable_password == 'yes' ){
            $user_pass         = trim( sanitize_text_field(wp_kses( $_POST['register_pass'] ,$allowed_html) ) );
            $user_pass_retype  = trim( sanitize_text_field(wp_kses( $_POST['register_pass_retype'] ,$allowed_html) ) );

            if ($user_pass == '' || $user_pass_retype == '' ) {
                echo json_encode( array( 'success' => false, 'msg' => esc_html__('One of the password field is empty!', 'houzez-login-register') ) );
                wp_die();
            }

            if ($user_pass !== $user_pass_retype ){
                echo json_encode( array( 'success' => false, 'msg' => esc_html__('Passwords do not match', 'houzez-login-register') ) );
                wp_die();
            }
        }


        // yani_google_recaptcha_callback();

        if($enable_password == 'yes' ) {
            $user_password = $user_pass;
        } else {
            $user_password = wp_generate_password( $length=12, $include_standard_special_chars=false );
        }
        $user_id = wp_create_user( $usermane, $user_password, $email );

        if ( is_wp_error($user_id) ) {
            echo json_encode( array( 'success' => false, 'msg' => $user_id ) );
            wp_die();
        } else {

            wp_update_user( array( 'ID' => $user_id, 'role' => $user_role ) );

            if( $enable_password =='yes' ) {
                echo json_encode( array( 'success' => true, 'msg' => esc_html__('Your account was created and you can login now!', 'houzez-login-register') ) );
            } else {
                echo json_encode( array( 'success' => true, 'msg' => esc_html__('An email with the generated password was sent!', 'houzez-login-register') ) );
            }

            update_user_meta( $user_id, 'first_name', $firstname);
            update_user_meta( $user_id, 'last_name', $lastname);

            if( $user_role == 'yani_agency' ) {
                update_user_meta( $user_id, 'yani_author_phone', $phone_number);
            } else {
                update_user_meta( $user_id, 'yani_author_mobile', $phone_number);
            }
 
            $user_as_agent = _yani_theme()->get_option('user_as_agent');

            if( $user_as_agent == 'yes' ) {

                if( !empty($firstname) && !empty($lastname) ) {
                    $usermane = $firstname.' '.$lastname;
                }

                if ($user_role == 'yani_agent' || $user_role == 'author') {
                    _yani_user()->register_as_agent($usermane, $email, $user_id, $phone_number);

                } else if ($user_role == 'yani_agency') {
                    _yani_user()->register_as_agency($usermane, $email, $user_id, $phone_number);
                }
            }
            _yani_user()->new_user_notification( $user_id, $user_password, $phone_number );

            do_action('yani_after_register', $user_id);
        }
        wp_die();

    }
		public function get_listing_model() {
	        $listing_id = isset($_POST['listing_id']) ? $_POST['listing_id'] : '';

	        if(empty($listing_id)) {
	            echo esc_html__('Nothing found', _yani_theme()->get_text_domain());
	            return;
	        }
	        

	        $lightbox_logo = _yani_theme()->get_option( 'lightbox_logo', false, 'url' );

	        $userID      =   get_current_user_id();
	        $fav_option = 'yani_favorites-'.$userID;
	        $fav_option = get_option( $fav_option );
	        $icon = $key = '';
	        if( !empty($fav_option) ) {
	            $key = array_search($listing_id, $fav_option);
	        }
	        if( $key != false || $key != '' ) {
	            $icon = 'text-danger';
	        }
	    
	        $prop_id = _yani_listing()->get_listing_data_by_id('property_id', $listing_id);
	        $prop_size = _yani_listing()->get_listing_data_by_id('property_size', $listing_id);
	        $land_area = _yani_listing()->get_listing_data_by_id('property_land', $listing_id);
	        $bedrooms = _yani_listing()->get_listing_data_by_id('property_bedrooms', $listing_id);
	        $rooms = _yani_listing()->get_listing_data_by_id('property_rooms', $listing_id);
	        $bathrooms = _yani_listing()->get_listing_data_by_id('property_bathrooms', $listing_id);
	        $year_built = _yani_listing()->get_listing_data_by_id('property_year', $listing_id);
	        $garage = _yani_listing()->get_listing_data_by_id('property_garage', $listing_id);
	        $property_type = _yani_taxonomy()->get_taxonomy_simple('property_type', $listing_id);
	        $garage_size = _yani_listing()->get_listing_data_by_id('property_garage_size', $listing_id);
	        $address = _yani_listing()->get_listing_data_by_id('property_map_address', $listing_id);

	        $term_status = wp_get_post_terms( $listing_id, 'property_status', array("fields" => "all"));
	        $term_label = wp_get_post_terms( $listing_id, 'property_label', array("fields" => "all"));

	        $size = 'houzez-gallery';
	        // $properties_images = rwmb_meta( 'yani_property_images', 'type=plupload_image&size='.$size, $listing_id );
	        $properties_images = [];
	        $token = wp_generate_password(5, false, false);

	    ?>
	    <div class="modal-header">
	        <div class="d-flex align-items-center">
	            <div class="lightbox-logo flex-grow-1">
	                <?php if(!empty($lightbox_logo)) { ?>
	                <img class="img-fluid" src="<?php echo esc_url($lightbox_logo); ?>" alt="logo">
	                <?php } ?>
	            </div><!-- lightbox-logo -->
	            <div class="lightbox-tools">
	                <ul class="list-inline">
	                    <?php if( _yani_theme()->get_option('disable_favorite') != 0 ) { ?>
	                    <li class="list-inline-item btn-favorite">
	                        <a class="add-favorite-js" data-listid="<?php echo intval($listing_id)?>" href="#"><i class="yani-icon icon-love-it mr-2 <?php echo esc_attr($icon); ?>"></i> <span class="display-none"><?php esc_html_e('Favorite', _yani_theme()->get_text_domain()); ?></span></a>
	                    </li>
	                    <?php } ?>
	                </ul>
	            </div><!-- lightbox-tools -->
	        </div><!-- d-flex -->
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	            <span aria-hidden="true">&times;</span>
	        </button>
	    </div><!-- modal-header -->

	    <div class="modal-body clearfix">

	        <div class="lightbox-gallery-wrap">
	            <a class="btn-expand">
	                <i class="yani-icon icon-expand-3"></i>
	            </a>
	            
	            <?php  if( !empty($properties_images) && count($properties_images)) { ?>
	            <div class="lightbox-gallery">
	                <div id="preview-js-<?php echo esc_attr($token); ?>" class="lightbox-slider">
	                    
	                    <?php
	                    $lightbox_caption = _yani_theme()->get_option('lightbox_caption', 0); 
	                    foreach( $properties_images as $prop_image_id => $prop_image_meta ) {
	                        $output = '';
	                        $output .= '<div>';
	                            $output .= '<img class="img-fluid" src="'.esc_url( $prop_image_meta['full_url'] ).'" alt="'.esc_attr($prop_image_meta['alt']).'" title="'.esc_attr($prop_image_meta['title']).'">';

	                            if( !empty($prop_image_meta['caption']) && $lightbox_caption != 0 ) {
	                                $output .= '<span class="hz-image-caption">'.esc_attr($prop_image_meta['caption']).'</span>';
	                            }

	                        $output .= '</div>';

	                        echo $output;
	                    }
	                    ?>
	                    
	                </div>
	            </div><!-- lightbox-gallery -->
	            <?php 
	            } else { 
	                $featured_image_url = _yani_image()->get_image_url('full', $listing_id);
	                echo '<div>
	                    <img class="img-fluid" src="'.esc_url($featured_image_url[0]).'">
	                </div>';
	            } ?>

	        </div><!-- lightbox-gallery-wrap -->


	        <div class="lightbox-content-wrap lightbox-form-wrap">
	        
	            <div class="labels-wrap labels-right"> 
	                <?php 
	                if( !empty($term_status) ) {
	                    foreach( $term_status as $status ) {
	                        $status_id = $status->term_id;
	                        $status_name = $status->name;
	                        echo '<a href="'.get_term_link($status_id).'" class="label-status label status-color-'.intval($status_id).'">
	                                '.esc_attr($status_name).'
	                            </a>';
	                    }
	                }

	                if( !empty($term_label) ) {
	                    foreach( $term_label as $label ) {
	                        $label_id = $label->term_id;
	                        $label_name = $label->name;
	                        echo '<a href="'.get_term_link($label_id).'" class="label label-color-'.intval($label_id).'">
	                                '.esc_attr($label_name).'
	                            </a>';
	                    }
	                }
	                ?>       
	            </div>
	            
	            <h2 class="item-title">
	                <a href="<?php echo esc_url(get_permalink($listing_id)); ?>"><?php echo get_the_title($listing_id); ?></a>
	            </h2><!-- item-title -->

	            <?php 
	            if(!empty($address)) {
	                echo '<address class="item-address">'.esc_attr($address).'</address>';
	            }
	            ?>
	            
	            <ul class="item-price-wrap hide-on-list">
	                <?php echo _yani_price()->get_property_price($listing_id); ?>
	            </ul>

	            <p><?php echo _yani_post()->get_excerpt(23, $listing_id); ?></p>

	            <div class="property-overview-data">
	                <?php
	                $listing_data_composer = _yani_theme()->get_option('preview_data_composer');
	                $data_composer = $listing_data_composer['enabled'];

	                $meta_type = _yani_theme()->get_option('preview_meta_type');

	                $bd_output = $b_output = $id_output = $garage_output = $area_size_output = $land_output = $year_output = $icon = $icon_bt = $icon_prop_id = $icon_garage = $icon_areasize = $icon_land = $icon_year = $cus_output = $cus_icon = '';
	                $i = 0;
	                if ($data_composer) {
	                    unset($data_composer['placebo']);
	                    foreach ($data_composer as $key=>$value) { $i ++;

	                        $listing_area_size = _yani_listing()->get_area_size( $listing_id );
	                        $listing_size_unit = _yani_listing()->get_size_unit( $listing_id );

	                        $listing_land_size = _yani_listing()->get_land_area_size( $listing_id );
	                        $listing_land_unit = _yani_listing()->get_land_size_unit( $listing_id );

	                        if( $key == 'bed' && $bedrooms != '' ) {

	                            $bd_output .= '<ul class="list-unstyled flex-fill">';
	                                $bd_output .= '<li class="property-overview-item">';
	                                    
	                                    if(_yani_theme()->get_option('icons_type') == 'font-awesome') {
	                                        $icon .= '<i class="'._yani_theme()->get_option('fa_bed').' mr-1"></i>';

	                                    } elseif (_yani_theme()->get_option('icons_type') == 'custom') {
	                                        $cus_icon = _yani_theme()->get_option('bed');
	                                        if(!empty($cus_icon['url'])) {
	                                            $icon .= '<img class="img-fluid mr-1" src="'.esc_url($cus_icon['url']).'" width="16" height="16" alt="'.esc_attr($cus_icon['title']).'">';
	                                        }
	                                    } else {
	                                        $icon .= '<i class="yani-icon icon-hotel-double-bed-1 mr-1"></i>';
	                                    }

	                                    if( $meta_type != 'text' ) {
	                                        $bd_output .= $icon;
	                                    }
	                                    
	                                    $bd_output .= '<strong>'.esc_attr($bedrooms).'</strong>';
	                                    
	                                $bd_output .= '</li>';

	                                if( $meta_type != 'icons' ) {
	                                    $prop_bed_label = ($bedrooms > 1 ) ? _yani_theme()->get_option('glc_bedrooms', 'Bedrooms') : _yani_theme()->get_option('glc_bedroom', 'Bedroom');
	                                    $bd_output .= '<li class="h-beds">'.esc_attr($prop_bed_label).'</li>';
	                                }

	                            $bd_output .= '</ul>';

	                            if(!empty($bd_output)) {
	                                echo $bd_output;
	                            }

	                        } else if( $key == 'room' && $rooms != '' ) {

	                            $rooms_output .= '<ul class="list-unstyled flex-fill">';
	                                $rooms_output .= '<li class="property-overview-item">';
	                                    
	                                    if(_yani_theme()->get_option('icons_type') == 'font-awesome') {
	                                        $room_icon .= '<i class="'._yani_theme()->get_option('fa_room').' mr-1"></i>';

	                                    } elseif (_yani_theme()->get_option('icons_type') == 'custom') {
	                                        $cus_icon = _yani_theme()->get_option('room');
	                                        if(!empty($cus_icon['url'])) {
	                                            $room_icon .= '<img class="img-fluid mr-1" src="'.esc_url($cus_icon['url']).'" width="16" height="16" alt="'.esc_attr($cus_icon['title']).'">';
	                                        }
	                                    } else {
	                                        $room_icon .= '<i class="yani-icon icon-hotel-double-bed-1 mr-1"></i>';
	                                    }

	                                    if( $meta_type != 'text' ) {
	                                        $rooms_output .= $room_icon;
	                                    }
	                                    
	                                    $rooms_output .= '<strong>'.esc_attr($rooms).'</strong>';
	                                    
	                                $rooms_output .= '</li>';

	                                if( $meta_type != 'icons' ) {
	                                    $prop_room_label = ($rooms > 1 ) ? _yani_theme()->get_option('glc_rooms', 'Rooms') : _yani_theme()->get_option('glc_room', 'Room');
	                                    $rooms_output .= '<li class="h-beds">'.esc_attr($prop_room_label).'</li>';
	                                }

	                            $rooms_output .= '</ul>';

	                            if(!empty($rooms_output)) {
	                                echo $rooms_output;
	                            }

	                        } elseif( $key == 'bath' && $bathrooms != "" ) {

	                            $b_output .= '<ul class="list-unstyled flex-fill">';
	                                $b_output .= '<li class="property-overview-item">';
	                                    
	                                    if(_yani_theme()->get_option('icons_type') == 'font-awesome') {
	                                        $icon_bt .= '<i class="'._yani_theme()->get_option('fa_bath').' mr-1"></i>';

	                                    } elseif (_yani_theme()->get_option('icons_type') == 'custom') {
	                                        $cus_icon = _yani_theme()->get_option('bath');
	                                        if(!empty($cus_icon['url'])) {
	                                            $icon_bt .= '<img class="img-fluid mr-1" src="'.esc_url($cus_icon['url']).'" width="16" height="16" alt="'.esc_attr($cus_icon['title']).'">';
	                                        }
	                                    } else {
	                                        $icon_bt .= '<i class="yani-icon icon-bathroom-shower-1 mr-1"></i>';
	                                    }

	                                    if( $meta_type != 'text' ) {
	                                        $b_output .= $icon_bt;
	                                    }
	                                    
	                                    $b_output .= '<strong>'.esc_attr($bathrooms).'</strong>';
	                                    
	                                $b_output .= '</li>';

	                                if( $meta_type != 'icons' ) {
	                                    $prop_bath_label = ($bathrooms > 1 ) ? _yani_theme()->get_option('glc_bathrooms', 'Bathrooms') : _yani_theme()->get_option('glc_bathroom', 'Bathroom');
	                                    $b_output .= '<li class="h-baths">'.esc_attr($prop_bath_label).'</li>';
	                                }

	                            $b_output .= '</ul>';

	                            if(!empty($b_output)) {
	                                echo $b_output;
	                            }

	                        } elseif( $key == 'property-id' && $prop_id != "" ) {

	                            $id_output .= '<ul class="list-unstyled flex-fill">';
	                                $id_output .= '<li class="property-overview-item">';
	                                    
	                                    if(_yani_theme()->get_option('icons_type') == 'font-awesome') {
	                                        $icon_prop_id .= '<i class="'._yani_theme()->get_option('fa_property-id').' mr-1"></i>';

	                                    } elseif (_yani_theme()->get_option('icons_type') == 'custom') {
	                                        $cus_icon = _yani_theme()->get_option('property-id');
	                                        if(!empty($cus_icon['url'])) {
	                                            $icon_prop_id .= '<img class="img-fluid mr-1" src="'.esc_url($cus_icon['url']).'" width="16" height="16" alt="'.esc_attr($cus_icon['title']).'">';
	                                        }
	                                    } else {
	                                        $icon_prop_id .= '<i class="yani-icon icon-tags mr-1"></i>';
	                                    }

	                                    if( $meta_type != 'text' ) {
	                                        $id_output .= $icon_prop_id;
	                                    }
	                                    
	                                    $id_output .= '<strong>'.esc_attr($prop_id).'</strong>';
	                                    
	                                $id_output .= '</li>';

	                                if( $meta_type != 'icons' ) {
	                                    $prop_id_label = _yani_theme()->get_option('glc_listing_id', 'Listing ID');
	                                    $id_output .= '<li class="h-property-id">'.esc_attr($prop_id_label).'</li>';
	                                }

	                            $id_output .= '</ul>';

	                            if(!empty($id_output)) {
	                                echo $id_output;
	                            }

	                        } elseif( $key == 'garage' && $garage != "" ) {

	                            $garage_output .= '<ul class="list-unstyled flex-fill">';
	                                $garage_output .= '<li class="property-overview-item">';
	                                    
	                                    if(_yani_theme()->get_option('icons_type') == 'font-awesome') {
	                                        $icon_garage .= '<i class="'._yani_theme()->get_option('fa_garage').' mr-1"></i>';

	                                    } elseif (_yani_theme()->get_option('icons_type') == 'custom') {
	                                        $cus_icon = _yani_theme()->get_option('garage');
	                                        if(!empty($cus_icon['url'])) {
	                                            $icon_garage .= '<img class="img-fluid mr-1" src="'.esc_url($cus_icon['url']).'" width="16" height="16" alt="'.esc_attr($cus_icon['title']).'">';
	                                        }
	                                    } else {
	                                        $icon_garage .= '<i class="yani-icon icon-car-1 mr-1"></i>';
	                                    }

	                                    if( $meta_type != 'text' ) {
	                                        $garage_output .= $icon_garage;
	                                    }
	                                    
	                                    $garage_output .= '<strong>'.esc_attr($garage).'</strong>';
	                                    
	                                $garage_output .= '</li>';

	                                if( $meta_type != 'icons' ) {
	                                    $prop_garage_label = ($garage > 1 ) ? _yani_theme()->get_option('glc_garages', 'Garages') : _yani_theme()->get_option('glc_garage', 'Garage');
	                                    $garage_output .= '<li class="h-garage">'.esc_attr($prop_garage_label).'</li>';
	                                }

	                            $garage_output .= '</ul>';

	                            if(!empty($garage_output)) {
	                                echo $garage_output;
	                            }

	                        } elseif( $key == 'area-size' && $listing_area_size != "" ) {

	                            $area_size_output .= '<ul class="list-unstyled flex-fill">';
	                                $area_size_output .= '<li class="property-overview-item">';
	                                    
	                                    if(_yani_theme()->get_option('icons_type') == 'font-awesome') {
	                                        $icon_areasize .= '<i class="'._yani_theme()->get_option('fa_area-size').' mr-1"></i>';

	                                    } elseif (_yani_theme()->get_option('icons_type') == 'custom') {
	                                        $cus_icon = _yani_theme()->get_option('area-size');
	                                        if(!empty($cus_icon['url'])) {
	                                            $icon_areasize .= '<img class="img-fluid mr-1" src="'.esc_url($cus_icon['url']).'" width="16" height="16" alt="'.esc_attr($cus_icon['title']).'">';
	                                        }
	                                    } else {
	                                        $icon_areasize .= '<i class="yani-icon icon-ruler-triangle mr-1"></i>';
	                                    }

	                                    if( $meta_type != 'text' ) {
	                                        $area_size_output .= $icon_areasize;
	                                    }
	                                    
	                                    $area_size_output .= '<strong>'.esc_attr($listing_area_size).'</strong>';
	                                    
	                                $area_size_output .= '</li>';

	                                if( $meta_type != 'icons' ) {
	                                    $area_size_output .= '<li class="h-area">'.$listing_size_unit.'</li>';
	                                }

	                            $area_size_output .= '</ul>';

	                            if(!empty($area_size_output)) {
	                                echo $area_size_output;
	                            }

	                        } elseif( $key == 'land-area' && $listing_land_size != "" ) {

	                            $land_output .= '<ul class="list-unstyled flex-fill">';
	                                $land_output .= '<li class="property-overview-item">';
	                                    
	                                    if(_yani_theme()->get_option('icons_type') == 'font-awesome') {
	                                        $icon_land .= '<i class="'._yani_theme()->get_option('fa_land-area').' mr-1"></i>';

	                                    } elseif (_yani_theme()->get_option('icons_type') == 'custom') {
	                                        $cus_icon = _yani_theme()->get_option('land-area');
	                                        if(!empty($cus_icon['url'])) {
	                                            $icon_land .= '<img class="img-fluid mr-1" src="'.esc_url($cus_icon['url']).'" width="16" height="16" alt="'.esc_attr($cus_icon['title']).'">';
	                                        }
	                                    } else {
	                                        $icon_land .= '<i class="yani-icon icon-real-estate-dimensions-map mr-1"></i>';
	                                    }

	                                    if( $meta_type != 'text' ) {
	                                        $land_output .= $icon_land;
	                                    }
	                                    
	                                    $land_output .= '<strong>'.esc_attr($listing_land_size).'</strong>';
	                                    
	                                $land_output .= '</li>';

	                                if( $meta_type != 'icons' ) {
	                                    $land_output .= '<li class="h-land-area">'.$listing_land_unit.'</li>';
	                                }

	                            $land_output .= '</ul>';

	                            if(!empty($listing_land_size)) {
	                                echo $land_output;
	                            }

	                        }  elseif( $key == 'year-built' && $year_built != "" ) {

	                            $year_output .= '<ul class="list-unstyled flex-fill">';
	                                $year_output .= '<li class="property-overview-item">';
	                                    
	                                    if(_yani_theme()->get_option('icons_type') == 'font-awesome') {
	                                        $icon_year .= '<i class="'._yani_theme()->get_option('fa_year-built').' mr-1"></i>';

	                                    } elseif (_yani_theme()->get_option('icons_type') == 'custom') {
	                                        $cus_icon = _yani_theme()->get_option('year-built');
	                                        if(!empty($cus_icon['url'])) {
	                                            $icon_year .= '<img class="img-fluid mr-1" src="'.esc_url($cus_icon['url']).'" width="16" height="16" alt="'.esc_attr($cus_icon['title']).'">';
	                                        }
	                                    } else {
	                                        $icon_year .= '<i class="yani-icon icon-attachment mr-1"></i>';
	                                    }

	                                    if( $meta_type != 'text' ) {
	                                        $year_output .= $icon_year;
	                                    }
	                                    
	                                    $year_output .= '<strong>'.esc_attr($year_built).'</strong>';
	                                    
	                                $year_output .= '</li>';

	                                if( $meta_type != 'icons' ) {
	                                    $year_output .= '<li class="h-year-built">'._yani_theme()->get_option('glc_year_built', 'Year Built').'</li>';
	                                }

	                            $year_output .= '</ul>';

	                            if(!empty($year_built)) {
	                                echo $year_output;
	                            }

	                        } else {
	                            
	                            $cus_output = '';
	                            $cus_data = _yani_listing()->get_listing_data_by_id($key, $listing_id);

	                            $cus_output .= '<ul class="list-unstyled flex-fill">';
	                            $cus_output .= '<li class="property-overview-item">';
	                                
	                                if(_yani_theme()->get_option('icons_type') == 'font-awesome') {
	                                    $cus_icon .= '<i class="'._yani_theme()->get_option('fa_'.$key).' mr-1"></i>';

	                                } elseif (_yani_theme()->get_option('icons_type') == 'custom') {
	                                    $cus_icon = _yani_theme()->get_option($key);
	                                    if(!empty($cus_icon['url'])) {
	                                        $cus_icon .= '<img class="img-fluid mr-1" src="'.esc_url($cus_icon['url']).'" width="16" height="16" alt="'.esc_attr($cus_icon['title']).'">';
	                                    }
	                                } 

	                                if( $meta_type != 'text' ) {
	                                    $cus_output .= $cus_icon;
	                                }
	                                
	                                $cus_output .= '<strong>'.esc_attr($cus_data).'</strong>';
	                                
	                            $cus_output .= '</li>';

	                            if( $meta_type != 'icons' ) {
	                                $cus_output .= '<li class="h-year-built">'.esc_attr($value).'</li>';
	                            }

	                        $cus_output .= '</ul>';

	                        if(!empty($cus_data)) {
	                            echo $cus_output;
	                        }

	                        } // end else
	                    if($i == 6)
	                        break;
	                    }
	                }

	                ?>
	                
	            </div>
	            
	            <a class="btn btn-primary btn-item" href="<?php echo esc_url(get_permalink($listing_id)); ?>">
	                <?php echo _yani_theme()->get_option('glc_detail_btn', 'Details'); ?>
	            </a><!-- btn-item -->

	        </div><!-- lightbox-content-wrap -->
	    </div><!-- modal-body -->
	    <div class="modal-footer">
	        
	    </div><!-- modal-footer -->

	    <?php
	    wp_die();
	    
		}

		public function add_favorites () {
        global $current_user;
        wp_get_current_user();
        $userID      =   $current_user->ID;
        $fav_option = 'yani_favorites-'.$userID;
        $property_id = intval( $_POST['listing_id'] );
        $current_prop_fav = get_option( 'yani_favorites-'.$userID );

        // Check if empty or not
        if( empty( $current_prop_fav ) ) {
            $prop_fav = array();
            $prop_fav['1'] = $property_id;
            update_option( $fav_option, $prop_fav );
            $arr = array( 'added' => true, 'response' => esc_html__('Added', _yani_theme()->get_text_domain()) );
            echo json_encode($arr);
            wp_die();
        } else {
            if(  ! in_array ( $property_id, $current_prop_fav )  ) {
                $current_prop_fav[] = $property_id;
                update_option( $fav_option,  $current_prop_fav );
                $arr = array( 'added' => true, 'response' => esc_html__('Added', _yani_theme()->get_text_domain()) );
                echo json_encode($arr);
                wp_die();
            } else {
                $key = array_search( $property_id, $current_prop_fav );

                if( $key != false ) {
                    unset( $current_prop_fav[$key] );
                }

                update_option( $fav_option, $current_prop_fav );
                $arr = array( 'added' => false, 'response' => esc_html__('Removed', _yani_theme()->get_text_domain()) );
                echo json_encode($arr);
                wp_die();
            }
        }
        wp_die();
    }

    public function loadmore_properties() {
        global $yani_local;

        $yani_local = _yani_theme()->get_text_domain();
        $fake_loop_offset = 0; 

        $tax_query = array();
        $card_version = sanitize_text_field($_POST['card_version']);
        $property_type = yani_Data_Source::traverse_comma_string($_POST['type']);
        $property_status = yani_Data_Source::traverse_comma_string($_POST['status']);
        $property_state = yani_Data_Source::traverse_comma_string($_POST['state']);
        $property_city = yani_Data_Source::traverse_comma_string($_POST['city']);
        $property_country = yani_Data_Source::traverse_comma_string($_POST['country']);
        $property_area = yani_Data_Source::traverse_comma_string($_POST['area']);
        $property_label = yani_Data_Source::traverse_comma_string($_POST['label']);
        $yani_user_role = $_POST['user_role'];
        $featured_prop = $_POST['featured_prop'];
        $posts_limit = $_POST['prop_limit'];
        $sort_by = $_POST['sort_by'];
        $offset = $_POST['offset'];
        $paged = $_POST['paged'];

        $wp_query_args = array(
            'ignore_sticky_posts' => 1
        );

        if( !empty($yani_user_role) ) {
            $role_ids = yani_Data_Source::get_author_ids_by_role( $yani_user_role );
            if (!empty($role_ids)) {
                $wp_query_args['author__in'] = $role_ids;
            }
        }

        if (!empty($property_type)) {
            $tax_query[] = array(
                'taxonomy' => 'property_type',
                'field' => 'slug',
                'terms' => $property_type
            );
        }

        if (!empty($property_status)) {
            $tax_query[] = array(
                'taxonomy' => 'property_status',
                'field' => 'slug',
                'terms' => $property_status
            );
        }
        if (!empty($property_country)) {
            $tax_query[] = array(
                'taxonomy' => 'property_country',
                'field' => 'slug',
                'terms' => $property_country
            );
        }
        if (!empty($property_state)) {
            $tax_query[] = array(
                'taxonomy' => 'property_state',
                'field' => 'slug',
                'terms' => $property_state
            );
        }
        if (!empty($property_city)) {
            $tax_query[] = array(
                'taxonomy' => 'property_city',
                'field' => 'slug',
                'terms' => $property_city
            );
        }
        if (!empty($property_area)) {
            $tax_query[] = array(
                'taxonomy' => 'property_area',
                'field' => 'slug',
                'terms' => $property_area
            );
        }
        if (!empty($property_label)) {
            $tax_query[] = array(
                'taxonomy' => 'property_label',
                'field' => 'slug',
                'terms' => $property_label
            );
        }

        if ( $sort_by == 'a_price' ) {
            $wp_query_args['orderby'] = 'meta_value_num';
            $wp_query_args['meta_key'] = 'yani_property_price';
            $wp_query_args['order'] = 'ASC';
        } else if ( $sort_by == 'd_price' ) {
            $wp_query_args['orderby'] = 'meta_value_num';
            $wp_query_args['meta_key'] = 'yani_property_price';
            $wp_query_args['order'] = 'DESC';
        } else if ( $sort_by == 'a_date' ) {
            $wp_query_args['orderby'] = 'date';
            $wp_query_args['order'] = 'ASC';
        } else if ( $sort_by == 'd_date' ) {
            $wp_query_args['orderby'] = 'date';
            $wp_query_args['order'] = 'DESC';
        } else if ( $sort_by == 'featured_top' ) {
            $wp_query_args['orderby'] = 'meta_value';
            $wp_query_args['meta_key'] = 'yani_featured';
            $wp_query_args['order'] = 'DESC';
        } else if ( $sort_by == 'random' ) {
            $wp_query_args['orderby'] = 'rand';
            $wp_query_args['order'] = 'DESC';
        }

        if (!empty($featured_prop)) {
            
            if( $featured_prop == "yes" ) {
                $wp_query_args['meta_key'] = 'yani_featured';
                $wp_query_args['meta_value'] = '1';
            } else {
                $wp_query_args['meta_key'] = 'yani_featured';
                $wp_query_args['meta_value'] = '0';
            }
        }

        $tax_count = count( $tax_query );

    
        if( $tax_count > 1 ) {
            $tax_query['relation'] = 'AND';
        }
        if( $tax_count > 0 ){
            $wp_query_args['tax_query'] = $tax_query;
        }

        $wp_query_args['post_status'] = 'publish';

        if (empty($posts_limit)) {
            $posts_limit = get_option('posts_per_page');
        }
        $wp_query_args['posts_per_page'] = $posts_limit;

        if (!empty($paged)) {
            $wp_query_args['paged'] = $paged;
        } else {
            $wp_query_args['paged'] = 1;
        }

        if (!empty($offset) and $paged > 1) {
            $wp_query_args['offset'] = $offset + ( ($paged - 1) * $posts_limit) ;
        } else {
            $wp_query_args['offset'] = $offset ;
        }

        $fake_loop_offset = $offset;

        $wp_query_args['post_type'] = 'property';
        
        $the_query = new WP_Query($wp_query_args);

        
        if ($the_query->have_posts()) :
            while ($the_query->have_posts()) : $the_query->the_post();

                get_template_part('template-parts/listing/'.$card_version);

            endwhile;
            wp_reset_postdata();
        else:
            echo 'no_result';
        endif;
        

        wp_die();
    }

    public  function update_profile(){
        global $current_user;
        wp_get_current_user();
        $userID  = $current_user->ID;
        check_ajax_referer( 'yani_profile_ajax_nonce', 'houzez-security-profile' );

        $user_company = $userlangs = $latitude = $longitude = $tax_number = $user_location = $license = $user_address = $fax_number = $firstname = $lastname = $title = $about = $userphone = $usermobile = $userskype = $facebook = $twitter = $linkedin = $instagram = $pinterest = $profile_pic = $profile_pic_id = $website = $useremail = $service_areas = $specialties = $whatsapp = '';

        // Update first name
        if ( !empty( $_POST['firstname'] ) ) {
            $firstname = sanitize_text_field( $_POST['firstname'] );
            update_user_meta( $userID, 'first_name', $firstname );
        } else {
            delete_user_meta( $userID, 'first_name' );
        }

        // Update GDPR
        if ( !empty( $_POST['gdpr_agreement'] ) ) {
            $gdpr_agreement = sanitize_text_field( $_POST['gdpr_agreement'] );
            update_user_meta( $userID, 'gdpr_agreement', $gdpr_agreement );
        } else {
            delete_user_meta( $userID, 'gdpr_agreement' );
        }

        // Update last name
        if ( !empty( $_POST['lastname'] ) ) {
            $lastname = sanitize_text_field( $_POST['lastname'] );
            update_user_meta( $userID, 'last_name', $lastname );
        } else {
            delete_user_meta( $userID, 'last_name' );
        }

        // Update Language
        if ( !empty( $_POST['userlangs'] ) ) {
            $userlangs = sanitize_text_field( $_POST['userlangs'] );
            update_user_meta( $userID, 'yani_author_language', $userlangs );
        } else {
            delete_user_meta( $userID, 'yani_author_language' );
        }


        // Update user_company
        if ( !empty( $_POST['user_company'] ) ) {
            $agency_id = get_user_meta($userID, 'yani_author_agency_id', true);
            $user_company = sanitize_text_field( $_POST['user_company'] );
            if( !empty($agency_id) ) {
                $user_company = get_the_title($agency_id);
            }
            update_user_meta( $userID, 'yani_author_company', $user_company );
        } else {
            $agency_id = get_user_meta($userID, 'yani_author_agency_id', true);
            if( !empty($agency_id) ) {
                update_user_meta( $userID, 'yani_author_company', get_the_title($agency_id) );
            } else {
                delete_user_meta($userID, 'yani_author_company');
            }
        }

        // Update Title
        if ( !empty( $_POST['title'] ) ) {
            $title = sanitize_text_field( $_POST['title'] );
            update_user_meta( $userID, 'yani_author_title', $title );
        } else {
            delete_user_meta( $userID, 'yani_author_title' );
        }

        // Update About
        if ( !empty( $_POST['bio'] ) ) {
            $about = wp_kses_post(  wpautop( wptexturize( $_POST['bio'] ) ) );
            update_user_meta( $userID, 'description', $about );
        } else {
            delete_user_meta( $userID, 'description' );
        }

        // Update Phone
        if ( !empty( $_POST['userphone'] ) ) {
            $userphone = sanitize_text_field( $_POST['userphone'] );
            update_user_meta( $userID, 'yani_author_phone', $userphone );
        } else {
            delete_user_meta( $userID, 'yani_author_phone' );
        }

        // Update Fax
        if ( !empty( $_POST['fax_number'] ) ) {
            $fax_number = sanitize_text_field( $_POST['fax_number'] );
            update_user_meta( $userID, 'yani_author_fax', $fax_number );
        } else {
            delete_user_meta( $userID, 'yani_author_fax' );
        }

        // yani_author_service_areas
        if ( !empty( $_POST['service_areas'] ) ) {
            $service_areas = sanitize_text_field( $_POST['service_areas'] );
            update_user_meta( $userID, 'yani_author_service_areas', $service_areas );
        } else {
            delete_user_meta( $userID, 'yani_author_service_areas' );
        }

        // Specialties
        if ( !empty( $_POST['specialties'] ) ) {
            $specialties = sanitize_text_field( $_POST['specialties'] );
            update_user_meta( $userID, 'yani_author_specialties', $specialties );
        } else {
            delete_user_meta( $userID, 'yani_author_specialties' );
        }

        // Update Mobile
        if ( !empty( $_POST['usermobile'] ) ) {
            $usermobile = sanitize_text_field( $_POST['usermobile'] );
            update_user_meta( $userID, 'yani_author_mobile', $usermobile );
        } else {
            delete_user_meta( $userID, 'yani_author_mobile' );
        }

        // Update WhatsApp
        if ( !empty( $_POST['whatsapp'] ) ) {
            $whatsapp = sanitize_text_field( $_POST['whatsapp'] );
            update_user_meta( $userID, 'yani_author_whatsapp', $whatsapp );
        } else {
            delete_user_meta( $userID, 'yani_author_whatsapp' );
        }

        // Update Skype
        if ( !empty( $_POST['userskype'] ) ) {
            $userskype = sanitize_text_field( $_POST['userskype'] );
            update_user_meta( $userID, 'yani_author_skype', $userskype );
        } else {
            delete_user_meta( $userID, 'yani_author_skype' );
        }

        // Update facebook
        if ( !empty( $_POST['facebook'] ) ) {
            $facebook = sanitize_text_field( $_POST['facebook'] );
            update_user_meta( $userID, 'yani_author_facebook', $facebook );
        } else {
            delete_user_meta( $userID, 'yani_author_facebook' );
        }

        // Update twitter
        if ( !empty( $_POST['twitter'] ) ) {
            $twitter = sanitize_text_field( $_POST['twitter'] );
            update_user_meta( $userID, 'yani_author_twitter', $twitter );
        } else {
            delete_user_meta( $userID, 'yani_author_twitter' );
        }

        // Update linkedin
        if ( !empty( $_POST['linkedin'] ) ) {
            $linkedin = sanitize_text_field( $_POST['linkedin'] );
            update_user_meta( $userID, 'yani_author_linkedin', $linkedin );
        } else {
            delete_user_meta( $userID, 'yani_author_linkedin' );
        }

        // Update instagram
        if ( !empty( $_POST['instagram'] ) ) {
            $instagram = sanitize_text_field( $_POST['instagram'] );
            update_user_meta( $userID, 'yani_author_instagram', $instagram );
        } else {
            delete_user_meta( $userID, 'yani_author_instagram' );
        }

        // Update pinterest
        if ( !empty( $_POST['pinterest'] ) ) {
            $pinterest = sanitize_text_field( $_POST['pinterest'] );
            update_user_meta( $userID, 'yani_author_pinterest', $pinterest );
        } else {
            delete_user_meta( $userID, 'yani_author_pinterest' );
        }

        // Update youtube
        if ( !empty( $_POST['youtube'] ) ) {
            $youtube = sanitize_text_field( $_POST['youtube'] );
            update_user_meta( $userID, 'yani_author_youtube', $youtube );
        } else {
            delete_user_meta( $userID, 'yani_author_youtube' );
        }

        // Update vimeo
        if ( !empty( $_POST['vimeo'] ) ) {
            $vimeo = sanitize_text_field( $_POST['vimeo'] );
            update_user_meta( $userID, 'yani_author_vimeo', $vimeo );
        } else {
            delete_user_meta( $userID, 'yani_author_vimeo' );
        }

        // Update Googleplus
        if ( !empty( $_POST['googleplus'] ) ) {
            $googleplus = sanitize_text_field( $_POST['googleplus'] );
            update_user_meta( $userID, 'yani_author_googleplus', $googleplus );
        } else {
            delete_user_meta( $userID, 'yani_author_googleplus' );
        }

        // Update website
        if ( !empty( $_POST['website'] ) ) {
            $website = sanitize_text_field( $_POST['website'] );
            wp_update_user( array( 'ID' => $userID, 'user_url' => $website ) );
        } else {
            $website = '';
            wp_update_user( array( 'ID' => $userID, 'user_url' => $website ) );
        }

        //For agency Role

        if ( !empty( $_POST['license'] ) ) {
            $license = sanitize_text_field( $_POST['license'] );
            update_user_meta( $userID, 'yani_author_license', $license );
        } else {
            delete_user_meta( $userID, 'yani_author_license' );
        }

        if ( !empty( $_POST['tax_number'] ) ) {
            $tax_number = sanitize_text_field( $_POST['tax_number'] );
            update_user_meta( $userID, 'yani_author_tax_no', $tax_number );
        } else {
            delete_user_meta( $userID, 'yani_author_tax_no' );
        }

        if ( !empty( $_POST['user_address'] ) ) {
            $user_address = sanitize_text_field( $_POST['user_address'] );
            update_user_meta( $userID, 'yani_author_address', $user_address );
        } else {
            delete_user_meta( $userID, 'yani_author_address' );
        }

        if ( !empty( $_POST['user_location'] ) ) {
            $user_location = sanitize_text_field( $_POST['user_location'] );
            update_user_meta( $userID, 'yani_author_google_location', $user_location );
        } else {
            delete_user_meta( $userID, 'yani_author_google_location' );
        }

        if ( !empty( $_POST['latitude'] ) ) {
            $latitude = sanitize_text_field( $_POST['latitude'] );
            update_user_meta( $userID, 'yani_author_google_latitude', $latitude );
        } else {
            delete_user_meta( $userID, 'yani_author_google_latitude' );
        }

        if ( !empty( $_POST['longitude'] ) ) {
            $longitude = sanitize_text_field( $_POST['longitude'] );
            update_user_meta( $userID, 'yani_author_google_longitude', $longitude );
        } else {
            delete_user_meta( $userID, 'yani_author_google_longitude' );
        }

        // Update email
        if( !empty( $_POST['useremail'] ) ) {
            $useremail = sanitize_email( $_POST['useremail'] );
            $useremail = is_email( $useremail );
            if( !$useremail ) {
                echo json_encode( array( 'success' => false, 'msg' => esc_html__('The Email you entered is not valid. Please try again.', _yani_theme()->get_text_domain()) ) );
                wp_die();
            } else {
                $email_exists = email_exists( $useremail );
                if( $email_exists ) {
                    if( $email_exists != $userID ) {
                        echo json_encode( array( 'success' => false, 'msg' => esc_html__('This Email is already used by another user. Please try a different one.', _yani_theme()->get_text_domain()) ) );
                        wp_die();
                    }
                } else {
                    $return = wp_update_user( array ('ID' => $userID, 'user_email' => $useremail ) );
                    if ( is_wp_error( $return ) ) {
                        $error = $return->get_error_message();
                        echo esc_attr( $error );
                        wp_die();
                    }
                }

                $profile_pic_id = intval( $_POST['profile-pic-id'] );

                $agent_id = get_user_meta( $userID, 'yani_author_agent_id', true );
                $agency_id = get_user_meta( $userID, 'yani_author_agency_id', true );
                $user_as_agent = _yani_theme()->get_option('user_as_agent');

                if (in_array('yani_agent', (array)$current_user->roles)) {
                    _yani_user()->update_user_agent ( $agent_id, $firstname, $lastname, $title, $about, $userphone, $usermobile, $whatsapp, $userskype, $facebook, $twitter, $linkedin, $instagram, $pinterest, $youtube, $vimeo, $googleplus, $profile_pic, $profile_pic_id, $website, $useremail, $license, $tax_number, $fax_number, $userlangs, $user_address, $user_company, $service_areas, $specialties );
                } elseif(in_array('yani_agency', (array)$current_user->roles)) {
                    _yani_user()->update_agency_user_agent ( $agency_id, $firstname, $lastname, $title, $about, $userphone, $usermobile, $whatsapp, $userskype, $facebook, $twitter, $linkedin, $instagram, $pinterest, $youtube, $vimeo, $googleplus, $profile_pic, $profile_pic_id, $website, $useremail, $license, $tax_number, $user_address, $user_location, $latitude, $longitude, $fax_number, $userlangs );
                }

            }
        }
        wp_update_user( array ('ID' => $userID, 'display_name' => $_POST['display_name'] ) );
        echo json_encode( array( 'success' => true, 'msg' => esc_html__('Profile updated', _yani_theme()->get_text_domain()) ) );
        die();
    }

    public function property_agent_contact() {

        $agent_forms_terms = _yani_theme()->get_option('agent_forms_terms');
        $hide_form_fields = _yani_theme()->get_option('hide_prop_contact_form_fields');

        $nonce = $_POST['property_agent_contact_security'];
        if (!wp_verify_nonce( $nonce, 'property_agent_contact_nonce') ) {
            echo json_encode(array(
                'success' => false,
                'msg' => esc_html__('Invalid Nonce!', _yani_theme()->get_text_domain())
            ));
            wp_die();
        }

        $property_id = isset($_POST['property_id']) ? sanitize_text_field( $_POST['property_id'] ) : '';
        $sender_phone = isset($_POST['mobile']) ? sanitize_text_field( $_POST['mobile'] ) : '';
        $property_link = esc_url( $_POST['property_permalink'] );
        $property_title = sanitize_text_field( $_POST['property_title'] );

        $user_type = isset($_POST['user_type']) ? sanitize_text_field( $_POST['user_type'] ) : '';
        $user_type = _yani_email()->get_form_user_type($user_type);

        $target_email = $_POST['target_email'];

        // wp_send_json_success(array($property_id,$sender_phone,$property_link,$property_title,$user_type,$target_email));
        if ( !is_array( $target_email ) ) {
            $target_email = is_email($target_email);
        }
        if (!$target_email) {
            echo json_encode(array(
                'success' => false,
                'msg' => sprintf( esc_html__('%s Email address is not configured!', _yani_theme()->get_text_domain()), $target_email )
            ));
            wp_die();
        }

        $sender_name = isset($_POST['name']) ? sanitize_text_field($_POST['name']) : '';
        if ( empty($sender_name) && $hide_form_fields['name'] != 1 ) {
            echo json_encode(array(
                'success' => false,
                'msg' => esc_html__('Name field is empty!', _yani_theme()->get_text_domain())
            ));
            wp_die();
        }

        
        if ( empty($sender_phone) && $hide_form_fields['phone'] != 1 ) {
            echo json_encode(array(
                'success' => false,
                'msg' => esc_html__('Phone field is empty!', _yani_theme()->get_text_domain())
            ));
            wp_die();
        }

        $sender_email = sanitize_email($_POST['email']);
        $sender_email = is_email($sender_email);
        if (!$sender_email) {
            echo json_encode(array(
                'success' => false,
                'msg' => esc_html__('Invalid email address!', _yani_theme()->get_text_domain())
            ));
            wp_die();
        }

        $sender_msg = stripslashes( $_POST['message'] );
        if ( empty($sender_msg) && $hide_form_fields['message'] != 1 ) {
            echo json_encode(array(
                'success' => false,
                'msg' => esc_html__('Your message is empty!', _yani_theme()->get_text_domain())
            ));
            wp_die();
        }

        
        if( _yani_theme()->get_option('gdpr_and_terms_checkbox', 1) ) {
            $privacy_policy = $_POST['privacy_policy'];
            if ( empty($privacy_policy) ) {
                echo json_encode(array(
                    'success' => false,
                    'msg' => _yani_theme()->get_option('agent_forms_terms_validation')
                ));
                wp_die();
            }
        }
        

        // yani_google_recaptcha_callback();

        $cc_email = '';
        $bcc_email = '';
        $send_message_copy = _yani_theme()->get_option('send_agent_message_copy');
        if( $send_message_copy == '1' ){
            $cc_email = _yani_theme()->get_option( 'send_agent_message_email' );
        }

        $args = array(
            'sender_name' => $sender_name, 
            'sender_email' => $sender_email, 
            'sender_phone' => $sender_phone, 
            'property_title' => $property_title, 
            'property_link' => $property_link, 
            'property_id' => $property_id, 
            'user_type' => $user_type, 
            'sender_message' => $sender_msg, 
        );

        $email_sent = _yani_email()->email_with_reply( $target_email, 'property_agent_contact', $args, $sender_name, $sender_email, $cc_email, $bcc_email);


        if ( $email_sent ) {

            if( _yani_theme()->get_option('webhook_property_agent_contact') == 1 ) {
                _yani_email()->init_webhook_post( $_POST, 'yani_property_agent_contact_form' );
            } 

            echo json_encode( array(
                'success' => true,
                'msg' => esc_html__("Email Sent Successfully!", _yani_theme()->get_text_domain())
            ));
        } else {
            echo json_encode(array(
                    'success' => false,
                    'msg' => esc_html__("Server Error: Make sure Email function working on your server!", _yani_theme()->get_text_domain())
                )
            );
        }

        $activity_args = array(
            'type' => 'lead',
            'name' => $sender_name,
            'email' => $sender_email,
            'phone' => $sender_phone,
            'user_type' => $user_type,
            'message' => $sender_msg,
        );
        do_action('yani_record_activities', $activity_args);

        do_action('yani_after_agent_form_submission');
        

        wp_die();

    }

    public function start_thread() {

		$nonce = $_POST['start_thread_form_ajax'];


		if ( !wp_verify_nonce( $nonce, 'property_agent_contact_nonce') ) {
			echo json_encode( array(
				'success' => false,
				'msg' => esc_html__('Unverified Nonce!', _yani_theme()->get_text_domain())
			));
			wp_die();
		}

		if ( isset( $_POST['property_id'] ) && !empty( $_POST['property_id'] ) && isset( $_POST['message'] ) && !empty( $_POST['message'] ) ) {

			$message = $_POST['message'];

			$thread_id = apply_filters( 'yani_start_thread', $_POST["property_id"] );
			$message_id = apply_filters( 'yani_thread_message', $thread_id, $message, Array() );


			if ( $message_id ) {

				echo json_encode(
					array(
						'success' => true,
						'msg' => esc_html__("Message sent successfully!", _yani_theme()->get_text_domain())
					)
				);

				wp_die();

			}

		}

		echo json_encode(
			array(
				'success' => false,
				'msg' => esc_html__("Some errors occurred! Please try again.", _yani_theme()->get_text_domain())
			)
		);

		wp_die();

	}

	public function init_thread_message() {

		$nonce = $_POST['start_thread_message_form_ajax'];

		if ( !wp_verify_nonce( $nonce, 'start-thread-message-form-nonce') ) {
			echo json_encode( array(
				'success' => false,
				'url' => _yani_template()->get_template_link('template/user_dashboard_messages.php') . '?' . http_build_query( array( 'thread_id' => $thread_id, 'success' => false ) ),
				'msg' => esc_html__('Unverified Nonce!', _yani_theme()->get_text_domain())
			));
			wp_die();
		}

		if ( isset( $_POST['thread_id'] ) && !empty( $_POST['thread_id'] ) && isset( $_POST['message'] ) && !empty( $_POST['message'] ) ) {
			$message_attachments = Array ();
			$thread_id = $_POST['thread_id'];
			$message = $_POST['message'];

			if ( isset( $_POST['propperty_image_ids'] ) && sizeof( $_POST['propperty_image_ids'] ) != 0 ) {
				$message_attachments = $_POST['propperty_image_ids'];
			}
			$message_attachments = serialize( $message_attachments );
			$message_id = apply_filters( 'yani_thread_message', $thread_id, $message, $message_attachments );

			if ( $message_id ) {

				echo json_encode(
					array(
						'success' => true,
						'url' => _yani_template()->get_template_link('template/user_dashboard_messages.php') . '?' . http_build_query( array( 'thread_id' => $thread_id, 'success' => true ) ),
						'msg' => esc_html__("Thread success fully created!", _yani_theme()->get_text_domain())
					)
				);

				wp_die();

			}

		}

		echo json_encode(
			array(
				'success' => false,
				'url' => _yani_template()->get_template_link('template/user_dashboard_messages.php') . '?' . http_build_query( array( 'thread_id' => $thread_id, 'success' => false ) ),
				'msg' => esc_html__("Some errors occurred! Please try again.", _yani_theme()->get_text_domain())
			)
		);

		wp_die();

	}

		public static function get_instance() {

			// If the single instance hasn't been set, set it now.
			if ( null == self::$instance ) {
				self::$instance = new self;
			}
			return self::$instance;
		}		
	

	public function contact_realtor() {

        $hide_form_fields = _yani_theme()->get_option('hide_agency_agent_contact_form_fields');

        $nonce = $_POST['contact_realtor_ajax'];
        if (!wp_verify_nonce( $nonce, 'contact_realtor_nonce') ) {
            echo json_encode(array(
                'success' => false,
                'msg' => esc_html__('Unverified Nonce!', _yani_theme()->get_text_domain())
            ));
            wp_die();
        }

        $sender_phone = isset($_POST['mobile']) ? sanitize_text_field( $_POST['mobile'] ) : '';
        $user_type = isset($_POST['user_type']) ? sanitize_text_field( $_POST['user_type'] ) : '';
        $agent_type = isset($_POST['agent_type']) ? sanitize_text_field( $_POST['agent_type'] ) : '';
        $user_type = _yani_email()->get_form_user_type($user_type); 

        $target_email = sanitize_email($_POST['target_email']);
        $target_email = is_email($target_email);
        if (!$target_email) {
            echo json_encode(array(
                'success' => false,
                'msg' => sprintf( esc_html__('%s Target Email address is not properly configured!', _yani_theme()->get_text_domain()), $target_email )
            ));
            wp_die();
        }


        $sender_name = isset($_POST['name']) ? sanitize_text_field($_POST['name']) : '';
        if ( empty($sender_name) && $hide_form_fields['name'] != 1 ) {
            echo json_encode(array(
                'success' => false,
                'msg' => esc_html__('Name field is empty!', _yani_theme()->get_text_domain())
            ));
            wp_die();
        }

        $sender_email = sanitize_email($_POST['email']);
        $sender_email = is_email($sender_email);
        if (!$sender_email) {
            echo json_encode(array(
                'success' => false,
                'msg' => esc_html__('Provided Email address is invalid!', _yani_theme()->get_text_domain())
            ));
            wp_die();
        }

        $sender_msg = isset($_POST['message']) ? $_POST['message'] : '';
        if ( empty($sender_msg) && $hide_form_fields['message'] != 1 ) {
            echo json_encode(array(
                'success' => false,
                'msg' => esc_html__('Your message empty!', _yani_theme()->get_text_domain())
            ));
            wp_die();
        }

        
        if( _yani_theme()->get_option('gdpr_and_terms_checkbox', 1) ) {
            $privacy_policy = $_POST['privacy_policy'];
            if ( empty($privacy_policy) ) {
                echo json_encode(array(
                    'success' => false,
                    'msg' => _yani_theme()->get_option('agent_forms_terms_validation')
                ));
                wp_die();
            }
        }
        

        // yani_google_recaptcha_callback();

        $email_subject = sprintf( esc_html__('New message sent by %s using contact form at %s', _yani_theme()->get_text_domain()), $sender_name, get_bloginfo('name') );

        $email_body = esc_html__("You have received a message from: ", _yani_theme()->get_text_domain()) . $sender_name . " <br/>";
        if (!empty($sender_phone)) {
            $email_body .= esc_html__("Phone Number : ", _yani_theme()->get_text_domain()) . $sender_phone . " <br/>";
        }
        if (!empty($user_type)) {
            $email_body .= esc_html__("User Type : ", _yani_theme()->get_text_domain()) . $user_type . " <br/>";
        }
        $email_body .= esc_html__("Additional message is as follows.", _yani_theme()->get_text_domain()) . " <br/>";
        $email_body .= wp_kses_post( wpautop( wptexturize( $sender_msg ) ) ) . " <br/>";
        $email_body .= sprintf( esc_html__( 'You can contact %s via email %s', _yani_theme()->get_text_domain()), $sender_name, $sender_email );

        $headers = array();
        $headers[] = "From: $sender_name <$sender_email>";
        $headers[] = "Reply-To: $sender_name <$sender_email>";
        $headers[] = "Content-Type: text/html; charset=UTF-8";
        $headers = apply_filters( "yani_realtors_mail_header", $headers );// Filter for modify the header in child theme

        if (wp_mail( $target_email, $email_subject, $email_body, $headers)) {
            echo json_encode( array(
                'success' => true,
                'msg' => esc_html__("Message Sent Successfully!", _yani_theme()->get_text_domain())
            ));

            if( _yani_theme()->get_option('webhook_agency_contact') == 1 && $agent_type == "agency_info" ) {
                _yani_email()->init_webhook_post( $_POST, 'yani_agency_profile_contact_from' );

            } elseif( ( _yani_theme()->get_option('webhook_agent_contact') == 1 ) && ( $agent_type == "agent_info" || $agent_type == "author_info" ) ) {
                _yani_email()->init_webhook_post( $_POST, 'yani_agent_profile_contact_from' );
            }

        } else {
            echo json_encode(array(
                    'success' => false,
                    'msg' => esc_html__("Server Error: Make sure Email function working on your server!", _yani_theme()->get_text_domain())
                )
            );
        }

        $activity_args = array(
            'type' => 'lead_agent',
            'name' => $sender_name,
            'email' => $sender_email,
            'phone' => $sender_phone,
            'user_type' => $user_type,
            'message' => $sender_msg,
        );
        do_action('yani_record_activities', $activity_args);

        do_action('yani_after_agent_form_submission');
        
        wp_die();
    	}
   

    public function get_auto_complete_search() {
        $current_language = apply_filters( 'wpml_current_language', null );
        global $wpdb;
        $key = $_POST['key'];
        $keyword_field = _yani_theme()->get_option('keyword_field');
        $yani_local = _yani_theme()->get_localization();
        $response = '';

        if( $keyword_field != 'prop_city_state_county' ) {

            if ( $keyword_field == "prop_title" ) {

                $table = $wpdb->posts;
                $data = $wpdb->get_results( "SELECT DISTINCT * FROM $table WHERE post_type='property' and post_status='publish' and (post_title LIKE '%$key%' OR post_content LIKE '%$key%')" );

                if ( sizeof( $data ) != 0 ) {

                    $search_url = add_query_arg( 'keyword', $key, _yani_template()->get_search_template_link() );

                    echo '<div class="auto-complete-keyword">';
                    echo '<ul class="list-group">';

                    $new_data = array();

                    foreach ( $data as $post ) {

                        $propID = $post->ID;

                        $post_language = apply_filters( 'wpml_element_language_code', null, array('element_id' => $propID, 'element_type' => 'post'));

                        if ($post_language !== $current_language) {
                            continue;
                        }

                        $new_data [] = $post;
                        
                        // echo $prop_thumb = get_the_post_thumbnail( $propID );
                        $prop_beds = get_post_meta( $propID, 'yani_property_bedrooms', true );
                        $prop_baths = get_post_meta( $propID, 'yani_property_bathrooms', true );
                        $prop_size = _yani_listing()->get_area_size( $propID );
                        $prop_type = _yani_taxonomy()->get_taxonomy_simple('property_type');
                        $prop_img = get_the_post_thumbnail_url( $propID, array ( 40, 40 ) );

                        if ( empty( $prop_img ) ) {
                            $prop_img = _yani_image()->get_image_placeholder_url('thumbnail');
                        }

                        ?>

                        <li class="list-group-item" data-text="<?php echo $post->post_title; ?>">
                            <div class="d-flex align-items-center">
                                <div class="auto-complete-image-wrap">
                                    <a href="<?php the_permalink( $propID ); ?>">
                                        <img class="img-fluid rounded" src="<?php echo $prop_img; ?>" width="40" height="40" alt="image">
                                    </a>    
                                </div><!-- auto-complete-image-wrap -->
                                <div class="auto-complete-content-wrap ml-3">
                                    <div class="auto-complete-title">
                                        <a href="<?php the_permalink( $propID ); ?>"><?php echo $post->post_title; ?></a>
                                    </div>
                                </div><!-- auto-complete-content-wrap -->
                            </div><!-- d-flex -->
                        </li><!-- list-group-item -->
                        <?php

                    }

                    echo '</ul>';

                    echo '<div class="auto-complete-footer">';
                        echo '<span class="auto-complete-count"><i class="yani-icon icon-pin mr-1"></i> ' . sizeof( $new_data ) . ' '.$yani_local['listins_found'].'</span>';
                        echo '<a target="_blank" href="' . $search_url . '" class="search-result-view">'.$yani_local['view_all_results'].'</a>';
                    echo '</div>';


                    echo '</div>';

                } else {

               ?>
               <ul class="list-group">
                   <li class="list-group-item"> <?php echo $yani_local['auto_result_not_found']; ?> </li>
               </ul>
               <?php

           }

       } else if ( $keyword_field == "prop_address" ) {

                $posts_table = $wpdb->posts;
                $postmeta_table = $wpdb->postmeta;
                $data = $wpdb->get_results( "SELECT DISTINCT post.ID, meta.meta_value FROM $postmeta_table AS meta INNER JOIN $posts_table AS post ON meta.post_id=post.ID AND post.post_type='property' and post.post_status='publish' AND meta.meta_value LIKE '%$key%'AND ( meta.meta_key='yani_property_map_address' OR meta.meta_key='yani_property_zip' OR meta.meta_key='yani_property_address' OR meta.meta_key='yani_property_id' )" );

                if ( sizeof( $data ) != 0 ) {

                    echo '<ul class="list-group">';

                    $new_data = array();

                    foreach ( $data as $title ) {

                        $post_language = apply_filters( 'wpml_element_language_code', null, array('element_id' => $title->ID, 'element_type' => 'post'));

                        if ($post_language !== $current_language) {
                            continue;
                        }

                        $new_data [] = $title;
                        ?>
                        
                        <li class="list-group-item" data-text="<?php echo $title->meta_value; ?>">
                            <div class="d-flex align-items-center">
                                <div class="auto-complete-content-wrap flex-fill">
                                    <i class="yani-icon icon-pin mr-1"></i> <?php echo $title->meta_value; ?>
                                </div><!-- auto-complete-content-wrap -->
                            </div><!-- d-flex -->
                        </li>
                        <?php

                    }

                    echo '</ul>';

                } else {

               ?>
               <ul class="list-group">
                   <li class="list-group-item"> <?php echo $yani_local['auto_result_not_found']; ?> </li>
               </ul>
               <?php

           }

            }

        } else {
            $terms_table = $wpdb->terms;
            $term_taxonomy = $wpdb->term_taxonomy;
            $data = $wpdb->get_results( "SELECT DISTINCT * FROM $terms_table as term INNER JOIN $term_taxonomy AS term_taxonomy
                ON term.term_id=term_taxonomy.term_id AND term.name LIKE '%$key%' AND ( term_taxonomy.taxonomy = 'property_area' OR term_taxonomy.taxonomy = 'property_city' OR term_taxonomy.taxonomy = 'property_state' )" );

            if ( sizeof( $data ) != 0 ) {

                echo '<ul class="list-group">';

                $new_data = array();

                foreach ( $data as $term ) {
                    
                    $term_language = apply_filters( 'wpml_element_language_code', null, array('element_id' => $term->term_id, 'element_type' => 'category'));

                    if ($term_language !== $current_language) {
                        continue;
                    }

                    $new_data [] = $term;

                    $taxonomy_img_id = get_term_meta( $term->term_id, 'yani_taxonomy_img', true );
                    $term_type = explode( 'property_', $term->taxonomy );
                    $term_type = $term_type[1];
                    $prop_count = $term->count;

                    if ( empty( $taxonomy_img_id ) ) {
                       $term_img = '<img src="http://placehold.it/40x40" width="40" height="40">';
                   } else {
                        $term_img = wp_get_attachment_image( $taxonomy_img_id, array( 40, 40 ), array( "class" => "img-fluid rounded" ) );
                   }

                    if ( $term_type == 'city' ) {
                        $term_type = $yani_local['auto_city'];
                    } elseif ( $term_type == 'area' ) {
                        $term_type = $yani_local['auto_area'];
                    } else {
                        $term_type = $yani_local['auto_state'];
                    }

                    ?>
                    <li class="list-group-item" data-text="<?php echo $term->name; ?>">
                        <div class="d-flex align-items-center">
                            <div class="auto-complete-image-wrap">
                                <a href="<?php echo get_term_link( $term ); ?>">
                                    <?php echo $term_img; ?>
                                </a>    
                            </div><!-- auto-complete-image-wrap -->
                            <div class="auto-complete-content-wrap flex-fill ml-3">
                                <div class="auto-complete-title"><?php echo esc_attr($term->name); ?></div>
                                <ul class="item-amenities">
                                    <li><?php if ( !empty( $term_type ) ) { ?>
                                    <?php echo $term_type; ?>
                                <?php } ?>
                                <?php if ( !empty( $prop_count ) ) : ?>
                                     - <?php echo $prop_count . ' ' . $yani_local['auto_listings']; ?>
                                <?php endif; ?></li>
                                </ul>
                            </div><!-- auto-complete-content-wrap -->
                            <div class="auto-complete-content-wrap ml-3">
                                <a target="_blank" href="<?php echo get_term_link( $term ); ?>" class="search-result-view"><?php echo $yani_local['auto_view_lists']; ?></a>
                            </div><!-- auto-complete-content-wrap -->
                        </div><!-- d-flex -->
                    </li>
                    <?php

                }

                echo '</ul>';

            } else {

               ?>
               <ul class="list-group">
                   <li class="list-group-item"> <?php echo $yani_local['auto_result_not_found']; ?> </li>
               </ul>
               <?php

           }

        }

        wp_die();

    }

    public function property_paypal_payment() {
        global $current_user;
        $propID        =   intval($_POST['prop_id']);
        $is_prop_featured   =   intval($_POST['is_prop_featured']);
        $is_prop_upgrade    =   intval($_POST['is_prop_upgrade']);
        $relist_mode    =   isset( $_POST['relist_mode'] ) ? esc_attr($_POST['relist_mode']) : '';
        $price_per_submission = _yani_theme()->get_option('price_listing_submission');
        $price_featured_submission = _yani_theme()->get_option('price_featured_listing_submission');
        $currency = _yani_theme()->get_option('currency_paid_submission');

        $blogInfo = esc_url( home_url() );

        wp_get_current_user();
        $userID =   $current_user->ID;
        $post   =   get_post($propID);

        if( $post->post_author != $userID ){
            wp_die('Are you kidding?');
        }

        $is_paypal_live             =   _yani_theme()->get_option('paypal_api');
        $host                       =   'https://api.sandbox.paypal.com';
        $price_per_submission       =   floatval( $price_per_submission );
        $price_featured_submission  =   floatval( $price_featured_submission );
        $submission_curency         =   esc_html( $currency );
        $payment_description        =   esc_html__('Listing payment on ',_yani_theme()->get_text_domain()).$blogInfo;

        if( $is_prop_featured == 0 ) {
            $total_price =  number_format( $price_per_submission, 2, '.','' );
        } else {
            $total_price = $price_per_submission + $price_featured_submission;
            $total_price = number_format( $total_price, 2, '.','' );
        }

        if ( $is_prop_upgrade == 1 ) {
            $total_price     =  number_format($price_featured_submission, 2, '.','');
            $payment_description =   esc_html__('Upgrade to featured listing on ',_yani_theme()->get_text_domain()).$blogInfo;
        }

        // Check if payal live
        if( $is_paypal_live =='live'){
            $host='https://api.paypal.com';
        }

        $url             =   $host.'/v1/oauth2/token';
        $postArgs        =   'grant_type=client_credentials';

        // Get Access token
        $paypal_token    =   _yani_payment()->get_paypal_access_token( $url, $postArgs );
        $url             =   $host.'/v1/payments/payment';//
        // $cancel_link     =   _yani_template()->get_template_link('template/user_dashboard_properties.php');
        $cancel_link     =   "http://riseup.local/payments/";
        $return_link     =   _yani_template()->get_template_link('template/template-thankyou.php');

        $payment = array(
            'intent' => 'sale',
            "redirect_urls" => array(
                "return_url" => $return_link,
                "cancel_url" => $cancel_link
            ),
            'payer' => array("payment_method" => "paypal"),
        );
        /* Prepare basic payment details
        *--------------------------------------*/
        $payment['transactions'][0] = array(
            'amount' => array(
                'total' => $total_price,
                'currency' => $submission_curency,
                'details' => array(
                    'subtotal' => $total_price,
                    'tax' => '0.00',
                    'shipping' => '0.00'
                )
            ),
            'description' => $payment_description
        );

        // wp_send_json_success($payment);
        /* Prepare individual items
        *--------------------------------------*/
        if( $is_prop_upgrade == 1 ) {

            $payment['transactions'][0]['item_list']['items'][] = array(
                'quantity' => '1',
                'name' => esc_html__('Upgrade to Featured Listing',_yani_theme()->get_text_domain()),
                'price' => $total_price,
                'currency' => $submission_curency,
                'sku' => 'Upgrade Listing',
            );

        } else {
            if( $is_prop_featured == 1 ) {

                $payment['transactions'][0]['item_list']['items'][] = array(
                    'quantity' => '1',
                    'name' => esc_html__('Listing with Featured Payment option',_yani_theme()->get_text_domain()),
                    'price' => $total_price,
                    'currency' => $submission_curency,
                    'sku' => 'Featured Paid Listing',
                );

            } else {
                $payment['transactions'][0]['item_list']['items'][] = array(
                    'quantity' => '1',
                    'name' => esc_html__('Listing Payment',_yani_theme()->get_text_domain()),
                    'price' => $total_price,
                    'currency' => $submission_curency,
                    'sku' => 'Paid Listing',
                );
            }
        }

        /* Convert PHP array into json format
        *--------------------------------------*/
        $jsonEncode = json_encode($payment);
        $json_response = _yani_payment()->execute_paypal_request( $url, $jsonEncode, $paypal_token );

        //print_r($json_response);
        foreach ($json_response['links'] as $link) {
            if($link['rel'] == 'execute'){
                $payment_execute_url = $link['href'];
            } else  if($link['rel'] == 'approval_url'){
                $payment_approval_url = $link['href'];
            }
        }

        // Save data in database for further use on processor page
        $output['payment_execute_url'] = $payment_execute_url;
        $output['paypal_token']        = $paypal_token;
        $output['property_id']         = $propID;
        $output['is_prop_featured']    = $is_prop_featured;
        $output['is_prop_upgrade']     = $is_prop_upgrade;
        $output['relist_mode']         = $relist_mode;

        $save_output[$current_user->ID]   =   $output;
        update_option('yani_paypal_transfer',$save_output);

        print $payment_approval_url;

        wp_die();

    }
    public function reviews_likes_dislikes() {
		$review_id = $_POST['review_id'];
		$type = $_POST['type'];
		

		$cookie_name = $type.$review_id;
		$cookie_value = true;
		$likeDislikeCookie = (isset($_COOKIE[$cookie_name])) ? $_COOKIE[$cookie_name] : array();

		if($type == 'likes') { 
			$cookie_dislike = 'dislikes'.$review_id;
			unset($_COOKIE[$cookie_dislike]);
			setcookie($cookie_dislike, '', time() - 3600);

		} elseif($type == 'dislikes') {
			$cookie_like = 'likes'.$review_id;
			unset($_COOKIE[$cookie_like]);
			setcookie($cookie_like, '', time() - 3600);
		}

		if(empty($likeDislikeCookie)) {

			setcookie($cookie_name , $cookie_value , time() + (3600 * 24 * 30));

			$current_likes = get_post_meta($review_id, 'review_likes', true);
			$current_dislikes = get_post_meta($review_id, 'review_dislikes', true);

			if($type == 'likes') {
				
				if(!empty($current_likes)) {
					$current_likes++;
				} else {
					$current_likes = 1;
				}

				if(!empty($current_dislikes)) {
					$current_dislikes--;
				} else {
					$current_dislikes = 0;
				}

			} elseif($type == 'dislikes') {
				if(!empty($current_likes)) {
					$current_likes--;
				} else {
					$current_likes = 0;
				}

				if(!empty($current_dislikes)) {
					$current_dislikes++;
				} else {
					$current_dislikes = 1;
				}
			}
			
			update_post_meta($review_id, 'review_likes', $current_likes);
			update_post_meta($review_id, 'review_dislikes', $current_dislikes);

			echo json_encode( array(
	            'success' => true,
	            'likes' => $current_likes,
	            'dislikes' => $current_dislikes,
	            'msg' => esc_html__('Thanks for voting', _yani_theme()->get_text_domain())
	        ));
	        wp_die();

		} else {
		
			echo json_encode( array(
	            'success' => false,
	            'msg' => esc_html__("You have already voted", _yani_theme()->get_text_domain())
	        ));
	        wp_die();
		}
	}

	public function submit_review() {
    	$userID = get_current_user_id();
    	$username = '';
    	$creds = array();
    	$reviews_approved = _yani_theme()->get_option('property_reviews_approved_by_admin');
    	$update_reviews_approved = _yani_theme()->get_option('update_review_approved');

        $nonce = $_POST['review-security'];
        if (!wp_verify_nonce( $nonce, 'review-nonce') ) {
            echo json_encode(array(
                'success' => false,
                'msg' => esc_html__('Invalid Nonce!', _yani_theme()->get_text_domain())
            ));
            wp_die();
        }

        $admin_email = get_option( 'admin_email' );

        $review_title = sanitize_text_field( $_POST['review_title'] );
        $permalink = esc_url( $_POST['permalink'] );
        $review_stars = sanitize_text_field( $_POST['review_stars'] );
        $review = wp_kses_post( $_POST['review'] );
        $listing_title = sanitize_text_field( $_POST['listing_title'] );
        $listing_title = esc_attr(strip_tags( $listing_title ));
        $review_post_type = sanitize_text_field( $_POST['review_post_type'] );
        $listing_id = sanitize_text_field( $_POST['listing_id'] );

        if(is_author()) {
        	$property_author_id = $userID;
        } else {
	        $property_author_id = get_post_field( 'post_author', $listing_id );
	    }


        if ( empty($review_title) ) {
            echo json_encode(array(
                'success' => false,
                'msg' => esc_html__('Review title field is empty!', _yani_theme()->get_text_domain())
            ));
            wp_die();
        }

        if ( empty($review_stars) ) {
            echo json_encode(array(
                'success' => false,
                'msg' => esc_html__('Select rating!', _yani_theme()->get_text_domain())
            ));
            wp_die();
        }

        if (empty($review)) {
            echo json_encode(array(
                'success' => false,
                'msg' => esc_html__('Write review!', _yani_theme()->get_text_domain())
            ));
            wp_die();
        }


    	$new_review = array(
            'post_type'	=> 'yani_reviews'
        );
        $review_id = 0;
        $new_review['post_title'] = $review_title;
        $new_review['post_content'] = wp_kses_post( $review );
        $new_review['post_author'] = $userID;


        $submission_action = intval($_POST['is_update']);

		if ( is_user_logged_in() ) {

			//Check if user already posted review 
			if(_yani_review()->check_user_review($userID, $listing_id, $review_post_type)) {
				echo json_encode( array (
		            'success' => false,
		            'review_link' => '',
		            'msg' => esc_html__("Sorry! You have already posted review on this listing!", _yani_theme()->get_text_domain())
		        ));
		        wp_die();

			} elseif( $userID == $property_author_id ) {

				echo json_encode( array (
		            'success' => false,
		            'review_link' => '',
		            'msg' => esc_html__("Sorry! Listing owners can not post review on their listings!", _yani_theme()->get_text_domain())
		        ));
		        wp_die();

			} else {

				if( $submission_action == 1 ) {

		        	$new_review['ID'] = intval( $_POST['review_id'] );
			        if($update_reviews_approved) {
			        	$new_review['post_status'] = 'pending';
			        } else {
			        	$new_review['post_status'] = 'publish';
			        }

			        $review_id = wp_update_post( $new_review );

		        } else {
		        	if($reviews_approved) {
			        	$new_review['post_status'] = 'pending';
			        } else {
			        	$new_review['post_status'] = 'publish';
			        }
			        $review_id = wp_insert_post( $new_review );
		        }
			}

			$username = get_the_author_meta( 'display_name', get_current_user_id() );
	        
	    } else {

	    	$reviewer_email = sanitize_text_field( $_POST['review_email'] );

	    	if( !is_email( $reviewer_email ) ) {

	            echo json_encode( array( 'success' => false, 'msg' => esc_html__('Invalid email address.', _yani_theme()->get_text_domain()) ) );
	            wp_die();

	        } else if( email_exists( $reviewer_email ) ) {

	            echo json_encode( array( 'success' => false, 'msg' => esc_html__('Email already exists! Please login or change email', _yani_theme()->get_text_domain()) ) );
	            wp_die();

	        } else {

	        	$user_password = wp_generate_password( $length = 12, $include_standard_special_chars = false );
	        	list($username) = explode('@', $reviewer_email);
				$username .=rand(1,100);

				if( username_exists( $username ) ) {
		            echo json_encode( array( 'success' => false, 'msg' => $username.' '.esc_html__('Username already exist!', _yani_theme()->get_text_domain()) ) );
		            wp_die();
		        }

		        $user_id = wp_create_user( $username, $user_password, $reviewer_email );
				$creds['user_login'] = $username;
				$creds['user_password'] = $user_password;
				$creds['remember'] = true;
				$user = wp_signon( $creds, true );

				if($reviews_approved) {
		        	$new_review['post_status'] = 'pending';
		        } else {
		        	$new_review['post_status'] = 'publish';
		        }

		        $new_review['post_author'] = $user_id;
		        $review_id = wp_insert_post( $new_review );

		        _yani_user()->new_user_notification( $user_id, $user_password );
	        }
	        
	    }
        
        if($review_id > 0) {

        	update_post_meta($review_id, 'review_post_type', $review_post_type);
        	update_post_meta($review_id, 'review_stars', $review_stars);
        	update_post_meta($review_id, 'review_by', $userID);
        	update_post_meta($review_id, 'review_to', $property_author_id);

        	$meta_key = '';
        	if($review_post_type == 'property') {
        		update_post_meta($review_id, 'review_property_id', $listing_id);
        		$meta_key = 'review_property_id';
        		$review_link = add_query_arg( 'tab', 'reviews#review-'.$review_id, $permalink );

        	} else if($review_post_type == 'yani_agent') {
        		update_post_meta($review_id, 'review_agent_id', $listing_id);
        		$meta_key = 'review_agent_id';
        		$review_link = add_query_arg( 'tab', 'reviews', $permalink );

        	} else if($review_post_type == 'yani_agency') {
        		update_post_meta($review_id, 'review_agency_id', $listing_id);
        		$meta_key = 'review_agency_id';
        		$review_link = add_query_arg( 'tab', 'reviews', $permalink );

        	} else if($review_post_type == 'yani_author') {
        		update_post_meta($review_id, 'review_author_id', $listing_id);
        		$meta_key = 'review_author_id';
        		$review_link = add_query_arg( 'tab', 'reviews', $permalink );
        	}

        	_yani_review()->add_listing_rating($listing_id, $meta_key, $review_stars);

      
        	$site_name = get_bloginfo('name');

	        $subject = sprintf( esc_html__('A new rating has been received for %s', _yani_theme()->get_text_domain()), $listing_title, $site_name );

	        $body = esc_html__("Rating:", _yani_theme()->get_text_domain()) .' '. esc_attr($review_stars) . " ".esc_html__('stars', _yani_theme()->get_text_domain())." <br/>";

	     	$body .= esc_html__("Review Title:", _yani_theme()->get_text_domain()) .' '. $review_title . " <br/>";

	     	$body .= esc_html__("Comment:", _yani_theme()->get_text_domain()) .' '.( $review ). " <br/>";

			$body .= "<br>------------------------------------<br>";

			$body .= "<br>".esc_html__("You can view this at", _yani_theme()->get_text_domain()).' '.esc_url( $review_link ). " <br/>";

			$body .= "<br>".esc_html__('Do not reply to this email.', _yani_theme()->get_text_domain())."<br>";

	        $headers = "Content-Type: text/html; charset=UTF-8\r\n";
	        $headers .= 'From: '.$site_name.' <do-not-reply@'.$_SERVER['HTTP_HOST'].'>' . "\r\n";
        	$headers .= "MIME-Version: 1.0\r\n";

	        wp_mail( $admin_email, $subject, $body, $headers );

	        echo json_encode( array(
	            'success' => true,
	            'review_link' => $review_link,
	            'msg' => esc_html__("Review has been submitted successfully!", _yani_theme()->get_text_domain())
	        ));
	    }

	    $activity_args = array(
            'type' => 'review',
            'review_title' => $review_title,
            'listing_id' => $listing_id,
            'review_id' => $review_id,
            'review_stars' => $review_stars,
            'review_post_type' => $review_post_type,
            'review_content' => $review,
            'review_link' => $review_link,
            'username' => $username,
        );
        do_action('yani_record_activities', $activity_args);

	    wp_die();

    }
    public function paypal_package_payment() {
        global $current_user;
        wp_get_current_user();
        $userID = $current_user->ID;
        $total_taxes = 0;
        $allowed_html =   array();
        $blogInfo = esc_url( home_url() );

        $yani_package_id      =   intval($_POST['yani_package_id']);
        $yani_package_name    =   wp_kses($_POST['yani_package_name'],$allowed_html);
        $yani_package_price   =   floatval(get_post_meta( $yani_package_id, 'yani_package_price', true ));
        

        $pack_tax = floatval(get_post_meta( $yani_package_id, 'yani_package_tax', true ));
        if( !empty($pack_tax) && !empty($yani_package_price) ) {
            $total_taxes = floatval($pack_tax)/100 * floatval($yani_package_price);
            $total_taxes = round($total_taxes, 2);
        }
        $yani_package_price = $yani_package_price + $total_taxes;

        if( empty($yani_package_price) && empty( $yani_package_id ) ) {
            exit();
        }
        
        $yani_package_price = number_format($yani_package_price, 2);


        $currency            = _yani_theme()->get_option('currency_paid_submission');
        $payment_description = $yani_package_name.' '.__('Membership payment on ',_yani_theme()->get_text_domain()).$blogInfo;

        $is_paypal_live      = _yani_theme()->get_option('paypal_api');
        $host                = 'https://api.sandbox.paypal.com';

        if( $is_paypal_live =='live'){
            $host = 'https://api.paypal.com';
        }

        $url             =   $host.'/v1/oauth2/token';
        $postArgs        =   'grant_type=client_credentials';
        $access_token    =   _yani_payment()->get_paypal_access_token( $url, $postArgs );
        $url             =   $host.'/v1/payments/payment';
        $return_url      = _yani_template()->get_template_link('template/template-thankyou.php');
        $dash_profile_link   =  _yani_template()->get_template_link('template/user_dashboard_profile.php');

        $payment = array(
            'intent' => 'sale',
            "redirect_urls" => array(
                "return_url" => $return_url,
                "cancel_url" => $dash_profile_link
            ),
            'payer' => array("payment_method" => "paypal"),
        );

        $payment['transactions'][0] = array(
            'amount' => array(
                'total' => $yani_package_price,
                'currency' => $currency,
                'details' => array(
                    'subtotal' => $yani_package_price,
                    'tax' => '0.00',
                    'shipping' => '0.00'
                )
            ),
            'description' => $payment_description
        );

        $payment['transactions'][0]['item_list']['items'][] = array(
            'quantity' => '1',
            'name' => __('Membership Payment ',_yani_theme()->get_text_domain()),
            'price' => $yani_package_price,
            'tax'         => '0.00',
            'currency' => $currency,
            'sku' => $yani_package_name.' '.__('Membership Payment ',_yani_theme()->get_text_domain()),
        );

        // Convert PHP array into json format
        $jsonEncode = json_encode($payment);
        $json_response = _yani_payment()->execute_paypal_request( $url, $jsonEncode, $access_token );

        foreach ($json_response['links'] as $link) {
            if($link['rel'] == 'execute'){
                $payment_execute_url = $link['href'];
                $payment_execute_method = $link['method'];
            } else if($link['rel'] == 'approval_url'){
                $payment_approval_url = $link['href'];
                $payment_approval_method = $link['method'];
            }
        }

        // Save data in database for further use on processor page
        $output['payment_execute_url'] = $payment_execute_url;
        $output['access_token']        = $access_token;
        $output['package_id']          = $yani_package_id;

        $save_output[$userID]   =   $output;
        update_option('yani_paypal_package_transfer', $save_output);
        update_user_meta( $userID, 'yani_paypal_package', $output);

        print $payment_approval_url;

        wp_die();

    }

    public function user_picture_upload( ) {

        $user_id = $_REQUEST['user_id'];
        $verify_nonce = $_REQUEST['verify_nonce'];
        // if ( ! wp_verify_nonce( $verify_nonce, 'yani_upload_nonce' ) ) {
        //     echo json_encode( array( 'success' => false , 'reason' => 'Invalid request' ) );
        //     die;
        // }

        $yani_user_image = $_FILES['yani_file_data_name'];
        $yani_wp_handle_upload = wp_handle_upload( $yani_user_image, array( 'test_form' => false ) );

        if ( isset( $yani_wp_handle_upload['file'] ) ) {
            $file_name  = basename( $yani_user_image['name'] );
            $file_type  = wp_check_filetype( $yani_wp_handle_upload['file'] );

            $uploaded_image_details = array(
                'guid'           => $yani_wp_handle_upload['url'],
                'post_mime_type' => $file_type['type'],
                'post_title'     => preg_replace( '/\.[^.]+$/', '', basename( $file_name ) ),
                'post_content'   => '',
                'post_status'    => 'inherit'
            );

            $profile_attach_id      =   wp_insert_attachment( $uploaded_image_details, $yani_wp_handle_upload['file'] );
            $profile_attach_data    =   wp_generate_attachment_metadata( $profile_attach_id, $yani_wp_handle_upload['file'] );
            wp_update_attachment_metadata( $profile_attach_id, $profile_attach_data );

            $thumbnail_url = wp_get_attachment_image_src( $profile_attach_id, 'large' );
            $this->save_user_photo($user_id, $profile_attach_id, $thumbnail_url);

            echo json_encode( array(
                'success'   => true,
                'url' => $thumbnail_url[0],
                'attachment_id'    => $profile_attach_id
            ));
            die;

        } else {
            echo json_encode( array( 'success' => false, 'reason' => 'Profile Photo upload failed!' ) );
            die;
        }

    }

    public function save_user_photo($user_id, $pic_id, $thumbnail_url) {
        
        update_user_meta( $user_id, 'yani_author_picture_id', $pic_id );
        update_user_meta( $user_id, 'yani_author_custom_picture', $thumbnail_url[0] );

        $user_agent_id = get_the_author_meta('yani_author_agent_id', $user_id);
        $user_agency_id = get_the_author_meta('yani_author_agency_id', $user_id);
        
        if( !empty($user_agent_id) ) {
            update_post_meta( $user_agent_id, '_thumbnail_id', $pic_id );

        } else if( !empty($user_agency_id) ) {
            update_post_meta( $user_agency_id, '_thumbnail_id', $pic_id );
        }

    }

    public function delete_property()    {

        $dashboard_listings = yani_template()->get_template_link('template/user_dashboard_properties.php');
        $dashboard_listings = add_query_arg( 'deleted', 1, $dashboard_listings );

        $nonce = $_REQUEST['security'];
        if ( ! wp_verify_nonce( $nonce, 'delete_my_property_nonce' ) ) {
            $ajax_response = array( 'success' => false , 'reason' => esc_html__( 'Security check failed!', 'houzez' ) );
            echo json_encode( $ajax_response );
            die;
        }

        if ( !isset( $_REQUEST['prop_id'] ) ) {
            $ajax_response = array( 'success' => false , 'reason' => esc_html__( 'No Property ID found', 'houzez' ) );
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
            $ajax_response = array( 'success' => true , 'redirect' => $dashboard_listings, 'mesg' => esc_html__( 'Property Deleted', 'houzez' ) );
            echo json_encode( $ajax_response );
            die;
        } else {
            $ajax_response = array( 'success' => false , 'reason' => esc_html__( 'Permission denied', 'houzez' ) );
            echo json_encode( $ajax_response );
            die;
        }

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

                $dashboard_listings = _yani_template()->get_template_link_2('template/user_dashboard_properties.php');
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

    public  function property_on_hold() {
        if ( isset( $_POST['propID'] ) ) {

            global $wpdb;
            if (! isset( $_POST['propID'] ) ) {
                wp_die('No post to put on hold has been supplied!');
            }
            $post_id = absint( $_POST['propID'] );
            
            $post_status = get_post_status( $post_id );

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


} 
}

function _yani_ajax() {
	return _Yani_AJAX_Helper::get_instance();
}

_yani_ajax()->init();