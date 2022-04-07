<?php
$prop_garage = yani_get_listing_data('property_garage');
$prop_garage_label = ($prop_garage > 1 ) ? yani_option('glc_garages', 'Garages') : yani_option('glc_garage', 'Garage');

$output = '';
if($prop_garage != '') {
	$output .= '<li class="h-cars">';
		$output .= '<span class="hz-figure">'.$prop_garage.' ';
		
		if(yani_option('icons_type') == 'font-awesome') {
			$output .= '<i class="'.yani_option('fa_garage').' ml-1"></i>';

		} elseif (yani_option('icons_type') == 'custom') {
			$cus_icon = yani_option('garage');
			if(!empty($cus_icon['url'])) {

				$alt = isset($cus_icon['title']) ? $cus_icon['title'] : '';
				$output .= '<img class="img-fluid ml-1" src="'.esc_url($cus_icon['url']).'" width="16" height="16" alt="'.esc_attr($alt).'">';
			}
		} else {
			$output .= '<i class="yani-icon icon-car-1 mr-1"></i>';
		}

		$output .='</span>';
		$output .= $prop_garage_label;
	$output .= '</li>';
}
echo $output;