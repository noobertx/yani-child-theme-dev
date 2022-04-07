<?php
global $opt_name,$theme_text_domain;

Redux::setSection( $opt_name, array(
    'title'            => esc_html__( 'Top Bar', $theme_text_domain ),
    'id'               => 'header-top-bar',
    'subsection'       => false,
    'desc'             => '',
    'fields'           => array(
        array(
            'id'       => 'top_bar',
            'type'     => 'switch',
            'title'    => esc_html__( 'Enable/Disable header top bar', $theme_text_domain ),
            'subtitle' => '',
            'default'  => 0,
            'on'       => esc_html__( 'Enabled', $theme_text_domain ),
            'off'      => esc_html__( 'Disabled', $theme_text_domain ),
        ),
        array(
            'id'       => 'top_bar_width',
            'type'     => 'select',
            'title'    => esc_html__( 'Layout', $theme_text_domain ),
            'subtitle' => '',
            'options'   => array(
                'container' => esc_html__( 'Boxed', $theme_text_domain ),
                'container-fluid'   => esc_html__( 'Full Width', $theme_text_domain )
            ),
            'desc'     => '',
            'default'  => 'container'// 1 = on | 0 = off
        ),
        array(
            'id'       => 'top_bar_mobile',
            'type'     => 'switch',
            'title'    => esc_html__( 'Hide Top Bar in Mobile?', $theme_text_domain ),
            'desc'     => '',
            'subtitle' => '',
            'default'  => 0,
            'on'       => esc_html__( 'Yes', $theme_text_domain ),
            'off'      => esc_html__( 'No', $theme_text_domain ),
        ),
        array(
            'id'       => 'top_bar_left',
            'type'     => 'select',
            'title'    => esc_html__( 'Top Bar Left Area', $theme_text_domain ),
            'subtitle' => esc_html__( 'What would you like to show on top bar left area.', $theme_text_domain ),
            'options'   => array(
                'none'   => esc_html__( 'Nothing', $theme_text_domain ),
                'menu_bar'    => esc_html__( 'Menu ( Create and assing menu under Appearance -> Menus )', $theme_text_domain ),
                'social_icons'    => esc_html__( 'Social Icons', $theme_text_domain ),
                'contact_info'    => esc_html__( 'Contact Info', $theme_text_domain ),
                'slogan'    => esc_html__( 'Slogan', $theme_text_domain ),
                'yani_switchers'    => esc_html__( 'Currency Switcher + Area Switcher', $theme_text_domain )
            ),
            'default'  => 'none'
        ),
        array(
            'id'       => 'top_bar_right',
            'type'     => 'select',
            'title'    => esc_html__( 'Top Bar Right Area', $theme_text_domain ),
            'subtitle' => esc_html__( 'What would you like to show on top bar right area.', $theme_text_domain ),
            'options'   => array(
                'none'   => esc_html__( 'Nothing', $theme_text_domain ),
                'menu_bar'    => esc_html__( 'Menu ( Create and assing menu under Appearance -> Menus )', $theme_text_domain ),
                'social_icons'    => esc_html__( 'Social Icons', $theme_text_domain ),
                'contact_info'    => esc_html__( 'Contact Info', $theme_text_domain ),
                'slogan'    => esc_html__( 'Slogan', $theme_text_domain ),
                'yani_switchers'    => esc_html__( 'Currency Switcher + Area Switcher', $theme_text_domain )
            ),
            'default'  => 'none'
        ),
        array(
            'id'        => 'top_bar_phone',
            'type'      => 'text',
            'default'   => '',
            'title'     => esc_html__( 'Phone Number', $theme_text_domain ),
            'subtitle'  => '',
        ),
        array(
            'id'        => 'top_bar_email',
            'type'      => 'text',
            'default'   => '',
            'title'     => esc_html__( 'Email Address', $theme_text_domain ),
            'subtitle'  => '',
        ),
        array(
            'id'        => 'top_bar_slogan',
            'type'      => 'textarea',
            'default'   => '',
            'title'     => esc_html__( 'Slogan', $theme_text_domain ),
            'subtitle'  => esc_html__( 'Enter website slogan', $theme_text_domain )
        )
    )
) );

