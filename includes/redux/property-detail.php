<?php
global $opt_name,$theme_text_domain, $custom_fields_array ;

Redux::setSection( $opt_name, array(
    'title'  => esc_html__( 'Property Detail', $theme_text_domain ),
    'id'     => 'property-page',
    'desc'   => '',
    'icon'   => 'el-icon-home el-icon-small',
    'fields'		=> array(
        array(
            'id'       => 'prop-top-area',
            'type'     => 'image_select',
            'title'    => esc_html__('Property Banner', $theme_text_domain),
            'subtitle' => esc_html__('Select the banner version you want to display in the property detail page', $theme_text_domain),
            'desc'     => esc_html__('Select the banner version', $theme_text_domain),
            'options'  => array(
                'v1' => array(
                    'alt' => '',
                    'img' => YANI_THEME_IMAGES . 'property/property-banner-style-1.jpg'
                ),
                'v2' => array(
                    'alt' => '',
                    'img' => YANI_THEME_IMAGES . 'property/property-banner-style-2.jpg'
                ),
                'v3' => array(
                    'alt' => '',
                    'img' => YANI_THEME_IMAGES . 'property/property-banner-style-3.jpg'
                ),
                'v4' => array(
                    'alt' => '',
                    'img' => YANI_THEME_IMAGES . 'property/property-banner-style-4.jpg'
                ),
                'v5' => array(
                    'alt' => '',
                    'img' => YANI_THEME_IMAGES . 'property/property-banner-style-5.jpg'
                ),
                'v6' => array(
                    'alt' => '',
                    'img' => YANI_THEME_IMAGES . 'property/property-banner-style-6.jpg'
                ),
            ),
            'default'  => 'v1',
        ),
        array(
            'id'       => 'prop_default_active_tab',
            'type'     => 'select',
            'title'    => esc_html__('Property Banner Active Tab', $theme_text_domain),
            'subtitle' => esc_html__('The property top banner has three tabs, the image/gallery, map view and street view. Select the one you want to display first', $theme_text_domain),
            'desc'     => esc_html__('Select the which one has to be the first tab', $theme_text_domain),
            'options'  => array(
                'image_gallery'   => esc_html__( 'Image/Gallery', $theme_text_domain ),
                'map_view'        => esc_html__( 'Map View', $theme_text_domain )
            ),
            'default'  => 'image_gallery',
        ),
        array(
            'id'       => 'prop-content-layout',
            'type'     => 'select',
            'title'    => esc_html__('Property Content Layout', $theme_text_domain),
            'subtitle' => '',
            'desc'     => esc_html__('Select the contet layout', $theme_text_domain),
            'options'  => array(
                'simple' => esc_html__( 'Default', $theme_text_domain ),
                'tabs'   => esc_html__( 'Tabs', $theme_text_domain ),
                'tabs-vertical' => esc_html__( 'Tabs Vertical', $theme_text_domain ),
                'v2' => esc_html__( 'Luxury Homes', $theme_text_domain ),
            ),
            'default'  => 'simple',
        ),

        array(
            'id'       => 'is_full_width',
            'type'     => 'switch',
            'title'    => esc_html__( 'Full Width Property Content Layout', $theme_text_domain ),
            'subtitle'     => esc_html__('If you select yes the property page will be full-width without the sidebar', $theme_text_domain),
            'desc' => esc_html__( 'Do you want to make the property page full width?', $theme_text_domain ),
            'default'  => 0,
            'required' => array( 'prop-content-layout', '!=', 'v2' ),
            'on'       => esc_html__( 'Yes', $theme_text_domain ),
            'off'      => esc_html__( 'No', $theme_text_domain ),
        ),

        array(
            'id'       => 'prop_details_cols',
            'type'     => 'select',
            'title'    => esc_html__('Details section columns', $theme_text_domain),
            'subtitle' => esc_html__('Select number of columns you show for details section', $theme_text_domain),
            'desc'     => '',
            'options'  => array(
                'list-1-cols'   => esc_html__( '1 Column', $theme_text_domain ),
                'list-2-cols'   => esc_html__( '2 Columns', $theme_text_domain ),
                'list-3-cols'   => esc_html__( '3 Columns', $theme_text_domain )
            ),
            'default'  => 'list-2-cols',
        ),

        array(
            'id'       => 'prop_address_cols',
            'type'     => 'select',
            'title'    => esc_html__('Address section columns', $theme_text_domain),
            'subtitle' => esc_html__('Select number of columns you show for address section', $theme_text_domain),
            'desc'     => '',
            'options'  => array(
                'list-1-cols'   => esc_html__( '1 Column', $theme_text_domain ),
                'list-2-cols'   => esc_html__( '2 Columns', $theme_text_domain ),
                'list-3-cols'   => esc_html__( '3 Columns', $theme_text_domain )
            ),
            'default'  => 'list-2-cols',
        ),

        array(
            'id'       => 'prop_features_cols',
            'type'     => 'select',
            'title'    => esc_html__('Features section columns', $theme_text_domain),
            'subtitle' => esc_html__('Select number of columns you show for features section', $theme_text_domain),
            'desc'     => '',
            'options'  => array(
                'list-1-cols'   => esc_html__( '1 Column', $theme_text_domain ),
                'list-2-cols'   => esc_html__( '2 Columns', $theme_text_domain ),
                'list-3-cols'   => esc_html__( '3 Columns', $theme_text_domain )
            ),
            'default'  => 'list-3-cols',
        ),

        array(
            'id'       => 'prop-detail-nav',
            'type'     => 'select',
            'title'    => esc_html__('Property Detail Navigation', $theme_text_domain),
            'subtitle' => esc_html__('It works only for default layout', $theme_text_domain),
            'desc'     => esc_html__('Do you wan to display the property detail page sticky navigation bar?', $theme_text_domain),
            'options'  => array(
                'no' => esc_html__( 'No', $theme_text_domain ),
                'yes'   => esc_html__( 'Yes', $theme_text_domain )
            ),
            'default'  => 'no',
        ),
        array(
            'id'       => 'map_in_section',
            'type'     => 'switch',
            'title'    => esc_html__( 'Address Map Section', $theme_text_domain ),
            'subtitle' => esc_html__( 'If enabled, the map in the top banner will not displayed', $theme_text_domain ),
            'desc'     => esc_html__( 'Enable or disable the map in the address section', $theme_text_domain ),
            'default'  => 0,
            'on'       => esc_html__( 'Enabled', $theme_text_domain ),
            'off'      => esc_html__( 'Disabled', $theme_text_domain ),
        ),
        array(
            'id'       => 'send_agent_message_copy',
            'type'     => 'switch',
            'title'    => esc_html__( 'Do you want to receive the copy of message sent to agent ?', $theme_text_domain ),
            'desc'     => '',
            'subtitle' => '',
            'default'  => 0,
            'on'       => esc_html__( 'Yes', $theme_text_domain ),
            'off'      => esc_html__( 'No', $theme_text_domain ),
        ),
        array(
            'id'       => 'send_agent_message_email',
            'type'     => 'text',
            'required' => array( 'send_agent_message_copy', '=', '1' ),
            'title'    => esc_html__( 'Email address to receive message copy.', $theme_text_domain ),
            'desc'     => esc_html__('This email address will receive a copy of message sent to agent from property detail page.', $theme_text_domain),
            'subtitle' => 'Enter valid email address.'
        ),
        
    ),
));


