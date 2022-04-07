<?php
$theme = wp_get_theme( '_themename' );

define( 'NOONIE_THEME_VERSION', $theme['Version'] );
define( 'NOONIE_PARENT_DIR', get_template_directory() );
define( 'NOONIE_CHILD_DIR', get_stylesheet_directory() );
define( 'NOONIE_INCLUDES', NOONIE_PARENT_DIR . '/includes' );
define( 'NOONIE_FRAMEWORK', NOONIE_INCLUDES . '/framework' );
define( 'NOONIE_CUSTOMIZER_DIR', NOONIE_INCLUDES . '/customizer' );


require_once(NOONIE_INCLUDES."/libs/theme-support.php");
require_once(NOONIE_INCLUDES."/libs/navigation.php");
require_once( 'framework/mobile-menu-walker.php');
require_once( 'framework/menu-walker.php');
require_once(NOONIE_INCLUDES."/helpers/theme-helper.class.php");
require_once(NOONIE_INCLUDES."/helpers/theme-header-helper.class.php");
require_once(NOONIE_INCLUDES."/helpers/template-helper.class.php");
require_once NOONIE_CUSTOMIZER_DIR . '/noonie-customizer.php';

?>