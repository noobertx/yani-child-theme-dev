<?php
global $opt_name,$theme_text_domain;

$search_builder = array(
    'keyword' => esc_html__('Keyword', $theme_text_domain ),
    'city' => esc_html__('Cities', $theme_text_domain ),
    'areas' => esc_html__('Areas', $theme_text_domain ),
    'status' => esc_html__('Status', $theme_text_domain ),
    'type' => esc_html__('Type', $theme_text_domain ),
    'bedrooms' => esc_html__('Bedrooms', $theme_text_domain ),
    'bathrooms' => esc_html__('Bathrooms', $theme_text_domain ),
    'min-area' => esc_html__('Min. Area', $theme_text_domain ),
    'max-area' => esc_html__('Max. Area', $theme_text_domain ),
    'min-price' => esc_html__('Min. Price', $theme_text_domain ),
    'max-price' => esc_html__('Max. Price', $theme_text_domain ),
    'property-id' => esc_html__('Property ID', $theme_text_domain ),
    'label' => esc_html__('Label', $theme_text_domain ),
    'price' => esc_html__('Price (Only Search v.3)', $theme_text_domain ),
);

$search_builder_disabled = array(
    'rooms' => esc_html__('Rooms',  $theme_text_domain ),
    'country' => esc_html__('Countries',  $theme_text_domain ),
    'state' => esc_html__('States',  $theme_text_domain ),
    'geolocation' => esc_html__('Geolocation',  $theme_text_domain ),
    'min-land-area' => esc_html__('Min. Land Area',  $theme_text_domain ),
    'max-land-area' => esc_html__('Max. Land Area',  $theme_text_domain ),
    'garage' => esc_html__('Garage',  $theme_text_domain ),
    'year-built' => esc_html__('Year Built',  $theme_text_domain ),
);


Redux::setSection( $opt_name, array(
    'title'            => esc_html__( 'Header Search', $theme_text_domain ),
    'id'               => 'header-search',
    'subsection'       => true,
    'desc'             => '',
    'fields'           => array(
        array(
            'id'       => 'main-search-enable',
            'type'     => 'switch',
            'title'    => esc_html__( 'Enable/Disable Search', $theme_text_domain ),
            'desc'    => esc_html__( 'Enable or disable the search bar below the navigation bar', $theme_text_domain ),
            'subtitle' => '',
            'default'  => 0,
            'on'       => esc_html__( 'Enabled', $theme_text_domain ),
            'off'      => esc_html__( 'Disabled', $theme_text_domain ),
        ),
        array(
            'id'       => 'search_style',
            'type'     => 'image_select',
            'required' => array( 'main-search-enable', '=', '1' ),
            'title'    => esc_html__( 'Search Style', $theme_text_domain ),
            'subtitle' => '',
            'options'  => array(),
            // 'options'  => array(
            //     'style_1' => array(
            //         'alt' => '',
            //         'img' => YANI_THEME_IMAGES . 'search/search-v1.png'
            //     ),
            //     'style_2' => array(
            //         'alt' => '',
            //         'img' => YANI_THEME_IMAGES . 'search/search-v2.png'
            //     ),
            //     'style_3' => array(
            //         'alt' => '',
            //         'img' => YANI_THEME_IMAGES . 'search/search-v3.png'
            //     ),
                
            // ),
            'desc'     => esc_html__('Select search style', $theme_text_domain),
            'default'  => 'style_1'
        ),
        array(
            'id'       => 'search_width',
            'type'     => 'select',
            'required' => array( 'main-search-enable', '=', '1' ),
            'title'    => esc_html__( 'Search Layout', $theme_text_domain ),
            'subtitle' => '',
            'options'   => array(
                'container' => esc_html__( 'Boxed', $theme_text_domain ),
                'container-fluid'  => esc_html__( 'Full Width', $theme_text_domain )
            ),
            'desc'     => esc_html__('Select the search layout', $theme_text_domain),
            'default'  => 'container'
        ),
        array(
            'id'       => 'search_position',
            'type'     => 'select',
            'required' => array( 'main-search-enable', '=', '1' ),
            'title'    => esc_html__( 'Search Position', $theme_text_domain ),
            'subtitle' => '',
            'options'   => array(
                'under_nav' => esc_html__( 'Under Navigation', $theme_text_domain ),
                'under_banner'  => esc_html__( 'Under banner ( Slider, Map etc )', $theme_text_domain )
            ),
            'desc'     => esc_html__('Select the search position', $theme_text_domain),
            'default'  => 'under_nav'
        ),
        array(
            'id'       => 'search_pages',
            'type'     => 'select',
            'required' => array( 'main-search-enable', '=', '1' ),
            'title'    => esc_html__( 'Search Pages', $theme_text_domain ),
            'subtitle' => '',
            'options'   => array(
                'only_home' => esc_html__( 'Only Homepage', $theme_text_domain ),
                'all_pages' => esc_html__( 'Homepage + Inner Pages', $theme_text_domain ),
                'only_innerpages' => esc_html__( 'Only Inner Pages', $theme_text_domain ),
                'specific_pages' => esc_html__( 'Specific Pages', $theme_text_domain )
            ),
            'desc'     => esc_html__('Select on which pages you want to display the search', $theme_text_domain),
            'default'  => 'all_pages'
        ),
        array(
            'id'       => 'header_search_selected_pages',
            'type'     => 'select',
            'multi'    => true,
            'required' => array('search_pages', '=', 'specific_pages'),
            'title'    => __('Specify Pages', $theme_text_domain),
            'desc' => __('Specify which pages have to display the search. You can select multiple pages', $theme_text_domain),
            'data' => 'pages',
        ),
        array(
            'id'       => 'single_prop_search',
            'type'     => 'switch',
            'title'    => esc_html__( 'Property Detail Page', $theme_text_domain ),
            'subtitle' => esc_html__( 'Enable or disable advnaced search on propery detail page.', $theme_text_domain ),
            'desc'     => '',
            'default'  => 0,
            'on'       => esc_html__( 'Enabled', $theme_text_domain ),
            'off'      => esc_html__( 'Disabled', $theme_text_domain ),
        ),
        array(
            'id'       => 'is_tax_page',
            'type'     => 'switch',
            'title'    => esc_html__( 'Taxonomy Pages', $theme_text_domain ),
            'subtitle' => esc_html__( 'Enable or disable advnaced search on taxonomy pages.', $theme_text_domain ),
            'desc'     => '',
            'default'  => 1,
            'required' => array( 'search_pages', '!=', 'specific_pages' ),
            'on'       => esc_html__( 'Enabled', $theme_text_domain ),
            'off'      => esc_html__( 'Disabled', $theme_text_domain ),
        ),
        array(
            'id'       => 'single_agent_search',
            'type'     => 'switch',
            'title'    => esc_html__( 'Agent & Agency Page', $theme_text_domain ),
            'subtitle' => esc_html__( 'Enable or disable search on agent & agency page.', $theme_text_domain ),
            'desc'     => '',
            'default'  => 0,
            'on'       => esc_html__( 'Enabled', $theme_text_domain ),
            'off'      => esc_html__( 'Disabled', $theme_text_domain ),
        ),
        array(
            'id'       => 'search_top_row_fields',
            'type'     => 'select',
            'title'    => esc_html__( 'Top Row Fields', $theme_text_domain ),
            'subtitle' => esc_html__( 'Number of fields to show in search top row', $theme_text_domain ),
            'options'   => array(
                '1' => esc_html__( 'One', $theme_text_domain ),
                '2' => esc_html__( 'Two', $theme_text_domain ),
                '3' => esc_html__( 'Three', $theme_text_domain ),
                '4' => esc_html__( 'Four', $theme_text_domain ),
                '5' => esc_html__( 'Five', $theme_text_domain )
            ),
            'desc'     => '',
            'default'  => '3'
        ),
        array(
            'id'      => 'search_builder',
            'type'    => 'sorter',
            'title'   => 'Search Builder',
            'subtitle'    => 'Drag and drop search manager, to quickly organize your search fields.',
            'options' => array(
                'enabled'  => $search_builder,
                'disabled' => $search_builder_disabled
            ),
        ),
        array(
            'id'       => 'enable_radius_search',
            'type'     => 'switch',
            'title'    => esc_html__( 'Enable Radius Search.', $theme_text_domain ),
            //'desc'     => '',
            'desc' => esc_html__('Enable or disable the advanced search radius search', $theme_text_domain),
            'default'  => 0,
            'on'       => esc_html__( 'Enable', $theme_text_domain ),
            'off'      => esc_html__( 'Disable', $theme_text_domain ),
        ),
        
        array(
            'id'       => 'price_range',
            'type'     => 'switch',
            'title'    => esc_html__( 'Price Range Slider', $theme_text_domain ),
            'subtitle'     => esc_html__('If enabled, min and max price dropdown fields will not show', $theme_text_domain),
            'desc' => esc_html__('Enable or disable the price range slider', $theme_text_domain),
            'default'  => 0,
            'on'       => esc_html__( 'Enabled', $theme_text_domain ),
            'off'      => esc_html__( 'Disabled', $theme_text_domain ),
        ),

        array(
            'id'       => 'price_range_mobile',
            'type'     => 'switch',
            'title'    => esc_html__( 'Price Range Slider for Mobile', $theme_text_domain ),
            'subtitle'     => esc_html__('If enabled, min and max price dropdown fields will not show', $theme_text_domain),
            'desc' => esc_html__('Enable or disable the price range slider', $theme_text_domain),
            'default'  => 1,
            'on'       => esc_html__( 'Enabled', $theme_text_domain ),
            'off'      => esc_html__( 'Disabled', $theme_text_domain ),
        ),

        array(
            'id'       => 'search_other_features',
            'type'     => 'switch',
            'title'    => esc_html__( 'Other Features', $theme_text_domain ),
            //'desc'     => '',
            'desc' => esc_html__('Enable or disable other features in searches', $theme_text_domain),
            'default'  => 0,
            'on'       => esc_html__( 'Enabled', $theme_text_domain ),
            'off'      => esc_html__( 'Disabled', $theme_text_domain ),
        ),

        array(
            'id'       => 'search_other_features_mobile',
            'type'     => 'switch',
            'title'    => esc_html__( 'Other Features for Mobile', $theme_text_domain ),
            //'desc'     => '',
            'desc' => esc_html__('Enable or disable other features in searches', $theme_text_domain),
            'default'  => 0,
            'on'       => esc_html__( 'Enabled', $theme_text_domain ),
            'off'      => esc_html__( 'Disabled', $theme_text_domain ),
        ),
        array(
            'id'       => 'header-search-visible',
            'type'     => 'switch',
            'required' => array( 'main-search-enable', '=', '1' ),
            'title'    => esc_html__( 'Advanced Filters Visible', $theme_text_domain ),
            'subtitle' => esc_html__( 'Use this option to keep the advanced search filters always visible', $theme_text_domain ),
            'desc'     => esc_html__('Note: If "Yes" it will remove advanced button in search and show all filters', $theme_text_domain),
            'default'  => 0,
            'on'       => esc_html__( 'Yes', $theme_text_domain ),
            'off'      => esc_html__( 'No', $theme_text_domain ),
        ),
        array(
            'id'       => 'main-search-sticky',
            'type'     => 'switch',
            'required' => array( 'header-search-visible', '=', '0' ),
            'title'    => esc_html__( 'Sticky Advanced Search - Desktop', $theme_text_domain ),
            'desc' => esc_html__( 'Enable or disable the advanced sticky search', $theme_text_domain ),
            'subtitle'     => esc_html__('Note: It will only work when the main menu sticky is disabled', $theme_text_domain),
            'default'  => 0,
            'on'       => esc_html__( 'Enabled', $theme_text_domain ),
            'off'      => esc_html__( 'Disabled', $theme_text_domain ),
        ),
        array(
            'id'       => 'mobile-search-sticky',
            'type'     => 'switch',
            'required' => array( 'main-search-enable', '=', '1' ),
            'title'    => esc_html__( 'Sticky Advanced Search - Mobile', $theme_text_domain ),
            'desc' => esc_html__( 'Enable or disable the advanced sticky search on mobile devices', $theme_text_domain ),
            'subtitle'     => esc_html__('Note: It will only work when the main menu sticky is disabled', $theme_text_domain),
            'default'  => 0,
            'on'       => esc_html__( 'Enabled', $theme_text_domain ),
            'off'      => esc_html__( 'Disabled', $theme_text_domain ),
        ),
    )
) );

