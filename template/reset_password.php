<?php
/**
 * Template Name: Reset Password
 *
 */
if ( is_user_logged_in() ) {
	wp_redirect( home_url() );
}
get_header();

get_template_part('template-parts/page-title');

$rp_key = '';
$rp_login = '';
$resetpass = false;

if ( isset( $_REQUEST['key'] ) && !empty( $_REQUEST['key'] ) ) :

	$rp_key = $_REQUEST['key'];

endif;

if ( isset( $_REQUEST['login'] ) && !empty( $_REQUEST['login'] ) ) :

	$rp_login = $_REQUEST['login'];

endif;

if ( !empty( $rp_key ) && !empty( $rp_login ) ) :

	$resetpass = true;

endif;

?>
<section class="frontend-submission-page">
    <div class="container">
        <div class="row">
            <div class="col-12">
            	<div id="reset_pass_msg_2"></div>

                <div class="dashboard-content-block hz-password-reset-page">
                    <?php if ( $rp_login == 'invalidkey' ) : $resetpass = false; ?>
						<div class="alert alert-danger" role="alert"> <?php esc_html_e('Oops something went wrong.', _yani_theme()->get_text_domain()); ?>  </div>
						<div class="login-register-title text-center">
			                <p class="text-danger"> <?php esc_html_e('Oops something went wrong.', _yani_theme()->get_text_domain()); ?> </p>
			            </div>
					<?php endif; ?>
					<?php if ( $rp_login == 'expiredkey' ) : $resetpass = false; ?>
			        	<div class="login-register-title text-center">
			                <p class="text-danger"> <?php esc_html_e('Session key expired.', _yani_theme()->get_text_domain()); ?> </p>
			            </div>
					<?php endif; ?>
					<?php if ( isset( $_REQUEST['password'] ) && $_REQUEST['password'] == 'changed' ) : $resetpass = false; ?>
			        	<div class="login-register-title text-center">
			                <p> <?php esc_html_e('Password has been changed, you can login now.', _yani_theme()->get_text_domain()); ?> </p>
			                <a href="#" data-toggle="modal" data-target="#pop-login" class="back text-center"> <?php esc_html_e('Log in | Register', _yani_theme()->get_text_domain()); ?> </a>
			            </div>
					<?php endif; ?>
		            <?php if ( $resetpass ) : ?>
			            <form action="#" method="post" autocomplete="off">
				            <input type="hidden" name="rp_login" value="<?php echo $rp_login; ?>" autocomplete="off" />
							<input type="hidden" name="rp_key" value="<?php echo $rp_key; ?>" />
							<?php wp_nonce_field( 'yani_resetpassword_nonce', 'yani_resetpassword_security' ); ?>
			                <div class="form-group">
			                    <input type="password" name="pass1" class="form-control" placeholder="<?php esc_html_e('New Password', _yani_theme()->get_text_domain()); ?>">
			                </div>
			                <div class="form-group">
			                    <input type="password" name="pass2" class="form-control" placeholder="<?php esc_html_e('Confirm Password', _yani_theme()->get_text_domain()); ?>">
			                </div>
			                <button type="submit" id="yani_reset_password" class="btn btn-primary btn-block">
			                	<?php get_template_part('template-parts/loader'); ?>
			                	<?php esc_html_e('Reset Password', _yani_theme()->get_text_domain()); ?>		
			                </button>
			                
			            </form>
			        <?php endif; ?>
                </div><!-- dashboard-content-block -->
            </div>
        </div><!-- row -->
    </div><!-- container -->
</section><!-- frontend-submission-page -->
<?php
get_footer();