/* Sections
----------------------------------------------------------------*/
Redux::setSection( $opt_name, array(
    'title'  => esc_html__( 'Layout Manager - Default', $theme_text_domain ),
    'id'     => 'property-section',
    'desc'   => '',
    'subsection' => true,
    'fields' => array(
        array(
            'id'      => 'property_blocks',
            'type'    => 'sorter',
            'title'   => 'Property Layout Manager',
            'subtitle'    => 'Use this tool if you selected "Default" on the "Property Content Layout" option',
            'desc'    => 'Drag and drop layout manager to quickly organize your property page content',
            'options' => array(
                'enabled'  => array(
                    'overview'     => esc_html__('Overview', $theme_text_domain),
                    'description'  => esc_html__('Description', $theme_text_domain),
                    'address'      => esc_html__('Address', $theme_text_domain),
                    'details'      => esc_html__('Details', $theme_text_domain),
                    'features'     => esc_html__('Features', $theme_text_domain),
                    'floor_plans'  => esc_html__('Floor Plans', $theme_text_domain),
                    'video'        => esc_html__('Video', $theme_text_domain),
                    'virtual_tour' => esc_html__('360° Virtual Tour', $theme_text_domain),
                    'walkscore'    => esc_html__('Walkscore', $theme_text_domain),
                    'mortgage_calculator'        => esc_html__('Mortgage Calculator', $theme_text_domain),
                    'agent_bottom' => esc_html__('Agent bottom', $theme_text_domain),
                    'review'        => esc_html__('Reviews', $theme_text_domain),
                    'similar_properties' => esc_html__('Similar Listings', $theme_text_domain),
                ),
                'disabled' => array(
                    'yelp_nearby'  => esc_html__('Near by Places', $theme_text_domain),
                    'block_gallery'  => esc_html__('Section Gallery', $theme_text_domain),
                    'schedule_tour' => esc_html__('Schedule Tour', $theme_text_domain),
                    'energy_class' => esc_html__('Energy Class', $theme_text_domain),
                    'unit'         => esc_html__('Multi Unit / Sub Listings', $theme_text_domain),
                    'adsense_space_1' => esc_html__('Adsense Space 1', $theme_text_domain),
                    'adsense_space_2' => esc_html__('Adsense Space 2', $theme_text_domain),
                    'adsense_space_3' => esc_html__('Adsense Space 3', $theme_text_domain),
                    'booking_calendar' => esc_html__('Availability Calendar', $theme_text_domain),
                )
            ),
        ),

        array(
            'id'       => 'block_gallery_visible',
            'type'     => 'text',
            'title'    => esc_html__('Section Gallery Number of Visible Images', $theme_text_domain),
            'subtitle' => '',
            'desc'     => '',
            'default'  => '9',
            'validate' => 'numeric'
        ),

        array(
            'id'       => 'block_gallery_columns',
            'type'     => 'text',
            'title'    => esc_html__('Section Gallery Images in a row', $theme_text_domain),
            'subtitle' => '',
            'desc'     => '',
            'default'  => '3',
            'validate' => 'numeric'
        ),
    )
));

