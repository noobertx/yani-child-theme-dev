<?php
global $opt_name,$theme_text_domain, $allowed_html_array;
Redux::setSection( $opt_name, array(
    'title'  => esc_html__( 'Splash Page', $theme_text_domain ),
    'id'     => 'splash-page',
    'desc'   => '',
    'icon'   => 'el-icon-website el-icon-small',
    'fields'        => array(
        array(
            'id'       => 'splash_layout',
            'type'     => 'select',
            'title'    => esc_html__( 'Header Layout', $theme_text_domain ),
            'subtitle' => '',
            'options'   => array(
                'container-fluid' => 'Full Width',
                'container' => 'Boxed'
            ),
            'desc'     => esc_html__( 'Select the spash page header Layout', $theme_text_domain ),
            'default'  => 'container-fluid'
        ),
        array(
            'id'       => 'backgroud_type',
            'type'     => 'select',
            'title'    => esc_html__( 'Page Background Type', $theme_text_domain ),
            'subtitle' => '',
            'options'   => array(
                'image' => 'Background Image',
                'slider' => 'Background Slider',
                'video' => 'Background Video'
            ),
            'desc'     => esc_html__( 'Select the page background type', $theme_text_domain ),
            'default'  => 'image'
        ),

        array(
            'id'       => 'splash_page_nav',
            'type'     => 'switch',
            'title'    => esc_html__( 'Navigation', $theme_text_domain ),
            'desc' => esc_html__( 'Enable or disable the splash page navigation', $theme_text_domain ),
            'default'  => 1,
            'on'       => esc_html__( 'Enabled', $theme_text_domain ),
            'off'      => esc_html__( 'Disabled', $theme_text_domain ),
        ),

        array(
            'id'       => 'splash_menu_align',
            'type'     => 'select',
            'title'    => esc_html__( 'Navigation Align', $theme_text_domain ),
            'desc' => esc_html__( 'Select the navigation align', $theme_text_domain ),
            'options'   => array(
                'nav-left'  => esc_html__( 'Left Align', $theme_text_domain ),
                'nav-right' => esc_html__( 'Right Align', $theme_text_domain )
            ),
            'default'  => 'nav-right'// 1 = on | 0 = off
        ),

        array(
            'id'       => 'splash_search',
            'type'     => 'switch',
            'title'    => esc_html__( 'Search', $theme_text_domain ),
            'desc' => esc_html__( 'Enable or disable the search on the splash page', $theme_text_domain ),
            'default'  => 1,
            'on'       => esc_html__( 'Enabled', $theme_text_domain ),
            'off'      => esc_html__( 'Disabled', $theme_text_domain ),
        ),

        // Section background image
        array(
            'id'       => 'splash_image_section-start',
            'type'     => 'section',
            'required' => array('backgroud_type', '=', 'image'),
            'title'    => esc_html__( 'Background Image Options', $theme_text_domain ),
            'subtitle' => '',
            'indent'   => true,
        ),
        array(
            'id'        => 'splash_image',
            'url'       => true,
            'type'      => 'media',
            'title'     => esc_html__('Upload image', $theme_text_domain),
            'default'   => '',
            'desc'      => esc_html__('Recommended image size 2000px x 1000px.', $theme_text_domain),
            'subtitle'  => '',
        ),

        array(
            'id'     => 'splash_image_section_end',
            'type'   => 'section',
            'indent' => false,
        ),

        // Section background slider
        array(
            'id'       => 'splash_slider_section-start',
            'type'     => 'section',
            'required' => array('backgroud_type', '=', 'slider'),
            'title'    => esc_html__( 'Background Slider Options', $theme_text_domain ),
            'subtitle' => '',
            'indent'   => true,
        ),
        array(
            'id'        => 'splash_slider',
            'url'       => true,
            'type'      => 'gallery',
            'title'     => esc_html__('Add/Edit Images', $theme_text_domain),
            'default'   => '',
            'desc'      => esc_html__('Recommended image size 2000px x 1000px.', $theme_text_domain),
            'subtitle'  => '',
        ),
        array(
            'id'     => 'splash_slider_section_end',
            'type'   => 'section',
            'indent' => false,
        ),

        // Section background video
        array(
            'id'       => 'splash_video_section-start',
            'type'     => 'section',
            'required' => array('backgroud_type', '=', 'video'),
            'title'    => esc_html__( 'Background Video Options', $theme_text_domain ),
            'subtitle' => '',
            'indent'   => true,
        ),
        array(
            'id'        => 'splash_bg_mp4',
            'url'       => true,
            'type'      => 'media',
            'mode'       => false,
            'title'     => esc_html__('MP4', $theme_text_domain),
            'default'   => '',
            'desc'      => esc_html__('Upload the mp4 file', $theme_text_domain),
            'subtitle'  => 'This file is required',
        ),
        array(
            'id'        => 'splash_bg_webm',
            'url'       => true,
            'type'      => 'media',
            'mode'       => false,
            'title'     => esc_html__('WEBM', $theme_text_domain),
            'default'   => '',
            'desc'      => esc_html__('Upload the webm file', $theme_text_domain),
            'subtitle'  => 'This file is required',
        ),
        array(
            'id'        => 'splash_bg_ogv',
            'url'       => true,
            'type'      => 'media',
            'mode'       => false,
            'title'     => esc_html__('OGV', $theme_text_domain),
            'default'   => '',
            'desc'      => esc_html__('Upload the ogv file', $theme_text_domain),
            'subtitle'  => 'This file is required',
        ),
        array(
            'id'        => 'splash_video_image',
            'url'       => true,
            'type'      => 'media',
            'title'     => esc_html__('Video Cover Image', $theme_text_domain),
            'default'   => '',
            'desc'      => esc_html__('Upload the cover image file', $theme_text_domain),
            'subtitle'  => 'This file is required',
        ),
        array(
            'id'     => 'splash_video_section_end',
            'type'   => 'section',
            'indent' => false,
        ),

    ),
));

