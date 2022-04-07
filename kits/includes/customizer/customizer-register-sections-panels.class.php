<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class to register panels and sections for customize options.
 */
class Noonie_Customize_Register_Section_Panels extends Noonie_Customize_Base_Option {
	public function register_options( $options, $wp_customize ) {

		$configs = array(

			/**
			 * Register panels.
			 */
			// Global Options.
			array(
				'name'     => 'noonie_global_panel',
				'type'     => 'panel',
				'title'    => esc_html__( 'Global', 'colormag' ),
				'priority' => 10,
			),

			// Front Page Options.
			array(
				'name'     => 'noonie_front_page_panel',
				'type'     => 'panel',
				'title'    => esc_html__( 'Front Page', 'colormag' ),
				'priority' => 20,
			),

			// Front Page General Options.
			array(
				'name'     => 'noonie_front_page_general_section',
				'type'     => 'section',
				'title'    => esc_html__( 'General', 'colormag' ),
				'panel'    => 'noonie_front_page_panel',
				'priority' => 10,
			),

			// Header Options.
			array(
				'name'     => 'noonie_header_panel',
				'type'     => 'panel',
				'title'    => esc_html__( 'Header', 'colormag' ),
				'priority' => 30,
			),

			// Content Options.
			array(
				'name'     => 'noonie_content_panel',
				'type'     => 'panel',
				'title'    => esc_html__( 'Content', 'colormag' ),
				'priority' => 40,
			),

			// Footer Options.
			array(
				'name'     => 'noonie_footer_panel',
				'type'     => 'panel',
				'title'    => esc_html__( 'Footer', 'colormag' ),
				'priority' => 50,
			),

			// Additional Options.
			array(
				'name'     => 'noonie_additional_panel',
				'type'     => 'panel',
				'title'    => esc_html__( 'Additional', 'colormag' ),
				'priority' => 60,
			),

			/**
			 * Register sections.
			 */
			// Color.
			array(
				'name'     => 'noonie_global_colors_section',
				'type'     => 'section',
				'title'    => esc_html__( 'Colors', 'colormag' ),
				'panel'    => 'noonie_global_panel',
				'priority' => 10,
			),

			array(
				'name'     => 'noonie_primary_colors_section',
				'type'     => 'section',
				'title'    => esc_html__( 'Primary Colors', 'colormag' ),
				'panel'    => 'noonie_global_panel',
				'section'  => 'noonie_global_colors_section',
				'priority' => 10,
			),

			array(
				'name'     => 'noonie_skin_color_section',
				'type'     => 'section',
				'title'    => esc_html__( 'Skin Color', 'colormag' ),
				'panel'    => 'noonie_global_panel',
				'section'  => 'noonie_global_colors_section',
				'priority' => 40,
			),

			array(
				'name'     => 'noonie_category_colors_section',
				'type'     => 'section',
				'title'    => esc_html__( 'Category Colors', 'colormag' ),
				'panel'    => 'noonie_global_panel',
				'section'  => 'noonie_global_colors_section',
				'priority' => 40,
			),

			// Background.
			array(
				'name'     => 'noonie_global_background_section',
				'type'     => 'section',
				'title'    => esc_html__( 'Background', 'colormag' ),
				'panel'    => 'noonie_global_panel',
				'priority' => 20,
			),

			// Layout.
			array(
				'name'     => 'noonie_global_layout_section',
				'type'     => 'section',
				'title'    => esc_html__( 'Layout', 'colormag' ),
				'panel'    => 'noonie_global_panel',
				'priority' => 30,
			),

			array(
				'name'     => 'noonie_site_layout_section',
				'type'     => 'section',
				'title'    => esc_html__( 'Site Layout', 'colormag' ),
				'panel'    => 'noonie_global_panel',
				'section'  => 'noonie_global_layout_section',
				'priority' => 10,
			),

			array(
				'name'     => 'noonie_sidebar_layout_section',
				'type'     => 'section',
				'title'    => esc_html__( 'Sidebar Layout', 'colormag' ),
				'panel'    => 'noonie_global_panel',
				'section'  => 'noonie_global_layout_section',
				'priority' => 20,
			),

			/**
			 * Header.
			 */



			array(
				'name'     => 'title_tagline',
				'type'     => 'section',
				'title'    => esc_html__( 'Site Identity', 'colormag' ),
				'panel'    => 'noonie_global_panel',
				'priority' => 5,
			),

			array(
				'name'     => 'noonie_top_bar_section',
				'type'     => 'section',
				'title'    => esc_html__( 'Top Bar', 'colormag' ),
				'panel'    => 'noonie_header_panel',
				'priority' => 20,
			),

			array(
				'name'     => 'noonie_primary_header_section',
				'type'     => 'section',
				'title'    => esc_html__( 'Primary Header', 'colormag' ),
				'panel'    => 'noonie_header_panel',
				'priority' => 30,
			),

			array(
				'name'     => 'noonie_primary_menu_section',
				'type'     => 'section',
				'title'    => esc_html__( 'Primary Menu', 'colormag' ),
				'panel'    => 'noonie_header_panel',
				'priority' => 40,
			),

			array(
				'name'     => 'noonie_sticky_header_section',
				'type'     => 'section',
				'title'    => esc_html__( 'Sticky Header', 'colormag' ),
				'panel'    => 'noonie_header_panel',
				'priority' => 50,
			),

			/**
			 * Content.
			 */
			array(
				'name'     => 'noonie_single_post_section',
				'type'     => 'section',
				'title'    => esc_html__( 'Single Post', 'colormag' ),
				'panel'    => 'noonie_content_panel',
				'priority' => 20,
			),

			array(
				'name'     => 'noonie_page_section',
				'type'     => 'section',
				'title'    => esc_html__( 'Page', 'colormag' ),
				'panel'    => 'noonie_content_panel',
				'priority' => 40,
			),

			/**
			 * Footer.
			 */
			array(
				'name'     => 'noonie_footer_general_section',
				'type'     => 'section',
				'title'    => esc_html__( 'General', 'colormag' ),
				'panel'    => 'noonie_footer_panel',
				'priority' => 10,
			),

			/**
			 * Additional.
			 */
			array(
				'name'     => 'noonie_social_icons_section',
				'type'     => 'section',
				'title'    => esc_html__( 'Social Icons', 'colormag' ),
				'panel'    => 'noonie_additional_panel',
				'priority' => 20,
			),

		);

		$options = array_merge( $options, $configs );

		return $options;

	}
}
return new Noonie_Customize_Register_Section_Panels();