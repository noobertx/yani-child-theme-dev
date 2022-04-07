<?php if(_yani_form()->show_google_reCaptcha()): ?>
<div class="form-group captcha_wrapper houzez-grecaptcha-<?php echo _yani_theme()->get_option( 'recaptha_type', 'v2' ); ?>">
    <div class="yani_google_reCaptcha"></div>
</div>
<?php endif; ?>