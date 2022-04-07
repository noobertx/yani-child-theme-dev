<?php
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! class_exists( '_Yani_Email_Helper' ) ) {
	class _Yani_Email_Helper{
		private static $instance = null;		
		public function get_form_user_type($token) {
    
	       $value = '';
	       
	       if( $token == 'buyer' ) {
	            $value = _yani_theme()->get_option('spl_con_buyer', "I'm a buyer");

	       } else if( $token == 'tennant' ) {
	            $value = _yani_theme()->get_option('spl_con_tennant', "I'm a tennant");

	       } else if( $token == 'agent' ) {
	            $value = _yani_theme()->get_option('spl_con_agent', "I'm an agent");

	       } else if( $token == 'other' ) {
	            $value = _yani_theme()->get_option('spl_con_other', "Other");
	       } 

	       return $value;
	    }

	    public function webhook_post_for_inquiry_contact_widget( $webhook_url, array $formData, $formId = 'contact_form' ) {

	        $webhook_url = esc_url($webhook_url);

	        $exclude_form_fields = apply_filters( 'yani_widget_webhook_exclude_form_fields',
	            array( 
	                'action',
	                'webhook',
	                'webhook_url',
	                'redirect_to',
	                'email_to', 
	                'email_subject',
	                'email_to_cc',
	                'email_to_bcc',
	                'yani_contact_form',
	            ),
	            $formId
	        );

	        $formData = array_merge( $formData, array( 'form_id' => $formId ) );

	        if ( !empty( $formData ) && is_array( $formData ) ) {
	            if ( !empty( $exclude_form_fields ) && is_array( $exclude_form_fields ) ) {
	                foreach ( $exclude_form_fields as $field ) {
	                    if ( isset( $formData[ $field ] ) ) {
	                        unset( $formData[ $field ] );
	                    }
	                }
	            }
	        }

	        
	        if ( !empty( $formData ) && !empty( $webhook_url ) ) {
	            $args = apply_filters( 'yani_widget_webhook_post_args', array(
	                'body'    => wp_json_encode( $formData ),
	                'headers' => array(
	                    'Content-Type' => 'application/json; charset=UTF-8',
	                ),
	            ) );

	            wp_safe_remote_post( $webhook_url, $args );
	        }
	    }

        public function new_user_notification( $user_id, $randonpassword = '', $phone_number = '' ) {

            $user = new WP_User( $user_id );

            $user_login = stripslashes( $user->user_login );
            $user_email = stripslashes( $user->user_email );

            $phone_number = get_user_meta($user_id, 'yani_author_phone', true);

            // Send notification to admin
            $args = array(
                'user_login_register' => $user_login,
                'user_email_register' => $user_email,
                'user_phone_register' => $phone_number
            );
            $this->send_email_type( get_option('admin_email'), 'admin_new_user_register', $args );


            // Return if password in empty
            if ( empty( $randonpassword ) ) {
                return;
            }

            // Send notification to registered user
            $args = array(
                'user_login_register'  =>  $user_login,
                'user_email_register'  =>  $user_email,
                'user_pass_register'   => $randonpassword,
                'user_phone_register'   => $phone_number,
            );
            $this->send_email_type( $user_email, 'new_user_register', $args );

        }

        public function send_messages_emails( $user_email, $subject, $message ){
        $headers = 'From: No Reply <noreply@'.$_SERVER['HTTP_HOST'].'>' . "\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
        $email_content = "";

        $enable_html_emails = _yani_theme()->get_option('enable_html_emails');
        $enable_email_header = _yani_theme()->get_option('enable_email_header');
        $enable_email_footer = _yani_theme()->get_option('enable_email_footer');


        $enable_html_emails = _yani_theme()->get_option('enable_html_emails');
        $email_head_logo = _yani_theme()->get_option('email_head_logo', false, 'url');
        $email_head_bg_color = _yani_theme()->get_option('email_head_bg_color');
        $email_foot_bg_color = _yani_theme()->get_option('email_foot_bg_color');
        $email_footer_content = _yani_theme()->get_option('email_footer_content');

        $social_1_icon = _yani_theme()->get_option('social_1_icon', false, 'url');
        $social_1_link = _yani_theme()->get_option('social_1_link');
        $social_2_icon = _yani_theme()->get_option('social_2_icon', false, 'url');
        $social_2_link = _yani_theme()->get_option('social_2_link');
        $social_3_icon = _yani_theme()->get_option('social_3_icon', false, 'url');
        $social_3_link = _yani_theme()->get_option('social_3_link');
        $social_4_icon = _yani_theme()->get_option('social_4_icon', false, 'url');
        $social_4_link = _yani_theme()->get_option('social_4_link');

        $message = wp_kses_post( wpautop( wptexturize( $message ) ) );

        $socials = '';
        if( !empty($social_1_icon) || !empty($social_2_icon) || !empty($social_3_icon) || !empty($social_4_icon) ) {
            $socials = '<div style="font-size: 0; text-align: center; padding-top: 20px;">';
            $socials .= '<p style="margin:0;margin-bottom: 10px; text-align: center; font-size: 14px; color:#777777;">'.esc_html__('Follow us on', _yani_theme()->get_text_domain()).'</p>';

            if( !empty($social_1_icon) ) {
                $socials .= '<a href="'.esc_url($social_1_link).'" style="margin-right: 5px"><img src="'.esc_url($social_1_icon).'" width="" height="" alt=""> </a>';
            }
            if( !empty($social_2_icon) ) {
                $socials .= '<a href="'.esc_url($social_2_link).'" style="margin-right: 5px"><img src="'.esc_url($social_2_icon).'" width="" height="" alt=""> </a>';
            }
            if( !empty($social_3_icon) ) {
                $socials .= '<a href="'.esc_url($social_3_link).'" style="margin-right: 5px"><img src="'.esc_url($social_3_icon).'" width="" height="" alt=""> </a>';
            }
            if( !empty($social_4_icon) ) {
                $socials .= '<a href="'.esc_url($social_4_link).'" style="margin-right: 5px"><img src="'.esc_url($social_4_icon).'" width="" height="" alt=""> </a>';
            }

            $socials .= '</div>';
        }

        if( $enable_email_header != 0 ) {
            $email_content = '<div style="text-align: center; background-color: ' . esc_attr($email_head_bg_color) . '; padding: 16px 0;">
                            <img src="' . esc_url($email_head_logo) . '" alt="logo">
                        </div>';
        }

        $email_content .= '<div style="background-color: #F6F6F6; padding: 30px;">
                            <div style="margin: 0 auto; width: 620px; background-color: #fff;border:1px solid #eee; padding:30px;">
                                <div style="font-family:\'Helvetica Neue\',\'Helvetica\',Helvetica,Arial,sans-serif;font-size:100%;line-height:1.6em;display:block;max-width:600px;margin:0 auto;padding:0">
                                '.$message.'
                                </div>
                            </div>
                        </div>';

        if( $enable_email_footer != 0 ) {
            $email_content .= '<div style="padding-top: text-align:center; 30px; padding-bottom: 30px; font-family:\'Helvetica Neue\',\'Helvetica\',Helvetica,Arial,sans-serif;">

                            <div style="width: 640px; background-color: ' . $email_foot_bg_color . '; margin: 0 auto;">
                                ' . $email_footer_content . '
                            </div>
                            ' . $socials . '
                        </div>';
        }

        if( $enable_html_emails != 0 ) {
            $email_messages = $email_content;
        } else {
            $email_messages = $message;
        }

        @wp_mail(
            $user_email,
            $subject,
            $email_messages,
            $headers
        );
    }

	    public function webhook_post( array $formData, $formId = 'property_agent_contact_form' ) {

        $webhook_url = _yani_theme()->get_option( 'yani_webhook_url' );

        $exclude_form_fields = apply_filters( 'yani_webhook_exclude_form_fields',
            array( 
                'action',
                'target_email',
                'property_nonce',
                'prop_payment',
                'property_agent_contact_security',
                'contact_realtor_ajax', 
                'is_listing_form',
                'submit',
                'realtor_page',
            ),
            $formId
        );

        $formData = array_merge( $formData, array( 'form_id' => $formId ) );

        if ( !empty( $formData ) && is_array( $formData ) ) {
            if ( !empty( $exclude_form_fields ) && is_array( $exclude_form_fields ) ) {
                foreach ( $exclude_form_fields as $field ) {
                    if ( isset( $formData[ $field ] ) ) {
                        unset( $formData[ $field ] );
                    }
                }
            }
        }

        
        if ( !empty( $formData ) && !empty( $webhook_url ) ) {
            $args = apply_filters( 'yani_webhook_post_args', array(
                'body'    => wp_json_encode( $formData ),
                'headers' => array(
                    'Content-Type' => 'application/json; charset=UTF-8',
                ),
            ) );

            wp_safe_remote_post( $webhook_url, $args );
        }
    }

    public function email_with_reply( $email, $email_type, $args, $sender_name, $sender_email, $cc_email, $bcc_email ) {

        $value_message = _yani_theme()->get_option('yani_' . $email_type, '');
        $value_subject = _yani_theme()->get_option('yani_subject_' . $email_type, '');

        do_action( 'wpml_register_single_string', _yani_theme()->get_text_domain(), 'yani_email_' . $value_message, $value_message );
        do_action( 'wpml_register_single_string', _yani_theme()->get_text_domain(), 'yani_email_subject_' . $value_subject, $value_subject );

        $value_message = apply_filters('wpml_translate_single_string', $value_message, _yani_theme()->get_text_domain(), 'yani_email_' . $value_message );
        $value_subject = apply_filters('wpml_translate_single_string', $value_subject, _yani_theme()->get_text_domain(), 'yani_email_subject_' . $value_subject );


        return $this->init_emails_maker( $email, $value_message, $value_subject, $args, $sender_name, $sender_email, $cc_email, $bcc_email);
    }

    public function  init_emails_maker( $email, $message, $subject, $args, $sender_name, $sender_email, $cc_email, $bcc_email ) {
        $args ['website_url'] = get_option('siteurl');
        $args ['website_name'] = get_option('blogname');
        $args ['user_email'] = $email;
        $user = get_user_by( 'email',$email );
        $args ['username'] = $user->user_login;

        foreach( $args as $key => $val){
            $subject = str_replace( '%'.$key, $val, $subject );
            $message = str_replace( '%'.$key, $val, $message );
        }

        return $this->send_emails_with_reply( $email, $subject, $message, $sender_name, $sender_email, $cc_email, $bcc_email );
        
    }

    public function send_emails_with_reply( $user_email, $subject, $message, $sender_name, $sender_email, $cc_email, $bcc_email ){
        $headers = array();
        
        $enable_html_emails = _yani_theme()->get_option('enable_html_emails');
        $enable_email_header = _yani_theme()->get_option('enable_email_header');
        $enable_email_footer = _yani_theme()->get_option('enable_email_footer');

        $cc_header = '';
        if ( ! empty( $cc_email ) ) {
            $cc_email = sanitize_email( $cc_email );
            $cc_email = is_email( $cc_email );
            $cc_header = 'Cc: ' . $cc_email . "\r\n";
        }

        $headers[] = "From: $sender_name <$sender_email>";
        $headers[] = "Reply-To: $sender_name <$sender_email>";
        if( $enable_html_emails != 0 ) {
            $headers[] = "Content-Type: text/html; charset=UTF-8";
        }
        $headers = apply_filters( "yani_send_mails_header", $headers );// Filter for modify the header in child theme

        $enable_html_emails = _yani_theme()->get_option('enable_html_emails');
        $email_head_logo = _yani_theme()->get_option('email_head_logo', false, 'url');
        $email_head_bg_color = _yani_theme()->get_option('email_head_bg_color');
        $email_foot_bg_color = _yani_theme()->get_option('email_foot_bg_color');
        $email_footer_content = _yani_theme()->get_option('email_footer_content');

        $social_1_icon = _yani_theme()->get_option('social_1_icon', false, 'url');
        $social_1_link = _yani_theme()->get_option('social_1_link');
        $social_2_icon = _yani_theme()->get_option('social_2_icon', false, 'url');
        $social_2_link = _yani_theme()->get_option('social_2_link');
        $social_3_icon = _yani_theme()->get_option('social_3_icon', false, 'url');
        $social_3_link = _yani_theme()->get_option('social_3_link');
        $social_4_icon = _yani_theme()->get_option('social_4_icon', false, 'url');
        $social_4_link = _yani_theme()->get_option('social_4_link');

        $message = wp_kses_post( wpautop( wptexturize( $message ) ) );

        $socials = '';
        if( !empty($social_1_icon) || !empty($social_2_icon) || !empty($social_3_icon) || !empty($social_4_icon) ) {
            $socials = '<div style="font-size: 0; text-align: center; padding-top: 20px;">';
            $socials .= '<p style="margin:0;margin-bottom: 10px; text-align: center; font-size: 14px; color:#777777;">'.esc_html__('Follow us on', _yani_theme()->get_text_domain()).'</p>';

            if( !empty($social_1_icon) ) {
                $socials .= '<a href="'.esc_url($social_1_link).'" style="margin-right: 5px"><img src="'.esc_url($social_1_icon).'" width="" height="" alt=""> </a>';
            }
            if( !empty($social_2_icon) ) {
                $socials .= '<a href="'.esc_url($social_2_link).'" style="margin-right: 5px"><img src="'.esc_url($social_2_icon).'" width="" height="" alt=""> </a>';
            }
            if( !empty($social_3_icon) ) {
                $socials .= '<a href="'.esc_url($social_3_link).'" style="margin-right: 5px"><img src="'.esc_url($social_3_icon).'" width="" height="" alt=""> </a>';
            }
            if( !empty($social_4_icon) ) {
                $socials .= '<a href="'.esc_url($social_4_link).'" style="margin-right: 5px"><img src="'.esc_url($social_4_icon).'" width="" height="" alt=""> </a>';
            }

            $socials .= '</div>';
        }
        $email_content = "";
        if( $enable_email_header != 0 ) {
            $email_content = '<div style="text-align: center; background-color: ' . esc_attr($email_head_bg_color) . '; padding: 16px 0;">
                            <img src="' . esc_url($email_head_logo) . '" alt="logo">
                        </div>';
        }

        $email_content .= '<div style="background-color: #F6F6F6; padding: 30px;">
                            <div style="margin: 0 auto; width: 620px; background-color: #fff;border:1px solid #eee; padding:30px;">
                                <div style="font-family:\'Helvetica Neue\',\'Helvetica\',Helvetica,Arial,sans-serif;font-size:100%;line-height:1.6em;display:block;max-width:600px;margin:0 auto;padding:0">
                                '.$message.'
                                </div>
                            </div>
                        </div>';

        if( $enable_email_footer != 0 ) {
            $email_content .= '<div style="padding-top: 30px; text-align:center; padding-bottom: 30px; font-family:\'Helvetica Neue\',\'Helvetica\',Helvetica,Arial,sans-serif;">

                            <div style="width: 640px; background-color: ' . $email_foot_bg_color . '; margin: 0 auto;">
                                ' . $email_footer_content . '
                            </div>
                            ' . $socials . '
                        </div>';
        }

        if( $enable_html_emails != 0 ) {
            $email_messages = $email_content;
        } else {
            $email_messages = $message;
        }


        if ( ! empty( $bcc_email ) ) {
            $bcc_emails = explode( ',', $bcc_email );
            foreach ( $bcc_emails as $bcc_email ) {
                wp_mail( trim( $bcc_email ), $subject, $email_messages, $headers );
            }
        }

        $headers[] = $cc_header;

        $email_sent = @wp_mail(
            $user_email,
            $subject,
            $email_messages,
            $headers
        );

        return $email_sent;

    }

    public function init_webhook_post( array $formData, $formId = 'property_agent_contact_form' ) {

        $webhook_url = _yani_theme()->get_option( 'yani_webhook_url' );

        $exclude_form_fields = apply_filters( 'yani_webhook_exclude_form_fields',
            array( 
                'action',
                'target_email',
                'property_nonce',
                'prop_payment',
                'property_agent_contact_security',
                'contact_realtor_ajax', 
                'is_listing_form',
                'submit',
                'realtor_page',
            ),
            $formId
        );

        $formData = array_merge( $formData, array( 'form_id' => $formId ) );

        if ( !empty( $formData ) && is_array( $formData ) ) {
            if ( !empty( $exclude_form_fields ) && is_array( $exclude_form_fields ) ) {
                foreach ( $exclude_form_fields as $field ) {
                    if ( isset( $formData[ $field ] ) ) {
                        unset( $formData[ $field ] );
                    }
                }
            }
        }

        
        if ( !empty( $formData ) && !empty( $webhook_url ) ) {
            $args = apply_filters( 'yani_webhook_post_args', array(
                'body'    => wp_json_encode( $formData ),
                'headers' => array(
                    'Content-Type' => 'application/json; charset=UTF-8',
                ),
            ) );

            wp_safe_remote_post( $webhook_url, $args );
        }
    }

        public function send_email_type( $email, $email_type, $args ) {

        $value_message = _yani_theme()->get_option('yani_' . $email_type, '');
        $value_subject = _yani_theme()->get_option('yani_subject_' . $email_type, '');

        do_action( 'wpml_register_single_string', _yani_theme()->get_text_domain(), 'yani_email_' . $value_message, $value_message );
        do_action( 'wpml_register_single_string', _yani_theme()->get_text_domain(), 'yani_email_subject_' . $value_subject, $value_subject );

        $value_message = apply_filters('wpml_translate_single_string', $value_message, _yani_theme()->get_text_domain(), 'yani_email_' . $value_message );
        $value_subject = apply_filters('wpml_translate_single_string', $value_subject, _yani_theme()->get_text_domain(), 'yani_email_subject_' . $value_subject );


        $this->emails_filter_replace( $email, $value_message, $value_subject, $args);
    }

    public function  emails_filter_replace( $email, $message, $subject, $args ) {
        $args ['website_url'] = get_option('siteurl');
        $args ['website_name'] = get_option('blogname');
        $args ['user_email'] = $email;
        $user = get_user_by( 'email',$email );
        $args ['username'] = $user->user_login;

        foreach( $args as $key => $val){
            $subject = str_replace( '%'.$key, $val, $subject );
            $message = str_replace( '%'.$key, $val, $message );
        }

        $this->send_emails( $email, $subject, $message );
        
    }

     public function send_emails( $user_email, $subject, $message ){
        $headers = array();
        $headers[] = 'From: No Reply <noreply@'.$_SERVER['HTTP_HOST'].'>';

        $enable_html_emails = _yani_theme()->get_option('enable_html_emails');
        $enable_email_header = _yani_theme()->get_option('enable_email_header');
        $enable_email_footer = _yani_theme()->get_option('enable_email_footer');

        if( $enable_html_emails != 0 ) {
            $headers[] = "Content-Type: text/html; charset=UTF-8";
        }
        $headers = apply_filters( "yani_send_mails_header", $headers );// Filter for modify the header in child theme

        $enable_html_emails = _yani_theme()->get_option('enable_html_emails');
        $email_head_logo = _yani_theme()->get_option('email_head_logo', false, 'url');
        $email_head_bg_color = _yani_theme()->get_option('email_head_bg_color');
        $email_foot_bg_color = _yani_theme()->get_option('email_foot_bg_color');
        $email_footer_content = _yani_theme()->get_option('email_footer_content');

        $social_1_icon = _yani_theme()->get_option('social_1_icon', false, 'url');
        $social_1_link = _yani_theme()->get_option('social_1_link');
        $social_2_icon = _yani_theme()->get_option('social_2_icon', false, 'url');
        $social_2_link = _yani_theme()->get_option('social_2_link');
        $social_3_icon = _yani_theme()->get_option('social_3_icon', false, 'url');
        $social_3_link = _yani_theme()->get_option('social_3_link');
        $social_4_icon = _yani_theme()->get_option('social_4_icon', false, 'url');
        $social_4_link = _yani_theme()->get_option('social_4_link');

        $message = wp_kses_post( wpautop( wptexturize( $message ) ) );

        $socials = '';
        if( !empty($social_1_icon) || !empty($social_2_icon) || !empty($social_3_icon) || !empty($social_4_icon) ) {
            $socials = '<div style="font-size: 0; text-align: center; padding-top: 20px;">';
            $socials .= '<p style="margin:0;margin-bottom: 10px; text-align: center; font-size: 14px; color:#777777;">'.esc_html__('Follow us on', _yani_theme()->get_text_domain()).'</p>';

            if( !empty($social_1_icon) ) {
                $socials .= '<a href="'.esc_url($social_1_link).'" style="margin-right: 5px"><img src="'.esc_url($social_1_icon).'" width="" height="" alt=""> </a>';
            }
            if( !empty($social_2_icon) ) {
                $socials .= '<a href="'.esc_url($social_2_link).'" style="margin-right: 5px"><img src="'.esc_url($social_2_icon).'" width="" height="" alt=""> </a>';
            }
            if( !empty($social_3_icon) ) {
                $socials .= '<a href="'.esc_url($social_3_link).'" style="margin-right: 5px"><img src="'.esc_url($social_3_icon).'" width="" height="" alt=""> </a>';
            }
            if( !empty($social_4_icon) ) {
                $socials .= '<a href="'.esc_url($social_4_link).'" style="margin-right: 5px"><img src="'.esc_url($social_4_icon).'" width="" height="" alt=""> </a>';
            }

            $socials .= '</div>';
        }

        $email_content = "";

        if( $enable_email_header != 0 ) {
            $email_content = '<div style="text-align: center; background-color: ' . esc_attr($email_head_bg_color) . '; padding: 16px 0;">
                            <img src="' . esc_url($email_head_logo) . '" alt="logo">
                        </div>';
        }

        $email_content .= '<div style="background-color: #F6F6F6; padding: 30px;">
                            <div style="margin: 0 auto; width: 620px; background-color: #fff;border:1px solid #eee; padding:30px;">
                                <div style="font-family:\'Helvetica Neue\',\'Helvetica\',Helvetica,Arial,sans-serif;font-size:100%;line-height:1.6em;display:block;max-width:600px;margin:0 auto;padding:0">
                                '.$message.'
                                </div>
                            </div>
                        </div>';

        if( $enable_email_footer != 0 ) {
            $email_content .= '<div style="padding-top: 30px; text-align:center; padding-bottom: 30px; font-family:\'Helvetica Neue\',\'Helvetica\',Helvetica,Arial,sans-serif;">

                            <div style="width: 640px; background-color: ' . $email_foot_bg_color . '; margin: 0 auto;">
                                ' . $email_footer_content . '
                            </div>
                            ' . $socials . '
                        </div>';
        }

        if( $enable_html_emails != 0 ) {
            $email_messages = $email_content;
        } else {
            $email_messages = $message;
        }

        @wp_mail(
            $user_email,
            $subject,
            $email_messages,
            $headers
        );
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

function _yani_email() {
	return _Yani_Email_Helper::get_instance();
}