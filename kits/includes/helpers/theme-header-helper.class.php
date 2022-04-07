<?php
if ( ! defined( 'WPINC' ) ) {
	die;
}
if ( ! class_exists( '_themename_Theme_Header_Helper' ) ) {
	class _themename_Theme_Header_Helper{
		private static $instance = null;
		private $text_domain = "yani";

		public function init(){
    		add_action( '_themename_header_main', array($this,'render_header_main' ),99);
    		// add_filter('wp_dropdown_users', array($this,'author_override'));
		}		

		public function render_header_main(){
			get_template_part('template-parts/header/', 'main');
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

function _theme_header_helper_theme() {
	return _themename_Theme_Header_Helper::get_instance();
}

return _themename_Theme_Header_Helper::get_instance()->init();
?>