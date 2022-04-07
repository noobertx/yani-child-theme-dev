<?php
global $opt_name,$theme_text_domain;
Redux::setSection( $opt_name, array(
    'title'            => esc_html__( 'Styling', $theme_text_domain ),
    'id'               => 'houzez-styling',
    'desc'             => '',
    'customizer_width' => '',
    'icon'             => 'el-icon-brush el-icon-small'
) );

/* Body
----------------------------------------------------------------*/
Redux::setSection( $opt_name, array(
    'title'  => esc_html__( 'Body', $theme_text_domain ),
    'id'     => 'styling-body',
    'desc'   => '',
    'subsection' => true,
    'fields' => array(
        array(
            'id'       => 'body_text_color',
            'type'     => 'color',
            'title'    => esc_html__( 'Text Color', $theme_text_domain ),
            'desc' => esc_html__('Select the body text color', $theme_text_domain),
            'default'  => '#222222',
            'transparent' => false,
        ),

        array(
            'id'       => 'body_bg_color',
            'type'     => 'color',
            'title'    => esc_html__( 'Background Color', $theme_text_domain ),
            'desc' => esc_html__('Select body background color', $theme_text_domain),
            'default'  => '#f8f8f8',
            'transparent' => false,
        ),

        array(
            'id'       => 'yani_primary_color',
            'type'     => 'color',
            'title'    => esc_html__( 'Primary Color', $theme_text_domain ),
            'desc' => esc_html__( 'Select the primary color.', $theme_text_domain ),
            'default'  => '#00aeff',
            'transparent' => false
        ),
        array(
            'id'       => 'yani_primary_color_hover',
            'type'     => 'color_rgba',
            'title'    => esc_html__( 'Primary Hover Color', $theme_text_domain ),
            'desc' => esc_html__( 'Select the primary hover color.', $theme_text_domain ),
            'default'  => array(
                'color' => '#33beff',
                'alpha' => '.65',
                'rgba'  => 'rgba(0, 174, 255, 0.65)'
            )
        ),

        array(
            'id'       => 'yani_secondary_color',
            'type'     => 'color',
            'title'    => esc_html__( 'Secondary Color', $theme_text_domain ),
            'desc' => esc_html__( 'Select the secondary color.', $theme_text_domain ),
            'default'  => '#28a745',
            'transparent' => false
        ),
        array(
            'id'       => 'yani_secondary_color_hover',
            'type'     => 'color_rgba',
            'title'    => esc_html__( 'Secondary Hover Color', $theme_text_domain ),
            'desc' => esc_html__( 'Select the secondary hover color.', $theme_text_domain ),
            'default'  => array(
                'color' => '#34ce57',
                'alpha' => '.75',
                'rgba'  => ''
            )
        ),
    )
));