Redux::setSection( $opt_name, array(
    'title'  => esc_html__( 'Layout Manager - Tabs', $theme_text_domain ),
    'id'     => 'property-section-tabs',
    'desc'   => '',
    'subsection' => true,
    'fields' => array(
        array(
            'id'      => 'property_blocks_tabs',
            'type'    => 'sorter',
            'title'   => 'Property Layout Manager',
            'subtitle'    => 'Use this tool if you selected "Tab" or "Vertical Tabs" on the "Property Content Layout" option',
            'desc'    => 'Drag and drop layout manager to quickly organize your property page content',
            'options' => array(
                'enabled'  => array(
                    'description'  => esc_html__('Description', $theme_text_domain),
                    'address'      => esc_html__('Address', $theme_text_domain),
                    'details'      => esc_html__('Details', $theme_text_domain),
                    'features'     => esc_html__('Features', $theme_text_domain),
                    'floor_plans'  => esc_html__('Floor Plans', $theme_text_domain),
                    'video'        => esc_html__('Video', $theme_text_domain),
                ),
                'disabled' => array(
                    'virtual_tour' => esc_html__('360° Virtual Tour', $theme_text_domain),
                )
            ),
        ),
        array(
            'id'       => 'tabs_agent_bottom',
            'type'     => 'switch',
            'title'    => esc_html__( 'Agent contact form section', $theme_text_domain ),
            'desc' => esc_html__( 'Enable or disable agent contact for section section.', $theme_text_domain ),
            'default'  => 1,
            'on'       => esc_html__( 'Enable', $theme_text_domain ),
            'off'      => esc_html__( 'Disable', $theme_text_domain ),
        ),
        array(
            'id'       => 'yani_availability_calendar',
            'type'     => 'switch',
            'title'    => esc_html__( 'Availability Calendar', $theme_text_domain ),
            'desc' => esc_html__( 'Enable or disable the availability calendar section.', $theme_text_domain ),
            'default'  => 0,
            'on'       => esc_html__( 'Enable', $theme_text_domain ),
            'off'      => esc_html__( 'Disable', $theme_text_domain ),
        ),
        array(
            'id'       => 'yani_energy_class',
            'type'     => 'switch',
            'title'    => esc_html__( 'Energy Efficiency', $theme_text_domain ),
            'desc' => esc_html__( 'Enable or disable the energy class sectio.', $theme_text_domain ),
            'default'  => 0,
            'on'       => esc_html__( 'Enable', $theme_text_domain ),
            'off'      => esc_html__( 'Disable', $theme_text_domain ),
        ),
        array(
            'id'       => 'yani_mortgage',
            'type'     => 'switch',
            'title'    => esc_html__( 'Mortgage Calculator', $theme_text_domain ),
            'desc' => esc_html__( 'Enable or disable mortgage calculator section.', $theme_text_domain ),
            'default'  => 1,
            'on'       => esc_html__( 'Enable', $theme_text_domain ),
            'off'      => esc_html__( 'Disable', $theme_text_domain ),
        ),
        array(
            'id'       => 'yani_sublisting',
            'type'     => 'switch',
            'title'    => esc_html__( 'Sub Listings', $theme_text_domain ),
            'desc' => esc_html__( 'Enable or disable the sub listings section.', $theme_text_domain ),
            'default'  => 0,
            'on'       => esc_html__( 'Enable', $theme_text_domain ),
            'off'      => esc_html__( 'Disable', $theme_text_domain ),
        ),
        array(
            'id'       => 'yani_tabs_schedule',
            'type'     => 'switch',
            'title'    => esc_html__( 'Schedule Tour', $theme_text_domain ),
            'subtitle' => esc_html__( 'Enable or disable the schedule a tour form.', $theme_text_domain ),
            'default'  => 0,
            'on'       => esc_html__( 'Enable', $theme_text_domain ),
            'off'      => esc_html__( 'Disable', $theme_text_domain ),
        ),
    )
));


Redux::setSection( $opt_name, array(
    'title'  => esc_html__( 'Layout Manager - Luxury Homes', $theme_text_domain ),
    'id'     => 'property-section-luxury-homes',
    'desc'   => '',
    'subsection' => true,
    'fields' => array(
        array(
            'id'      => 'property_blocks_luxuryhomes',
            'type'    => 'sorter',
            'title'   => 'Property Layout Manager',
            'subtitle'    => 'Use this tool if you selected "Luxury Homes" on the "Property Content Layout" option',
            'desc'    => 'Drag and drop layout manager to quickly organize your property page content',
            'options' => array(
                'enabled'  => array(
                    'description'  => esc_html__('Description & Details', $theme_text_domain),
                    'features'     => esc_html__('Features', $theme_text_domain),
                    'address'      => esc_html__('Address', $theme_text_domain),
                    'gallery'      => esc_html__('Gallery', $theme_text_domain),
                    'floor_plans'  => esc_html__('Floor Plans', $theme_text_domain),
                    'video'        => esc_html__('Video', $theme_text_domain),
                    'mortgage_calculator'        => esc_html__('Mortgage Calculator', $theme_text_domain),
                    'agent_form'   => esc_html__('Agent Contact', $theme_text_domain),
                    'review'        => esc_html__('Reviews', $theme_text_domain),
                    'similar_properties' => esc_html__('Similar Listings', $theme_text_domain),
                ),
                'disabled' => array(
                    'virtual_tour' => esc_html__('360° Virtual Tour', $theme_text_domain),
                    'energy_class' => esc_html__('Energy Class', $theme_text_domain),
                    'yelp_nearby'  => esc_html__('Nearby', $theme_text_domain),
                    'unit'         => esc_html__('Multi Unit / Sub Listings', $theme_text_domain),
                    'walkscore'    => esc_html__('Walkscore', $theme_text_domain),
                    'schedule_tour' => esc_html__('Schedule Tour', $theme_text_domain),
                    'adsense_space_1' => esc_html__('Adsense Space 1', $theme_text_domain),
                    'adsense_space_2' => esc_html__('Adsense Space 2', $theme_text_domain),
                    'adsense_space_3' => esc_html__('Adsense Space 3', $theme_text_domain),
                    'booking_calendar' => esc_html__('Availability Calendar', $theme_text_domain),
                )
            ),
        )
    )
));

$overview_composer = array(
    'type' => esc_html__('Property Type', $theme_text_domain),
    'bedrooms' => esc_html__('Bedrooms', $theme_text_domain),
    'bathrooms' => esc_html__('Bathrooms', $theme_text_domain),
    'garage' => esc_html__('Garage', $theme_text_domain),
    'area-size' => esc_html__('Area Size', $theme_text_domain),
    'year-built' => esc_html__('Year Built', $theme_text_domain),

);

$overview_composer_disabled = array(
    'rooms' => esc_html__('Rooms', $theme_text_domain),
    'land-area' => esc_html__('Land Area', $theme_text_domain),
    'property-id' => esc_html__('Property ID', $theme_text_domain),
);

$overview_composer_disabled = array_merge($overview_composer_disabled, $custom_fields_array);

