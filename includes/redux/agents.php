<?php
global $opt_name,$theme_text_domain, $allowed_html_array;
Redux::setSection( $opt_name, array(
    'title'  => esc_html__( 'Agents', $theme_text_domain ),
    'id'     => 'houzez-agents',
    'desc'   => '',
    'icon'   => 'el-icon-user el-icon-small',
    'fields'        => array(
        array(
            'id'       => 'num_of_agents',
            'type'     => 'text',
            'title'    => esc_html__( 'Number of Agents', $theme_text_domain ),
            'subtitle'    => esc_html__( 'Number of agents to display on the All Agents page template', $theme_text_domain ),
            'desc'    => esc_html__( 'Enter the number of agents', $theme_text_domain ),
            'default'  => '9'
        ),
        array(
            'id'       => 'agent_tabs',
            'type'     => 'switch',
            'title'    => esc_html__( 'Tabs', $theme_text_domain ),
            'subtitle' => esc_html__('Property status tabs displayed in the agent detail page', $theme_text_domain),
            'desc' => esc_html__( 'Enable or disable the tabs on agent detail page', $theme_text_domain ),
            'default'  => 0,
            'on'       => 'Enabled',
            'off'      => 'Disabled',
        ),
        array(
            'id'       => 'agent_detail_tab_1',
            'type'     => 'select',
            'title'    => esc_html__('Tab 1', $theme_text_domain),
            'subtitle' => esc_html__('Property status tab in the agent detail page', $theme_text_domain),
            'desc'     => esc_html__('Select the status', $theme_text_domain),
            'data'     => 'terms',
            'required' => array('agent_tabs', '=', '1'),
            'args'        =>  array('taxonomy'=>'property_status'),
            'default' => ''
        ),
        array(
            'id'       => 'agent_detail_tab_2',
            'type'     => 'select',
            'title'    => esc_html__('Tab 2', $theme_text_domain),
            'subtitle' => esc_html__('Property status tab in the agent detail page', $theme_text_domain),
            'desc'     => esc_html__('Select the status', $theme_text_domain),
            'required' => array('agent_tabs', '=', '1'),
            'data'        => 'terms',
            'args'        =>  array('taxonomy'=>'property_status'),
            'default' => ''
        ),

        array(
            'id'       => 'agent_listings_layout',
            'type'     => 'select',
            'title'    => __('Listings Layout', $theme_text_domain),
            'subtitle' => __('Select the listings layout for the agent detail page', $theme_text_domain),
            'desc'     => esc_html__('Select the layout', $theme_text_domain),
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
            'id'       => 'num_of_agent_listings',
            'type'     => 'text',
            'title'    => esc_html__( 'Number of Listings', $theme_text_domain ),
            'subtitle'    => esc_html__( 'Number of listings to display on the agent detail page', $theme_text_domain ),
            'desc'    => esc_html__( 'Enter the number of listings', $theme_text_domain ),
            'default'  => '10'
        ),
        array(
            'id'       => 'agent_listings_order',
            'type'     => 'select',
            'title'    => __('Default Order', $theme_text_domain),
            'subtitle' => __('Listings order on the agent detail page', $theme_text_domain),
            'desc' => __('Select the listings order.', $theme_text_domain),
            'options'  => array(
                'default' => esc_html__( 'Default', $theme_text_domain ),
                'd_date' => esc_html__( 'Date New to Old', $theme_text_domain ),
                'a_date' => esc_html__( 'Date Old to New', $theme_text_domain ),
                'd_price' => esc_html__( 'Price (High to Low)', $theme_text_domain ),
                'a_price' => esc_html__( 'Price (Low to High)', $theme_text_domain ),
                'featured_first' => esc_html__( 'Show Featured Listings on Top', $theme_text_domain ),
            ),
            'default' => 'default'
        ),

        array(
            'id'       => 'agent_mobile',
            'type'     => 'switch',
            'title'    => esc_html__( 'Mobile', $theme_text_domain ),
            'subtitle' => '',
            'default'  => 1,
            'on'       => 'Enabled',
            'off'      => 'Disabled',
        ),
        array(
            'id'       => 'agent_phone',
            'type'     => 'switch',
            'title'    => esc_html__( 'Office Phone', $theme_text_domain ),
            'subtitle' => '',
            'default'  => 1,
            'on'       => 'Enabled',
            'off'      => 'Disabled',
        ),

         array(
            'id'       => 'agent_fax',
            'type'     => 'switch',
            'title'    => esc_html__( 'Fax', $theme_text_domain ),
            'subtitle' => '',
            'default'  => 1,
            'on'       => 'Enabled',
            'off'      => 'Disabled',
        ),

         array(
            'id'       => 'agent_email',
            'type'     => 'switch',
            'title'    => esc_html__( 'Email', $theme_text_domain ),
            'subtitle' => '',
            'default'  => 1,
            'on'       => 'Enabled',
            'off'      => 'Disabled',
        ),

         array(
            'id'       => 'agent_website',
            'type'     => 'switch',
            'title'    => esc_html__( 'Website', $theme_text_domain ),
            'subtitle' => '',
            'default'  => 1,
            'on'       => 'Enabled',
            'off'      => 'Disabled',
        ),

         array(
            'id'       => 'agent_social',
            'type'     => 'switch',
            'title'    => esc_html__( 'Social', $theme_text_domain ),
            'subtitle' => '',
            'default'  => 1,
            'on'       => 'Enabled',
            'off'      => 'Disabled',
        ),

        array(
            'id'       => 'agent_stats',
            'type'     => 'switch',
            'title'    => esc_html__( 'Stats', $theme_text_domain ),
            'subtitle' => esc_html__('Enable or disable the stats on agent detail page', $theme_text_domain),
            'default'  => 1,
            'on'       => 'Enabled',
            'off'      => 'Disabled',
        ),
        array(
            'id'       => 'agent_review',
            'type'     => 'switch',
            'title'    => esc_html__( 'Review & Rating', $theme_text_domain ),
            'subtitle' => '',
            'default'  => 1,
            'on'       => 'Enabled',
            'off'      => 'Disabled',
        ),
        array(
            'id'       => 'agent_listings',
            'type'     => 'switch',
            'title'    => esc_html__( 'Listings', $theme_text_domain ),
            'subtitle' => '',
            'default'  => 1,
            'on'       => 'Enabled',
            'off'      => 'Disabled',
        ),
        array(
            'id'       => 'agent_bio',
            'type'     => 'switch',
            'title'    => esc_html__( 'About Agent', $theme_text_domain ),
            'subtitle' => '',
            'default'  => 1,
            'on'       => 'Enabled',
            'off'      => 'Disabled',
        ),
        array(
            'id'       => 'agent_sidebar',
            'type'     => 'switch',
            'title'    => esc_html__( 'Agent Sidebar', $theme_text_domain ),
            'subtitle' => '',
            'default'  => 1,
            'on'       => 'Enabled',
            'off'      => 'Disabled',
        ),
    ),
    
));