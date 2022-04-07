<?php

global $opt_name,$theme_text_domain;
Redux::setSection( $opt_name, array(
    'title'  => esc_html__( 'Translation', $theme_text_domain ),
    'id'     => 'labels-management',
    'desc'   => '',
    'icon'   => 'el-icon-home el-icon-small',
    'fields'        => array(
        
    )
));
Redux::setSection( $opt_name, array(
    'title'  => esc_html__( 'Common', $theme_text_domain ),
    'id'     => 'common-labels',
    'desc'   => '',
    'subsection'   => true,
    'fields'        => array(
        array(
            'id'       => 'cl_common_section-start',
            'type'     => 'section',
            'title'    => esc_html__('Common', $theme_text_domain),
            'subtitle' => esc_html__('Manage common strings accross site', $theme_text_domain),
            'indent'   => true,
        ),
        array(
            'id'       => 'cl_featured_label',
            'type'     => 'text',
            'title'    => esc_html__('Featured Label', $theme_text_domain),
            'desc'     => '',
            'subtitle' => '',
            'default' => 'Featured',
        ),
        array(
            'id'       => 'cl_property',
            'type'     => 'text',
            'title'    => esc_html__('Property', $theme_text_domain),
            'desc'     => '',
            'subtitle' => '',
            'default' => 'Property',
        ),
        array(
            'id'       => 'cl_properties',
            'type'     => 'text',
            'title'    => esc_html__('Properties', $theme_text_domain),
            'desc'     => '',
            'subtitle' => '',
            'default' => 'Properties',
        ),
        array(
            'id'       => 'cl_favorite',
            'type'     => 'text',
            'title'    => esc_html__('Favourite', $theme_text_domain),
            'desc'     => '',
            'subtitle' => '',
            'default' => 'Favourite',
        ),
        array(
            'id'       => 'cl_preview',
            'type'     => 'text',
            'title'    => esc_html__('Preview', $theme_text_domain),
            'desc'     => '',
            'subtitle' => '',
            'default' => 'Preview',
        ),
        array(
            'id'       => 'cl_add_compare',
            'type'     => 'text',
            'title'    => esc_html__('Add Compare', $theme_text_domain),
            'desc'     => '',
            'subtitle' => '',
            'default' => 'Add to Compare',
        ),
        array(
            'id'       => 'cl_remove_compare',
            'type'     => 'text',
            'title'    => esc_html__('Remove Compare', $theme_text_domain),
            'desc'     => '',
            'subtitle' => '',
            'default' => 'Remove from Compare',
        ),
        array(
            'id'       => 'cl_none',
            'type'     => 'text',
            'title'    => esc_html__('None Label', $theme_text_domain),
            'default' => 'None',
        ),
        array(
            'id'       => 'cl_select',
            'type'     => 'text',
            'title'    => esc_html__('Select Label', $theme_text_domain),
            'default' => 'Select',
        ),
        array(
            'id'       => 'cl_only_digits',
            'type'     => 'text',
            'title'    => esc_html__('Only digits Label', $theme_text_domain),
            'default' => 'Only digits',
        ),
        array(
            'id'       => 'cl_example',
            'type'     => 'text',
            'title'    => esc_html__('For Example Label', $theme_text_domain),
            'default' => 'For example',
        ),
        array(
            'id'       => 'cl_hide',
            'type'     => 'text',
            'title'    => esc_html__('Hide Label', $theme_text_domain),
            'default' => 'Hide',
        ),
        array(
            'id'       => 'cl_show',
            'type'     => 'text',
            'title'    => esc_html__('Show Label', $theme_text_domain),
            'default' => 'Show',
        ),
        array(
            'id'       => 'cl_yes',
            'type'     => 'text',
            'title'    => esc_html__('Yes Label', $theme_text_domain),
            'default' => 'Yes',
        ),
        array(
            'id'       => 'cl_no',
            'type'     => 'text',
            'title'    => esc_html__('No Label', $theme_text_domain),
            'default' => 'No',
        ),
        array(
            'id'       => 'cl_or',
            'type'     => 'text',
            'title'    => esc_html__('OR Label', $theme_text_domain),
            'default' => 'OR',
        ),
        array(
            'id'       => 'cl_select_all',
            'type'     => 'text',
            'title'    => esc_html__('Select All', $theme_text_domain),
            'default' => 'Select All',
        ),
        array(
            'id'       => 'cl_deselect_all',
            'type'     => 'text',
            'title'    => esc_html__('Deselect All', $theme_text_domain),
            'default' => 'Deselect All',
        ),
        array(
            'id'       => 'cl_no_results_matched',
            'type'     => 'text',
            'title'    => esc_html__('No results matched', $theme_text_domain),
            'default' => 'No results matched',
        ),
        array(
            'id'       => 'cl_common_section-end',
            'type'     => 'section',
            'indent'   => false,
        ),
    )
));

Redux::setSection( $opt_name, array(
    'title'  => esc_html__( 'Searches', $theme_text_domain ),
    'id'     => 'searches-labels',
    'desc'   => '',
    'subsection'   => true,
    'fields'        => array(
        array(
            'id'       => 'srh_labels_section-start',
            'type'     => 'section',
            'title'    => '',
            'subtitle' => esc_html__('Manage labels for searches accross the site', $theme_text_domain),
            'indent'   => true,
        ),

        array(
            'id'       => 'srh_item_selected',
            'type'     => 'text',
            'title'    => esc_html__('items selected', $theme_text_domain),
            'default' => 'items selected',
        ),
        array(
            'id'       => 'srh_any',
            'type'     => 'text',
            'title'    => esc_html__('Any', $theme_text_domain),
            'default' => 'Any',
        ),
        array(
            'id'       => 'srh_keyword',
            'type'     => 'text',
            'title'    => esc_html__('Keyword', $theme_text_domain),
            'default' => 'Enter Keyword...',
        ),
        array(
            'id'       => 'srh_address',
            'type'     => 'text',
            'title'    => esc_html__('Address, town, street, zip or property ID', $theme_text_domain),
            'default' => 'Enter an address, town, street, zip or property ID',
        ),

        array(
            'id'       => 'srh_csa',
            'type'     => 'text',
            'title'    => esc_html__('City, State or Area', $theme_text_domain),
            'default' => 'Search City, State or Area',
        ),
        array(
            'id'       => 'srh_location',
            'type'     => 'text',
            'title'    => esc_html__('Location', $theme_text_domain),
            'default' => 'Location',
        ),
        array(
            'id'       => 'srh_radius',
            'type'     => 'text',
            'title'    => esc_html__('Radius', $theme_text_domain),
            'default' => 'Radius',
        ),
        array(
            'id'       => 'srh_type',
            'type'     => 'text',
            'title'    => esc_html__('Type', $theme_text_domain),
            'default' => 'Type',
        ),
        array(
            'id'       => 'srh_types',
            'type'     => 'text',
            'title'    => esc_html__('types selected', $theme_text_domain),
            'default' => 'types selected',
        ),
        array(
            'id'       => 'srh_status',
            'type'     => 'text',
            'title'    => esc_html__('Status', $theme_text_domain),
            'default' => 'Status',
        ),
        array(
            'id'       => 'srh_statuses',
            'type'     => 'text',
            'title'    => esc_html__('statuses selected', $theme_text_domain),
            'default' => 'status selected',
        ),
        array(
            'id'       => 'srh_label',
            'type'     => 'text',
            'title'    => esc_html__('Label', $theme_text_domain),
            'default' => 'Label',
        ),
        array(
            'id'       => 'srh_labels',
            'type'     => 'text',
            'title'    => esc_html__('Labels', $theme_text_domain),
            'default' => 'Labels',
        ),

        array(
            'id'       => 'srh_all_status',
            'type'     => 'text',
            'title'    => esc_html__('All Status', $theme_text_domain),
            'default' => 'All Status',
        ),
        array(
            'id'       => 'srh_bedrooms',
            'type'     => 'text',
            'title'    => esc_html__('Bedrooms', $theme_text_domain),
            'default' => 'Bedrooms',
        ),
        array(
            'id'       => 'srh_studio',
            'type'     => 'text',
            'title'    => esc_html__('Studio', $theme_text_domain),
            'default' => 'Studio',
        ),
        array(
            'id'       => 'srh_rooms',
            'type'     => 'text',
            'title'    => esc_html__('Rooms', $theme_text_domain),
            'default' => 'Rooms',
        ),
        array(
            'id'       => 'srh_bathrooms',
            'type'     => 'text',
            'title'    => esc_html__('Bathrooms', $theme_text_domain),
            'default' => 'Bathrooms',
        ),
        array(
            'id'       => 'srh_beds',
            'type'     => 'text',
            'title'    => esc_html__('Beds', $theme_text_domain),
            'default' => 'Beds',
        ),
        array(
            'id'       => 'srh_baths',
            'type'     => 'text',
            'title'    => esc_html__('Baths', $theme_text_domain),
            'default' => 'Baths',
        ),
        array(
            'id'       => 'srh_min_area',
            'type'     => 'text',
            'title'    => esc_html__('Min Area', $theme_text_domain),
            'default' => 'Min. Area',
        ),
        array(
            'id'       => 'srh_max_area',
            'type'     => 'text',
            'title'    => esc_html__('Max Area', $theme_text_domain),
            'default' => 'Max. Area',
        ),
        array(
            'id'       => 'srh_min_land_area',
            'type'     => 'text',
            'title'    => esc_html__('Min Land Area', $theme_text_domain),
            'default' => 'Min. Land Area',
        ),
        array(
            'id'       => 'srh_max_land_area',
            'type'     => 'text',
            'title'    => esc_html__('Max Land Area', $theme_text_domain),
            'default' => 'Max. Land Area',
        ),
        array(
            'id'       => 'srh_min_price',
            'type'     => 'text',
            'title'    => esc_html__('Min Price', $theme_text_domain),
            'default' => 'Min. Price',
        ),
        array(
            'id'       => 'srh_max_price',
            'type'     => 'text',
            'title'    => esc_html__('Max Price', $theme_text_domain),
            'default' => 'Max. Price',
        ),
        array(
            'id'       => 'srh_price',
            'type'     => 'text',
            'title'    => esc_html__('Price', $theme_text_domain),
            'default' => 'Price',
        ),
        array(
            'id'       => 'srh_price_range',
            'type'     => 'text',
            'title'    => esc_html__('Price Range', $theme_text_domain),
            'default' => 'Price Range',
        ),
        array(
            'id'       => 'srh_from',
            'type'     => 'text',
            'title'    => esc_html__('From', $theme_text_domain),
            'default' => 'From',
        ),
        array(
            'id'       => 'srh_to',
            'type'     => 'text',
            'title'    => esc_html__('To', $theme_text_domain),
            'default' => 'To',
        ),
        array(
            'id'       => 'srh_prop_id',
            'type'     => 'text',
            'title'    => esc_html__('Property ID', $theme_text_domain),
            'default' => 'Property ID',
        ),
        array(
            'id'       => 'srh_countries',
            'type'     => 'text',
            'title'    => esc_html__('All Countries', $theme_text_domain),
            'default' => 'All Countries',
        ),
        array(
            'id'       => 'srh_states',
            'type'     => 'text',
            'title'    => esc_html__('All States', $theme_text_domain),
            'default' => 'All States',
        ),
        array(
            'id'       => 'srh_cities',
            'type'     => 'text',
            'title'    => esc_html__('All Cities', $theme_text_domain),
            'default' => 'All Cities',
        ),
        array(
            'id'       => 'srh_areas',
            'type'     => 'text',
            'title'    => esc_html__('All Areas', $theme_text_domain),
            'default' => 'All Areas',
        ),
        array(
            'id'       => 'srh_areass',
            'type'     => 'text',
            'title'    => esc_html__('Areas Selected', $theme_text_domain),
            'default' => 'areas selected',
        ),

        array(
            'id'       => 'srh_garage',
            'type'     => 'text',
            'title'    => esc_html__('Garage', $theme_text_domain),
            'default' => 'Garage',
        ),

        array(
            'id'       => 'srh_year_built',
            'type'     => 'text',
            'title'    => esc_html__('Year Built', $theme_text_domain),
            'default' => 'Year Built',
        ),

        array(
            'id'       => 'srh_currency',
            'type'     => 'text',
            'title'    => esc_html__('Currency', $theme_text_domain),
            'default' => 'Currency',
        ),

        array(
            'id'       => 'srh_other_features',
            'type'     => 'text',
            'title'    => esc_html__('Other Features', $theme_text_domain),
            'default' => 'Other Features',
        ),

        array(
            'id'       => 'srh_btn_adv',
            'type'     => 'text',
            'title'    => esc_html__('Advanced Button', $theme_text_domain),
            'default' => 'Advanced',
        ),
        array(
            'id'       => 'srh_btn_search',
            'type'     => 'text',
            'title'    => esc_html__('Search Button', $theme_text_domain),
            'default' => 'Search',
        ),
        array(
            'id'       => 'srh_btn_go',
            'type'     => 'text',
            'title'    => esc_html__('Go Button', $theme_text_domain),
            'default' => 'Go',
        ),
        array(
            'id'       => 'srh_btn_save_search',
            'type'     => 'text',
            'title'    => esc_html__('Save Search Button', $theme_text_domain),
            'default' => 'Save Search',
        ),

        array(
            'id'       => 'srh_dock_title',
            'type'     => 'text',
            'title'    => esc_html__('Dock Search Main Title', $theme_text_domain),
            'default' => 'Advanced Search',
        ),

        array(
            'id'       => 'srh_mobile_title',
            'type'     => 'text',
            'title'    => esc_html__('Mobile Search Placeholder', $theme_text_domain),
            'default' => 'Search',
        ),

        array(
            'id'       => 'srh_btn_more',
            'type'     => 'text',
            'title'    => esc_html__('More Options Button', $theme_text_domain),
            'default' => 'More Options',
        ),
        array(
            'id'       => 'srh_clear',
            'type'     => 'text',
            'title'    => esc_html__('Clear', $theme_text_domain),
            'default' => 'Clear',
        ),
        array(
            'id'       => 'srh_apply',
            'type'     => 'text',
            'title'    => esc_html__('Apply', $theme_text_domain),
            'default' => 'Apply',
        ),

        array(
            'id'       => 'srh_labels_section-end',
            'type'     => 'section',
            'indent'   => false,
        ),
    )
));

