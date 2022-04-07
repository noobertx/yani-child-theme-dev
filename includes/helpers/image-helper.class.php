<?php
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! class_exists( '_Yani_Image_Helper' ) ) {
	class _Yani_Image_Helper{
		private static $instance = null;

		public function init(){
			add_filter( 'intermediate_image_sizes_advanced', array($this,'remove_default_images' ));
		}

		public function get_image_placeholder( $featured_image_size ){
	        $placeholder_url = _yani_theme()->get_option( 'yani_placeholder', false, 'url' );

	        if ( ! empty( $placeholder_url ) ) {
	            $placeholder_image_id = attachment_url_to_postid( $placeholder_url );
	            if ( ! empty( $placeholder_image_id ) ) {
	                return wp_get_attachment_image( $placeholder_image_id, $featured_image_size, false, array( "class" => "img-fluid" ) );
	            }

	        } else {
	            $dummy_image_url = $this->get_dummy_placeholder_link( $featured_image_size );
	            if ( ! empty( $dummy_image_url ) ) {
	                return sprintf( '<img class="img-fluid" src="%s" alt="%s">', esc_url( $dummy_image_url ), the_title_attribute( 'echo=0' ) );
	            }
	        }

	        return '';
	    }

	    function get_dummy_placeholder_link( $image_size ){

	        global $_wp_additional_image_sizes;
	        $img_width = 0;
	        $img_height = 0;
	        $img_text = get_bloginfo('name');

	        $protocol = 'http';
	        $protocol = ( is_ssl() ) ? 'https' : $protocol;

	        if ( in_array( $image_size , array( 'thumbnail', 'medium', 'large' ) ) ) {

	            $img_width = get_option( $image_size . '_size_w' );
	            $img_height = get_option( $image_size . '_size_h' );

	        } elseif ( isset( $_wp_additional_image_sizes[ $image_size ] ) ) {

	            $img_width = $_wp_additional_image_sizes[ $image_size ]['width'];
	            $img_height = $_wp_additional_image_sizes[ $image_size ]['height'];

	        }

	        if( intval( $img_width ) > 0 && intval( $img_height ) > 0 ) {
	            return $protocol.'://placehold.it/' . $img_width . 'x' . $img_height . '&text=' . urlencode( $img_text ) . '';
	        }

	        return '';
	    }

	     function get_attachment_metadata($attachment_id)    {
	        $thumbnail_image = get_posts(array('p' => $attachment_id, 'post_type' => 'attachment'));

	        if ($thumbnail_image && isset($thumbnail_image[0])) {
	            return $thumbnail_image[0];
	        }
	    }

	    public function get_image_url( $image_size, $post_id = NULL ) {
	        $thumb_id = get_post_thumbnail_id($post_id);
	        $thumb_url_array = wp_get_attachment_image_src( $thumb_id, $image_size, true );

	        return $thumb_url_array;
	    }

	    public function get_image_placeholder_url( $image_size ){

	        $placeholder_url = _yani_theme()->get_option( 'yani_placeholder', false, 'url' );
	        if ( ! empty( $placeholder_url ) ) {
	            $placeholder_image_id = attachment_url_to_postid( $placeholder_url );
	            if ( ! empty( $placeholder_image_id ) ) {
	                return wp_get_attachment_image_url( $placeholder_image_id, $image_size, false );
	            }
	        }

	        return $this->get_dummy_placeholder_link( $image_size );
	    }


	    public function remove_default_images( $sizes ) {
	        if ( 'true' == get_option( 'yani_unset_default_image_sizes' ) ) {
	            unset( $sizes['small'] ); // 150px
	            unset( $sizes['medium'] ); // 300px
	            unset( $sizes['medium_large'] ); // 768px
	            unset( $sizes['1536x1536'] ); // 2x medium_large size.
	            unset( $sizes['large'] ); // 1024px
	            unset( $sizes['2048x2048'] ); // // 2x large size.
	        }

	        return $sizes;
	    }

	    public function get_image_id($image_url) {
	        global $wpdb;
	        $attachment = $wpdb->get_col($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE guid='%s';", $image_url));
	        return $attachment[0];
	    }

	    public  function get_image_by_id( $thumb_id, $image_size ) {
	        $thumb_url_array = wp_get_attachment_image_src( $thumb_id, $image_size, true );
	        return $thumb_url_array;
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

function _yani_image() {
	return _Yani_Image_Helper::get_instance();
}