Redux::setSection( $opt_name, array(
    'title'  => esc_html__( 'Settings', $theme_text_domain ),
    'id'     => 'adv-search-settings',
    'desc'   => '',
    'subsection' => true,
    'fields' => array(
        array(
            'id'       => 'keyword_field',
            'type'     => 'select',
            'title'    => __('Keyword Field', $theme_text_domain),
            'desc' => __('Select the search criteria for the keyword field', $theme_text_domain),
            'options'  => array(
                'prop_title' => esc_html__('Property Title or Content', $theme_text_domain),
                'prop_address' => esc_html__('Property address, street, zip or property ID', $theme_text_domain),
                'prop_city_state_county' => esc_html__('Search State, City or Area', $theme_text_domain),
            ),
            'default' => 'prop_address'
        ),
        array(
            'id'       => 'keyword_autocomplete',
            'type'     => 'switch',
            'title'    => esc_html__( 'Auto Complete', $theme_text_domain ),
            //'desc'     => '',
            'desc' => esc_html__('Enable or disable the auto complete functionality for the keyword field', $theme_text_domain),
            'default'  => 0,
            'on'       => esc_html__( 'Enable', $theme_text_domain ),
            'off'      => esc_html__( 'Disable', $theme_text_domain ),
        ),
        array(
            'id'       => 'beds_baths_search',
            'type'     => 'select',
            'title'    => esc_html__( 'Bedrooms, Rooms, Bathrooms', $theme_text_domain ),
            'desc'    => esc_html__( 'Select the search criteria for bedrooms, Rooms and bathrooms', $theme_text_domain ),
            //'desc'     => '',
            'options'  => array(
                'equal' => esc_html__('Equal', $theme_text_domain),
                'greater' => esc_html__('Greater', $theme_text_domain),
                'like' => esc_html__('Like', $theme_text_domain),
            ),
            'default' => 'equal'
        ),
        array(
            'id'       => 'state_city_area_dropdowns',
            'type'     => 'switch',
            'title'    => esc_html__( 'State, City, Area dropdowns.', $theme_text_domain ),
            //'desc'     => '',
            'desc' => esc_html__('Do you want to display the States, Cities, Areas fields if they have at least 1 property?', $theme_text_domain),
            'default'  => 0,
            'on'       => esc_html__( 'Yes', $theme_text_domain ),
            'off'      => esc_html__( 'Show All', $theme_text_domain ),
        ),

        array(
            'id'       => 'price_field_type',
            'type'     => 'button_set',
            'title'    => __('Price Field Type', $theme_text_domain),
            'subtitle' => '',
            'desc'     => '',
            'options' => array(
                'input' => esc_html__('Input Field', $theme_text_domain), 
                'select' => esc_html__('Select Field', $theme_text_domain), 
             ), 
            'default' => 'select'
        ),

        array(
            'id'          => 'search_exclude_status',
            'type'        => 'select',
            'title'       => esc_html__( 'Exclude Statuses', $theme_text_domain ),
            'subtitle'    => esc_html__( 'Which statuses would you like to exclude from searches?', $theme_text_domain ),
            'multi'       => true,
            'data'        => 'terms',
            'args'  => array(
                'taxonomy' => array( 'property_status' ),
                'hide_empty' => false,
            )
        ),

        array(
            'id'       => 'ms_section-start',
            'type'     => 'section',
            'title'    => esc_html__( 'Multi Selection', $theme_text_domain ),
            'subtitle' => '',
            'indent'   => true,
        ),

        array(
            'id'       => 'ms_type',
            'type'     => 'switch',
            'title'    => esc_html__( 'Type', $theme_text_domain ),
            'desc'     => '',
            'subtitle' => esc_html__('Show multi-select for property type', $theme_text_domain),
            'default'  => 1,
            'on'       => esc_html__( 'Yes', $theme_text_domain ),
            'off'      => esc_html__( 'No', $theme_text_domain ),
        ),

        array(
            'id'       => 'ms_status',
            'type'     => 'switch',
            'title'    => esc_html__( 'Status', $theme_text_domain ),
            'desc'     => '',
            'subtitle' => esc_html__('Show multi-select for property status', $theme_text_domain),
            'default'  => 0,
            'on'       => esc_html__( 'Yes', $theme_text_domain ),
            'off'      => esc_html__( 'No', $theme_text_domain ),
        ),

        array(
            'id'       => 'ms_label',
            'type'     => 'switch',
            'title'    => esc_html__( 'Label', $theme_text_domain ),
            'desc'     => '',
            'subtitle' => esc_html__('Show multi-select for property label', $theme_text_domain),
            'default'  => 0,
            'on'       => esc_html__( 'Yes', $theme_text_domain ),
            'off'      => esc_html__( 'No', $theme_text_domain ),
        ),

        /*array(
            'id'       => 'ms_city',
            'type'     => 'switch',
            'title'    => esc_html__( 'City', $theme_text_domain ),
            'desc'     => '',
            'subtitle' => esc_html__('Show multi-select for property city', $theme_text_domain),
            'default'  => 0,
            'on'       => esc_html__( 'Yes', $theme_text_domain ),
            'off'      => esc_html__( 'No', $theme_text_domain ),
        ),*/

        array(
            'id'       => 'ms_area',
            'type'     => 'switch',
            'title'    => esc_html__( 'Area', $theme_text_domain ),
            'desc'     => '',
            'subtitle' => esc_html__('Show multi-select for property Area', $theme_text_domain),
            'default'  => 1,
            'on'       => esc_html__( 'Yes', $theme_text_domain ),
            'off'      => esc_html__( 'No', $theme_text_domain ),
        ),

        array(
            'id'     => 'ms_section_end',
            'type'   => 'section',
            'indent' => false,
        ),

        array(
            'id' => 'yani_default_radius',
            'type' => 'slider',
            'title' => __('Default Radius', $theme_text_domain),
            'desc' => __('Setup the default distance', $theme_text_domain),
            //'desc' => '',
            "default" => 50,
            "min" => 0,
            "step" => 1,
            "max" => 100,
            'display_value' => ''
        ),
        array(
            'id'       => 'radius_unit',
            'type'     => 'select',
            'title'    => __('Radius Unit', $theme_text_domain),
            'desc' => __('Select the distance unit', $theme_text_domain),
            'description' => '',
            'options'  => array(
                'km' => 'km',
                'mi' => 'mi'
            ),
            'default' => 'km'
        ),

        array(
            'id'       => 'features_limit',
            'type'     => 'text',
            'title'    => esc_html__('Features Limit', $theme_text_domain),
            'desc' => esc_html__('Enter the number of features to show in the advanced search. Note: enter -1 to display them all.', $theme_text_domain),
            //'desc'     => '',
            'default'  => '-1',
        ),
        array(
            'id'       => 'enable_disable_save_search',
            'type'     => 'switch',
            'title'    => esc_html__( 'Save Search Button', $theme_text_domain ),
            'subtitle'     => '',
            'desc' => esc_html__('Enable the save search button option on search result page', $theme_text_domain),
            'default'  => 1,
            'on'       => esc_html__( 'Yes', $theme_text_domain ),
            'off'      => esc_html__( 'No', $theme_text_domain ),
        ),
        array(
            'id'       => 'save_search_duration',
            'type'     => 'select',
            'title'    => esc_html__('Send Emails', $theme_text_domain),
            'subtitle' => 'If a customer saved a search result, he will receive periodic updates if new proprties will match his search criteria',
            'desc'     => 'Select when you want to send the emails related to saved searches',
            'required' => array( 'enable_disable_save_search', '=', '1' ),
            'options'  => array(
                'daily'   => esc_html__( 'Daily', $theme_text_domain ),
                'weekly'   => esc_html__( 'weekly', $theme_text_domain )
            ),
            'default'  => 'daily',
        ),
        array(
            'id'        => 'min_price',
            'type'      => 'textarea',
            'title'     => esc_html__( 'Minimum Prices List for Advance Search Form', $theme_text_domain ),
            'read-only' => false,
            'default'   => '1000, 5000, 10000, 50000, 100000, 200000, 300000, 400000, 500000, 600000, 700000, 800000, 900000, 1000000, 1500000, 2000000, 2500000, 5000000',
            'subtitle'  => esc_html__( 'Only provide comma separated numbers. Do not add decimal points, dashes, spaces and currency signs.', $theme_text_domain ),
            'validate' => 'comma_numeric'
        ),
        array(
            'id'        => 'max_price',
            'type'      => 'textarea',
            'title'     => esc_html__( 'Maximum Prices List for Advance Search Form', $theme_text_domain ),
            'read-only' => false,
            'default'   => '5000, 10000, 50000, 100000, 200000, 300000, 400000, 500000, 600000, 700000, 800000, 900000, 1000000, 1500000, 2000000, 2500000, 5000000, 10000000',
            'subtitle'  => esc_html__( 'Only provide comma separated numbers. Do not add decimal points, dashes, spaces and currency signs.', $theme_text_domain ),
            'validate' => 'comma_numeric'
        ),
        array(
            'id'     => 'rentPrice-info',
            'type'   => 'info',
            'notice' => false,
            'style'  => 'info',
            'title'  => wp_kses(__( '<span class="font24">Rent Prices.</span>', $theme_text_domain ), $allowed_html_array),
            'desc'   => esc_html__( 'Visitors expect smaller values for rent prices, So please provide the list of minimum and maximum rent prices below', $theme_text_domain )
        ),
        array(
            'id'          => 'search_rent_status',
            'type'        => 'select',
            'title'       => esc_html__( 'Select the Appropriate Rent Status', $theme_text_domain ),
            'subtitle'    => esc_html__( 'The rent prices will be displayed based on selected status.', $theme_text_domain ),
            'desc'        => '',
            'data'        => 'terms',
            'args'  => array(
                'taxonomy' => array( 'property_status' ),
                'hide_empty' => false,
            )
        ),

        array(
            'id'        => 'min_price_rent',
            'type'      => 'textarea',
            'title'     => esc_html__( 'Minimum Prices List for Rent Only', $theme_text_domain ),
            'read-only' => false,
            'default'   => '500, 1000, 2000, 3000, 4000, 5000, 7500, 10000, 15000, 20000, 25000, 30000, 40000, 50000, 75000, 100000',
            'subtitle'  => esc_html__( 'Only provide comma separated numbers. Do not add decimal points, dashes, spaces and currency signs.', $theme_text_domain ),
            'validate' => 'comma_numeric'
        ),
        array(
            'id'        => 'max_price_rent',
            'type'      => 'textarea',
            'title'     => esc_html__( 'Maximum Prices List for Rent Only', $theme_text_domain ),
            'read-only' => false,
            'default'   => '1000, 2000, 3000, 4000, 5000, 7500, 10000, 15000, 20000, 25000, 30000, 40000, 50000, 75000, 100000, 150000',
            'subtitle'  => esc_html__( 'Only provide comma separated numbers. Do not add decimal points, dashes, spaces and currency signs.', $theme_text_domain ),
            'validate' => 'comma_numeric'
        ),
        array(
            'id'     => 'advanced-search-widget-priceRang-info',
            'type'   => 'info',
            'notice' => false,
            'style'  => 'info',
            'title'  => __( '<span class="font24">Advanced Search Price range for price slider.</span>', $theme_text_domain ),
            'desc'   => ''
        ),
        array(
            'id'        => 'advanced_search_widget_min_price',
            'type'      => 'text',
            'title'     => esc_html__( 'Minimum Price', $theme_text_domain ),
            'desc'     => esc_html__( 'Enter the minimum price', $theme_text_domain ),
            'read-only' => false,
            'default'   => '200',
            'subtitle'  => '',
            'validate' => 'numeric'
        ),
        array(
            'id'        => 'advanced_search_widget_max_price',
            'type'      => 'text',
            'title'     => esc_html__( 'Maximum Price', $theme_text_domain ),
            'desc'     => esc_html__( 'Enter the maximum price', $theme_text_domain ),
            'read-only' => false,
            'default'   => '2500000',
            'subtitle'  => '',
            'validate' => 'numeric'
        ),
        array(
            'id'          => 'search_rent_status_for_price_range',
            'type'        => 'select',
            'title'       => esc_html__( 'Select the Appropriate Rent Status', $theme_text_domain ),
            'subtitle'    => esc_html__( 'The rent prices will be displayed based on selected status.', $theme_text_domain ),
            'desc'        => '',
            'data'  => 'terms',
            'args'  => array(
                'taxonomy' => array( 'property_status' ),
                'hide_empty' => false,
            )
        ),
        array(
            'id'        => 'advanced_search_min_price_range_for_rent',
            'type'      => 'text',
            'title'     => esc_html__( 'Minimum Price For Rent Only', $theme_text_domain ),
            'desc'     => esc_html__( 'Enter the minimum price', $theme_text_domain ),
            'read-only' => false,
            'default'   => '50',
            'subtitle'  => '',
            'validate' => 'numeric'
        ),
        array(
            'id'        => 'advanced_search_max_price_range_for_rent',
            'type'      => 'text',
            'title'     => esc_html__( 'Maximum Price For Rent Only', $theme_text_domain ),
            'desc'     => esc_html__( 'Enter the maximum price', $theme_text_domain ),
            'read-only' => false,
            'default'   => '25000',
            'subtitle'  => '',
            'validate' => 'numeric'
        ),

        array(
            'id'     => 'beds-baths-info',
            'type'   => 'info',
            'notice' => false,
            'style'  => 'info',
            'title'  => wp_kses(__( '<span class="font24">Bedrooms & Bathrooms</span>', $theme_text_domain ), $allowed_html_array),
            'desc'   => ''
        ),
        array(
            'id'        => 'adv_beds_list',
            'type'      => 'textarea',
            'title'     => esc_html__( 'Bedrooms List', $theme_text_domain ),
            'read-only' => false,
            'default'   => '1,2,3,4,5,6,7,8,9,10',
            'subtitle'  => esc_html__( 'Only provide comma separated numbers. Do not add dashes, spaces and currency signs.', $theme_text_domain ),
            //'validate' => 'comma_numeric'
        ),
        array(
            'id'        => 'adv_rooms_list',
            'type'      => 'textarea',
            'title'     => esc_html__( 'Rooms List', $theme_text_domain ),
            'read-only' => false,
            'default'   => '1,2,3,4,5,6,7,8,9,10',
            'subtitle'  => esc_html__( 'Only provide comma separated numbers. Do not add dashes, spaces and currency signs.', $theme_text_domain ),
            //'validate' => 'comma_numeric'
        ),
        array(
            'id'        => 'adv_baths_list',
            'type'      => 'textarea',
            'title'     => esc_html__( 'Bathrooms List', $theme_text_domain ),
            'read-only' => false,
            'default'   => '1,2,3,4,5,6,7,8,9,10',
            'subtitle'  => esc_html__( 'Only provide comma separated numbers. Do not add dashes, spaces and currency signs.', $theme_text_domain ),
            //'validate' => 'comma_numeric'
        )
    )
));

