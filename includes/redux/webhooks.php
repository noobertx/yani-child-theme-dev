<?php
global $opt_nam,$theme_text_domain;

Redux::setSection( $opt_name, array(
    'title'  => esc_html__( 'Webhooks', $theme_text_domain ),
    'id'     => 'houzez-webhooks',
    'desc'   => '',
    'icon'          => 'el-icon-envelope el-icon-small',
    'fields'        => array(
    
        array(
            'id'       => 'yani_webhook_url',
            'type'     => 'text',
            'title'    => esc_html__( 'Webhook URL', $theme_text_domain ),
            'subtitle'     => esc_html__( "Enter the integration URL (like Zapier) that will receive the form's submitted data.", $theme_text_domain ),
            'placeholder' => esc_html__( 'https://your-webhook-url.com' , $theme_text_domain ),
            'default'  => ''
        ),
        array(
            'id'       => 'webhook_property_agent_contact',
            'type'     => 'switch',
            'title'    => esc_html__( 'Property Agent Form', $theme_text_domain ),
            'subtitle' => esc_html__( 'Enable webhook for single property agent contact form.', $theme_text_domain ),
            'default'  => 0,
            'on'       => esc_html__( 'Yes', $theme_text_domain ),
            'off'      => esc_html__( 'No', $theme_text_domain ),
        ),
        array(
            'id'       => 'webhook_agent_contact',
            'type'     => 'switch',
            'title'    => esc_html__( 'Agent Profile Page Form', $theme_text_domain ),
            'subtitle' => esc_html__( 'Enable webhook for agent profile page form.', $theme_text_domain ),
            'default'  => 0,
            'on'       => esc_html__( 'Yes', $theme_text_domain ),
            'off'      => esc_html__( 'No', $theme_text_domain ),
        ),
        array(
            'id'       => 'webhook_agency_contact',
            'type'     => 'switch',
            'title'    => esc_html__( 'Agency Profile Page Form', $theme_text_domain ),
            'subtitle' => esc_html__( 'Enable webhook for agency profile page form.', $theme_text_domain ),
            'default'  => 0,
            'on'       => esc_html__( 'Yes', $theme_text_domain ),
            'off'      => esc_html__( 'No', $theme_text_domain ),
        ),
        array(
            'id'       => 'add_new_property',
            'type'     => 'switch',
            'title'    => esc_html__( 'Add New Property Form', $theme_text_domain ),
            'subtitle' => esc_html__( 'Enable webhook for add new property Form.', $theme_text_domain ),
            'default'  => 0,
            'on'       => esc_html__( 'Yes', $theme_text_domain ),
            'off'      => esc_html__( 'No', $theme_text_domain ),
        )
    
    ),
));