/* Overview Composer 
----------------------------------------------------------------*/
Redux::setSection( $opt_name, array(
    'title'  => esc_html__( 'Overview Section', $theme_text_domain ),
    'id'     => 'overview-section',
    'desc'   => '',
    'subsection' => true,
    'fields' => array(
        array(
            'id'       => 'show_id_head',
            'type'     => 'switch',
            'title'    => esc_html__( 'Property ID', $theme_text_domain ),
            'desc' => esc_html__( 'Show property id in section header.', $theme_text_domain ),
            'default'  => 1,
            'on'       => esc_html__( 'Show', $theme_text_domain ),
            'off'      => esc_html__( 'Hide', $theme_text_domain ),
        ),
        array(
            'id'      => 'overview_data_composer',
            'type'    => 'sorter',
            'title'   => 'Overview Data Composer',
            'subtitle'    => esc_html__( 'Drag and drop data manage for overview section', $theme_text_domain ),
            'desc'    => '',
            'options' => array(
                'enabled'  => $overview_composer,
                'disabled' => $overview_composer_disabled
            ),
        ),
    )
));

/* Energy Class
----------------------------------------------------------------*/
Redux::setSection( $opt_name, array(
    'title'  => esc_html__( 'Energy Class', $theme_text_domain ),
    'id'     => 'energy-class-section',
    'desc'   => '',
    'subsection' => true,
    'fields' => array(
        array(
            'id'       => 'energy_class_data',
            'type'     => 'text',
            'title'    => esc_html__( 'Energy Classes', $theme_text_domain ),
            'default'  => 'A+, A, B, C, D, E, F, G, H',
            'subtitle' => esc_html__( 'Enter comma separated energy classes', $theme_text_domain ),
        ),
        array(
            'id'       => 'energy_1_color',
            'type'     => 'color',
            'title'    => esc_html__( 'Class 1 Color', $theme_text_domain ),
            'desc' => '',
            'default'  => '#33a357',
            'transparent' => false,
        ),
        array(
            'id'       => 'energy_2_color',
            'type'     => 'color',
            'title'    => esc_html__( 'Class 2 Color', $theme_text_domain ),
            'desc' => '',
            'default'  => '#79b752',
            'transparent' => false,
        ),
        array(
            'id'       => 'energy_3_color',
            'type'     => 'color',
            'title'    => esc_html__( 'Class 3 Color', $theme_text_domain ),
            'desc' => '',
            'default'  => '#c3d545',
            'transparent' => false,
        ),
        array(
            'id'       => 'energy_4_color',
            'type'     => 'color',
            'title'    => esc_html__( 'Class 4 Color', $theme_text_domain ),
            'desc' => '',
            'default'  => '#fff12c',
            'transparent' => false,
        ),
        array(
            'id'       => 'energy_5_color',
            'type'     => 'color',
            'title'    => esc_html__( 'Class 5 Color', $theme_text_domain ),
            'desc' => '',
            'default'  => '#edb731',
            'transparent' => false,
        ),
        array(
            'id'       => 'energy_6_color',
            'type'     => 'color',
            'title'    => esc_html__( 'Class 6 Color', $theme_text_domain ),
            'desc' => '',
            'default'  => '#d66f2c',
            'transparent' => false,
        ),
        array(
            'id'       => 'energy_7_color',
            'type'     => 'color',
            'title'    => esc_html__( 'Class 7 Color', $theme_text_domain ),
            'desc' => '',
            'default'  => '#cc232a',
            'transparent' => false,
        ),
        array(
            'id'       => 'energy_8_color',
            'type'     => 'color',
            'title'    => esc_html__( 'Class 8 Color', $theme_text_domain ),
            'desc' => '',
            'default'  => '#cc232a',
            'transparent' => false,
        ),
        array(
            'id'       => 'energy_9_color',
            'type'     => 'color',
            'title'    => esc_html__( 'Class 9 Color', $theme_text_domain ),
            'desc' => '',
            'default'  => '#cc232a',
            'transparent' => false,
        ),
        array(
            'id'       => 'energy_10_color',
            'type'     => 'color',
            'title'    => esc_html__( 'Class 10 Color', $theme_text_domain ),
            'desc' => '',
            'default'  => '#cc232a',
            'transparent' => false,
        ),
    )
));

$prop_details_showhide_options = array(
    'prop_id' => esc_html__('Property ID', $theme_text_domain),
    'prop_type' => esc_html__('Type', $theme_text_domain),
    'prop_status' => esc_html__('Status', $theme_text_domain),
    'prop_label' => esc_html__('Label', $theme_text_domain),
    'sale_rent_price' => esc_html__('Sale or Rent Price', $theme_text_domain),
    'bedrooms' => esc_html__('Bedrooms', $theme_text_domain),
    'rooms' => esc_html__('Rooms', $theme_text_domain),
    'bathrooms' => esc_html__('Bathrooms', $theme_text_domain),
    'area_size' => esc_html__('Area Size', $theme_text_domain),
    'land_area' => esc_html__('Land Area', $theme_text_domain),
    'garages' => esc_html__('Garages', $theme_text_domain),
    'year_built' => esc_html__('Year Built', $theme_text_domain),
    'updated_date' => esc_html__('Updated Date', $theme_text_domain),
    'additional_details' => esc_html__('Additional Details', $theme_text_domain),
    'address' => esc_html__('Address', $theme_text_domain),
    'country' => esc_html__('Country', $theme_text_domain),
    'city' => esc_html__('City', $theme_text_domain),
    'state' => esc_html__('State/county', $theme_text_domain),
    'area' => esc_html__('Area', $theme_text_domain),
    'zip' => esc_html__('Zip/Postal Code', $theme_text_domain),
);

$prop_details_showhide_options = array_merge($prop_details_showhide_options, $custom_fields_array);

$prop_details_showhide_default = array(
    'prop_id' => '0',
    'prop_type' => '0',
    'prop_status' => '0',
    'prop_label' => '0',
    'sale_rent_price' => '0',
    'bedrooms' => '0',
    'rooms' => '0',
    'bathrooms' => '0',
    'area_size' => '0',
    'land_area' => '0',
    'garages' => '0',
    'year_built' => '0',
    'updated_date' => '0',
    'additional_details' => '0',
);

