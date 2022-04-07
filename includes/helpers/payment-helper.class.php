<?php
if ( ! defined( 'WPINC' ) ) {
    die;
}

if ( ! class_exists( '_Yani_Payment_Helper' ) ) {
    class _Yani_Payment_Helper{
        private static $instance = null;        

        public function get_paypal_access_token( $url, $postArgs ) {
            $clientID   = _yani_theme()->get_option('paypal_client_id');
            $SecretID   = _yani_theme()->get_option('paypal_client_secret_key');

            $curl = curl_init( $url );
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_USERPWD, $clientID . ":" . $SecretID);
            curl_setopt($curl, CURLOPT_HEADER, false);

            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $postArgs );
            $response = curl_exec( $curl );

            if (empty($response)) {
                die(curl_error($curl));
                curl_close($curl);
            } else {
                $info = curl_getinfo($curl);
                curl_close($curl);
                if($info['http_code'] != 200 && $info['http_code'] != 201 ) {
                    echo "Received error: " . $info['http_code']. "\n";
                    echo "Raw response:".$response."\n";
                    die();
                }
            }
            // Convert json format to PHP array
            $response = json_decode( $response );
            return $response->access_token;
        }

        public function execute_paypal_request( $url, $jsonData, $access_token ) {

            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_HEADER, false);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                'Authorization: Bearer '.$access_token,
                'Accept: application/json',
                'Content-Type: application/json'
            ));

            curl_setopt($curl, CURLOPT_POSTFIELDS, $jsonData);
            $response = curl_exec( $curl );
            if (empty($response)) {
                die(curl_error($curl));
                curl_close($curl);
            } else {
                $info = curl_getinfo($curl);
                curl_close($curl);
                if($info['http_code'] != 200 && $info['http_code'] != 201 ) {
                    echo "Received error: " . $info['http_code']. "\n";
                    echo "Raw response:".$response."\n";
                    die();
                }
            }

            $jsonResponse = json_decode($response, TRUE);
            return $jsonResponse;
        }


        public function stripe_cancel_subscription() {
            global $current_user;
            require_once( get_template_directory() . '/framework/stripe-php/init.php' );

            $current_user = wp_get_current_user();
            $userID = $current_user->ID;

            $stripe_customer_id = get_user_meta($userID, 'yani_stripe_user_profile', true);
            $subscription_id = get_user_meta($userID, 'yani_stripe_subscription_id', true);

            $stripe_secret_key = _yani_theme()->get_option('stripe_secret_key');
            $stripe_publishable_key = _yani_theme()->get_option('stripe_publishable_key');
            $stripe = array(
                "secret_key"      => $stripe_secret_key,
                "publishable_key" => $stripe_publishable_key
            );
            \Stripe\Stripe::setApiKey($stripe['secret_key']);

            $sub = \Stripe\Customer::retrieve($stripe_customer_id);
            $subscription = \Stripe\Subscription::retrieve($subscription_id);
            /*$sub->cancel(
                array("at_period_end" => true)
            );*/

            \Stripe\Subscription::update(
                $subscription_id,
                array(
                    'cancel_at_period_end' => true,
                )
            );
            $subscription->cancel();

            update_user_meta($current_user->ID, 'yani_stripe_subscription_id', '');
            update_user_meta($current_user->ID, 'yani_stripe_user_profile', '');
        }

        public static function get_instance() {

            // If the single instance hasn't been set, set it now.
            if ( null == self::$instance ) {
                self::$instance = new self;
            }
            return self::$instance;
        }    
    }
}

function _yani_payment() {
    return _Yani_Payment_Helper::get_instance();
}

