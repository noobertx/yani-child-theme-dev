<?php
global $opt_name,$theme_text_domain;
/* **********************************************************************
 * Footer
 * **********************************************************************/
Redux::setSection( $opt_name, array(
    'title'  => esc_html__( 'Footer', $theme_text_domain ),
    'id'     => 'footer',
    'desc'   => '',
    'icon'             => 'el-icon-website el-icon-small',
    'fields'        => array(
        array(
            'id'       => 'footer_cols',
            'type'     => 'image_select',
            'title'    => esc_html__('Footer Layout', $theme_text_domain),
            'subtitle' => '',
            'desc'     => esc_html__('Select the footer layout', $theme_text_domain),
            'options'  => array(
                'one_col' => array(
                    'alt' => '',
                    'img' => YANI_THEME_IMAGES . '1col.png'
                ),
                'two_col' => array(
                    'alt' => '',
                    'img' => YANI_THEME_IMAGES . '2cl.png'
                ),
                'three_cols_middle' => array(
                    'alt' => '',
                    'img' => YANI_THEME_IMAGES . '3cm.png'
                ),
                'three_cols' => array(
                    'alt' => '',
                    'img' => YANI_THEME_IMAGES . '3cl.png'
                ),
                'four_cols' => array(
                    'alt' => '',
                    'img' => YANI_THEME_IMAGES . '4cl.png'
                ),
                'v6' => array(
                    'alt' => '',
                    'img' => YANI_THEME_IMAGES . '3cr.png'
                ),
            ),
            'default'  => 'three_cols'
        ),

        array(
            'id'       => 'ftb_section-start',
            'type'     => 'section',
            'title'    => esc_html__( 'Footer Bottom', $theme_text_domain ),
            'subtitle' => '',
            'indent'   => true,
        ),

        array(
            'id'       => 'ft-bottom',
            'type'     => 'select',
            'title'    => esc_html__('Version', $theme_text_domain),
            'desc' => esc_html__('Select the bottom version', $theme_text_domain),
            //'desc'     => '',
            'options'  => array(
                'v1'   => esc_html__( 'Version 1', $theme_text_domain ),
                'v2'   => esc_html__( 'Version 2', $theme_text_domain ),
                'v3'   => esc_html__( 'Version 3', $theme_text_domain ),
                'v4'   => esc_html__( 'Version 4', $theme_text_domain )
            ),
            'default'  => 'v1',
        ),

        array(
            'id'        => 'footer_logo',
            'url'       => true,
            'type'      => 'media',
            'title'     => esc_html__( 'Logo', $theme_text_domain ),
            'read-only' => false,
            'default'   => array( 'url' => YANI_THEME_IMAGES .'logo-houzez-white.png' ),
            'desc'  => esc_html__( 'Upload the logo.', $theme_text_domain ),
        ),

        array(
            'id'       => 'copy_rights',
            'type'     => 'text',
            'title'    => esc_html__( 'Copyright', $theme_text_domain ),
            'desc'     => esc_html__( 'Enter the copyright text', $theme_text_domain ),
            'default'  => 'Houzez - All rights reserved'
        ),
        array(
            'id'       => 'social-footer',
            'type'     => 'switch',
            'title'    => esc_html__( 'Footer social media', $theme_text_domain ),
            'desc'     => esc_html__( 'Enable or disable social media links', $theme_text_domain ),
            'subtitle' => '',
            'default'  => 0,
            'on'       => 'Enabled',
            'off'      => 'Disabled',
        ),
        array(
            'id'       => 'fs-facebook',
            'type'     => 'text',
            'required' => array( 'social-footer', '=', '1' ),
            'title'    => esc_html__( 'Facebook', $theme_text_domain ),
            'desc' => esc_html__( 'Enter Facebook profile url', $theme_text_domain ),
            //'desc'     => '',
            'default'  => false,
        ),
        array(
            'id'       => 'fs-twitter',
            'type'     => 'text',
            'required' => array( 'social-footer', '=', '1' ),
            'title'    => esc_html__( 'Twitter', $theme_text_domain ),
            'desc' => esc_html__( 'Enter Twitter profile url', $theme_text_domain ),
            //'desc'     => '',
            'default'  => false,
        ),
        array(
            'id'       => 'fs-googleplus',
            'type'     => 'text',
            'required' => array( 'social-footer', '=', '1' ),
            'title'    => esc_html__( 'Google Plus', $theme_text_domain ),
            'desc' => esc_html__( 'Enter Google Plus profile url', $theme_text_domain ),
            //'desc'     => '',
            'default'  => false,
        ),
        array(
            'id'       => 'fs-linkedin',
            'type'     => 'text',
            'required' => array( 'social-footer', '=', '1' ),
            'title'    => esc_html__( 'Linkedin', $theme_text_domain ),
            'desc' => esc_html__( 'Enter Linkedin profile url', $theme_text_domain ),
            //'desc'     => '',
            'default'  => false,
        ),
        array(
            'id'       => 'fs-instagram',
            'type'     => 'text',
            'required' => array( 'social-footer', '=', '1' ),
            'title'    => esc_html__( 'Instagram', $theme_text_domain ),
            'desc' => esc_html__( 'Enter Instagram profile url', $theme_text_domain ),
            //'desc'     => '',
            'default'  => false,
        ),
        array(
            'id'       => 'fs-pinterest',
            'type'     => 'text',
            'required' => array( 'social-footer', '=', '1' ),
            'title'    => esc_html__( 'Pinterest', $theme_text_domain ),
            'desc' => esc_html__( 'Enter Pinterest profile url', $theme_text_domain ),
            //'desc'     => '',
            'default'  => false,
        ),
        array(
            'id'       => 'fs-yelp',
            'type'     => 'text',
            'required' => array( 'social-footer', '=', '1' ),
            'title'    => esc_html__( 'Yelp', $theme_text_domain ),
            'desc' => esc_html__( 'Enter Yelp profile url', $theme_text_domain ),
            //'desc'     => '',
            'default'  => false,
        ),
        array(
            'id'       => 'fs-behance',
            'type'     => 'text',
            'required' => array( 'social-footer', '=', '1' ),
            'title'    => esc_html__( 'Behance', $theme_text_domain ),
            'desc' => esc_html__( 'Enter Behance profile url', $theme_text_domain ),
            //'desc'     => '',
            'default'  => false,
        ),
        array(
            'id'       => 'fs-youtube',
            'type'     => 'text',
            'required' => array( 'social-footer', '=', '1' ),
            'title'    => esc_html__( 'Youtube', $theme_text_domain ),
            'desc' => esc_html__( 'Enter Youtube profile url', $theme_text_domain ),
            //'desc'     => '',
            'default'  => false,
        ),

        array(
            'id'     => 'ftb_section_end',
            'type'   => 'section',
            'indent' => false,
        )

    ),
));