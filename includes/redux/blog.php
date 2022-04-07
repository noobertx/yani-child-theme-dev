<?php
global $opt_name,$theme_text_domain, $allowed_html_array;
Redux::setSection( $opt_name, array(
    'title'  => esc_html__( 'Blog', $theme_text_domain ),
    'id'     => 'blog',
    'desc'   => '',
    'icon'   => 'el-icon-edit el-icon-small',
    'fields'        => array(
        array(
            'id'       => 'masorny_num_posts',
            'type'     => 'text',
            'title'    => esc_html__( 'Masonry Blog Template', $theme_text_domain ),
            'subtitle' => esc_html__( 'Number of posts to display on the Masonry blog pages', $theme_text_domain ),
            'desc'     => esc_html__( 'Enter the number of posts', $theme_text_domain ),
            'default'  => '12'
        ),
        array(
            'id'       => 'blog_featured_image',
            'type'     => 'switch',
            'title'    => esc_html__( 'Featured Image', $theme_text_domain ),
            'desc'     => esc_html__( 'Enable or disable the featured image', $theme_text_domain ),
            'subtitle' => esc_html__( 'Displayed on the single post page', $theme_text_domain ),
            'default'  => 1,
            'on'       => 'Enabled',
            'off'      => 'Disabled',
        ),

        array(
            'id'       => 'blog_date',
            'type'     => 'switch',
            'title'    => esc_html__( 'Post Date', $theme_text_domain ),
            'desc'     => esc_html__( 'Enable or disable the post date', $theme_text_domain ),
            'subtitle' => esc_html__( 'Displayed on the blog, archive and single post page', $theme_text_domain ),
            'default'  => 1,
            'on'       => 'Enabled',
            'off'      => 'Disabled',
        ),

        array(
            'id'       => 'blog_author',
            'type'     => 'switch',
            'title'    => esc_html__( 'Posts Author', $theme_text_domain ),
            'desc'     => esc_html__( 'Enable or disable the post author', $theme_text_domain ),
            'subtitle' => esc_html__( 'Displayed on the blog, archive and single post page', $theme_text_domain ),
            'default'  => 1,
            'on'       => 'Enabled',
            'off'      => 'Disabled',
        ),

        array(
            'id'       => 'blog_tags',
            'type'     => 'switch',
            'title'    => esc_html__( 'Tags', $theme_text_domain ),
            'default'  => 1,
            'on'       => 'Enabled',
            'off'      => 'Disabled',
        ),

        array(
            'id'       => 'blog_author_box',
            'type'     => 'switch',
            'title'    => esc_html__( 'Author Box', $theme_text_domain ),
            'desc'     => esc_html__( 'Enable or disable the author box', $theme_text_domain ),
            'subtitle' => esc_html__( 'Displayed on the single post page', $theme_text_domain ),
            'default'  => 1,
            'on'       => 'Enabled',
            'off'      => 'Disabled',
        ),
        array(
            'id'       => 'blog_next_prev',
            'type'     => 'switch',
            'title'    => esc_html__( 'Next/Prev Post', $theme_text_domain ),
            'default'  => 1,
            'on'       => 'Enabled',
            'off'      => 'Disabled',
        ),
        array(
            'id'       => 'blog_related_posts',
            'type'     => 'switch',
            'title'    => esc_html__( 'Related Posts', $theme_text_domain ),
            'default'  => 1,
            'on'       => 'Enabled',
            'off'      => 'Disabled',
        ),

    ),
));