Redux::setSection( $opt_name, array(
    'title'  => esc_html__( 'Show/Hide Data', $theme_text_domain ),
    'id'     => 'propertydetail-showhide',
    'desc'   => '',
    'subsection' => true,
    'fields' => array(
        array(
            'id'       => 'print_property_button',
            'type'     => 'switch',
            'title'    => esc_html__( 'Print Property', $theme_text_domain ),
            'desc'     => '',
            'subtitle' => esc_html__( 'Enable/Disable print property button', $theme_text_domain ),
            'default'  => 1,
            'on'       => esc_html__( 'Enabled', $theme_text_domain ),
            'off'      => esc_html__( 'Disabled', $theme_text_domain ),
        ),
        array(
            'id'       => 'detail_featured_label',
            'type'     => 'switch',
            'title'    => esc_html__( 'Featured Label', $theme_text_domain ),
            'desc'     => '',
            'subtitle' => esc_html__( 'Enable/Disable featured label', $theme_text_domain ),
            'default'  => 1,
            'on'       => esc_html__( 'Enabled', $theme_text_domain ),
            'off'      => esc_html__( 'Disabled', $theme_text_domain ),
        ),
        array(
            'id'       => 'detail_status',
            'type'     => 'switch',
            'title'    => esc_html__( 'Status', $theme_text_domain ),
            'desc'     => '',
            'subtitle' => esc_html__( 'Enable/Disable property status', $theme_text_domain ),
            'default'  => 1,
            'on'       => esc_html__( 'Enabled', $theme_text_domain ),
            'off'      => esc_html__( 'Disabled', $theme_text_domain ),
        ),
        array(
            'id'       => 'detail_label',
            'type'     => 'switch',
            'title'    => esc_html__( 'Labels', $theme_text_domain ),
            'desc'     => '',
            'subtitle' => esc_html__( 'Enable/Disable property labels', $theme_text_domain ),
            'default'  => 1,
            'on'       => esc_html__( 'Enabled', $theme_text_domain ),
            'off'      => esc_html__( 'Disabled', $theme_text_domain ),
        ),
        array(
            'id'       => 'prop_detail_favorite',
            'type'     => 'switch',
            'title'    => esc_html__( 'Favorite Property', $theme_text_domain ),
            'desc'     => '',
            'subtitle' => esc_html__( 'Enable/Disable favorite property button', $theme_text_domain ),
            'default'  => 1,
            'on'       => esc_html__( 'Enabled', $theme_text_domain ),
            'off'      => esc_html__( 'Disabled', $theme_text_domain ),
        ),
        array(
            'id'       => 'prop_detail_share',
            'type'     => 'switch',
            'title'    => esc_html__( 'Share Property', $theme_text_domain ),
            'desc'     => '',
            'subtitle' => esc_html__( 'Enable/Disable share property button', $theme_text_domain ),
            'default'  => 1,
            'on'       => esc_html__( 'Enabled', $theme_text_domain ),
            'off'      => esc_html__( 'Disabled', $theme_text_domain ),
        ),
        array(
            'id'       => 'documents_download',
            'type'     => 'switch',
            'title'    => esc_html__( 'Documents Download', $theme_text_domain ),
            'subtitle' => esc_html__( 'Enable/Disable documents download only for registers users.', $theme_text_domain ),
            'default'  => 1,
            'on'       => esc_html__( 'Enabled', $theme_text_domain ),
            'off'      => esc_html__( 'Disabled', $theme_text_domain ),
        ),
        
        array(
            'id'       => 'hide_detail_prop_fields',
            'type'     => 'checkbox',
            'title'    => esc_html__( 'Property Detail Information', $theme_text_domain ),
            'desc'     => '',
            'subtitle' => esc_html__('Select which information you want to hide from the property detail page', $theme_text_domain),
            'options'  => $prop_details_showhide_options,
            'default' => $prop_details_showhide_default
        ),
    )
));

/* Adsense Spaces
----------------------------------------------------------------*/
Redux::setSection( $opt_name, array(
    'title'  => esc_html__( 'Adsense Spaces', $theme_text_domain ),
    'id'     => 'adsense_spaces',
    'desc'   => '',
    'subsection' => true,
    'fields' => array(
        array(
            'id'       => 'adsense_space_1',
            'type'     => 'textarea',
            'title'    => esc_html__( 'Adsense Space 1', $theme_text_domain ),
            'subtitle' => esc_html__( 'Paste your banner JS or Google Adsense code, html banner also allowed.', $theme_text_domain ),
        ),
        array(
            'id'       => 'adsense_space_2',
            'type'     => 'textarea',
            'title'    => esc_html__( 'Adsense Space 2', $theme_text_domain ),
            'subtitle' => esc_html__( 'Paste your banner JS or Google Adsense code, html banner also allowed.', $theme_text_domain ),
        ),
        array(
            'id'       => 'adsense_space_3',
            'type'     => 'textarea',
            'title'    => esc_html__( 'Adsense Space 3', $theme_text_domain ),
            'subtitle' => esc_html__( 'Paste your banner JS or Google Adsense code, html banner also allowed.', $theme_text_domain ),
        ),
    )
));


/* WalkScore
----------------------------------------------------------------*/
Redux::setSection( $opt_name, array(
    'title'  => esc_html__( 'Walkscore', $theme_text_domain ),
    'id'     => 'walkscore',
    'desc'   => '',
    'subsection' => true,
    'fields' => array(
        array(
            'id'       => 'yani_walkscore',
            'type'     => 'switch',
            'title'    => esc_html__( 'Walkscore', $theme_text_domain ),
            'desc' => esc_html__( 'Enable or disable the Walkscore section on property detail page.', $theme_text_domain ),
            'default'  => 0,
            'on'       => esc_html__( 'Enabled', $theme_text_domain ),
            'off'      => esc_html__( 'Disabled', $theme_text_domain ),
        ),
        array(
            'id'       => 'yani_walkscore_api',
            'type'     => 'text',
            'title'    => esc_html__( 'Walkscore API Key', $theme_text_domain ),
            'desc'     => wp_kses(__('Enter your Walkscore API key code. <a target="_blank" href="https://www.walkscore.com/professional/api.php">Get an API code</a>', $theme_text_domain ), $allowed_html_array),
            'required' => array('yani_walkscore', '=', '1')
        ),
    )
));