Redux::setSection( $opt_name, array(
    'title'  => esc_html__( 'Search Results Page',  $theme_text_domain  ),
    'id'     => 'adv-search-resultpage',
    'icon'   => 'el-icon-search el-icon-small',
    'desc'   => '',
    'subsection' => false,
    'fields' => array(
        array(
            'id'       => 'search_result_page',
            'type'     => 'select',
            'title'    => __('Search Reslt Page',  $theme_text_domain ),
            'desc' => __('Create this page using "Search Results" template',  $theme_text_domain ),
            'options'  => array(
                'normal_page' => 'Normal Page',
                'half_map' => 'Half Map'
            ),
            'default' => 'normal_page'
        ),
        
        array(
            'id'       => 'search_result_layout',
            'type'     => 'image_select',
            'required' => array( 'search_result_page', '=', 'normal_page' ),
            'title'    => __('Search Result Page Layout',  $theme_text_domain ),
            'subtitle' => __('Select the layout for search result page.',  $theme_text_domain ),
            'options'  => array(
                'no-sidebar' => array(
                    'alt'   => '',
                    'img'   => ReduxFramework::$_url.'assets/img/1c.png'
                ),
                'left-sidebar' => array(
                    'alt'   => '',
                    'img'   => ReduxFramework::$_url.'assets/img/2cl.png'
                ),
                'right-sidebar' => array(
                    'alt'   => '',
                    'img'  => ReduxFramework::$_url.'assets/img/2cr.png'
                )
            ),
            'default' => 'right-sidebar'
        ),
        array(
            'id'       => 'search_result_posts_layout',
            'type'     => 'select',
            'title'    => __('Properties Layout',  $theme_text_domain ),
            'desc' => __('Select the properties layout for search result page.',  $theme_text_domain ),
            'options'  => array(
                'Listings Version 1' => array(
                    'list-view-v1' => 'List View',
                    'grid-view-v1' => 'Grid View',
                ),
                'Listings Version 2' => array(
                    'list-view-v2' => 'List View',
                    'grid-view-v2' => 'Grid View',
                ),
                'grid-view-v3' => 'Grid View v3',
                'grid-view-v4' => 'Grid View v4',
                'Listings Version 5' => array(
                    'list-view-v5' => 'List View',
                    'grid-view-v5' => 'Grid View',
                ),
                'grid-view-v6' => 'Grid View v6',
            ),
            'default' => 'list-view-v1'
        ),

        array(
            'id'       => 'search_default_order',
            'type'     => 'select',
            'title'    => __('Default Order',  $theme_text_domain ),
            'desc' => __('Select the results page properties order.',  $theme_text_domain ),
            'options'  => array(
                '' => esc_html__( 'Default Order',  $theme_text_domain  ),
                'd_date' => esc_html__( 'Date New to Old',  $theme_text_domain  ),
                'a_date' => esc_html__( 'Date Old to New',  $theme_text_domain  ),
                'd_price' => esc_html__( 'Price (High to Low)',  $theme_text_domain  ),
                'a_price' => esc_html__( 'Price (Low to High)',  $theme_text_domain  ),
                'featured_first' => esc_html__( 'Show Featured Listings on Top',  $theme_text_domain  ),
            ),
            'default' => ''
        ),

        array(
            'id'       => 'search_num_posts',
            'type'     => 'text',
            'title'    => esc_html__('Number of Listings',  $theme_text_domain ),
            'desc'    => esc_html__('Enter the number of listings to display on the search result page',  $theme_text_domain ),
            'subtitle' => '',
            //'desc'     => '',
            'default'  => '9',
        ),
    )
));

