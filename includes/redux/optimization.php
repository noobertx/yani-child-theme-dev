<?php
global $opt_name,$theme_text_domain;

/* **********************************************************************
 * Optimizations
 * **********************************************************************/
Redux::setSection( $opt_name, array(
    'title'         => esc_html__( 'Optimizations', $theme_text_domain ),
    'id'         => 'yani_optimazation',
    'icon'       => 'el el-icon-tasks el-icon-small',
    'desc'       => '',
    'fields'     => array(
        array(
            'id'        => 'js_all_in_one',
            'type'      => 'switch',
            'title'     => esc_html__( 'Combine JS Scripts', $theme_text_domain ),
            'subtitle'  => esc_html__( 'Combine all third party js scripts into one file', $theme_text_domain ),
            "default"   => 0,
            'on'        => esc_html__( 'Yes', $theme_text_domain ),
            'off'       => esc_html__( 'No', $theme_text_domain ),
        ),
        array(
            'id'        => 'css_all_in_one',
            'type'      => 'switch',
            'title'     => esc_html__( 'Combine CSS Styles', $theme_text_domain ),
            'subtitle'  => esc_html__( 'Combine all css styles into one file', $theme_text_domain ),
            "default"   => 0,
            'on'        => esc_html__( 'Yes', $theme_text_domain ),
            'off'       => esc_html__( 'No', $theme_text_domain ),
        ),
        array(
            'id'        => 'minify_js',
            'type'      => 'switch',
            'title'     => esc_html__( 'Minify JS', $theme_text_domain ),
            'subtitle'  => esc_html__( 'Use minify version of js files', $theme_text_domain ),
            "default"   => 0,
            'on'        => esc_html__( 'On', $theme_text_domain ),
            'off'       => esc_html__( 'Off', $theme_text_domain ),
        ),

        array(
            'id'        => 'minify_css',
            'type'      => 'switch',
            'title'     => esc_html__( 'Minify CSS', $theme_text_domain ),
            'subtitle'  => esc_html__( 'By default the theme loads a style.css that is not minified. If you wish you can enable this setting to instead load a single style-min.css file with the code minified. If you are using a child theme you will have to change the @import from pointing to style.css to point to style-min.css', $theme_text_domain ),
            "default"   => 0,
            'on'        => esc_html__( 'On', $theme_text_domain ),
            'off'       => esc_html__( 'Off', $theme_text_domain ),
        ),

        array(
            'id'        => 'remove_scripts_version',
            'type'      => 'switch',
            'title'     => __( 'Remove Version Parameter From JS & CSS Files', $theme_text_domain ),
            'subtitle'  => __( 'Most scripts and style-sheets called by WordPress include a query string identifying the version. This can cause issues with caching and such, which will result in less than optimal load times. You can toggle this setting on to remove the query string from such strings.', $theme_text_domain ),
            "default"   => 0,
            'on'        => esc_html__( 'On', $theme_text_domain ),
            'off'       => esc_html__( 'Off', $theme_text_domain ),
        ),

        array(
            'id'        => 'preload_pages',
            'type'      => 'switch',
            'title'     => esc_html__( 'Preload Pages', $theme_text_domain ),
            'subtitle'  => esc_html__( 'Preload pages right before a user clicks on it for blazing fast browsing between pages.', $theme_text_domain ),
            'desc'  => esc_html__( 'NOTE: if you are using login/register for front-end site then better to not enable this option.', $theme_text_domain ),
            "default"   => 0,
            'on'        => esc_html__( 'Yes', $theme_text_domain ),
            'off'       => esc_html__( 'No', $theme_text_domain ),
        ),
        array(
            'id'        => 'lazyload_images',
            'type'      => 'switch',
            'title'     => esc_html__( 'Lazy Load Images', $theme_text_domain ),
            'subtitle'  => esc_html__( 'Enable lazy loading for images, it will boost page loading speed', $theme_text_domain ),
            "default"   => 0,
            'on'        => esc_html__( 'Yes', $theme_text_domain ),
            'off'       => esc_html__( 'No', $theme_text_domain ),
        ),
        array(
            'id'        => 'disable_emoji',
            'type'      => 'switch',
            'title'     => esc_html__( 'Disable Emoji Script', $theme_text_domain ),
            'subtitle'  => esc_html__( 'Remove WP emoji scripts from front-end.', $theme_text_domain ),
            "default"   => 0,
            'on'        => esc_html__( 'Yes', $theme_text_domain ),
            'off'       => esc_html__( 'No', $theme_text_domain ),
        ),
        /*array(
            'id'        => 'disable_jquery_migrate',
            'type'      => 'switch',
            'title'     => esc_html__( 'Disable Jquery Migrate', $theme_text_domain ),
            'subtitle'  => esc_html__( 'Remove jQuery Migrate. Most up-to-date front-end code and plugins don’t require jquery-migrate.min.js. More often than not, keeping this - simply adds unnecessary load to your site.', $theme_text_domain ),
            "default"   => 0,
            'on'        => esc_html__( 'Yes', $theme_text_domain ),
            'off'       => esc_html__( 'No', $theme_text_domain ),
        ),*/

        /*array(
            'id'        => 'defer_async_enabled',
            'type'      => 'switch',
            'title'     => esc_html__( 'Allow `async` and `defer` while enqueuing Javascript.', $theme_text_domain ),
            'subtitle'  => esc_html__( 'Adds async/defer attributes to enqueued / registered scripts.', $theme_text_domain ),
            "default"   => 0,
            'on'        => esc_html__( 'Yes', $theme_text_domain ),
            'off'       => esc_html__( 'No', $theme_text_domain ),
        ),*/

        array(
            'id'        => 'jpeg_100',
            'type'      => 'switch',
            'title'     => esc_html__( 'JPEG 100% Quality', $theme_text_domain ),
            'subtitle'  => esc_html__( 'By default images cropped with WordPress are resized/cropped at 90% quality. Enable this setting to set all JPEGs to 100% quality.', $theme_text_domain ),
            "default"   => 0,
            'on'        => esc_html__( 'On', $theme_text_domain ),
            'off'       => esc_html__( 'Off', $theme_text_domain ),
        )
    )
) );