Redux::setSection( $opt_name, array(
    'title'  => esc_html__( 'Yelp Nearby Places', $theme_text_domain ),
    'id'     => 'yelp',
    'desc'   => '',
    'subsection' => true,
    'fields' => array(
        array(
            'id'       => 'yani_yelp',
            'type'     => 'switch',
            'title'    => esc_html__( 'Yelp', $theme_text_domain ),
            'desc' => esc_html__( 'Enable or disable Yelp on the property detail page.', $theme_text_domain ),
            'subtitle' => wp_kses(__( 'Please note that Yelp is not working for all countries. See here <a target="_blank" href="https://www.yelp.com/factsheet">https://www.yelp.com/factsheet</a> the list of countries where Yelp is available.', $theme_text_domain ), $allowed_html_array),
            'default'  => 0,
            'on'       => esc_html__( 'Enabled', $theme_text_domain ),
            'off'      => esc_html__( 'Disabled', $theme_text_domain ),
        ),
        array(
            'id'       => 'yani_yelp_api_key',
            'type'     => 'text',
            'title'    => esc_html__( 'Yelp API Key', $theme_text_domain ),
            //'subtitle' => esc_html__( "Yelp info doesn't show if you don't add the API Key.", $theme_text_domain ),
            'desc'     => wp_kses(__('Enter your Yelp API key code. <a target="_blank" href="https://www.yelp.com/developers/v3/manage_app">Get an API code</a>', $theme_text_domain), $allowed_html_array),
            'required' => array('yani_yelp', '=', '1')
        ),
        array(
            'id'       => 'yani_yelp_term',
            'type'     => 'select',
            'multi'    => true,
            'title'    => esc_html__( 'Yelp Categories', $theme_text_domain ),
            'desc' => esc_html__( "Select the Yelp categories that you want to display.", $theme_text_domain ),
            'options'  => $yelp_categories = array (
                'active' => 'Active Life',
                'arts' => 'Arts & Entertainment',
                'auto' => 'Automotive',
                'beautysvc' => 'Beauty & Spas',
                'education' => 'Education',
                'eventservices' => 'Event Planning & Services',
                'financialservices' => 'Financial Services',
                'food' => 'Food',
                'health' => 'Health & Medical',
                'homeservices' => 'Home Services ',
                'hotelstravel' => 'Hotels & Travel',
                'localflavor' => 'Local Flavor',
                'localservices' => 'Local Services',
                'massmedia' => 'Mass Media',
                'nightlife' => 'Nightlife',
                'pets' => 'Pets',
                'professional' => 'Professional Services',
                'publicservicesgovt' => 'Public Services & Government',
                'realestate' => 'Real Estate',
                'religiousorgs' => 'Religious Organizations',
                'restaurants' => 'Restaurants',
                'shopping' => 'Shoppi',
                'transport' => 'Transportation'
            ),
            'default' => array('food', 'health', 'education', 'realestate'),
            'required' => array('yani_yelp', '=', '1')
        ),
        array(
            'id'       => 'yani_yelp_limit',
            'type'     => 'text',
            'title'    => esc_html__( 'Yelp Results Limit', $theme_text_domain ),
            'desc' => esc_html__( "Enter the number of result that you want to display", $theme_text_domain ),
            'required' => array('yani_yelp', '=', '1'),
            'default' => 3
        ),
        array(
            'id'       => 'yani_yelp_dist_unit',
            'type'     => 'select',
            'multi'    => false,
            'title'    => esc_html__( 'Yelp Distance Unit', $theme_text_domain ),
            'desc' => esc_html__( "Select the distance unit.", $theme_text_domain ),
            'options'  => array (
                'miles' => 'Miles',
                'kilometers' => 'Kilometers'
            ),
            'default' => 'miles',
            'required' => array('yani_yelp', '=', '1')
        )
    )
));


/* Adsense Spaces
----------------------------------------------------------------*/
Redux::setSection( $opt_name, array(
    'title'  => esc_html__( 'Schedule a Tour', $theme_text_domain ),
    'id'     => 'schedule_a_tour',
    'desc'   => '',
    'subsection' => true,
    'fields' => array(
        array(
            'id'       => 'schedule_time_slots',
            'type'     => 'textarea',
            'title'    => esc_html__( 'Time Slots', $theme_text_domain ),
            'subtitle' => esc_html__( 'Use the comma to separate the time slots. (For example: 12:00 am, 12:15 am, 12:30 am)', $theme_text_domain ),
            'default'  => '10:00 am, 10:15 pm, 10:30 pm, 12:00 pm, 12:15 pm, 12:30 pm, 12:45 pm, 01:00 pm, 01:15 pm, 01:30 pm, 01:45 pm, 02:00 pm, 05:00 pm'
        )
    )
));

$custom_licon_fields = $builtin_icons = $default_fields = array();
$builtin_icons = _yani_field()->get_listing_fields_for_icons_luxury();
$all_icons_fields = array_merge($builtin_icons, $custom_fields_array);
foreach ($all_icons_fields as $key => $icon_field) {

    $prefix = '';
    if( !array_key_exists($key, $builtin_icons)) {
        $prefix = 'c_';
    }

    $custom_licon_fields[] = array(
        'id'        => $prefix.$key,
        'type'      => 'media',
        'title'     => $icon_field,
        'read-only' => false,
        'subtitle'  => esc_html__( 'Upload jpg, png or svg icon', $theme_text_domain ),
    );
}

/* Icons
----------------------------------------------------------------*/
Redux::setSection( $opt_name, array(
    'title'  => esc_html__( 'Luxury Homes Icons', $theme_text_domain ),
    'id'     => 'luxury-homes',
    'desc'   => esc_html__( 'Icons for the Luxury Homes property detail page', $theme_text_domain ),
    'subsection' => true,
    'fields' => $custom_licon_fields
));