/* Navigation bars
----------------------------------------------------------------*/
Redux::setSection( $opt_name, array(
    'title'  => esc_html__( 'Navigation Bar', $theme_text_domain ),
    'id'     => 'styling-headers',
    'desc'   => '',
    'subsection' => true,
    'fields' => array(


        // Header 1
        array(
            'id'       => 'header_1_bg',
            'type'     => 'color',
            'required' => array('header_style', '=', '1'),
            'title'    => esc_html__( 'Background Color', $theme_text_domain ),
            'desc'    => esc_html__( 'Select the navigation background color', $theme_text_domain ),
            'subtitle' => '',
            'default'  =>'#004274',
            'mode'     => 'background',
            'transparent' => false
        ),
        array(
            'id'       => 'header_1_links_color',
            'type'     => 'color',
            'title'    => esc_html__( 'Menu Tabs Text Color', $theme_text_domain ),
            'desc'    => esc_html__( 'Select the text color of the menu tabs', $theme_text_domain ),
            'required' => array('header_style', '=', '1'),
            'subtitle' => '',
            'default'  => '#FFFFFF',
            'transparent' => false
        ),
        array(
            'id'       => 'header_1_links_hover_color',
            'type'     => 'color',
            'title'    => esc_html__( 'Menu Tabs Text Color On Hover', $theme_text_domain ),
            'desc'    => esc_html__( 'Select the text color of the menu tabs on hover', $theme_text_domain ),
            'required' => array('header_style', '=', '1'),
            'subtitle' => '',
            'default'  => '#00aeff',
            'transparent' => false
        ),
        array(
            'id'       => 'header_1_links_hover_bg_color',
            'type'     => 'color_rgba',
            'title'    => esc_html__( 'Menu Tabs Background Color On Hover', $theme_text_domain ),
            'desc'    => esc_html__( 'Select the background color of the menu tabs on hover', $theme_text_domain ),
            'required' => array('header_style', '=', '1'),
            'subtitle' => '',
            'default'  => array(
                'color' => '#00aeff',
                'alpha' => '.1',
                'rgba'  => 'rgba(0, 174, 255, 0.1)'
            )
        ),

        // Header 2
        array(
            'id'       => 'header_2_section-start',
            'type'     => 'section',
            'required' => array(
                array('header_style', '!=', '1'),
                array('header_style', '!=', '3'),
                array('header_style', '!=', '4'),
                array('header_style', '!=', '6'),
            ),
            'title'    => esc_html__( 'Top Area', $theme_text_domain ),
            'indent'   => true,
        ),
        array(
            'id'       => 'header_2_top_bg',
            'type'     => 'color',
            'required' => array(
                array('header_style', '!=', '1'),
                array('header_style', '!=', '3'),
                array('header_style', '!=', '4'),
                array('header_style', '!=', '6'),
            ),
            'title'    => esc_html__( 'Background Color', $theme_text_domain ),
            'desc' => esc_html__('Select the top area background color', $theme_text_domain),
            'default'  => '#ffffff',
            'transparent' => false
        ),
        array(
            'id'       => 'header_2_top_text',
            'type'     => 'color',
            'required' => array(
                array('header_style', '!=', '1'),
                array('header_style', '!=', '3'),
                array('header_style', '!=', '4'),
                array('header_style', '!=', '6'),
            ),
            'title'    => esc_html__( 'Text Color', $theme_text_domain ),
            'desc' => esc_html__('Select the top area text color', $theme_text_domain),
            'default'  => '#004274',
            'transparent' => false
        ),
        array(
            'id'       => 'header_2_section-end',
            'type'     => 'section',
            'required' => array(
                array('header_style', '!=', '1'),
                array('header_style', '!=', '3'),
                array('header_style', '!=', '4'),
                array('header_style', '!=', '6'),
            ),
            'indent'   => false,
        ),

        array(
            'id'       => 'header_2_bg',
            'type'     => 'color',
            'required' => array(
                array('header_style', '!=', '1'),
                array('header_style', '!=', '3'),
                array('header_style', '!=', '4'),
                array('header_style', '!=', '6'),
            ),
            'title'    => esc_html__( 'Menu Background Color', $theme_text_domain ),
            'desc' => esc_html__( 'Select the menu background color', $theme_text_domain ),
            'default'  => '#004274',
            'transparent' => false
        ),
        array(
            'id'       => 'header_2_links_color',
            'type'     => 'color',
            'title'    => esc_html__( 'Menu Tabs Text Color', $theme_text_domain ),
            'desc' => esc_html__( 'Select the text color of the menu tabs', $theme_text_domain ),
            'required' => array(
                array('header_style', '!=', '1'),
                array('header_style', '!=', '3'),
                array('header_style', '!=', '4'),
                array('header_style', '!=', '6'),
            ),
            'subtitle' => '',
            'default'  => '#ffffff',
            'transparent' => false
        ),
        array(
            'id'       => 'header_2_links_hover_color',
            'type'     => 'color',
            'title'    => esc_html__( 'Menu Tabs Text Color On Hover', $theme_text_domain ),
            'desc' => esc_html__( 'Select the text color of the menu tabs on hover', $theme_text_domain ),
            'required' => array(
                array('header_style', '!=', '1'),
                array('header_style', '!=', '3'),
                array('header_style', '!=', '4'),
                array('header_style', '!=', '6'),
            ),
            'subtitle' => '',
            'default'  => '#00aeff',
            'transparent' => false
        ),
        array(
            'id'       => 'header_2_links_hover_bg_color',
            'type'     => 'color_rgba',
            'title'    => esc_html__( 'Menu Tabs Background Color On Hover', $theme_text_domain ),
            'desc' => esc_html__( 'Select the background color of the menu tabs on hover', $theme_text_domain ),
            'required' => array(
                array('header_style', '!=', '1'),
                array('header_style', '!=', '3'),
                array('header_style', '!=', '4'),
                array('header_style', '!=', '6'),
            ),
            'subtitle' => '',
            'default'  => array(
                'color' => '#00aeff',
                'alpha' => '.1',
                'rgba'  => 'rgba(0, 174, 255, 0.1)'
            )
        ),
        array(
            'id'       => 'header_2_border',
            'type'     => 'color_rgba',
            'title'    => esc_html__( 'Menu Tabs Border Color', $theme_text_domain ),
            'desc' => esc_html__( 'Select the border color of the menu tabs', $theme_text_domain ),
            'required' => array(
                array('header_style', '!=', '1'),
                array('header_style', '!=', '3'),
                array('header_style', '!=', '4'),
                array('header_style', '!=', '6'),
            ),
            'subtitle' => '',
            'default'  => array(
                'color'  => '#004274',
                'alpha'  => '.2',
                'rgba'  => 'rgba(0, 174, 255, 0.2)'
            )
        ),

        // Header 3
        array(
            'id'       => 'header_3_bg',
            'type'     => 'color',
            'required' => array('header_style', '=', '3'),
            'title'    => esc_html__( 'Top Area Background Color', $theme_text_domain ),
            'desc' => esc_html__( 'Select the top area background color', $theme_text_domain ),
            'default'  => '#004274',
            'transparent' => false
        ),
        array(
            'id'       => 'header_3_callus_color',
            'type'     => 'color',
            'required' => array('header_style', '=', '3'),
            'title'    => esc_html__( 'Call Us Color', $theme_text_domain ),
            'desc' => esc_html__( 'Select the call us text color', $theme_text_domain ),
            'default'  => '#ffffff',
            'transparent' => false
        ),
        array(
            'id'       => 'header_3_callus_bg_color',
            'type'     => 'color',
            'required' => array('header_style', '=', '3'),
            'title'    => esc_html__( 'Call Us Background Color', $theme_text_domain ),
            'desc' => esc_html__( 'Select the call us background color', $theme_text_domain ),
            'default'  => '#00aeff',
            'transparent' => false
        ),
        array(
            'id'       => 'header_3_bg_menu',
            'type'     => 'color',
            'required' => array('header_style', '=', '3'),
            'title'    => esc_html__( 'Menu Background Color', $theme_text_domain ),
            'desc' => esc_html__( 'Select the menu background color', $theme_text_domain ),
            'default'  => '#004274',
            'transparent' => false
        ),

        
        
        array(
            'id'       => 'header_3_links_color',
            'type'     => 'color',
            'title'    => esc_html__( 'Menu Tabs Text Color', $theme_text_domain ),
            'desc' => esc_html__( 'Select the text color of the menu tabs', $theme_text_domain ),
            'required' => array('header_style', '=', '3'),
            'subtitle' => '',
            'default'  => '#FFFFFF',
            'transparent' => false
        ),

        array(
            'id'       => 'header_3_links_hover_color',
            'type'     => 'color',
            'title'    => esc_html__( 'Menu Tabs Text Color On Hover', $theme_text_domain ),
            'desc' => esc_html__( 'Select the text color of the menu tabs on hover', $theme_text_domain ),
            'required' => array('header_style', '=', '3'),
            'subtitle' => '',
            'default'  => '#00aeff',
            'transparent' => false
        ),
        array(
            'id'       => 'header_3_links_hover_bg_color',
            'type'     => 'color_rgba',
            'title'    => esc_html__( 'Menu Tabs Background Color', $theme_text_domain ),
            'desc' => esc_html__( 'Select the background color of the menu tabs', $theme_text_domain ),
            'required' => array('header_style', '=', '3'),
            'subtitle' => '',
            'default'  => array(
                'color' => '#00aeff',
                'alpha' => '.1',
                'rgba'  => 'rgba(0, 174, 255, 0.1)'
            )
        ),
        array(
            'id'       => 'header_3_border',
            'type'     => 'color_rgba',
            'title'    => esc_html__( 'Menu Tabs Border Color', $theme_text_domain ),
            'desc' => esc_html__( 'Select the border color of the menu tabs', $theme_text_domain ),
            'required' => array('header_style', '=', '3'),
            'subtitle' => '',
            'default'  => array(
                'color' => '#00aeff',
                'alpha' => '.2',
                'rgba'  => 'rgba(0, 174, 239, 0.2)'
            )
        ),
        array(
            'id'       => 'header_3_social_color',
            'type'     => 'color',
            'title'    => esc_html__( 'Social Icons color', $theme_text_domain ),
            'desc' => esc_html__( 'Select the social icons color', $theme_text_domain ),
            'required' => array('header_style', '=', '3'),
            'subtitle' => '',
            'default'  => '#004274',
            'transparent' => false
        ),

        //Header 4
        array(
            'id'       => 'header_4_bg',
            'type'     => 'color',
            'required' => array('header_style', '=', '4'),
            'title'    => esc_html__( 'Background Color', $theme_text_domain ),
            'desc' => esc_html__( 'Select the background color', $theme_text_domain ),
            'subtitle' => '',
            'default'  => '#ffffff',
            'transparent' => false

        ),
        array(
            'id'       => 'header_4_links_color',
            'type'     => 'color',
            'title'    => esc_html__( 'Menu Tabs Text Color', $theme_text_domain ),
            'desc' => esc_html__( 'Select the text color of the menu tabs', $theme_text_domain ),
            'required' => array('header_style', '=', '4'),
            'subtitle' => '',
            'default'  => '#004274',
            'transparent' => false
        ),
        array(
            'id'       => 'header_4_links_hover_color',
            'type'     => 'color',
            'title'    => esc_html__( 'Menu Tabs Text Color On Hover', $theme_text_domain ),
            'desc' => esc_html__( 'Select the text color of the menu tabs on hover', $theme_text_domain ),
            'required' => array('header_style', '=', '4'),
            'subtitle' => '',
            'default'  => '#00aeef'
        ),

        array(
            'id'       => 'header_4_links_hover_bg_color',
            'type'     => 'color_rgba',
            'title'    => esc_html__( 'Menu Tabs Background Color On Hover', $theme_text_domain ),
            'desc' => esc_html__( 'Select the background color of the menu tabs on hover', $theme_text_domain ),
            'required' => array('header_style', '=', '4'),
            'subtitle' => '',
            'default'  => array(
                'color' => '#00aeff',
                'alpha' => '.1',
                'rgba'  => 'rgba(0, 174, 255, 0.1)'
            )
        ),

        // Header 6
        array(
            'id'       => 'header_6_bg',
            'type'     => 'color',
            'required' => array('header_style', '=', '6'),
            'title'    => esc_html__( 'Background Color', $theme_text_domain ),
            'desc'    => esc_html__( 'Select the background color', $theme_text_domain ),
            'subtitle' => '',
            'default'  =>'#004274',
            'mode'     => 'background',
            'transparent' => false
        ),
        array(
            'id'       => 'header_6_links_color',
            'type'     => 'color',
            'title'    => esc_html__( 'Menu Tabs Text Color', $theme_text_domain ),
            'desc'    => esc_html__( 'Select the text color of the menu tabs', $theme_text_domain ),
            'required' => array('header_style', '=', '6'),
            'subtitle' => '',
            'default'  => '#FFFFFF',
            'transparent' => false
        ),
        array(
            'id'       => 'header_6_links_hover_color',
            'type'     => 'color',
            'title'    => esc_html__( 'Menu Tabs Text Color On Hover', $theme_text_domain ),
            'desc'    => esc_html__( 'Select the text color of the menu tabs on hover', $theme_text_domain ),
            'required' => array('header_style', '=', '6'),
            'subtitle' => '',
            'default'  => '#00aeff',
            'transparent' => false
        ),
        array(
            'id'       => 'header_6_links_hover_bg_color',
            'type'     => 'color_rgba',
            'title'    => esc_html__( 'Menu Tabs Background Color On Hover', $theme_text_domain ),
            'desc'    => esc_html__( 'Select the background color of the menu tabs on hover', $theme_text_domain ),
            'required' => array('header_style', '=', '6'),
            'subtitle' => '',
            'default'  => array(
                'color' => '#00aeff',
                'alpha' => '.1',
                'rgba'  => 'rgba(0, 174, 255, 0.1)'
            )
        ),

        array(
            'id'       => 'header_6_social_color',
            'type'     => 'color',
            'title'    => esc_html__( 'Social Icons Color', $theme_text_domain ),
            'desc'    => esc_html__( 'Select the color of the social icons', $theme_text_domain ),
            'required' => array('header_style', '=', '6'),
            'subtitle' => '',
            'default'  => '#FFFFFF',
            'transparent' => false
        ),

        /*
         * Header Transparent
         * --------------------------------------------------------------------- */
        array(
            'id'     => 'info-header-4-transparent',
            'type'   => 'info',
            'notice' => false,
            'style'  => 'info',
            'title'  => esc_html__( 'Transparent Menu Options (The transparent navigation is displayed on the splash page and when you select the trasparent header)', $theme_text_domain ),
            'desc'   => ''
        ),

        array(
            'id'       => 'header_4_transparent_links_color',
            'type'     => 'color',
            'title'    => esc_html__( 'Menu Tabs Text Color', $theme_text_domain ),
            'desc'    => esc_html__( 'Select the text color of the menu tabs', $theme_text_domain ),
            'subtitle' => '',
            'default'  => '#ffffff',
            'transparent' => false
        ),
        array(
            'id'       => 'header_4_transparent_links_hover_color',
            'type'     => 'color',
            'title'    => esc_html__( 'Menu Tabs Text Color On Hover', $theme_text_domain ),
            'desc'    => esc_html__( 'Select the text color of the menu tabs on hover', $theme_text_domain ),
            'subtitle' => '',
            'default'  => '#00aeef',
            'transparent' => false
        ),

        array(
            'id'       => 'header_4_transparent_border_bottom1',
            'type'     => 'border',
            'title'    => esc_html__( 'Border Bottom', $theme_text_domain ),
            'desc'    => esc_html__( 'Select the border dimention and style', $theme_text_domain ),
            'subtitle' => '',
            'color' => false,
            'default'  => array(
                'border-style'  => 'solid',
                'border-top'    => '1px',
                'border-right'  => '1px',
                'border-bottom' => '1px',
                'border-left'   => '1px'
            )
        ),
        array(
            'id'       => 'header_4_transparent_border_bottom_color',
            'type'     => 'color_rgba',
            'title'    => esc_html__( 'Border Bottom Color', $theme_text_domain ),
            'desc'    => esc_html__( 'Select the border color', $theme_text_domain ),
            'subtitle' => '',
            'default'  => array(
                'color' => '#ffffff',
                'alpha' => '.30',
                'rgba'  => 'rgba(255, 255, 255, 0.3)'
            )
        ),

    )
));