/*-------------------------------------------------------------------------------
* Dock Search 
*------------------------------------------------------------------------------*/
$dock_search_builder = $search_builder;
$dock_search_builder_disabled = $search_builder_disabled;
unset($dock_search_builder['price']);

Redux::setSection( $opt_name, array(
    'title'            => esc_html__( 'Dock Search', $theme_text_domain ),
    'id'               => 'dock-search',
    'subsection'       => true,
    'desc'             => '',
    'fields'           => array(
        array(
            'id'       => 'enable_advanced_search_over_headers',
            'type'     => 'switch',
            'title'    => esc_html__( 'Advanced Search Panel', $theme_text_domain ),
            'desc' => esc_html__('Enable or disable the advanced search panel over the header type like Header Map, Revolution Slider, Image, Property Slider and Video.', $theme_text_domain),
            'default'  => 0,
            'on'       => esc_html__( 'Yes', $theme_text_domain ),
            'off'      => esc_html__( 'No', $theme_text_domain ),
        ),

        array(
            'id'       => 'adv_search_which_header_show',
            'type'     => 'checkbox',
            'required' => array('enable_advanced_search_over_headers', '=', '1'),
            'title'    => esc_html__( 'Choose Header Type', $theme_text_domain ),
            'desc'     => '',
            'subtitle' => esc_html__('Choose on which header type you want to show the advanced search panel', $theme_text_domain),
            'options'  => array(
                'header_map' => 'Header with google map',
                'header_video' => 'Header Video',
                'header_image' => 'Header Parallax Image',
                'header_rs' => 'Header Revolution Slider',
                'header_ps' => 'Header Properties Slider'
            ),
            'default' => array(
                'header_map' => '1',
                'header_video' => '0',
                'header_image' => '0',
                'header_rs' => '0',
                'header_ps' => '0'
            )
        ),
        array(
            'id'       => 'adv_search_over_header_pages',
            'type'     => 'select',
            'title'    => esc_html__( 'Search Pages', $theme_text_domain ),
            'subtitle' => '',
            'options'   => array(
                'only_home' => esc_html__( 'Only Homepage', $theme_text_domain ),
                'all_pages' => esc_html__( 'Homepage + Inner Pages', $theme_text_domain ),
                'only_innerpages' => esc_html__( 'Only Inner Pages', $theme_text_domain ),
                'specific_pages' => esc_html__( 'Specific Pages', $theme_text_domain )
            ),
            'desc'     => esc_html__('Select on which pages you want to display the search', $theme_text_domain),
            'default'  => 'only_home'
        ),
        array(
            'id'       => 'adv_search_selected_pages',
            'type'     => 'select',
            'multi'    => true,
            'required' => array('adv_search_over_header_pages', '=', 'specific_pages'),
            'title'    => __('Select Pages', $theme_text_domain),
            'subtitle' => __('You can select multiple pages', $theme_text_domain),
            'desc'     => '',
            'data' => 'pages',
        ),
        array(
            'id'       => 'keep_adv_search_live',
            'type'     => 'switch',
            'title'    => esc_html__( 'Keep Advanced Search visible?', $theme_text_domain ),
            'desc' => esc_html__('If no, the advanced search panel over the header will be displayed in the closed position by default.', $theme_text_domain),
            'default'  => 1,
            'on'       => esc_html__( 'Yes', $theme_text_domain ),
            'off'      => esc_html__( 'No', $theme_text_domain ),
        ),

        array(
            'id'       => 'dock_search_top_row_fields',
            'type'     => 'select',
            'title'    => esc_html__( 'Top Row Fields', $theme_text_domain ),
            'subtitle' => esc_html__( 'Number of fields to show in search top row', $theme_text_domain ),
            'options'   => array(
                '1' => esc_html__( 'One', $theme_text_domain ),
                '2' => esc_html__( 'Two', $theme_text_domain ),
                '3' => esc_html__( 'Three', $theme_text_domain ),
                '4' => esc_html__( 'Four', $theme_text_domain ),
                '5' => esc_html__( 'Five', $theme_text_domain )
            ),
            'desc'     => '',
            'default'  => '3'
        ),
        array(
            'id'      => 'dock_search_builder',
            'type'    => 'sorter',
            'title'   => 'Search Builder',
            'subtitle'    => 'Drag and drop search manager, to quickly organize your search fields.',
            'options' => array(
                'enabled'  => $dock_search_builder,
                'disabled' => $dock_search_builder_disabled
            ),
        ),
        array(
            'id'       => 'dock_radius_search',
            'type'     => 'switch',
            'title'    => esc_html__( 'Enable Radius Search.', $theme_text_domain ),
            //'desc'     => '',
            'desc' => esc_html__('Enable or disable the advanced search radius search', $theme_text_domain),
            'default'  => 0,
            'on'       => esc_html__( 'Enable', $theme_text_domain ),
            'off'      => esc_html__( 'Disable', $theme_text_domain ),
        ),
        
        array(
            'id'       => 'dock_price_range',
            'type'     => 'switch',
            'title'    => esc_html__( 'Price Range Slider', $theme_text_domain ),
            'subtitle'     => esc_html__('If enabled, min and max price dropdown fields will not show', $theme_text_domain),
            'desc' => esc_html__('Enable or disable the price range slider', $theme_text_domain),
            'default'  => 0,
            'on'       => esc_html__( 'Enabled', $theme_text_domain ),
            'off'      => esc_html__( 'Disabled', $theme_text_domain ),
        ),
        array(
            'id'       => 'dock_search_other_features',
            'type'     => 'switch',
            'title'    => esc_html__( 'Other Features', $theme_text_domain ),
            //'desc'     => '',
            'desc' => esc_html__('Enable or disable other features in searches', $theme_text_domain),
            'default'  => 0,
            'on'       => esc_html__( 'Enabled', $theme_text_domain ),
            'off'      => esc_html__( 'Disabled', $theme_text_domain ),
        ),

    )
) );


