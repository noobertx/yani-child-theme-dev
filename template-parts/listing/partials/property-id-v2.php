<?php
$property_id  = yani_get_listing_data('property_id');
$property_id_label = yani_option('glc_listing_id', 'Listing ID');

$output = '';
if( $property_id != '' ) { 
	$output .= '<li class="h-property-id">';
		$output .= '<span class="hz-figure">'.$property_id.' ';
		
		if(yani_option('icons_type') == 'font-awesome') {
			$output .= '<i class="'.yani_option('fa_property-id').' ml-1"></i>';

		} elseif (yani_option('icons_type') == 'custom') {
			$cus_icon = yani_option('property-id');
			if(!empty($cus_icon['url'])) {

				$alt = isset($cus_icon['title']) ? $cus_icon['title'] : '';
				$output .= '<img class="img-fluid ml-1" src="'.esc_url($cus_icon['url']).'" width="16" height="16" alt="'.esc_attr($alt).'">';
			}
		} else {
			$output .= '<i class="yani-icon icon-tags ml-1"></i>';
		}

		$output .= '</span>';
		$output .= ' '.$property_id_label;
	$output .= '</li>';
}
echo $output;