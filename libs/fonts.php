<?php
class Theme_Fonts{
	protected $google_fonts;

	function __construct(){
		add_action( 'wp_enqueue_scripts', [ $this, 'action_enqueue_styles' ] );
	}

	public function action_enqueue_styles(){
		$google_fonts_url = $this->get_google_fonts_url();
		if ( ! empty( $google_fonts_url ) ) {
			// wp_enqueue_style( '_themename-fonts', $google_fonts_url, [], null ); // phpcs:ignore WordPress.WP.EnqueuedResourceParameters.MissingVersion
		}
	}

	protected function get_google_fonts_url() : string {
		$google_fonts = $this->get_google_fonts();

		if ( empty( $google_fonts ) ) {
			return '';
		}

		$font_families = [];

		foreach ( $google_fonts as $font_name => $font_variants ) {
			if ( ! empty( $font_variants ) ) {
				if ( ! is_array( $font_variants ) ) {
					$font_variants = explode( ',', str_replace( ' ', '', $font_variants ) );
				}

				$font_families[] = $font_name . ':' . implode( ',', $font_variants );
				continue;
			}

			$font_families[] = $font_name;
		}

		$query_args = [
			'family'  => implode( '|', $font_families ),
			'display' => 'swap',
		];

		return add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}

	protected function get_google_fonts() : array {
		if ( is_array( $this->google_fonts ) ) {
			return $this->google_fonts;
		}

		$google_fonts = [
			'Roboto' => [ '400', '400i', '700', '700i' ],
			'Poppins'     => [ '400', '400i', '600', '600i' ],
			'RocknRoll+One'     => [ '400', '400i', '600', '600i' ],
		];

		/**
		 * Filters default Google Fonts.
		 *
		 * @param array $google_fonts Associative array of $font_name => $font_variants pairs.
		 */
		$this->google_fonts = (array) apply_filters( '_themename_google_fonts', $google_fonts );

		return $this->google_fonts;
	}
}

new Theme_Fonts();
?>