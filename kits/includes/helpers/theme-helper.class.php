<?php
if ( ! defined( 'WPINC' ) ) {
	die;
}
if ( ! class_exists( '_themename_Theme_Helper' ) ) {
	class _themename_Theme_Helper{
		private static $instance = null;
		private $text_domain = "yani";

		public function init(){
			add_filter( 'style_loader_src', array($this,'remove_wp_ver_css_js'), 9999 );
			add_filter( 'script_loader_src', array($this,'remove_wp_ver_css_js'), 9999 );
    		add_action( 'elementor/theme/register_locations', array($this,'register_elementor_templates_locations' ));
    		add_filter('wp_dropdown_users', array($this,'author_override'));
		}

		public function remove_wp_ver_css_js( $src ) {
        	if ( $this->get_option( 'remove_scripts_version', '1' ) ) {
            	if ( strpos( $src, 'ver=' ) ) {
                	$src = remove_query_arg( 'ver', $src );
            	}
        	}
        	return $src;
    	}

    	public function get_option( $id, $fallback = false, $param = false ) {
			if ( isset( $_GET['yani_'.$id] ) ) {
				if ( '-1' == $_GET['yani_'.$id] ) {
					return false;
				} else {
					return $_GET['yani_'.$id];
				}
			} else {
				global $yani_option;
				if ( $fallback == false ) $fallback = '';
				$output = ( isset($yani_option[$id]) && $yani_option[$id] !== '' ) ? $yani_option[$id] : $fallback;
				if ( !empty($yani_option[$id]) && $param ) {
					$output = $yani_option[$id][$param];
				}
			}
			return $output;
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

function _themename_theme() {
	return _themename_Theme_Helper::get_instance();
}

return _themename_Theme_Helper::get_instance()->init();
?>