<?php
global $opt_name,$theme_text_domain;
Redux::setSection( $opt_name, array(
    'title'  => esc_html__( 'Logos & Favicon', $theme_text_domain ),
    'id'     => 'logo-favicon',
    'desc'   => '',
    'icon'   => 'el-icon-picture el-icon-small',
    'fields'		=> array(
        array(
            'id'		=> 'custom_logo',
            'url'		=> true,
            'type'		=> 'media',
            'title'		=> esc_html__( 'Logo', $theme_text_domain ),
            'read-only'	=> false,
            'default'	=> array( 'url'	=> YANI_THEME_IMAGES . 'logo-houzez-white.png' ),
            'desc'	=> esc_html__( 'Upload the logo', $theme_text_domain ),
        ),

        array(
            'id'		=> 'retina_logo',
            'url'		=> true,
            'type'		=> 'media',
            'title'		=> esc_html__( 'Logo (For Retina Screens)', $theme_text_domain ),
            'default'	=> array( 'url'	=> YANI_THEME_IMAGES . 'logo-houzez-white@2x.png' ),
            'subtitle'	=> esc_html__( 'The retina logo have to be double size of the regular logo', $theme_text_domain ),
            'desc'  => esc_html__( 'Upload the logo for retina devices', $theme_text_domain ),
        ),

        array(
            'id'		=> 'mobile_logo',
            'url'		=> true,
            'type'		=> 'media',
            'title'		=> esc_html__( 'Mobile Logo', $theme_text_domain ),
            'read-only'	=> false,
            'default'	=> array( 'url'	=> YANI_THEME_IMAGES . 'logo-houzez-white.png' ),
            'desc'	=> esc_html__( 'Upload the logo for mobile devices.', $theme_text_domain ),
        ),

        array(
            'id'		=> 'mobile_retina_logo',
            'url'		=> true,
            'type'		=> 'media',
            'title'		=> esc_html__( 'Mobile Logo (For Retina Screens)', $theme_text_domain ),
            'default'	=> array( 'url'	=> YANI_THEME_IMAGES . 'logo-houzez-white@2x.png' ),
            'subtitle'  => esc_html__( 'The retina logo have to be double size of the regular logo', $theme_text_domain ),
            'desc'  => esc_html__( 'Upload the logo for retina devices', $theme_text_domain ),
        ),

        array(
            'id'		=> 'custom_logo_splash',
            'url'		=> true,
            'type'		=> 'media',
            'title'		=> esc_html__( 'Splash Page & Transparent Header Logo', $theme_text_domain ),
            'read-only'	=> false,
            'default'	=> array( 'url'	=> YANI_THEME_IMAGES . 'logo-houzez-white.png' ),
            'desc'	=> esc_html__( 'Upload the logo for the splash page and the transparent header', $theme_text_domain ),
        ),

        array(
            'id'		=> 'retina_logo_splash',
            'url'		=> true,
            'type'		=> 'media',
            'title'		=> esc_html__( 'Splash Page & Transparent Header Logo (For Retina Screens)', $theme_text_domain ),
            'default'	=> array( 'url'	=> YANI_THEME_IMAGES . 'logo-houzez-white@2x.png' ),
            'subtitle'	=> esc_html__( 'The retina logo have to be double size of the regular logo', $theme_text_domain ),
            'desc'  => esc_html__( 'Upload the retina logo for the splash page and the transparent header', $theme_text_domain ),
        ),


        array(
            'id'		=> 'custom_logo_mobile_splash',
            'url'		=> true,
            'type'		=> 'media',
            'title'		=> esc_html__( 'Mobile Splash Page Logo', $theme_text_domain ),
            'read-only'	=> false,
            'default'	=> array( 'url'	=> YANI_THEME_IMAGES . 'logo-houzez-white.png' ),
            'desc'	=> esc_html__( 'Upload your custom logo for mobile splash page.', $theme_text_domain ),
        ),

        array(
            'id'		=> 'retina_logo_mobile_splash',
            'url'		=> true,
            'type'		=> 'media',
            'title'		=> esc_html__( 'Mobile Splash Page Logo (For Retina Screens)', $theme_text_domain ),
            'default'	=> array( 'url'	=> YANI_THEME_IMAGES . 'logo-houzez-white@2x.png' ),
            'subtitle'	=> esc_html__( 'The retina logo have to be double size of the regular logo', $theme_text_domain ),
            'desc'  => esc_html__( 'Upload the retina logo for the mobile splash page', $theme_text_domain ),
        ),

        array(
            'id'		=> 'retina_logo_height',
            'type'		=> 'text',
            'default'	=> '',
            'title'		=> esc_html__( 'Standard Logo Height', $theme_text_domain ),
            'desc'	=> esc_html__( 'Enter the standard logo height', $theme_text_domain ),
        ),

        array(
            'id'		=> 'retina_logo_width',
            'type'		=> 'text',
            'default'	=> '',
            'title'		=> esc_html__( 'Standard Logo Width', $theme_text_domain ),
            'desc'	=> esc_html__( 'Enter the standard logo width', $theme_text_domain ),
        ),

        array(
            'id'        => 'retina_mobilelogo_height',
            'type'      => 'text',
            'default'   => '',
            'title'     => esc_html__( 'Mobile Logo Height', $theme_text_domain )
        ),

        array(
            'id'        => 'retina_mobilelogo_width',
            'type'      => 'text',
            'default'   => '',
            'title'     => esc_html__( 'Mobile Logo Width', $theme_text_domain )
        ),

        array(
            'id'	=> 'favicon',
            'url'			=> true,
            'type'		=> 'media',
            'title'		=> esc_html__( 'Favicon', $theme_text_domain ),
            'default'	=> array( 'url'	=> YANI_THEME_IMAGES . 'favicon.png' ),
            'subtitle'	=> esc_html__( 'Upload the favicon.', $theme_text_domain ),
        ),

        array(
            'id'		=> 'iphone_icon',
            'url'		=> true,
            'type'		=> 'media',
            'title'		=> esc_html__( 'Apple iPhone Icon ', $theme_text_domain ),
            'default'	=> array(
                'url'	=> YANI_THEME_IMAGES . 'favicon-57x57.png'
            ),
            'subtitle'	=> esc_html__( 'Upload the iPhone icon (57px by 57px).', $theme_text_domain ),
        ),

        array(
            'id'		=> 'iphone_icon_retina',
            'url'		=> true,
            'type'		=> 'media',
            'title'		=> esc_html__( 'Apple iPhone Retina Icon ', $theme_text_domain ),
            'default'	=> array(
                'url'	=> YANI_THEME_IMAGES . 'favicon-114x114.png'
            ),
            'subtitle'	=> esc_html__( 'Upload the iPhone retina icon (114px by 114px).', $theme_text_domain ),
        ),

        array(
            'id'		=> 'ipad_icon',
            'url'		=> true,
            'type'		=> 'media',
            'title'		=> esc_html__( 'Apple iPad Icon ', $theme_text_domain ),
            'default'	=> array(
                'url'	=> YANI_THEME_IMAGES . 'favicon-72x72.png'
            ),
            'subtitle'	=> esc_html__( 'Upload the iPad icon (72px by 72px).', $theme_text_domain ),
        ),

        array(
            'id'		=> 'ipad_icon_retina',
            'url'		=> true,
            'type'		=> 'media',
            'title'		=> esc_html__( 'Apple iPad Retina Icon ', $theme_text_domain ),
            'default'	=> array(
                'url'	=> YANI_THEME_IMAGES . 'favicon-144x144.png'
            ),
            'subtitle'	=> esc_html__( 'Upload the iPad retina icon (144px by 144px).', $theme_text_domain ),
        )
    ),
) );

