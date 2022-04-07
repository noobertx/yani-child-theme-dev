
<footer id="footer">

	<div id="site-footer" role ="contentinfo">		
		<?php get_template_part('template-parts/footer/widgets'); ?>
		<?php get_template_part('template-parts/footer/info'); ?>
	</div>
</footer>
</div>
		<?php
		if( !_yani_template()->is_login_page() ) { 
			//get_template_part('template-parts/login-register/modal-login-register'); 
		}
		//get_template_part('template-parts/listing/listing-lightbox'); 
		?>
		
		<?php if(_yani_theme()->get_header_style(true) == 'header-simple'){ ?>
			<?php //get_template_part('template-parts/header/header','side-slide'); ?>
		<?php } ?>
	<?php wp_footer();?>
	</body>
</html>
