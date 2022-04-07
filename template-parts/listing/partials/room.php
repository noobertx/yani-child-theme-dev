<?php
$prop_room  = yani_get_listing_data('property_rooms');
$prop_room_label = ($prop_room > 1 ) ? yani_option('glc_rooms', 'Rooms') : yani_option('glc_room', 'Room');

$output = '';
if( $prop_room != '' ) { 
	$output .= '<li class="h-rooms">';

		if(yani_option('icons_type') == 'font-awesome') {
			$output .= '<i class="'.yani_option('fa_room').' mr-1"></i>';

		} elseif (yani_option('icons_type') == 'custom') {
			$cus_icon = yani_option('room');
			if(!empty($cus_icon['url'])) {

				$alt = isset($cus_icon['title']) ? $cus_icon['title'] : '';
				$output .= '<img class="img-fluid mr-1" src="'.esc_url($cus_icon['url']).'" width="16" height="16" alt="'.esc_attr($cus_icon['title']).'">';
			}
		} else {
			$output .= '<i class="yani-icon real-estate-dimensions-block mr-1"></i>';
		}
		
		$output .= '<span class="item-amenities-text">'.esc_attr($prop_room_label).':</span> <span class="hz-figure">'.esc_attr($prop_room).'</span>';
	$output .= '</li>';
}
echo $output;