/*-------------------------------------------------------------------------------
* Dock Search 
*------------------------------------------------------------------------------*/
Redux::setSection( $opt_name, array(
    'title'            => esc_html__( 'Half Map Search', $theme_text_domain ),
    'id'               => 'halfmap-search',
    'subsection'       => true,
    'desc'             => '',
    'fields'           => array(
        array(
            'id'       => 'enable_halfmap_search',
            'type'     => 'switch',
            'title'    => esc_html__( 'Show Search', $theme_text_domain ),
            'desc'     => '',
            'subtitle' => esc_html__('Enable or disable the search for half map', $theme_text_domain),
            'default'  => 1,
            'on'       => esc_html__( 'Yes', $theme_text_domain ),
            'off'      => esc_html__( 'No', $theme_text_domain ),
        ),

        array(
            'id'       => 'halfmap_search_layout',
            'type'     => 'image_select',
            'title'    => esc_html__('Select Version', $theme_text_domain),
            'subtitle' => '',
            'desc'     => '',
            'options'  => array(
                'v1' => array(
                    'alt' => '',
                    'img' => YANI_THEME_IMAGES . 'search/search-v1.png'
                ),
                'v2' => array(
                    'alt' => '',
                    'img' => YANI_THEME_IMAGES . 'search/search-v2.png'
                ),
                'v3' => array(
                    'alt' => '',
                    'img' => YANI_THEME_IMAGES . 'search/search-v3.png'
                ),
                'v4' => array(
                    'alt' => '',
                    'img' => YANI_THEME_IMAGES . 'search/search-halfmap.png'
                ),
                
            ),
            'default'  => 'v4'
        ),

        array(
            'id'       => 'search_top_row_fields_halfmap',
            'type'     => 'select',
            'title'    => esc_html__( 'Top Row Fields', $theme_text_domain ),
            'desc' => esc_html__( 'Select the number of fields to display in the search top row', $theme_text_domain ),
            'options'   => array(
                '1' => esc_html__( 'One', $theme_text_domain ),
                '2' => esc_html__( 'Two', $theme_text_domain ),
                '3' => esc_html__( 'Three', $theme_text_domain ),
                '4' => esc_html__( 'Four', $theme_text_domain ),
                '5' => esc_html__( 'Five', $theme_text_domain )
            ),
            //'desc'     => '',
            'default'  => '3'
        ),
        array(
            'id'      => 'search_builder_halfmap',
            'type'    => 'sorter',
            'title'   => 'Search Builder Half Map',
            'subtitle'    => 'Drag and drop search manager, to quickly organize your search fields.',
            'options' => array(
                'enabled'  => $search_builder,
                'disabled' => $search_builder_disabled
            ),
        ),

        array(
            'id'       => 'enable_radius_search_halfmap',
            'type'     => 'switch',
            'title'    => esc_html__( 'Enable Radius Search On The Half Map Page.', $theme_text_domain ),
            //'desc'     => '',
            'desc' => esc_html__('Enable or disable the radius search on the half map page', $theme_text_domain),
            'default'  => 1,
            'on'       => esc_html__( 'Enable', $theme_text_domain ),
            'off'      => esc_html__( 'Disable', $theme_text_domain ),
        ),
        array(
            'id'       => 'price_range_halfmap',
            'type'     => 'switch',
            'title'    => esc_html__( 'Price Range Slider for Half Map', $theme_text_domain ),
            'subtitle'     => esc_html__('If enabled, the minimum and maximum price dropdown fields will not displayed', $theme_text_domain),
            'desc' => esc_html__('Enable or disable the price range slider', $theme_text_domain),
            'default'  => 1,
            'on'       => esc_html__( 'Enabled', $theme_text_domain ),
            'off'      => esc_html__( 'Disabled', $theme_text_domain ),
        ),
        array(
            'id'       => 'search_other_features_halfmap',
            'type'     => 'switch',
            'title'    => esc_html__( 'Other Features for Half Map', $theme_text_domain ),
            //'desc'     => '',
            'desc' => esc_html__('Enable or disable other features in searches', $theme_text_domain),
            'default'  => 1,
            'on'       => esc_html__( 'Enabled', $theme_text_domain ),
            'off'      => esc_html__( 'Disabled', $theme_text_domain ),
        ),

        array(
            'id'       => 'halfmap-search-visible',
            'type'     => 'switch',
            'title'    => esc_html__( 'Advanced Filters Visible', $theme_text_domain ),
            'desc' => esc_html__( 'Keep the advaced search filters always visible', $theme_text_domain ),
            'subtitle'     => esc_html__('Note: If "Yes" it will remove advanced button in search and show all filters', $theme_text_domain),
            'default'  => 0,
            'on'       => esc_html__( 'Yes', $theme_text_domain ),
            'off'      => esc_html__( 'No', $theme_text_domain ),
        ),
        
    )
) );

