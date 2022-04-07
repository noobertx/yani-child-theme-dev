<?php
function _themename_sanitize_site_info($input){
	$allowed = array('a' => array(
		'href' => array(),
		'title' => array()
	));

	return wp_kses($input, $allowed);
}


function _themename_sanitize_footer_bg($input){
	$valid = array("light","dark");

	if(in_array($input,$valid,true)){
		return $input;
	}

	return "dark";
}
?>