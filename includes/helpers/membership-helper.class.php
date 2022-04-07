<?php
if ( ! defined( 'WPINC' ) ) {
    die;
}

if ( ! class_exists( '_yani_Membership_Helper' ) ) {
    class _yani_Membership_Helper{
        private static $instance = null;        

      

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
    return _yani_Membership_Helper::get_instance();
}