<?php 
	global $custom_wprig_opt;

	$customizer_footer = _themename_sanitize_footer_bg(get_theme_mod("set_footer_bg","dark"));
	$footer_text = get_theme_mod("set_copyright_text","dark");
?>
<div class="info-wrap bg-<?php echo $customizer_footer; ?> text-center">
	<?php if (($custom_wprig_opt && $custom_wprig_opt['opt-display-copyright'] && !empty($custom_wprig_opt['opt-display-copyright-text'])) || !empty($customizer_footer)) {

		if(!empty($custom_wprig_opt['opt-display-copyright-text'])){
			echo $custom_wprig_opt['opt-display-copyright-text'];
		}else{
			$allowed = array('a' => array(
				'href' => array(),
				'title' => array()
			));

			echo wp_kses($footer_text,$allowed);
		}

	}else{		
		echo "All rights reserved";
	} ?>
</div>