/* Sub Menu
----------------------------------------------------------------*/
Redux::setSection( $opt_name, array(
    'title'  => esc_html__( 'Sub Menu', $theme_text_domain ),
    'id'     => 'styling-submenu',
    'desc'   => '',
    'subsection' => true,
    'fields' => array(
        array(
            'id'       => 'header_submenu_bg',
            'type'     => 'color_rgba',
            'title'    => esc_html__( 'Background Color', $theme_text_domain ),
            'desc'    => esc_html__( 'Select the background color', $theme_text_domain ),
            'subtitle' => '',
            'default'  => array(
                'color' => '#FFFFFF',
                'alpha' => '.95',
                'rgba'  => 'rgba(255, 255, 255, 0.95)'
            )

        ),
        array(
            'id'       => 'header_submenu_links_color',
            'type'     => 'color',
            'title'    => esc_html__( 'Menu Tabs Text Color', $theme_text_domain ),
            'desc'    => esc_html__( 'Select the text color of the menu tabs', $theme_text_domain ),
            'subtitle' => '',
            'default'  => '#004274',
            'transparent' => false
        ),
        array(
            'id'       => 'header_submenu_links_hover_color',
            'type'     => 'color',
            'title'    => esc_html__( 'Menu Tabs Text Color On Hover', $theme_text_domain ),
            'desc'    => esc_html__( 'Select the text color of the menu tabs on hover', $theme_text_domain ),
            'subtitle' => '',
            'default'  => '#00aeff'
        ),
        array(
            'id'       => 'header_submenu_border_color',
            'type'     => 'color',
            'title'    => esc_html__( 'Border color', $theme_text_domain ),
            'desc'    => esc_html__( 'Select the border color', $theme_text_domain ),
            'subtitle' => '',
            'default'  => '#dce0e0',
            'transparent' => true
        ),
    )
));

