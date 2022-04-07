<?php
global $opt_name,$theme_text_domain;
$custom_fields_array= array();

Redux::setSection( $opt_name, array(
    'title'  => esc_html__( 'Add New Property', $theme_text_domain ),
    'id'     => 'add-property-page',
    'desc'   => '',
    'icon'   => 'el-icon-plus-sign el-icon-small',
    'fields' => array(
        array(
            'id'       => 'submit_form_type',
            'type'     => 'select',
            'title'    => esc_html__('Add New Property Mode', $theme_text_domain),
            'subtitle' => '',
            'desc'     => esc_html__('Select between multi-steps or one step', $theme_text_domain),
            'options'  => array(
                'mstep'   => esc_html__( 'Multi-steps', $theme_text_domain ),
                'one_step'   => esc_html__( 'One-step', $theme_text_domain )
            ),
            'default'  => 'mstep',
        ),
        array(
            'id'       => 'listings_admin_approved',
            'type'     => 'select',
            'title'    => esc_html__('New Submited Listings Approval', $theme_text_domain),
            'subtitle' => '',
            'desc'     => esc_html__('Select yes if all new submissions must be approved by the administrator', $theme_text_domain),
            'options'  => array(
                'yes'   => esc_html__( 'Yes', $theme_text_domain ),
                'no'   => esc_html__( 'No', $theme_text_domain )
            ),
            'default'  => 'yes',
        ),
        array(
            'id'       => 'edit_listings_admin_approved',
            'type'     => 'select',
            'title'    => esc_html__('Edited Listings Approval', $theme_text_domain),
            'subtitle' => '',
            'desc'     => esc_html__('Select yes if all updates must be approved by the administrator', $theme_text_domain),
            'options'  => array(
                'yes'   => esc_html__( 'Yes', $theme_text_domain ),
                'no'   => esc_html__( 'No', $theme_text_domain )
            ),
            'default'  => 'no',
        ),
        array(
            'id'       => 'enable_multi_agents',
            'type'     => 'switch',
            'title'    => esc_html__( 'Multi Agents Mode', $theme_text_domain ),
            'desc'     => esc_html__( 'Enable or Disable the multi agents mode', $theme_text_domain ),
            'subtitle' => esc_html__( 'Assign a property to several agents', $theme_text_domain ),
            'default'  => 0,
            'on'       => esc_html__( 'Enable', $theme_text_domain ),
            'off'      => esc_html__( 'Disable', $theme_text_domain ),
        ),
        array(
            'id'       => 'range-bedsroomsbaths',
            'type'     => 'switch',
            'title'    => esc_html__( 'Range Values for Bedrooms, Bathrooms and Rooms', $theme_text_domain ),
            'desc'     => __( 'Note: Set search query Like for bedrooms, bathrooms and Rooms under <strong>Searches -> Settings</strong> to make it searchable.', $theme_text_domain ),
            'subtitle' => esc_html__( 'Enable range inputs for bedrooms, rooms and bathrooms fields. Example( 3 - 5, 2 - 4)', $theme_text_domain ),
            'default'  => 0,
            'on'       => esc_html__( 'Enable', $theme_text_domain ),
            'off'      => esc_html__( 'Disable', $theme_text_domain ),
        ),
        array(
            'id'       => 'add_ms_section-start',
            'type'     => 'section',
            'title'    => esc_html__( 'Multi Selection', $theme_text_domain ),
            'subtitle' => '',
            'indent'   => true,
        ),

        array(
            'id'       => 'ams_type',
            'type'     => 'switch',
            'title'    => esc_html__( 'Property Types', $theme_text_domain ),
            'desc'     => '',
            'subtitle' => esc_html__('Allow multiple selection of property types', $theme_text_domain),
            'default'  => 0,
            'on'       => esc_html__( 'Yes', $theme_text_domain ),
            'off'      => esc_html__( 'No', $theme_text_domain ),
        ),

        array(
            'id'       => 'ams_status',
            'type'     => 'switch',
            'title'    => esc_html__( 'Property Status', $theme_text_domain ),
            'desc'     => '',
            'subtitle' => esc_html__('Allow multiple selection of property status', $theme_text_domain),
            'default'  => 0,
            'on'       => esc_html__( 'Yes', $theme_text_domain ),
            'off'      => esc_html__( 'No', $theme_text_domain ),
        ),

        array(
            'id'       => 'ams_label',
            'type'     => 'switch',
            'title'    => esc_html__( 'Property Labels', $theme_text_domain ),
            'desc'     => '',
            'subtitle' => esc_html__('Allow multiple selection of property labels', $theme_text_domain),
            'default'  => 0,
            'on'       => esc_html__( 'Yes', $theme_text_domain ),
            'off'      => esc_html__( 'No', $theme_text_domain ),
        ),
        array(
            'id'     => 'add_ms_section_end',

            'type'   => 'section',
            'indent' => false,
        ),
        
        array(
            'id'       => 'location_dropdowns',
            'type'     => 'select',
            'title'    => esc_html__('Display Drop-down Menus', $theme_text_domain),
            'subtitle' => '',
            'desc'     => esc_html__('Select Yes to replace the Property Location text fields with drop-down menus in order to select the property City, Area, County/State and Country', $theme_text_domain),
            'options'  => array(
                'yes'   => esc_html__( 'Yes', $theme_text_domain ),
                'no'   => esc_html__( 'No', $theme_text_domain )
            ),
            'default'  => 'no',
        ),
        array(
            'id'		=> 'area_prefix_default',
            'type'		=> 'select',
            'title'		=> esc_html__( 'Default area prefix', $theme_text_domain ),
            'subtitle'	=> esc_html__( 'Default option for area prefix.', $theme_text_domain ),
            'options'	=> array(
                'SqFt' => 'Square Feet - ft²',
                'm²' => 'Square Meters - m²',
            ),
            'default' => 'SqFt'
        ),
        array(
            'id'       => 'area_prefix_changeable',
            'type'     => 'switch',
            'title'    => esc_html__( 'Allow user to change area prefix?', $theme_text_domain ),
            'desc'     => '',
            'subtitle' => '',
            'default'  => 1,
            'on'       => esc_html__( 'Yes', $theme_text_domain ),
            'off'      => esc_html__( 'No', $theme_text_domain ),
        ),
        array(
            'id'       => 'auto_property_id',
            'type'     => 'switch',
            'title'    => esc_html__( 'Auto Generate Property ID ?', $theme_text_domain ),
            'desc'     => '',
            'subtitle' => esc_html__( 'Enable/Disable auto generate property id', $theme_text_domain ),
            'default'  => 0,
            'on'       => esc_html__( 'Enabled', $theme_text_domain ),
            'off'      => esc_html__( 'Disabled', $theme_text_domain ),
        ),
        array(
            'id'        => 'property_id_pattern',
            'type'      => 'text',
            'title'     => esc_html__( 'Property ID Pattern', $theme_text_domain ),
            'subtitle'  => esc_html__( "Enter pattern for property id. Example HZ-{ID}", $theme_text_domain ),
            'default' => '{ID}',
            'required' => array('auto_property_id', '=', '1')
        ),
        array(
            'id'        => 'property_id_prefix',
            'type'      => 'text',
            'title'     => esc_html__( 'Property ID Prefix', $theme_text_domain ),
            'subtitle'  => esc_html__( "Enter prefix for property id, leave empty if you don't want to show prefix. Example HZ-", $theme_text_domain ),
            'default' => ''
        ),
        array(
            'id'       => 'max_prop_images',
            'type'     => 'text',
            'title'    => esc_html__( 'Maximum Images', $theme_text_domain ),
            'desc'     => '',
            'subtitle' => esc_html__('Maximum images allow for single property.', $theme_text_domain),
            'default' => '50'
        ),
        array(
            'id'       => 'image_max_file_size',
            'type'     => 'text',
            'title'    => esc_html__( 'Maximum File Size', $theme_text_domain ),
            'desc'     => '',
            'subtitle' => esc_html__('Maximum upload image size. For example 10kb, 500kb, 1mb, 10m, 100mb', $theme_text_domain),
            'default' => '12000kb'
        ),
        array(
            'id'       => 'max_prop_attachments',
            'type'     => 'text',
            'title'    => esc_html__( 'Maximum Attachments', $theme_text_domain ),
            'desc'     => '',
            'subtitle' => '',
            'default' => '3'
        ),
        array(
            'id'       => 'attachment_max_file_size',
            'type'     => 'text',
            'title'    => esc_html__( 'Maximum File Size for attachments', $theme_text_domain ),
            'desc'     => '',
            'subtitle' => esc_html__('Maximum upload attachment size. For example 10kb, 500kb, 1mb, 10m, 100mb', $theme_text_domain),
            'default' => '3000kb'
        ),
    )
));

