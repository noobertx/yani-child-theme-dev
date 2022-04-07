<?php
require_once("utils/lazy-load.php");
	function _themename_theme_support(){

		$text_domain = "_themename";
		load_theme_textdomain($text_domain,get_stylesheet_directory().'/languages/');
		load_theme_textdomain($text_domain,get_template_directory().'/languages/');
		add_theme_support('post-thumbnails');
	
		add_theme_support('title-tag');
		add_theme_support('post-thumbnails');
		add_theme_support('html5',array(
			'search-form',
			'comment-list',
			'comment-form',
			'gallery',
			'caption',
		));
		add_theme_support('customize-selective-refresh-widgets');
		add_theme_support('custom-logo',array(
			'height' => 200,
			'width' => 600,
			'flex-height' => true,
			'flex-width' => true,
		));
		add_theme_support('post-formats',array(
			'aside',
			'image',
			'video',
			'quote',
			'link',
			'gallery',
			'audio',
		));
		add_theme_support( 'editor-styles' );
		add_theme_support('align-wide');
		add_theme_support( 'align-wide' );

		add_theme_support(
			'editor-color-palette',
			[
				[
					'name'  => __( 'Primary', 'wp-rig' ),
					'slug'  => 'theme-primary',
					'color' => "#4a4e69",
				],
				[
					'name'  => __( 'Secondary', 'wp-rig' ),
					'slug'  => 'theme-secondary',
					'color' => "#c9ada7",
				],
                [
					'name'  => __( 'Accent', 'wp-rig' ),
					'slug'  => 'theme-accent',
					'color' => '#9a8c98',
				],
                [
					'name'  => __( 'Dark', 'wp-rig' ),
					'slug'  => 'theme-dark',
					'color' => '#22223b',
				],
                [
					'name'  => __( 'Light', 'wp-rig' ),
					'slug'  => 'theme-light',
					'color' => '#f2e9e4',
				],
				[
					'name'  => __( 'Default', 'wp-rig' ),
					'slug'  => 'theme-default',
					'color' => '#999',
				],
				[
					'name'  => __( 'Info', 'wp-rig' ),
					'slug'  => 'theme-info',
					'color' => '#00bcd4',
				],
				[
					'name'  => __( 'Success', 'wp-rig' ),
					'slug'  => 'theme-success',
					'color' => '#4caf50',
				],
				[
					'name'  => __( 'Warning', 'wp-rig' ),
					'slug'  => 'theme-warning',
					'color' => '#ff9800',
				],
				[
					'name'  => __( 'Danger', 'wp-rig' ),
					'slug'  => 'theme-danger',
					'color' => '#f44336',
				],				
			]
		);
		/* 025 Start here */
		add_theme_support( 'woocommerce',array(
			'thumbnail_image_width' => 255,
			'single_image_width' => 255,
			'product_grid' => array(
				'default_rows' => 10,
				'min_rows' => 5,
				'max_rows' => 10,
				'default_columns' => 3,
				'min_columns' => 3,
				'max_columns' => 5,
			),
		) );

		add_theme_support( 'wc-product-gallery-zoom' );
    	add_theme_support( 'wc-product-gallery-lightbox' );
	    add_theme_support( 'wc-product-gallery-slider' );

	    if(!isset($content_width)){
	    	$content_width = 600;
	    }

	    add_theme_support('customize-selective-refresh-widgets');

		add_theme_support( 'wp-block-styles' );

	}

	add_action( 'after_setup_theme', '_themename_theme_support');
	
	/*28*/
	add_filter( 'woocommerce_enqueue_styles', '__return_false' );
?>