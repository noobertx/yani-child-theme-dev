<?php



$footer_link_color = sanitize_hex_color(get_theme_mod("set_footer_links_color","#fff"));
$header_links_color = sanitize_hex_color(get_theme_mod("set_header_links_color","#fff"));



$inline_style = "
	#navbarSupportedContent a  span {
		color : {$header_links_color};
	}
	footer a {
		color : {$footer_link_color};
	}
";
?>