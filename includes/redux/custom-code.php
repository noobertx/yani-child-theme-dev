<?php
global $opt_name,$theme_text_domain;
Redux::setSection( $opt_name, array(
    'title'      => esc_html__( 'Custom Code',$theme_text_domain ),
    'id'         => 'custom_code',
    'icon'       => 'el el-cog el-icon-small',
    'desc'       => '',
    'fields'     => array(
        array(
            'id'       => 'custom_css',
            'type'     => 'ace_editor',
            'title'    => esc_html__( 'CSS Code',$theme_text_domain ),
            'subtitle' => esc_html__( 'Paste your CSS code here.',$theme_text_domain ),
            'mode'     => 'css',
            'theme'    => 'monokai',
            'desc'     => '',
            'default'  => ""
        ),
        array(
            'id'       => 'custom_js_header',
            'type'     => 'ace_editor',
            'title'    => esc_html__( 'Custom JS Code',$theme_text_domain ),
            'subtitle' => esc_html__( 'Custom JavaScript/Analytics Header.',$theme_text_domain ),
            'mode'     => 'text',
            'theme'    => 'chrome',
            'desc'     => '',
            'default'  => ""
        ),
        array(
            'id'       => 'custom_js_footer',
            'type'     => 'ace_editor',
            'title'    => esc_html__( 'Custom JS Code',$theme_text_domain ),
            'subtitle' => esc_html__( 'Custom JavaScript/Analytics Footer.',$theme_text_domain ),
            'mode'     => 'text',
            'theme'    => 'chrome',
            'desc'     => '',
            'default'  => ""
        )
    )
) );