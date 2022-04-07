<?php
function _themename_validate_footer_layout($validity, $value){
	// Displays error when input is not valid
	// if(!preg_match('/^([1-9]|1[012])(,(1-9]|1[012]))*$/',$value)){

	if(!is_numeric($value)){
		$validity->add('invalid_footer_layout',esc_html__("Footer Layout is Invallid",""));
	}
	// }

	return $validity;
}
?>