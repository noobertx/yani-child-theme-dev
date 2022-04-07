<?php
class yani_Membership{
	private static $instance = null;	

	public function update_package_listings($user_id) {
        $package_listings = get_the_author_meta( 'package_listings' , $user_id );
        $user_submit_has_no_membership = get_the_author_meta( 'user_submit_has_no_membership', $user_id );
        $user_submitted_without_membership = get_the_author_meta( 'user_submitted_without_membership', $user_id );
        $package_listings = intval($package_listings);

        if ( $package_listings - 1 >= 0 ) {
            if($user_submitted_without_membership == 'yes') {
                update_user_meta($user_id, 'package_listings', $package_listings - 1);
            } else if( empty($user_submit_has_no_membership) ) {
                update_user_meta($user_id, 'package_listings', $package_listings - 1);
            } else {
                update_user_meta($user_id, 'package_listings', $package_listings );
            }
        } else if( $package_listings == 0 ) {
            update_user_meta( $user_id, 'package_listings', 0 );
        }
    }

      public function get_stripe_payment_membership( $pack_id, $pack_price, $title ) {
            require_once( get_template_directory() . '/framework/stripe-php/init.php' );
            $stripe_secret_key = _yani_theme()->get_option('stripe_secret_key');
            $stripe_publishable_key = _yani_theme()->get_option('stripe_publishable_key');

            $current_user = wp_get_current_user();

            $userID = $current_user->ID;
            $user_login = $current_user->user_login;
            $user_email = get_the_author_meta('user_email', $userID);

            $stripe = array(
                "secret_key" => $stripe_secret_key,
                "publishable_key" => $stripe_publishable_key
            );

            \Stripe\Stripe::setApiKey($stripe['secret_key']);

            $submission_currency = _yani_theme()->get_option('currency_paid_submission');

            if( $submission_currency == 'JPY') {
                $package_price_for_stripe = $pack_price;
            } else {
                $package_price_for_stripe = $pack_price * 100;
            }

            print '
                <div class="yani_stripe_membership " id="'.  sanitize_title($title).'">
                    <script src="https://checkout.stripe.com/checkout.js" id="stripe_script"
                    class="stripe-button"
                    data-key="'. $stripe_publishable_key.'"
                    data-amount="'.$package_price_for_stripe.'"
                    data-email="'.$user_email.'"
                    data-currency="'.$submission_currency.'"
                    data-zip-code="true"
                    data-locale="'.get_locale().'"
                    data-billing-address="true"
                    data-label="'.__('Pay with Credit Card',_yani_theme()->get_text_domain()).'"
                    data-description="'.$title.' '.__('Package Payment',_yani_theme()->get_text_domain()).'">
                    </script>
                </div>
                <input type="hidden" id="pack_id" name="pack_id" value="' . $pack_id . '">
                <input type="hidden" name="userID" value="' . $userID . '">
                <input type="hidden" id="pay_ammout" name="pay_ammout" value="' . $package_price_for_stripe . '">';
        }

	public static function get_instance() {

		// If the single instance hasn't been set, set it now.
		if ( null == self::$instance ) {
			self::$instance = new self;
		}
		return self::$instance;
	}
}

function _yani_membership() {
	return yani_Membership::get_instance();
}