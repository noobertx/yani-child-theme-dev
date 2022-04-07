<div id="hz-login-messages" class="hz-social-messages"></div>
<form>
    <div class="login-form-wrap">
        <div class="form-group">
            <div class="form-group-field username-field">
                <input class="form-control" name="username" placeholder="<?php esc_html_e('Username or Email', _yani_theme()->get_text_domain()); ?>" type="text" />
            </div><!-- input-group -->
        </div><!-- form-group -->
        <div class="form-group">
            <div class="form-group-field password-field">
                <input class="form-control" name="password" placeholder="<?php esc_html_e('Password', _yani_theme()->get_text_domain()); ?>" type="password" />
            </div><!-- input-group -->
        </div><!-- form-group -->
    </div><!-- login-form-wrap -->

    <div class="form-tools">
        <div class="d-flex">
            <label class="control control--checkbox flex-grow-1">
                <input name="remember" type="checkbox"><?php esc_html_e( 'Remember me',  _yani_theme()->get_text_domain() ); ?>
                <span class="control__indicator"></span>
            </label>
            <a href="#" data-toggle="modal" data-target="#reset-password-form" data-dismiss="modal"><?php esc_html_e( 'Lost your password?',  _yani_theme()->get_text_domain() ); ?></a>
        </div><!-- d-flex -->    
    </div><!-- form-tools -->

    <?php get_template_part('template-parts/google', 'reCaptcha'); ?>

    <?php wp_nonce_field( 'yani_login_nonce', 'yani_login_security' ); ?>
    <input type="hidden" name="action" id="login_action" value="yani_login">

    <input type="hidden" name="redirect_to" value="<?php echo esc_url(_yani_login_register()->after_login_redirect()); ?>">

    <button id="yani-login-btn" type="submit" class="btn btn-primary btn-full-width">
        <?php get_template_part('template-parts/loader'); ?>
        <?php esc_html_e('Login',  _yani_theme()->get_text_domain()); ?>        
    </button>
</form>

<?php if( _yani_theme()->get_option('facebook_login') != 'no' || _yani_theme()->get_option('google_login') != 'no' ) { ?>
<div class="social-login-wrap">

    <?php if( _yani_theme()->get_option('facebook_login') != 'no' ) { ?>
    <button type="button" class="hz-facebook-login btn btn-facebook-login btn-full-width">
        <?php get_template_part('template-parts/loader'); ?>
        <?php esc_html_e( 'Continue with Facebook',  _yani_theme()->get_text_domain() ); ?>
    </button>
    <?php } ?>

    <?php if( _yani_theme()->get_option('google_login') != 'no' ) { ?>
    <button type="button" class="hz-google-login btn btn-google-plus-lined btn-full-width">
        <?php get_template_part('template-parts/loader'); ?>
        <img class="google-icon" src="<?php echo yani_IMAGE; ?>Google__G__Logo.svg"/> <?php esc_html_e( 'Sign in with google',  _yani_theme()->get_text_domain() ); ?>
    </button>
    <?php } ?>

</div>
<?php } ?>
