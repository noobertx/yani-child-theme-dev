<?php
class _themename_LazyLoad {
	function __construct(){
		add_action( 'wp', [ $this, 'action_lazyload_images' ] );
		add_action( 'customize_register', [ $this, 'action_customize_register_lazyload' ] );
	}

	public function action_lazyload_images() {

		// If this is the admin page, return early.
		if ( is_admin() ) {
			return;
		}

		// If lazy-load is disabled in Customizer, return early.
		if ( 'no-lazyload' === get_theme_mod( 'lazy_load_media' ) ) {
			return;
		}

		// If the Jetpack Lazy-Images module is active, return early.
		if ( ! apply_filters( 'lazyload_is_enabled', true ) ) {
			return;
		}

		// If the AMP plugin is active, return early.
		// if ( wp_rig()->is_amp() ) {
		// 	return;
		// }

		add_action( 'wp_head', [ $this, 'action_add_lazyload_filters' ], PHP_INT_MAX );
		add_action( 'wp_enqueue_scripts', [ $this, 'action_enqueue_lazyload_assets' ] );

		// Do not lazy load avatar in admin bar.
		// add_action( 'admin_bar_menu', [ $this, 'action_remove_lazyload_filters' ], 0 );
		add_filter( 'wp_kses_allowed_html', [ $this, 'filter_allow_lazyload_attributes' ] );
	}

	public function action_customize_register_lazyload( WP_Customize_Manager $wp_customize ) {
		$lazyload_choices = [
			'lazyload'    => __( 'Lazy-load on (default)', 'wp-rig' ),
			'no-lazyload' => __( 'Lazy-load off', 'wp-rig' ),
		];

		$wp_customize->add_setting(
			'lazy_load_media',
			[
				'default'           => 'lazyload',
				'transport'         => 'postMessage',
				'sanitize_callback' => function( $input ) use ( $lazyload_choices ) : string {
					if ( array_key_exists( $input, $lazyload_choices ) ) {
						return $input;
					}

					return '';
				},
			]
		);

		$wp_customize->add_control(
			'lazy_load_media',
			[
				'label'           => __( 'Lazy-load images', 'wp-rig' ),
				'section'         => 'theme_options',
				'type'            => 'radio',
				'description'     => __( 'Lazy-loading images means images are loaded only when they are in view. Improves performance, but can result in content jumping around on slower connections.', 'wp-rig' ),
				'choices'         => $lazyload_choices,
			]
		);
	}

	public function action_add_lazyload_filters() {
		add_filter( 'the_content', [ $this, 'filter_add_lazyload_placeholders' ], PHP_INT_MAX );
		add_filter( 'post_thumbnail_html', [ $this, 'filter_add_lazyload_placeholders' ], PHP_INT_MAX );
		add_filter( 'get_avatar', [ $this, 'filter_add_lazyload_placeholders' ], PHP_INT_MAX );
		add_filter( 'widget_text', [ $this, 'filter_add_lazyload_placeholders' ], PHP_INT_MAX );
		add_filter( 'get_image_tag', [ $this, 'filter_add_lazyload_placeholders' ], PHP_INT_MAX );
		add_filter( 'wp_get_attachment_image_attributes', [ $this, 'filter_lazyload_attributes' ], PHP_INT_MAX );
	}

	public function action_enqueue_lazyload_assets() {
		wp_enqueue_script(
			'_themename-lazy-load-images',
			get_theme_file_uri( '/assets/js/lazyload.min.js' ),
			[],
			microtime(),
			false
		);
		wp_script_add_data( '_themename-lazy-load-images', 'defer', true );
		wp_script_add_data( '_themename-lazy-load-images', 'precache', true );
	}
	public function filter_add_lazyload_placeholders( string $content ) : string {
		// Don't lazyload for feeds, previews.
		if ( is_feed() || is_preview() ) {
			return $content;
		}

		// Don't lazy-load if the content has already been run through previously.
		if ( false !== strpos( $content, 'data-src' ) ) {
			return $content;
		}

		// Find all <img> elements via regex, add lazy-load attributes.
		$content = preg_replace_callback(
			'#<(img)([^>]+?)(>(.*?)</\\1>|[\/]?>)#si',
			function( array $matches ) : string {
				$old_attributes_str       = $matches[2];
				$old_attributes_kses_hair = wp_kses_hair( $old_attributes_str, wp_allowed_protocols() );

				if ( empty( $old_attributes_kses_hair['src'] ) ) {
					return $matches[0];
				}

				$old_attributes = $this->flatten_kses_hair_data( $old_attributes_kses_hair );
				$new_attributes = $this->filter_lazyload_attributes( $old_attributes );

				// If we didn't add lazy attributes, just return the original image source.
				if ( empty( $new_attributes['data-src'] ) ) {
					return $matches[0];
				}

				$new_attributes_str = $this->build_attributes_string( $new_attributes );

				return sprintf( '<img %1$s><noscript>%2$s</noscript>', $new_attributes_str, $matches[0] );
			},
			$content
		);

		return $content;
	}
	public function filter_lazyload_attributes( array $attributes ) : array {
		if ( empty( $attributes['src'] ) ) {
			return $attributes;
		}

		if ( ! empty( $attributes['class'] ) && $this->should_skip_image_with_blacklisted_class( $attributes['class'] ) ) {
			return $attributes;
		}

		$old_attributes = $attributes;

		// Add the lazy class to the img element.
		$attributes['class'] = $this->lazyload_class( $attributes );

		// Set placeholder and lazy-src.
		$attributes['src'] = $this->lazyload_get_placeholder_image();

		// Set data-src to the original source uri.
		$attributes['data-src'] = $old_attributes['src'];

		// Process `srcset` attribute.
		if ( ! empty( $attributes['srcset'] ) ) {
			$attributes['data-srcset'] = $old_attributes['srcset'];
			unset( $attributes['srcset'] );
		}

		// Process `sizes` attribute.
		if ( ! empty( $attributes['sizes'] ) ) {
			$attributes['data-sizes'] = $old_attributes['sizes'];
			unset( $attributes['sizes'] );
		}

		return $attributes;
	}
	protected function should_skip_image_with_blacklisted_class( string $classes ) : bool {
		$blacklisted_classes = [
			'skip-lazy',
			'custom-logo',
		];

		foreach ( $blacklisted_classes as $class ) {
			if ( false !== strpos( $classes, $class ) ) {
				return true;
			}
		}
		return false;
	}
	protected function lazyload_class( array $attributes ) : string {
		if ( array_key_exists( 'class', $attributes ) ) {
			$classes  = $attributes['class'];
			$classes .= ' lazy';
		} else {
			$classes = 'lazy';
		}

		return $classes;
	}
	protected function lazyload_get_placeholder_image() : string {
		return get_theme_file_uri( '/assets/images/placeholder.svg' );
	}
	protected function flatten_kses_hair_data( array $attributes ) : array {
		$flattened_attributes = [];
		foreach ( $attributes as $name => $attribute ) {
			$flattened_attributes[ $name ] = $attribute['value'];
		}
		return $flattened_attributes;
	}
	protected function build_attributes_string( array $attributes ) : string {
		$string = [];
		foreach ( $attributes as $name => $value ) {
			if ( '' === $value ) {
				$string[] = sprintf( '%s', $name );
			} else {
				$string[] = sprintf( '%s="%s"', $name, esc_attr( $value ) );
			}
		}

		return implode( ' ', $string );
	}

}

// new _themename_LazyLoad(); // Temportary disabled because of plugin conflict
?>