Redux::setSection( $opt_name, array(
    'title'  => esc_html__( 'Lightbox Logo', $theme_text_domain ),
    'id'     => 'lightbox-logo-options',
    'desc'   => '',
    'subsection'   => true,
    'fields'        => array(
        array(
            'id'        => 'lightbox_logo',
            'url'       => true,
            'type'      => 'media',
            'title'     => esc_html__( 'Lightbox Logo', $theme_text_domain ),
            'read-only' => false,
            'default'   => array( 'url' => '' ),
            'subtitle'  => esc_html__( 'Upload logo for lightbox.', $theme_text_domain ),
        )
    ),
) );

Redux::setSection( $opt_name, array(
    'title'  => esc_html__( 'Dashboard Logo', $theme_text_domain ),
    'id'     => 'dashboard-logo-options',
    'desc'   => '',
    'subsection'   => true,
    'fields'        => array(
        array(
            'id'        => 'dashboard_logo',
            'url'       => true,
            'type'      => 'media',
            'title'     => esc_html__( 'Logo', $theme_text_domain ),
            'read-only' => false,
            'default'   => array( 'url' => YANI_THEME_IMAGES . 'logo-houzez-white.png' ),
            'desc'  => esc_html__( 'Upload the logo for dashboard', $theme_text_domain ),
        )
    ),
) );