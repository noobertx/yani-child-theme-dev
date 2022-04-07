<?php
global $opt_name,$theme_text_domain;
Redux::set_section( $opt_name, array(
    'title'            => esc_html__( 'Headers', $theme_text_domain ),
    'id'               => 'headers',
    'desc'             => '',
    'customizer_width' => '400px',
    'icon'             => 'el-icon-website el-icon-small',
) );
Redux::set_section( $opt_name, array(
    'title'            => esc_html__( 'Style', $theme_text_domain ),
    'id'               => 'header-styles',
    'subsection'       => true,
    'desc'             => '',
    'fields'           => array(
        /*array(
            'id'       => 'header_style',
            'type'     => 'image_select',
            'title'    => esc_html__( 'Header Style', $theme_text_domain ),
            'subtitle' => '',
            'default'  => '1',// 1 = on | 0 = off
            'options'  => array(
                '1' => array(
                    'alt' => '',
                    'img' => YANI_THEME_IMAGES . 'header/header-style-1.jpg'
                ),
                '2' => array(
                    'alt' => '',
                    'img' => YANI_THEME_IMAGES . 'header/header-style-2.jpg'
                ),
                '3' => array(
                    'alt' => '',
                    'img' => YANI_THEME_IMAGES . 'header/header-style-3.jpg'
                ),
                '4' => array(
                    'alt' => '',
                    'img' => YANI_THEME_IMAGES . 'header/header-style-4.jpg'
                ),
                '5' => array(
                    'alt' => '',
                    'img' => YANI_THEME_IMAGES . 'header/header-style-5.jpg'
                ),
                '6' => array(
                    'alt' => '',
                    'img' => YANI_THEME_IMAGES . 'header/header-style-6.jpg'
                ),
                
            ),
            'desc'     => '',
        ), */
        array(
            'id'       => 'header_style',
            'type'     => 'select',
            'title'    => esc_html__( 'Header Style', $theme_text_domain ),
            'subtitle' => '',
            'default'  => 'classic',// 1 = on | 0 = off
            'options'  => array(
                'classic' => __( 'Classic', $theme_text_domain ),
                'modern' => __( 'Modern', $theme_text_domain ),
                'plain' => __( 'Plain', $theme_text_domain ),
                'stack,left' => __( 'Stack | Left', $theme_text_domain ),
                'stack,center' => __( 'Stack | Center', $theme_text_domain ),
                'stack,right' => __( 'Stack | Right', $theme_text_domain ),
                'stack,magazine' => __( 'Magazine', $theme_text_domain ),
                'creative' => __( 'Creative', $theme_text_domain ),
                'creative,rtl' => __( 'Creative | Right', $theme_text_domain ),
                'creative,open' => __( 'Creative | Open', $theme_text_domain ),
                'creative,open,rtl' => __( 'Creative | Right + Open', $theme_text_domain ),
                'fixed' => __( 'Fixed', $theme_text_domain ),
                'transparent' => __( 'Transparent', $theme_text_domain ),
                'simple' => __( 'Simple', $theme_text_domain ),
                'simple,empty' => __( 'Empty', $theme_text_domain ),
                'below' => __( 'Below slider', $theme_text_domain ),
                'split' => __( 'Split menu', $theme_text_domain ),
                'split,semi' => __( 'Split menu | Semitransparent', $theme_text_domain ),
                'below,split' => __( 'Below slider + Split menu', $theme_text_domain ),
                'overlay,transparent' => __( 'Overlay | 1 level menu', $theme_text_domain ),
                'shop' => __( 'Shop', $theme_text_domain ),
            ),
            'desc'     => '',
        ),
        array(
            'id'       => 'header_1_width',
            'type'     => 'select',
            'title'    => esc_html__( 'Header Layout', $theme_text_domain ),
            'subtitle' => '',
            // 'required' => array('header_style', '=', '1'),
            'options'   => array(
                'container' => esc_html__( 'Boxed', $theme_text_domain ),
                'container-fluid'   => esc_html__( 'Full Width', $theme_text_domain )
            ),
            'desc'     => esc_html__( 'Select the header layout', $theme_text_domain ),
            'default'  => 'container'// 1 = on | 0 = off
        ),
        array(
            'id'       => 'header_1_menu_align',
            'type'     => 'select',
            'title'    => esc_html__( 'Navigation Align', $theme_text_domain ),
            'subtitle' => '',
            // 'required' => array('header_style', '=', '1' ),
            'options'   => array(
                'nav-left'  => esc_html__( 'Left Align', $theme_text_domain ),
                'nav-right' => esc_html__( 'Right Align', $theme_text_domain )
            ),
            'desc'     => esc_html__( 'Select the navigation align', $theme_text_domain ),
            'default'  => 'nav-right'// 1 = on | 0 = off
        ),

        array(
            'id'       => 'header_1_height',
            'type'     => 'text',
            // 'required' => array('header_style', '=', '1'),
            'title'    => esc_html__( 'Header Height', $theme_text_domain ),
            'subtitle' => '',
            'default'    => '60',
            'validate' => 'numeric',
        ),
        array(
            'id'       => 'header_2_height',
            'type'     => 'text',
            'required' => array('header_style', '=', '2'),
            'title'    => esc_html__( 'Header Height', $theme_text_domain ),
            'subtitle' => '',
            'default'    => '54',
            'validate' => 'numeric',
        ),
        array(
            'id'       => 'header_3_top_height',
            'type'     => 'text',
            'required' => array('header_style', '=', '3'),
            'title'    => esc_html__( 'Header Top Height', $theme_text_domain ),
            'subtitle' => '',
            'default'    => '80',
            'validate' => 'numeric',
        ),

        array(
            'id'       => 'header_3_bottom_height',
            'type'     => 'text',
            'required' => array('header_style', '=', '3'),
            'title'    => esc_html__( 'Header Bottom Height', $theme_text_domain ),
            'subtitle' => '',
            'default'    => '54',
            'validate' => 'numeric',
        ),

        array(
            'id'       => 'header_4_height',
            'type'     => 'text',
            'required' => array('header_style', '=', '4'),
            'title'    => esc_html__( 'Header Height', $theme_text_domain ),
            'subtitle' => '',
            'default'    => '90',
            'validate' => 'numeric',
        ),

        array(
            'id'       => 'header_5_top_height',
            'type'     => 'text',
            'required' => array('header_style', '=', '5'),
            'title'    => esc_html__( 'Header Top Height', $theme_text_domain ),
            'subtitle' => '',
            'default'    => '110',
            'validate' => 'numeric',
        ),

        array(
            'id'       => 'header_5_bottom_height',
            'type'     => 'text',
            'required' => array('header_style', '=', '5'),
            'title'    => esc_html__( 'Header Bottom Height', $theme_text_domain ),
            'subtitle' => '',
            'default'    => '54',
            'validate' => 'numeric',
        ),

        array(
            'id'       => 'header_6_height',
            'type'     => 'text',
            'required' => array('header_style', '=', '6'),
            'title'    => esc_html__( 'Header Height', $theme_text_domain ),
            'subtitle' => '',
            'default'    => '60',
            'validate' => 'numeric',
        ),

        array(
            'id'       => 'main-menu-sticky',
            'type'     => 'switch',
            'title'    => esc_html__( 'Sticky Menu - Desktop Devices', $theme_text_domain ),
            'desc' => esc_html__( 'Enable or disable the sticky menu on desktop devices', $theme_text_domain ),
            'default'  => 0,
            'on'       => esc_html__( 'Enabled', $theme_text_domain ),
            'off'      => esc_html__( 'Disabled', $theme_text_domain ),
        ),
        array(
            'id'       => 'header_4_width',
            'type'     => 'select',
            'title'    => esc_html__( 'Layout', $theme_text_domain ),
            'subtitle' => '',
            'required' => array('header_style', '=', '4'),
            'options'   => array(
                'container' => esc_html__( 'Boxed', $theme_text_domain ),
                'container-fluid'   => esc_html__( 'Full Width', $theme_text_domain )
            ),
            'desc' => esc_html__( 'Select the header layout', $theme_text_domain ),
            'default'  => 'container'// 1 = on | 0 = off
        ),
        array(
            'id'       => 'header_4_menu_align',
            'type'     => 'select',
            'title'    => esc_html__( 'Navigation Align', $theme_text_domain ),
            'desc' => esc_html__( 'Select the navigation align', $theme_text_domain ),
            'required' => array('header_style', '=', '4' ),
            'options'   => array(
                'nav-left'  => esc_html__( 'Left Align', $theme_text_domain ),
                'nav-right' => esc_html__( 'Right Align', $theme_text_domain )
            ),
            'default'  => 'nav-left'// 1 = on | 0 = off
        ),

        array(
            'id'       => 'hd1_4_phone_enable',
            'type'     => 'switch',
            'title'    => esc_html__( 'Enable or disable phone numder for header 1 & 4', $theme_text_domain ),
            // 'required' => array( 
            //     array('header_style', '!=', '2'),
            //     array('header_style', '!=', '3'),
            //     array('header_style', '!=', '5'),
            //     array('header_style', '!=', '6')
            // ),
            'desc'     => '',
            'subtitle' => '',
            'default'  => 0,
            'on'       => esc_html__( 'Enabled', $theme_text_domain ),
            'off'      => esc_html__( 'Disabled', $theme_text_domain ),
        ),

        array(
            'id'       => 'hd1_4_phone',
            'type'     => 'text',
            'required' => array('hd1_4_phone_enable', '=', '1'),
            'title'    => esc_html__( 'Phone Number', $theme_text_domain ),
            'default'    => '+1 (800) 987 6543',
            'subtitle' => '',
        ),

        array(
            'id'       => 'hd3_callus_section-start',
            'type'     => 'section',
            'required' => array('header_style', '=', '3'),
            'title'    => esc_html__( 'Call Us', $theme_text_domain ),
            'subtitle' => esc_html__( 'Call us number in header', $theme_text_domain ),
            'indent'   => true, // Indent all options below until the next 'section' option is set.
        ),
        array(
            'id'       => 'hd3_callus',
            'type'     => 'switch',
            'title'    => esc_html__( 'Enable or disable the call us box in the header', $theme_text_domain ),
            'desc'     => '',
            'subtitle' => '',
            'default'  => 1,
            'on'       => esc_html__( 'Enabled', $theme_text_domain ),
            'off'      => esc_html__( 'Disabled', $theme_text_domain ),
        ),
        array(
            'id'       => 'hd3_call_us_image',
            'type'     => 'media',
            'required' => array('hd3_callus', '=', '1'),
            'url'      => true,
            'title'    => esc_html__( 'Upload image', $theme_text_domain ),
            'subtitle' => esc_html__('Recommended size 85 x 85', $theme_text_domain),
            'default'   => array(
                'url'   => get_template_directory_uri() . '/img/call-image.png'
            ),
        ),
        array(
            'id'       => 'hd3_call_us_text',
            'type'     => 'text',
            'title'    => esc_html__( 'Text', $theme_text_domain ),
            'required' => array('hd3_callus', '=', '1'),
            'default'    => 'Call Us:',
            'subtitle' => '',
        ),
        array(
            'id'       => 'hd3_phone',
            'type'     => 'text',
            'required' => array('hd3_callus', '=', '1'),
            'title'    => esc_html__( 'Phone Number', $theme_text_domain ),
            'default'    => '1-800-987-6543',
            'subtitle' => '',
        ),
        array(
            'id'     => 'hd3_callus_section_end',
            'type'   => 'section',
            'indent' => false, // Indent all options below until the next 'section' option is set.
        ),

        /*
         *  Header 2 Contact Info
         * -----------------------------------------------------------------------*/
        array(
            'id'       => 'hd2_contact-start',
            'type'     => 'section',
            'required' => array('header_style', '=', '2'),
            'title'    => esc_html__( 'Contact Information', $theme_text_domain ),
            'subtitle' => '',
            'indent'   => true,
        ),
        array(
            'id'       => 'hd2_contact_info',
            'type'     => 'switch',
            'title'    => esc_html__( 'Contact Information', $theme_text_domain ),
            'desc'     => esc_html__( 'Enable or disable the contact information', $theme_text_domain ),
            'subtitle' => '',
            'default'  => 1,
            'on'       => esc_html__( 'Enabled', $theme_text_domain ),
            'off'      => esc_html__( 'Disabled', $theme_text_domain ),
        ),
        array(
            'id'       => 'hd2_contact_phone',
            'type'     => 'text',
            'required' => array('hd2_contact_info', '=', '1'),
            'title'    => esc_html__( 'Phone Number', $theme_text_domain ),
            'subtitle' => '',
            'default'   => '1 800 987 6543',
            'desc'     => esc_html__( 'Enter the phone number', $theme_text_domain ),
        ),
        array(
            'id'       => 'hd2_contact_email',
            'type'     => 'text',
            'required' => array('hd2_contact_info', '=', '1'),
            'title'    => esc_html__( 'Email Address', $theme_text_domain ),
            'subtitle' => '',
            'default'   => 'info@yani.com',
            'desc'     => esc_html__( 'Enter the email address', $theme_text_domain ),
        ),
        array(
            'id'     => 'hd2_contact_section_end',
            'type'   => 'section',
            'indent' => false,
        ),

        /*
         *  Header 2 Address
         * -----------------------------------------------------------------------*/
        array(
            'id'       => 'hd2_address-start',
            'type'     => 'section',
            'required' => array('header_style', '=', '2'),
            'title'    => esc_html__( 'Address', $theme_text_domain ),
            'subtitle' => '',
            'indent'   => true,
        ),
        array(
            'id'       => 'hd2_address_info',
            'type'     => 'switch',
            'title'    => esc_html__( 'Address', $theme_text_domain ),
            'desc'     => esc_html__( 'Enable or disable the address', $theme_text_domain ),
            'subtitle' => '',
            'default'  => 1,
            'on'       => esc_html__( 'Enabled', $theme_text_domain ),
            'off'      => esc_html__( 'Disabled', $theme_text_domain ),
        ),
        array(
            'id'       => 'hd2_address_line1',
            'type'     => 'text',
            'required' => array('hd2_address_info', '=', '1'),
            'title'    => esc_html__( 'Line 1', $theme_text_domain ),
            'subtitle' => '',
            'default'   => 'Oceanview Hall',
            'desc'     => esc_html__( 'Enter the address line 1', $theme_text_domain ),
        ),
        array(
            'id'       => 'hd2_address_line2',
            'type'     => 'text',
            'required' => array('hd2_address_info', '=', '1'),
            'title'    => esc_html__( 'Line 2', $theme_text_domain ),
            'subtitle' => '',
            'default'   => 'Miami, FL 33141',
            'desc'     => esc_html__( 'Enter the address line 2', $theme_text_domain ),
        ),
        array(
            'id'     => 'hd2_address_section_end',
            'type'   => 'section',
            'indent' => false,
        ),


        /*
         *  Header 2 Timing
         * -----------------------------------------------------------------------*/
        array(
            'id'       => 'hd2_timing-start',
            'type'     => 'section',
            'required' => array('header_style', '=', '2'),
            'title'    => esc_html__( 'Office Timing', $theme_text_domain ),
            'subtitle' => '',
            'indent'   => true,
        ),
        array(
            'id'       => 'hd2_timing_info',
            'type'     => 'switch',
            'title'    => esc_html__( 'Office Timing', $theme_text_domain ),
            'desc'     => '',
            'subtitle' => '',
            'default'  => 1,
            'on'       => esc_html__( 'Enabled', $theme_text_domain ),
            'off'      => esc_html__( 'Disabled', $theme_text_domain ),
            'desc'     => esc_html__( 'Enable or disable the office time', $theme_text_domain ),
        ),
        array(
            'id'       => 'hd2_timing_hours',
            'type'     => 'text',
            'required' => array('hd2_timing_info', '=', '1'),
            'title'    => esc_html__( 'Opening Hours', $theme_text_domain ),
            'subtitle' => '',
            'default'   => '9 am to 6 pm',
            'desc'     => esc_html__( 'Enter the opening hours', $theme_text_domain ),

        ),
        array(
            'id'       => 'hd2_timing_days',
            'type'     => 'text',
            'required' => array('hd2_timing_info', '=', '1'),
            'title'    => esc_html__( 'Opening Days', $theme_text_domain ),
            'subtitle' => '',
            'default'   => 'Monday to Friday',
            'desc'     => esc_html__( 'Enter the opening days', $theme_text_domain ),
        ),
        array(
            'id'     => 'hd2_timing_section_end',
            'type'   => 'section',
            'indent' => false,
        )
    )
) );

