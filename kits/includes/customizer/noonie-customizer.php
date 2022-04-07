<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
require( dirname( __FILE__ ) . '/core/customizer-framework.class.php' );
require( dirname( __FILE__ ) . '/core/customizer-base-options.class.php' );

class Noonie_Customizer {
	public function __construct() {

		// Include the customize options.
		add_action( 'customize_register', array( $this, 'customize_register' ) );

		// Include the required files for Customize option.
		add_action( 'customize_register', array( $this, 'customize_options_file_include' ) , 9 );

	}

	public function customize_register( $wp_customize ) {

		// Override default.
		// require COLORMAG_CUSTOMIZER_DIR . '/override-defaults.php';

	}

	public function customize_options_file_include() {
		require NOONIE_CUSTOMIZER_DIR . '/customizer-register-sections-panels.class.php';

		// Header customize options.
		require NOONIE_CUSTOMIZER_DIR . '/options/header/customize-site-identity-options.class.php';
	}


}

return new Noonie_Customizer();
?>