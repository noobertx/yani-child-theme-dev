<?php
$land_area 	= yani_get_listing_data('property_land');

if(!empty($land_area)) {

	$output_land = '';	
	$output_land .= '<ul class="list-unstyled flex-fill">';
		$output_land .= '<li class="property-overview-item">';
			
			if(yani_option('icons_type') == 'font-awesome') {
				$output_land .= '<i class="'.yani_option('fa_land-area').' mr-1"></i> ';

			} elseif (yani_option('icons_type') == 'custom') {
				$cus_icon = yani_option('land-area');
				if(!empty($cus_icon['url'])) {

					$alt_title = isset($cus_icon['title']) ? $cus_icon['title'] : '';
					$output_land .= '<img class="img-fluid mr-1" src="'.esc_url($cus_icon['url']).'" width="16" height="16" alt="'.esc_attr($alt_title).'"> ';
				}
			} else {
				$output_land .= '<i class="yani-icon icon-real-estate-dimensions-map mr-1"></i> ';
			}

			$output_land .= '<strong>'.yani_get_land_area_size( get_the_ID() ).'</strong>';
		$output_land .= '</li>';
		$output_land .= '<li class="hz-meta-label h-land">'.yani_option('spl_lot', 'Lot').' '.yani_get_land_size_unit( get_the_ID() ).'</li>';
	$output_land .= '</ul>';

	echo $output_land;
}