Redux::setSection( $opt_name, array(
    'title'  => esc_html__( 'Layout Manager', $theme_text_domain ),
    'id'     => 'Add-new-property-layout-manager',
    'desc'   => '',
    'subsection' => true,
    'fields' => array(
        array(
            'id'      => 'property_form_sections',
            'type'    => 'sorter',
            'title'   => 'Add New Property Form Layout Manager',
            'subtitle'    => 'Drag-and-drop each module to quickly organize your property submission form layout',
            'options' => array(
                'enabled'  => array(
                    'description-price'     => esc_html__('Description & Price', $theme_text_domain),
                    'media'                 => esc_html__('Property Media', $theme_text_domain),
                    'details'               => esc_html__('Property Details', $theme_text_domain),
                    'features'              => esc_html__('Property Features', $theme_text_domain),
                    'location'              => esc_html__('Property Location', $theme_text_domain),
                    'virtual_tour'          => esc_html__('360° Virtual Tour', $theme_text_domain),
                    'floorplans'            => esc_html__('Floor Plans', $theme_text_domain),
                    'multi-units'           => esc_html__('Multi Units / Sub Properties', $theme_text_domain),
                    'agent_info'            => esc_html__('Agent Information', $theme_text_domain),
                    'private_note'          => esc_html__('Private Notes', $theme_text_domain)
                ),
                'disabled' => array(
                    'attachments'    => esc_html__('Attachments', $theme_text_domain),
                    'energy_class'    => esc_html__('Energy Class', $theme_text_domain)
                )
            ),
        ),
    )
));
$submit_form_required_fields = array(
    'title' => esc_html__('Title', $theme_text_domain),
    
    'prop_type' => esc_html__('Type', $theme_text_domain),
    'prop_status' => esc_html__('Status', $theme_text_domain),
    'prop_labels' => esc_html__('Label', $theme_text_domain),
    'sale_rent_price' => esc_html__('Sale or Rent Price', $theme_text_domain),
    'prop_second_price' => esc_html__('Second Price ( Display optional price for rental or square feet )', $theme_text_domain),
    'price_label' => esc_html__('After Price Label', $theme_text_domain),
    'prop_id' => esc_html__('Property ID', $theme_text_domain),
    'bedrooms' => esc_html__('Bedrooms', $theme_text_domain),
    'rooms' => esc_html__('Rooms', $theme_text_domain),
    'bathrooms' => esc_html__('Bathrooms', $theme_text_domain),
    'area_size' => esc_html__('Area Size', $theme_text_domain),
    'land_area' => esc_html__('Land Area', $theme_text_domain),
    'garages' => esc_html__('Garages', $theme_text_domain),
    'year_built' => esc_html__('Year Built', $theme_text_domain),
    'energy_class' => esc_html__('Energy Class', $theme_text_domain),
    'property_map_address' => esc_html__('Map Address', $theme_text_domain),
    'country' => esc_html__('Country', $theme_text_domain),
    'state' => esc_html__('State', $theme_text_domain),
    'city' => esc_html__('City', $theme_text_domain),
    'area' => esc_html__('Area', $theme_text_domain),
    
    
);