Redux::setSection( $opt_name, array(
    'title'  => esc_html__( 'Banner Search', $theme_text_domain ),
    'id'     => 'home-banner-search',
    'desc'   => '',
    'subsection' => true,
    'fields' => array(
        array(
            'id'       => 'splash_v1_dropdown',
            'type'     => 'select',
            'title'    => esc_html__( 'Banner Search dropdown', $theme_text_domain ),
            'desc'     => esc_html__('Select what you want to display as first field in the banner search', $theme_text_domain ),
            'options'  => array(
                'property_country' => esc_html__('Countries', $theme_text_domain),
                'property_state' => esc_html__('States', $theme_text_domain),
                'property_city' => esc_html__('Cities', $theme_text_domain),
                'property_area' => esc_html__('Areas', $theme_text_domain),
                'property_status' => esc_html__('Status', $theme_text_domain),
                'property_type' => esc_html__('Type', $theme_text_domain)
            ),
            'default' => 'property_city'
        ),
        array(
            'id'       => 'banner_search_tabs',
            'type'     => 'switch',
            'title'    => esc_html__( 'Search Tabs', $theme_text_domain ),
            'subtitle'     => 'This option will display the status tabs on the search bar',
            'desc' => esc_html__('Do you want to display tabs on the search banner?', $theme_text_domain),
            'default'  => 0,
            'on'       => esc_html__( 'Yes', $theme_text_domain ),
            'off'      => esc_html__( 'No', $theme_text_domain ),
        ),
        array(
            'id'       => 'tabs_limit',
            'type'     => 'text',
            'title'    => esc_html__('Tabs Limit', $theme_text_domain),
            'desc' => esc_html__('Enter the number of tabs to display in banner search', $theme_text_domain),
            //'desc'     => '',
            'default'  => '2',
            'required'  => array('banner_search_tabs', '=', '1'),
            'validate'  => 'numeric',
        ),
        array(
            'id'       => 'banner_radius_search',
            'type'     => 'switch',
            'title'    => esc_html__( 'Enable Radius Search.', $theme_text_domain ),
            //'desc'     => '',
            'desc' => esc_html__('Enable or disable the search radius search', $theme_text_domain),
            'default'  => 0,
            'on'       => esc_html__( 'Enable', $theme_text_domain ),
            'off'      => esc_html__( 'Disable', $theme_text_domain ),
        ),
    )
));


