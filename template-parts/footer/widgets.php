<?php	$footer_bg = _themename_sanitize_footer_bg(get_theme_mod("set_footer_bg","dark"));?>
<div id="footer-wrap" class="bg-<?php echo $footer_bg;?>">
	<div class="container mx-auto">
		<div class="row">
			<?php

				$selected_layout = get_theme_mod('set_footer_layout');

				$layouts = array(
					array(3,3,3,3),
					array(4,4,4),
				);


				$columns = $layouts[$selected_layout];

				foreach($columns as $i => $colspan){	?>
				<div class="footer-<?php echo $i;?> col-<?php echo $colspan;?>">						
					<?php dynamic_sidebar( 'footer-sidebar-'.$i ); ?>
				</div>
		<?php } ?>
		</div>
	</div>
	
</div>