/* Create Listing
----------------------------------------------------------------*/
Redux::setSection( $opt_name, array(
    'title'  => esc_html__( 'Create Listing Button', $theme_text_domain ),
    'id'     => 'styling-create-listing',
    'desc'   => '',
    'subsection' => true,
    'fields' => array(
        array(
            'id'       => 'header_4_btn_color',
            'type'     => 'color',
            'title'    => esc_html__( 'Button Text Color', $theme_text_domain ),
            'desc'    => esc_html__( 'Select the text color', $theme_text_domain ),
            'subtitle' => '',
            'default'  => '#ffffff',
            'transparent' => true
        ),
        array(
            'id'       => 'header_4_btn_hover_color',
            'type'     => 'color_rgba',
            'title'    => esc_html__( 'Button Text Color On Hover', $theme_text_domain ),
            'desc'    => esc_html__( 'Select the text color on hover', $theme_text_domain ),
            'subtitle' => '',
            'default'  => array(
                'color' => '#ffffff',
                'alpha' => '.99',
                'rgba'  => 'rgba(255, 255, 255, 0.99)'
            )
        ),
        array(
            'id'       => 'header_4_btn_bg_color',
            'type'     => 'color',
            'title'    => esc_html__( 'Button Background Color', $theme_text_domain ),
            'desc'    => esc_html__( 'Select the button background color', $theme_text_domain ),
            'default'  => '#00aeff',
            'transparent' => true
        ),
        array(
            'id'       => 'header_4_btn_bg_hover_color',
            'type'     => 'color_rgba',
            'title'    => esc_html__( 'Button Background Color On Hover', $theme_text_domain ),
            'desc'    => esc_html__( 'Select the button background color on hover', $theme_text_domain ),
            'default'  => array(
                'color' => '#00aeff',
                'alpha' => '.65',
                'rgba'  => 'rgba(0, 174, 255, 0.65)'
            )
        ),
        array(
            'id'       => 'header_4_btn_border',
            'type'     => 'border',
            'title'    => esc_html__( 'Button Border', $theme_text_domain ),
            'desc'    => esc_html__( 'Select the button border options', $theme_text_domain ),
            'subtitle' => '',
            'default'  => array(
                'border-color'  => '#00aeff',
                'border-style'  => 'solid',
                'border-top'    => '1px',
                'border-right'  => '1px',
                'border-bottom' => '1px',
                'border-left'   => '1px'
            )
        ),
        array(
            'id'       => 'header_4_btn_border_hover_color',
            'type'     => 'color_rgba',
            'title'    => esc_html__( 'Button Border On Hover', $theme_text_domain ),
            'desc'    => esc_html__( 'Select the button border color on hover', $theme_text_domain ),
            'default'  => array(
                'color' => '#00aeff',
                'alpha' => '.99',
                'rgba'  => 'rgba(0, 174, 255, 0.99)'
            )
        ),

        /*
         * Transparent
         * --------------------------------------------------------------------- */
        array(
            'id'     => 'info-create-listingtransparent',
            'type'   => 'info',
            'notice' => false,
            'style'  => 'info',
            'title'  => esc_html__( 'Transparent Header - Create Listing Button', $theme_text_domain ),
            'desc'   => ''
        ),

        array(
            'id'       => 'header_4_transparent_btn_color',
            'type'     => 'color',
            'title'    => esc_html__( 'Button Text Color', $theme_text_domain ),
            'desc'    => esc_html__( 'Select the text color', $theme_text_domain ),
            'subtitle' => '',
            'default'  => '#ffffff',
            'transparent' => false
        ),
        array(
            'id'       => 'header_4_transparent_btn_hover_color',
            'type'     => 'color_rgba',
            'title'    => esc_html__( 'Button Text Color On Hover', $theme_text_domain ),
            'desc'    => esc_html__( 'Select the text color on hover', $theme_text_domain ),
            'subtitle' => '',
            'default'  => array(
                'color' => '#ffffff',
                'alpha' => '1',
                'rgba'  => ''
            )
        ),
        array(
            'id'       => 'header_4_transparent_btn_bg_color',
            'type'     => 'color_rgba',
            'title'    => esc_html__( 'Button Background Color', $theme_text_domain ),
            'desc'    => esc_html__( 'Select the button background color', $theme_text_domain ),
            'default'  => array(
                'color' => '#ffffff',
                'alpha' => '.2',
                'rgba'  => 'rgba(255, 255, 255, 0.2)'
            )
        ),
        array(
            'id'       => 'header_4_transparent_btn_bg_hover_color',
            'type'     => 'color_rgba',
            'title'    => esc_html__( 'Button Background Color On Hover', $theme_text_domain ),
            'desc'    => esc_html__( 'Select the button background color on hover', $theme_text_domain ),
            'default'  => array(
                'color' => '#00aeff',
                'alpha' => '.65',
                'rgba'  => 'rgba(0, 174, 255, 0.65)'
            )
        ),
        array(
            'id'       => 'header_4_transparent_btn_border',
            'type'     => 'border',
            'title'    => esc_html__( 'Button Border', $theme_text_domain ),
            'desc'    => esc_html__( 'Select the button border options', $theme_text_domain ),
            'subtitle' => '',
            'default'  => array(
                'border-color'  => '#ffffff',
                'border-style'  => 'solid',
                'border-top'    => '1px',
                'border-right'  => '1px',
                'border-bottom' => '1px',
                'border-left'   => '1px'
            )
        ),
        array(
            'id'       => 'header_4_transparent_btn_border_hover_color',
            'type'     => 'color_rgba',
            'title'    => esc_html__( 'Button Border On Hover', $theme_text_domain ),
            'desc'    => esc_html__( 'Select the button border color on hover', $theme_text_domain ),
            'default'  => array(
                'color' => '#00AEEF',
                'alpha' => '1',
                'rgba'  => ''
            )
        ),

    )
));

