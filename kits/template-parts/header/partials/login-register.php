<?php
	$enable_create_listing = 1;
	$header_create_listing_template_link = _yani_template()->get_template_link_2("template/user_dashboard_submit.php");

?>
<div class="login-register">
	<ul class="login-register-nav">
			<?php if(!is_user_logged_in() ){ ?>
				<li class="login-link">
					<a href="#" data-toggle="modal" data-target="#login-register-form"><?php esc_html_e('Login', _yani_theme()->get_text_domain()); ?></a>
				</li>
				<li class="register-link">
					<a href="#" data-toggle="modal" data-target="#login-register-form"><?php esc_html_e('Register', _yani_theme()->get_text_domain()); ?></a>
				</li>
			<?php }else{ ?>
				<li class="login-link">
					<a class="btn btn-icon-login-register" href="#" data-toggle="modal" data-target="#login-register-form"><i class="yani-icon icon-single-neutral-circle"></i></a>
				</li>
			<?php } ?>
	</ul>
</div>