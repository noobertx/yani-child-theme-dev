<?php
global $hide_fields;
$address = _yani_property_listing()->get_listing_data('property_address');
$zipcode = _yani_property_listing()->get_listing_data('property_zip');

$country = _yani_taxonomy()->get_taxonomy_simple('property_country');
$city = _yani_taxonomy()->get_taxonomy_simple('property_city');
$state = _yani_taxonomy()->get_taxonomy_simple('property_state');
$area = _yani_taxonomy()->get_taxonomy_simple('property_area');

if( !empty($address) && $hide_fields['address'] != 1 ) {
    echo '<li class="detail-address"><strong>'._yani_theme()->get_option('spl_address', 'Address').'</strong> <span>'.esc_attr( $address ).'</span></li>';
}
if( !empty( $city ) && $hide_fields['city'] != 1 ) {
    echo '<li class="detail-city"><strong>'._yani_theme()->get_option( 'spl_city', 'City' ).'</strong> <span>'.esc_attr( $city ).'</span></li>';
}
if( !empty( $state ) && $hide_fields['state'] != 1 ) {
    echo '<li class="detail-state"><strong>'._yani_theme()->get_option('spl_state', 'County/State').'</strong> <span>'.esc_attr( $state ).'</span></li>';
}
if( !empty($zipcode) && $hide_fields['zip'] != 1 ) {
    echo '<li class="detail-zip"><strong>'._yani_theme()->get_option('spl_zip', 'Zip/Postal Code').'</strong> <span>'.esc_attr( $zipcode ).'</span></li>';
}
if( !empty( $area ) && $hide_fields['area'] != 1 ) {
    echo '<li class="detail-area"><strong>'._yani_theme()->get_option( 'spl_area', 'Area' ).'</strong> <span>'.esc_attr( $area ).'</span></li>';
}
if( !empty($country) && $hide_fields['country'] != 1 ) {
    echo '<li class="detail-country"><strong>'._yani_theme()->get_option('spl_country', 'Country').'</strong> <span>'.esc_attr($country).'</span></li>';
}