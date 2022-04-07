<?php
$property_type = _yani_taxonomy()->get_taxonomy_simple('property_type');

$output = '';
if(!empty($property_type)) {
	$output .= '<li class="h-type">';
		$output .= '<span>'.esc_attr($property_type).'</span>';
	$output .= '</li>';
}

if(_yani_theme()->get_option('disable_type', 1)) {
	echo $output;
}