/* Mobile Navigation
----------------------------------------------------------------*/
Redux::setSection( $opt_name, array(
    'title'  => esc_html__( 'Mobile Menu', $theme_text_domain ),
    'id'     => 'styling-mobile-menu',
    'desc'   => '',
    'subsection' => true,
    'fields' => array(
        array(
            'id'       => 'mob_menu_bg_color',
            'type'     => 'color',
            'title'    => esc_html__( 'Mobile Header Background Color', $theme_text_domain ),
            'desc' => esc_html__('Select the background color of the mobile header', $theme_text_domain),
            'default'  => '#004274',
            'transparent' => false
        ),
        array(
            'id'       => 'mob_menu_btn_color',
            'type'     => 'color',
            'title'    => esc_html__( 'Mobile Header Icon Color', $theme_text_domain ),
            'subtitle'    => esc_html__( 'Navicon and User-menu icon color', $theme_text_domain ),
            'desc'    => esc_html__( 'Select the color of the incons in the mobile header', $theme_text_domain ),
            'default'  => '#FFFFFF'
        ),
        array(
            'id'       => 'mob_nav_bg_color',
            'type'     => 'color',
            'title'    => esc_html__( 'Menu Tabs Background Color', $theme_text_domain ),
            'desc'    => esc_html__( 'Select the background color of the menu tabs', $theme_text_domain ),
            'default'  => '#ffffff',
            'transparent' => false
        ),
        array(
            'id'       => 'mob_link_color',
            'type'     => 'color',
            'title'    => esc_html__( 'Menu Tabs Text Color', $theme_text_domain ),
            'desc'    => esc_html__( 'Select the text color of the menu tabs', $theme_text_domain ),
            'default'  => '#004274'
        ),
        array(
            'id'       => 'mobile_nav_border',
            'type'     => 'border',
            'title'    => esc_html__( 'Border', $theme_text_domain ),
            'desc'    => esc_html__( 'Select the button border options', $theme_text_domain ),
            'desc'     => '',
            'default'  => array(
                'border-color'  => '#dce0e0',
                'border-style'  => 'solid',
                'border-top'    => '1px',
                'border-right'  => '0px',
                'border-bottom' => '0px',
                'border-left'   => '0px'
            )
        ),
    )
));

