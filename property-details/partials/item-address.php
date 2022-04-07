<?php
$address_composer = _yani_theme()->get_option('listing_address_composer');
$enabled_data = $address_composer['enabled'];
$temp_array = array();

echo '<address class="item-address"><i class="yani-icon icon-pin mr-1"></i>';

if ($enabled_data) {
	unset($enabled_data['placebo']);
	foreach ($enabled_data as $key=>$value) {

		if( $key == 'address' ) {
			$temp_array[] = _yani_property_listing()->get_listing_data('property_map_address');

		} else if( $key == 'streat-address' ) {
			$temp_array[] = _yani_property_listing()->get_listing_data('property_address');

		} else if( $key == 'country' ) {
			$temp_array[] = _yani_property_listing()->taxonomy_simple('property_country');

		} else if( $key == 'state' ) {
			$temp_array[] = _yani_property_listing()->taxonomy_simple('property_state');

		} else if( $key == 'city' ) {
			$temp_array[] = _yani_property_listing()->taxonomy_simple('property_city');

		} else if( $key == 'area' ) {
			$temp_array[] = _yani_property_listing()->taxonomy_simple('property_area');

		}
	}

	$result = join( ", ", $temp_array );
	echo $result;
}

echo '</address>';