Redux::setSection( $opt_name, array(
    'title'  => esc_html__( 'Mortgage Calculator', $theme_text_domain ),
    'id'     => 'prop-details-mortgage-cal',
    'desc'   => '',
    'subsection' => true,
    'fields' => array(
        array(
            'id'          => 'cal_where',
            'type'        => 'select',
            'title'       => esc_html__( 'Select the Status', $theme_text_domain ),
            'subtitle'    => esc_html__( 'Select status where you want to hide mortgage calculator', $theme_text_domain ),
            'desc'        => '',
            'multi'    => true,
            'data'  => 'terms',
            'args'  => array(
                'taxonomy' => array( 'property_status' ),
                'hide_empty' => false,
            )
        ),
        array(
            'id'       => 'mcal_down_payment',
            'type'     => 'text',
            'title'    => esc_html__( 'Default Down Payment', $theme_text_domain ),
            'subtitle' => esc_html__( 'Enter default down payment percentage(%)', $theme_text_domain ),
            'default'  => '15',
            'validate' => 'numeric'
        ),
        array(
            'id'       => 'mcal_terms',
            'type'     => 'text',
            'title'    => esc_html__( 'Default Terms(years)', $theme_text_domain ),
            'subtitle' => '',
            'default'  => '12',
            'validate' => 'numeric'
        ),
        array(
            'id'       => 'mcal_interest_rate',
            'type'     => 'text',
            'title'    => esc_html__( 'Default Interest Rate(%)', $theme_text_domain ),
            'subtitle' => '',
            'default'  => '3.5',
            'validate' => 'numeric'
        ),
        array(
            'id'       => 'mcal_prop_tax_enable',
            'type'     => 'switch',
            'title'    => esc_html__( 'Property Tax', $theme_text_domain ),
            'desc' => esc_html__( 'Enable or disable property tax', $theme_text_domain ),
            'default'  => 1,
            'on'       => esc_html__( 'Enabled', $theme_text_domain ),
            'off'      => esc_html__( 'Disabled', $theme_text_domain ),
        ),
        array(
            'id'       => 'mcal_prop_tax',
            'type'     => 'text',
            'title'    => esc_html__( 'Default Property tax', $theme_text_domain ),
            'subtitle' => '',
            'default'  => '3000',
            'required' => array('mcal_prop_tax_enable', '=', '1'),
            'validate' => 'numeric'
        ),
        array(
            'id'       => 'mcal_hi_enable',
            'type'     => 'switch',
            'title'    => esc_html__( 'Homey Insurance', $theme_text_domain ),
            'desc' => esc_html__( 'Enable or disable homey insurance', $theme_text_domain ),
            'default'  => 1,
            'on'       => esc_html__( 'Enabled', $theme_text_domain ),
            'off'      => esc_html__( 'Disabled', $theme_text_domain ),
        ),
        array(
            'id'       => 'mcal_hi',
            'type'     => 'text',
            'title'    => esc_html__( 'Default Homey Insurance', $theme_text_domain ),
            'subtitle' => '',
            'default'  => '1000',
            'required' => array('mcal_hi_enable', '=', '1'),
            'validate' => 'numeric'
        ),
        array(
            'id'       => 'mcal_pmi_enable',
            'type'     => 'switch',
            'title'    => esc_html__( 'PMI', $theme_text_domain ),
            'desc' => esc_html__( 'Enable or disable pmi', $theme_text_domain ),
            'default'  => 1,
            'on'       => esc_html__( 'Enabled', $theme_text_domain ),
            'off'      => esc_html__( 'Disabled', $theme_text_domain ),
        ),
        array(
            'id'       => 'mcal_pmi',
            'type'     => 'text',
            'title'    => esc_html__( 'Default PMI', $theme_text_domain ),
            'subtitle' => '',
            'default'  => '1000',
            'required' => array('mcal_pmi_enable', '=', '1'),
            'validate' => 'numeric'
        ),

    )
));

Redux::setSection( $opt_name, array(
    'title'  => esc_html__( 'Similar Properties', $theme_text_domain ),
    'id'     => 'property-similar-showhide',
    'desc'   => '',
    'subsection' => true,
    'fields' => array(
        array(
            'id'       => 'yani_similer_properties',
            'type'     => 'switch',
            'title'    => esc_html__( 'Similar Properties', $theme_text_domain ),
            'desc' => esc_html__( 'Enable or disable the similar properties on the property detail page.', $theme_text_domain ),
            'default'  => 0,
            'on'       => esc_html__( 'Enabled', $theme_text_domain ),
            'off'      => esc_html__( 'Disabled', $theme_text_domain ),
        ),
        array(
            'id'       => 'yani_similer_properties_type',
            'type'     => 'select',
            'multi'     => true,
            'title'    => esc_html__( 'Similar Properties Criteria', $theme_text_domain ),
            'desc' => esc_html__( "Choose which criteria you want to use to display similar properties.", $theme_text_domain ),
            'options'  => array(
                'property_type' => esc_html__('Property Type', $theme_text_domain),
                'property_status' => esc_html__('Property Status', $theme_text_domain),
                'property_label' => esc_html__('Property Label', $theme_text_domain),
                'property_feature' => esc_html__('Property Feature', $theme_text_domain),
                'property_country' => esc_html__('Property Country', $theme_text_domain),
                'property_state' => esc_html__('Property State', $theme_text_domain),
                'property_city' => esc_html__('Property City', $theme_text_domain),
                'property_area' => esc_html__('Property Area', $theme_text_domain),
            ),
            'default' => 'property_type'
        ),

        array(
            'id'       => 'similar_order',
            'type'     => 'select',
            'title'    => __('Default Order', $theme_text_domain),
            'desc' => '',
            'options'  => array(
                'd_date' => esc_html__( 'Date New to Old', $theme_text_domain ),
                'a_date' => esc_html__( 'Date Old to New', $theme_text_domain ),
                'd_price' => esc_html__( 'Price (High to Low)', $theme_text_domain ),
                'a_price' => esc_html__( 'Price (Low to High)', $theme_text_domain ),
                'featured_first' => esc_html__( 'Show Featured Listings on Top', $theme_text_domain ),
                'random' => esc_html__( 'Random', $theme_text_domain ),
            ),
            'default' => 'd_date'
        ),

        array(
            'id'       => 'yani_similer_properties_view',
            'type'     => 'select',
            'title'    => esc_html__( 'Similar Properties View', $theme_text_domain ),
            'desc' => esc_html__( "Select the view to display for similar properties.", $theme_text_domain ),
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
                'Listings Version 5' => array(
                    'list-view-v5' => 'List View',
                    'grid-view-v5' => 'Grid View',
                ),
                'grid-view-v6' => 'Grid View v6',
            ),
            'default' => 'list-view-v1'
        ),

        array(
            'id'       => 'yani_similer_properties_count',
            'type'     => 'select',
            'title'    => esc_html__( 'Similar Properties Number', $theme_text_domain ),
            'desc' => esc_html__( "Select how many similar properties to display", $theme_text_domain ),
            'options'  => array(
                1 => 1,
                2 => 2,
                3 => 3,
                4 => 4,
                5 => 5,
                6 => 6,
                7 => 7,
                8 => 8,
                9 => 9,
                10 => 10,
            ),
            'default' => 4
        )
    )
));