$submit_form_fields = array(
    'beds' => esc_html__('Bedrooms', _yani_theme()->get_text_domain()),
    'rooms' => esc_html__('Rooms', _yani_theme()->get_text_domain()),
    'baths' => esc_html__('Bathrooms', _yani_theme()->get_text_domain()),
    'area-size' => esc_html__('Area Size', _yani_theme()->get_text_domain()),
    'area-size-unit' => esc_html__('Area Size Unit', _yani_theme()->get_text_domain()),
    'land-area' => esc_html__('Land Area', _yani_theme()->get_text_domain()),
    'land-area-unit' => esc_html__('Land Area Unit', _yani_theme()->get_text_domain()),
    'garage' => esc_html__('Garage', _yani_theme()->get_text_domain()),
    'garage-size' => esc_html__('Garage Size', _yani_theme()->get_text_domain()),
    'property-id' => esc_html__('Property ID', _yani_theme()->get_text_domain()),
    'year' => esc_html__('Year Built', _yani_theme()->get_text_domain()),
);
$submit_form_fields = array_merge($submit_form_fields, $custom_fields_array);

Redux::setSection( $opt_name, array(
    'title'  => esc_html__( 'Show/Hide Form Fields', $theme_text_domain ),
    'id'     => 'property-showhide',
    'desc'   => '',
    'subsection' => true,
    'fields' => array(
        array(
            'id'      => 'adp_details_fields',
            'type'    => 'sorter',
            'title'   => 'Property Detail Section',
            'subtitle'    => 'Drag-and-drop each module to quickly organize the form fields order of Property Details section.',
            'options' => array(
                'enabled'  => $submit_form_fields,
                'disabled' => array()
            ),
        ),
        array(
            'id'       => 'hide_add_prop_fields',
            'type'     => 'checkbox',
            'title'    => esc_html__( 'Add New Property Form Fields', $theme_text_domain ),
            'desc'     => '',
            'subtitle' => esc_html__('Select which fields you want to disable from the Add New Property form', $theme_text_domain),
            'options'  => array(
                'prop_type' => esc_html__('Property Type', $theme_text_domain),
                'prop_status' => esc_html__('Property Status', $theme_text_domain),
                'prop_label' => esc_html__('Property Label', $theme_text_domain),
                'sale_rent_price' => esc_html__('Sale or Rent Price', $theme_text_domain),
                'second_price' => esc_html__('Second Price', $theme_text_domain),
                'price_postfix' => esc_html__('After Price Label', $theme_text_domain),
                'price_prefix' => esc_html__('Price Prefix', $theme_text_domain),
                'video_url' => esc_html__('Property Video Url', $theme_text_domain),
                'neighborhood' => esc_html__('Neighborhood', $theme_text_domain),
                'city' => esc_html__('City', $theme_text_domain),
                'postal_code' => esc_html__('Postal Code/Zip', $theme_text_domain),
                'state' => esc_html__('County/State', $theme_text_domain),
                'country' => esc_html__('Country', $theme_text_domain),
                'map' => esc_html__('Map Section', $theme_text_domain),
                'map_address' => esc_html__('Map Address', $theme_text_domain),
                'additional_details' => esc_html__('Additional Details', $theme_text_domain),
            ),
            'default' => array(
                'prop_type' => '0',
                'prop_status' => '0',
                'prop_label' => '0',
                'sale_rent_price' => '0',
                'second_price' => '0',
                'price_postfix' => '0',
                'price_prefix' => '0',
                'video_url' => '0',
                'neighborhood' => '0',
                'city' => '0',
                'postal_code' => '0',
                'state' => '0',
                'country' => '0',
                'map' => '0',
                'map_address' => '0',
                'additional_details' => '0',
            )
        ),
    )
));
$submit_form_required_fields = array_merge($submit_form_required_fields, $custom_fields_array);
Redux::setSection( $opt_name, array(
    'title'  => esc_html__( 'Required Form Fields', $theme_text_domain ),
    'id'     => 'property-required-fields',
    'desc'   => '',
    'subsection' => true,
    'fields' => array(
        array(
            'id'       => 'enable_title_limit',
            'type'     => 'switch',
            'title'    => esc_html__( 'Property Title Limit', $theme_text_domain ),
            'desc'     => '',
            'subtitle' => esc_html__( 'Limit Title length for add listing', $theme_text_domain ),
            'default'  => 0,
            'on'       => esc_html__( 'Enabled', $theme_text_domain ),
            'off'      => esc_html__( 'Disabled', $theme_text_domain ),
        ),
        array(
            'id'       => 'property_title_limit',
            'type'     => 'text',
            'title'    => esc_html__( 'Number of Characters', $theme_text_domain ),
            'subtitle' => esc_html__( 'Enter number of allowed characters.ie 150', $theme_text_domain ),
            'default'  => '',
            'validate'  => 'numeric',
            'required'  => array('enable_title_limit', '=', '1'),
        ),
        array(
            'id'       => 'required_fields',
            'type'     => 'checkbox',
            'title'    => esc_html__( 'Required Fields', $theme_text_domain ),
            'desc'     => '',
            'subtitle' => esc_html__('Select which fields of the Add New Property form are mandatory', $theme_text_domain),
            'options'  => $submit_form_required_fields,
            'default' => array(
                'title' => '1',
                'prop_type' => '0',
                'prop_status' => '0',
                'prop_labels' => '0',
                'sale_rent_price' => '1',
                'prop_second_price' => '0',
                'price_label' => '0',
                'prop_id' => '0',
                'bedrooms' => '0',
                'rooms' => '0',
                'bathrooms' => '0',
                'area_size' => '1',
                'land_area' => '0',
                'garages' => '0',
                'year_built' => '0',
                'property_map_address' => '1',
                'energy_class' => '0',
                'area' => '0',
                'city' => '0',
                'state' => '0',
                'country' => '0',
                
            )
        ),
    )
));
?>