/* Advance Search
----------------------------------------------------------------*/
Redux::setSection( $opt_name, array(
    'title'  => esc_html__( 'Advanced Search', $theme_text_domain ),
    'id'     => 'styling-advanced-search',
    'desc'   => '',
    'subsection' => true,
    'fields' => array(
        array(
            'id'       => 'adv_background',
            'type'     => 'color',
            'title'    => esc_html__( 'Background Color', $theme_text_domain ),
            'subtitle' => esc_html__( 'Select the advanced search background color', $theme_text_domain ),
            'default'  => '#ffffff',
            'validate' => 'color',
        ),
        array(
            'id'       => 'side_search_background',
            'type'     => 'color',
            'title'    => esc_html__( 'Half Map Search Background Color', $theme_text_domain ),
            'subtitle' => esc_html__( 'Select the background color for half map side search', $theme_text_domain ),
            'default'  => '#ffffff',
            'validate' => 'color',
        ),
        array(
            'id'       => 'adv_textfields_borders',
            'type'     => 'color',
            'title'    => esc_html__( 'Fields Border Color ', $theme_text_domain ),
            'subtitle' => esc_html__( 'Select the border color of the search fields', $theme_text_domain ),
            'subtitle' => '',
            'default'  => '#dce0e0',
        ),
        array(
            'id'       => 'adv_text_color20',
            'type'     => 'color',
            'title'    => esc_html__( 'Fields Placeholder Color', $theme_text_domain ),
            'subtitle' => esc_html__('Select placeholder text color', $theme_text_domain),
            'default'  => '#a1a7a8',
        ),
        array(
            'id'       => 'adv_other_color',
            'type'     => 'color',
            'title'    => esc_html__( 'Text Color', $theme_text_domain ),
            'subtitle' => esc_html__( 'Text color for price range slider and other features', $theme_text_domain ),
            'default'  => '#222222',
            'validate' => 'color',
        ),
        array(
            'id'       => 'adv_halfmap_other_color',
            'type'     => 'color',
            'title'    => esc_html__( 'Half Map Text Color', $theme_text_domain ),
            'subtitle' => esc_html__( 'Text color for price range slider and other features for half map side search', $theme_text_domain ),
            'default'  => '#222222',
            'validate' => 'color',
        ),
        array(
            'id'       => 'adv_search_btn_bg',
            'type'     => 'link_color',
            'title'    => esc_html__( 'Search Button Background Color', $theme_text_domain ),
            'subtitle'     => esc_html__( 'Select the search button background color', $theme_text_domain ),
            'active'    => false,
            'default'  => array(
                'regular' => '#28a745',
                'hover'   => '#34ce57',
            )
        ),
        array(
            'id'       => 'adv_search_btn_text',
            'type'     => 'link_color',
            'title'    => esc_html__( 'Search Button Text Color', $theme_text_domain ),
            'subtitle'     => esc_html__( 'Select the search button text color', $theme_text_domain ),
            'active'    => false,
            'default'  => array(
                'regular' => '#ffffff',
                'hover'   => '#ffffff',
            )
        ),
        array(
            'id'       => 'adv_search_border',
            'type'     => 'link_color',
            'title'    => esc_html__( 'Search Button Border Color', $theme_text_domain ),
            'subtitle'     => esc_html__( 'Select the search button border color', $theme_text_domain ),
            'active'    => false,
            'default'  => array(
                'regular' => '#28a745',
                'hover'   => '#34ce57',
            )
        ),
        array(
            'id'       => 'adv_button_color',
            'type'     => 'link_color',
            'title'    => esc_html__( 'Advanced Button Text Color', $theme_text_domain ),
            'subtitle'     => esc_html__( 'Select the advanced button text color', $theme_text_domain ),
            'active'    => false,
            'default'  => array(
                'regular' => '#00aeff',
                'hover'   => '#ffffff'
            )
        ),
        array(
            'id'       => 'adv_button_bg_color',
            'type'     => 'link_color',
            'title'    => esc_html__( 'Advanced Button Background Color', $theme_text_domain ),
            'subtitle'     => esc_html__( 'Select the advanced button background color', $theme_text_domain ),
            'active'    => false,
            'default'  => array(
                'regular' => '#ffffff',
                'hover'   => '#00aeff'
            )
        ),
        array(
            'id'       => 'adv_button_border_color',
            'type'     => 'link_color',
            'title'    => esc_html__( 'Advanced Button Border Color', $theme_text_domain ),
            'subtitle'     => esc_html__( 'Select the advanced button border color', $theme_text_domain ),
            'active'    => false,
            'default'  => array(
                'regular' => '#dce0e0',
                'hover'   => '#00aeff'
            )
        ),

        array(
            'id'             => 'header_search_padding',
            'type'           => 'spacing',
            'mode'           => 'padding',
            'units'          => array('em', 'px'),
            'units_extended' => 'false',
            'left' => 'false',
            'right' => 'false',
            'title'          => esc_html__('Padding', $theme_text_domain),
            'subtitle'       => esc_html__('Add top and bottom padding for header search', $theme_text_domain),
            'default'            => array(
                'padding-top'     => '10px', 
                'padding-bottom'  => '10px', 
                'units'          => 'px', 
            )
        ),

        array(
            'id'       => 'adv_overlay_open_close_bg_color',
            'type'     => 'color',
            'title'    => esc_html__( 'Open/Close Button Background Color', $theme_text_domain ),
            'subtitle' => esc_html__('This setting works for the advanced search over headers map, video, image, etc.', $theme_text_domain),
            'desc'     => esc_html__( 'Select the open/close button background color', $theme_text_domain ),
            'default'  => '#00aeff',
            'transparent' => false
        ),
        array(
            'id'       => 'adv_overlay_open_close_color',
            'type'     => 'color',
            'title'    => esc_html__( 'Open/Close Button Color', $theme_text_domain ),
            'subtitle' => esc_html__('This setting works for the advanced search over headers map, video, image, etc.', $theme_text_domain),
            'desc'     => esc_html__( 'Select the open/close button text color', $theme_text_domain ),
            'default'  => '#ffffff',
            'transparent' => false
        ),
    )
));