Redux::setSection( $opt_name, array(
    'title'  => esc_html__( 'Settings', $theme_text_domain ),
    'id'     => 'adv-search-settings',
    'desc'   => '',
    'subsection' => true,
    'fields' => array(
        array(
            'id'       => 'keyword_field',
            'type'     => 'select',
            'title'    => __('Keyword Field', $theme_text_domain),
            'desc' => __('Select the search criteria for the keyword field', $theme_text_domain),
            'options'  => array(
                'prop_title' => esc_html__('Property Title or Content', $theme_text_domain),
                'prop_address' => esc_html__('Property address, street, zip or property ID', $theme_text_domain),
                'prop_city_state_county' => esc_html__('Search State, City or Area', $theme_text_domain),
            ),
            'default' => 'prop_address'
        ),
        array(
            'id'       => 'keyword_autocomplete',
            'type'     => 'switch',
            'title'    => esc_html__( 'Auto Complete', $theme_text_domain ),
            //'desc'     => '',
            'desc' => esc_html__('Enable or disable the auto complete functionality for the keyword field', $theme_text_domain),
            'default'  => 0,
            'on'       => esc_html__( 'Enable', $theme_text_domain ),
            'off'      => esc_html__( 'Disable', $theme_text_domain ),
        ),
        array(
            'id'       => 'beds_baths_search',
            'type'     => 'select',
            'title'    => esc_html__( 'Bedrooms, Rooms, Bathrooms', $theme_text_domain ),
            'desc'    => esc_html__( 'Select the search criteria for bedrooms, Rooms and bathrooms', $theme_text_domain ),
            //'desc'     => '',
            'options'  => array(
                'equal' => esc_html__('Equal', $theme_text_domain),
                'greater' => esc_html__('Greater', $theme_text_domain),
                'like' => esc_html__('Like', $theme_text_domain),
            ),
            'default' => 'equal'
        ),
        array(
            'id'       => 'state_city_area_dropdowns',
            'type'     => 'switch',
            'title'    => esc_html__( 'State, City, Area dropdowns.', $theme_text_domain ),
            //'desc'     => '',
            'desc' => esc_html__('Do you want to display the States, Cities, Areas fields if they have at least 1 property?', $theme_text_domain),
            'default'  => 0,
            'on'       => esc_html__( 'Yes', $theme_text_domain ),
            'off'      => esc_html__( 'Show All', $theme_text_domain ),
        ),

        array(
            'id'       => 'price_field_type',
            'type'     => 'button_set',
            'title'    => __('Price Field Type', $theme_text_domain),
            'subtitle' => '',
            'desc'     => '',
            'options' => array(
                'input' => esc_html__('Input Field', $theme_text_domain), 
                'select' => esc_html__('Select Field', $theme_text_domain), 
             ), 
            'default' => 'select'
        ),

        array(
            'id'          => 'search_exclude_status',
            'type'        => 'select',
            'title'       => esc_html__( 'Exclude Statuses', $theme_text_domain ),
            'subtitle'    => esc_html__( 'Which statuses would you like to exclude from searches?', $theme_text_domain ),
            'multi'       => true,
            'data'        => 'terms',
            'args'  => array(
                'taxonomy' => array( 'property_status' ),
                'hide_empty' => false,
            )
        ),

        array(
            'id'       => 'ms_section-start',
            'type'     => 'section',
            'title'    => esc_html__( 'Multi Selection', $theme_text_domain ),
            'subtitle' => '',
            'indent'   => true,
        ),

        array(
            'id'       => 'ms_type',
            'type'     => 'switch',
            'title'    => esc_html__( 'Type', $theme_text_domain ),
            'desc'     => '',
            'subtitle' => esc_html__('Show multi-select for property type', $theme_text_domain),
            'default'  => 1,
            'on'       => esc_html__( 'Yes', $theme_text_domain ),
            'off'      => esc_html__( 'No', $theme_text_domain ),
        ),

        array(
            'id'       => 'ms_status',
            'type'     => 'switch',
            'title'    => esc_html__( 'Status', $theme_text_domain ),
            'desc'     => '',
            'subtitle' => esc_html__('Show multi-select for property status', $theme_text_domain),
            'default'  => 0,
            'on'       => esc_html__( 'Yes', $theme_text_domain ),
            'off'      => esc_html__( 'No', $theme_text_domain ),
        ),

        array(
            'id'       => 'ms_label',
            'type'     => 'switch',
            'title'    => esc_html__( 'Label', $theme_text_domain ),
            'desc'     => '',
            'subtitle' => esc_html__('Show multi-select for property label', $theme_text_domain),
            'default'  => 0,
            'on'       => esc_html__( 'Yes', $theme_text_domain ),
            'off'      => esc_html__( 'No', $theme_text_domain ),
        ),

        /*array(
            'id'       => 'ms_city',
            'type'     => 'switch',
            'title'    => esc_html__( 'City', $theme_text_domain ),
            'desc'     => '',
            'subtitle' => esc_html__('Show multi-select for property city', $theme_text_domain),
            'default'  => 0,
            'on'       => esc_html__( 'Yes', $theme_text_domain ),
            'off'      => esc_html__( 'No', $theme_text_domain ),
        ),*/

        array(
            'id'       => 'ms_area',
            'type'     => 'switch',
            'title'    => esc_html__( 'Area', $theme_text_domain ),
            'desc'     => '',
            'subtitle' => esc_html__('Show multi-select for property Area', $theme_text_domain),
            'default'  => 1,
            'on'       => esc_html__( 'Yes', $theme_text_domain ),
            'off'      => esc_html__( 'No', $theme_text_domain ),
        ),

        array(
            'id'     => 'ms_section_end',
            'type'   => 'section',
            'indent' => false,
        ),

        array(
            'id' => 'yani_default_radius',
            'type' => 'slider',
            'title' => __('Default Radius', $theme_text_domain),
            'desc' => __('Setup the default distance', $theme_text_domain),
            //'desc' => '',
            "default" => 50,
            "min" => 0,
            "step" => 1,
            "max" => 100,
            'display_value' => ''
        ),
        array(
            'id'       => 'radius_unit',
            'type'     => 'select',
            'title'    => __('Radius Unit', $theme_text_domain),
            'desc' => __('Select the distance unit', $theme_text_domain),
            'description' => '',
            'options'  => array(
                'km' => 'km',
                'mi' => 'mi'
            ),
            'default' => 'km'
        ),

        array(
            'id'       => 'features_limit',
            'type'     => 'text',
            'title'    => esc_html__('Features Limit', $theme_text_domain),
            'desc' => esc_html__('Enter the number of features to show in the advanced search. Note: enter -1 to display them all.', $theme_text_domain),
            //'desc'     => '',
            'default'  => '-1',
        ),
        array(
            'id'       => 'enable_disable_save_search',
            'type'     => 'switch',
            'title'    => esc_html__( 'Save Search Button', $theme_text_domain ),
            'subtitle'     => '',
            'desc' => esc_html__('Enable the save search button option on search result page', $theme_text_domain),
            'default'  => 1,
            'on'       => esc_html__( 'Yes', $theme_text_domain ),
            'off'      => esc_html__( 'No', $theme_text_domain ),
        ),
        array(
            'id'       => 'save_search_duration',
            'type'     => 'select',
            'title'    => esc_html__('Send Emails', $theme_text_domain),
            'subtitle' => 'If a customer saved a search result, he will receive periodic updates if new proprties will match his search criteria',
            'desc'     => 'Select when you want to send the emails related to saved searches',
            'required' => array( 'enable_disable_save_search', '=', '1' ),
            'options'  => array(
                'daily'   => esc_html__( 'Daily', $theme_text_domain ),
                'weekly'   => esc_html__( 'weekly', $theme_text_domain )
            ),
            'default'  => 'daily',
        ),
        array(
            'id'        => 'min_price',
            'type'      => 'textarea',
            'title'     => esc_html__( 'Minimum Prices List for Advance Search Form', $theme_text_domain ),
            'read-only' => false,
            'default'   => '1000, 5000, 10000, 50000, 100000, 200000, 300000, 400000, 500000, 600000, 700000, 800000, 900000, 1000000, 1500000, 2000000, 2500000, 5000000',
            'subtitle'  => esc_html__( 'Only provide comma separated numbers. Do not add decimal points, dashes, spaces and currency signs.', $theme_text_domain ),
            'validate' => 'comma_numeric'
        ),
        array(
            'id'        => 'max_price',
            'type'      => 'textarea',
            'title'     => esc_html__( 'Maximum Prices List for Advance Search Form', $theme_text_domain ),
            'read-only' => false,
            'default'   => '5000, 10000, 50000, 100000, 200000, 300000, 400000, 500000, 600000, 700000, 800000, 900000, 1000000, 1500000, 2000000, 2500000, 5000000, 10000000',
            'subtitle'  => esc_html__( 'Only provide comma separated numbers. Do not add decimal points, dashes, spaces and currency signs.', $theme_text_domain ),
            'validate' => 'comma_numeric'
        ),
        array(
            'id'     => 'rentPrice-info',
            'type'   => 'info',
            'notice' => false,
            'style'  => 'info',
            'title'  => wp_kses(__( '<span class="font24">Rent Prices.</span>', $theme_text_domain ), $allowed_html_array),
            'desc'   => esc_html__( 'Visitors expect smaller values for rent prices, So please provide the list of minimum and maximum rent prices below', $theme_text_domain )
        ),
        array(
            'id'          => 'search_rent_status',
            'type'        => 'select',
            'title'       => esc_html__( 'Select the Appropriate Rent Status', $theme_text_domain ),
            'subtitle'    => esc_html__( 'The rent prices will be displayed based on selected status.', $theme_text_domain ),
            'desc'        => '',
            'data'        => 'terms',
            'args'  => array(
                'taxonomy' => array( 'property_status' ),
                'hide_empty' => false,
            )
        ),

        array(
            'id'        => 'min_price_rent',
            'type'      => 'textarea',
            'title'     => esc_html__( 'Minimum Prices List for Rent Only', $theme_text_domain ),
            'read-only' => false,
            'default'   => '500, 1000, 2000, 3000, 4000, 5000, 7500, 10000, 15000, 20000, 25000, 30000, 40000, 50000, 75000, 100000',
            'subtitle'  => esc_html__( 'Only provide comma separated numbers. Do not add decimal points, dashes, spaces and currency signs.', $theme_text_domain ),
            'validate' => 'comma_numeric'
        ),
        array(
            'id'        => 'max_price_rent',
            'type'      => 'textarea',
            'title'     => esc_html__( 'Maximum Prices List for Rent Only', $theme_text_domain ),
            'read-only' => false,
            'default'   => '1000, 2000, 3000, 4000, 5000, 7500, 10000, 15000, 20000, 25000, 30000, 40000, 50000, 75000, 100000, 150000',
            'subtitle'  => esc_html__( 'Only provide comma separated numbers. Do not add decimal points, dashes, spaces and currency signs.', $theme_text_domain ),
            'validate' => 'comma_numeric'
        ),
        array(
            'id'     => 'advanced-search-widget-priceRang-info',
            'type'   => 'info',
            'notice' => false,
            'style'  => 'info',
            'title'  => __( '<span class="font24">Advanced Search Price range for price slider.</span>', $theme_text_domain ),
            'desc'   => ''
        ),
        array(
            'id'        => 'advanced_search_widget_min_price',
            'type'      => 'text',
            'title'     => esc_html__( 'Minimum Price', $theme_text_domain ),
            'desc'     => esc_html__( 'Enter the minimum price', $theme_text_domain ),
            'read-only' => false,
            'default'   => '200',
            'subtitle'  => '',
            'validate' => 'numeric'
        ),
        array(
            'id'        => 'advanced_search_widget_max_price',
            'type'      => 'text',
            'title'     => esc_html__( 'Maximum Price', $theme_text_domain ),
            'desc'     => esc_html__( 'Enter the maximum price', $theme_text_domain ),
            'read-only' => false,
            'default'   => '2500000',
            'subtitle'  => '',
            'validate' => 'numeric'
        ),
        array(
            'id'          => 'search_rent_status_for_price_range',
            'type'        => 'select',
            'title'       => esc_html__( 'Select the Appropriate Rent Status', $theme_text_domain ),
            'subtitle'    => esc_html__( 'The rent prices will be displayed based on selected status.', $theme_text_domain ),
            'desc'        => '',
            'data'  => 'terms',
            'args'  => array(
                'taxonomy' => array( 'property_status' ),
                'hide_empty' => false,
            )
        ),
        array(
            'id'        => 'advanced_search_min_price_range_for_rent',
            'type'      => 'text',
            'title'     => esc_html__( 'Minimum Price For Rent Only', $theme_text_domain ),
            'desc'     => esc_html__( 'Enter the minimum price', $theme_text_domain ),
            'read-only' => false,
            'default'   => '50',
            'subtitle'  => '',
            'validate' => 'numeric'
        ),
        array(
            'id'        => 'advanced_search_max_price_range_for_rent',
            'type'      => 'text',
            'title'     => esc_html__( 'Maximum Price For Rent Only', $theme_text_domain ),
            'desc'     => esc_html__( 'Enter the maximum price', $theme_text_domain ),
            'read-only' => false,
            'default'   => '25000',
            'subtitle'  => '',
            'validate' => 'numeric'
        ),

        array(
            'id'     => 'beds-baths-info',
            'type'   => 'info',
            'notice' => false,
            'style'  => 'info',
            'title'  => wp_kses(__( '<span class="font24">Bedrooms & Bathrooms</span>', $theme_text_domain ), $allowed_html_array),
            'desc'   => ''
        ),
        array(
            'id'        => 'adv_beds_list',
            'type'      => 'textarea',
            'title'     => esc_html__( 'Bedrooms List', $theme_text_domain ),
            'read-only' => false,
            'default'   => '1,2,3,4,5,6,7,8,9,10',
            'subtitle'  => esc_html__( 'Only provide comma separated numbers. Do not add dashes, spaces and currency signs.', $theme_text_domain ),
            //'validate' => 'comma_numeric'
        ),
        array(
            'id'        => 'adv_rooms_list',
            'type'      => 'textarea',
            'title'     => esc_html__( 'Rooms List', $theme_text_domain ),
            'read-only' => false,
            'default'   => '1,2,3,4,5,6,7,8,9,10',
            'subtitle'  => esc_html__( 'Only provide comma separated numbers. Do not add dashes, spaces and currency signs.', $theme_text_domain ),
            //'validate' => 'comma_numeric'
        ),
        array(
            'id'        => 'adv_baths_list',
            'type'      => 'textarea',
            'title'     => esc_html__( 'Bathrooms List', $theme_text_domain ),
            'read-only' => false,
            'default'   => '1,2,3,4,5,6,7,8,9,10',
            'subtitle'  => esc_html__( 'Only provide comma separated numbers. Do not add dashes, spaces and currency signs.', $theme_text_domain ),
            //'validate' => 'comma_numeric'
        )
    )
));

