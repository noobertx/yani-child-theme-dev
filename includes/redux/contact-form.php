<?php
global $opt_name,$theme_text_domain;
Redux::setSection( $opt_name, array(
    'title'  => esc_html__( 'Contact Forms', $theme_text_domain ),
    'id'     => 'contact-form-7',
    'desc'   => '',
    'icon'   => 'el-icon-envelope el-icon-small',
    'fields'        => array(
        array(
            'id'       => 'form_type',
            'type'     => 'select',
            'title'    => esc_html__('Agent Form Type', $theme_text_domain),
            'desc' => esc_html__('Select which forms you want to use.', $theme_text_domain),
            'options'  => array(
                'custom_form' => 'Houzez Custom Forms',
                'contact_form_7' => 'Contact Form 7',
                'gravity_form' => 'Gravity Form',
                'hubspot' => 'HubSpot',
            ),
            'default' => 'custom_form',
        ),

        array(
            'id'     => 'hubspot-info',
            'type'   => 'info',
            'notice' => false,
            'style'  => 'info',
            'title'  => wp_kses(__( 'Follow <a target="_blank" href="https://favethemes.zendesk.com/hc/en-us/articles/360061352091-HubSpot">HubSpot Documentation</a>', $theme_text_domain ), $allowed_html_array),
            'subtitle' => __('"HubSpot" plugin required', $theme_text_domain),
            'desc'   => '',
            'required' => array('form_type', '=', 'hubspot')
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
            'id'       => 'contact_form_agent_above_image',
            'type'     => 'text',
            'title'    => esc_html__( 'Agent Contact Form', $theme_text_domain ),
            //'desc'     => '',
            'desc' => esc_html__( 'Enter the contact form shortcode for the agent form above image, sidebar and property gallery lightbox.', $theme_text_domain ),
            'default'  => '',
            'required' => array( 'form_type', '!=', 'custom_form' ),
        ),

        array(
            'id'       => 'contact_form_agent_bottom',
            'type'     => 'text',
            'required' => array( 'form_type', '!=', 'custom_form' ),
            'title'    => esc_html__( 'Agent Contact Form Bottom', $theme_text_domain ),
            //'desc'     => '',
            'desc' => esc_html__( 'Enter the contact form shortcode for the agent form at the bottom of the property detail page.', $theme_text_domain ),
            'default'  => ''
        ),

        array(
            'id'       => 'schedule_tour_shortcode',
            'type'     => 'text',
            'required' => array( 'form_type', '!=', 'custom_form' ),
            'title'    => esc_html__( 'Schedule Tour Form', $theme_text_domain ),
            //'desc'     => '',
            'desc' => esc_html__( 'Enter the contact form shortcode for the schedule tour form on property detail page.', $theme_text_domain ),
            'default'  => ''
        ),

        array(
            'id'       => 'contact_form_agent_detail',
            'type'     => 'text',
            'required' => array( 'form_type', '!=', 'custom_form' ),
            'title'    => esc_html__( 'Agent Profile Page From', $theme_text_domain ),
            //'desc'     => '',
            'desc' => esc_html__( 'Enter the contact form shortcode for the agent detail page.', $theme_text_domain ),
            'default'  => ''
        ),

        array(
            'id'       => 'contact_form_agency_detail',
            'type'     => 'text',
            'required' => array( 'form_type', '!=', 'custom_form' ),
            'title'    => esc_html__( 'Agency Profile Page Form', $theme_text_domain ),
            //'desc'     => '',
            'desc' => esc_html__( 'Enter the contact form shortcode for the agency detail page.', $theme_text_domain ),
            'default'  => ''
        ),

        array(
            'id'       => 'agent_form_above_image',
            'type'     => 'switch',
            'title'    => esc_html__( 'Property Page', $theme_text_domain ),
            'desc' => esc_html__( 'Enable or disable the agent contact form on property featured image for property detail v.1', $theme_text_domain ),
            'default'  => 1,
            'on'       => esc_html__( 'Enabled', $theme_text_domain ),
            'off'      => esc_html__( 'Disabled', $theme_text_domain ),
        ),

        array(
            'id'       => 'agent_form_sidebar',
            'type'     => 'switch',
            'title'    => esc_html__( 'Property Page Sidebar Form', $theme_text_domain ),
            'desc' => esc_html__( 'Enable or disable the agent contact form on the property detail page sidebar', $theme_text_domain ),
            'default'  => 1,
            'on'       => esc_html__( 'Enabled', $theme_text_domain ),
            'off'      => esc_html__( 'Disabled', $theme_text_domain ),
        ),

        array(
            'id'       => 'agent_form_gallery',
            'type'     => 'switch',
            'title'    => esc_html__( 'Property Page Popup Gallery Form', $theme_text_domain ),
            'desc' => esc_html__( 'Enable or disable the agent contact form on the property detail popup gallery', $theme_text_domain ),
            'default'  => 1,
            'on'       => esc_html__( 'Enabled', $theme_text_domain ),
            'off'      => esc_html__( 'Disabled', $theme_text_domain ),
        ),

        array(
            'id'       => 'agent_form_agent_page',
            'type'     => 'switch',
            'title'    => esc_html__( 'Agent Profile Page Form', $theme_text_domain ),
            'desc' => esc_html__( 'Enable or disable the agent contact form on the agent detail page', $theme_text_domain ),
            'default'  => 1,
            'on'       => esc_html__( 'Enabled', $theme_text_domain ),
            'off'      => esc_html__( 'Disabled', $theme_text_domain ),
        ),
        array(
            'id'       => 'agency_form_agency_page',
            'type'     => 'switch',
            'title'    => esc_html__( 'Agency Profile Page Form', $theme_text_domain ),
            'desc' => esc_html__( 'Enable or disable the agent contact form on the agency detail page', $theme_text_domain ),
            'default'  => 1,
            'on'       => esc_html__( 'Enabled', $theme_text_domain ),
            'off'      => esc_html__( 'Disabled', $theme_text_domain ),
        ),

        array(
            'id'       => 'agent_view_listing',
            'type'     => 'switch',
            'title'    => esc_html__( 'View Listings Button', $theme_text_domain ),
            //'desc'     => '',
            'desc' => esc_html__( 'Enable or disable the view listings on the agent form.', $theme_text_domain ),
            'default'  => 1,
            'on'       => 'Enabled',
            'off'      => 'Disabled',
        ),
        array(
            'id'       => 'agent_phone_num',
            'type'     => 'switch',
            'title'    => esc_html__( 'Phone Number', $theme_text_domain ),
            'desc' => esc_html__( 'Do you want to display the agent phone number?', $theme_text_domain ),
            'default'  => 1,
            'on'       => 'Yes',
            'off'      => 'No',
        ),
        array(
            'id'       => 'agent_mobile_num',
            'type'     => 'switch',
            'title'    => esc_html__( 'Mobile Number', $theme_text_domain ),
            'desc' => esc_html__( 'Do you want to display the agent mobile number?', $theme_text_domain ),
            'default'  => 1,
            'on'       => 'Yes',
            'off'      => 'No',
        ),
        array(
            'id'       => 'agent_whatsapp_num',
            'type'     => 'switch',
            'title'    => esc_html__( 'WhatsApp', $theme_text_domain ),
            'desc' => esc_html__( 'Do you want to display the agent WhatsApp?', $theme_text_domain ),
            'default'  => 1,
            'on'       => 'Yes',
            'off'      => 'No',
        ),

        array(
            'id'       => 'agent_direct_messages',
            'type'     => 'switch',
            'title'    => esc_html__( 'Direct Message Button', $theme_text_domain ),
            'subtitle'    => esc_html__( 'Do you want to display direct message button for agent contact forms?', $theme_text_domain ),
            'desc' => esc_html__( 'Please make sure you have create message page using User Dashboard Messages template.', $theme_text_domain ),
            'default'  => 0,
            'on'       => 'Yes',
            'off'      => 'No',
        ),

        array(
            'id'       => 'agent_skype_con',
            'type'     => 'switch',
            'title'    => esc_html__( 'Skype', $theme_text_domain ),
            'desc' => esc_html__( 'Do you want to display the agent Skype?', $theme_text_domain ),
            'default'  => 1,
            'on'       => 'Yes',
            'off'      => 'No',
        ),
        array(
            'id'       => 'agent_con_social',
            'type'     => 'switch',
            'title'    => esc_html__( 'Social Icons', $theme_text_domain ),
            'desc' => esc_html__( 'Do you want to display the agent social icons?', $theme_text_domain ),
            'default'  => 1,
            'on'       => 'Yes',
            'off'      => 'No',
        ),
    ),
));
Redux::setSection( $opt_name, array(
    'title'  => esc_html__( 'Show/Hide Form Fields', $theme_text_domain ),
    'id'     => 'contactforms-showhide',
    'desc'   => '',
    'subsection' => true,
    'fields' => array(
        array(
            'id'       => 'prop_detail_agent_form_fields_section-start',
            'type'     => 'section',
            'title'    => esc_html__('Property Detail Agent Form', $theme_text_domain),
            'subtitle' => '',
            'indent'   => true,
        ),
        array(
            'id'       => 'hide_prop_contact_form_fields',
            'type'     => 'checkbox',
            'title'    => esc_html__( 'Contact form Fields', $theme_text_domain ),
            'desc'     => '',
            'subtitle' => esc_html__('Select which fields you want to disable from the property detail page agent contact form', $theme_text_domain),
            'options'  => array(
                'name' => esc_html__('Name', $theme_text_domain),
                'phone' => esc_html__('Phone', $theme_text_domain),
                'message' => esc_html__('Message', $theme_text_domain),
                'usertype' => esc_html__('User Type', $theme_text_domain),
            ),
            'default' => array(
                'name' => '0',
                'phone' => '0',
                'message' => '0',
                'usertype' => '0',
            )
        ),
        array(
            'id'       => 'prop_detail_agent_form_fields_section-end',
            'type'     => 'section',
            'indent'   => false,
        ),

        array(
            'id'       => 'agency_agent_form_fields_section-start',
            'type'     => 'section',
            'title'    => esc_html__('Agency & Agent Page Contact Form', $theme_text_domain),
            'subtitle' => '',
            'indent'   => true,
        ),
        array(
            'id'       => 'hide_agency_agent_contact_form_fields',
            'type'     => 'checkbox',
            'title'    => esc_html__( 'Contact form Fields', $theme_text_domain ),
            'desc'     => '',
            'subtitle' => esc_html__('Select which fields you want to disable from the agency & agent page contact form', $theme_text_domain),
            'options'  => array(
                'name' => esc_html__('Name', $theme_text_domain),
                'phone' => esc_html__('Phone', $theme_text_domain),
                'message' => esc_html__('Message', $theme_text_domain),
                'usertype' => esc_html__('User Type', $theme_text_domain),
            ),
            'default' => array(
                'name' => '0',
                'phone' => '0',
                'message' => '0',
                'usertype' => '0',
            )
        ),
        array(
            'id'       => 'agency_agent_form_fields_section-end',
            'type'     => 'section',
            'indent'   => false,
        ),

        array(
            'id'       => 'show_gdpr_section-start',
            'type'     => 'section',
            'title'    => esc_html__('Terms & Condition and GDPR checkbox', $theme_text_domain),
            'subtitle' => '',
            'indent'   => true,
        ),

        array(
            'id'       => 'gdpr_and_terms_checkbox',
            'type'     => 'switch',
            'title'    => '',
            'subtitle' => esc_html__( 'GDPR/Terms & Condition checkbox for forms', $theme_text_domain ),
            'default'  => 1,
            'on'       => 'Yes',
            'off'      => 'No',
        ),


        array(
            'id'       => 'show_gdpr_section-end',
            'type'     => 'section',
            'indent'   => false,
        ),
    )
));

Redux::setSection( $opt_name, array(
    'title'  => esc_html__( 'Redirection', $theme_text_domain ),
    'id'     => 'contactforms-redirection',
    'desc'   => '',
    'subsection' => true,
    'fields' => array(
        
        array(
            'id'       => 'agent_form_redirect',
            'type'     => 'select',
            'title'    => esc_html__('Select Page For Redirection', $theme_text_domain),
            'subtitle' => esc_html__('User will be redirected to selected page after agent form submission', $theme_text_domain),
            'data'      => 'pages',
        ),
        
    )
));
?>