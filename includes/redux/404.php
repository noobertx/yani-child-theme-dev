<?php
global $opt_name,$theme_text_domain;

Redux::setSection( $opt_name, array(
    'title'  => esc_html__( 'Page 404', $theme_text_domain ),
    'id'     => 'page-404',
    'desc'   => '',
    'icon'   => 'el-icon-error el-icon-small',
    'fields'        => array(

        array(
            'id'       => '404-title',
            'type'     => 'text',
            'title'    => esc_html__( 'Title', $theme_text_domain ),
            'desc'     => esc_html__( 'Enter the page title', $theme_text_domain ),
            'default'  => 'Oh oh! Page not found.'
        ),
        array(
            'id'        => '404-des',
            'type'      => 'textarea',
            'title'     => esc_html__( 'Description', $theme_text_domain ),
            'desc'     => esc_html__( 'Enter the page content', $theme_text_domain ),
            'default'   => "We're sorry, but the page you are looking for doesn't exist. You can search your topic using the box below or return to the homepage."
        )
    ),
));