Redux::setSection( $opt_name, array(
    'title'            => esc_html__( 'Social Media', $theme_text_domain ),
    'id'               => 'header-social',
    'subsection'       => true,
    'desc'             => '',
    'fields'           => array(
        array(
            'id'       => 'social-header',
            'type'     => 'switch',
            'title'    => esc_html__( 'Social Media Icons', $theme_text_domain ),
            'subtitle' => esc_html__('Only for header style 2, 3 and the top bar', $theme_text_domain),
            'desc'     => esc_html__( 'Enable or disable the social media in the header', $theme_text_domain ),
            'default'  => 0,
            'on'       => esc_html__( 'Enabled', $theme_text_domain ),
            'off'      => esc_html__( 'Disabled', $theme_text_domain ),
        ),
        array(
            'id'       => 'hs-facebook',
            'type'     => 'text',
            'required' => array( 'social-header', '=', '1' ),
            'title'    => esc_html__( 'Facebook', $theme_text_domain ),
            'desc' => esc_html__( 'Enter the Facebook profile URL', $theme_text_domain ),
            'default'  => false,
        ),
        array(
            'id'       => 'hs-twitter',
            'type'     => 'text',
            'required' => array( 'social-header', '=', '1' ),
            'title'    => esc_html__( 'Twitter', $theme_text_domain ),
            'desc' => esc_html__( 'Enter the Twitter profile URL', $theme_text_domain ),
            'default'  => false,
        ),
        array(
            'id'       => 'hs-googleplus',
            'type'     => 'text',
            'required' => array( 'social-header', '=', '1' ),
            'title'    => esc_html__( 'Google Plus', $theme_text_domain ),
            'desc' => esc_html__( 'Enter Google Plus profile URL', $theme_text_domain ),
            'default'  => false,
        ),
        array(
            'id'       => 'hs-linkedin',
            'type'     => 'text',
            'required' => array( 'social-header', '=', '1' ),
            'title'    => esc_html__( 'Linked In', $theme_text_domain ),
            'desc' => esc_html__( 'Enter the Linkedin profile URL', $theme_text_domain ),
            'default'  => false,
        ),
        array(
            'id'       => 'hs-instagram',
            'type'     => 'text',
            'required' => array( 'social-header', '=', '1' ),
            'title'    => esc_html__( 'Instagram', $theme_text_domain ),
            'desc' => esc_html__( 'Enter the Instagram profile URL', $theme_text_domain ),
            'default'  => false,
        ),
        array(
            'id'       => 'hs-pinterest',
            'type'     => 'text',
            'required' => array( 'social-header', '=', '1' ),
            'title'    => esc_html__( 'Pinterest', $theme_text_domain ),
            'desc' => esc_html__( 'Enter the Pinterest profile URL', $theme_text_domain ),
            'default'  => false,
        ),
        array(
            'id'       => 'hs-youtube',
            'type'     => 'text',
            'required' => array( 'social-header', '=', '1' ),
            'title'    => esc_html__( 'Youtube', $theme_text_domain ),
            'desc' => esc_html__( 'Enter the Youtube profile URL', $theme_text_domain ),
            'default'  => false,
        ),
        array(
            'id'       => 'hs-yelp',
            'type'     => 'text',
            'required' => array( 'social-header', '=', '1' ),
            'title'    => esc_html__( 'Yelp', $theme_text_domain ),
            'desc' => esc_html__( 'Enter the Yelp profile URL', $theme_text_domain ),
            'default'  => false,
        ),
        array(
            'id'       => 'hs-behance',
            'type'     => 'text',
            'required' => array( 'social-header', '=', '1' ),
            'title'    => esc_html__( 'Behance', $theme_text_domain ),
            'desc' => esc_html__( 'Enter the Behance profile URL', $theme_text_domain ),
            'default'  => false,
        )
    )
) );

Redux::setSection( $opt_name, array(
    'title'            => esc_html__( 'Create Listing Button', $theme_text_domain ),
    'id'               => 'header-create-listings',
    'subsection'       => true,
    'desc'             => '',
    'fields'           => array(
        array(
            'id'       => 'create_lisiting_enable',
            'type'     => 'switch',
            'title'    => esc_html__( 'Create Listing Button', $theme_text_domain ),
            'desc' => esc_html__('Enable or disable the Create Listing button on the header', $theme_text_domain),
            'default'  => 1,
            'on'       => esc_html__( 'Enabled', $theme_text_domain ),
            'off'      => esc_html__( 'Disabled', $theme_text_domain ),
        ),
        array(
            'id'       => 'create_listing_button',
            'type'     => 'select',
            'title'    => esc_html__( 'Button Behavior', $theme_text_domain ),
            'desc' => esc_html__('Is the login required to create a new listing?', $theme_text_domain),
            'default'  => 'no',
            'options'  => array(
                'no' => esc_html__('No', $theme_text_domain),
                'yes' => esc_html__('Yes', $theme_text_domain),
            )
        )
    )
) );
?>