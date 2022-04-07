<?php
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! class_exists( '_Yani_User_Helper' ) ) {
	class _Yani_User_Helper{
		private static $instance = null;

		

	    public function get_remaining_listings($user_id) {
        	return get_the_author_meta( 'package_listings' , $user_id );
    	}

	    public function not_buyer() {
	        global $current_user;
	        $current_user = wp_get_current_user();
	        //yani_agent, subscriber, author, yani_buyer, yani_owner
	        $use_yani_roles = 1;

	        if( $use_yani_roles != 0 ) {
	            if (in_array('yani_buyer', (array)$current_user->roles) ) {
	                return false;
	            }
	            return true;
	        }
	        return true;
	    }

	    public function is_admin() {
	        global $current_user;
	        $current_user = wp_get_current_user();

	        if (in_array('administrator', (array)$current_user->roles)) {
	            return true;
	        }
	        return false;
	    }
    

	    public function update_profile( $userID ) {

    	}

    	

	    public function role_is($role){
	    	global $current_user;
	        $current_user = wp_get_current_user();
	        //yani_agent, subscriber, author, yani_buyer, yani_owner
	        $use_yani_roles = 1;

	        if( $use_yani_roles != 0 ) {
	            if (in_array($role, (array)$current_user->roles) ) {
	                return true;
	            }
	            return false;
	        }
	        return false;
	    }

    	public function register_as_agent( $username, $email, $user_id, $mobile_num = null, $image_url = null ) {

	        // Create post object
	        $args = array(
	            'post_title'    => $username,
	            'post_type' => 'yani_agent',
	            'post_status'   => 'publish'
	        );

	        // Insert the post into the database
	        $post_id =  wp_insert_post( $args );
	        update_post_meta( $post_id, 'yani_user_meta_id', $user_id);  // used when agent custom post type updated
	        update_user_meta( $user_id, 'yani_author_agent_id', $post_id);
	        update_post_meta( $post_id, 'yani_agent_email', $email);
	        update_post_meta( $post_id, 'yani_agent_mobile', $mobile_num);

	        if( _yani_theme()->get_option('realtor_visible', 0) ) {
	            update_post_meta( $post_id, 'yani_agent_visible', 1);
	        }

	        if( !empty($image_url) ) {
	            yani_set_image_from_url($post_id, $image_url);
	        }

	    }

    	public function register_as_agency( $username, $email, $user_id, $phone_number = null ) {
	        // Create post object
	        $args = array(
	            'post_title'    => $username,
	            'post_type' => 'yani_agency',
	            'post_status'   => 'publish'
	        );

	        // Insert the post into the database
	        $post_id =  wp_insert_post( $args );
	        update_post_meta( $post_id, 'yani_user_meta_id', $user_id);  // used when agent custom post type updated
	        update_user_meta( $user_id, 'yani_author_agency_id', $post_id);
	        update_post_meta( $post_id, 'yani_agency_email', $email) ;
	        update_post_meta( $post_id, 'yani_agency_phone', $phone_number);

	        if( _yani_theme()->get_option('realtor_visible', 0) ) {
	            update_post_meta( $post_id, 'yani_agency_visible', 1);
	        }
	    }

	    public function update_user_agent ( $agent_id, $firstname, $lastname, $title, $about, $userphone, $usermobile, $whatsapp, $userskype, $facebook, $twitter, $linkedin, $instagram, $pinterest, $youtube, $vimeo, $googleplus, $profile_pic, $profile_pic_id, $website, $useremail, $license, $tax_number, $fax_number, $userlangs, $user_address, $user_company, $service_areas, $specialties ) {


	        if( !empty( $firstname ) || !empty( $lastname ) ) {
	            $agr = array(
	                'ID' => $agent_id,
	                'post_title' => $firstname.' '.$lastname,
	                'post_content' => $about
	            );
	            $post_id = wp_update_post($agr);
	        } else {
	            $agr = array(
	                'ID' => $agent_id,
	                'post_content' => $about
	            );
	            $post_id = wp_update_post($agr);
	        }

	        
	        update_post_meta( $agent_id, 'yani_agent_license', $license );
	        update_post_meta( $agent_id, 'yani_agent_tax_no', $tax_number );
	        update_post_meta( $agent_id, 'yani_agent_facebook', $facebook );
	        update_post_meta( $agent_id, 'yani_agent_linkedin', $linkedin );
	        update_post_meta( $agent_id, 'yani_agent_twitter', $twitter );
	        update_post_meta( $agent_id, 'yani_agent_pinterest', $pinterest );
	        update_post_meta( $agent_id, 'yani_agent_instagram', $instagram );
	        update_post_meta( $agent_id, 'yani_agent_youtube', $youtube );
	        update_post_meta( $agent_id, 'yani_agent_vimeo', $vimeo );
	        update_post_meta( $agent_id, 'yani_agent_website', $website );
	        update_post_meta( $agent_id, 'yani_agent_googleplus', $googleplus );
	        update_post_meta( $agent_id, 'yani_agent_office_num', $userphone );
	        update_post_meta( $agent_id, 'yani_agent_fax', $fax_number );
	        update_post_meta( $agent_id, 'yani_agent_mobile', $usermobile );
	        update_post_meta( $agent_id, 'yani_agent_whatsapp', $whatsapp );
	        update_post_meta( $agent_id, 'yani_agent_skype', $userskype );
	        update_post_meta( $agent_id, 'yani_agent_position', $title );
	        update_post_meta( $agent_id, 'yani_agent_des', $about );
	        update_post_meta( $agent_id, 'yani_agent_email', $useremail );
	        update_post_meta( $agent_id, 'yani_agent_language', $userlangs );
	        update_post_meta( $agent_id, 'yani_agent_address', $user_address );
	        update_post_meta( $agent_id, 'yani_agent_company', $user_company );
	        update_post_meta( $agent_id, 'yani_agent_service_area', $service_areas );
	        update_post_meta( $agent_id, 'yani_agent_specialties', $specialties );

    }

    public function get_profile_pic($user_id = null) {

	        if(empty($user_id)) {
	            $user_id = get_the_author_meta( 'ID' );
	        }
	        
	        $author_picture_id      =   get_the_author_meta( 'yani_author_picture_id' , $user_id );
	        $user_custom_picture = get_the_author_meta( 'yani_author_custom_picture', $user_id );

	        if( !empty( $author_picture_id ) ) {
	            $author_picture_id = intval( $author_picture_id );
	            if ( $author_picture_id ) {
	                $img = wp_get_attachment_image_src( $author_picture_id, 'large' );
	                $user_custom_picture = $img[0];

	            }
	        }

	        if($user_custom_picture =='' ) {
	            // $user_custom_picture = yani_IMAGE. 'profile-avatar.png';
	        }

	        return $user_custom_picture;
	    }

    public function update_user_agency($agency_user_agent_id, $firstname, $lastname, $useremail)    {
        if (!empty($firstname) || !empty($lastname)) {
            $agr = array(
                'ID' => $agency_user_agent_id,
                'post_title' => $firstname . ' ' . $lastname
            );
            $post_id = wp_update_post($agr);
        }
        update_post_meta( $post_id, 'yani_agent_email', $useremail );
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

function _yani_user() {
	return _Yani_User_Helper::get_instance();
}