Redux::setSection( $opt_name, array(
    'title'  => esc_html__( 'Grid, List, Card & Preview', $theme_text_domain ),
    'id'     => 'glcp-translation',
    'desc'   => esc_html__( 'Manage titles for listings Grid, List, Card and Preview views', $theme_text_domain ),
    'subsection'   => true,
    'fields'        => array(
        
        /*--------------------------------------------------------------
        * Grid, list, card and preview
        **------------------------------------------------------------*/
        array(
            'id'       => 'cl_glcp_section-start',
            'type'     => 'section',
            'indent'   => true,
        ),

        array(
            'id'       => 'glc_bedroom',
            'type'     => 'text',
            'title'    => esc_html__('Bedroom Label', $theme_text_domain),
            'default' => 'Bedroom',
        ),
        array(
            'id'       => 'glc_bedrooms',
            'type'     => 'text',
            'title'    => esc_html__('Bedrooms Label', $theme_text_domain),
            'default' => 'Bedrooms',
        ),
        array(
            'id'       => 'glc_bathroom',
            'type'     => 'text',
            'title'    => esc_html__('Bathroom Label', $theme_text_domain),
            'default' => 'Bathroom',
        ),
        array(
            'id'       => 'glc_bathrooms',
            'type'     => 'text',
            'title'    => esc_html__('Bathrooms Label', $theme_text_domain),
            'default' => 'Bathrooms',
        ),
        array(
            'id'       => 'glc_bed',
            'type'     => 'text',
            'title'    => esc_html__('Bed Label', $theme_text_domain),
            'default' => 'Bed',
        ),
        array(
            'id'       => 'glc_beds',
            'type'     => 'text',
            'title'    => esc_html__('Beds Label', $theme_text_domain),
            'default' => 'Beds',
        ),
        array(
            'id'       => 'glc_room',
            'type'     => 'text',
            'title'    => esc_html__('Room Label', $theme_text_domain),
            'default' => 'Room',
        ),
        array(
            'id'       => 'glc_rooms',
            'type'     => 'text',
            'title'    => esc_html__('Rooms Label', $theme_text_domain),
            'default' => 'Rooms',
        ),
        array(
            'id'       => 'glc_bath',
            'type'     => 'text',
            'title'    => esc_html__('Bath Label', $theme_text_domain),
            'default' => 'Bath',
        ),
        array(
            'id'       => 'glc_baths',
            'type'     => 'text',
            'title'    => esc_html__('Baths Label', $theme_text_domain),
            'default' => 'Baths',
        ),
        array(
            'id'       => 'glc_garage',
            'type'     => 'text',
            'title'    => esc_html__('Garage Label', $theme_text_domain),
            'default' => 'Garage',
        ),
        array(
            'id'       => 'glc_garages',
            'type'     => 'text',
            'title'    => esc_html__('Garages Label', $theme_text_domain),
            'default' => 'Garages',
        ),
        array(
            'id'       => 'glc_year_built',
            'type'     => 'text',
            'title'    => esc_html__('Year Built Label', $theme_text_domain),
            'default' => 'Year Built',
        ),
        array(
            'id'       => 'glc_id',
            'type'     => 'text',
            'title'    => esc_html__('ID Label', $theme_text_domain),
            'default' => 'ID',
        ),
        array(
            'id'       => 'glc_listing_id',
            'type'     => 'text',
            'title'    => esc_html__('Listing ID Label', $theme_text_domain),
            'default' => 'Listing ID',
        ),
        array(
            'id'       => 'glc_detail_btn',
            'type'     => 'text',
            'title'    => esc_html__('Details Button Label', $theme_text_domain),
            'default' => 'Details',
        ),
        array(
            'id'       => 'cl_glcp_section-end',
            'type'     => 'section',
            'indent'   => false,
        ),
        
    )
));

Redux::setSection( $opt_name, array(
    'title'  => esc_html__( 'Dashboard Menu', $theme_text_domain ),
    'id'     => 'dashboard-menu',
    'desc'   => '',
    'subsection'   => true,
    'fields'        => array(
        array(
            'id'       => 'dsh_labels_section-start',
            'type'     => 'section',
            'title'    => '',
            'subtitle' => esc_html__('Manage labels for dashboard menu', $theme_text_domain),
            'indent'   => true,
        ),

        array(
            'id'       => 'dsh_board',
            'type'     => 'text',
            'title'    => esc_html__("Board", $theme_text_domain),
            'default' => "Board",
        ),
        array(
            'id'       => 'dsh_activities',
            'type'     => 'text',
            'title'    => esc_html__("Activities", $theme_text_domain),
            'default' => "Activities",
        ),
        array(
            'id'       => 'dsh_deals',
            'type'     => 'text',
            'title'    => esc_html__("Deals", $theme_text_domain),
            'default' => "Deals",
        ),
        array(
            'id'       => 'dsh_leads',
            'type'     => 'text',
            'title'    => esc_html__("Leads", $theme_text_domain),
            'default' => "Leads",
        ),
        array(
            'id'       => 'dsh_inquiries',
            'type'     => 'text',
            'title'    => esc_html__("Inquiries", $theme_text_domain),
            'default' => "Inquiries",
        ),
        array(
            'id'       => 'dsh_insight',
            'type'     => 'text',
            'title'    => esc_html__("Insight", $theme_text_domain),
            'default' => "Insight",
        ),
        array(
            'id'       => 'dsh_properties',
            'type'     => 'text',
            'title'    => esc_html__("Properties", $theme_text_domain),
            'default' => "Properties",
        ),
        array(
            'id'       => 'dsh_all',
            'type'     => 'text',
            'title'    => esc_html__("All", $theme_text_domain),
            'default' => "All",
        ),
        array(
            'id'       => 'dsh_published',
            'type'     => 'text',
            'title'    => esc_html__("Published", $theme_text_domain),
            'default' => "Published",
        ),
        array(
            'id'       => 'dsh_pending',
            'type'     => 'text',
            'title'    => esc_html__("Pending", $theme_text_domain),
            'default' => "Pending",
        ),
        array(
            'id'       => 'dsh_expired',
            'type'     => 'text',
            'title'    => esc_html__("Expired", $theme_text_domain),
            'default' => "Expired",
        ),
        array(
            'id'       => 'dsh_draft',
            'type'     => 'text',
            'title'    => esc_html__("Draft", $theme_text_domain),
            'default' => "Draft",
        ),
        array(
            'id'       => 'dsh_hold',
            'type'     => 'text',
            'title'    => esc_html__("On Hold", $theme_text_domain),
            'default' => "On Hold",
        ),
        array(
            'id'       => 'dsh_create_listing',
            'type'     => 'text',
            'title'    => esc_html__("Create a Listing", $theme_text_domain),
            'default' => "Create a Listing",
        ),
        array(
            'id'       => 'dsh_favorite',
            'type'     => 'text',
            'title'    => esc_html__("Favorites", $theme_text_domain),
            'default' => "Favorites",
        ),
        array(
            'id'       => 'dsh_messages',
            'type'     => 'text',
            'title'    => esc_html__("Messages", $theme_text_domain),
            'default' => "Messages",
        ),
        array(
            'id'       => 'dsh_saved_searches',
            'type'     => 'text',
            'title'    => esc_html__("Saved Searches", $theme_text_domain),
            'default' => "Saved Searches",
        ),
        array(
            'id'       => 'dsh_membership',
            'type'     => 'text',
            'title'    => esc_html__("Membership", $theme_text_domain),
            'default' => "Membership",
        ),
        array(
            'id'       => 'dsh_invoices',
            'type'     => 'text',
            'title'    => esc_html__("Invoices", $theme_text_domain),
            'default' => "Invoices",
        ),
        array(
            'id'       => 'dsh_profile',
            'type'     => 'text',
            'title'    => esc_html__("My Profile", $theme_text_domain),
            'default' => "My Profile",
        ),
        array(
            'id'       => 'dsh_gdpr',
            'type'     => 'text',
            'title'    => esc_html__("GDPR Request", $theme_text_domain),
            'default' => "GDPR Request",
        ),
        array(
            'id'       => 'dsh_agents',
            'type'     => 'text',
            'title'    => esc_html__("Agents", $theme_text_domain),
            'default' => "Agents",
        ),
        array(
            'id'       => 'dsh_addnew',
            'type'     => 'text',
            'title'    => esc_html__("Add New", $theme_text_domain),
            'default' => "Add New",
        ),
        array(
            'id'       => 'dsh_logout',
            'type'     => 'text',
            'title'    => esc_html__("Log Out", $theme_text_domain),
            'default' => "Log Out",
        ),
    

        array(
            'id'       => 'dsh_labels_section-end',
            'type'     => 'section',
            'indent'   => false,
        ),
    )
));

