<?php
global $opt_name,$theme_text_domain;
$allowed_html_array = array(
    'a' => array(
        'href' => array(),
        'title' => array()
    )
);

Redux::setSection( $opt_name, array(
    'title'  => esc_html__( 'Property Agent', $theme_text_domain ),
    'id'     => 'email-property-agent',
    'desc'   => '',
    'icon'   => '',
    'subsection' => true,
    'fields'    => array(
        array(
            'id'     => 'email-property_agent_contact',
            'type'   => 'info',
            'notice' => false,
            'style'  => 'info',
            'title'  => wp_kses(__( '<span class="font24">Property Agent Contact Form</span>', $theme_text_domain ), $allowed_html_array),
            'subtitle' => esc_html__('Use %sender_name , %sender_email , %sender_phone , %website_name , %property_title , %property_link , %property_id , %user_type ,  %sender_message', $theme_text_domain),
            'desc'   => ''
        ),
        array(
            'id'       => 'yani_subject_property_agent_contact',
            'type'     => 'text',
            'title'    => esc_html__('Subject', $theme_text_domain),
            'subtitle' => esc_html__('Email subject for Propety Agent Contact', $theme_text_domain),
            'desc'     => '',
            'default'  => 'New message sent by %sender_name using agent contact form at %website_name',
        ),
        array(
            'id'       => 'yani_property_agent_contact',
            'type'     => 'editor',
            'title'    => esc_html__('Content', $theme_text_domain),
            'subtitle' => esc_html__('Email content for Propety Agent Contact, HTML tags are allowed.', $theme_text_domain),
            'desc'     => '',
            'default'  => '
            You have received new message from: %sender_name
            Property Title : %property_title
            Property URL : %property_link
            Property ID  : %property_id
            Phone Number : %sender_phone
            User Type    : %user_type
            Additional message is
            %sender_message
            You can contact %sender_name via email %sender_email</div>
            ',
            'args' => array(
                'teeny' => false,
                'textarea_rows' => 10
            )
        ),
    )
));
?>