/* Saved Search Button
----------------------------------------------------------------*/
Redux::setSection( $opt_name, array(
    'title'  => esc_html__( 'Saved Search Button', $theme_text_domain ),
    'id'     => 'styling-saved-search',
    'desc'   => '',
    'subsection' => true,
    'fields' => array(
        array(
            'id'       => 'ssb_color',
            'type'     => 'color',
            'title'    => esc_html__( 'Text Color', $theme_text_domain ),
            'desc'    => '',
            'subtitle' => '',
            'default'  => '#ffffff'

        ),
        array(
            'id'       => 'ssb_color_hover',
            'type'     => 'color',
            'title'    => esc_html__( 'Text Color Hover', $theme_text_domain ),
            'desc'    => '',
            'subtitle' => '',
            'default'  => '#ffffff'

        ),
        array(
            'id'       => 'ssb_bg_color',
            'type'     => 'color',
            'title'    => esc_html__( 'Background Color', $theme_text_domain ),
            'desc'    => '',
            'subtitle' => '',
            'default'  => '#28a745'

        ),
        array(
            'id'       => 'ssb_bg_color_hover',
            'type'     => 'color',
            'title'    => esc_html__( 'Background Color Hover', $theme_text_domain ),
            'desc'    => '',
            'subtitle' => '',
            'default'  => '#28a745'

        ),
        array(
            'id'       => 'ssb_border_color',
            'type'     => 'color',
            'title'    => esc_html__( 'Border Color', $theme_text_domain ),
            'desc'    => '',
            'subtitle' => '',
            'default'  => '#28a745'

        ),
        array(
            'id'       => 'ssb_border_color_hover',
            'type'     => 'color',
            'title'    => esc_html__( 'Border Color Hover', $theme_text_domain ),
            'desc'    => '',
            'subtitle' => '',
            'default'  => '#28a745'

        ),
        
    )
));

/* Header Account Navigation
----------------------------------------------------------------*/
Redux::setSection( $opt_name, array(
    'title'  => esc_html__( 'User Account Menu', $theme_text_domain ),
    'id'     => 'styling-user-account-menu',
    'desc'   => '',
    'subsection' => true,
    'fields' => array(
        array(
            'id'       => 'ua_menu_bg',
            'type'     => 'color',
            'title'    => esc_html__( 'Background Color', $theme_text_domain ),
            'desc'    => esc_html__( 'Select the menu background color', $theme_text_domain ),
            'subtitle' => '',
            'default'  => '#FFFFFF'

        ),
        array(
            'id'       => 'ua_menu_links_color',
            'type'     => 'color',
            'title'    => esc_html__( 'Menu Tabs Text Color', $theme_text_domain ),
            'desc'    => esc_html__( 'Select the text color of the menu tabs', $theme_text_domain ),
            'subtitle' => '',
            'default'  => '#004274',
            'transparent' => false
        ),
        array(
            'id'       => 'ua_menu_links_hover_color',
            'type'     => 'color',
            'title'    => esc_html__( 'Menu Tabs Text Color On Hover', $theme_text_domain ),
            'desc'    => esc_html__( 'Select the text color of the menu tabs on hover', $theme_text_domain ),
            'subtitle' => '',
            'default'  => '#00aeff',
            'transparent' => false
        ),
        array(
            'id'       => 'ua_menu_links_hover_bg_color',
            'type'     => 'color_rgba',
            'title'    => esc_html__( 'Menu Tabs Background Color On Hover', $theme_text_domain ),
            'desc'    => esc_html__( 'Select the background color of the menu tabs on hover', $theme_text_domain ),
            'subtitle' => '',
            'default'  => array(
                'color' => '#00aeff',
                'alpha' => '0.11',
                'rgba'  => 'rgba(0, 174, 255, 0.1)'
            )
        ),
        array(
            'id'       => 'ua_menu_border_color',
            'type'     => 'color',
            'title'    => esc_html__( 'Menu Tabs Border Color', $theme_text_domain ),
            'desc' => esc_html__( 'Select the border color of the menu tabs', $theme_text_domain ),
            'subtitle' => '',
            'default'  => '#dce0e0',
            'transparent' => true
        ),
    )
));

