<?php
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! class_exists( '_Yani_Attachment_Helper' ) ) {
	class _Yani_Attachment_Helper{
		private static $instance = null;		

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

		public static function get_instance() {

			// If the single instance hasn't been set, set it now.
			if ( null == self::$instance ) {
				self::$instance = new self;
			}
			return self::$instance;
		}
	}
}

function _yani_attachment() {
	return _Yani_Attachment_Helper::get_instance();
}