// Currency Switcher
if ( class_exists( 'FCC_Rates' ) ) {    // if wp-currencies plugins is active

    // get all currency codes
    $currencies = FCC_Rates::get_currencies();
    $currency_codes = array();
    if ( 0 < count( $currencies ) ) {
        foreach( $currencies as $currency_code => $currency ) {
            $currency_codes[$currency_code] = $currency_code;
        }
    }

    Redux::setSection($opt_name, array(
        'title' => esc_html__('Currency Switcher', $theme_text_domain),
        'id' => 'currency-switcher',
        'desc' => '',
        'subsection' => true,
        'fields' => array(
            array(
                'id'       => 'currency_switcher_enable',
                'type'     => 'switch',
                'title'    => esc_html__( 'Enable/Disable currency switcher in top bar', $theme_text_domain ),
                'subtitle' => '',
                'default'  => 0,
                'on'       => esc_html__( 'Enabled', $theme_text_domain ),
                'off'      => esc_html__( 'Disabled', $theme_text_domain ),
            ),
            array(
                'id' => 'currency_switcher_info',
                'type' => 'info',
                'title' => esc_html__('Guide', $theme_text_domain),
                'style' => 'info',
                'desc' => __('Please find full list of available currencies at <a target="_blank" href="https://openexchangerates.org/currencies">https://openexchangerates.org/currencies</a><br/>Add api key under Houzez -> Currency Converter API', $theme_text_domain)
            ),
            array(
                'id' => 'yani_base_currency',
                'type' => 'select',
                'title' => esc_html__('Base Currency', $theme_text_domain),
                'subtitle' => esc_html__('Please select base currency which will use as base currency for all conversions.', $theme_text_domain),
                'read-only' => false,
                'options' => $currency_codes,
                'default' => 'USD'
            ),
            array(
                'id' => 'yani_supported_currencies',
                'type' => 'textarea',
                'title' => esc_html__('Your Supported Currencies.', $theme_text_domain),
                'subtitle' => esc_html__('Please provide comma separated currencies code in Capital Letters.', $theme_text_domain),
                'default' => 'AUD,CAD,CHF,EUR,GBP,HKD,JPY,NOK,SEK,USD,NGN'
            ),
            array(
                'id' => 'yani_currency_expiry',
                'title' => esc_html__('Expiry time',$theme_text_domain),
                'subtitle' => esc_html__('Select expiry time for selected currency.',$theme_text_domain),
                'default' => '3600',
                'type' => "radio",
                'options' => array(
                    '3600' => esc_html__('One Hour',$theme_text_domain),
                    '86400' => esc_html__('One Day',$theme_text_domain),
                    '604800' => esc_html__('One Week',$theme_text_domain),
                    '18144000' => esc_html__('One Month',$theme_text_domain),
                )
            )
        ),
    ));
}

Redux::setSection($opt_name, array(
    'title' => esc_html__('Area Switcher', $theme_text_domain),
    'id' => 'area-switcher',
    'desc' => '',
    'subsection' => true,
    'fields' => array(
        array(
            'id'       => 'area_switcher_enable',
            'type'     => 'switch',
            'title'    => esc_html__( 'Enable/Disable area switcher in top bar', $theme_text_domain ),
            'subtitle' => '',
            'default'  => 0,
            'on'       => esc_html__( 'Enabled', $theme_text_domain ),
            'off'      => esc_html__( 'Disabled', $theme_text_domain ),
        ),

        array(
            'id' => 'yani_base_area',
            'type' => 'select',
            'title' => esc_html__('Base Area', $theme_text_domain),
            'subtitle' => esc_html__('Selected area will be used as base area for all conversions.', $theme_text_domain),
            'read-only' => false,
            'options' => array(
                'sqft' => esc_html( 'Square Feet', $theme_text_domain ),
                'sq_meter' => esc_html( 'Square Meters', $theme_text_domain )
            ),
            'default' => 'sqft'
        )
    ),
));
?>