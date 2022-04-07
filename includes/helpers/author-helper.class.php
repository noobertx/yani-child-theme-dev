<?php
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! class_exists( '_Yani_Author_Helper' ) ) {
	class _Yani_Author_Helper{
		private static $instance = null;	

		public function get_avatar_url($get_avatar){
        	preg_match("/src='(.*?)'/i", $get_avatar, $matches);
        	return $matches[1];
    	}

    	public function get( $post_id = 0 ){
        	$post = get_post( $post_id );
        	return $post->post_author;
    	}
    	
    	public function author_override($output){
	        global $post, $user_ID;

	        // return if this isn't the theme author override dropdown
	        if (!preg_match('/post_author_override/', $output)) return $output;

	        // return if we've already replaced the list (end recursion)
	        if (preg_match('/post_author_override_replaced/', $output)) return $output;

	        // replacement call to wp_dropdown_users
	        $output = wp_dropdown_users(array(
	            'echo' => 0,
	            'name' => 'post_author_override_replaced',
	            'selected' => empty($post->ID) ? $user_ID : $post->post_author,
	            'include_selected' => true
	        ));

	        // put the original name back
	        $output = preg_replace('/post_author_override_replaced/', 'post_author_override', $output);

	        return $output;
	    }

	    public function get_user_packages_meta( $post_id, $field = false ) {

	        $defaults = array(
	            'package_name' => ''
	        );

	        $meta = get_post_meta( $post_id, '_yani_user_package_meta', true );
	        $meta = wp_parse_args( (array) $meta, $defaults );

	        if ( $field ) {
	            if ( isset( $meta[$field] ) ) {
	                return $meta[$field];
	            } else {
	                return false;
	            }
	        }
	        return $meta;
	    }

	    public function get_post_type_array($post_type="yani_agent") {
	        $agents_array = array(
	            - 1 => $this->get('cl_none', 'None'),
	        );

	        $agents_posts = get_posts(
	            array(
	                'post_type'        =>  $post_type,
	                'posts_per_page'   => - 1,
	                'suppress_filters' => false,
	            )
	        );

	        if ( count( $agents_posts ) > 0 ) {
	            foreach ( $agents_posts as $agent_post ) {
	                $agents_array[ $agent_post->ID ] = $agent_post->post_title;
	            }
	        }

	        return $agents_array;
	    } 

	    public function get_ids_by_role($role) {
        	$ids = get_users(array('role' => $role, 'fields' => 'ID'));
        	return $ids;
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

function _yani_author() {
	return _Yani_Author_Helper::get_instance();
}