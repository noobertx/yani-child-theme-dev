<?php
global $opt_name,$theme_text_domain;
$date_languages = array();
Redux::setSection( $opt_name, array(
    'title'  => esc_html__( 'General', $theme_text_domain ),
    'id'     => 'general-options',
    'desc'   => '',
    'icon'   => 'el-icon-dashboard el-icon-small',
    'fields'        => array(
        
        array(
            'id'       => 'site_breadcrumb',
            'type'     => 'switch',
            'title'    => esc_html__( 'Breadcrumb?', $theme_text_domain ),
            'desc'     => '',
            'subtitle' => esc_html__( 'Show breadcrumb', $theme_text_domain ),
            'default'  => 1,
            'on'       => esc_html__( 'Yes', $theme_text_domain ),
            'off'      => esc_html__( 'No', $theme_text_domain ), 
        ),
        array(
            'id'       => 'phone_number_full',
            'type'     => 'switch',
            'title'    => esc_html__( 'Phone/Mobile Number', $theme_text_domain ),
            'desc'     => '',
            'subtitle' => esc_html__( 'Show full phone number for agents, agencies across the site.', $theme_text_domain ),
            'default'  => 1,
            'on'       => esc_html__( 'Yes', $theme_text_domain ),
            'off'      => esc_html__( 'No', $theme_text_domain ), 
        ),
        array(
            'id'       => 'gallery_caption',
            'type'     => 'switch',
            'title'    => esc_html__( 'Gallery Image Caption?', $theme_text_domain ),
            'desc'     => '',
            'subtitle' => esc_html__( 'Show impage caption for property detail page gallery?', $theme_text_domain ),
            'default'  => 0,
            'on'       => esc_html__( 'Yes', $theme_text_domain ),
            'off'      => esc_html__( 'No', $theme_text_domain ),
        ),
        array(
            'id'       => 'lightbox_caption',
            'type'     => 'switch',
            'title'    => esc_html__( 'Popup Gallery Image Caption?', $theme_text_domain ),
            'desc'     => '',
            'subtitle' => esc_html__( 'Show impage caption for popup gallery?', $theme_text_domain ),
            'default'  => 0,
            'on'       => esc_html__( 'Yes', $theme_text_domain ),
            'off'      => esc_html__( 'No', $theme_text_domain ),
        ),
        array(
            'id'       => 'terms_condition',
            'type'     => 'select',
            'data'     => 'pages',
            'title'    => esc_html__( 'Terms & Conditions Page', $theme_text_domain ),
            'subtitle' => '',
            'desc'     => esc_html__( 'Select which page to use for Terms & Conditions', $theme_text_domain ),
        ),
        array(
            'id'        => 'yani_date_language',
            'type'      => 'select',
            'title'     => esc_html__( 'Language for datepicker', $theme_text_domain ),
            'subtitle'  => esc_html__( 'This applies for the calendar field type available for properties.', $theme_text_domain ),
            'options'   => $date_languages,
            'default' => 'US'
        ),
        /*array(
            'id'        => 'default_country',
            'type'      => 'select',
            'title'     => esc_html__( 'Country', $theme_text_domain ),
            'subtitle'  => esc_html__( 'Select default country', $theme_text_domain ),
            'options'   => $Countries,
            'default' => 'US'
        ),*/
        
        array(
            'id'       => 'users_admin_access',
            'type'     => 'switch',
            'title'    => esc_html__( 'Block Users Admin Access?', $theme_text_domain ),
            'desc'     => '',
            'subtitle' => esc_html__( 'Restrict user admin panel access', $theme_text_domain ),
            'default'  => 1,
            'on'       => esc_html__( 'Yes', $theme_text_domain ),
            'off'      => esc_html__( 'No', $theme_text_domain ),
        ),
        
        array(
            'id'       => 'yani_templates',
            'type'     => 'select',
            'multi'    => true,
            'title'    => esc_html__('Templates', $theme_text_domain),
            'subtitle' => esc_html__('Select templates which you want to remove from template list when add new page', $theme_text_domain),
            'options' => array(
                'template/template-listing-grid-v1.php' => 'Template listings grid v1',
                'template/template-listing-grid-v1-fullwidth-2cols.php' => 'Template listings grid v1 full width 2Cols',
                'template/template-listing-grid-v1-fullwidth-3cols.php' => 'Template listings grid v1 full width 3Cols',
                'template/template-listing-grid-v1-fullwidth-4cols.php' => 'Template listings grid v1 full width 4Cols',
                'template/template-listing-grid-v2.php' => 'Template listings grid v2',
                'template/template-listing-grid-v2-fullwidth-2cols.php' => 'Template listings grid v2 full width 2Cols',
                'template/template-listing-grid-v2-fullwidth-3cols.php' => 'Template listings grid v2 full width 3Cols',
                'template/template-listing-grid-v2-fullwidth-4cols.php' => 'Template listings grid v2 full width 4Cols',
                'template/template-listing-grid-v3.php' => 'Template listings grid v3',
                'template/template-listing-grid-v3-fullwidth-2cols.php' => 'Template listings grid v3 full width 2Cols',
                'template/template-listing-grid-v3-fullwidth-3cols.php' => 'Template listings grid v3 full width 3Cols',
                'template/template-listing-grid-v4.php' => 'Template listings grid v4',
                'template/template-listing-grid-v5.php' => 'Template listings grid v5',
                'template/template-listing-grid-v5-fullwidth-2cols.php' => 'Template listings grid v5 full width 2Cols',
                'template/template-listing-grid-v5-fullwidth-3cols.php' => 'Template listings grid v5 full width 3Cols',
                'template/template-listing-grid-v6.php' => 'Template listings grid v6',
                'template/template-listing-grid-v6-fullwidth-2cols.php' => 'Template listings grid v6 full width 2Cols',
                'template/template-listing-grid-v6-fullwidth-3cols.php' => 'Template listings grid v6 full width 3Cols',
                'template/template-listing-list-v1.php' => 'Template listings list v1',
                'template/template-listing-list-v1-fullwidth.php' => 'Template listings list v1 full width',
                'template/template-listing-list-v2.php' => 'Template listings list v2',
                'template/template-listing-list-v2-fullwidth.php' => 'Template listings list v2 full width',
                'template/template-listing-list-v5.php' => 'Template listings list v5',
                'template/template-listing-list-v5-fullwidth.php' => 'Template listings list v5 full width',
                'template/properties-parallax.php' => 'Template Listings Parallax',
                'template/property-listings-map.php' => 'Property Listing Half Map',
                'template/template-splash.php' => 'Splash Page Template',
                'template/reset_password.php' => 'Reset Password',
                'template/template-agents.php' => 'Template all agents',
                'template/template-agencies.php' => 'Template all agencies',
                'template/template-compare.php' => 'Compare Properties',
                'template/template-packages.php' => 'Packages',
                'template/template-onepage.php' => 'One Page Template',
                'template/template-page.php' => 'Page Template',
                'template/template-payment.php' => 'Payment Page',
                'template/template-stripe-charge.php' => 'Stripe Charge Page',
                'template/template-paypal-ipn.php' => 'Paypal Webhook ( Recurring Payment )',
                'template/blog-masonry.php' => 'Blog Masonry Template',
                'template/user_dashboard_crm.php' => 'Houzez CRM',
                'template/user_dashboard_favorites.php' => 'User Dashboard Favorite Properties',
                'template/user_dashboard_gdpr.php' => 'User Dashboard GDPR Request',
                'template/user_dashboard_insight.php' => 'User Dashboard Insight',
                'template/user_dashboard_invoices.php' => 'User Dashboard Invoices',
                'template/user_dashboard_membership.php' => 'User Dashboard Membership Info',
                'template/user_dashboard_saved_search.php' => 'User Dashboard Saved Search',
            )
        ),

        array(
            'id'       => 'yani_page_filters',
            'type'     => 'select',
            'multi'    => true,
            'title'    => esc_html__('Page Filters', $theme_text_domain),
            'subtitle' => esc_html__('Select which taxonomy filters you want to remove when add new page in admin panel.', $theme_text_domain),
            'options' => array(
                'property_type' => esc_html__('Types', $theme_text_domain),
                'property_status' => esc_html__('Statuses', $theme_text_domain),
                'property_city' => esc_html__('Cities', $theme_text_domain),
                'property_area' => esc_html__('Areas', $theme_text_domain),
                'property_states' => esc_html__('States', $theme_text_domain),
                'property_feature' => esc_html__('Features', $theme_text_domain),
                'property_label' => esc_html__('Labels', $theme_text_domain)
            )
        ),

        array(
            'id'       => 'measurement_unit_global',
            'type'     => 'switch',
            'title'    => esc_html__( 'Measurement Unit Globally', $theme_text_domain ),
            'subtitle' => esc_html__( 'Enable/Disable property measurement unit globally, it will overwrite measurement unit added for single properties', $theme_text_domain ),
            'default'  => 0,
            'on'       => esc_html__( 'Enabled', $theme_text_domain ),
            'off'      => esc_html__( 'Disabled', $theme_text_domain ),
        ),
        array(
            'id'        => 'measurement_unit',
            'type'      => 'select',
            'title'     => esc_html__( 'Measurement Unit', $theme_text_domain ),
            'subtitle'  => esc_html__( 'Select the measurement unit you will use on the website', $theme_text_domain ),
            'required' => array( 'measurement_unit_global', '=', '1' ),
            'options'   => array(
                'sqft' => 'Square Feet - ft²',
                'sq_meter' => 'Square Meters - m²',
            ),
            'default' => 'sqft'
        ),
        array(
            'id'        => 'measurement_unit_sqft_text',
            'type'      => 'text',
            'title'     => esc_html__( 'Square Feet Text', $theme_text_domain ),
            'subtitle'  => esc_html__( 'Enter text for square feet', $theme_text_domain ),
            'default' => 'sqft'
        ),
        array(
            'id'        => 'measurement_unit_square_meter_text',
            'type'      => 'text',
            'title'     => esc_html__( 'Square Meters Text', $theme_text_domain ),
            'subtitle'  => esc_html__( 'Enter text for square meters', $theme_text_domain ),
            'default' => 'm²'
        ),

        /*
        array(
            'id'       => 'site_scroll_top',
            'type'     => 'switch',
            'title'    => esc_html__( 'Scroll To Top?', $theme_text_domain ),
            'desc'     => '',
            'subtitle' => esc_html__( 'Enable/Disable Scroll to top', $theme_text_domain ),
            'default'  => 1,
            'on'       => esc_html__( 'Enabled', $theme_text_domain ),
            'off'      => esc_html__( 'Disabled', $theme_text_domain ),
        ),*/
        array(
            'id'       => 'sticky_sidebar',
            'type'     => 'checkbox',
            'title'    => esc_html__( 'Sticky Sidebar', $theme_text_domain ),
            'desc'     => '',
            'subtitle'     => esc_html__('Select in which page templates you want the sidebars to be sticky', $theme_text_domain),
            'options'  => array(
                'default_sidebar' => esc_html__('Default Page Template (Blog)', $theme_text_domain),
                'property_listings' => esc_html__('Listing Page', $theme_text_domain),
                'single_property' => esc_html__('Property Detail Page', $theme_text_domain),
                'agent_sidebar' => esc_html__('Agent Profile Page', $theme_text_domain),
                'agency_sidebar' => esc_html__('Agency Profile Page', $theme_text_domain),
                'search_sidebar' => esc_html__('Search Result Page', $theme_text_domain),
                'page_sidebar' => esc_html__('Page Template', $theme_text_domain)
            ),
            'default' => array(
                'default_sidebar' => '0',
                'property_listings' => '1',
                'single_property' => '1',
                'agent_sidebar' => '0',
                'agency_sidebar' => '0',
                'search_sidebar' => '0',
                'page_sidebar' => '0'
            )
        ),
    )
));	
?>