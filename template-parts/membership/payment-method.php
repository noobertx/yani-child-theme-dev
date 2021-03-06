<?php
$userID = get_current_user_id();
$total_taxes = 0;
$selected_package_id = isset( $_GET['selected_package'] ) ? $_GET['selected_package'] : '';
$pack_price = get_post_meta( $selected_package_id, 'yani_package_price', true );
$pack_tax = get_post_meta( $selected_package_id, 'yani_package_tax', true );
$pack_title = get_the_title( $selected_package_id );

if( !empty($pack_tax) && !empty($pack_price) ) {
    $total_taxes = intval($pack_tax)/100 * $pack_price;
    $total_taxes = round($total_taxes, 2);
}


if( !empty($total_taxes) ) {
    $pack_price = $pack_price + $total_taxes;
}


$terms_conditions = _yani_theme()->get_option('payment_terms_condition');
$allowed_html_array = array(
    'a' => array(
        'href' => array(),
        'title' => array(),
        'target' => array()
    )
);
$enable_paypal = _yani_theme()->get_option('enable_paypal');
$enable_stripe = _yani_theme()->get_option('enable_stripe');
$enable_2checkout = _yani_theme()->get_option('enable_2checkout');
$enable_wireTransfer = _yani_theme()->get_option('enable_wireTransfer');
$yani_auto_recurring = _yani_theme()->get_option('yani_auto_recurring');

$checked_paypal = $checked_stripe = $checked_bank = '';
if($enable_paypal != 0 ) {
    $checked_paypal = 'checked';
} elseif( $enable_paypal != 1 && $enable_stripe != 0 ) {
    $checked_stripe = 'checked';
} elseif( $enable_paypal != 1 && $enable_stripe != 1 && $enable_wireTransfer != 0 ) {
    $checked_bank = 'checked';
} else {

}

if( $pack_price > 0 ) {
?>
<div class="payment-method">
    
    <?php if( $enable_paypal != 0 ) { ?>
    <div class="payment-method-block paypal-method method-select">
        <div class="form-group">
            <label class="control control--radio radio-tab">
                <input type="radio" class="payment-paypal" name="yani_payment_type" value="paypal" <?php echo $checked_paypal;?>>
                    
                <span class="control-text"><?php esc_html_e( 'Paypal', _yani_theme()->get_text_domain()); ?></span>
                <span class="control__indicator"></span>
                <span class="radio-tab-inner"></span>
            </label>
        </div>
    </div>
    <?php 
    if( _yani_theme()->get_option('yani_disable_recurring', 0) != 0 ) {
        if( $yani_auto_recurring != 1 ) { ?>
            <div class="recurring-payment-wrap">
                <label class="control control--checkbox">
                    <input type="checkbox" name="paypal_package_recurring" id="paypal_package_recurring" value="1">
                    <?php esc_html_e( 'Set as recurring payment', 'houzez' ); ?>
                    <span class="control__indicator"></span>
                </label>
            </div><!-- recurring-payment-wrap -->
        <?php
            } else {
                echo '<input style="display: none;" type="checkbox" checked name="paypal_package_recurring" id="paypal_package_recurring" value="1">';
            }
        }
    }?>

    <?php if( $enable_stripe != 0 ) { ?>
    <div class="payment-method-block stripe-method method-select">
        <div class="form-group">
            <label class="control control--radio radio-tab">
                <input type="radio" class="payment-stripe" name="yani_payment_type" value="stripe" <?php echo $checked_stripe;?>>
                <span class="control-text"><?php esc_html_e( 'Stripe', _yani_theme()->get_text_domain()); ?></span>
                <span class="control__indicator"></span>
                <span class="radio-tab-inner"></span>
            </label>
            <?php _yani_membership()->get_stripe_payment_membership( $selected_package_id, $pack_price, $pack_title ); ?>
        </div>
    </div>

    <?php 
    if( _yani_theme()->get_option('yani_disable_recurring', 0) != 0 ) {
        if( $yani_auto_recurring != 1 ) { ?>
        <div class="recurring-payment-wrap">
            <label class="control control--checkbox">
                <input type="checkbox" name="yani_stripe_recurring" id="yani_stripe_recurring" value="1">
                <?php esc_html_e( 'Set as recurring payment', 'houzez' ); ?>
                <span class="control__indicator"></span>
            </label>
        </div><!-- recurring-payment-wrap -->
        <?php
            } else {
                echo '<input type="hidden" name="yani_stripe_recurring" id="yani_stripe_recurring" value="1">';
            }
        }
    }
    ?>

    <?php if( $enable_wireTransfer != 0 ) { ?>
    <div class="payment-method-block bank-method method-select">
        <div class="form-group">
            <label class="control control--radio radio-tab">
                <input type="radio" name="yani_payment_type" value="direct_pay" <?php echo $checked_bank;?>>
                <span class="control-text"><?php esc_html_e( 'Bank Transfer', 'houzez' ); ?></span>
                <span class="control__indicator"></span>
                <span class="radio-tab-inner"></span>
                <span class="float-right"><?php esc_html_e('Payment by bank transfer. Use the order ID as a reference', _yani_theme()->get_text_domain()); ?></span>
            </label>
        </div>

    </div>
    <?php } ?>
</div>
<?php } //$pack_price != 0 if ?>

<input type="hidden" name="yani_package_id" value="<?php echo esc_attr($selected_package_id); ?>">
<input type="hidden" name="yani_package_price" value="<?php echo esc_attr($pack_price); ?>">

<?php if( $pack_price > 0 ) { ?>

    <button id="yani_complete_membership" type="button" class="btn btn-success btn-full-width mt-4 mb-4">
        <?php get_template_part('template-parts/loader'); ?>
        <?php esc_html_e('Complete Membership', _yani_theme()->get_text_domain()); ?>
    </button>
    <div class="mb-4"><?php echo sprintf(wp_kses(__('By clicking "Complete Membership" you agree to our <a target="_blank"  href="%s">Terms & Conditions</a>', _yani_theme()->get_text_domain()), $allowed_html_array), get_permalink($terms_conditions)); ?></div>

<?php } else { 
    if( is_user_logged_in() ) { 

        if (yani_user_had_free_package($userID)) { ?>
            <button id="yani_complete_membership" type="button" class="btn btn-success btn-full-width mt-4 mb-4">
                <?php get_template_part('template-parts/loader'); ?>
                <?php esc_html_e('Complete Membership', _yani_theme()->get_text_domain()); ?>
            </button>
            <div class="mb-4"><?php echo sprintf(wp_kses(__('By clicking "Complete Membership" you agree to our <a target="_blank"  href="%s">Terms & Conditions</a>', _yani_theme()->get_text_domain()), $allowed_html_array), get_permalink($terms_conditions)); ?></div>

        <?php
        } else { // yani_user_had_free_package($userID) ?>
            <span class="help-block free-membership-used"><?php esc_html_e('You have already used your free package, please choose different package.', _yani_theme()->get_text_domain()); ?></span>
        <?php    
        }

    } else { // is_user_logged_in() ?>

        <button id="yani_complete_membership" type="button" class="btn btn-success btn-full-width mt-4 mb-4">
            <?php get_template_part('template-parts/loader'); ?>
            <?php esc_html_e('Complete Membership', _yani_theme()->get_text_domain()); ?>
        </button>
        <div class="mb-4"><?php echo sprintf(wp_kses(__('By clicking "Complete Membership" you agree to our <a target="_blank"  href="%s">Terms & Conditions</a>', _yani_theme()->get_text_domain()), $allowed_html_array), get_permalink($terms_conditions)); ?></div>

    <?php
    }

}?>