/* Dashboard Menu
----------------------------------------------------------------*/
Redux::setSection( $opt_name, array(
    'title'  => esc_html__( 'Dashboard Menu', $theme_text_domain ),
    'id'     => 'styling-dashboardmenu',
    'desc'   => '',
    'subsection' => true,
    'fields' => array(
        array(
            'id'       => 'dm_background',
            'type'     => 'color',
            'title'    => esc_html__( 'Background Color', $theme_text_domain ),
            'desc'    => esc_html__( 'Select the menu background color', $theme_text_domain ),
            'subtitle' => '',
            'default'  => '#002B4B',
            'transparent' => true
        ),
        array(
            'id'       => 'dm_color',
            'type'     => 'color',
            'title'    => esc_html__( 'Menu Tabs Text Color', $theme_text_domain ),
            'desc'    => esc_html__( 'Select the text color of the menu tabs', $theme_text_domain ),
            'subtitle' => '',
            'default'  => '#839EB2',
            'transparent' => true
        ),
        array(
            'id'       => 'dm_hover_color',
            'type'     => 'color',
            'title'    => esc_html__( 'Menu Tabs Text Color On Hover', $theme_text_domain ),
            'desc'    => esc_html__( 'Select the text color of the menu tabs on hover', $theme_text_domain ),            'subtitle' => '',
            'default'  => '#ffffff',
            'transparent' => true
        ),
        array(
            'id'       => 'dm_submenu_active_color',
            'type'     => 'color',
            'title'    => esc_html__( 'Sub Menu Active Color', $theme_text_domain ),
            'desc'    => esc_html__( 'Select submenu active color', $theme_text_domain ),
            'subtitle' => '',
            'default'  => '#00aeff'
        ),
    )
));

/* Property Details
----------------------------------------------------------------*/
Redux::setSection( $opt_name, array(
    'title'  => esc_html__( 'Property Details', $theme_text_domain ),
    'id'     => 'styling-property-detail',
    'desc'   => '',
    'subsection' => true,
    'fields' => array(
        array(
            'id'       => 'yani_prop_details_bg',
            'type'     => 'color_rgba',
            'title'    => esc_html__( 'Property Details Module Background Color', $theme_text_domain ),
            'desc' => esc_html__( 'Select property details module background color.', $theme_text_domain ),
            'default'  => array(
                'color' => '#00aeff',
                'alpha' => '.1',
                'rgba'  => '',
                'rgba'  => ''
            )
        ),
        array(
            'id'       => 'prop_details_border_color',
            'type'     => 'color',
            'title'    => esc_html__( 'Property Details Border Color', $theme_text_domain ),
            'desc' => esc_html__( 'Select property details module border color.', $theme_text_domain ),
            'subtitle' => '',
            'default'  => '#00aeff',
            'transparent' => false
        ),
    )
));

/* Featured Label
----------------------------------------------------------------*/
Redux::setSection( $opt_name, array(
    'title'  => esc_html__( 'Featured Label', $theme_text_domain ),
    'id'     => 'styling-featured-label',
    'desc'   => '',
    'subsection' => true,
    'fields' => array(
        array(
            'id'       => 'featured_label_bg_color',
            'type'     => 'color',
            'title'    => esc_html__( 'Background Color', $theme_text_domain ),
            'desc'    => esc_html__( 'Select the label background color', $theme_text_domain ),
            'subtitle' => '',
            'default'  => '#77c720',
            'transparent' => true
        ),
        array(
            'id'       => 'featured_label_color',
            'type'     => 'color',
            'title'    => esc_html__( 'Text Color', $theme_text_domain ),
            'desc'    => esc_html__( 'Select the label text color', $theme_text_domain ),
            'subtitle' => '',
            'default'  => '#ffffff',
            'transparent' => false
        )
    )
));

/* Top Bar
----------------------------------------------------------------*/
Redux::setSection( $opt_name, array(
    'title'  => esc_html__( 'Top Bar', $theme_text_domain ),
    'id'     => 'styling-top-bar',
    'desc'   => '',
    'subsection' => true,
    'fields' => array(
        array(
            'id'       => 'top_bar_bg',
            'type'     => 'color',
            'title'    => esc_html__( 'Background Color', $theme_text_domain ),
            'subtitle' => '',
            'default'  => '#000000',
            'transparent' => true
        ),
        array(
            'id'       => 'top_bar_color',
            'type'     => 'color',
            'title'    => esc_html__( 'Color', $theme_text_domain ),
            'subtitle' => '',
            'default'  => '#ffffff',
            'transparent' => false
        ),
        array(
            'id'       => 'top_bar_color_hover',
            'type'     => 'color_rgba',
            'title'    => esc_html__( 'Hover Color', $theme_text_domain ),
            'subtitle' => '',
            'default'  => array(
                'color' => '#00AEEF',
                'alpha' => '.75',
                'rgba'  => ''
            )
        ),
    )
));


/* Footer
----------------------------------------------------------------*/
Redux::setSection( $opt_name, array(
    'title'  => esc_html__( 'Footer', $theme_text_domain ),
    'id'     => 'styling-footer',
    'desc'   => '',
    'subsection' => true,
    'fields' => array(
        array(
            'id'       => 'footer_bg_color',
            'type'     => 'color',
            'title'    => esc_html__( 'Footer Top Background Color', $theme_text_domain ),
            'desc' => esc_html__('Select the footer top background color', $theme_text_domain),
            'default'  => '#004274',
            'transparent' => false,
        ),
        array(
            'id'       => 'footer_bottom_bg_color',
            'type'     => 'color',
            'title'    => esc_html__( 'Footer Bottom Background Color', $theme_text_domain ),
            'desc' => esc_html__('Select the footer bottom background color', $theme_text_domain),
            'default'  => '#00335A',
            'transparent' => false,
        ),
        array(
            'id'       => 'footer_color',
            'type'     => 'color',
            'title'    => esc_html__( 'Text Color', $theme_text_domain ),
            'desc' => esc_html__('Select the footer text color', $theme_text_domain),
            'default'  => '#ffffff'
        ),
        array(
            'id'       => 'footer_hover_color',
            'type'     => 'color_rgba',
            'title'    => esc_html__( 'Links Hover Color', $theme_text_domain ),
            'desc' => esc_html__('Select the footer links hover color', $theme_text_domain),
            'default'  => array(
                'color' => '#00aeff',
                'alpha' => '1',
                'rgba'  => ''
            )
        ),

    )
));