Redux::setSection( $opt_name, array(
    'title'  => esc_html__( 'Add New Property', $theme_text_domain ),
    'id'     => 'createlisting-translation',
    'desc'   => '',
    'subsection'   => true,
    'fields'        => array(
        
        array(
            'id'       => 'cl_buttons_section-start',
            'type'     => 'section',
            'title'    => esc_html__('Buttons and links', $theme_text_domain),
            'subtitle' => esc_html__('Manage buttons and links titles front-end', $theme_text_domain),
            'indent'   => true,
        ),

        array(
            'id'       => 'fal_submit_property',
            'type'     => 'text',
            'title'    => esc_html__('Submit Property', $theme_text_domain),
            'default' => 'Submit Property',
        ),

        array(
            'id'       => 'fal_save_draft',
            'type'     => 'text',
            'title'    => esc_html__('Save as Draft', $theme_text_domain),
            'default' => 'Save as Draft',
        ),

        array(
            'id'       => 'fal_save_changes',
            'type'     => 'text',
            'title'    => esc_html__('Save Changes', $theme_text_domain),
            'default' => 'Save Changes',
        ),

        array(
            'id'       => 'fal_view_property',
            'type'     => 'text',
            'title'    => esc_html__('View Property', $theme_text_domain),
            'default' => 'View Property',
        ),

        array(
            'id'       => 'fal_cancel',
            'type'     => 'text',
            'title'    => esc_html__('Cancel', $theme_text_domain),
            'default' => 'Cancel',
        ),
        array(
            'id'       => 'fal_back',
            'type'     => 'text',
            'title'    => esc_html__('Back', $theme_text_domain),
            'default' => 'Back',
        ),

        array(
            'id'       => 'fal_next',
            'type'     => 'text',
            'title'    => esc_html__('Next', $theme_text_domain),
            'default' => 'Next',
        ),

        array(
            'id'       => 'cl_buttons_section-end',
            'type'     => 'section',
            'indent'   => false,
        ),

        array(
            'id'       => 'cl_sections_section-start',
            'type'     => 'section',
            'title'    => esc_html__('Sections Titles', $theme_text_domain),
            'subtitle' => esc_html__('Manage create listing page section titles front-end and admin', $theme_text_domain),
            'indent'   => true,
        ),

        array(
            'id'       => 'cls_description',
            'type'     => 'text',
            'title'    => esc_html__('Description', $theme_text_domain),
            'default' => 'Description',
        ),

        array(
            'id'       => 'cls_description_price',
            'type'     => 'text',
            'title'    => esc_html__('Description & Price', $theme_text_domain),
            'default' => 'Description & Price',
        ),

        array(
            'id'       => 'cls_price',
            'type'     => 'text',
            'title'    => esc_html__('Price', $theme_text_domain),
            'default' => 'Price',
        ),

        array(
            'id'       => 'cls_media',
            'type'     => 'text',
            'title'    => esc_html__('Media', $theme_text_domain),
            'default' => 'Media',
        ),

        array(
            'id'       => 'cls_documents',
            'type'     => 'text',
            'title'    => esc_html__('Property Documents', $theme_text_domain),
            'default' => 'Property Documents',
        ),

        array(
            'id'       => 'cls_details',
            'type'     => 'text',
            'title'    => esc_html__('Details', $theme_text_domain),
            'default' => 'Details',
        ),
        array(
            'id'       => 'cls_private_notes',
            'type'     => 'text',
            'title'    => esc_html__('Private Note', $theme_text_domain),
            'default' => 'Private Note',
        ),
        array(
            'id'       => 'cls_additional_details',
            'type'     => 'text',
            'title'    => esc_html__('Additional details', $theme_text_domain),
            'default' => 'Additional details',
        ),
        array(
            'id'       => 'cls_address',
            'type'     => 'text',
            'title'    => esc_html__('Address', $theme_text_domain),
            'default' => 'Address',
        ),
        array(
            'id'       => 'cls_location',
            'type'     => 'text',
            'title'    => esc_html__('Location', $theme_text_domain),
            'default' => 'Location',
        ),
        array(
            'id'       => 'cls_map',
            'type'     => 'text',
            'title'    => esc_html__('Map', $theme_text_domain),
            'default' => 'Map',
        ),
        array(
            'id'       => 'cls_features',
            'type'     => 'text',
            'title'    => esc_html__('Features', $theme_text_domain),
            'default' => 'Features',
        ),
        array(
            'id'       => 'cls_video',
            'type'     => 'text',
            'title'    => esc_html__('Video', $theme_text_domain),
            'default' => 'Video',
        ),
        array(
            'id'       => 'cls_virtual_tour',
            'type'     => 'text',
            'title'    => esc_html__('360° Virtual Tour', $theme_text_domain),
            'default' => '360° Virtual Tour',
        ),

        array(
            'id'       => 'cls_sub_listings',
            'type'     => 'text',
            'title'    => esc_html__('Sub listings', $theme_text_domain),
            'default' => 'Sub listings',
        ),
        array(
            'id'       => 'cls_energy_class',
            'type'     => 'text',
            'title'    => esc_html__('Energy Class', $theme_text_domain),
            'default' => 'Energy Class',
        ),
        array(
            'id'       => 'cls_floor_plans',
            'type'     => 'text',
            'title'    => esc_html__('Floor Plans', $theme_text_domain),
            'default' => 'Floor Plans',
        ),
        
        array(
            'id'       => 'cls_walkscore',
            'type'     => 'text',
            'title'    => esc_html__('Walkscore', $theme_text_domain),
            'default' => 'Walkscore',
        ),

        array(
            'id'       => 'cls_contact_info',
            'type'     => 'text',
            'title'    => esc_html__("Contact Information", $theme_text_domain),
            'default' => "Contact Information",
        ),

        array(
            'id'       => 'cls_information',
            'type'     => 'text',
            'title'    => esc_html__("Information", $theme_text_domain),
            'default' => "Information",
        ),

        array(
            'id'       => 'cls_settings',
            'type'     => 'text',
            'title'    => esc_html__("Property Settings", $theme_text_domain),
            'default' => "Property Settings",
        ),

        array(
            'id'       => 'cls_slider',
            'type'     => 'text',
            'title'    => esc_html__("Slider", $theme_text_domain),
            'default' => "Slider",
        ),

        array(
            'id'       => 'cls_layout',
            'type'     => 'text',
            'title'    => esc_html__("Layout", $theme_text_domain),
            'default' => "Layout",
        ),

        array(
            'id'       => 'cls_rental',
            'type'     => 'text',
            'title'    => esc_html__("Rental Details", $theme_text_domain),
            'default' => "Rental Details",
        ),
       
        array(
            'id'       => 'cls_gdpr',
            'type'     => 'text',
            'title'    => esc_html__("GDPR Agreement", $theme_text_domain),
            'default' => "GDPR Agreement *",
        ),

        array(
            'id'       => 'cl_sections_section-end',
            'type'     => 'section',
            'indent'   => false,
        ),

        /*--------------------------------------------------------------
        * Location labels
        **------------------------------------------------------------*/
        array(
            'id'       => 'cl_location_section-start',
            'type'     => 'section',
            'title'    => esc_html__('Fields Labels and Placeholders', $theme_text_domain),
            'subtitle' => '',
            'indent'   => true,
        ),

        array(
            'id'       => 'cl_prop_title',
            'type'     => 'text',
            'title'    => esc_html__("Property Title", $theme_text_domain),
            'default' => "Property Title",
        ),
        array(
            'id'       => 'cl_prop_title_plac',
            'type'     => 'text',
            'title'    => esc_html__("Property Title Placeholder", $theme_text_domain),
            'default' => "Enter your property title",
        ),
        array(
            'id'       => 'cl_content',
            'type'     => 'text',
            'title'    => esc_html__("Content", $theme_text_domain),
            'default' => "Content",
        ),
        
        array(
            'id'       => 'cl_prop_type',
            'type'     => 'text',
            'title'    => esc_html__("Type", $theme_text_domain),
            'default' => "Type",
        ),
        array(
            'id'       => 'cl_prop_types',
            'type'     => 'text',
            'title'    => esc_html__("Types", $theme_text_domain),
            'default' => "Types",
        ),
        array(
            'id'       => 'cl_prop_status',
            'type'     => 'text',
            'title'    => esc_html__("Status", $theme_text_domain),
            'default' => "Status",
        ),
        array(
            'id'       => 'cl_prop_statuses',
            'type'     => 'text',
            'title'    => esc_html__("Statuses", $theme_text_domain),
            'default' => "Statuses",
        ),
        array(
            'id'       => 'cl_prop_label',
            'type'     => 'text',
            'title'    => esc_html__("Label", $theme_text_domain),
            'default' => "Label",
        ),
        array(
            'id'       => 'cl_prop_labels',
            'type'     => 'text',
            'title'    => esc_html__("Labels", $theme_text_domain),
            'default' => "Labels",
        ),
        array(
            'id'       => 'cl_sale_price',
            'type'     => 'text',
            'title'    => esc_html__("Sale or Rent Price", $theme_text_domain),
            'default' => "Sale or Rent Price",
        ),
        array(
            'id'       => 'cl_sale_price_plac',
            'type'     => 'text',
            'title'    => esc_html__("Sale or Rent Price Placeholder", $theme_text_domain),
            'default' => "Enter the price",
        ),

        array(
            'id'       => 'cl_second_price',
            'type'     => 'text',
            'title'    => esc_html__("Second Price", $theme_text_domain),
            'default' => "Second Price (Optional)",
        ),
        array(
            'id'       => 'cl_second_price_plac',
            'type'     => 'text',
            'title'    => esc_html__("Second Price Placeholder", $theme_text_domain),
            'default' => "Enter the second price",
        ),
        array(
            'id'       => 'cl_price_postfix',
            'type'     => 'text',
            'title'    => esc_html__("Price Postfix", $theme_text_domain),
            'default' => "After The Price",
        ),
        array(
            'id'       => 'cl_price_postfix_plac',
            'type'     => 'text',
            'title'    => esc_html__("Price Postfix Placeholder", $theme_text_domain),
            'default' => "Enter the after price",
        ),
        array(
            'id'       => 'cl_price_postfix_tooltip',
            'type'     => 'text',
            'title'    => esc_html__("Price Postfix Tooltip", $theme_text_domain),
            'default' => "For example: Monthly",
        ),

        array(
            'id'       => 'cl_price_prefix',
            'type'     => 'text',
            'title'    => esc_html__("Price Prefix", $theme_text_domain),
            'default' => "Price Prefix",
        ),
        array(
            'id'       => 'cl_price_prefix_plac',
            'type'     => 'text',
            'title'    => esc_html__("Price Prefix Placeholder", $theme_text_domain),
            'default' => "Enter the price prefix",
        ),
        array(
            'id'       => 'cl_price_prefix_tooltip',
            'type'     => 'text',
            'title'    => esc_html__("Price Postfix Tooltip", $theme_text_domain),
            'default' => "For example: Start from",
        ),

        array(
            'id'       => 'cl_bedrooms',
            'type'     => 'text',
            'title'    => esc_html__('Bedrooms', $theme_text_domain),
            'default' => 'Bedrooms',
        ),
        array(
            'id'       => 'cl_bedrooms_plac',
            'type'     => 'text',
            'title'    => esc_html__('Bedrooms Placeholder', $theme_text_domain),
            'default' => 'Enter number of bedrooms',
        ),

        array(
            'id'       => 'cl_rooms',
            'type'     => 'text',
            'title'    => esc_html__('Rooms', $theme_text_domain),
            'default' => 'Rooms',
        ),
        array(
            'id'       => 'cl_rooms_plac',
            'type'     => 'text',
            'title'    => esc_html__('Rooms Placeholder', $theme_text_domain),
            'default' => 'Enter number of rooms',
        ),

        array(
            'id'       => 'cl_bathrooms',
            'type'     => 'text',
            'title'    => esc_html__('Bathrooms', $theme_text_domain),
            'default' => 'Bathrooms',
        ),

        array(
            'id'       => 'cl_bathrooms_plac',
            'type'     => 'text',
            'title'    => esc_html__('Bathrooms Placeholder', $theme_text_domain),
            'default' => 'Enter number of bathrooms',
        ),

        array(
            'id'       => 'cl_area_size',
            'type'     => 'text',
            'title'    => esc_html__('Area Size', $theme_text_domain),
            'default' => 'Area Size',
        ),

        array(
            'id'       => 'cl_area_size_plac',
            'type'     => 'text',
            'title'    => esc_html__('Area Size Placeholder', $theme_text_domain),
            'default' => 'Enter property area size',
        ),

        array(
            'id'       => 'cl_area_size_postfix',
            'type'     => 'text',
            'title'    => esc_html__('Size Postfix', $theme_text_domain),
            'default' => 'Size Postfix',
        ),

        array(
            'id'       => 'cl_area_size_postfix_plac',
            'type'     => 'text',
            'title'    => esc_html__('Size Postfix Placeholder', $theme_text_domain),
            'default' => 'Enter property area size postfix',
        ),

        array(
            'id'       => 'cl_area_size_postfix_tooltip',
            'type'     => 'text',
            'title'    => esc_html__('Size Postfix Tooltip', $theme_text_domain),
            'default' => 'For example: Sq Ft',
        ),

        array(
            'id'       => 'cl_land_size',
            'type'     => 'text',
            'title'    => esc_html__('Land Area', $theme_text_domain),
            'default' => 'Land Area',
        ),

        array(
            'id'       => 'cl_land_size_plac',
            'type'     => 'text',
            'title'    => esc_html__('Land Area Placeholder', $theme_text_domain),
            'default' => 'Enter property Land Area',
        ),

        array(
            'id'       => 'cl_land_size_postfix',
            'type'     => 'text',
            'title'    => esc_html__('Land Area Size Postfix', $theme_text_domain),
            'default' => 'Land Area Size Postfix',
        ),

        array(
            'id'       => 'cl_land_size_postfix_plac',
            'type'     => 'text',
            'title'    => esc_html__('Land Area Size Postfix Placeholder', $theme_text_domain),
            'default' => 'Enter property Land Area postfix',
        ),

        array(
            'id'       => 'cl_land_size_postfix_tooltip',
            'type'     => 'text',
            'title'    => esc_html__('Land Area Size Postfix Tooltip', $theme_text_domain),
            'default' => 'For example: Sq Ft',
        ),

        array(
            'id'       => 'cl_garage',
            'type'     => 'text',
            'title'    => esc_html__('Garages', $theme_text_domain),
            'default' => 'Garages',
        ),

        array(
            'id'       => 'cl_garage_plac',
            'type'     => 'text',
            'title'    => esc_html__('Garages Placeholder', $theme_text_domain),
            'default' => 'Enter number of garages',
        ),

        array(
            'id'       => 'cl_garage_size',
            'type'     => 'text',
            'title'    => esc_html__('Garage Size', $theme_text_domain),
            'default' => 'Garage Size',
        ),

        array(
            'id'       => 'cl_garage_size_plac',
            'type'     => 'text',
            'title'    => esc_html__('Garage Size Placeholder', $theme_text_domain),
            'default' => 'Enter the garage size',
        ),

        array(
            'id'       => 'cl_garage_size_tooltip',
            'type'     => 'text',
            'title'    => esc_html__('Garage Size Tooltip', $theme_text_domain),
            'default' => 'For example: 200 Sq Ft',
        ),

        array(
            'id'       => 'cl_year_built',
            'type'     => 'text',
            'title'    => esc_html__('Year Built', $theme_text_domain),
            'default' => 'Year Built',
        ),

        array(
            'id'       => 'cl_year_built_plac',
            'type'     => 'text',
            'title'    => esc_html__('Year Built Placeholder', $theme_text_domain),
            'default' => 'Enter year built',
        ),

        array(
            'id'       => 'cl_prop_id',
            'type'     => 'text',
            'title'    => esc_html__("Property ID", $theme_text_domain),
            'default' => "Property ID",
        ),
        array(
            'id'       => 'cl_prop_id_plac',
            'type'     => 'text',
            'title'    => esc_html__("Property ID Placeholder", $theme_text_domain),
            'default' => "Enter property ID",
        ),

        array(
            'id'       => 'cl_prop_id_tooltip',
            'type'     => 'text',
            'title'    => esc_html__("Property ID Tooltip", $theme_text_domain),
            'default' => "For example: HZ-01",
        ),

        array(
            'id'       => 'cl_additional_title',
            'type'     => 'text',
            'title'    => esc_html__("Additional Details Title", $theme_text_domain),
            'default' => "Title",
        ),
        array(
            'id'       => 'cl_additional_title_plac',
            'type'     => 'text',
            'title'    => esc_html__("Additional Details Title Placeholder", $theme_text_domain),
            'default' => "Eg: Equipment",
        ),

        array(
            'id'       => 'cl_additional_value',
            'type'     => 'text',
            'title'    => esc_html__("Additional Details Value", $theme_text_domain),
            'default' => "Value",
        ),
        array(
            'id'       => 'cl_additional_value_plac',
            'type'     => 'text',
            'title'    => esc_html__("Additional Details Value Placeholder", $theme_text_domain),
            'default' => "Grill - Gas",
        ),

        array(
            'id'       => 'cl_drag_drop_text_image',
            'type'     => 'text',
            'title'    => esc_html__("Drag & Drop Text", $theme_text_domain),
            'default' => "Drag and drop the images to customize the image gallery order.",
        ),

        array(
            'id'       => 'cl_drag_drop_title',
            'type'     => 'text',
            'title'    => esc_html__("Drag & Drop Title", $theme_text_domain),
            'default' => "Drag and drop the gallery images here",
        ),

        array(
            'id'       => 'cl_image_size',
            'type'     => 'text',
            'title'    => esc_html__("Image Size", $theme_text_domain),
            'default' => "(Minimum size 1440x900)",
        ),

        array(
            'id'       => 'cl_image_btn',
            'type'     => 'text',
            'title'    => esc_html__("Select Image Button", $theme_text_domain),
            'default' => "Select and Upload",
        ),

        array(
            'id'       => 'cl_image_featured',
            'type'     => 'text',
            'title'    => esc_html__("Make Featured text", $theme_text_domain),
            'default' => "Click on the star icon to select the cover image.",
        ),

        array(
            'id'       => 'cl_video_url',
            'type'     => 'text',
            'title'    => esc_html__("Video Url", $theme_text_domain),
            'default' => "Video URL",
        ),
        array(
            'id'       => 'cl_video_url_plac',
            'type'     => 'text',
            'title'    => esc_html__("Video Url Placeholder", $theme_text_domain),
            'default' => "YouTube, Vimeo, SWF File and MOV File are supported",
        ),

        array(
            'id'       => 'cl_energy_cls',
            'type'     => 'text',
            'title'    => esc_html__("Energy Class", $theme_text_domain),
            'default' => "Energy Class",
        ),
        array(
            'id'       => 'cl_energy_cls_plac',
            'type'     => 'text',
            'title'    => esc_html__("Energy Class Placeholder", $theme_text_domain),
            'default' => "Select Energy Class",
        ),

        array(
            'id'       => 'cl_energy_index',
            'type'     => 'text',
            'title'    => esc_html__("Global Energy Performance Index", $theme_text_domain),
            'default' => "Global Energy Performance Index",
        ),
        array(
            'id'       => 'cl_energy_index_plac',
            'type'     => 'text',
            'title'    => esc_html__("Global Energy Performance Index Placeholder", $theme_text_domain),
            'default' => "For example: 92.42 kWh / m²a",
        ),

        array(
            'id'       => 'cl_energy_renew_index',
            'type'     => 'text',
            'title'    => esc_html__("Renewable energy performance index", $theme_text_domain),
            'default' => "Renewable energy performance index",
        ),
        array(
            'id'       => 'cl_energy_renew_index_plac',
            'type'     => 'text',
            'title'    => esc_html__("Renewable energy performance index Placeholder", $theme_text_domain),
            'default' => "For example: 00.00 kWh / m²a",
        ),

        array(
            'id'       => 'cl_energy_build_performance',
            'type'     => 'text',
            'title'    => esc_html__("Energy performance of the building", $theme_text_domain),
            'default' => "Energy performance of the building",
        ),
        array(
            'id'       => 'cl_energy_build_performance_plac',
            'type'     => 'text',
            'title'    => esc_html__("Energy performance of the building Placeholder", $theme_text_domain),
            'default' => "",
        ),

        array(
            'id'       => 'cl_energy_ecp_rating',
            'type'     => 'text',
            'title'    => esc_html__("EPC Current Rating", $theme_text_domain),
            'default' => "EPC Current Rating",
        ),
        array(
            'id'       => 'cl_energy_ecp_rating_plac',
            'type'     => 'text',
            'title'    => esc_html__("EPC Current Rating Placeholder", $theme_text_domain),
            'default' => "",
        ),

        array(
            'id'       => 'cl_energy_ecp_p',
            'type'     => 'text',
            'title'    => esc_html__("EPC Potential Rating", $theme_text_domain),
            'default' => "EPC Potential Rating",
        ),
        array(
            'id'       => 'cl_energy_ecp_p_plac',
            'type'     => 'text',
            'title'    => esc_html__("EPC Potential Rating Placeholder", $theme_text_domain),
            'default' => "",
        ),

        array(
            'id'       => 'cl_virtual_plac',
            'type'     => 'text',
            'title'    => esc_html__("Virtual Tour Placeholder", $theme_text_domain),
            'default' => "Enter virtual tour iframe/embeded code",
        ),

        array(
            'id'       => 'cl_private_note',
            'type'     => 'text',
            'title'    => esc_html__("Private Note Label", $theme_text_domain),
            'default' => "Write private note for this property, it will not display for public.",
        ),

        array(
            'id'       => 'cl_private_note_plac',
            'type'     => 'text',
            'title'    => esc_html__("Private Note Placeholder", $theme_text_domain),
            'default' => "Enter the note here",
        ),

        array(
            'id'       => 'cl_address',
            'type'     => 'text',
            'title'    => esc_html__('Address', $theme_text_domain),
            'default' => 'Address',
        ),
        array(
            'id'       => 'cl_address_plac',
            'type'     => 'text',
            'title'    => esc_html__('Address Placeholder', $theme_text_domain),
            'default' => 'Enter your property address',
        ),
        array(
            'id'       => 'cl_zip',
            'type'     => 'text',
            'title'    => esc_html__('Zip/Postal Code', $theme_text_domain),
            'default' => 'Zip/Postal Code',
        ),
        array(
            'id'       => 'cl_zip_plac',
            'type'     => 'text',
            'title'    => esc_html__('Zip/Postal Code Placeholder', $theme_text_domain),
            'default' => 'Enter zip/postal code',
        ),
        array(
            'id'       => 'cl_country',
            'type'     => 'text',
            'title'    => esc_html__('Country', $theme_text_domain),
            'default' => 'Country',
        ),
        array(
            'id'       => 'cl_country_plac',
            'type'     => 'text',
            'title'    => esc_html__('Country Placeholder', $theme_text_domain),
            'default' => 'Enter the country',
        ),
        array(
            'id'       => 'cl_state',
            'type'     => 'text',
            'title'    => esc_html__('State/county', $theme_text_domain),
            'default' => 'State/county',
        ),
        array(
            'id'       => 'cl_state_plac',
            'type'     => 'text',
            'title'    => esc_html__('State/county Placeholder', $theme_text_domain),
            'default' => 'Enter the State/county',
        ),
        array(
            'id'       => 'cl_city',
            'type'     => 'text',
            'title'    => esc_html__('City', $theme_text_domain),
            'default' => 'City',
        ),
        array(
            'id'       => 'cl_city_plac',
            'type'     => 'text',
            'title'    => esc_html__('City Placeholder', $theme_text_domain),
            'default' => 'Enter the city',
        ),
        array(
            'id'       => 'cl_area',
            'type'     => 'text',
            'title'    => esc_html__('Area', $theme_text_domain),
            'default' => 'Area',
        ),
        array(
            'id'       => 'cl_area_plac',
            'type'     => 'text',
            'title'    => esc_html__('Area Placeholder', $theme_text_domain),
            'default' => 'Enter the area',
        ),

        array(
            'id'       => 'cl_drag_drop_text',
            'type'     => 'text',
            'title'    => esc_html__('Drag & Drop Text', $theme_text_domain),
            'default' => 'Drag and drop the pin on map to find exact location',
        ),

        array(
            'id'       => 'cl_latitude',
            'type'     => 'text',
            'title'    => esc_html__('Latitude', $theme_text_domain),
            'default' => 'Latitude',
        ),
        array(
            'id'       => 'cl_latitude_plac',
            'type'     => 'text',
            'title'    => esc_html__('Latitude Placeholder', $theme_text_domain),
            'default' => 'Enter address latitude',
        ),

        array(
            'id'       => 'cl_longitude',
            'type'     => 'text',
            'title'    => esc_html__('Longitude', $theme_text_domain),
            'default' => 'Longitude',
        ),
        array(
            'id'       => 'cl_longitude_plac',
            'type'     => 'text',
            'title'    => esc_html__('Longitude Placeholder', $theme_text_domain),
            'default' => 'Enter address Longitude',
        ),

        array(
            'id'       => 'cl_street_view',
            'type'     => 'text',
            'title'    => esc_html__('Street View', $theme_text_domain),
            'default' => 'Street View',
        ),

        array(
            'id'       => 'cl_ppbtn',
            'type'     => 'text',
            'title'    => esc_html__('Place pin buttton', $theme_text_domain),
            'default' => 'Place the pin in address above',
        ),

        array(
            'id'       => 'cl_streat_address',
            'type'     => 'text',
            'title'    => esc_html__("Streat Address", $theme_text_domain),
            'default' => "Streat Address",
        ),
        array(
            'id'       => 'cl_streat_address_plac',
            'type'     => 'text',
            'title'    => esc_html__("Streat Address Placeholder", $theme_text_domain),
            'default' => "Enter only the street name and the building number",
        ),

        array(
            'id'       => 'cl_make_featured',
            'type'     => 'text',
            'title'    => esc_html__("Make Featured Text", $theme_text_domain),
            'default' => "Do you want to mark this property as featured?",
        ),

        array(
            'id'       => 'cl_login_view',
            'type'     => 'text',
            'title'    => esc_html__("Login to view title", $theme_text_domain),
            'default' => "The user must be logged in to view this property?",
        ),

        array(
            'id'       => 'cl_login_view_plac',
            'type'     => 'text',
            'title'    => esc_html__("Login to view description", $theme_text_domain),
            'default' => 'If "Yes" then only logged in user can view property details.',
        ),

        array(
            'id'       => 'cl_disclaimer',
            'type'     => 'text',
            'title'    => esc_html__("Disclaimer", $theme_text_domain),
            'default' => "Disclaimer",
        ),

        array(
            'id'       => 'cl_mortgage',
            'type'     => 'text',
            'title'    => esc_html__("Mortgage Calculator", $theme_text_domain),
            'default' => "Mortgage Calulator",
        ),

        array(
            'id'       => 'cl_mortgage_plac',
            'type'     => 'text',
            'title'    => esc_html__("Mortgage Calulator Placeholder", $theme_text_domain),
            'default' => 'Show/Hide mortgage calculator for this listing?',
        ),

        array(
            'id'       => 'cl_decuments_text',
            'type'     => 'text',
            'title'    => esc_html__("Documents Text", $theme_text_domain),
            'default' => "You can attach PDF files, Map images OR other documents.",
        ),

        array(
            'id'       => 'cl_attachment_btn',
            'type'     => 'text',
            'title'    => esc_html__("Attachment button", $theme_text_domain),
            'default' => "Select Attachment.",
        ),

        array(
            'id'       => 'cl_uploaded_attachments',
            'type'     => 'text',
            'title'    => esc_html__("Uploaded Attachments", $theme_text_domain),
            'default' => "Uploaded Attachments",
        ),

        array(
            'id'       => 'cl_contact_info_text',
            'type'     => 'text',
            'title'    => esc_html__("Contact Info Text", $theme_text_domain),
            'default' => "What information do you want to display in agent data container?",
        ),
        array(
            'id'       => 'cl_author_info',
            'type'     => 'text',
            'title'    => esc_html__("Author Info", $theme_text_domain),
            'default' => "Author Info",
        ),

        array(
            'id'       => 'cl_agent_info',
            'type'     => 'text',
            'title'    => esc_html__("Agent Info", $theme_text_domain),
            'default' => "Agent Info (Choose agent from the list below)",
        ),

        array(
            'id'       => 'cl_agent_info_plac',
            'type'     => 'text',
            'title'    => esc_html__("Agent Info Placeholder", $theme_text_domain),
            'default' => "Select an Agent",
        ),

        array(
            'id'       => 'cl_agency_info',
            'type'     => 'text',
            'title'    => esc_html__("Agency Info", $theme_text_domain),
            'default' => "Agency Info (Choose agency from the list below)",
        ),

        array(
            'id'       => 'cl_agency_info2',
            'type'     => 'text',
            'title'    => esc_html__("Agency Info", $theme_text_domain),
            'default' => "Agency Info",
        ),

        array(
            'id'       => 'cl_agency_info_plac',
            'type'     => 'text',
            'title'    => esc_html__("Agency Info Placeholder", $theme_text_domain),
            'default' => "Select an Agency",
        ),

        array(
            'id'       => 'cl_not_display',
            'type'     => 'text',
            'title'    => esc_html__("Do not display", $theme_text_domain),
            'default' => "Do not display",
        ),

        array(
            'id'       => 'cl_add_slider',
            'type'     => 'text',
            'title'    => esc_html__("Add to Slider", $theme_text_domain),
            'default' => "Do you want to display this property on the custom property slider?",
        ),
        array(
            'id'       => 'cl_add_slider_plac',
            'type'     => 'text',
            'title'    => esc_html__("Add to Slider Placeholder", $theme_text_domain),
            'default' => "Upload an image below if you selected yes.",
        ),
        array(
            'id'       => 'cl_slider_img',
            'type'     => 'text',
            'title'    => esc_html__("Slider Image", $theme_text_domain),
            'default' => "Slider Image",
        ),

        array(
            'id'       => 'cl_slider_img_size',
            'type'     => 'text',
            'title'    => esc_html__("Slider Image Size", $theme_text_domain),
            'default' => "Suggested size 2000px x 700px",
        ),
        array(
            'id'       => 'cl_plan_title',
            'type'     => 'text',
            'title'    => esc_html__("Plan Title", $theme_text_domain),
            'default' => "Plan Title",
        ),

        array(
            'id'       => 'cl_plan_title_plac',
            'type'     => 'text',
            'title'    => esc_html__("Plan Title Placeholder", $theme_text_domain),
            'default' => "Enter the plan title",
        ),

        array(
            'id'       => 'cl_plan_bedrooms',
            'type'     => 'text',
            'title'    => esc_html__("Plan Bedrooms", $theme_text_domain),
            'default' => "Bedrooms",
        ),

        array(
            'id'       => 'cl_plan_bedrooms_plac',
            'type'     => 'text',
            'title'    => esc_html__("Plan Bedrooms Placeholder", $theme_text_domain),
            'default' => "Enter the number of bedrooms",
        ),

        array(
            'id'       => 'cl_plan_bathrooms',
            'type'     => 'text',
            'title'    => esc_html__("Plan Bathrooms", $theme_text_domain),
            'default' => "Bathrooms",
        ),
        array(
            'id'       => 'cl_plan_bathrooms_plac',
            'type'     => 'text',
            'title'    => esc_html__("Plan Bedrooms Placeholder", $theme_text_domain),
            'default' => "Enter the number of bathrooms",
        ),

        array(
            'id'       => 'cl_plan_price',
            'type'     => 'text',
            'title'    => esc_html__("Plan Price", $theme_text_domain),
            'default' => "Price",
        ),
        array(
            'id'       => 'cl_plan_price_plac',
            'type'     => 'text',
            'title'    => esc_html__("Plan Price Placeholder", $theme_text_domain),
            'default' => "Enter the price",
        ),

        array(
            'id'       => 'cl_plan_price_postfix',
            'type'     => 'text',
            'title'    => esc_html__("Plan Price Postfix", $theme_text_domain),
            'default' => "Price Postfix",
        ),
        array(
            'id'       => 'cl_plan_price_postfix_plac',
            'type'     => 'text',
            'title'    => esc_html__("Plan Price Postfix Placeholder", $theme_text_domain),
            'default' => "Enter the price postfix",
        ),

        array(
            'id'       => 'cl_plan_size',
            'type'     => 'text',
            'title'    => esc_html__("Plan Size", $theme_text_domain),
            'default' => "Plan Size",
        ),
        array(
            'id'       => 'cl_plan_size_plac',
            'type'     => 'text',
            'title'    => esc_html__("Plan Size Placeholder", $theme_text_domain),
            'default' => "Enter the plan size",
        ),

        array(
            'id'       => 'cl_plan_img',
            'type'     => 'text',
            'title'    => esc_html__("Plan Image", $theme_text_domain),
            'default' => "Plan Image",
        ),
        array(
            'id'       => 'cl_plan_img_plac',
            'type'     => 'text',
            'title'    => esc_html__("Plan Image Placeholder", $theme_text_domain),
            'default' => "Upload the plan image",
        ),
        array(
            'id'       => 'cl_plan_img_btn',
            'type'     => 'text',
            'title'    => esc_html__("Plan Image Button", $theme_text_domain),
            'default' => "Select Image",
        ),
        array(
            'id'       => 'cl_plan_img_size',
            'type'     => 'text',
            'title'    => esc_html__("Plan Image Size", $theme_text_domain),
            'default' => "Minimum size 800 x 600 px",
        ),

        array(
            'id'       => 'cl_plan_des',
            'type'     => 'text',
            'title'    => esc_html__("Plan Description", $theme_text_domain),
            'default' => "Description",
        ),
        array(
            'id'       => 'cl_plan_des_plac',
            'type'     => 'text',
            'title'    => esc_html__("Plan Description Placeholder", $theme_text_domain),
            'default' => "Enter the plan description",
        ),

        array(
            'id'       => 'cl_subl_title',
            'type'     => 'text',
            'title'    => esc_html__("Title", $theme_text_domain),
            'default' => "Title",
        ),

        array(
            'id'       => 'cl_subl_title_plac',
            'type'     => 'text',
            'title'    => esc_html__("Title Placeholder", $theme_text_domain),
            'default' => "Enter the  title",
        ),

        array(
            'id'       => 'cl_subl_bedrooms',
            'type'     => 'text',
            'title'    => esc_html__("Bedrooms", $theme_text_domain),
            'default' => "Bedrooms",
        ),

        array(
            'id'       => 'cl_subl_bedrooms_plac',
            'type'     => 'text',
            'title'    => esc_html__("Bedrooms Placeholder", $theme_text_domain),
            'default' => "Enter the number of bedrooms",
        ),

        array(
            'id'       => 'cl_subl_bathrooms',
            'type'     => 'text',
            'title'    => esc_html__("Bathrooms", $theme_text_domain),
            'default' => "Bathrooms",
        ),
        array(
            'id'       => 'cl_subl_bathrooms_plac',
            'type'     => 'text',
            'title'    => esc_html__("Bedrooms Placeholder", $theme_text_domain),
            'default' => "Enter the number of bathrooms",
        ),

        array(
            'id'       => 'cl_subl_price',
            'type'     => 'text',
            'title'    => esc_html__("Price", $theme_text_domain),
            'default' => "Price",
        ),
        array(
            'id'       => 'cl_subl_price_plac',
            'type'     => 'text',
            'title'    => esc_html__("Price Placeholder", $theme_text_domain),
            'default' => "Enter the price",
        ),

        array(
            'id'       => 'cl_subl_price_postfix',
            'type'     => 'text',
            'title'    => esc_html__("Price Postfix", $theme_text_domain),
            'default' => "Price",
        ),
        array(
            'id'       => 'cl_subl_price_postfix_plac',
            'type'     => 'text',
            'title'    => esc_html__("Price Postfix Placeholder", $theme_text_domain),
            'default' => "Enter the price postfix",
        ),

        array(
            'id'       => 'cl_subl_size',
            'type'     => 'text',
            'title'    => esc_html__("Property Size", $theme_text_domain),
            'default' => "Property Size",
        ),
        array(
            'id'       => 'cl_subl_size_plac',
            'type'     => 'text',
            'title'    => esc_html__("Property Size Placeholder", $theme_text_domain),
            'default' => "Enter the property size",
        ),

        array(
            'id'       => 'cl_subl_size_postfix',
            'type'     => 'text',
            'title'    => esc_html__("Size Postfix", $theme_text_domain),
            'default' => "Size Postfix",
        ),
        array(
            'id'       => 'cl_subl_size_postfix_plac',
            'type'     => 'text',
            'title'    => esc_html__("Size Postfix Placeholder", $theme_text_domain),
            'default' => "Enter the property size postfix",
        ),

        array(
            'id'       => 'cl_subl_type',
            'type'     => 'text',
            'title'    => esc_html__("Property Type", $theme_text_domain),
            'default' => "Property Type",
        ),
        array(
            'id'       => 'cl_subl_type_plac',
            'type'     => 'text',
            'title'    => esc_html__("Property Type Placeholder", $theme_text_domain),
            'default' => "Enter the property type",
        ),

        array(
            'id'       => 'cl_subl_date',
            'type'     => 'text',
            'title'    => esc_html__("Availability Date", $theme_text_domain),
            'default' => "Availability Date",
        ),
        array(
            'id'       => 'cl_subl_date_plac',
            'type'     => 'text',
            'title'    => esc_html__("Availability Date Placeholder", $theme_text_domain),
            'default' => "Enter the availability date",
        ),

        array(
            'id'       => 'cl_subl_ids',
            'type'     => 'text',
            'title'    => esc_html__("Listing IDs", $theme_text_domain),
            'default' => "Listing IDs",
        ),
        array(
            'id'       => 'cl_subl_ids_plac',
            'type'     => 'text',
            'title'    => esc_html__("Listing IDs Placeholder", $theme_text_domain),
            'default' => "Enter the listing IDs comma separated",
        ),
        array(
            'id'       => 'cl_subl_ids_tooltip',
            'type'     => 'text',
            'title'    => esc_html__("Listing IDs Tooltp", $theme_text_domain),
            'default' => "If the sub-properties are separated listings, use the box above to enter the listing IDs (Example: 4,5,6)",
        ),

        array(
            'id'       => 'cl_location_section-end',
            'type'     => 'section',
            'indent'   => false,
        ),
        
    )
));

