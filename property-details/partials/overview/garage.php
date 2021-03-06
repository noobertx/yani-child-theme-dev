<?php
$garage = yani_get_listing_data('property_garage');

if($garage != "") {

	$garage_label = ($garage > 1 ) ? yani_option('spl_garages', 'Garages') : yani_option('spl_garage', 'Garage');

	$output_garage = '';
	$output_garage .= '<ul class="list-unstyled flex-fill">';
		$output_garage .= '<li class="property-overview-item">';
			
			if(yani_option('icons_type') == 'font-awesome') {
				$output_garage .= '<i class="'.yani_option('fa_garage').' mr-1"></i> ';

			} elseif (yani_option('icons_type') == 'custom') {
				$cus_icon = yani_option('garage');
				if(!empty($cus_icon['url'])) {

					$alt_title = isset($cus_icon['title']) ? $cus_icon['title'] : '';
					$output_garage .= '<img class="img-fluid mr-1" src="'.esc_url($cus_icon['url']).'" width="16" height="16" alt="'.esc_attr($alt_title).'"> ';
				}
			} else {
				$output_garage .= '<i class="yani-icon icon-car-1 mr-1"></i> ';
			}

			$output_garage .= '<strong>'.esc_attr($garage).'</strong>';
		$output_garage .= '</li>';
		$output_garage .= '<li class="hz-meta-label h-garage">'.esc_attr($garage_label).'</li>';
	$output_garage .= '</ul>';

	echo $output_garage;
}