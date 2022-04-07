<?php
global $opt_name,$theme_text_domain, $allowed_html_array;
Redux::setSection( $opt_name, array(
    'title'  => esc_html__( 'Google reCaptcha', $theme_text_domain ),
    'id'     => 'google-recaptcha',
    'desc'   => '',
    'icon'   => 'el-icon-envelope el-icon-small',
    'fields'        => array(
        array(
            'id'       => 'enable_reCaptcha',
            'type'     => 'switch',
            'title'    => esc_html__( 'reCaptcha', $theme_text_domain ),
            'desc'     => esc_html__( 'Enable or disable Google reCaptcha on forms', $theme_text_domain ),
            'subtitle' => '',
            'default'  => 0,
            'on'       => esc_html__( 'Enabled', $theme_text_domain ),
            'off'      => esc_html__( 'Disabled', $theme_text_domain ),
        ),
        array(
            'id' => 'google_recaptcha_info',
            'type' => 'info',
            'title' => esc_html__('Google reCaptcha', $theme_text_domain),
            'style' => 'info',
            'desc' => __('<p>If you do not have keys already then visit <kbd>
            <a href = "https://www.google.com/recaptcha/admin">
                https://www.google.com/recaptcha/admin</a></kbd> to generate them.
        Set the respective keys in <kbd>Site Key</kbd> and
        <kbd>Secret Key</kbd></p>', $theme_text_domain),
            'required'  => array('enable_reCaptcha', '=', 1)
        ),
        array(
            'id'       => 'recaptha_type',
            'type'     => 'radio',
            'title'    => esc_html__( 'reCaptcha Version', $theme_text_domain ),
            'desc'     => esc_html__('Get new keys for V3 as V2 keys will not work!', $theme_text_domain),
            'options'  => array(
                'v2' => 'V2',
                'v3' => 'V3'
            ),
            'default'  => 'v2',
            'required'  => array('enable_reCaptcha', '=', 1)
        ),

        array(
            'id'       => 'recaptha_site_key',
            'type'     => 'text',
            'title'    => esc_html__( 'Site Key', $theme_text_domain ),
            'desc'     => esc_html__('Enter your Google reCaptha site key.', $theme_text_domain),
            'default'  => '',
            'required'  => array('enable_reCaptcha', '=', 1)
        ),

        array(
            'id'       => 'recaptha_secret_key',
            'type'     => 'text',
            'title'    => esc_html__( 'Secret Key', $theme_text_domain ),
            'desc'     => esc_html__('Enter your Google reCaptha Secret key.', $theme_text_domain),
            'default'  => '',
            'required'  => array('enable_reCaptcha', '=', 1)
        ),
    ),
));