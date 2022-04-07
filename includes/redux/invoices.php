<?php
global $opt_name,$theme_text_domain;
Redux::setSection( $opt_name, array(
    'title'  => esc_html__( 'Invoice Options', $theme_text_domain ),
    'id'     => 'property-invoice',
    'desc'   => '',
    'icon'   => 'el-icon-file el-icon-small',
    'fields'		=> array(
        array(
            'id'		=> 'invoice_logo',
            'url'		=> true,
            'type'		=> 'media',
            'title'		=> esc_html__( 'Company Logo', $theme_text_domain ),
            'read-only'	=> false,
            'default'	=> array( 'url'	=> YANI_THEME_IMAGES .'/logo-houzez-white.png' ),
            'desc'	=> esc_html__( 'Logo to use in the invoices tenplate', $theme_text_domain ),
            'desc'  => esc_html__( 'Upload the logo', $theme_text_domain ),
        ),
        array(
            'id'		=> 'invoice_company_name',
            'type'		=> 'text',
            'title'		=> esc_html__( 'Company Name', $theme_text_domain ),
            'default'	=> 'Company Name',
            'desc'	=> esc_html__( 'Enter the company name', $theme_text_domain ),
        ),
        array(
            'id'		=> 'invoice_address',
            'type'		=> 'textarea',
            'title'		=> esc_html__( 'Address', $theme_text_domain ),
            'default'	=> '1161 Washingtown Avenue 299<br> Miami Beach 33141 FL',
            'desc'	=> esc_html__( 'Enter the company address', $theme_text_domain ),
        ),
        array(
            'id'		=> 'invoice_phone',
            'type'		=> 'text',
            'title'		=> esc_html__( 'Phone', $theme_text_domain ),
            'default'	=> '(987)654 3210',
            'desc'  => esc_html__( 'Enter the company phone number', $theme_text_domain ),
        ),
        array(
            'id'		=> 'invoice_additional_info',
            'type'		=> 'editor',
            'title'		=> esc_html__( 'Additional Information', $theme_text_domain ),
            'default'	=> '<p>The lorem ipsum text is typically a scrambled section of De finibus bonorum et malorum, a 1st-century BC Latin text by Cicero, with words altered, added, and removed to make it nonsensical, improper Latin.[citation needed]</p>',
            'subtitle'	=> '',
            'desc'  => esc_html__( 'Enter additional infomartion if needed', $theme_text_domain ),
        ),
        array(
            'id'		=> 'invoice_thankyou',
            'type'		=> 'text',
            'title'		=> esc_html__( 'Thank You Message', $theme_text_domain ),
            'default'	=> 'Thank you for your business with us.',
            'subtitle'	=> '',
            'desc'  => esc_html__( 'Enter the thank you message', $theme_text_domain ),
        ),
    ),
));