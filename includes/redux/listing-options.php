<?php
global $opt_name,$theme_text_domain;

$listing_composer = array(
    'bed' => esc_html__('Bedrooms', $theme_text_domain),
    'bath' => esc_html__('Bathrooms', $theme_text_domain),
    'area-size' => esc_html__('Area Size', $theme_text_domain),
);

$listing_composer_disabled = array(
    'room' => esc_html__('Rooms', $theme_text_domain),
    'land-area' => esc_html__('Land Area', $theme_text_domain),
    'garage' => esc_html__('Garage', $theme_text_domain),
    'property-id' => esc_html__('Property ID', $theme_text_domain),
);

$listing_composer_disabled = array_merge($listing_composer_disabled, $custom_fields_array);

Redux::setSection( $opt_name, array(
    'title'  => esc_html__( 'Composer', $theme_text_domain ),
    'id'     => 'lisitngs-composer',
    'desc'   => esc_html__( 'Manage list or grid view information on the listing pages', $theme_text_domain ),
    'subsection' => true,
    'fields'        => array(
        
        array(
            'id'      => 'listing_data_composer',
            'type'    => 'sorter',
            'title'   => 'Listing Meta Composer',
            'subtitle'    => esc_html__( 'Maximum 4 options allowed', $theme_text_domain ),
            'desc'    => esc_html__( 'Drag and drop layout manager, to quickly organize your grid and list meta.
', $theme_text_domain ),
            'options' => array(
                'enabled'  => $listing_composer,
                'disabled' => $listing_composer_disabled
            ),
        ),

        array(
            'id'      => 'listing_address_composer',
            'type'    => 'sorter',
            'title'   => 'Listing Address Composer',
            'subtitle'    => esc_html__( 'Manage address meta for list, grid and listing detail', $theme_text_domain ),
            'options' => array(
                'enabled'  => array(
                    'address' => esc_html__('Address', $theme_text_domain) 
                ),
                'disabled' => array(
                    'country' => esc_html__('Country', $theme_text_domain),
                    'state' => esc_html__('State', $theme_text_domain),
                    'city' => esc_html__('City', $theme_text_domain),
                    'area' => esc_html__('Area', $theme_text_domain),
                    'streat-address' => esc_html__('Streat Address', $theme_text_domain),
                ),
            ),
        ),
        
        
    )
));
/*-------------------------------------------------------------------------------
* Builder v1, v2 and half map 
*------------------------------------------------------------------------------*/
$listing_composer = array(
    'bed' => esc_html__('Bedrooms', $theme_text_domain),
    'bath' => esc_html__('Bathrooms', $theme_text_domain),
    'area-size' => esc_html__('Area Size', $theme_text_domain),
);

$listing_composer_disabled = array(
    'room' => esc_html__('Rooms', $theme_text_domain),
    'land-area' => esc_html__('Land Area', $theme_text_domain),
    'garage' => esc_html__('Garage', $theme_text_domain),
    'property-id' => esc_html__('Property ID', $theme_text_domain),
);

$listing_composer_disabled = array_merge($listing_composer_disabled, $custom_fields_array);

Redux::setSection( $opt_name, array(
    'title'  => esc_html__( 'Composer', $theme_text_domain ),
    'id'     => 'lisitngs-composer',
    'desc'   => esc_html__( 'Manage list or grid view information on the listing pages', $theme_text_domain ),
    'subsection' => true,
    'fields'        => array(
        
        array(
            'id'      => 'listing_data_composer',
            'type'    => 'sorter',
            'title'   => 'Listing Meta Composer',
            'subtitle'    => esc_html__( 'Maximum 4 options allowed', $theme_text_domain ),
            'desc'    => esc_html__( 'Drag and drop layout manager, to quickly organize your grid and list meta.
', $theme_text_domain ),
            'options' => array(
                'enabled'  => $listing_composer,
                'disabled' => $listing_composer_disabled
            ),
        ),

        array(
            'id'      => 'listing_address_composer',
            'type'    => 'sorter',
            'title'   => 'Listing Address Composer',
            'subtitle'    => esc_html__( 'Manage address meta for list, grid and listing detail', $theme_text_domain ),
            'options' => array(
                'enabled'  => array(
                    'address' => esc_html__('Address', $theme_text_domain) 
                ),
                'disabled' => array(
                    'country' => esc_html__('Country', $theme_text_domain),
                    'state' => esc_html__('State', $theme_text_domain),
                    'city' => esc_html__('City', $theme_text_domain),
                    'area' => esc_html__('Area', $theme_text_domain),
                    'streat-address' => esc_html__('Streat Address', $theme_text_domain),
                ),
            ),
        ),
        
        
    )
));

$custom_icon_fields = $builtin_fields = $default_fields = array();

$default_fields [] = array(
    'id'       => 'icons_type',
    'type'     => 'select',
    'title'    => esc_html__('Icons Type', $theme_text_domain),
    'subtitle' => '',
    'options'  => array(
        'houzez-default'   => esc_html__( 'Houzez Default Icons', $theme_text_domain ),
        'font-awesome'   => esc_html__( 'Fontawesome Icons v5', $theme_text_domain ),
        'custom'   => esc_html__( 'Custom Image Icons', $theme_text_domain ),
    ),
    'default'  => 'houzez-default',
);

$builtin_fields = _yani_field()->get_listing_fields_for_icons();
$all_fields = array_merge($builtin_fields, $custom_fields_array);

foreach ($all_fields as $key => $icon_field) {
    $custom_icon_fields[] = array(
        'id'        => $key,
        'type'      => 'media',
        'title'     => $icon_field,
        'read-only' => false,
        'required'   => array('icons_type', '=', 'custom'),
        'subtitle'  => esc_html__( 'Upload jpg, png or svg icon', $theme_text_domain ),
    );
    $custom_icon_fields[] = array(
        'id'        => 'fa_'.$key,
        'type'      => 'text',
        'title'     => $icon_field,
        'required'   => array('icons_type', '=', 'font-awesome'),
        'subtitle'  => esc_html__( 'Add font awesome icon class', $theme_text_domain ),
    );
}


$custom_icon_fields = array_merge($default_fields, $custom_icon_fields);

Redux::setSection( $opt_name, array(
    'title'  => esc_html__( 'Icons', $theme_text_domain ),
    'id'     => 'lisitngs-composer-icons',
    'desc'   => esc_html__( 'Manage list or grid icons on the listing pages', $theme_text_domain ),
    'subsection' => true,
    'fields'  => $custom_icon_fields
));

Redux::setSection( $opt_name, array(
    'title'  => esc_html__( 'Meta v1 and v4', $theme_text_domain ),
    'id'     => 'lisitngs-meta-v1v4',
    'desc'   => esc_html__( 'Manage list or grid (grid v.1 and v.4) meta type on the listing pages', $theme_text_domain ),
    'subsection' => true,
    'fields'  => array(
        array(
            'id'       => 'v1_4_meta_type',
            'type'     => 'select',
            'title'    => esc_html__('Meta Type v1 and v4', $theme_text_domain),
            'subtitle' => esc_html__('This option only works on the list view and grid v.1 and v.4', $theme_text_domain),
            'desc' => esc_html__('Select meta type', $theme_text_domain),
            'options'  => array(
                'icons'   => esc_html__( 'Icons', $theme_text_domain ),
                'icons_text' => esc_html__( 'Icons + Text', $theme_text_domain ),
                'text'   => esc_html__( 'Text', $theme_text_domain ),
            ),
            'default'  => 'icons',
        )
    )
));

Redux::setSection( $opt_name, array(
    'title'  => esc_html__( 'Meta v2', $theme_text_domain ),
    'id'     => 'lisitngs-meta-v2',
    'desc'   => esc_html__( 'Manage the meta type for the grid v2', $theme_text_domain ),
    'subsection' => true,
    'fields'  => array(
        array(
            'id'       => 'v2_meta_type',
            'type'     => 'select',
            'title'    => esc_html__('Meta Type v2', $theme_text_domain),
            'subtitle' => esc_html__('This option only works on the grid view v.2', $theme_text_domain),
            'desc' => esc_html__('Select meta type', $theme_text_domain),
            'options'  => array(
                'icons'   => esc_html__( 'With Icons', $theme_text_domain ),
                'without_icons' => esc_html__( 'Without Icons', $theme_text_domain ),
            ),
            'default'  => 'icons',
        )
    )
));


/*-------------------------------------------------------------------------------
* Listing Preview lightbox
*------------------------------------------------------------------------------*/
$preview_composer = array(
    'bed' => esc_html__('Bedrooms', $theme_text_domain),
    'bath' => esc_html__('Bathrooms', $theme_text_domain),
    'garage' => esc_html__('Garage', $theme_text_domain),
    'area-size' => esc_html__('Area Size', $theme_text_domain),
    'land-area' => esc_html__('Land Area', $theme_text_domain),
    'year-built' => esc_html__('Year Built', $theme_text_domain)
);

$preview_composer_disabled = array('property-id' => esc_html__('Property ID', $theme_text_domain), 'room' => esc_html__('Rooms', $theme_text_domain));

$preview_composer_disabled = array_merge($preview_composer_disabled, $custom_fields_array);
Redux::setSection( $opt_name, array(
    'title'  => esc_html__( 'Listing Preview lightbox', $theme_text_domain ),
    'id'     => 'listing-preview-options',
    'desc'   => esc_html__( 'Manage listing preview information', $theme_text_domain ),
    'subsection' => true,
    'fields' => array(
        array(
            'id'       => 'preview_meta_type',
            'type'     => 'select',
            'title'    => esc_html__('Meta Type', $theme_text_domain),
            'subtitle' => esc_html__('Select meta type for listing preview lightbox', $theme_text_domain),
            'desc' => esc_html__('Select meta type', $theme_text_domain),
            'options'  => array(
                'icons'   => esc_html__( 'Icons', $theme_text_domain ),
                'icons_text' => esc_html__( 'Icons + Text', $theme_text_domain ),
                'text'   => esc_html__( 'Text', $theme_text_domain ),
            ),
            'default'  => 'icons_text',
        ),
        array(
            'id'      => 'preview_data_composer',
            'type'    => 'sorter',
            'title'   => 'Meta Composer',
            'subtitle'    => esc_html__( 'Maximum 6 options allowed', $theme_text_domain ),
            'desc'    => esc_html__( 'Drag and drop layout manager, to quickly organize your preview meta.
', $theme_text_domain ),
            'options' => array(
                'enabled'  => $preview_composer,
                'disabled' => $preview_composer_disabled
            ),
        ),
        
    )
));

Redux::setSection( $opt_name, array(
    'title'  => esc_html__( 'Placeholder', $theme_text_domain ),
    'id'     => 'lisitngs-placeholder',
    'desc'   => esc_html__( 'Manage listings default Placeholder', $theme_text_domain ),
    'subsection' => true,
    'fields'        => array(
        
        array(
            'id'        => 'yani_placeholder',
            'url'       => false,
            'type'      => 'media',
            'title'     => esc_html__( 'Placeholder', $theme_text_domain ),
            'default'   => array( 'url' => '' ),
            'subtitle'  => esc_html__( 'Upload default placeholder. Recommended Size 1170 x 850 pixels', $theme_text_domain ),
            'desc'      => '',
        ),
        
        
    )
));
?>