Redux::setSection( $opt_name, array(
    'title'            => esc_html__( 'Welcome Title', $theme_text_domain ),
    'id'               => 'splash-welcome',
    'subsection'       => true,
    'desc'             => '',
    'fields'           => array(
        array(
            'id'       => 'splash_welcome_text',
            'type'     => 'text',
            'title'    => esc_html__( 'Page Title', $theme_text_domain ),
            'desc' => esc_html__( 'Enter the title', $theme_text_domain ),
            'default'  => 'Welcome, Make Yourself At Home',
        ),
        array(
            'id'       => 'splash_welcome_sub',
            'type'     => 'text',
            'title'    => esc_html__( 'Splash Page Subtitle', $theme_text_domain ),
            'desc' => esc_html__( 'Enter the sub-title', $theme_text_domain ),
            'default'  => '',
        )
    )
) );

Redux::setSection( $opt_name, array(
    'title'            => esc_html__( 'Call Us', $theme_text_domain ),
    'id'               => 'splash-callus',
    'subsection'       => true,
    'desc'             => '',
    'fields'           => array(
        array(
            'id'        => 'splash_callus_text',
            'type'      => 'text',
            'title'     => esc_html__('Text', $theme_text_domain),
            'default'   => 'Call Us',
            'desc'      => esc_html__( 'Enter the text', $theme_text_domain ),
            'subtitle'  => '',
        ),
        array(
            'id'        => 'splash_callus_phone',
            'type'      => 'text',
            'title'     => esc_html__('Phone Number', $theme_text_domain),
            'default'   => '(800) 897 6543',
            'desc'      => esc_html__( 'Enter the phone number', $theme_text_domain ),
            'subtitle'  => '',
        ),
    )
) );

Redux::setSection( $opt_name, array(
    'title'            => esc_html__( 'Social Media', $theme_text_domain ),
    'id'               => 'splash-social',
    'subsection'       => true,
    'desc'             => '',
    'fields'           => array(
        array(
            'id'       => 'social-splash',
            'type'     => 'switch',
            'title'    => esc_html__( 'Social Media Icons', $theme_text_domain ),
            'desc'     => esc_html__( 'Enable or disable the social media icons', $theme_text_domain ),
            'subtitle' => '',
            'default'  => 0,
            'on'       => esc_html__( 'Enabled', $theme_text_domain ),
            'off'      => esc_html__( 'Disabled', $theme_text_domain ),
        ),
        array(
            'id'       => 'sp-facebook',
            'type'     => 'text',
            'required' => array( 'social-splash', '=', '1' ),
            'title'    => esc_html__( 'Facebook', $theme_text_domain ),
            'desc' => esc_html__( 'Enter the Facebook profile URL', $theme_text_domain ),
            'default'  => false,
        ),
        array(
            'id'       => 'sp-twitter',
            'type'     => 'text',
            'required' => array( 'social-splash', '=', '1' ),
            'title'    => esc_html__( 'Twitter', $theme_text_domain ),
            'desc' => esc_html__( 'Enter the Twitter profile URL', $theme_text_domain ),
            'default'  => false,
        ),
        array(
            'id'       => 'sp-googleplus',
            'type'     => 'text',
            'required' => array( 'social-splash', '=', '1' ),
            'title'    => esc_html__( 'Google Plus', $theme_text_domain ),
            'desc' => esc_html__( 'Enter the Google Plus profile URL', $theme_text_domain ),
            'default'  => false,
        ),
        array(
            'id'       => 'sp-linkedin',
            'type'     => 'text',
            'required' => array( 'social-splash', '=', '1' ),
            'title'    => esc_html__( 'Linked In', $theme_text_domain ),
            'desc' => esc_html__( 'Enter the Linkedin profile URL', $theme_text_domain ),
            'default'  => false,
        ),
        array(
            'id'       => 'sp-instagram',
            'type'     => 'text',
            'required' => array( 'social-splash', '=', '1' ),
            'title'    => esc_html__( 'Instagram', $theme_text_domain ),
            'desc' => esc_html__( 'Enter the Instagram profile URL', $theme_text_domain ),
            'default'  => false,
        )
    )
) );

Redux::setSection( $opt_name, array(
    'title'            => esc_html__( 'Logo Link', $theme_text_domain ),
    'id'               => 'splash-logo-link',
    'subsection'       => true,
    'desc'             => '',
    'fields'           => array(
        array(
            'id'       => 'splash-logolink-type',
            'type'     => 'select',
            'title'    => esc_html__( 'Splash Page Logo Link', $theme_text_domain ),
            'desc'     => esc_html__( 'Select a page from the list or custom', $theme_text_domain ),
            'subtitle' => '',
            'options' => array(
                'home_page' => 'Home Page',
                'custom' => 'Custom'
            ),
            'default'  => 'home_page'
        ),

        array(
            'id'       => 'splash-logolink',
            'type'     => 'text',
            'required' => array('splash-logolink-type', '=', 'custom'),
            'title'    => esc_html__( 'Custom Link', $theme_text_domain ),
            'desc'     => esc_html__( 'Enter the URL', $theme_text_domain ),
            'subtitle' => '',
            'default'  => ''
        )
    )
) );