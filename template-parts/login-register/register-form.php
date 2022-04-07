<?php
$allowed_html_array = array(
    'a' => array(
        'href' => array(),
        'target' => array(),
        'title' => array()
    )
);
$user_show_roles = _yani_theme()->get_option('user_show_roles');
$show_hide_roles = _yani_theme()->get_option('show_hide_roles');
?>
<div id="hz-register-messages" class="hz-social-messages"></div>
<?php if( get_option('users_can_register') ) { ?>
<form>
<div class="register-form-wrap">
    
    <?php if( _yani_theme()->get_option('register_first_name', 0) == 1 ) { ?>
    <div class="form-group">
        <div class="form-group-field username-field">
            <input class="form-control" name="first_name" type="text" placeholder="<?php esc_html_e('First Name', _yani_theme()->get_text_domain()); ?>" />
        </div><!-- input-group -->
    </div><!-- form-group -->
    <?php } ?>

    <?php if( _yani_theme()->get_option('register_last_name', 0) == 1 ) { ?>
    <div class="form-group">
        <div class="form-group-field username-field">
            <input class="form-control" name="last_name" type="text" placeholder="<?php esc_html_e('Last Name', _yani_theme()->get_text_domain()); ?>" />
        </div><!-- input-group -->
    </div><!-- form-group -->
    <?php } ?>

    <div class="form-group">
        <div class="form-group-field username-field">
            <input class="form-control" name="username" type="text" placeholder="<?php esc_html_e('Username', _yani_theme()->get_text_domain()); ?>" />
        </div><!-- input-group -->
    </div><!-- form-group -->
    

    <div class="form-group">
        <div class="form-group-field email-field">
            <input class="form-control" name="useremail" type="email" placeholder="<?php esc_html_e('Email', _yani_theme()->get_text_domain()); ?>" />
        </div><!-- input-group -->
    </div><!-- form-group -->

    <?php if( _yani_theme()->get_option('register_mobile', 0) == 1 ) { ?>
    <div class="form-group">
        <div class="form-group-field phone-field">
            <input class="form-control" name="phone_number" type="number" placeholder="<?php esc_html_e('Phone', _yani_theme()->get_text_domain()); ?>" />
        </div><!-- input-group -->
    </div><!-- form-group -->
    <?php } ?>

    <?php if( _yani_theme()->get_option('enable_password') == 'yes' ) { ?>
        <div class="form-group">
            <div class="form-group-field password-field">
                <input class="form-control" name="register_pass" placeholder="<?php esc_html_e('Password', _yani_theme()->get_text_domain()); ?>" type="password" />
            </div><!-- input-group -->
        </div><!-- form-group -->
        <div class="form-group">
            <div class="form-group-field password-field">
                <input class="form-control" name="register_pass_retype" placeholder="<?php esc_html_e('Retype Password', _yani_theme()->get_text_domain()); ?>" type="password" />
            </div><!-- input-group -->
        </div><!-- form-group -->
    <?php } ?>
    
</div><!-- login-form-wrap -->

<?php if($user_show_roles != 0) { ?>
<div class="form-group mt-10">
    <select required="required" name="role" class="selectpicker form-control bs-select-hidden" data-live-search="false" data-live-search-style="begins">
        <option value=""> <?php esc_html_e('Select your account type',  _yani_theme()->get_text_domain()); ?> </option>
        <?php
        if( $show_hide_roles['agent'] != 1 ) {
            echo '<option value="yani_agent"> '._yani_theme()->get_option('agent_role').' </option>';
        }
        if( $show_hide_roles['agency'] != 1 ) {
            echo '<option value="yani_agency"> ' . _yani_theme()->get_option('agency_role') . ' </option>';
        }
        if( $show_hide_roles['owner'] != 1 ) {
            echo '<option value="yani_owner"> ' . _yani_theme()->get_option('owner_role') . '  </option>';
        }
        if( $show_hide_roles['buyer'] != 1 ) {
            echo '<option value="yani_buyer"> ' . _yani_theme()->get_option('buyer_role') . '  </option>';
        }
        if( $show_hide_roles['seller'] != 1 ) {
            echo '<option value="yani_seller"> ' . _yani_theme()->get_option('seller_role') . '  </option>';
        }
        if( $show_hide_roles['manager'] != 1 ) {
            echo '<option value="yani_manager"> ' . _yani_theme()->get_option('manager_role') . ' </option>';
        }
        ?>
    </select>
</div><!-- form-group -->
<?php } ?>

<div class="form-tools">
    <label class="control control--checkbox">
        <input name="term_condition" type="checkbox">
        <?php echo sprintf( __( 'I agree with your <a target="_blank" href="%s">Terms & Conditions</a>',  _yani_theme()->get_text_domain() ), 
            get_permalink(_yani_theme()->get_option('login_terms_condition') )); ?>
        <span class="control__indicator"></span>


    </label>
</div><!-- form-tools -->

<?php if(_yani_theme()->get_option('agent_forms_terms')) { ?>
<div class="form-tools">
    <label class="control control--checkbox">
        <input name="privacy_policy" type="checkbox"> <?php echo _yani_theme()->get_option('agent_forms_terms_text'); ?>
        <span class="control__indicator"></span>
    </label>
</div><!-- form-tools -->
<?php } ?>


<?php get_template_part('template-parts/google', 'reCaptcha'); ?>

<?php wp_nonce_field( 'yani_register_nonce', 'yani_register_security' ); ?>
<input type="hidden" name="action" value="yani_register" id="register_action">
<button id="yani-register-btn" type="submit" class="btn btn-primary btn-full-width">
    <?php get_template_part('template-parts/loader'); ?>
    <?php esc_html_e('Register', _yani_theme()->get_text_domain());?>
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

<?php } else {
    esc_html_e('User registration is disabled for demo purpose.',  _yani_theme()->get_text_domain());
} ?>