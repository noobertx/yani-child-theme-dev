<?php
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! class_exists( '_Yani_Membership_Package_Helper' ) ) {
	class _Yani_Membership_Package_Helper{
		private static $instance = null;		

		public function save_user_record( $userID ) {
	       
	        $args = array(
	            'author'        =>  $userID,
	            'post_type' => 'user_packages',
	            'posts_per_page' => 1
	        );
	        $current_user_posts = get_posts( $args );

	        if( !empty( $current_user_posts ) ) {
	            foreach ($current_user_posts as $post) {
	                $postID = $post->ID;
	            }

	            $args = array(
	                'ID'           => $postID,
	                'post_title' => 'Package ' . $userID,
	                'post_type' => 'user_packages',
	            );

	            // Update the post into the database
	            wp_update_post( $args );

	        } else {

	            $args = array(
	                'post_title' => 'Package ' . $userID,
	                'post_type' => 'user_packages',
	                'post_status' => 'publish'
	            );
	            // Insert the post into the database
	            $post_id = wp_insert_post($args);
	            update_post_meta($post_id, 'user_packages_userID', $userID);
	        }
	    }

	    public function check_membership( $user_id ) { //function user_has_membership
	        $has_package = get_the_author_meta( 'package_id', $user_id );
	        $has_listing = get_the_author_meta( 'package_listings', $user_id );

	        if( $this->is_admin() ) {
	            return true;

	        } else if( !empty( $has_package ) && ( $has_listing != 0 || $has_listing != '' ) ) {
	            
	            return true;
	        }
	        return false;
	    }

	    public function  check_user_package_status( $userID, $packID ) {

	        $pack_listings            =  get_post_meta( $packID, 'yani_package_listings', true );
	        $pack_featured_listings   =  get_post_meta( $packID, 'yani_package_featured_listings', true );
	        $pack_unlimited_listings  =  get_post_meta( $packID, 'yani_unlimited_listings', true );

	        $user_num_posted_listings = _yani_listing()->get_user_num_posted_listings( $userID );
	        $user_num_posted_featured_listings = _yani_listing()->get_user_num_posted_featured_listings( $userID );

	        $current_listings =  get_user_meta( $userID, 'package_listings', true ) ;

	        if( $pack_unlimited_listings == 1 || $current_listings == 0 ) {
	            return false;
	        }

	        // if is unlimited and go to non unlimited pack
	        if ( $current_listings == -1 && $pack_unlimited_listings != 1 ) {
	            return true;
	        }

	        if ( ( $user_num_posted_listings > $pack_listings ) || ( $user_num_posted_featured_listings > $pack_featured_listings ) ) {
	            return true;
	        } else {
	            return false;
	        }


    }

    	public function downgrade_package( $user_id, $pack_id ) {

	        $pack_listings           =  get_post_meta( $pack_id, 'pack_listings', true );
	        $pack_featured_listings  =  get_post_meta( $pack_id, 'pack_featured_listings', true );

	        update_user_meta( $user_id, 'package_listings', $pack_listings );
	        update_user_meta( $user_id, 'package_featured_listings', $pack_featured_listings );

	        $args = array(
	            'post_type'   => 'property',
	            'author'      => $user_id,
	            'post_status' => 'any'
	        );

	        $query = new WP_Query( $args );
	        global $post;
	        while( $query->have_posts()){
	            $query->the_post();

	            $property = array(
	                'ID'          => $post->ID,
	                'post_type'   => 'property',
	                'post_status' => 'expired'
	            );

	            wp_update_post( $property );
	            update_post_meta( $post->ID, 'yani_featured', 0 );
	        }
	        wp_reset_postdata();

	        $user = get_user_by( 'id', $user_id );
	        $user_email = $user->user_email;

	        $headers = 'From: No Reply <noreply@'.$_SERVER['HTTP_HOST'].'>' . "\r\n";
	        $message  = esc_html__('Account Downgraded,',_yani_theme()->get_text_domain()) . "\r\n\r\n";
	        $message .= sprintf( _("Hello, You downgraded your subscription on  %s. Because your listings number was greater than what the actual package offers, we set the status of all your listings to \"expired\". You will need to choose which listings you want live and send them again for approval. Thank you!",_yani_theme()->get_text_domain()), get_option('blogname')) . "\r\n\r\n";

	        wp_mail($user_email,
	            sprintf(esc_html__('[%s] Account Downgraded',_yani_theme()->get_text_domain()), get_option('blogname')),
	            $message,
	            $headers);
	    }


	    public function update_membership_package( $user_id, $package_id ) {

	        // Get selected package listings
	        $pack_listings            =   get_post_meta( $package_id, 'yani_package_listings', true );
	        $pack_featured_listings   =   get_post_meta( $package_id, 'yani_package_featured_listings', true );
	        $pack_unlimited_listings  =   get_post_meta( $package_id, 'yani_unlimited_listings', true );

	        $user_current_posted_listings           =   _yani_listing()->get_user_num_posted_listings ( $user_id ); // get user current number of posted listings ( no expired )
	        $user_current_posted_featured_listings  =   _yani_listing()->get_user_num_posted_featured_listings( $user_id ); // get user number of posted featured listings ( no expired )


	        if( $this->check_user_package_status( $user_id, $package_id ) ) {
	            $new_pack_listings           =  $pack_listings - $user_current_posted_listings;
	            $new_pack_featured_listings  =  $pack_featured_listings -  $user_current_posted_featured_listings;
	        } else {
	            $new_pack_listings           =  $pack_listings;
	            $new_pack_featured_listings  =  $pack_featured_listings;
	        }

	        if( $new_pack_listings < 0 ) {
	            $new_pack_listings = 0;
	        }

	        if( $new_pack_featured_listings < 0 ) {
	            $new_pack_featured_listings = 0;
	        }

	        if ( $pack_unlimited_listings == 1 ) {
	            $new_pack_listings = -1 ;
	        }



	        update_user_meta( $user_id, 'package_listings', $new_pack_listings);
	        update_user_meta( $user_id, 'package_featured_listings', $new_pack_featured_listings);


	        // Use for user who submit property without having account and membership
	        $user_submit_has_no_membership = get_the_author_meta( 'user_submit_has_no_membership', $user_id );
	        if( !empty( $user_submit_has_no_membership ) ) {
	            $this->update_package_listings( $user_id );
	            _yani_property()->update_property_from_draft( $user_submit_has_no_membership ); // change property status from draft to pending or publish
	            delete_user_meta( $user_id, 'user_submit_has_no_membership' );
	        }


	        $time = time();
	        $date = date('Y-m-d H:i:s',$time);
	        update_user_meta( $user_id, 'package_activation', $date );
	        update_user_meta( $user_id, 'package_id', $package_id );

	    }

	    public function update_package_listings($user_id) {
	        $package_listings = get_the_author_meta( 'package_listings' , $user_id );
	        $user_submit_has_no_membership = get_the_author_meta( 'user_submit_has_no_membership', $user_id );
	        $user_submitted_without_membership = get_the_author_meta( 'user_submitted_without_membership', $user_id );
	        $package_listings = intval($package_listings);

	        if ( $package_listings - 1 >= 0 ) {
	            if($user_submitted_without_membership == 'yes') {
	                update_user_meta($user_id, 'package_listings', $package_listings - 1);
	            } else if( empty($user_submit_has_no_membership) ) {
	                update_user_meta($user_id, 'package_listings', $package_listings - 1);
	            } else {
	                update_user_meta($user_id, 'package_listings', $package_listings );
	            }
	        } else if( $package_listings == 0 ) {
	            update_user_meta( $user_id, 'package_listings', 0 );
	        }
	    }

	    public function get_user_package_id($user_id) {
	        return get_the_author_meta( 'package_id', $user_id );
	    }


	    public function get_user_current_package( $user_id ) {

	        $remaining_listings = _yani_user()->get_remaining_listings( $user_id );
	        $pack_featured_remaining_listings = _yani_user()->get_featured_remaining_listings( $user_id );
	        $package_id = $this->get_user_package_id( $user_id );
	        $packages_page_link = _yani_template()->get_template_link('template/template-packages.php');

	        if( $remaining_listings == -1 ) {
	            $remaining_listings = esc_html__('Unlimited', _yani_theme()->get_text_domain());
	        }

	        if( !empty( $package_id ) ) {

	            $seconds = 0;
	            $pack_title = get_the_title( $package_id );
	            $pack_listings = get_post_meta( $package_id, 'yani_package_listings', true );
	            $pack_unmilited_listings = get_post_meta( $package_id, 'yani_unlimited_listings', true );
	            $pack_featured_listings = get_post_meta( $package_id, 'yani_package_featured_listings', true );
	            $pack_billing_period = get_post_meta( $package_id, 'yani_billing_time_unit', true );
	            $pack_billing_frequency = get_post_meta( $package_id, 'yani_billing_unit', true );
	            $pack_date = strtotime ( get_user_meta( $user_id, 'package_activation',true ) );

	            switch ( $pack_billing_period ) {
	                case 'Day':
	                    $seconds = 60*60*24;
	                    break;
	                case 'Week':
	                    $seconds = 60*60*24*7;
	                    break;
	                case 'Month':
	                    $seconds = 60*60*24*30;
	                    break;
	                case 'Year':
	                    $seconds = 60*60*24*365;
	                    break;
	            }

	            $pack_time_frame = $seconds * $pack_billing_frequency;
	            $expired_date    = $pack_date + $pack_time_frame;
	            $expired_date = date_i18n( get_option('date_format'),  $expired_date );

	           
	            echo '<li>'.esc_html__( 'Your Current Package', 'houzez' ).'<strong>'.esc_attr( $pack_title ).'</strong></li>';

	            if( $pack_unmilited_listings == 1 ) {
	                echo '<li>'.esc_html__('Listings Included: ',_yani_theme()->get_text_domain()).'<strong>'.esc_html__('unlimited listings ',_yani_theme()->get_text_domain()).'</strong></li>';
	                echo '<li>'.esc_html__('Listings Remaining: ',_yani_theme()->get_text_domain()).'<strong>'.esc_html__('unlimited listings ',_yani_theme()->get_text_domain()).'</strong></li>';
	            } else {
	                echo '<li>'.esc_html__('Listings Included: ',_yani_theme()->get_text_domain()).'<strong>'.esc_attr( $pack_listings ).'</strong></li>';
	                echo '<li>'.esc_html__('Listings Remaining: ',_yani_theme()->get_text_domain()).'<strong>'.esc_attr( $remaining_listings ).'</strong></li>';
	            }

	            echo '<li>'.esc_html__('Featured Included: ',_yani_theme()->get_text_domain()).'<strong>'.esc_attr( $pack_featured_listings ).'</strong></li>';
	            echo '<li>'.esc_html__('Featured Remaining: ',_yani_theme()->get_text_domain()).'<strong>'.esc_attr( $pack_featured_remaining_listings ).'</strong></li>';
	            echo '<li>'.esc_html__('Ends On',_yani_theme()->get_text_domain()).'<strong>';
	            echo ' '.esc_attr( $expired_date );
	            echo '</strong></li>';

	        }
	    }

	    public function retrive_user_by_profile($recurring_payment_id)    {
	        if ($recurring_payment_id != '') {
	            $arg = array(
	                'meta_key' => 'yani_paypal_recurring_profile_id',
	                'meta_value' => $recurring_payment_id,
	                'meta_compare' => '='
	            );

	            $userid = 0;
	            $houzezusers = get_users($arg);
	            foreach ($houzezusers as $user) {
	                $userid = $user->ID;
	            }
	            return $userid;
	        } else {
	            return 0;
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

function _yani_membership() {
	return _Yani_Membership_Package_Helper::get_instance();
}