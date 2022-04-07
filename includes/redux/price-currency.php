<?php
global $opt_name,$theme_text_domain, $allowed_html_array;
Redux::setSection( $opt_name, array(
    'title'  => esc_html__( 'Price & Currency', $theme_text_domain ),
    'id'     => 'price-format',
    'desc'   => '',
    'icon'   => 'el-icon-usd el-icon-small',
    'fields'		=> array(

        array(
            'id'       => 'multi_currency',
            'type'     => 'switch',
            'title'    => esc_html__( 'Multi-currency', $theme_text_domain ),
            'subtitle'     => esc_html__( 'Please note: the currency switcher will not work if this option is enabled', $theme_text_domain ),
            'desc' => esc_html__('Enable or disable multi-currency', $theme_text_domain),
            'default'  => 0,
            'on'       => esc_html__( 'Enabled', $theme_text_domain ),
            'off'      => esc_html__( 'Disabled', $theme_text_domain ),
        ),
        array(
            'id'       => 'default_multi_currency',
            'type'     => 'select',
            'title'    => esc_html__('Default Currency', $theme_text_domain ),
            'desc' => esc_html__('Select the default currency', $theme_text_domain),
            'required'  => array('multi_currency', '=', '1'),
            'default' => 'USD',
            'options'  => []//yani_available_currencies()
        ),
        array(
            'id'   => 'info_normal',
            'type' => 'info',
            'title'    => esc_html__( 'Info', $theme_text_domain ),
            'desc'     => wp_kses(__( '<a target="_blank" href="admin.php?page=yani_currencies">Add Currencies</a>', $theme_text_domain ), $allowed_html_array),
            'required'  => array('multi_currency', '=', '1'),
        ),
        array(
            'id'       => 'short_prices',
            'type'     => 'switch',
            'title'    => esc_html__( 'Short Price', $theme_text_domain ),
            'subtitle'     => esc_html__( 'Please note: the currency switcher will not work if the short price option is enabled', $theme_text_domain ),
            'desc' => esc_html__( 'Enable or disable the short price numbers like 12K, 10M, 10B.', $theme_text_domain ),
            'default'  => 0,
            'on'       => esc_html__( 'Enabled', $theme_text_domain ),
            'off'      => esc_html__( 'Disabled', $theme_text_domain ),
        ),
        array(
            'id'       => 'indian_format',
            'type'     => 'switch',
            'title'    => esc_html__( 'Indian Currency Format', $theme_text_domain ),
            'desc' => esc_html__( 'Enable or disable the Indian Currency format', $theme_text_domain ),
            'default'  => 0,
            'on'       => esc_html__( 'Enabled', $theme_text_domain ),
            'off'      => esc_html__( 'Disabled', $theme_text_domain ),
        ),
        array(
            'id'		=> 'currency_symbol',
            'type'		=> 'text',
            'title'		=> esc_html__( 'Currency Symbol', $theme_text_domain ),
            'read-only'	=> false,
            'default'	=> '$',
            'required'  => array('multi_currency', '=', '0'),
            'desc'	=> esc_html__( 'Enter the currency sign. (For Example: $)', $theme_text_domain ),
        ),
        array(
            'id'		=> 'currency_position',
            'type'		=> 'select',
            'title'		=> esc_html__( 'Currency Symbol Position', $theme_text_domain ),
            'read-only'	=> false,
            'required'  => array('multi_currency', '=', '0'),
            'options'	=> array(
                'before'	=> esc_html__( 'Before the price', $theme_text_domain ),
                'after'		=> esc_html__( 'After the price', $theme_text_domain )
            ),
            'default'	=> 'before',
            'subtitle'	=> '',
            'desc'  => esc_html__( 'Select the currency symbol position', $theme_text_domain ),
        ),
        array(
            'id'		=> 'decimals',
            'type'		=> 'select',
            'title'		=> esc_html__( 'Number of decimal points', $theme_text_domain ),
            'read-only'	=> false,
            'desc'  => esc_html__( 'Select the decimal points', $theme_text_domain ),
            //'required'  => array('multi_currency', '=', '0'),

            'required' => array( 
                array('multi_currency','=','0'), 
                array('indian_format','=','0') 
            ),

            'options'	=> array(
                '0'	=> '0',
                '1'	=> '1',
                '2'	=> '2',
                '3'	=> '3',
                '4'	=> '4',
                '5'	=> '5',
                '6'	=> '6',
                '7'	=> '7',
                '8'	=> '8',
                '9'	=> '9',
                '10' => '10',
            ),
            'default'	=> '0',
            'subtitle'	=> '',
        ),
        array(
            'id'		=> 'decimal_point_separator',
            'type'		=> 'text',
            'title'		=> esc_html__( 'Decimal Points Separator', $theme_text_domain ),
            'read-only'	=> false,
            //'required'  => array('multi_currency', '=', '0'),

            'required' => array( 
                array('multi_currency','=','0'), 
                array('indian_format','=','0') 
            ),
            'default'	=> '.',
            'desc'	=> esc_html__( 'Enter the decimal points separator (For Example: .)', $theme_text_domain ),
        ),
        array(
            'id'		=> 'thousands_separator',
            'type'		=> 'text',
            'title'		=> esc_html__( 'Thousands Separator', $theme_text_domain ),
            'read-only'	=> false,
            //'required'  => array('multi_currency', '=', '0'),

            'required' => array( 
                array('multi_currency','=','0'), 
                array('indian_format','=','0') 
            ),
            'default'	=> ',',
            'desc'	=> esc_html__( 'Enter the thousands separator (For Example: ,)', $theme_text_domain ),
        ),
        array(
            'id'        => 'currency_separator',
            'type'      => 'text',
            'title'     => esc_html__( 'Price Separator', $theme_text_domain ),
            'read-only' => false,
            'default'   => '/',
            'subtitle'  => '',
            'desc'  => esc_html__( 'Provide what you want to show between price and price label. Example: / or empty space', $theme_text_domain )
        ),
    ),
));