Redux::setSection( $opt_name, array(
    'title'  => esc_html__( 'Property Detail Page', $theme_text_domain ),
    'id'     => 'property-details-labels',
    'desc'   => esc_html__( 'Manage titles for property detail page.', $theme_text_domain ),
    'subsection'   => true,
    'fields'        => array(
        
        /*--------------------------------------------------------------
        * Property detail and create listing section titles
        **------------------------------------------------------------*/
        array(
            'id'       => 'sp_sections_section-start',
            'type'     => 'section',
            'title'    => esc_html__('Sections Titles', $theme_text_domain),
            'subtitle' => esc_html__('Manage Single Property page section titles', $theme_text_domain),
            'indent'   => true,
        ),

        array(
            'id'       => 'sps_overview',
            'type'     => 'text',
            'title'    => esc_html__('Overview title', $theme_text_domain),
            'default' => 'Overview',
        ),

        array(
            'id'       => 'sps_description',
            'type'     => 'text',
            'title'    => esc_html__('Description title', $theme_text_domain),
            'default' => 'Description',
        ),

        array(
            'id'       => 'sps_documents',
            'type'     => 'text',
            'title'    => esc_html__('Property Documents title', $theme_text_domain),
            'default' => 'Property Documents',
        ),

        array(
            'id'       => 'sps_details',
            'type'     => 'text',
            'title'    => esc_html__('Details title', $theme_text_domain),
            'default' => 'Details',
        ),
        array(
            'id'       => 'sps_additional_details',
            'type'     => 'text',
            'title'    => esc_html__('Additional details title', $theme_text_domain),
            'default' => 'Additional details',
        ),
        array(
            'id'       => 'sps_address',
            'type'     => 'text',
            'title'    => esc_html__('Address title', $theme_text_domain),
            'default' => 'Address',
        ),
        array(
            'id'       => 'sps_features',
            'type'     => 'text',
            'title'    => esc_html__('Features title', $theme_text_domain),
            'default' => 'Features',
        ),
        array(
            'id'       => 'sps_video',
            'type'     => 'text',
            'title'    => esc_html__('Video title', $theme_text_domain),
            'default' => 'Video',
        ),
        array(
            'id'       => 'sps_virtual_tour',
            'type'     => 'text',
            'title'    => esc_html__('360° Virtual Tour title', $theme_text_domain),
            'default' => '360° Virtual Tour',
        ),

        array(
            'id'       => 'sps_sub_listings',
            'type'     => 'text',
            'title'    => esc_html__('Sub listings title', $theme_text_domain),
            'default' => 'Sub listings',
        ),
        array(
            'id'       => 'sps_energy_class',
            'type'     => 'text',
            'title'    => esc_html__('Energy Class title', $theme_text_domain),
            'default' => 'Energy Class',
        ),
        array(
            'id'       => 'sps_floor_plans',
            'type'     => 'text',
            'title'    => esc_html__('Floor Plans title', $theme_text_domain),
            'default' => 'Floor Plans',
        ),
        array(
            'id'       => 'sps_calculator',
            'type'     => 'text',
            'title'    => esc_html__('Mortgage Calculator title', $theme_text_domain),
            'default' => 'Mortgage Calculator',
        ),
        array(
            'id'       => 'sps_walkscore',
            'type'     => 'text',
            'title'    => esc_html__('Walkscore title', $theme_text_domain),
            'default' => 'Walkscore',
        ),
        array(
            'id'       => 'sps_nearby',
            'type'     => 'text',
            'title'    => esc_html__("What's Nearby? title", $theme_text_domain),
            'default' => "What's Nearby?",
        ),
        array(
            'id'       => 'sps_schedule_tour',
            'type'     => 'text',
            'title'    => esc_html__("Schedule a Tour title", $theme_text_domain),
            'default' => "Schedule a Tour",
        ),

        array(
            'id'       => 'sps_contact',
            'type'     => 'text',
            'title'    => esc_html__("Contact title", $theme_text_domain),
            'default' => "Contact",
        ),

        array(
            'id'       => 'sps_contact_info',
            'type'     => 'text',
            'title'    => esc_html__("Contact Information title", $theme_text_domain),
            'default' => "Contact Information",
        ),

        array(
            'id'       => 'sps_your_info',
            'type'     => 'text',
            'title'    => esc_html__("Your information title", $theme_text_domain),
            'default' => "Your information",
        ),

        array(
            'id'       => 'sps_propperty_enqry',
            'type'     => 'text',
            'title'    => esc_html__("Enquire About This Property title", $theme_text_domain),
            'default' => "Enquire About This Property",
        ),

        array(
            'id'       => 'sps_reviews',
            'type'     => 'text',
            'title'    => esc_html__("Reviews title", $theme_text_domain),
            'default' => "Reviews",
        ),
        array(
            'id'       => 'sps_similar_listings',
            'type'     => 'text',
            'title'    => esc_html__("Similar Listings title", $theme_text_domain),
            'default' => "Similar Listings",
        ),

        array(
            'id'       => 'sp_sections_section-end',
            'type'     => 'section',
            'indent'   => false,
        ),
        /*------------------------------- Detail page labels ---------------------------------------*/
        array(
            'id'       => 'sp_labels_section-start',
            'type'     => 'section',
            'title'    => esc_html__('Property Detail Labels', $theme_text_domain),
            'subtitle' => esc_html__('Manage property detail page labels', $theme_text_domain),
            'indent'   => true,
        ),

        array(
            'id'       => 'spl_prop_id',
            'type'     => 'text',
            'title'    => esc_html__("Property ID", $theme_text_domain),
            'default' => "Property ID",
        ),
        array(
            'id'       => 'spl_price',
            'type'     => 'text',
            'title'    => esc_html__('Price', $theme_text_domain),
            'default' => "Price",
        ),

        array(
            'id'       => 'spl_prop_type',
            'type'     => 'text',
            'title'    => esc_html__("Property Type", $theme_text_domain),
            'default' => "Property Type",
        ),
        array(
            'id'       => 'spl_prop_status',
            'type'     => 'text',
            'title'    => esc_html__("Property Status", $theme_text_domain),
            'default' => "Property Status",
        ),
        array(
            'id'       => 'spl_prop_size',
            'type'     => 'text',
            'title'    => esc_html__("Property Size", $theme_text_domain),
            'default' => "Property Size",
        ),
        array(
            'id'       => 'spl_land',
            'type'     => 'text',
            'title'    => esc_html__("Land Area", $theme_text_domain),
            'default' => "Land Area",
        ),
        array(
            'id'       => 'spl_room',
            'type'     => 'text',
            'title'    => esc_html__('Room Label', $theme_text_domain),
            'default' => 'Room',
        ),
        array(
            'id'       => 'spl_rooms',
            'type'     => 'text',
            'title'    => esc_html__('Rooms Label', $theme_text_domain),
            'default' => 'Rooms',
        ),
        array(
            'id'       => 'spl_bedroom',
            'type'     => 'text',
            'title'    => esc_html__('Bedroom Label', $theme_text_domain),
            'default' => 'Bedroom',
        ),
        array(
            'id'       => 'spl_bedrooms',
            'type'     => 'text',
            'title'    => esc_html__('Bedrooms Label', $theme_text_domain),
            'default' => 'Bedrooms',
        ),
        array(
            'id'       => 'spl_bathroom',
            'type'     => 'text',
            'title'    => esc_html__('Bathroom Label', $theme_text_domain),
            'default' => 'Bathroom',
        ),
        array(
            'id'       => 'spl_bathrooms',
            'type'     => 'text',
            'title'    => esc_html__('Bathrooms Label', $theme_text_domain),
            'default' => 'Bathrooms',
        ),
        array(
            'id'       => 'spl_garage',
            'type'     => 'text',
            'title'    => esc_html__('Garage Label', $theme_text_domain),
            'default' => 'Garage',
        ),
        array(
            'id'       => 'spl_garages',
            'type'     => 'text',
            'title'    => esc_html__('Garages Label', $theme_text_domain),
            'default' => 'Garages',
        ),
        array(
            'id'       => 'spl_garage_size',
            'type'     => 'text',
            'title'    => esc_html__('Garage Size Label', $theme_text_domain),
            'default' => 'Garage Size',
        ),
        array(
            'id'       => 'spl_year_built',
            'type'     => 'text',
            'title'    => esc_html__('Year Built Label', $theme_text_domain),
            'default' => 'Year Built',
        ),
        array(
            'id'       => 'spl_lot',
            'type'     => 'text',
            'title'    => esc_html__('Lot', $theme_text_domain),
            'default' => 'Lot',
        ),
        array(
            'id'       => 'spl_ogm',
            'type'     => 'text',
            'title'    => esc_html__('Open on Google Maps', $theme_text_domain),
            'default' => 'Open on Google Maps',
        ),

        array(
            'id'       => 'spl_address',
            'type'     => 'text',
            'title'    => esc_html__('Address Label', $theme_text_domain),
            'default' => 'Address',
        ),
        array(
            'id'       => 'spl_zip',
            'type'     => 'text',
            'title'    => esc_html__('Zip/Postal Code Label', $theme_text_domain),
            'default' => 'Zip/Postal Code',
        ),
        array(
            'id'       => 'spl_country',
            'type'     => 'text',
            'title'    => esc_html__('Country Label', $theme_text_domain),
            'default' => 'Country',
        ),
        array(
            'id'       => 'spl_state',
            'type'     => 'text',
            'title'    => esc_html__('State/county Label', $theme_text_domain),
            'default' => 'State/county',
        ),
        array(
            'id'       => 'spl_city',
            'type'     => 'text',
            'title'    => esc_html__('City Label', $theme_text_domain),
            'default' => 'City',
        ),
        array(
            'id'       => 'spl_area',
            'type'     => 'text',
            'title'    => esc_html__('Area Label', $theme_text_domain),
            'default' => 'Area',
        ),

        array(
            'id'       => 'sp_labels_section-end',
            'type'     => 'section',
            'indent'   => false,
        ),

        array(
            'id'       => 'sp_agent_forms_section-start',
            'type'     => 'section',
            'title'    => esc_html__('Contact Forms', $theme_text_domain),
            'subtitle' => esc_html__('Manage labels for agent contact forms and schedule tour', $theme_text_domain),
            'indent'   => true,
        ),

        array(
            'id'       => 'spl_con_name',
            'type'     => 'text',
            'title'    => esc_html__("Name", $theme_text_domain),
            'default' => "Name",
        ),
        array(
            'id'       => 'spl_con_name_plac',
            'type'     => 'text',
            'title'    => esc_html__("Name Placeholder", $theme_text_domain),
            'default' => "Enter your name",
        ),

        array(
            'id'       => 'spl_con_phone',
            'type'     => 'text',
            'title'    => esc_html__("Phone", $theme_text_domain),
            'default' => "Phone",
        ),
        array(
            'id'       => 'spl_con_phone_plac',
            'type'     => 'text',
            'title'    => esc_html__("Phone Placeholder", $theme_text_domain),
            'default' => "Enter your Phone",
        ),

        array(
            'id'       => 'spl_con_email',
            'type'     => 'text',
            'title'    => esc_html__("Email", $theme_text_domain),
            'default' => "Email",
        ),
        array(
            'id'       => 'spl_con_email_plac',
            'type'     => 'text',
            'title'    => esc_html__("Email Placeholder", $theme_text_domain),
            'default' => "Enter your email",
        ),

        array(
            'id'       => 'spl_con_message',
            'type'     => 'text',
            'title'    => esc_html__("Message", $theme_text_domain),
            'default' => "Message",
        ),
        array(
            'id'       => 'spl_con_message_plac',
            'type'     => 'text',
            'title'    => esc_html__("Message Placeholder", $theme_text_domain),
            'default' => "Enter your Message",
        ),

        array(
            'id'       => 'spl_con_interested',
            'type'     => 'text',
            'title'    => esc_html__("Message Default Prefix", $theme_text_domain),
            'default' => "Hello, I am interested in",
        ),

        array(
            'id'       => 'spl_con_usertype',
            'type'     => 'text',
            'title'    => esc_html__("I'm a", $theme_text_domain),
            'default' => "I'm a",
        ),
        
        array(
            'id'       => 'spl_con_select',
            'type'     => 'text',
            'title'    => esc_html__("Select", $theme_text_domain),
            'default' => "Select",
        ),

        array(
            'id'       => 'spl_con_buyer',
            'type'     => 'text',
            'title'    => esc_html__("I'm a buyer", $theme_text_domain),
            'default' => "I'm a buyer",
        ),

        array(
            'id'       => 'spl_con_tennant',
            'type'     => 'text',
            'title'    => esc_html__("I'm a tennant", $theme_text_domain),
            'default' => "I'm a tennant",
        ),

        array(
            'id'       => 'spl_con_agent',
            'type'     => 'text',
            'title'    => esc_html__("I'm an agent", $theme_text_domain),
            'default' => "I'm an agent",
        ),

        array(
            'id'       => 'spl_con_other',
            'type'     => 'text',
            'title'    => esc_html__("Other", $theme_text_domain),
            'default' => "Other",
        ),

        array(
            'id'       => 'spl_con_view_listings',
            'type'     => 'text',
            'title'    => esc_html__("View Listings link", $theme_text_domain),
            'default' => "View Listings",
        ),

        array(
            'id'       => 'spl_con_tour_type',
            'type'     => 'text',
            'title'    => esc_html__("Tour Type", $theme_text_domain),
            'default' => "Tour Type",
        ),
        array(
            'id'       => 'spl_con_in_person',
            'type'     => 'text',
            'title'    => esc_html__("In Person", $theme_text_domain),
            'default' => "In Person",
        ),
        array(
            'id'       => 'spl_con_video_chat',
            'type'     => 'text',
            'title'    => esc_html__("Video Chat", $theme_text_domain),
            'default' => "Video Chat",
        ),
        array(
            'id'       => 'spl_con_date',
            'type'     => 'text',
            'title'    => esc_html__("Date", $theme_text_domain),
            'default' => "Date",
        ),
        array(
            'id'       => 'spl_con_date_plac',
            'type'     => 'text',
            'title'    => esc_html__("Date Placeholder", $theme_text_domain),
            'default' => "Select tour date",
        ),

        array(
            'id'       => 'spl_con_time',
            'type'     => 'text',
            'title'    => esc_html__("Time", $theme_text_domain),
            'default' => "Time",
        ),

        array(
            'id'       => 'spl_btn_send',
            'type'     => 'text',
            'title'    => esc_html__("Send Email Button", $theme_text_domain),
            'default' => "Send Email",
        ),
        array(
            'id'       => 'spl_btn_call',
            'type'     => 'text',
            'title'    => esc_html__("Call Button", $theme_text_domain),
            'default' => "Call",
        ),

        array(
            'id'       => 'spl_btn_message',
            'type'     => 'text',
            'title'    => esc_html__("Send Message Button", $theme_text_domain),
            'default' => "Send Message",
        ),

        array(
            'id'       => 'spl_btn_request_info',
            'type'     => 'text',
            'title'    => esc_html__("Request Information Button", $theme_text_domain),
            'default' => "Request Information",
        ),
        array(
            'id'       => 'spl_btn_tour_sch',
            'type'     => 'text',
            'title'    => esc_html__("Submit a Tour Request Button", $theme_text_domain),
            'default' => "Submit a Tour Request",
        ),

        array(
            'id'       => 'spl_sub_agree',
            'type'     => 'text',
            'title'    => esc_html__("By submitting this form I agree to", $theme_text_domain),
            'default' => "By submitting this form I agree to",
        ),

        array(
            'id'       => 'spl_term',
            'type'     => 'text',
            'title'    => esc_html__("Terms of Use", $theme_text_domain),
            'default' => "Terms of Use",
        ),

        array(
            'id'       => 'agent_forms_terms_validation',
            'type'     => 'text',
            'title'    => esc_html__( 'Terms of Use Checkbox Validation Message', $theme_text_domain ),
            'subtitle' => '',
            'default'  => 'Please accept terms of use'
        ),

        array(
            'id'       => 'sp_agent_forms_section-end',
            'type'     => 'section',
            'indent'   => false,
        ),

        /*------------------------------------------- Energy Detail page -------------------------*/
        array(
            'id'       => 'sp_energy_labels_section-start',
            'type'     => 'section',
            'title'    => esc_html__('Energy Class', $theme_text_domain),
            'subtitle' => esc_html__('Manage labels for energy class section', $theme_text_domain),
            'indent'   => true,
        ),

        array(
            'id'       => 'spl_energetic_cls',
            'type'     => 'text',
            'title'    => esc_html__("Energetic class", $theme_text_domain),
            'default' => "Energetic class",
        ),
        
        array(
            'id'       => 'spl_energy_index',
            'type'     => 'text',
            'title'    => esc_html__("Global Energy Performance Index", $theme_text_domain),
            'default' => "Global Energy Performance Index",
        ),
       
        array(
            'id'       => 'spl_energy_renew_index',
            'type'     => 'text',
            'title'    => esc_html__("Renewable energy performance index", $theme_text_domain),
            'default' => "Renewable energy performance index",
        ),
        

        array(
            'id'       => 'spl_energy_build_performance',
            'type'     => 'text',
            'title'    => esc_html__("Energy performance of the building", $theme_text_domain),
            'default' => "Energy performance of the building",
        ),
        

        array(
            'id'       => 'spl_energy_ecp_rating',
            'type'     => 'text',
            'title'    => esc_html__("EPC Current Rating", $theme_text_domain),
            'default' => "EPC Current Rating",
        ),
    
        array(
            'id'       => 'spl_energy_ecp_p',
            'type'     => 'text',
            'title'    => esc_html__("EPC Potential Rating", $theme_text_domain),
            'default' => "EPC Potential Rating",
        ),
        array(
            'id'       => 'spl_energy_cls',
            'type'     => 'text',
            'title'    => esc_html__("Energy class", $theme_text_domain),
            'default' => "Energy class",
        ),
        
        array(
            'id'       => 'sp_energy_labels_section-end',
            'type'     => 'section',
            'indent'   => false,
        ),

        /*------------------------------------------- Mortgage Calculator -------------------------*/
        array(
            'id'       => 'sp_mortgage_cal_labels_section-start',
            'type'     => 'section',
            'title'    => esc_html__('Mortgage Calculator', $theme_text_domain),
            'subtitle' => esc_html__('Manage labels for mortgage calculator section', $theme_text_domain),
            'indent'   => true,
        ),

        array(
            'id'       => 'spc_principal_ints',
            'type'     => 'text',
            'title'    => esc_html__("Principal & Interest", $theme_text_domain),
            'default' => "Principal & Interest",
        ),

        array(
            'id'       => 'spc_prop_tax',
            'type'     => 'text',
            'title'    => esc_html__("Property Tax", $theme_text_domain),
            'default' => "Property Tax",
        ),
        array(
            'id'       => 'spc_hi',
            'type'     => 'text',
            'title'    => esc_html__("Home Insurance", $theme_text_domain),
            'default' => "Home Insurance",
        ),
        array(
            'id'       => 'spc_pmi',
            'type'     => 'text',
            'title'    => esc_html__("PMI", $theme_text_domain),
            'default' => "PMI",
        ),
        array(
            'id'       => 'spc_total_amt',
            'type'     => 'text',
            'title'    => esc_html__("Total Amount", $theme_text_domain),
            'default' => "Total Amount",
        ),
        array(
            'id'       => 'spc_down_payment',
            'type'     => 'text',
            'title'    => esc_html__("Down Payment", $theme_text_domain),
            'default' => "Down Payment",
        ),
        array(
            'id'       => 'spc_ir',
            'type'     => 'text',
            'title'    => esc_html__("Interest Rate", $theme_text_domain),
            'default' => "Interest Rate",
        ),

        array(
            'id'       => 'spc_load_term',
            'type'     => 'text',
            'title'    => esc_html__("Loan Term", $theme_text_domain),
            'default' => "Loan Terms (Years)",
        ),

        array(
            'id'       => 'spc_monthly',
            'type'     => 'text',
            'title'    => esc_html__("Monthly", $theme_text_domain),
            'default' => "Monthly",
        ),
        array(
            'id'       => 'spc_btn_cal',
            'type'     => 'text',
            'title'    => esc_html__("Calculate Button", $theme_text_domain),
            'default' => "Calculate",
        ),
        
        
        array(
            'id'       => 'sp_mortgage_cal_labels_section-end',
            'type'     => 'section',
            'indent'   => false,
        ),
        
    )
))
?>