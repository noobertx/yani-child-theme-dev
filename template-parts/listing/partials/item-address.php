<?php
$address_composer = _yani_theme()->get_option('listing_address_composer');
$enabled_data = isset($address_composer['enabled']) ? $address_composer['enabled'] : 0;
$temp_array = array();

echo '<address class="item-address">';

if ($enabled_data) {
	unset($enabled_data['placebo']);
	foreach ($enabled_data as $key=>$value) {

		if( $key == 'address' ) {
			$temp_array[] = _yani_property_listing()->get_listing_data('property_map_address');
		}

		if( $key == 'streat-address' ) {
			$temp_array[] = _yani_property_listing()->get_listing_data('property_address');
		}

		if( $key == 'country' ) {
			$temp_array[] = _yani_taxonomy()->get_taxonomy_simple('property_country');
		}

		if( $key == 'state' ) {
			$temp_array[] = _yani_taxonomy()->get_taxonomy_simple('property_state');
		}

		if( $key == 'city' ) {
			$temp_array[] = _yani_taxonomy()->get_taxonomy_simple('property_city');
		}

		if( $key == 'area' ) {
			$temp_array[] = _yani_taxonomy()->get_taxonomy_simple('property_area');
		}
		

	}

	$result = join( ", ", $temp_array );
	echo $result;
}

echo '</address>';