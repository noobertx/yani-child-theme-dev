<?php

    /**
     * ReduxFramework Barebones Sample Config File
     * For full documentation, please visit: http://docs.reduxframework.com/
     */

    if ( ! class_exists( 'Redux' ) ) {
        return;
    }

    // This is your option name where all the Redux data is stored.
    $opt_name = "custom_wprig_opt";

    /**
     * ---> SET ARGUMENTS
     * All the possible arguments for Redux.
     * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
     * */

    $theme = wp_get_theme(); // For use with some settings. Not necessary.

    $args = array(
        // TYPICAL -> Change these values as you need/desire
        'opt_name'             => $opt_name,
        // This is where your data is stored in the database and also becomes your global variable name.
        'display_name'         => $theme->get( 'Name' ),
        // Name that appears at the top of your panel
        'display_version'      => $theme->get( 'Version' ),
        // Version that appears at the top of your panel
        'menu_type'            => 'menu',
        //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
        'allow_sub_menu'       => true,
        // Show the sections below the admin menu item or not
        'menu_title'           => __( 'WPRig Options', 'redux-framework-demo' ),
        'page_title'           => __( 'WPRig Options', 'redux-framework-demo' ),
        // You will need to generate a Google API key to use this feature.
        // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
        'google_api_key'       => '',
        // Set it you want google fonts to update weekly. A google_api_key value is required.
        'google_update_weekly' => false,
        // Must be defined to add google fonts to the typography module
        'async_typography'     => true,
        // Use a asynchronous font on the front end or font string
        //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
        'admin_bar'            => true,
        // Show the panel pages on the admin bar
        'admin_bar_icon'       => 'dashicons-portfolio',
        // Choose an icon for the admin bar menu
        'admin_bar_priority'   => 50,
        // Choose an priority for the admin bar menu
        'global_variable'      => '',
        // Set a different name for your global variable other than the opt_name
        'dev_mode'             => true,
        // Show the time the page took to load, etc
        'update_notice'        => true,
        // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
        'customizer'           => true,
        // Enable basic customizer support
        //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
        //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

        // OPTIONAL -> Give you extra features
        'page_priority'        => null,
        // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
        'page_parent'          => 'themes.php',
        // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
        'page_permissions'     => 'manage_options',
        // Permissions needed to access the options panel.
        'menu_icon'            => '',
        // Specify a custom URL to an icon
        'last_tab'             => '',
        // Force your panel to always open to a specific tab (by id)
        'page_icon'            => 'icon-themes',
        // Icon displayed in the admin panel next to your menu_title
        'page_slug'            => '_options',
        // Page slug used to denote the panel
        'save_defaults'        => true,
        // On load save the defaults to DB before user clicks save or not
        'default_show'         => false,
        // If true, shows the default value next to each field that is not the default value.
        'default_mark'         => '',
        // What to print by the field's title if the value shown is default. Suggested: *
        'show_import_export'   => true,
        // Shows the Import/Export panel when not used as a field.

        // CAREFUL -> These options are for advanced use only
        'transient_time'       => 60 * MINUTE_IN_SECONDS,
        'output'               => true,
        // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
        'output_tag'           => true,
        // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
        // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

        // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
        'database'             => '',
        // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!

        'use_cdn'              => true,
        // If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code.

        //'compiler'             => true,

        // HINTS
        'hints'                => array(
            'icon'          => 'el el-question-sign',
            'icon_position' => 'right',
            'icon_color'    => 'lightgray',
            'icon_size'     => 'normal',
            'tip_style'     => array(
                'color'   => 'light',
                'shadow'  => true,
                'rounded' => false,
                'style'   => '',
            ),
            'tip_position'  => array(
                'my' => 'top left',
                'at' => 'bottom right',
            ),
            'tip_effect'    => array(
                'show' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'mouseover',
                ),
                'hide' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'click mouseleave',
                ),
            ),
        )
    );

    // ADMIN BAR LINKS -> Setup custom links in the admin bar menu as external items.
    $args['admin_bar_links'][] = array(
        'id'    => 'redux-docs',
        'href'  => 'http://docs.reduxframework.com/',
        'title' => __( 'Documentation', 'redux-framework-demo' ),
    );

    $args['admin_bar_links'][] = array(
        //'id'    => 'redux-support',
        'href'  => 'https://github.com/ReduxFramework/redux-framework/issues',
        'title' => __( 'Support', 'redux-framework-demo' ),
    );

    $args['admin_bar_links'][] = array(
        'id'    => 'redux-extensions',
        'href'  => 'reduxframework.com/extensions',
        'title' => __( 'Extensions', 'redux-framework-demo' ),
    );

    // SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
    $args['share_icons'][] = array(
        'url'   => 'https://github.com/ReduxFramework/ReduxFramework',
        'title' => 'Visit us on GitHub',
        'icon'  => 'el el-github'
        //'img'   => '', // You can use icon OR img. IMG needs to be a full URL.
    );
    $args['share_icons'][] = array(
        'url'   => 'https://www.facebook.com/pages/Redux-Framework/243141545850368',
        'title' => 'Like us on Facebook',
        'icon'  => 'el el-facebook'
    );
    $args['share_icons'][] = array(
        'url'   => 'http://twitter.com/reduxframework',
        'title' => 'Follow us on Twitter',
        'icon'  => 'el el-twitter'
    );
    $args['share_icons'][] = array(
        'url'   => 'http://www.linkedin.com/company/redux-framework',
        'title' => 'Find us on LinkedIn',
        'icon'  => 'el el-linkedin'
    );

    // Panel Intro text -> before the form
    if ( ! isset( $args['global_variable'] ) || $args['global_variable'] !== false ) {
        if ( ! empty( $args['global_variable'] ) ) {
            $v = $args['global_variable'];
        } else {
            $v = str_replace( '-', '_', $args['opt_name'] );
        }
        $args['intro_text'] = sprintf( __( '<p>Did you know that Redux sets a global variable for you? To access any of your saved options from within your code you can use your global variable: <strong>$%1$s</strong></p>', 'redux-framework-demo' ), $v );
    } else {
        $args['intro_text'] = __( '<p>This text is displayed above the options panel. It isn\'t required, but more info is always better! The intro_text field accepts all HTML.</p>', 'redux-framework-demo' );
    }

    // Add content after the form.
    $args['footer_text'] = __( '<p>This text is displayed below the options panel. It isn\'t required, but more info is always better! The footer_text field accepts all HTML.</p>', 'redux-framework-demo' );

    Redux::setArgs( $opt_name, $args );

    /*
     * ---> END ARGUMENTS
     */

    /*
     * ---> START HELP TABS
     */

    $tabs = array(
        array(
            'id'      => 'redux-help-tab-1',
            'title'   => __( 'Theme Information 1', 'redux-framework-demo' ),
            'content' => __( '<p>This is the tab content, HTML is allowed.</p>', 'redux-framework-demo' )
        ),
        array(
            'id'      => 'redux-help-tab-2',
            'title'   => __( 'Theme Information 2', 'redux-framework-demo' ),
            'content' => __( '<p>This is the tab content, HTML is allowed.</p>', 'redux-framework-demo' )
        )
    );
    Redux::setHelpTab( $opt_name, $tabs );

    // Set the help sidebar
    $content = __( '<p>This is the sidebar content, HTML is allowed.</p>', 'redux-framework-demo' );
    Redux::setHelpSidebar( $opt_name, $content );


    /*
     * <--- END HELP TABS
     */


    /*
     *
     * ---> START SECTIONS
     *
     */

    /*

        As of Redux 3.5+, there is an extensive API. This API can be used in a mix/match mode allowing for


     */
    Redux::setSection( $opt_name, array(
        'title'            => __( 'General', 'redux-framework-demo' ),
        'id'               => 'general',
        'desc'             => __( '', 'redux-framework-demo' ),
        'customizer_width' => '400px',
        'icon'             => 'el el-th'
    ) );

    Redux::setSection( $opt_name, array(
        'title'  => __( 'Contact & Socials', 'redux-framework-demo' ),
        'id'     => 'contact-socials-options',
        'subsection'       => true,
        'desc'   => __( '', 'redux-framework-demo' ),
        'icon'   => 'el el-th',
        'fields' => array(
            array(
                'id'       => 'address-field-title',
                'type'     => 'text',
                'title'    => __( 'Address Field', 'redux-framework-demo' ),
                'default'  => 'Contact information',
            ),
            array(
                'id'       => 'address',
                'type'     => 'textarea',
                'title'    => __( 'Address', 'redux-framework-demo' )                
            ),            
            array(
                'id'       => 'call-now-field-title',
                'type'     => 'text',
                'title'    => __( 'Call Now Field Title', 'redux-framework-demo' ),
                'default'  => 'We are available 24/ 7. Call Now.',
            ),
            array(
                'id'       => 'phone',
                'type'     => 'text',
                'title'    => __( 'Phone', 'redux-framework-demo' ),
                'default'  => '',
            ),
            array(
                'id'       => 'fax',
                'type'     => 'text',
                'title'    => __( 'Fax', 'redux-framework-demo' ),
                'default'  => '',
            ),
            array(
                'id'       => 'email',
                'type'     => 'text',
                'title'    => __( 'Email', 'redux-framework-demo' ),
                'default'  => '',
            ),
            array(
                'id'       => 'social-title',
                'type'     => 'text',
                'title'    => __( 'Social Title', 'redux-framework-demo' ),
                'default'  => '',
            ),
            array(
                'id'       => 'social-icons',
                'type'     => 'multi_text',
                'title'    => __( 'Social Media Links', 'redux-framework-demo' )
            ),
        )
    ) );

    Redux::setSection( $opt_name, array(
        'title'            => __( 'Header', 'redux-framework-demo' ),
        'id'               => 'header',
        'desc'             => __( '', 'redux-framework-demo' ),
        'customizer_width' => '400px',
        'icon'             => 'el el-th'
    ) );

    // -> START Basic Fields
    Redux::setSection( $opt_name, array(
        'title'  => __( 'Header Main', 'redux-framework-demo' ),
        'id'     => 'header-options',
        'subsection'       => true,
        'desc'   => __( 'Basic field with no subsections.', 'redux-framework-demo' ),
        'icon'   => 'el el-th',
        'fields' => array(
            array(
                'id'       => 'opt-display-header-area',
                'type'     => 'switch',
                'title'    => 'Display Header Area',
                'subtitle' => '',
                'default'  => true
            ),
            array(
                'id'       => 'opt-display-sticky-header',
                'type'     => 'switch',
                'title'    => 'Sticky Header',
                'subtitle' => '',
                'default'  => true
            ),
            array(
                'id'       => 'opt-header-logo',
                'type'     => 'media',
                'url'      => true,
                'title'    => __( 'Header Logo', 'redux-framework-demo' ),
                'compiler' => 'true',
                //'mode'      => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                'default'  => array( 'url' => 'https://s.wordpress.org/style/images/codeispoetry.png' ),
                //'hint'      => array(
                //    'title'     => 'Hint Title',
                //    'content'   => 'This is a <b>hint</b> for the media field with a Title.',
                //)
            ),
            array(
                'id'       => 'opt-header-select-layout',
                'type'     => 'image_select',
                'title'    => __( 'Header Layout', 'redux-framework-demo' ),
                'subtitle' => __( '', 'redux-framework-demo' ),
                'desc'     => __( '.', 'redux-framework-demo' ),
                //Must provide key => value(array:title|img) pairs for radio options
                'options'  => array(
                    '1' => array(
                        'alt' => '1 Column',
                        'img' => ReduxFramework::$_url . 'assets/img/1col.png'
                    ),
                    '2' => array(
                        'alt' => '2 Column Left',
                        'img' => ReduxFramework::$_url . 'assets/img/2cl.png'
                    ),
                    '3' => array(
                        'alt' => '2 Column Right',
                        'img' => ReduxFramework::$_url . 'assets/img/2cr.png'
                    ),
                    '4' => array(
                        'alt' => '3 Column Middle',
                        'img' => ReduxFramework::$_url . 'assets/img/3cm.png'
                    ),
                    '5' => array(
                        'alt' => '3 Column Left',
                        'img' => ReduxFramework::$_url . 'assets/img/3cl.png'
                    ),
                    '6' => array(
                        'alt' => '3 Column Right',
                        'img' => ReduxFramework::$_url . 'assets/img/3cr.png'
                    ),
                    '7' => array(
                        'alt' => '3 Column Right',
                        'img' => ReduxFramework::$_url . 'assets/img/3cr.png'
                    )
                ),
                'default'  => '2'
            ),
            array(
                'id'       => 'opt-responsive-style',
                'type'     => 'select',
                'title'    => __( 'Responsive Style', 'redux-framework-demo' ),
                'subtitle' => __( '', 'redux-framework-demo' ),
                'desc'     => __( '', 'redux-framework-demo' ),
                //Must provide key => value pairs for select options
                'options'  => array(
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                    '5' => '5',
                    '6' => '6',
                    '7' => '7',
                ),
                'default'  => '1'
            ),
            array(
                'id'       => 'opt-header-location',
                'type'     => 'select',
                'title'    => __( 'Header Location', 'redux-framework-demo' ),
                'subtitle' => __( '', 'redux-framework-demo' ),
                'desc'     => __( '', 'redux-framework-demo' ),
                //Must provide key => value pairs for select options
                'options'  => array(
                    'top-header' => 'Top',
                    'left-header' => 'Left',
                    'right-header' => 'Right'
                ),
                'default'  => 'top-header'
            ),
            array(
                'id'       => 'opt-expand-header',
                'type'     => 'switch',
                'title'    => 'Initially expand header',
                'required' => array( 'opt-header-location', '!=', 'top-header' ),
                'subtitle' => '',
                'default'  => true
            ),
            array(
                'id'       => 'opt-menu-opens-on',
                'type'     => 'select',
                'title'    => __( 'Select Dropdown Menu Open Option', 'redux-framework-demo' ),
                'subtitle' => __( '', 'redux-framework-demo' ),
                'desc'     => __( '', 'redux-framework-demo' ),
                //Must provide key => value pairs for select options
                'options'  => array(
                    'click' => 'Click',
                    'hover' => 'Hover'
                ),
                'default'  => 'click'
            ),
            array(
                'id'       => 'opt-menu-justify-content',
                'type'     => 'select',
                'title'    => __( 'Justify Menu Content', 'redux-framework-demo' ),
                'subtitle' => __( '', 'redux-framework-demo' ),
                'desc'     => __( '', 'redux-framework-demo' ),
                //Must provide key => value pairs for select options
                'options'  => array(
                    'left' => 'Left',
                    'center' => 'Center',
                    'right' => 'Right',
                    'space-around' => 'Space Around',
                    'space-between' => 'Space Between',
                    'space-evenly' => 'Space Evenly',
                ),
                'default'  => 'left'
            ),
            array(
                'id'       => 'opt-display-search-icon',
                'type'     => 'switch',
                'title'    => 'Display Search Icon',
                'subtitle' => '',
                'default'  => true
            ),
            array(
                'id'       => 'opt-display-cart-icon',
                'type'     => 'switch',
                'title'    => 'Display Cart Icon',
                'subtitle' => '',
                'default'  => true
            ),
            array(
                'id'       => 'opt-display-header-top-menu',
                'type'     => 'switch',
                'title'    => 'Display Header Top Menu',
                'subtitle' => '',
                'default'  => true
            ),
            array(
                'id'       => 'opt-display-current-date',
                'type'     => 'switch',
                'title'    => 'Display Current Date',
                'subtitle' => '',
                'default'  => true
            ),
            array(
                'id'       => 'opt-text',
                'type'     => 'text',
                'title'    => __( 'Example Text', 'redux-framework-demo' ),
                'desc'     => __( 'Example description.', 'redux-framework-demo' ),
                'subtitle' => __( 'Example subtitle.', 'redux-framework-demo' ),
                'hint'     => array(
                    'content' => 'This is a <b>hint</b> tool-tip for the text field.<br/><br/>Add any HTML based text you like here.',
                )
            )
        )
    ) );

    Redux::setSection( $opt_name, array(
        'title'  => __( 'Off Canvas Menu', 'redux-framework-demo' ),
        'id'     => 'off-canvas-menu-options',
        'subsection'       => true,
        'desc'   => __( '', 'redux-framework-demo' ),
        'icon'   => 'el el-th',
        'fields' => array(
            array(
                'id'       => 'opt-display-off-canvas-area',
                'type'     => 'switch',
                'title'    => 'Display Off Canvas Area',
                'subtitle' => '',
                'default'  => true
            ),
            array(
                'id'       => 'opt-display-off-canvas-search',
                'type'     => 'switch',
                'required' => array( 'opt-display-off-canvas-area', '=', '1' ),
                'title'    => 'Off-Canvas Search',
                'subtitle' => '',
                'default'  => true
            ),
            array(
                'id'       => 'opt-display-off-canvas-menu',
                'type'     => 'switch',
                'required' => array( 'opt-display-off-canvas-area', '=', '1' ),
                'title'    => 'Off-Canvas Menu',
                'subtitle' => '',
                'default'  => true
            ), 
            array(
                'id'       => 'opt-display-off-canvas-contact-info',
                'type'     => 'switch',
                'required' => array( 'opt-display-off-canvas-area', '=', '1' ),
                'title'    => 'Off-Canvas Contact Info',
                'subtitle' => '',
                'default'  => true
            )
        )
    ) );

    Redux::setSection( $opt_name, array(
        'title'            => __( 'Footer', 'redux-framework-demo' ),
        'id'               => 'footer',
        'desc'             => __( '', 'redux-framework-demo' ),
        'customizer_width' => '400px',
        'icon'             => 'el el-th'
    ) );

    Redux::setSection( $opt_name, array(
        'title'  => __( 'Footer', 'redux-framework-demo' ),
        'id'     => 'footer-options',
        'subsection'       => true,
        'desc'   => __( '', 'redux-framework-demo' ),
        'icon'   => 'el el-th',
        'fields' => array(
            array(
                'id'       => 'opt-display-footer-area',
                'type'     => 'switch',
                'title'    => 'Display Footer Area',
                'subtitle' => '',
                'default'  => true
            ),
            array(
                'id'      => 'opt-sfooter-logo',
                'type'    => 'media',
                'title'   => __( 'Footer Logo', 'redux-framework-demo' ),
                'default'  => array( 'url' => 'https://s.wordpress.org/style/images/codeispoetry.png' )                
            ),
            array(
                'id'       => 'opt-footer-logo',
                'type'     => 'media',
                'url'      => true,
                'title'    => __( 'Footer Logo', 'redux-framework-demo' ),
                'compiler' => 'true',
                //'mode'      => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                'default'  => array( 'url' => 'https://s.wordpress.org/style/images/codeispoetry.png' ),
                //'hint'      => array(
                //    'title'     => 'Hint Title',
                //    'content'   => 'This is a <b>hint</b> for the media field with a Title.',
                //)
            ),
            array(
                'id'       => 'opt-footer-select-layout',
                'type'     => 'image_select',
                'title'    => __( 'Footer Layout', 'redux-framework-demo' ),
                'subtitle' => __( '', 'redux-framework-demo' ),
                'desc'     => __( '.', 'redux-framework-demo' ),
                //Must provide key => value(array:title|img) pairs for radio options
                'options'  => array(
                    '1' => array(
                        'alt' => 'Layout 1',
                        'img' => ReduxFramework::$_url . 'assets/img/1col.png'
                    ),
                    '2' => array(
                        'alt' => 'Layout 2 Left',
                        'img' => ReduxFramework::$_url . 'assets/img/2cl.png'
                    ),
                    '3' => array(
                        'alt' => 'Layout 2 Right',
                        'img' => ReduxFramework::$_url . 'assets/img/2cr.png'
                    )
                ),
                'default'  => '2'
            ),
            array(
                'id'       => 'opt-footer-columns',
                'type'     => 'select',
                'title'    => __( 'Number of Columns', 'redux-framework-demo' ),
                'subtitle' => __( '', 'redux-framework-demo' ),
                'desc'     => __( '', 'redux-framework-demo' ),
                //Must provide key => value pairs for select options
                'options'  => array(
                    '1' => '1 Column',
                    '2' => '2 Column',
                    '3' => '3 Column',
                    '4' => '4 Column',
                    '5' => '5 Column',
                    '6' => '6 Column',
                ),
                'default'  => '4'
            ),
            array(
                'id'       => 'opt-display-footer-middle',
                'type'     => 'switch',
                'title'    => 'Display Footer Middle',
                'subtitle' => '',
                'default'  => true
            ),
            array(
                'id'       => 'opt-display-footer-bottom-menu',
                'type'     => 'switch',
                'title'    => 'Display Footer Bottom Menu',
                'subtitle' => '',
                'default'  => true
            ),
            array(
                'id'       => 'opt-display-copyright',
                'type'     => 'switch',
                'title'    => 'Display Copyright',
                'subtitle' => '',
                'default'  => true
            ),
            array(
                'id'       => 'opt-display-copyright-text',
                'type'     => 'textarea',
                'title'    => __( 'Copyright Text', 'redux-framework-demo' )                
            ) 
        )
    ) );

    Redux::setSection( $opt_name, array(
        'title'            => __( 'Page Layouts', 'redux-framework-demo' ),
        'id'               => 'page-layouts',
        'desc'             => __( '', 'redux-framework-demo' ),
        'customizer_width' => '400px',
        'icon'             => 'el el-th'
    ) );

    Redux::setSection( $opt_name, array(
        'title'  => __( 'Page Layouts', 'redux-framework-demo' ),
        'id'     => 'page-layout-options',
        'subsection'       => true,
        'desc'   => __( '', 'redux-framework-demo' ),
        'icon'   => 'el el-th',
        'fields' => array(
            array(
                'id'       => 'opt-design-width',
                'type'     => 'button_set',
                'title'    => __( 'Design Width', 'redux-framework-demo' ),
                //Must provide key => value pairs for radio options
                'options'  => array(
                    'full-width-layout' => 'Full Width',
                    'box-width-layout' => 'Boxed',
                ),
                'default'  => 'full-width-layout'
            ),
            array(
                'id'             => 'opt-boxed-width',
                'type'           => 'dimensions',
                'required' => array( 'opt-design-width', '=', 'box-width-layout' ),
                'units'          => array( 'px', 'em', 'vw '),    // You can specify a unit value. Possible: px, em, %
                'units_extended' => 'true',  // Allow users to select any type of unit
                'title'          => __( 'Page Width', 'redux-framework-demo' ),
                'height'         => false,
                'default'        => array(
                    'width'  => 1200,
                )
            ),
            array(
                'id'       => 'opt-page-layout',
                'type'     => 'select',
                'title'    => __( 'Page Layout', 'redux-framework-demo' ),
                'options'  => array(
                    'left-sidebar' => 'Left Sidebar',
                    'full-width' => 'Full Width',
                    'right-sidebar' => 'Right Sidebar',
                ),
                'default'  => 'full-width'
            ),
            array(
                'id'       => 'opt-display-page-breadcrumbs',
                'type'     => 'switch',
                'title'    => 'Breadcrumb',
                'subtitle' => '',
                'default'  => true
            ),
            array(
                'id'       => 'opt-display-page-banner',
                'type'     => 'switch',
                'title'    => 'Banner',
                'subtitle' => '',
                'default'  => true
            ),
        )
    ) );

    Redux::setSection( $opt_name, array(
        'title'            => __( 'Archive', 'redux-framework-demo' ),
        'id'               => 'archive-layouts',
        'desc'             => __( '', 'redux-framework-demo' ),
        'customizer_width' => '400px',
        'icon'             => 'el el-th'
    ) );

    Redux::setSection( $opt_name, array(
        'title'  => __( 'Archive Layouts', 'redux-framework-demo' ),
        'id'     => 'archive-layout-options',
        'subsection'       => true,
        'desc'   => __( '', 'redux-framework-demo' ),
        'icon'   => 'el el-th',
        'fields' => array(
            array(
                'id'       => 'opt-archive-layout',
                'type'     => 'select',
                'title'    => __( 'Archive Layout', 'redux-framework-demo' ),
                'options'  => array(
                    'left-sidebar' => 'Left Sidebar',
                    'full-width' => 'Full Width',
                    'right-sidebar' => 'Right Sidebar',
                ),
                'default'  => 'full-width'
            ),
            array(
                'id'       => 'opt-display-archive-breadcrumbs',
                'type'     => 'switch',
                'title'    => 'Breadcrumb',
                'subtitle' => '',
                'default'  => true
            ),
            array(
                'id'       => 'opt-display-archive-banner',
                'type'     => 'switch',
                'title'    => 'Banner',
                'subtitle' => '',
                'default'  => true
            ),
            array(
                'id'       => 'opt-archive-template',
                'type'     => 'image_select',
                'title'    => __( 'Archive Template', 'redux-framework-demo' ),
                'subtitle' => __( '', 'redux-framework-demo' ),
                'desc'     => __( '.', 'redux-framework-demo' ),
                //Must provide key => value(array:title|img) pairs for radio options
                'options'  => array(
                    'archive-listings' => array(
                        'alt' => 'Listings',
                        'img' => ReduxFramework::$_url . 'assets/img/1col.png'
                    ),
                    'archive-cards' => array(
                        'alt' => 'Grid',
                        'img' => ReduxFramework::$_url . 'assets/img/2cl.png'
                    ),
                ),
                'default'  => 'archive-listings'
            ),
            array(
                'id'       => 'opt-display-archive-content',
                'type'     => 'switch',
                'title'    => 'Show Content Display',
                'subtitle' => '',
                'default'  => true
            ),
            array(
                'id'       => 'opt-display-number-archive-item',
                'type'     => 'text',
                'title'    => __( 'Number of Content', 'redux-framework-demo' ),
                'validate' => 'numeric',
                'default'  => '20',
            ),
            array(
                'id'       => 'opt-display-archive-author',
                'type'     => 'switch',
                'title'    => 'Show Author Name',
                'subtitle' => '',
                'default'  => true
            ),
            array(
                'id'       => 'opt-display-archive-date',
                'type'     => 'switch',
                'title'    => 'Show Author Date',
                'subtitle' => '',
                'default'  => true
            ),
            array(
                'id'       => 'opt-display-archive-post-view',
                'type'     => 'switch',
                'title'    => 'Show / Hide Post View',
                'subtitle' => '',
                'default'  => false
            ),
            array(
                'id'       => 'opt-display-archive-post-update-date',
                'type'     => 'switch',
                'title'    => 'Show Post Update Date',
                'subtitle' => '',
                'default'  => false
            ),
            array(
                'id'       => 'opt-display-archive-post-shares',
                'type'     => 'switch',
                'title'    => 'Show/hide Post Shares',
                'subtitle' => '',
                'default'  => false
            ),
            array(
                'id'       => 'opt-display-archive-categories',
                'type'     => 'switch',
                'title'    => 'Show Categories',
                'subtitle' => '',
                'default'  => true
            ),
            array(
                'id'       => 'opt-display-archive-comments',
                'type'     => 'switch',
                'title'    => 'Show Comment Number',
                'subtitle' => '',
                'default'  => false
            ),
            array(
                'id'       => 'opt-display-archive-thumbnail',
                'type'     => 'switch',
                'title'    => 'Show post thumbnail',
                'subtitle' => '',
                'default'  => true
            ),
            array(
                'id'       => 'opt-archive-pagination-style',
                'type'     => 'select',
                'title'    => __( 'Pagination Style', 'redux-framework-demo' ),
                'options'  => array(
                    'classic' => 'Classic Pagination',
                    'click' => 'Click Load More',
                    'scroll' => 'Scroll Load More',
                ),
                'default'  => 'classic'
            ),
        )
    ) );

    Redux::setSection( $opt_name, array(
        'title'            => __( 'Single', 'redux-framework-demo' ),
        'id'               => 'single-layouts',
        'desc'             => __( '', 'redux-framework-demo' ),
        'customizer_width' => '400px',
        'icon'             => 'el el-th'
    ) );

    Redux::setSection( $opt_name, array(
        'title'  => __( 'Single Layouts', 'redux-framework-demo' ),
        'id'     => 'single-layout-options',
        'subsection'       => true,
        'desc'   => __( '', 'redux-framework-demo' ),
        'icon'   => 'el el-th',
        'fields' => array(
            array(
                'id'       => 'opt-single-layout',
                'type'     => 'select',
                'title'    => __( 'Single Page Layout', 'redux-framework-demo' ),
                'options'  => array(
                    'left-sidebar' => 'Left Sidebar',
                    'full-width' => 'Full Width',
                    'right-sidebar' => 'Right Sidebar',
                ),
                'default'  => 'full-width'
            ),
            array(
                'id'       => 'opt-display-single-breadcrumbs',
                'type'     => 'switch',
                'title'    => 'Breadcrumb',
                'subtitle' => '',
                'default'  => true
            ),
            array(
                'id'       => 'opt-display-single-banner',
                'type'     => 'switch',
                'title'    => 'Banner',
                'subtitle' => '',
                'default'  => true
            ),
            array(
                'id'       => 'opt-single-template',
                'type'     => 'image_select',
                'title'    => __( 'Single Template Layout', 'redux-framework-demo' ),
                'subtitle' => __( '', 'redux-framework-demo' ),
                'desc'     => __( '.', 'redux-framework-demo' ),
                //Must provide key => value(array:title|img) pairs for radio options
                'options'  => array(
                    '1' => array(
                        '1',
                        'img' => ReduxFramework::$_url . 'assets/img/1col.png'
                    ),
                    '2' => array(
                        'alt' => '2',
                        'img' => ReduxFramework::$_url . 'assets/img/2cl.png'
                    ),
                    '3' => array(
                        'alt' => '3',
                        'img' => ReduxFramework::$_url . 'assets/img/2cl.png'
                    ),
                    '4' => array(
                        'alt' => '4',
                        'img' => ReduxFramework::$_url . 'assets/img/2cl.png'
                    ),
                    '5' => array(
                        'alt' => '5',
                        'img' => ReduxFramework::$_url . 'assets/img/2cl.png'
                    ),
                    '6' => array(
                        'alt' => '6',
                        'img' => ReduxFramework::$_url . 'assets/img/2cl.png'
                    ),
                ),
                'default'  => '1'
            ),
            array(
                'id'       => 'opt-display-single-author',
                'type'     => 'switch',
                'title'    => 'Show Author Name',
                'subtitle' => '',
                'default'  => true
            ),
            array(
                'id'       => 'opt-display-single-author-bio',
                'type'     => 'switch',
                'title'    => 'Show Author Bio',
                'subtitle' => '',
                'default'  => true
            ),
            array(
                'id'       => 'opt-display-single-date',
                'type'     => 'switch',
                'title'    => 'Show Post Date',
                'subtitle' => '',
                'default'  => true
            ),
            array(
                'id'       => 'opt-display-single-post-view',
                'type'     => 'switch',
                'title'    => 'Show / Hide Post View',
                'subtitle' => '',
                'default'  => false
            ),
            array(
                'id'       => 'opt-display-single-post-update-date',
                'type'     => 'switch',
                'title'    => 'Show Post Update Date',
                'subtitle' => '',
                'default'  => false
            ),
            array(
                'id'       => 'opt-display-single-post-shares',
                'type'     => 'switch',
                'title'    => 'Show/hide Post Shares',
                'subtitle' => '',
                'default'  => false
            ),
            array(
                'id'       => 'opt-display-single-categories',
                'type'     => 'switch',
                'title'    => 'Show Categories',
                'subtitle' => '',
                'default'  => true
            ),
            array(
                'id'       => 'opt-display-single-comments',
                'type'     => 'switch',
                'title'    => 'Show Comment Number',
                'subtitle' => '',
                'default'  => false
            ),
            array(
                'id'       => 'opt-display-single-prev-next',
                'type'     => 'switch',
                'title'    => 'Show Next Post / Previous post',
                'subtitle' => '',
                'default'  => true
            ),
            array(
                'id'       => 'opt-display-single-post-share-top',
                'type'     => 'switch',
                'title'    => 'Show / Hide Share Button in top',
                'subtitle' => '',
                'default'  => true
            ),
            array(
                'id'       => 'opt-display-single-post-share-footer',
                'type'     => 'switch',
                'title'    => 'Show / Hide Share Button in footer',
                'subtitle' => '',
                'default'  => false
            ),
            array(
                'id'       => 'opt-display-single-post-related',
                'type'     => 'switch',
                'title'    => 'Show Related post',
                'subtitle' => '',
                'default'  => false
            ),
            array(
                'id'       => 'opt-single-related-post-title',
                'type'     => 'text',
                'required' => array( 'opt-display-single-post-related', '=', '1' ),
                'title'    => 'Related Post Title',
                'default'  => 'Related Posts'
            ),
            array(
                'id'       => 'opt-display-single-related-post-number',
                'type'     => 'text',
                'required' => array( 'opt-display-single-post-related', '=', '1' ),
                'title'    => __( 'Show Related Post Number', 'redux-framework-demo' ),
                'validate' => 'numeric',
                'default'  => '4',
            ),
            array(
                'id'       => 'opt-display-single-query-type',
                'type'     => 'select',
                'title'    => __( 'Query Type', 'redux-framework-demo' ),
                'required' => array( 'opt-display-single-post-related', '=', '1' ),
                'options'  => array(
                    'post_category' => 'Posts in the same Categories',
                    'tags' => 'Posts in the same Tags',
                    'author' => 'Posts by the same Author',
                ),
                'default'  => 'post_category'
            ),
            array(
                'id'       => 'opt-display-single-sort-order',
                'type'     => 'select',
                'title'    => __( 'Sort Order', 'redux-framework-demo' ),
                'required' => array( 'opt-display-single-post-related', '=', '1' ),
                'options'  => array(
                    'recent_posts' => 'Recent Posts',
                    'random_posts' => 'Random Posts',
                    'last_modified_posts' => 'Last Modified Posts',
                    'most_commented_posts' => 'Most Commented Posts',
                    'most_viewed_posts' => 'Most Viewed Posts'
                ),
                'default'  => 'recent_posts'
            ),
            array(
                'id'       => 'opt-display-single-related-post-title-length',
                'type'     => 'text',
                'required' => array( 'opt-display-single-post-related', '=', '1' ),
                'title'    => __( 'Related Post Title Length', 'redux-framework-demo' ),
                'validate' => 'numeric',
                'default'  => '15',
            ),
        )
    ) );

    Redux::setSection( $opt_name, array(
        'title'            => __( 'Advance Block Settings', 'redux-framework-demo' ),
        'id'               => 'advance-block-options',
        'desc'             => __( '', 'redux-framework-demo' ),
        'customizer_width' => '400px',
        'icon'             => 'el el-th'
    ) );

    Redux::setSection( $opt_name, array(
        'title'      => __( 'Call To Action', 'redux-framework-demo' ),
        'id'         => 'call-to-action-settings',
        'desc'       => '',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'opt-zipcodes-multitext',
                'type'     => 'text',
                'title'    => __( 'Zip Codes', 'redux-framework-demo' ),
                'desc'     => __( 'separate each item by adding comma(,)', 'redux-framework-demo' ),
            ),
        )
    ) );


    Redux::setSection( $opt_name, array(
        'title'            => __( 'White Label', 'redux-framework-demo' ),
        'id'               => 'white-label-options',
        'desc'             => __( '', 'redux-framework-demo' ),
        'customizer_width' => '400px',
        'icon'             => 'el el-th'
    ) );

    Redux::setSection( $opt_name, array(
        'title'      => __( 'Branding', 'redux-framework-demo' ),
        'id'         => 'branding-options',
        'desc'       => __( ' ', 'redux-framework-demo' ),
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'opt-wp-version',
                'type'     => 'switch',
                'title'    => 'Display WP Version',
                'subtitle' => '',
                'default'  => false
            ),
        )
    ) );

    Redux::setSection( $opt_name, array(
        'title'      => __( 'Login', 'redux-framework-demo' ),
        'id'         => 'login-options',
        'desc'       => __( ' ', 'redux-framework-demo' ),
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'opt-login-logo',
                'type'     => 'media',
                'url'      => true,
                'title'    => __( 'Login Logo', 'redux-framework-demo' ),
                'compiler' => 'true',
                'default'  => array( 'url' => '' ),
            ),
            array(
                'id'       => 'opt-login-background',
                'type'     => 'background',
                'output'   => array( 'body' ),
                'title'    => __( 'Body Background', 'redux-framework-demo' ),
                'subtitle' => __( 'Body background with image, color, etc.', 'redux-framework-demo' ),
                //'default'   => '#FFFFFF',
            ),
        )
    ) );

    Redux::setSection( $opt_name, array(
        'title'      => __( 'Admin Bar', 'redux-framework-demo' ),
        'id'         => 'admin-bar-options',
        'desc'       => __( ' ', 'redux-framework-demo' ),
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'opt-hide-admin-bar',
                'type'     => 'switch',
                'title'    => 'Hide Admin Bar',
                'subtitle' => '',
                'default'  => false
            ),
        )
    ) );

    Redux::setSection( $opt_name, array(
        'title' => __( 'Color Selection', 'redux-framework-demo' ),
        'id'    => 'color',
        'desc'  => __( '', 'redux-framework-demo' ),
        'icon'  => 'el el-brush'
    ) );

    

    Redux::setSection( $opt_name, array(
        'title'      => __( 'Global Color', 'redux-framework-demo' ),
        'id'         => 'global-color',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'opt-color-scheme',
                'type'     => 'select',
                'title'    => __( 'Color Scheme', 'redux-framework-demo' ),
                'subtitle' => __( '', 'redux-framework-demo' ),
                'desc'     => __( '', 'redux-framework-demo' ),
                //Must provide key => value pairs for select options
                'options'  => array(
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                    '5' => 'Candy',
                    '6' => 'Crimson',
                    '7' => 'Oasis',
                    '8' => 'Vibrant',
                    '9' => '9',
                    '10' => '10',
                    '11' => '11',
                    '12' => '12',
                    '13' => '13',
                    '14' => '14',
                    '15' => '15',
                ),
                'default'  => '1'
            ),
            array(
                'id'       => 'opt-site-color',
                'type'     => 'select',
                'title'    => __( 'Site Color', 'redux-framework-demo' ),
                'options'  => array(
                    'custom' => 'Custom',
                    'light' => 'Light',
                    'dark' => 'Dark',
                ),
                'default'  => 'custom'
            ),
            array(
                'id'       => 'opt-primary-background-color',
                'type'     => 'color',
                'output'   => array( '.bg-primary-color' ),
                'title'    => __( 'Primary Background Color', 'redux-framework-demo' ),
                'default'  => '#000000',
                'mode'     => 'background',
            ),
            array(
                'id'       => 'opt-secondary-background-color',
                'type'     => 'color',
                'output'   => array( '.bg-secondary-color ,ul.timeline:before,ul.timeline>li .timeline__date' ),
                'title'    => __( 'Secondary Background Color', 'redux-framework-demo' ),
                'default'  => '#666666',
                'validate' => 'color',
                'mode'     => 'background',
            ),
            // array(
            //     'id'       => 'opt-primary-text-color',
            //     'type'     => 'color',
            //     'output'   => array( '.text-primary-color,h1,h2,h3,h4,h5,h6,.scroll .site-title a' ),
            //     'title'    => __( 'Primary Text Color', 'redux-framework-demo' ),
            //     'default'  => '#e36d60',
            // ),
            array(
                'id'       => 'opt-secondary-text-color',
                'type'     => 'color',
                'output'   => array( '.text-secondary-color' ),
                'title'    => __( 'Secondary Text Color', 'redux-framework-demo' ),
                'default'  => '#41848f',
                'validate' => 'color',
            ),
            array(
                'id'       => 'opt-dark-color',
                'type'     => 'color',
                'output'   => array( '.dark-site-color' ),
                'title'    => __( 'Dark Background Color', 'redux-framework-demo' ),
                'default'  => '#000000',
                'mode'     => 'background',
            ),

            array(
                'id'       => 'opt-dark-text-color',
                'type'     => 'color',
                'output'   => array( '.dark-site-color p,.dark-site-color ul' ),
                'title'    => __( 'Dark Background Text Color', 'redux-framework-demo' ),
                'default'  => '#fff'
            ),

            array(
                'id'       => 'opt-light-color',
                'type'     => 'color',
                'output'   => array( '.light-site-color' ),
                'title'    => __( 'Light Background Color', 'redux-framework-demo' ),
                'default'  => '#eee',
                'mode'     => 'background',
            ),

            array(
                'id'       => 'opt-light-text-color',
                'type'     => 'color',
                'output'   => array( '.light-site-text-color' ),
                'title'    => __( 'Light Background Text Color', 'redux-framework-demo' ),
                'default'  => '#000',
                'mode'     => 'background',
            ),

            array(
                'id'       => 'opt-custom-color',
                'type'     => 'color',
                'output'   => array( '.custom-site-color' ),
                'title'    => __( 'Custom Background Color', 'redux-framework-demo' ),
                'default'  => '#666',
                'mode'     => 'background',
            ),

            array(
                'id'       => 'opt-custom-text-color',
                'type'     => 'color',
                'output'   => array( '.custom-site-text-color' ),
                'title'    => __( 'Custom Background Text Color', 'redux-framework-demo' ),
                'default'  => '#333',
                'mode'     => 'background',
            ),

            array(
                'id'       => 'opt-link-color',
                'type'     => 'link_color',
                'output'   => array( 'a' ),
                'title'    => __( 'Link Color', 'redux-framework-demo' ),
                'default'  => array(
                    'regular' => '#aaa',
                    'hover'   => '#bbb',
                    'active'  => '#ccc',
                )
            ),
            array(
                'id'       => 'opt-enable-body-background-opt',
                'type'     => 'switch',
                'title'    => 'Enable Body Background Options',
                'subtitle' => '',
                'default'  => true
            ),
            array(
                'id'       => 'opt-body-background',
                'type'     => 'background',
                'background-color' => false,
                'required' => array( 'opt-enable-body-background-opt', '=', '1' ),
                'output'   => array( 'body, body.dark-site-color' ),
                'title'    => __( 'Body Background', 'redux-framework-demo' ),
                'subtitle' => __( 'Body background with image, color, etc.', 'redux-framework-demo' ),
                //'default'   => '#FFFFFF',
            ),  
        ),
    ) );
    
    Redux::setSection( $opt_name, array(
        'title'      => __( 'Header Color', 'redux-framework-demo' ),
        'id'         => 'header-color',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'opt-top-bar-color',
                'type'     => 'link_color',
                'output'   => array( '.header-top a,.header-top ul.social-share a' ),
                'title'    => __( 'Top Bar Text Color', 'redux-framework-demo' ),
                'default'  => array(
                    'regular' => '#aaa',
                    'hover'   => '#bbb',
                    'active'  => '#ccc',
                )
            ),
            array(
                'id'       => 'opt-menu-color',
                'type'     => 'link_color',
                'output'   => array( '#primary-menu>li>a' ),
                'title'    => __( 'Menu Color', 'redux-framework-demo' ),
                'default'  => array(
                    'regular' => '#aaa',
                    'hover'   => '#bbb',
                    'active'  => '#ccc',
                )
            ),
            array(
                'id'       => 'opt-sub-menu-color',
                'type'     => 'link_color',
                'output'   => array( '#primary-menu ul>li>a' ),
                'title'    => __( 'Sub Menu Color', 'redux-framework-demo' ),
                'default'  => array(
                    'regular' => '#aaa',
                    'hover'   => '#bbb',
                    'active'  => '#ccc',
                )
            ),
        ),
    ) );

    Redux::setSection( $opt_name, array(
        'title'      => __( 'Banner Color', 'redux-framework-demo' ),
        'id'         => 'banner-color',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'opt-enable-banner-colors',
                'type'     => 'switch',
                'title'    => 'Enable Banner Color',
                'subtitle' => '',
                'default'  => true
            ),
            array(
                'id'            => 'opt-color-banner-direction',
                'type'          => 'slider',
                'title'         => __( 'Banner Direction (deg)', 'redux-framework-demo' ),
                'default'       => 90,
                'min'           => 0,
                'step'          => 1,
                'max'           => 360,
                'display_value' => 'deg'
            ),
            array(
                'id'       => 'opt-color-banner',
                'type'     => 'color_gradient',
                'title'    => __( 'Banner Background Color', 'redux-framework-demo' ),
                'default'  => array(
                    'from' => '#090979',
                    'to'   => '#00d4ff'
                ),
            ),
        ),
    ) );

    Redux::setSection( $opt_name, array(
        'title'      => __( 'Footer Color', 'redux-framework-demo' ),
        'id'         => 'footer-color',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'opt-footer-color',
                'type'     => 'link_color',
                'output'   => array( '.menu a' ),
                'title'    => __( 'Menu Color', 'redux-framework-demo' ),
                'default'  => array(
                    'regular' => '#aaa',
                    'hover'   => '#bbb',
                    'active'  => '#ccc',
                )
            )
        ),
    ) );

    /*
     * <--- END SECTIONS
     */
