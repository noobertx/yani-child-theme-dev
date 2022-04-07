<?php
global $opt_name,$theme_text_domain;

Redux::setSection( $opt_name, array(
    'title'  => esc_html__( 'Taxonomies Layout', $theme_text_domain ),
    'id'     => 'taxonomies-pages',
    'desc'   => esc_html__( 'Select taxonomies (type, status, country, city, state, features, areas, labels) pages layout', $theme_text_domain ),
    'icon'   => 'el-icon-th-list el-icon-small',
    'subsection' => false,
    'fields' => array(
        array(
            'id'       => 'taxonomy_layout',
            'type'     => 'image_select',
            'title'    => __('Page Layout', $theme_text_domain),
            'subtitle' => '',
            'options'  => array(
                'no-sidebar' => array(
                    'alt'   => '',
                    'img'   => YANI_THEME_IMAGES. '1c.png'
                ),
                'left-sidebar' => array(
                    'alt'   => '',
                    'img'   => YANI_THEME_IMAGES. '2cl.png'
                ),
                'right-sidebar' => array(
                    'alt'   => '',
                    'img'  => YANI_THEME_IMAGES. '2cr.png'
                )
            ),
            'default' => 'right-sidebar'
        ),
        array(
            'id'       => 'taxonomy_content_position',
            'type'     => 'select',
            'title'    => __('Content Position', $theme_text_domain),
            'desc' => __('Select content position for taxonomies pages. Content can be added in desciption field for each taxonomy', $theme_text_domain),
            'options'  => array(
                'above' => esc_html__('Above listings', $theme_text_domain),
                'bottom' => esc_html__('Below listings', $theme_text_domain),
            ),
            'default' => 'above'
        ),
        /*array(
            'id'       => 'tax_show_map',
            'type'     => 'switch',
            'title'    => esc_html__( 'Show Map', $theme_text_domain ),
            'desc' => esc_html__( 'Show the map on top of taxonomy pages', $theme_text_domain ),
            'default'  => 0,
            'on'       => esc_html__( 'Yes', $theme_text_domain ),
            'off'      => esc_html__( 'No', $theme_text_domain ),
        ),*/

        array(
            'id'       => 'taxonomy_posts_layout',
            'type'     => 'select',
            'title'    => __('Listings Layout', $theme_text_domain),
            'desc' => __('Select the listings layout for the taxonomy page.', $theme_text_domain),
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
            'id'       => 'taxonomy_default_order',
            'type'     => 'select',
            'title'    => __('Default Order', $theme_text_domain),
            'desc' => esc_html__('Select the taxonomy page listings order.', $theme_text_domain),
            'options'  => array(
                'd_date' => esc_html__( 'Date New to Old', $theme_text_domain ),
                'a_date' => esc_html__( 'Date Old to New', $theme_text_domain ),
                'd_price' => esc_html__( 'Price (High to Low)', $theme_text_domain ),
                'a_price' => esc_html__( 'Price (Low to High)', $theme_text_domain ),
                'featured_first' => esc_html__( 'Show Featured Listings on Top', $theme_text_domain ),
            ),
            'default' => 'd_date'
        ),

        array(
            'id'       => 'taxonomy_num_posts',
            'type'     => 'text',
            'title'    => esc_html__('Number of Listings to Show', $theme_text_domain),
            'subtitle' => '',
            'desc' => esc_html__('Enter the number of listings to display.', $theme_text_domain),
            'default'  => '9',
            'validate' => 'numeric',
        ),
    )
));