Redux::setSection( $opt_name, array(
    'title'  => esc_html__( 'Reviews & Ratings', $theme_text_domain ),
    'id'     => 'property-reviews',
    'desc'   => '',
    'subsection' => true,
    'fields' => array(

        array(
            'id'       => 'property_reviews',
            'type'     => 'switch',
            'title'    => esc_html__( 'Reviews & Ratings', $theme_text_domain ),
            'desc' => esc_html__( 'Enable or disable the reviews & ratings on the property detail page.', $theme_text_domain ),
            'default'  => 1,
            'on'       => esc_html__( 'Enabled', $theme_text_domain ),
            'off'      => esc_html__( 'Disabled', $theme_text_domain ),
        ),
        array(
            'id'       => 'property_reviews_approved_by_admin',
            'type'     => 'switch',
            'title'    => esc_html__( 'New Ratings Approved By Admin', $theme_text_domain ),
            'desc' => esc_html__( 'New reviews & ratings must be approved by the administrator', $theme_text_domain ),
            'default'  => 0,
            'on'       => esc_html__( 'Yes', $theme_text_domain ),
            'off'      => esc_html__( 'No', $theme_text_domain ),
        ),
        array(
            'id'       => 'update_review_approved',
            'type'     => 'switch',
            'title'    => esc_html__( 'Updated Ratings Approved by Admin', $theme_text_domain ),
            'desc' => esc_html__( 'Updated reviews & ratings must be approved by the administrator', $theme_text_domain ),
            'default'  => 0,
            'on'       => esc_html__( 'Yes', $theme_text_domain ),
            'off'      => esc_html__( 'No', $theme_text_domain ),
        ),
        array(
            'id'       => 'num_of_review',
            'type'     => 'text',
            'title'    => esc_html__( 'Number of Reviews', $theme_text_domain ),
            'desc' => esc_html__( 'Enter the number of reviews to display on the property detail page', $theme_text_domain ),
            'default'  => 5,
        )
    )
));

Redux::setSection( $opt_name, array(
    'title'  => esc_html__( 'Breadcrumbs', $theme_text_domain ),
    'id'     => 'property-breadcrumbs',
    'desc'   => '',
    'subsection' => true,
    'fields' => array(

        array(
            'id'       => 'single_prop_breadcrumb',
            'type'     => 'radio',
            'title'    => '',
            'subtitle' => esc_html__('Choose breadcrumb type for single propety page', $theme_text_domain),
            'default'  => 'property_type',
            'options'  => array(
                'property_type' => esc_html__('Property Type', $theme_text_domain),
                'property_status' => esc_html__('Property Status', $theme_text_domain),
                'property_status_type' => esc_html__('Property Status and Type', $theme_text_domain),
                'property_city' => esc_html__('Property City', $theme_text_domain),
                'property_area' => esc_html__('Property Area', $theme_text_domain),
                'property_city_area' => esc_html__('Property City and Area', $theme_text_domain),
            )
        )
    )
));


Redux::setSection( $opt_name, array(
    'title'  => esc_html__( 'Next/Prev Property', $theme_text_domain ),
    'id'     => 'property-next-prev',
    'desc'   => '',
    'subsection' => true,
    'fields' => array(

        array(
            'id'       => 'enable_next_prev_prop',
            'type'     => 'switch',
            'title'    => esc_html__( 'Next/Prev Property Navigation', $theme_text_domain ),
            'desc' => esc_html__( 'Enable or disable the next/prev property navigation at the end of the property detail page', $theme_text_domain ),
            'default'  => 0,
            'on'       => esc_html__( 'Enabled', $theme_text_domain ),
            'off'      => esc_html__( 'Disabled', $theme_text_domain ),
        )
    )
));

Redux::setSection( $opt_name, array(
    'title'  => esc_html__( 'Disclaimer', $theme_text_domain ),
    'id'     => 'property-disclaimer',
    'desc'   => '',
    'subsection' => true,
    'fields' => array(

        array(
            'id'       => 'enable_disclaimer',
            'type'     => 'switch',
            'title'    => esc_html__( 'Show Disclaimer', $theme_text_domain ),
            'desc' => esc_html__( 'Enable or disable disclaimer', $theme_text_domain ),
            'default'  => 1,
            'on'       => esc_html__( 'Enabled', $theme_text_domain ),
            'off'      => esc_html__( 'Disabled', $theme_text_domain ),
        ),
        array(
            'id'       => 'property_disclaimer',
            'type'     => 'textarea',
            'title'    => esc_html__( 'Disclaimer Text', $theme_text_domain ),
            'desc' => esc_html__( 'Add disclaimer text globally for all properties, this can be also set on single property level when add/edit property', $theme_text_domain ),
        )
    )
));