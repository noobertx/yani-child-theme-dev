<?php
global $opt_name,$theme_text_domain;
Redux::setSection( $opt_name, array(
    'title'  => esc_html__( 'Banner Slider', $theme_text_domain ),
    'id'     => 'property-banner-slider',
    'desc'   => '',
    'fields' => array(
        array(
            'id'       => 'banner_slider_autoplay',
            'type'     => 'switch',
            'title'    => esc_html__( 'Auto Play', $theme_text_domain ),
            'subtitle' => '',
            'default'  => 1,
            'on'       => esc_html__( 'Yes', $theme_text_domain ),
            'off'      => esc_html__( 'No', $theme_text_domain ),
        ),
        array(
            'id'       => 'banner_slider_loop',
            'type'     => 'switch',
            'title'    => esc_html__( 'Loop', $theme_text_domain ),
            'subtitle' => '',
            'default'  => 1,
            'on'       => esc_html__( 'Yes', $theme_text_domain ),
            'off'      => esc_html__( 'No', $theme_text_domain ),
        ),
        array(
            'id'       => 'banner_slider_autoplayspeed',
            'type'     => 'text',
            'title'    => esc_html__( 'Auto Play Speed', $theme_text_domain ),
            'subtitle' => esc_html__( 'Enter auto play speed in milliseconds. Min value: 4000', $theme_text_domain ),
            'default'  => '4000',
            'validate' => 'numeric'
        ),
    )
));