<div class="form-login-link login-link">
    <?php esc_html_e('Already have an account?', _yani_theme()->get_text_domain()); ?> 
    <a href="#" data-toggle="modal" data-target="#login-register-form"><?php esc_html_e('Login', _yani_theme()->get_text_domain()); ?></a>
</div>
<div class="row">
    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label><?php esc_html_e('First Name', _yani_theme()->get_text_domain()); ?></label>
            <input type="text" name="first_name" class="form-control" placeholder="<?php esc_html_e('Enter your first name', _yani_theme()->get_text_domain()); ?>">
        </div>
    </div><!-- col-md-6 col-sm-12 -->
    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label><?php esc_html_e('Last Name', _yani_theme()->get_text_domain()); ?></label>
            <input type="text" name="last_name" class="form-control" placeholder="<?php esc_html_e('Enter your last name', _yani_theme()->get_text_domain()); ?>">
        </div>
    </div><!-- col-md-6 col-sm-12 -->
    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label><?php esc_html_e('Username *', _yani_theme()->get_text_domain()); ?> </label>
            <input type="text" name="username" class="form-control" placeholder="<?php esc_html_e('Enter username', _yani_theme()->get_text_domain()); ?> ">
        </div>
    </div><!-- col-md-6 col-sm-12 -->
    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="useremail"> <?php esc_html_e('Email *', _yani_theme()->get_text_domain()); ?> </label>
            <input type="email" name="useremail" class="form-control" placeholder="<?php esc_html_e('Enter your email address', _yani_theme()->get_text_domain()); ?>">
        </div>
    </div><!-- col-md-6 col-sm-12 -->
    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="password"> <?php esc_html_e('Password *', _yani_theme()->get_text_domain()); ?> </label>
            <input type="password" name="register_pass" class="form-control" placeholder="<?php esc_html_e('Password', _yani_theme()->get_text_domain()); ?>">
        </div>
    </div><!-- col-md-6 col-sm-12 -->
    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="confirmpassword"> <?php esc_html_e('Confirm Password *', _yani_theme()->get_text_domain()); ?> </label>
            <input type="password" name="register_pass_retype" class="form-control" placeholder="<?php esc_html_e('Confirm Password', _yani_theme()->get_text_domain()); ?>">
        </div>
    </div><!-- col-md-6 col-sm-12 -->
</div><!-- row -->
<?php wp_nonce_field( 'yani_register_nonce2', 'yani_register_security2' ); ?>
<input type="hidden" name="action" value="yani_register_user_with_membership">