Redux::setSection( $opt_name, array(
    'title'  => esc_html__( 'Search Results Page', $theme_text_domain ),
    'id'     => 'adv-search-resultpage',
    'icon'   => 'el-icon-search el-icon-small',
    'desc'   => '',
    'subsection' => false,
    'fields' => array(
        array(
            'id'       => 'search_result_page',
            'type'     => 'select',
            'title'    => __('Search Reslt Page', $theme_text_domain),
            'desc' => __('Create this page using "Search Results" template', $theme_text_domain),
            'options'  => array(
                'normal_page' => 'Normal Page',
                'half_map' => 'Half Map'
            ),
            'default' => 'normal_page'
        ),
        
        array(
            'id'       => 'search_result_layout',
            'type'     => 'image_select',
            'required' => array( 'search_result_page', '=', 'normal_page' ),
            'title'    => __('Search Result Page Layout', $theme_text_domain),
            'subtitle' => __('Select the layout for search result page.', $theme_text_domain),
            'options'  => array(
                'no-sidebar' => array(
                    'alt'   => '',
                    'img'   => ReduxFramework::$_url.'assets/img/1c.png'
                ),
                'left-sidebar' => array(
                    'alt'   => '',
                    'img'   => ReduxFramework::$_url.'assets/img/2cl.png'
                ),
                'right-sidebar' => array(
                    'alt'   => '',
                    'img'  => ReduxFramework::$_url.'assets/img/2cr.png'
                )
            ),
            'default' => 'right-sidebar'
        ),
        array(
            'id'       => 'search_result_posts_layout',
            'type'     => 'select',
            'title'    => __('Properties Layout', $theme_text_domain),
            'desc' => __('Select the properties layout for search result page.', $theme_text_domain),
            'options'  => array(
                'Listings Version 1' => array(
                    'list-view-v1' => 'List View',
                    'grid-view-v1' => 'Grid View',
                ),
                'Listings Version 2' => array(
                    'list-view-v2' => 'List View',
                    'grid-view-v2' => 'Grid View',
                ),
                'grid-view-v3' => 'Grid View v3',
                'grid-view-v4' => 'Grid View v4',
                'Listings Version 5' => array(
                    'list-view-v5' => 'List View',
                    'grid-view-v5' => 'Grid View',
                ),
                'grid-view-v6' => 'Grid View v6',
            ),
            'default' => 'list-view-v1'
        ),

        array(
            'id'       => 'search_default_order',
            'type'     => 'select',
            'title'    => __('Default Order', $theme_text_domain),
            'desc' => __('Select the results page properties order.', $theme_text_domain),
            'options'  => array(
                '' => esc_html__( 'Default Order', $theme_text_domain ),
                'd_date' => esc_html__( 'Date New to Old', $theme_text_domain ),
                'a_date' => esc_html__( 'Date Old to New', $theme_text_domain ),
                'd_price' => esc_html__( 'Price (High to Low)', $theme_text_domain ),
                'a_price' => esc_html__( 'Price (Low to High)', $theme_text_domain ),
                'featured_first' => esc_html__( 'Show Featured Listings on Top', $theme_text_domain ),
            ),
            'default' => ''
        ),

        array(
            'id'       => 'search_num_posts',
            'type'     => 'text',
            'title'    => esc_html__('Number of Listings', $theme_text_domain),
            'desc'    => esc_html__('Enter the number of listings to display on the search result page', $theme_text_domain),
            'subtitle' => '',
            //'desc'     => '',
            'default'  => '9',
        ),
    )
));
?>