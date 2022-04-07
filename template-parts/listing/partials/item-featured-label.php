<?php
global $prop_featured;
$prop_featured = _yani_property_listing()->get_listing_data('featured');

if( $prop_featured == 1 ) {
	echo '<span class="label-featured label">'._yani_theme()->get_option('cl_featured_label', esc_html__( 'Featured', 'houzez' )).'</span>';
}