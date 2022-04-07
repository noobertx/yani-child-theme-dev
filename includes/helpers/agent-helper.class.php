<?php
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! class_exists( '_Yani_Agent_Helper' ) ) {
	class _Yani_Agent_Helper{
		private static $instance = null;		
		public static function get_instance() {

			// If the single instance hasn't been set, set it now.
			if ( null == self::$instance ) {
				self::$instance = new self;
			}
			return self::$instance;
		}

		public function show_agent_box() {
	        global $current_user;
	        $current_user = wp_get_current_user();
	        //yani_agent, subscriber, author, yani_buyer, yani_owner
	        $use_yani_roles = 1;

	        if( $use_yani_roles != 0 ) {
	            if ( in_array('yani_owner', (array)$current_user->roles) ||
	                in_array('yani_agent', (array)$current_user->roles) ||
	                in_array('yani_seller', (array)$current_user->roles) ||
	                in_array('yani_manager', (array)$current_user->roles) ||
	                in_array('author', (array)$current_user->roles)
	            ) {
	                return false;
	            }
	            return true;
	        }
	        return true;
	    }

	    public function get_agent_info( $args, $type ) {
        if( $type == 'for_grid_list' ) {
            return '<a href="'.$args[ 'link' ].'">'.$args[ 'agent_name' ].'</a> ';

        } elseif( $type == 'agent_form' ) {
            $output = '';

            $output .= '<div class="media agent-media">';
                $output .= '<div class="media-left">';
                    $output .= '<input type="checkbox">';
                    $output .= '<a href="'.$args[ 'link' ].'">';
                        $output .= '<img src="'.$args[ 'picture' ].'" alt="'.$args[ 'agent_name' ].'" width="75" height="75">';
                    $output .= '</a>';
                $output .= '</div>';

                $output .= '<div class="media-body">';
                    $output .= '<dl>';
                        if( !empty($args[ 'agent_name' ]) ) {
                            $output .= '<dd><i class="fa fa-user"></i> '.$args[ 'agent_name' ].'</dd>';
                        }
                        if( !empty( $args[ 'agent_mobile' ] ) ) {
                            $output .= '<dd><i class="fa fa-phone"></i><span class="clickToShow">'.esc_attr( $args[ 'agent_mobile' ] ).'</span></dd>';
                        }
                        $output .= '<dd><a href="'.$args[ 'link' ].'" class="view">'.esc_html__('View my listing', 'houzez' ).'</a></dd>';
                    $output .= '</dl>';
                $output .= '</div>';
            $output .= '</div>';

            return $output;
        }
    }

    public function get_listing_data($field, $single = true) {
        $prefix = 'yani_';
        $data = get_post_meta(get_the_ID(), $prefix.$field, $single);

        if($data != '') {
            return $data;
        }
        return '';
    }

    
    public function render_property_contact_form($is_top = true, $luxury = false) {
        $allowed_html_array = array(
            'a' => array(
                'href' => array(),
                'title' => array()
            )
        );
        $listing_agent = $prop_agent = $prop_agent_phone = $prop_agent_mobile = $picture = $agent_id = '';
        $prop_agent_num = $agent_num_call = $prop_agent_email = $prop_agent_permalink = '';
        $return_array = array();

        $agent_display = $this->get_listing_data('agent_display_option');
        $is_single_agent = true;

        if( $agent_display != 'none' ) {
            if( $agent_display == 'agent_info' ) {

                $agents_ids = $this->get_listing_data('agents', false);

                $agents_ids = array_filter( $agents_ids, function($hz){
                    return ( $hz > 0 );
                });

                $agents_ids = array_unique( $agents_ids );

                if ( ! empty( $agents_ids ) ) {
                    $agents_count = count( $agents_ids );
                    if ( $agents_count > 1 ) :
                        $is_single_agent = false;
                    endif;
                    $listing_agent = '';
                    foreach ( $agents_ids as $agent ) {
                        if ( 0 < intval( $agent ) ) {

                            $agent_id = intval( $agent );
                            $prop_agent_phone = get_post_meta( $agent_id, 'yani_agent_office_num', true );
                            $prop_agent_mobile = get_post_meta( $agent_id, 'yani_agent_mobile', true );
                            $prop_agent_whatsapp = get_post_meta( $agent_id, 'yani_agent_whatsapp', true );
                            $prop_agent_email = get_post_meta( $agent_id, 'yani_agent_email', true );
                            $agent_num_call = str_replace(array('(',')',' ','-'),'', $prop_agent_mobile);
                            $prop_agent = get_the_title( $agent_id );
                            $thumb_id = get_post_thumbnail_id( $agent_id );
                            $thumb_url_array = wp_get_attachment_image_src( $thumb_id, array(150,150), true );
                            $prop_agent_photo_url = $thumb_url_array[0];
                            $prop_agent_permalink = get_post_permalink( $agent_id );

                            $agent_args = array();
                            $agent_args[ 'agent_id' ] = $agent_id;
                            $agent_args[ 'agent_skype' ] = get_post_meta( $agent_id, 'yani_agent_skype', true );
                            $agent_args[ 'agent_name' ] = $prop_agent;
                            $agent_args[ 'agent_mobile' ] = $prop_agent_mobile;
                            $agent_args[ 'agent_mobile_call' ] = str_replace(array('(',')',' ','-'),'', $prop_agent_mobile);
                            $agent_args[ 'agent_whatsapp' ] = $prop_agent_whatsapp;
                            $agent_args[ 'agent_whatsapp_call' ] = str_replace(array('(',')',' ','-'),'', $prop_agent_whatsapp);
                            $agent_args[ 'agent_phone' ] = $prop_agent_phone;
                            $agent_args[ 'agent_phone_call' ] = str_replace(array('(',')',' ','-'),'', $prop_agent_phone);
                            $agent_args[ 'agent_email' ] = $prop_agent_email;
                            $agent_args[ 'link' ] = $prop_agent_permalink;
                            $agent_args[ 'facebook' ] = get_post_meta( $agent_id, 'yani_agent_facebook', true );
                            $agent_args[ 'twitter' ] = get_post_meta( $agent_id, 'yani_agent_twitter', true );
                            $agent_args[ 'linkedin' ] = get_post_meta( $agent_id, 'yani_agent_linkedin', true );
                            $agent_args[ 'googleplus' ] = get_post_meta( $agent_id, 'yani_agent_googleplus', true );
                            $agent_args[ 'youtube' ] = get_post_meta( $agent_id, 'yani_agent_youtube', true );
                            $agent_args[ 'instagram' ] = get_post_meta( $agent_id, 'yani_agent_instagram', true );

                            if( empty( $prop_agent_photo_url )) {
                                $agent_args[ 'picture' ] = YANI_THEME_IMAGES. 'profile-avatar.png';
                                $picture = YANI_THEME_IMAGES. 'profile-avatar.png';
                            } else {
                                $agent_args[ 'picture' ] = $prop_agent_photo_url;
                                $picture = $prop_agent_photo_url;
                            }
                
                            if($is_top) {
                                $listing_agent .= $this->get_agent_info_bottom( $agent_args, 'agent_form', $is_single_agent );
                            } else {

                                if($luxury) {
                                    $listing_agent .= yani_get_agent_info_bottom_v2( $agent_args, 'agent_form', $is_single_agent );
                                } else {
                                    $listing_agent .= $this->get_agent_info_bottom( $agent_args, 'agent_form', $is_single_agent );
                                }
                                
                            }

                        }
                    }
                }

            } elseif( $agent_display == 'agency_info' ) {
                $agent_id = get_post_meta( get_the_ID(), 'yani_property_agency', true );

                $prop_agent_phone = get_post_meta( $agent_id, 'yani_agency_phone', true );
                $prop_agent_mobile = get_post_meta( $agent_id, 'yani_agency_mobile', true );
                $prop_agent_whatsapp = get_post_meta( $agent_id, 'yani_agency_whatsapp', true );
                $prop_agent_email = get_post_meta( $agent_id, 'yani_agency_email', true );
                $agent_num_call = str_replace(array('(',')',' ','-'),'', $prop_agent_mobile);
                $prop_agent = get_the_title( $agent_id );
                $thumb_id = get_post_thumbnail_id( $agent_id );
                $thumb_url_array = wp_get_attachment_image_src( $thumb_id, array(150,150), true );
                $prop_agent_photo_url = $thumb_url_array[0];
                $prop_agent_permalink = '';
                // $prop_agent_permalink = get_post_permalink( $agent_id );

                $agent_args = array();
                $agent_args[ 'agent_id' ] = $agent_id;
                $agent_args[ 'agent_skype' ] = get_post_meta( $agent_id, 'yani_agency_skype', true );
                $agent_args[ 'agent_name' ] = $prop_agent;
                $agent_args[ 'agent_mobile' ] = $prop_agent_mobile;
                $agent_args[ 'agent_mobile_call' ] = str_replace(array('(',')',' ','-'),'', $prop_agent_mobile);
                $agent_args[ 'agent_whatsapp' ] = $prop_agent_whatsapp;
                $agent_args[ 'agent_whatsapp_call' ] = str_replace(array('(',')',' ','-'),'', $prop_agent_whatsapp);
                $agent_args[ 'agent_phone' ] = $prop_agent_phone;
                $agent_args[ 'agent_phone_call' ] = str_replace(array('(',')',' ','-'),'', $prop_agent_phone);
                $agent_args[ 'agent_email' ] = $prop_agent_email;
                $agent_args[ 'link' ] = $prop_agent_permalink;
                $agent_args[ 'facebook' ] = get_post_meta( $agent_id, 'yani_agency_facebook', true );
                $agent_args[ 'twitter' ] = get_post_meta( $agent_id, 'yani_agency_twitter', true );
                $agent_args[ 'linkedin' ] = get_post_meta( $agent_id, 'yani_agency_linkedin', true );
                $agent_args[ 'googleplus' ] = get_post_meta( $agent_id, 'yani_agency_googleplus', true );
                $agent_args[ 'youtube' ] = get_post_meta( $agent_id, 'yani_agency_youtube', true );
                $agent_args[ 'instagram' ] = get_post_meta( $agent_id, 'yani_agency_instagram', true );

                if( empty( $prop_agent_photo_url )) {
                    $agent_args[ 'picture' ] = YANI_THEME_IMAGES. 'profile-avatar.png';
                    $picture = YANI_THEME_IMAGES. 'profile-avatar.png';
                } else {
                    $agent_args[ 'picture' ] = $prop_agent_photo_url;
                    $picture = $prop_agent_photo_url;
                }

                if($is_top) {
                    $listing_agent .= $this->get_agent_info_bottom( $agent_args, 'agent_form' );
                } else {
                    if($luxury) {
                        $listing_agent .= yani_get_agent_info_bottom_v2( $agent_args, 'agent_form' );
                    } else {
                        $listing_agent .= $this->get_agent_info_bottom( $agent_args, 'agent_form' );
                    }
                }
            

            } else {

                $prop_agent = get_the_author();
                $prop_agent_permalink = get_author_posts_url( get_the_author_meta( 'ID' ) );
                $prop_agent_phone = get_the_author_meta( 'yani_author_phone' );
                $prop_agent_mobile = get_the_author_meta( 'yani_author_mobile' );
                $prop_agent_whatsapp = get_the_author_meta( 'yani_author_whatsapp' );
                $agent_num_call = str_replace(array('(',')',' ','-'),'', $prop_agent_num);
                $prop_agent_photo_url = get_the_author_meta( 'yani_author_custom_picture' );
                $prop_agent_email = get_the_author_meta( 'email' );

                $agent_args = array();
                $agent_id   = get_the_author_meta( 'ID' );
                $agent_args[ 'agent_id' ] = get_the_author_meta( 'ID' );
                $agent_args[ 'agent_skype' ] = get_the_author_meta( 'yani_author_skype' );
                $agent_args[ 'agent_name' ] = $prop_agent;
                $agent_args[ 'agent_mobile' ] = $prop_agent_mobile;
                $agent_args[ 'agent_mobile_call' ] = str_replace(array('(',')',' ','-'),'', $prop_agent_mobile);

                $agent_args[ 'agent_whatsapp' ] = $prop_agent_whatsapp;
                $agent_args[ 'agent_whatsapp_call' ] = str_replace(array('(',')',' ','-'),'', $prop_agent_whatsapp);
                $agent_args[ 'agent_phone' ] = $prop_agent_phone;
                $agent_args[ 'agent_phone_call' ] = str_replace(array('(',')',' ','-'),'', $prop_agent_phone);
                $agent_args[ 'agent_email' ] = $prop_agent_email;
                $agent_args[ 'link' ] = $prop_agent_permalink;
                $agent_args[ 'facebook' ] = get_the_author_meta( 'yani_author_facebook' );
                $agent_args[ 'twitter' ] = get_the_author_meta( 'yani_author_twitter' );
                $agent_args[ 'linkedin' ] = get_the_author_meta( 'yani_author_linkedin' );
                $agent_args[ 'googleplus' ] = get_the_author_meta( 'yani_author_googleplus' );
                $agent_args[ 'youtube' ] = get_the_author_meta( 'yani_author_youtube' );
                $agent_args[ 'instagram' ] = get_the_author_meta( 'yani_author_instagram' );

                if( empty( $prop_agent_photo_url )) {
                    $agent_args[ 'picture' ] = YANI_THEME_IMAGES. 'profile-avatar.png';
                    $picture = YANI_THEME_IMAGES. 'profile-avatar.png';
                } else {
                    $agent_args[ 'picture' ] = $prop_agent_photo_url;
                    $picture = $prop_agent_photo_url;
                }

                if($is_top) {
                    $listing_agent .= $this->get_agent_info_bottom( $agent_args, 'agent_form' );
                } else {
                    if($luxury) {
                        $listing_agent .= yani_get_agent_info_bottom_v2( $agent_args, 'agent_form' );
                    } else {
                        $listing_agent .= $this->get_agent_info_bottom( $agent_args, 'agent_form' );
                    }
                }

            }

            $return_array['agent_data'] = $listing_agent;
            $return_array['is_single_agent'] = $is_single_agent;
            $return_array['agent_email'] = $prop_agent_email;
            $return_array['agent_name'] = $prop_agent;
            $return_array['agent_phone'] = $prop_agent_phone;
            $return_array['agent_phone_call'] = str_replace(array('(',')',' ','-'),'', $prop_agent_phone);
            $return_array['agent_mobile'] = $prop_agent_mobile;
            $return_array['agent_mobile_call'] = str_replace(array('(',')',' ','-'),'', $prop_agent_mobile);

            $return_array['agent_whatsapp'] = $prop_agent_whatsapp;
            $return_array['agent_whatsapp_call'] = str_replace(array('(',')',' ','-'),'', $prop_agent_whatsapp);
            $return_array['picture'] = $picture;
            $return_array['link'] = $prop_agent_permalink;
            $return_array['agent_type'] = $agent_display;
            $return_array['agent_id'] = $agent_id;
        }

        return $return_array;
    }

    public function get_agent_info_top($args, $type, $is_single = true)    {
        $view_listing = _yani_theme()->get_template('agent_view_listing');
        $agent_phone_num = _yani_theme()->get_template('agent_phone_num');

        if( empty($args['agent_name']) ) {
            return '';
        }

        if ($type == 'for_grid_list') {
            return '<a href="' . $args['link'] . '">' . $args['agent_name'] . '</a> ';

        } elseif ($type == 'agent_form') {
            $output = '';

            $output .= '<div class="agent-details">';
                $output .= '<div class="d-flex align-items-center">';
                    
                    $output .= '<div class="agent-image">';
                        
                        if ( $is_single == false ) {
                            $output .= '<input type="checkbox" class="houzez-hidden" checked="checked" class="multiple-agent-check" name="target_email[]" value="' . $args['agent_email'] . '" >';
                        }

                        $output .= '<img class="rounded" src="' . $args['picture'] . '" alt="' . $args['agent_name'] . '" width="70" height="70">';

                    $output .= '</div>';

                    $output .= '<ul class="agent-information list-unstyled">';

                        if (!empty($args['agent_name'])) {
                            $output .= '<li class="agent-name">';
                                $output .= '<i class="yani-icon icon-single-neutral mr-1"></i> '.$args['agent_name'];
                            $output .= '</li>';
                        }
                        
                        if ( $is_single == false && !empty($args['agent_mobile'])) {
                            $output .= '<li class="agent-phone agent-phone-hidden">';
                                $output .= '<i class="yani-icon icon-phone mr-1"></i> ' . esc_attr($args['agent_mobile']);
                            $output .= '</li>';
                        }

                        
                        if($view_listing != 0) {
                            $output .= '<li class="agent-link">';
                                $output .= '<a href="' . $args['link'] . '">' . _yani_theme()->get_template('spl_con_view_listings', 'View listings') . '</a>';
                            $output .= '</li>';
                        }


                    $output .= '</ul>';
                $output .= '</div>';
            $output .= '</div>';

            return $output;
        }
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
                            $output .= '<span class="agent-phone '.$this->show_phone().'">';
                                 $output .= '<a href="tel:'.esc_attr( $args[ 'agent_phone_call' ] ).'">'.esc_attr($args[ 'agent_phone' ]).'</a>';
                            $output .= '</span>';
                            endif;

                            if ( !empty( $args[ 'agent_mobile' ] ) && _yani_theme()->get_option('agent_mobile_num', 1) ) :
                            $output .= '<i class="yani-icon icon-mobile-phone mr-1"></i>';
                            $output .= '<span class="agent-phone '.$this->show_phone().'">';
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

    public function show_phone() {
        $phone_number_full = _yani_theme()->get_option('phone_number_full', 1);
        $class = '';
        if( $phone_number_full != 1 ) {
            $class = "agent-show-onClick agent-phone-hidden";
        }

        return $class;
    }

	}
}

function _yani_agent() {
	return _Yani_Agent_Helper::get_instance();
}